<?php
/**
 * The template for displaying Comments
 * The area of the page that contains comments and the comment form.
 
  */
// Exit if accessed directly
if ( !defined('ABSPATH')) exit;


?>
<?php if (post_password_required()) { ?>
    <p class="nocomments"><?php _e('This post is password protected. Enter the password to view any comments.', 'hathor'); ?></p>
    
	<?php return; } ?>

<?php if (have_comments()) : ?>
    <h6 id="comments">
			<?php
				printf( _n('One comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'hathor'),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>');
			?>
    </h6>

    

    <ol class="commentlist">
        <?php wp_list_comments('avatar_size=60&type=comment'); ?>
    </ol>
    
    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
    <div class="navigation">
        <div class="previous"><?php previous_comments_link(__( '&#8249; Older comments','hathor' )); ?></div><!-- end of .previous -->
        <div class="next"><?php next_comments_link(__( 'Newer comments &#8250;','hathor', 0 )); ?></div><!-- end of .next -->
    </div><!-- end of.navigation -->
    <?php endif; ?>

<?php else : ?>

<?php endif; ?>

<?php
if (!empty($comments_by_type['pings'])) : // let's seperate pings/trackbacks from comments
    $count = count($comments_by_type['pings']);
    ($count !== 1) ? $txt = __('Pings&#47;Trackbacks','hathor') : $txt = __('Pings&#47;Trackbacks','hathor');
?>

    <h6 id="pings"><?php printf( __( '%1$d %2$s for "%3$s"', 'hathor' ), $count, $txt, get_the_title() )?></h6>

    <ol class="commentlist">
        <?php wp_list_comments('type=pings&max_depth=<em>'); ?>
    </ol>


<?php endif; ?>
<div id="respond" class="comment-respond">

<?php if (comments_open()) : ?>

    <?php
    $fields = array(
        'author' => '<p class="comment-form-author">' . '<label for="author">' . __('Name','hathor') . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
        '<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30" /></p>',
        'email' => '<p class="comment-form-email"><label for="email">' . __('E-mail','hathor') . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
        '<input id="email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" /></p>',
        'url' => '<p class="comment-form-url"><label for="url">' . __('Website','hathor') . '</label>' .
        '<input id="url" name="url" type="text" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" /></p>',
    );

    $defaults = array('fields' => apply_filters('comment_form_default_fields', $fields));

    comment_form($defaults);
    ?>


    <?php endif; ?>
</div>