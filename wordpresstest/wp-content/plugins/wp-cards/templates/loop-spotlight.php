<?php

	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post(); ?>
			<div class="entry col col-md-4">
				<div class="spotlight-container" id="excerpt-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>" data-view="spotlight">
					<?php wp_cards_excerpt( array( 'post_type' => get_post_type(), 'view' => 'spotlight' ) ); ?>
				</div><!-- /.excerpt-wrapper -->
			</div><!-- /.entry col --><?php
		}
		rewind_posts();
	}

?>