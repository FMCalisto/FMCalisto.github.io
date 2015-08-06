<?php

if (!current_user_can('manage_options'))
{
    wp_die(__('You do not have sufficient permissions to manage options for this blog.'));
}

$title = 'Enhanced Publication Settings';
$parent_file = 'options-general.php';

if (isset($_POST['visualization_page_id']))
{
    update_option('epub_visualization_page_id', $_POST['visualization_page_id']);
}

if (isset($_POST['canvas_max_width']))
{
    update_option('epub_canvas_max_width', $_POST['canvas_max_width']);
}

if (isset($_POST['epub_type']))
{
    update_option('epub_type', $_POST['epub_type']);
}

if (isset($_POST['site_title']))
{
    update_option('epub_site_title', $_POST['site_title']);
}

if (isset($_POST['site_abstract']))
{
    update_option('epub_site_abstract', $_POST['site_abstract']);
}

if (isset($_POST['site_publisher']))
{
    update_option('epub_site_publisher', $_POST['site_publisher']);
}

if (isset($_POST['site_publisher_url']))
{
    update_option('epub_site_publisher_url', $_POST['site_publisher_url']);
}

if (isset($_POST['site_publish_year']))
{
    update_option('epub_site_publish_year', $_POST['site_publish_year']);
}

if (isset($_POST['site_identifier']))
{
    update_option('epub_site_identifier', $_POST['site_identifier']);
}

if (isset($_POST['site_cover_url']))
{
    update_option('epub_site_cover_url', $_POST['site_cover_url']);
}

if (isset($_POST['page_category']))
{
    update_option('epub_page_category', $_POST['page_category']);
}

if (isset($_POST['site_editors']))
{
    update_option('epub_site_editors', $_POST['site_editors']);
}

if (isset($_POST['site_developers']))
{
    update_option('epub_developers', $_POST['site_developers']);
}

if (isset($_POST['site_related_objects']))
{
    update_option('epub_related_objects', $_POST['site_related_objects']);
}

if (isset($_POST['show_agencies']))
{
    update_option('epub_show_agencies', $_POST['show_agencies']);
}
else
{
    update_option('epub_show_agencies', false);
}


?><div class="wrap">
    <?php screen_icon(); ?>
    <h2><?php echo esc_html( $title ); ?></h2>
    <form id="epub-options" action="<?php admin_url("options-general.php?page=epub-settings"); ?>" method="post">
        <div id="epub-option-tabs" style="margin: 2em 0">
            <ul>
                <li><a href="#ontology-tab">Site mapping</a></li>
                <li><a href="#vis-tab">Visualization</a></li>
            </ul>

            <div id="ontology-tab">
                <div>
                    <p><strong>Map this blog and selected posts/pages to:</strong></p>
                    <p>
                        <select id ="epub_type" name="epub_type">
                            <option value="book_chapter" selected="selected">Book and chapters</option>
                            <!--<option value="2">Journal and articles</option>-->
                        </select>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<input id="epub-conversion" type="button" value="convert existing posts/pages" />)
                    </p>
                </div>
                <div id="site_title">
                    <p><strong>Title (if different from the current site title)</strong></p>
                    <p><input name="site_title" type="text" class="text_input full" style="width:100%" value="<?php echo get_option('epub_site_title', get_bloginfo('name')); ?>" /></p>
                </div>
                <div id="site_abstract">
                    <p><strong>Abstract</strong></p>
                    <p><textarea name="site_abstract" type="text" class="full text_input" rows="5" style="width:100%"><?php echo get_option('epub_site_abstract'); ?></textarea></p>
                </div>
                <div id="site_publisher">
                    <p><strong>Publisher</strong></p>
                    <p><input name="site_publisher" type="text" class="full text_input" style="width:100%" value="<?php echo get_option('epub_site_publisher'); ?>" /></p>
                </div>
                <div id="site_publisher_url">
                    <p><strong>Publisher URL</strong></p>
                    <p><input name="site_publisher_url" type="text" class="full text_input" style="width:100%" value="<?php echo get_option('epub_site_publisher_url'); ?>" /></p>
                </div>
                <div id="site_publish_year">
                    <p><strong>Publish Year</strong></p>
                    <p><input name="site_publish_year" type="text" class="full text_input" value="<?php echo get_option('epub_site_publish_year'); ?>" /></p>
                </div>
                <div id="site_identifier">
                    <p><strong>Unique Identifier (such as ISSN, ISBN)</strong></p>
                    <p><input name="site_identifier" type="text" class="full text_input" style="width:100%" value="<?php echo get_option('epub_site_identifier'); ?>" /></p>
                </div>
                <div id="site_cover_url">
                    <p><strong>Cover Image URL</strong></p>
                    <p><input name="site_cover_url" type="text" class="full text_input" style="width:100%" value="<?php echo get_option('epub_site_cover_url'); ?>" /></p>
                </div>
                <div id="site_editior">
                    <p><strong>Book editors</strong></p>
                    <p><input name="site_editors" type="text" class="full text_input epub_users" style="width:100%" value="<?php echo get_option('epub_site_editors'); ?>" />
                    <span class="description">Start typing user name here.</span></p>
                </div>

                <div id="site-developers">
                    <p><strong>Web developers</strong></p>
                    <p><input type="text" style="width:100%" name="site_developers" class="full text_input epub_users" value="<?php echo get_option('epub_developers'); ?>" />
                    <span class="description">Start typing user name here.</span></p>
                </div>
                <div>
                    <p><input type="checkbox" name="show_agencies" <?php if (get_option('epub_show_agencies', false)) echo 'checked="true"' ; ?>" /> Show Enhanced Publication plugin funding agencies.</p>
                </div>
                <?php if (class_exists('bibliplug_query')) { ?>
                <div id="related_objects">
                    <p><strong>Related Objects</strong> &nbsp;&nbsp;&nbsp;
                    <select name="site_related_objects">
                        <option value="">----</option>
                        <?php
                        $ref_cats = get_categories(array('taxonomy' => 'ref_cat'));
                        $current_ref_cat = get_option('epub_related_objects');
                        foreach($ref_cats as $ref_cat)
                        {
                            $selected = ($current_ref_cat == $ref_cat->name) ? 'selected="true"' : '';
                            echo '<option value="' . $ref_cat->name . '" ' . $selected . ' >' . $ref_cat->name . '</option>';
                        }
                        ?>
                    </select>
                    <span class="description">Reference category name. Reference in this category wil be shown as related objects to the book.</span></p>
                </div> <?php }?>

            </div>
            <div id="vis-tab">
                <p>To use InContext Visualization on your website, please </p>
                <p>		1. Copy the html code below into the page which the visualization will be shown.
                <pre>    &lt;div id="visualizer_canvas"&gt;&lt;/div&gt;</pre></p>
                <p>		2. Enter the page ID here <input type="text" name="visualization_page_id" value="<?php echo get_option('epub_visualization_page_id'); ?>" /></p>
                <p></p>
                <p>visualizer canvas max width: <input type="text" name="canvas_max_width" value="<?php echo get_option('epub_canvas_max_width', 800); ?>" /></p>
            </div>
        </div>
        <p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="Save Changes" /></p>
    </form>

    <form id="epub-conversion-form" title="Posts/pages conversion">
        <p><strong>You can convert existing posts/pages to the new ontology.</strong></p>
        <p>Choose the type for conversion:<br/>
            <select id="current-type" name="post_type"><option>Post</option><option>Page</option></select>
        </p>
        <div id="category-all" class="tabs-panel">
            <p>Choose one or more categories to convert.</p>
            <ul id="category-checklist" class="list:category categorychecklist form-no-clear">
                <?php wp_terms_checklist(); ?>
            </ul>
        </div>
        <strong><div id="convert-result"></div></strong>
    </form>
</div>