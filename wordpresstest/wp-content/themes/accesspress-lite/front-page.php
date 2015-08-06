<?php
/**
 * The front page file.
 * @package AccesspressLite
 */

get_header(); ?>

	<?php 
		global $accesspresslite_options;
		$accesspresslite_settings = get_option( 'accesspresslite_options', $accesspresslite_options );

		if ( 'page' == get_option( 'show_on_front' ) ) {
		    include( get_page_template() );
		} else {
			get_template_part( 'index', 'one' ); 
		}
		
		
	?>
	
<?php get_footer(); ?>
