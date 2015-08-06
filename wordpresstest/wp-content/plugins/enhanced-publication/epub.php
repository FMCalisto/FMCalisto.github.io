<?php

/*
Plugin Name: Enhanced Publication
Plugin URI: http://ep-books.ehumanities.nl/semantic-words/enhanced-publication
Description: Resource map for Enhanced Publication.
Version: 1.0
Author: Zuotian Tatum, Clifford Tatum
*/

/*  Copyright Zuotian Tatum  (email : zuotiantatum@live.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if (!class_exists('epub_repository'))
{
    require_once('epub_repository.php');
}

if (!defined('EPUB_POST_TYPE'))
{
    define('EPUB_POST_TYPE', get_option('epub_type', 'book_chapter'));
}

add_action('wp_head', 'epub_aggregation_link');
add_action('init', 'epub_init', 10, 1);
add_action('admin_init', 'epub_admin_init');
add_action('admin_menu', 'epub_menu');
add_filter('post_limits', "setpost_limits");
add_action('wp_ajax_epub_site_editors', 'epub_site_editors');
add_action('wp_ajax_epub_conversion', 'epub_conversion');
add_action('the_content', 'epub_content');

function setpost_limits($limit)
{
    return is_feed('aggregation-rdf') ? "" : $limit;
}

function epub_init()
{
    add_feed('aggregation-rdf', 'epub_rdf');

    //enable custom content types
    if (EPUB_POST_TYPE == 'book_chapter')
    {
        epub_book_chapter_init();
    }
}

function epub_admin_init()
{
    global $pagenow;
    if ($pagenow == 'options-general.php' && $_GET['page'] == 'enhanced-publication/epub_settings.php')
    {
        wp_enqueue_script('epub_settings_js', plugins_url('enhanced-publication/epub_settings.js'), array('jquery', 'suggest', 'jquery-ui-tabs', 'jquery-ui-dialog'));
        wp_enqueue_style('epub_jquery_ui', plugins_url('enhanced-publication/styles/jquery-ui-1.8.16.custom.css'));
    }

    add_meta_box('epubdiv', __('Enhanced Publication Fields'), 'epub_meta_box', EPUB_POST_TYPE, 'normal', 'high');

    add_action('save_post', 'epub_save_postdata');
}

function epub_site_editors()
{
    $query_var = esc_html(strtolower($_GET['q']));
    $search = sprintf( '*%s*',  $query_var );
    $authors = get_users(array('search' => $search, 'who' => 'authors', 'fields' => array('display_name')));

    if ($authors)
    {
        foreach ($authors as $author)
        {
            echo $author->display_name . "\n";
        }
    }

    die();
}

function epub_conversion()
{
    $post_type = $_POST['post_type'];
    $categories = $_POST['post_category'];

    $query = new WP_Query(array(
        'post_type' => $post_type,
        'category__in' => $categories));

    foreach ($query->posts as $post)
    {
        set_post_type($post->ID, EPUB_POST_TYPE);
    }

    if ($query->post_count)
    {
        die("Converted $query->post_count" . strtolower($post_type) . "s.");
    }
    else
    {
        die("No ". strtolower($post_type) . "s found.");
    }
}

function epub_content($content)
{
    global $post;
    if ($post->post_type == EPUB_POST_TYPE)
    {
        $result = '';

        if(function_exists('coauthors_posts_links'))
        {
            $result .= coauthors_posts_links(null, null, null, null, false);
        }
        else
        {
            $result .= get_the_author_link();
        }

        $result .= "<p></p>";

        $abstract = get_post_meta($post->ID, 'epub_abstract', true);
        if ($abstract)
        {
            $result .= '<p><strong>Abstract</strong><br />';
            $result .= '<span style="font-style:italic; padding-left:1em;">';
            $result .= str_replace(array("\r\n", "\n", "\r"), "<br/>", $abstract);
            $result .= "</span></p>\n";
        }

        $result .= '<hr/>';

        $result .= $content;

        $reference_cat = get_post_meta($post->ID, 'epub_reference_cat', true);
        if ($reference_cat && class_exists('bibliplug_query'))
        {
            $references = do_shortcode("[bibliplug category='$reference_cat']");
            if ($references)
            {
                $result .= '<hr/>';
                $result .= '<p><strong>Reference list</strong></p>';
                $result .= $references;
            }
        }

        return $result;
    }

    return $content;
}

function epub_aggregation_link()
{
    $epub_repository = new epub_repository();
    echo "<link rel='aggregation' type='text/rdf+xml' href='". $epub_repository->get_aggregation_url() ."'/>" . PHP_EOL;
    global $post;

    if (is_page() && get_option('epub_visualization_page_id', -1) == $post->ID)
    {
        $incontext_url = plugins_url('/enhanced-publication/InContext');
        ?><!-- Visualizer CSS files -->
        <link type="text/css" href="<?php echo $incontext_url; ?>/Content/visualizer.css" media="screen" rel="Stylesheet" />
        <link type="text/css" href="<?php echo $incontext_url; ?>/Content/visualizer-skin.css" media="screen" rel="Stylesheet" />

        <!-- Add transparent PNG support to IE6 -->
        <!-- Visualizer IE6 CSS file -->
        <!--[if IE 6]>
            <script type="text/javascript" src="' . $incontext_url . 'Content/iepngfix_tilebg.js"></script>
            <link type="text/css" href="' . $incontext_url . 'Content/visualizer-ie6.css" rel="Stylesheet" />
        <![endif]-->

        <!-- Visualizer script include files -->
        <script type="text/javascript" src="<?php echo $incontext_url; ?>/Scripts/visualizer_compiled_min.js"></script>

        <!-- Visualizer example code -->
        <script type="text/javascript">
        // initialize the visualizer
        var app = new VisualizerApp("visualizer_canvas", "<?php echo $epub_repository->get_aggregation_url(); ?>",
            { // configuration options, see the configuration options documentation page for more information
                debug: true,
                maxWidth: <?php echo get_option('epub_canvas_max_width', 800); ?>,
                dataUrl: "<?php echo $epub_repository->get_aggregation_url(); ?>",
                schemaUrl: "<?php echo $incontext_url; ?>/rdf_schema.php",
                titleProperties: ["http://purl.org/dc/terms/title", "http://xmlns.com/foaf/0.1/name"],
                dontShowProperties: ["http://www.openarchives.org/ore/terms/isDescribedBy", "http://purl.utwente.nl/ns/escape-system.owl#resourceUri"],
                annotationTypeId: "http://purl.utwente.nl/ns/escape-annotations.owl#RelationAnnotation",
                objectAnnotationTypeId: "http://purl.utwente.nl/ns/escape-annotations.owl#object",
                subjectAnnotationTypeId: "http://purl.utwente.nl/ns/escape-annotations.owl#subject",
                descriptionAnnotationTypeId: "http://purl.org/dc/terms/description",
                imageTypeId: "http://xmlns.com/foaf/0.1/img",
                useHistoryManager: true,
                baseClassTypes: {
                    "http://purl.org/spar/fabio/Book": "publication",
                    "http://purl.org/spar/fabio/BookChapter": "publication",
                    "http://purl.org/spar/fabio/WebSite": "event",
                    "http://purl.org/vocab/frbr/core#Expression": "publication",
                    "http://xmlns.com/foaf/0.1/Project": "project",
                    "http://purl.org/dc/dcmitype/MovingImage": "video",
                    "http://purl.utwente.nl/ns/escape-events.owl#Event": "event",
                    "http://purl.utwente.nl/ns/escape-projects.owl#Topic": "topic",
                    "http://xmlns.com/foaf/0.1/Image": "image"
                }
            });
        </script><?php
    }
}

function epub_rdf()
{
    header('Content-Type: '. feed_content_type('rss-http'). '; charset=' . get_option('blog_charset'), true);
    header('Content-Disposition: application/rdf+xml;');

    $repository = new epub_repository();
    $repository->book_aggregation();
}

function epub_menu()
{
    add_options_page('Enhanced Publication', 'Enhanced Publication', 8, 'enhanced-publication/epub_settings.php');
}

function epub_meta_box()
{
    global $post;
    ?>
    <div id="epub_abstract">
        <p><strong>Abstract</strong></p>
        <p><textarea name="epub_abstract" type="text" class="full text_input" rows="10" style="width:100%"><?php echo get_post_meta($post->ID, 'epub_abstract', true); ?></textarea></p>
    </div><?php

    if (class_exists('bibliplug_query')) {
        $ref_cats = get_categories(array('taxonomy' => 'ref_cat'));
        ?>
        <div id="epub_reference_cat">
            <p><strong>Reference category name</strong> &nbsp;&nbsp;&nbsp;
                <select name="epub_reference_cat">
                    <option value="">----</option>
                    <?php
                    $current_ref_cat = get_post_meta($post->ID, 'epub_reference_cat', true);
                    foreach($ref_cats as $ref_cat)
                    {
                        $selected = ($current_ref_cat == $ref_cat->name) ? 'selected="true"' : '';
                        echo '<option value="' . $ref_cat->name . '" ' . $selected . ' >' . $ref_cat->name . '</option>';
                    }
                    ?>
                </select>
            </p>
        </div>
        <?php }
    else
    {
        ?>
            <div id="epub_reference_cat">
                <p class="description">Install <a href="http://wordpress.org/extend/plugins/enhanced-bibliplug" />Enhanced Bibliplug</a> to add references to your chapter.</p>
            </div>
        <?php
    }
}

function epub_save_postdata()
{
    global $post;
    if ($post->post_type == EPUB_POST_TYPE) {
        if (isset($_POST['epub_abstract']))
        {
            update_post_meta($post->ID, 'epub_abstract', $_POST['epub_abstract']);
        }

        if (isset($_POST['epub_reference_cat']))
        {
            update_post_meta($post->ID, 'epub_reference_cat', $_POST['epub_reference_cat']);
        }
    }
}

function epub_book_chapter_init()
{
    $labels = array(
        'name' => _x('Book Chapters', 'post type general name'),
        'singular_name' => _x('Book Chapter', 'post type singular name'),
        'add_new' => _x('Add New', 'book'),
        'add_new_item' => __('Add New Book Chapter'),
        'edit_item' => __('Edit Book Chapter'),
        'new_item' => __('New Book Chapter'),
        'all_items' => __('All Book Chapter'),
        'view_item' => __('View Book Chapter'),
        'search_items' => __('Search Book Chapters'),
        'not_found' =>  __('No book chapters found'),
        'not_found_in_trash' => __('No book chapters found in Trash'),
        'parent_item_colon' => '',
        'menu_name' => 'Book Chapters'
    );

    register_post_type('book_chapter', array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        '_builtin' => false,
        '_edit_link' => 'post.php?post=%d',
        'capability_type' => 'page',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'chapter'),
        'supports' => array('title', 'editor', 'author'), //, 'custom-fields', 'author'),
        'menu_position' => 20,
        'taxonomies' => array('category', 'post_tag')
    ));
}
?>