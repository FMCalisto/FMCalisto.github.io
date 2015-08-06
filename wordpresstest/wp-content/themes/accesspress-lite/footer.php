<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package AccesspressLite
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
	<?php 
		global $accesspresslite_options;
		$accesspresslite_settings = get_option( 'accesspresslite_options', $accesspresslite_options );

		if ( is_active_sidebar( 'footer-1' ) ||  is_active_sidebar( 'footer-2' )  || is_active_sidebar( 'footer-3' )  || is_active_sidebar( 'footer-4' ) ) : ?>
		<div id="top-footer">
		<div class="ak-container">
			<div class="footer1 footer">
				<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
					<?php dynamic_sidebar( 'footer-1' ); ?>
				<?php endif; ?>	
			</div>

			<div class="footer2 footer">
				<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
					<?php dynamic_sidebar( 'footer-2' ); ?>
				<?php endif; ?>	
			</div>

			<div class="clearfix hide"></div>

			<div class="footer3 footer">
				<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
					<?php dynamic_sidebar( 'footer-3' ); ?>
				<?php endif; ?>	
			</div>

			<div class="footer4 footer">
				<?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
					<?php dynamic_sidebar( 'footer-4' ); ?>
				<?php endif; ?>	
			</div>
		</div>
		</div>
	<?php endif; ?>

		
		<div id="bottom-footer">
		<div class="ak-container">
			<h1 class="site-info">
				<span class="sep"> Developed by </span>
				<a href="<?php echo esc_url('http://franciscocalisto.me/');?>" title="FMCalisto" target="_blank">Francisco Maria Calisto</a>
			</h1><!-- .site-info -->

			<div class="copyright">
				Copyright &copy; <?php echo date('Y') ?>
				<a href="<?php echo home_url(); ?>">
				<?php if(!empty($accesspresslite_settings['footer_copyright'])){
					echo $accesspresslite_settings['footer_copyright'];
					}else{
						echo bloginfo('name');
					} ?>
				</a>
				, Theme by
				<a href="<?php echo esc_url('http://accesspressthemes.com/');?>" title="APL" target="_blank">AccessPress Lite</a>
			</div>
		</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>