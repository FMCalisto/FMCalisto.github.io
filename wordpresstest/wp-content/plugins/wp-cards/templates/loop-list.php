<?php

	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post(); ?>
			<div class="entry col col-lg-12">
				<div class="excerpt-wrapper" id="excerpt-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>" data-view="list">
					<?php wp_cards_excerpt( array( 'post_type' => get_post_type(), 'view' => 'list' ) ); ?>
				</div><!-- /.excerpt-wrapper -->
			</div><!-- /.entry col --><?php
		}
		rewind_posts();
	}

?>