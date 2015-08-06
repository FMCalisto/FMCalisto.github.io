<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package AccesspressLite
 */

get_header(); ?>
<div class="ak-container">
		<main id="main" class="site-main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'accesspresslite' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location.', 'accesspresslite' ); ?></p>
				</div><!-- .page-content -->
                
                <div class="number404">
                <?php _e('404' , 'accesspresslite' ); ?> 
                <span><?php _e('error' , 'accesspresslite' ); ?></span>   
                </div>
			</section><!-- .error-404 -->

		</main><!-- #main -->
</div>
<?php get_footer(); ?>