<?php

	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post(); ?>
			<div class="entry col col-xs-12 col-md-6 col-lg-4">
				<div class="excerpt-wrapper" id="excerpt-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>" data-view="grid">
					<?php wp_cards_excerpt( array( 'post_type' => get_post_type(), 'view' => 'grid' ) ); ?>
				</div><!-- /.excerpt-wrapper -->
			</div><!-- /.entry col --><?php
		}
		rewind_posts();
	}

?>