<h1 class="entry-title"><?php the_title(); ?></h1>
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
<div class="btn-toolbar"><a class="btn btn-primary btn-lg" href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'wp-cards' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" role="button"><?php _e( 'Read more &raquo;', 'wp-cards' ); ?></a></div>