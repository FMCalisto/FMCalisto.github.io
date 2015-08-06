<?php get_header(); ?>
<div class="container">
	<h1><?php _e( 'Card Staging Area', 'wp-cards' ); ?></h1>
	<div class="alert alert-warning hidden-xs hidden-sm hidden-md hidden-lg" role="alert">
		<strong><?php _e( 'Bootstrap is not enabled', 'wp-cards' ); ?></strong> <?php printf( __( 'WP Cards requires that Bootstrap CSS and JavaScript files to be loaded, active these files under Theme Options <a href="%1$s" class="alert-link" target="_blank">here</a>.', 'wp-cards' ), admin_url( 'options-general.php?page=wp_cards_options' ) ); ?>
	</div>
<?php if ( ! dynamic_sidebar( 'card_staging' ) ) : ?>
	<!-- Card Staging -->
	<div class="alert alert-info" role="alert">
		<strong><?php _e( 'No Cards To Preview', 'wp-cards' ); ?></strong> <?php _e( 'This theme requires that the WP Cards plugin be installed and activated in order to render this page correctly.', 'wp-cards' ); ?> <?php printf( __( 'If you are seeing this message and you already have WP Cards active on your site, there are currently no cards loaded into the "Card Staging" <a href="%1$s" class="alert-link" target="_blank">widget area</a>.', 'wp-cards' ), admin_url( 'widgets.php' ) ); ?>
	</div>
<?php endif; ?>
</div><!-- /.container -->
<?php get_footer(); ?>