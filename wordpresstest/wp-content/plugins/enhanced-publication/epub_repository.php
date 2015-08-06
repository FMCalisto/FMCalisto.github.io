<?php

include_once('arc2/ARC2.php');

if (class_exists('bibliplug_query'))
{
    require_once(BIBLIPLUG_DIR . 'format_helper/export_format_helper.php');
}

class epub_repository {

    private $site_url;
    private $aggregation_url;
    private $rdf2_url;
    private $site_name;
    private $config;
    private $book_node;

    public function __construct() {
        $this->site_url = get_bloginfo('url');
        $this->rdf2_url = get_feed_link('aggregation-rdf');
        $this->aggregation_url = $this->rdf2_url . '#aggregation';
        $this->site_name = get_bloginfo('name');

        $this->book_node = "_:book";

        $this->config = array(
            'serializer_prettyprint_containers' => 1,
            'ns' => array(
                'rdf' => 'http://www.w3.org/1999/02/22-rdf-syntax-ns#',
                'foaf' => 'http://xmlns.com/foaf/0.1/',
                'dc' => 'http://purl.org/dc/elements/1.1/',
                'dcterms' => 'http://purl.org/dc/terms/',
                'fabio' => 'http://purl.org/spar/fabio/',
                'biro' => 'http://purl.org/spar/biro/',
                'ore' => 'http://www.openarchives.org/ore/terms/',
                'res' => 'http://www.medsci.ox.ac.uk/vocab/researchers/0.1/',
                'frbr' => 'http://purl.org/vocab/frbr/core#',
                'prism' => 'http://prismstandard.org/namespaces/basic/2.0/',
                'dai' => 'http://purl.org/info:eu-repo/dai#',
                'pav' => 'http://swan.mindinformatics.org/ontologies/1.2/pav/',
                'escape-display' => 'http://purl.utwente.nl/ns/escape-display.owl#'
            ));
    }

    public function get_aggregation_url()
    {
        return $this->aggregation_url;
    }

    public function book_aggregation()
    {
        $serializer = ARC2::getRDFXMLSerializer($this->config);

        $main_index = array(
            $this->rdf2_url => $this->get_resource_map_description(),
            $this->aggregation_url => $this->get_aggregation_description_base(),
            $this->book_node => $this->get_book_description(),
            $this->site_url => $this->get_human_start_page_description()
        );

        $main_index[$this->aggregation_url]['ore:aggregates'][] = $this->book_node;

        // add publisher
        $this->get_publisher_description($main_index);

        // add authors to the aggregation.
        $this->aggregate_authors($main_index);

        $ref_index = array();
        $ref_count = 0;

        // add pages as book chapters to the aggregation.
        $posts = new WP_Query(array(
            'post_type' => EPUB_POST_TYPE,
            'orderby'=>'menu_order',
            'order' => 'ASC'));

        foreach($posts->posts as $post)
        {
            $post_url = get_permalink($post->ID);

            $post_description = array(
                'rdf:type' => array('http://purl.org/spar/fabio/BookChapter', 'http://www.openarchives.org/ore/terms/Aggregation'),
                'dcterms:title' => $post->post_title,
                'dcterms:issued' => mysql2date('Y-m-d\TH:i:s\Z', $post->post_date_gmt, false),
                'dcterms:modified' => mysql2date('Y-m-d\TH:i:s\Z', $post->post_modified_gmt, false),
                'dcterms:abstract' => $this->excerpt_content(get_post_meta($post->ID, 'epub_abstract', true)),
                'frbr:partOf' => array($this->book_node)
            );

            // co-author-plus plugin.
            if (function_exists('get_coauthors'))
            {
                $authors = get_coauthors($post->ID);
                foreach ($authors as $author)
                {
                    $author_url = get_author_posts_url($author->ID);
                    $post_description['dcterms:creator'][] = $author->display_name;
                    $post_description['pav:authoredBy'][] = $author_url;
                    $main_index[$author_url]['pav:authors'][] = $post_url;
                }
            }
            else
            {
                $author_url = get_author_posts_url($post->post_author);
                $post_description['dcterms:creator'] = array($author_url);
                //$post_description['pav:authoredBy'][] = $author_url;
                //$main_index[$author_url]['pav:authors'][] = $post_url;
            }

            $tags = get_the_tags($post->ID);
            if (!empty($tags))
            {
                foreach ($tags as $tag)
                {
                    $post_description['fabio:index'][] = $tag->name;
                }
            }

            $attachments = new WP_Query(array(
                'post_type' => 'attachment',
                'post_status' => 'inherit',
                'post_parent' => $post->ID
            ));

            foreach($attachments->posts as $attachment)
            {
                $attachment_description = array(
                    'rdf:type' => array('http://xmlns.com/foaf/0.1/Image'),
                    'dcterms:title' => $attachment->post_excerpt,
                    'dcterms:issued' => mysql2date('Y-m-d\TH:i:s\Z', $attachment->post_date_gmt, false),
                    'dcterms:modified' => mysql2date('Y-m-d\TH:i:s\Z', $attachment->post_modified_gmt, false),
                    'dcterms:format' => $attachment->post_mime_type,
                    'dcterms:description' => $attachment->post_content,
                    'ore:isAggregatedBy' => array($post_url)
                );

                $post_description['ore:aggregates'][] = $attachment->guid;
                $main_index[$attachment->guid] = $attachment_description;
            }

            // enhanced bibliplug plugin.
            if (class_exists('bibliplug_query'))
            {
                $reference_cat = get_post_meta($post->ID, 'epub_reference_cat', true);
                if ($reference_cat)
                {
                    global $bib_query;
                    $export_helper = new export_format_helper();
                    $references = $bib_query->get_references_by_taxonomy($reference_cat, 'ref_cat');

                    foreach($references as $reference)
                    {
                        $ref_node_name = '_:reference' . $reference->id;
                        $ref_description = $this->get_reference_description($reference, $main_index, &$ref_node_name, $export_helper);
                        $ref_description['biro:isReferencedBy'] = array($post_url);
                        $ref_index[$ref_node_name] = $ref_description;
                        $post_description['biro:references'][] = $ref_node_name;
                    }
                }
            }

            //$main_index[$this->aggregation_url]['ore:aggregates'][] = $post_url;
            $main_index[$this->book_node]['frbr:part'][] = $post_url;
            $main_index[$post_url] = $post_description;
        }

        // add related objects (books, vidoes) to the book itself.
        $related_objects_cat = get_option('epub_related_objects');
        if ($related_objects_cat && class_exists('bibliplug_query'))
        {
            global $bib_query;
            $export_helper = new export_format_helper();
            $references = $bib_query->get_references_by_taxonomy($related_objects_cat, 'ref_cat');
            foreach($references as $reference)
            {
                $ref_node_name = '_:reference' . $reference->id;
                $ref_description = $this->get_reference_description($reference, $main_index, &$ref_node_name, $export_helper);

                $main_index[$ref_node_name] = $ref_description;
                $ref_description['frbr:relatedEndeavour'] = array($this->book_node);
                $main_index[$this->book_node]['frbr:relatedEndeavour'][] = $ref_node_name;
            }
        }

        if (get_option('epub_show_agencies', false))
        {
            // add funding agencies.
            $main_index[$this->aggregation_url]['ore:aggregates'][] = 'http://www.surffoundation.nl/';
            $main_index[$this->site_url]['foaf:fundedBy'][] = 'http://www.surffoundation.nl/';
            $main_index['http://www.surffoundation.nl/'] = array(
                'rdf:type' => 'http://xmlns.com/foaf/0.1/Organization',
                'dcterms:title' => 'SURFfoundation',
                'escape-display:funds' => array($this->site_url)
            );

            $main_index[$this->aggregation_url]['ore:aggregates'][] = 'http://ehumanities.nl/';
            $main_index[$this->site_url]['foaf:fundedBy'][] = 'http://www.ehumanities.nl/';
            $main_index['http://ehumanities.nl/'] = array(
                'rdf:type' => 'http://xmlns.com/foaf/0.1/Organization',
                'dcterms:title' => 'e-Humanities Group',
                'escape-display:funds' => array($this->site_url)
            );

            $main_index[$this->aggregation_url]['ore:aggregates'][] = 'http://virtualknowledgestudio.nl/';
            $main_index[$this->site_url]['foaf:fundedBy'][] = 'http://www.virtualknowledgestudio.nl/';
            $main_index['http://virtualknowledgestudio.nl/'] = array(
                'rdf:type' => 'http://xmlns.com/foaf/0.1/Organization',
                'dcterms:title' => 'Virtual Knowledge Studio',
                'escape-display:funds' => array($this->site_url)
            );
        }

        echo $serializer->getSerializedIndex(array_merge($main_index, $ref_index));
    }

    private function get_aggregation_description_base()
    {
        return array(
            'rdf:type' => array('http://www.openarchives.org/ore/terms/Aggregation', 'http://purl.org/info:eu-repo/semantics/EnhancedPublication'),
            'dcterms:title' => $this->site_name,
            'ore:isDescribedBy' => array($this->rdf2_url),
            'ore:aggregates' => array($this->site_url)
        );
    }

    private function get_resource_map_description()
    {
        return array(
            'rdf:type' => array('http://www.openarchives.org/ore/terms/ResourceMap'),
            'ore:describes' => array($this->aggregation_url),
            'dcterms:title' => 'Resource Map of "'. $this->site_name .'"',
            'dcterms:created' => gmdate("Y-m-d\TH:m:s\Z"),
            'dcterms:rights' => array(
                'This Resource Map is available under the Creative Commons Attribution-Noncommercial Generic license',
                'http://creativecommons.org/licenses/by-nc/2.5/rdf'),
            'dcterms:creator' => 'Enhanced Publication for WordPress'
        );
    }

    private function get_human_start_page_description()
    {
        return array(
            'rdf:type' => array(
                'http://purl.org/spar/fabio/WebSite',
                'info:eu-repo/semantics/humanStartPage'),
            'dcterms:title' => $this->site_name,
            'dcterms:description' => get_bloginfo('description'),
            'dcterms:created' => mysql2date('Y-m-d\TH:i:s\Z', get_lastpostmodified('GMT'), false),
            'dcterms:modified' => mysql2date('Y-m-d\TH:i:s\Z', get_lastpostmodified('GMT'), false),
            'frbr:relatedEndeavour' => array($this->book_node),
        );
    }

    private function get_reference_description($reference, $main_index, &$ref_node_name, $export_helper)
    {
        global $bib_query;
        $creators = $bib_query->get_creators($reference->id);
        $reference_description = $export_helper->get_rdf_tripple($reference, $creators);

        // workaround for "More info" button.
        if ($reference_description['fabio:hasURL'])
        {
            $ref_node_name = $reference_description['fabio:hasURL'];
            unset($reference_description['fabio:hasURL']);
        }

        foreach($creators as $creator)
        {
            if ($creator->user_id)
            {
                $url = get_author_posts_url($creator->user_id);
                $main_index[$url]['pav:authors'][] = $ref_node_name;
                $reference_description['pav:authoredBy'][] = $url;
            }
        }

        return $reference_description;
    }

    private function get_user_description($user)
    {
        $user_meta = get_userdata($user->ID);
        $user_description = array(
            'foaf:name' => $user->display_name,
            'foaf:familyName' => $user_meta->user_lastname,
            'foaf:givenName' => $user_meta->user_firstname,
            'foaf:mbox' => $user->user_email,
            'foaf:homepage' => $user->user_url,
            'res:biography' => $user_meta->author_bio,
            'dai:DAI' =>$user_meta->dai
        );

        if (function_exists('user_avatar_fetch_avatar'))
        {
            $avatar_src = user_avatar_fetch_avatar(array( 'item_id' => $user->ID, 'html' => false, 'no_grav' => true));
            if ($avatar_src)
            {
                $user_description['foaf:img'] = array($avatar_src);
            }
        }

        return $user_description;
    }

    private function aggregate_authors(&$main_index)
    {
        $editors = get_users('role=editor');
        $authors = get_users('role=author');
        $admins = get_users('role=administrator');
        $book_editors = array_map('trim', explode(",", get_option('epub_site_editors')));
        $web_developers = array_map('trim', explode(",", get_option('epub_developers')));

        foreach (array_merge($authors, $editors, $admins) as $user)
        {
            $user_profile_url = get_author_posts_url($user->ID);
            $main_index[$user_profile_url] = $this->get_user_description($user);
            $main_index[$user_profile_url]['rdf:type'] = array('http://www.medsci.ox.ac.uk/vocab/researchers/0.1/Researcher');
            $main_index[$this->aggregation_url]['ore:aggregates'][] = $user_profile_url;

            if (in_array($user->display_name, $book_editors))
            {
                $main_index[$this->book_node]['pav:editedBy'][] = $user_profile_url;
                $main_index[$user_profile_url]['pav:editors'] = array($this->book_node);
            }

            if (in_array($user->display_name, $web_developers))
            {
                $main_index[$user_profile_url]['foaf:make'] = array($this->site_url);
                $main_index[$this->site_url]['foaf:maker'][] = $user_profile_url;
            }
        }
    }

    private function get_book_description()
    {
        return array(
            'rdf:type' => array('http://purl.org/spar/fabio/Book'),
            'dcterms:title' => get_option('epub_site_title', get_bloginfo('name')),
            'dcterms:abstract' => $this->excerpt_content(get_option('epub_site_abstract')),
            'dcterms:issued' => get_option('epub_site_publish_year'),
            'foaf:img' => array(get_option('epub_site_cover_url')),
            'foaf:homepage' => array($this->site_url),
            'ore:similarTo' => get_option('epub_site_identifier'),
            'frbr:relatedEndeavour' => array($this->site_url)
        );
    }

    private function get_publisher_description(&$main_index)
    {
        $publisher_url = get_option('epub_site_publisher_url');
        if ($publisher_url)
        {
            $main_index[$this->book_node]['pav:publishedBy'] = array($publisher_url);
            $main_index[$this->aggregation_url]['ore:aggregates'][] = $publisher_url;
            $main_index[$publisher_url] = array(
                'rdf:type' => 'http://xmlns.com/foaf/0.1/Organization',
                'dcterms:title' => get_option('epub_site_publisher'),
                'pav:publisher' => array($this->book_node)
            );
        }
        else
        {
            $main_index[$this->book_node]['dcterms:publisher'] = get_option('epub_site_publisher');
        }
    }

    private function wrap_text_in_cdata($text)
    {
        if ($text)
        {
            return '<![CDATA[' . str_replace(array("\r\n", "\n", "\r"), "<br/>", $text) . ']]>';
        }

        return $text;
    }

    private function excerpt_content($content)
    {
        if (strlen($content) > 100)
        {
            $end_pos = strpos($content, ' ', 150);
            return substr($content, 0, $end_pos) . ' ...';
        }

        return $content;
    }
}