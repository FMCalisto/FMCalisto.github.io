<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package AccesspressLite
 */
?>

<?php 
global $post, $accesspresslite_options;
$accesspresslite_settings = get_option( 'accesspresslite_options', $accesspresslite_options );
$event_category = $accesspresslite_settings['event_cat'];
$show_events = $accesspresslite_settings['leftsidebar_show_latest_events'];
$testimonial_category = $accesspresslite_settings['testimonial_cat'];
$show_testimonials = $accesspresslite_settings['leftsidebar_show_testimonials'];
$post_class = "";

if(!empty($post)){
	if(is_front_page()){
		$post_id = get_option('page_on_front');
	}else{
		$post_id = $post->ID;
	}
	$post_class = get_post_meta( $post_id, 'accesspresslite_sidebar_layout', true );
}

if($post_class=='left-sidebar' || $post_class=='both-sidebar' ){
?>
	<div id="secondary-left" class="widget-area left-sidebar sidebar">
			<?php
			if($show_events==1) {
				if(!empty($event_category)){
				$loop = new WP_Query( array(
	                'cat' => $event_category,
	                'posts_per_page' => 3,
	            )); ?>
	        <aside id="latest-events" class="clearfix">
	        <h3 class="widget-title"><?php echo get_cat_name(esc_attr($event_category)); ?></h3>

	        <?php while ($loop->have_posts()) : $loop->the_post(); ?>

	        	<div class="event-list clearfix">
	        		
	        		<figure class="event-thumbnail">
						<a href="<?php the_permalink(); ?>">
						<?php 
						if( has_post_thumbnail() ){
						$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'event-thumbnail', false ); 
						?>
						<img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title(); ?>">
						<?php } else { ?>
						<img src="<?php echo get_template_directory_uri(); ?>/images/demo/event-fallback.jpg" alt="<?php the_title(); ?>">
						<?php } ?>
						
						<div class="event-date">
							<span class="event-date-day"><?php echo get_the_date('j'); ?></span>
							<span class="event-date-month"><?php echo get_the_date('M'); ?></span>
						</div>
						</a>
					</figure>	

					<div class="event-detail">
		        		<h4 class="event-title">
		        			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		        		</h4>

		        		<div class="event-excerpt">
		        			<?php echo accesspresslite_excerpt( get_the_content() , 50 ) ?>
		        		</div>
	        		</div>
	        	</div>
	        <?php endwhile; ?>
	        <?php if(!empty($accesspresslite_settings['view_all_text'])){ ?>
	        <a class="all-events" href="<?php echo get_category_link( esc_attr($event_category) ) ?>"><?php echo esc_html($accesspresslite_settings['view_all_text']); ?></a>
	        <?php } ?>
	        <?php wp_reset_postdata(); ?>
	        </aside>
	        <?php
	        } else { ?>
	        <aside id="latest-events" class="clearfix">
	        <h3 class="widget-title">Latest Events/News</h3>
		        <?php for ( $event_count=1 ; $event_count < 4 ; $event_count++ ) { ?>
		        <div class="event-list clearfix">
						<figure class="event-thumbnail">
							<a href="#"><img src="<?php echo get_template_directory_uri().'/images/demo/event-'.$event_count.'.jpg'; ?>" alt="<?php echo 'event'.$event_count; ?>">
							<div class="event-date">
								<span class="event-date-day"><?php echo $event_count; ?></span>
								<span class="event-date-month"><?php echo "Mar"; ?></span>
							</div>
							</a>
						</figure>	

						<div class="event-detail">
			        		<h4 class="event-title">
			        			<a href="#">Title of the event-<?php echo $event_count; ?></a>
			        		</h4>

			        		<div class="event-excerpt">
			        			Lorem Ipsum is simply dummy text of the printing and..
			        		</div>
		        		</div>
		        	</div>
		        <?php } ?>
		        <a class="all-events" href="#">View All Events</a>
		        </aside>
	        <?php } 
	        }?>


        <?php wp_reset_query(); ?>
        
	    <?php if($show_testimonials == 1){ ?>
		<aside class="widget testimonial-sidebar clearfix">
 		<?php
			
			if(!empty($testimonial_category)) { ?>
			<h3 class="widget-title"><?php echo get_cat_name(esc_attr($testimonial_category)); ?></h3>
			<?php
	            $loop = new WP_Query( array(
	                'cat' => $testimonial_category,
	                'posts_per_page' => 3,
	            )); ?>
	        <div class="testimonial-wrap">
		        <?php while ($loop->have_posts()) : $loop->the_post(); ?>

			        <div class="testimonial-list">
			        	<div class="testimonial-thumbnail">
			        		<?php 
                            if(has_post_thumbnail()){
                            the_post_thumbnail('thumbnail'); 
                            }else{ ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/images/testimonial-dummy.jpg" alt="no-image"/>
                            <?php }?>
		        		</div>

			        	<div class="testimonial-excerpt">
			        		<?php echo accesspresslite_excerpt( get_the_content() , 90 ) ?>
			        	</div>
			        	<div class="clearfix"></div>
					<div class="testimoinal-client-name"><?php the_title(); ?></div>
					</div>
			<?php endwhile; ?>
	        </div>
	        <?php if(!empty($accesspresslite_settings['view_all_text'])){ ?>
            <a class="all-testimonial" href="<?php echo get_category_link( esc_attr($testimonial_category) ) ?>"><?php echo esc_attr($accesspresslite_settings['view_all_text']); ?></a>
            <?php } ?>
	        
	        <?php wp_reset_postdata(); 
			}else{ 
			$client_name=array("","Linda Lee","George Bailey","Micheal Warner");
			?>
			<div class="testimonial-wrap">
			<h3 class="widget-title">Testimonial</h3>
				<?php for ($testimonial_count=1 ; $testimonial_count < 4 ; $testimonial_count++) { ?>
			        	<div class="testimonial-list clearfix">
			        		<div class="testimonial-thumbnail">
			        		<img src="<?php echo get_template_directory_uri().'/images/demo/testimonial-image'.$testimonial_count.'.jpg' ?>" alt="<?php echo $client_name[$testimonial_count]; ?>">
			        		</div>

			        		<div class="testimonial-excerpt">
			        			Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer..
			        		</div>
			        		<div class="clearfix"></div>
			        	<div class="testimoinal-client-name"><?php echo $client_name[$testimonial_count]; ?></div>
			        	</div>
						
				<?php } ?>
				</div>
			<a class="all-testimonial" href="#">View All Testimonials</a>
			<?php } ?>
			</aside>
			<?php } ?>
		

		<?php if ( is_active_sidebar( 'left-sidebar' ) ) : ?>
			<?php dynamic_sidebar( 'left-sidebar' ); ?>
		<?php endif; ?>
	</div><!-- #secondary -->
<?php } ?>