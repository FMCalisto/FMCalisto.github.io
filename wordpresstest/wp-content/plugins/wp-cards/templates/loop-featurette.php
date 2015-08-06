<?php

	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post(); 
			wp_cards_excerpt( array( 'post_type' => get_post_type(), 'view' => 'featurette' ) );
		}
		rewind_posts();
	}

?>