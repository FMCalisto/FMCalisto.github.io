<?php

	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post(); ?>
			<div class="entry col col-12" id="excerpt-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>" data-view="banner">
				<?php wp_cards_excerpt( array( 'post_type' => get_post_type(), 'view' => 'list' ) ); ?>
			</div><!-- /.entry col --><?php
		}
		rewind_posts();
	}

?>