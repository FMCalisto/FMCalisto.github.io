<div class="entry" id="excerpt-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>" data-view="featurette">
	<?php
	global $wp_query;
	$thumb_class = ( $wp_query->current_post % 2 ) ? 'img-right' : 'img-left';
	?>
	<div class="col col-6 col-sm-12 col-md-6 <?php echo $thumb_class; ?>">
		<?php if ( $imgdata = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array( '460', '300' ) ) )  : ?>
			<a href="<?php the_permalink(); ?>">
				<div class="excerpt-thumb cover-image" style="background-image:url('<?php echo $imgdata[0]; ?>');"></div>
			</a>
		<?php endif; ?>
	</div>
	<div class="col col-6 col-sm-12 col-md-6">
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		<?php

		// Get the excerpt
		if ( ! empty( $post->post_excerpt ) ) {
			$excerpt = $post->post_excerpt;
		} else {
			$excerpt_args = array(
				'text'   => get_the_content(),
				'length' => 30
			);
			$excerpt = wp_cards_the_excerpt( $excerpt_args );
		}

		echo wpautop( $excerpt );

		?>
		<p><a href="<?php the_permalink(); ?>" rel="bookmark" class="btn btn-success"><?php _e( 'Continue Reading', 'wp-cards' ); ?> <i class="glyphicon glyphicon-arrow-right"></i></a></p>
	</div>
</div><!-- /.entry -->
<hr class="featurette-divider">