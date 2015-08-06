<?php

global $wp_cards_plugin_options;
extract($wp_cards_plugin_options);

get_header(); 
	if ( 'enable' == $enable_jumbotron_cards['value'] ) : ?>
	<div class="container-fluid">
		<?php if ( ! dynamic_sidebar( 'jumbotron-cards' ) ) : ?>
		<!-- Jumbotron Cards -->
		<?php endif; ?>
	</div><!-- /.container-fluid -->
	<?php endif; ?>
	<div id="<?php echo $page_container_id['value']; ?>" class="container homepage-container">
		<?php if ( 'enable' == $enable_header_footer_cards['value'] ) : ?>
		<div class="header-cards">
			<?php if ( ! dynamic_sidebar( 'header-cards' ) ) : ?>
			<!-- Header Cards -->
			<?php endif; ?>
		</div><!-- /.header-cards -->
		<?php endif; ?>
		<div id="<?php echo $page_content_id['value']; ?>">
			<?php if ( ! dynamic_sidebar( 'home_page_cards' ) ) : ?>
			<!-- Homepage Card Area -->
			<?php endif; ?>
		</div><!-- /#content -->
		<?php if ( 'enable' == $enable_header_footer_cards['value'] ) : ?>
		<div class="footer-cards">
			<?php if ( ! dynamic_sidebar( 'footer-cards' ) ) : ?>
			<!-- Footer Cards -->
			<?php endif; ?>
		</div><!-- /.footer-cards -->
		<?php endif; ?>
	</div><!-- /.container -->
<?php get_footer(); ?>