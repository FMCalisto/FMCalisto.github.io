<?php
/**
 * @package AccesspressLite
 */
?>
<?php
global $accesspresslite_options;
$accesspresslite_settings = get_option( 'accesspresslite_options', $accesspresslite_options );
$cat_event = $accesspresslite_settings['event_cat'];
$cat_testimonial = $accesspresslite_settings['testimonial_cat'];
$cat_portfolio = $accesspresslite_settings['portfolio_cat'];
?>


<?php if(!empty($cat_event) && is_category() && is_category($cat_event)): ?>
<article id="post-<?php the_ID(); ?>" class="cat-event-list">
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php 
		if( has_post_thumbnail() ){
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'featured-thumbnail', false ); 
		?>
		<div class="cat-event-image">
		<img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title(); ?>">
		</div>
		<?php } ?>
		<div class="cat-event-excerpt <?php if(! has_post_thumbnail() ) { echo "full-width"; }?>">

		<div class="event-date-archive">
			<?php accesspresslite_posted_on(); ?>
		</div>
		
		<div><?php echo accesspresslite_excerpt( get_the_content() , 400 ) ?></div>
		</div>
		<a href="<?php the_permalink(); ?>" class="cat-event-more bttn"><?php _e('More','accesspresslite');?></a>
	</div><!-- .entry-content -->
</article>

<?php elseif(!empty($cat_testimonial) && is_category() && is_category($cat_testimonial)): ?>

<article id="post-<?php the_ID(); ?>" class="cat-testimonial-list clearfix">
	<header class="entry-header">
	<div class="cat-testimonial-image">
	<?php 
		if( has_post_thumbnail() ){
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'featured-thumbnail', false ); 
		?>
		<img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title(); ?>">
		<?php }else {?>	
		<img src="<?php echo get_template_directory_uri(); ?>/images/testimonial-fallback.jpg" alt="<?php the_title(); ?>">
		<?php }?>
	</div>
		

	<h1 class="entry-title"><?php the_title(); ?></h1>
	
	</header><!-- .entry-header -->

	<div class="cat-testimonial-excerpt">
		    <?php the_content(); ?>
	</div>
</article>

<?php elseif(!empty($cat_portfolio) && is_category() && is_category($cat_portfolio)): ?>

<article id="post-<?php the_ID(); ?>" class="cat-portfolio-list">
<?php 
$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'portfolio-thumbnail', false ); 
$full_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large', false ); 
?>
	<a class="fancybox-gallery" href="<?php echo esc_url($full_image[0]); ?>" data-lightbox-gallery="gallery">
    <div class="cat-portfolio-image">
		<img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>">
    </div>
	<div class="portofolio-layout">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<div class="cat-portfolio-excerpt">
		    <?php the_content(); ?>
		</div>
	</div>
    </a>
</article>

<?php else: ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php accesspresslite_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php if(has_post_thumbnail()){?>
		<div class="entry-thumbnail">
			<?php  the_post_thumbnail('thumbnail'); ?>
		</div>
		<?php } ?>
		<div class="short-content">
		<?php echo accesspresslite_excerpt( get_the_content() , 500 ) ?>
		</div>
		<a href="<?php the_permalink(); ?>" class="bttn"><?php _e('More','accesspresslite')?></a>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'accesspresslite' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-footer">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'accesspresslite' ) );
				if ( $categories_list && accesspresslite_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( __( 'Posted in %1$s', 'accesspresslite' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'accesspresslite' ) );
				if ( $tags_list ) :
			?>
			<span class="tags-links">
				<?php printf( __( 'Tagged %1$s', 'accesspresslite' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
<?php endif; ?>