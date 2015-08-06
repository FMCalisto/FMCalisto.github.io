<?php
	$view = wp_cards_get_view();

	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post(); ?>
			<div class="entry col col-lg-12">
				<div class="excerpt-wrapper" id="excerpt-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>" data-view="<?php echo $view; ?>">
					<?php wp_cards_excerpt( array( 'post_type' => get_post_type(), 'view' => $view ) ); ?>
				</div><!-- /.excerpt-wrapper -->
			</div><!-- /.entry col -->
			<?php
		}

		/*wp_cards_load_more( array( 'view' => $view, 'target' => 'some_id' ) );*/
		rewind_posts();
	}

?>