<?php 
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package Imonthemes
 * @subpackage hathor
 *
 */



get_header(); ?>


	<div class="row">
    
   
    
    
        <div class="large-12">
	
		<div class="error1">
			<h1 class="error2"><?php _e( '404', 'hathor' ); ?></h1>
            <h4><?php _e( 'Page not found!', 'hathor' ); ?></h4>
			 <a> <?php _e( "Can't find what you need? Take a moment and do a search below!", 'hathor' ); ?></a>
             <div id="error3">
             <?php get_search_form(); ?></div>
             
				<br /><br /><br />
              
			<a class="gray_btn" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php _e( 'Or Return home?', 'hathor' ); ?></a>
		</div>	
		
	</div>
    
    </div>

<?php get_footer(); ?>