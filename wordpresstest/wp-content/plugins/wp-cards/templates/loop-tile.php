<?php

	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post(); ?>
			<div class="entry col col-sm-6 col-lg-4">
				<div class="excerpt-wrapper" id="excerpt-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>" data-view="tile">
					<?php wp_cards_excerpt( array( 'post_type' => get_post_type(), 'view' => 'tile' ) ); ?>
				</div><!-- /.excerpt-wrapper -->
			</div><!-- /.entry col --><?php
		}
		rewind_posts();
	}

?>