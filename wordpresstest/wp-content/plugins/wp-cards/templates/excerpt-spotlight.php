<?php if ( $imgdata = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array('300','300') ) )  : ?>
	<a href="<?php the_permalink(); ?>" rel="bookmark">
		<div class="cover-image img-circle" style="background-image:url('<?php echo $imgdata[0]; ?>');"></div>
	</a>
<?php endif; ?>
<div class="spotlight-body">
	<h3 class="entry-title"><?php the_title(); ?></h3>
	<?php
		// Get the excerpt
		if ( ! empty( $post->post_excerpt ) ) {
			$excerpt = $post->post_excerpt;
		} else {
			$excerpt_args = array(
				'text'   => get_the_content(),
				'length' => 60
			);
			$excerpt = wp_cards_the_excerpt( $excerpt_args );
		}

		echo wpautop( $excerpt );
	?>
</div><!-- /.spotlight-body -->
<div class="spotlight-footer"><a class="btn btn-default" href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'wp-cards' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" role="button"><?php _e( 'Read more &raquo;', 'wp-cards' ); ?></a></div>