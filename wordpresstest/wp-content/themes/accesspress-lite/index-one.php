<?php 
global $accesspresslite_options;
$accesspresslite_settings = get_option( 'accesspresslite_options', $accesspresslite_options );
$accesspresslite_layout = $accesspresslite_settings['accesspresslite_home_page_layout'];
$accesspresslite_welcome_post_id = $accesspresslite_settings['welcome_post'];
$accesspresslite_event_category = $accesspresslite_settings['event_cat'];
$featured_post1 = $accesspresslite_settings['featured_post1'];
$featured_post2 = $accesspresslite_settings['featured_post2'];
$featured_post3 = $accesspresslite_settings['featured_post3'];
$show_fontawesome_icon = $accesspresslite_settings['show_fontawesome'];
$testimonial_category = $accesspresslite_settings['testimonial_cat'];
$accesspresslite_featured_bar = $accesspresslite_settings['featured_bar'];
$accesspresslite_welcome_post_char = (isset($accesspresslite_settings['welcome_post_char']) ? $accesspresslite_settings['welcome_post_char'] : 650 );
$accesspresslite_show_event_number = (isset($accesspresslite_settings['show_event_number']) ? $accesspresslite_settings['show_event_number'] : 3 ) ;
$big_icons = $accesspresslite_settings['big_icons'];
$disable_event = $accesspresslite_settings['disable_event'];
if($disable_event == 1){
	$welcome_class = "full-width";
}else{
	$welcome_class = "";
}
if( $accesspresslite_layout !== 'Layout2') { ?>
<?php do_action('accesspresslite_call_to_action');?>			
<section id="top-section" class="ak-container">
<div id="welcome-text" class="clearfix <?php echo esc_attr($welcome_class); ?>">
	<?php
		
			if(!empty($accesspresslite_welcome_post_id)){
			$posttype = get_post_type($accesspresslite_welcome_post_id);
			$postparam = ($posttype == 'page') ? 'page_id': 'p';
			$args = array(
				'post_type' => $posttype,
				$postparam => $accesspresslite_welcome_post_id
				);
			$query1 = new WP_Query( $args );
				while ($query1->have_posts()) : $query1->the_post(); ?>
					 
					<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
					
					<?php 
					if( has_post_thumbnail() ){
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full', false ); 
					?>

					<figure class="welcome-text-image">
						<a href="<?php the_permalink(); ?>">
						<img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title(); ?>">
						</a>
					</figure>	
					<?php } ?>
					
					<div  class="welcome-detail<?php if( !has_post_thumbnail() ){ echo " welcome-detail-full-width"; } ?>">
					
					<?php if($accesspresslite_settings['welcome_post_content'] == 0 || empty($accesspresslite_settings['welcome_post_content'])){ ?>
						<p><?php echo accesspresslite_excerpt( get_the_content() , $accesspresslite_welcome_post_char ) ?></p>
						<?php if(!empty($accesspresslite_settings['welcome_post_readmore'])){?>
							<a href="<?php the_permalink(); ?>" class="read-more bttn"><?php echo esc_attr($accesspresslite_settings['welcome_post_readmore']); ?></a>
						<?php } 
					}else{ 
						the_content();
					} ?>
					
					</div>
					
				<?php endwhile;	
				wp_reset_postdata(); 
				}
				
				else{ ?>
				
				<h1><a href="#"><?php _e('General Info','accesspresslite'); ?></a></h1>
				<figure class="welcome-text-image">
				<a href="#">
					<img src="<?php echo get_template_directory_uri(); ?>/images/demo/welcome-image.jpg" alt="welcome">
				</a>
				</figure>

				<div  class="welcome-detail">
				<p><?php _e('The Intelligent Multimodal Interfaces group does research in novel user interaction paradigms and applications for Design and Manufacturing applications. We have focused our activities on Calligraphic Interfaces. These are applications organized around drawing and sketching as the main paradigms. We also work on other interaction modalities such as speech, sound and vision.','accesspresslite'); ?></p>
				<a href="#" class="readmore bttn"><?php _e('Read More','accesspresslite'); ?></a>
				</div>

			<?php } ?>
</div>

<?php if($disable_event != 1): ?>
<div id="latest-events">

			<?php
			if(is_active_sidebar('event-sidebar')) {
				dynamic_sidebar('event-sidebar');
			}else{
				if(!empty($accesspresslite_event_category)){

	            $loop = new WP_Query( array(
	                'cat' => $accesspresslite_event_category,
	                'posts_per_page' => $accesspresslite_show_event_number,
	            )); ?>

	        <h1><a href="<?php echo get_category_link($accesspresslite_event_category); ?>"><?php echo get_cat_name($accesspresslite_event_category); ?></a></h1>

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
						
						<?php 
						if($accesspresslite_settings['show_eventdate'] == 1){ ?>
							<div class="event-date">
							<span class="event-date-day"><?php echo get_the_date('j'); ?></span>
							<span class="event-date-month"><?php echo get_the_date('M'); ?></span>
							</div>
						<?php
						}?>
						</a>
					</figure>	

					<div class="event-detail">
		        		<h4 class="event-title">
		        			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		        		</h4>

		        		<div class="event-excerpt">
		        			<?php echo accesspresslite_excerpt( get_the_content() , 100 ) ?>
		        		</div>
	        		</div>
	        	</div>
	        <?php endwhile; ?>
	        <?php wp_reset_postdata(); 

	        } else { ?>
	        
	        <h1>News Feed</h1>
		        <?php for ( $event_count=1 ; $event_count < 4 ; $event_count++ ) { ?>
		        <div class="event-list clearfix">
						<figure class="event-thumbnail">
							<a href="#"><img src="<?php echo get_template_directory_uri().'/images/demo/event-'.$event_count.'.jpg'; ?>" alt="<?php echo 'event'.$event_count; ?>">
							<div class="event-date">
								<span class="event-date-day"><?php echo $event_count; ?></span>
								<span class="event-date-month"><?php _e('Mar','accesspresslite'); ?></span>
							</div>
							</a>
						</figure>	

						<div class="event-detail">
			        		<h4 class="event-title">
			        			<a href="#"><?php _e('Title of the event-','accesspresslite'); ?><?php echo $event_count; ?></a>
			        		</h4>

			        		<div class="event-excerpt">
			        			<?php _e('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor...','accesspresslite'); ?>
			        		</div>
		        		</div>
		        	</div>
		        <?php } 
	        	}
	        } ?>
</div>
<?php endif; ?>
</section>

<section id="mid-section" class="ak-container">
<?php 
if(!empty($featured_post1) || !empty($featured_post2) || !empty($featured_post3)){
    if(!empty($featured_post1)) { ?>
		<div id="featured-post-1" class="featured-post<?php if($big_icons == 1){ echo ' big-icon'; } ?>">
			
			<?php
				$posttype = get_post_type($featured_post1);
				$postparam = ($posttype == 'page') ? 'page_id': 'p';
				$args = array(
					'post_type' => $posttype,
					$postparam => $featured_post1
				);
				$query2 = new WP_Query( $args );
				// the Loop
				while ($query2->have_posts()) : $query2->the_post(); 
					
					if( $show_fontawesome_icon == 0 ){
					?>
					<figure class="featured-image">
						<a href="<?php the_permalink(); ?>">
                        <div class="featured-overlay">
                			<span class="overlay-plus font-icon-plus"></span>
                		</div>
							<?php 							
							if( has_post_thumbnail()){
							$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'featured-thumbnail', false ); 
							?>
							<img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title(); ?>">
							<?php }else { ?>
							<img src="<?php echo get_template_directory_uri(); ?>/images/demo/featured-fallback.jpg" alt="<?php the_title(); ?>">
							<?php } 
							?>
						</a>
					</figure>
					<?php } ?>	

					<h2 class="<?php if($show_fontawesome_icon == 1){ echo 'has-icon'; }?>">
					<a href="<?php the_permalink(); ?>">
					<?php 
					if($show_fontawesome_icon == 1){ ?>

					<i class="fa <?php echo esc_attr($accesspresslite_settings['featured_post1_icon']) ?>"></i>
							
					<?php } ?>
					<span><?php the_title(); ?></span>
					</a>
					</h2>

					<div class="featured-content">
						<p><?php echo accesspresslite_excerpt( get_the_content() , 260 ) ?></p>
						<?php if(!empty($accesspresslite_settings['featured_post_readmore'])){?>
						<a href="<?php the_permalink(); ?>" class="read-more bttn"><?php echo esc_attr($accesspresslite_settings['featured_post_readmore']); ?></a>
						<?php } ?>
					</div>
				<?php endwhile;
				wp_reset_postdata(); ?>
		
		</div>
	<?php }

	if(!empty($featured_post2)) { ?>
		<div id="featured-post-2" class="featured-post<?php if($big_icons == 1){ echo ' big-icon'; } ?>">
			
			<?php
				$posttype = get_post_type($featured_post2);
				$postparam = ($posttype == 'page') ? 'page_id': 'p';
				$args = array(
					'post_type' => $posttype,
					$postparam => $featured_post2
				);
				$query3 = new WP_Query( $args );
				// the Loop
				while ($query3->have_posts()) : $query3->the_post();
					
					if( $show_fontawesome_icon == 0 ){
					?>
					<figure class="featured-image">
						<a href="<?php the_permalink(); ?>">
                        <div class="featured-overlay">
                			<span class="overlay-plus font-icon-plus"></span>
                		</div>
							<?php 							
							if( has_post_thumbnail()){
							$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'featured-thumbnail', false ); 
							?>
							<img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title(); ?>">
							<?php }else { ?>
							<img src="<?php echo get_template_directory_uri(); ?>/images/demo/featured-fallback.jpg" alt="<?php the_title(); ?>">
							<?php } 
							?>
						</a>
					</figure>
					<?php } ?>	

					<h2 class="<?php if($show_fontawesome_icon == 1){ echo 'has-icon'; }?>">
					<a href="<?php the_permalink(); ?>">
					<?php 
					if($show_fontawesome_icon == 1){ ?>

					<i class="fa <?php echo esc_attr($accesspresslite_settings['featured_post2_icon']) ?>"></i>
							
					<?php } ?>
					<span><?php the_title(); ?></span>
					</a>
					</h2>

					<div class="featured-content">
						<p><?php echo accesspresslite_excerpt( get_the_content() , 260 ) ?></p>
						<?php if(!empty($accesspresslite_settings['featured_post_readmore'])){?>
						<a href="<?php the_permalink(); ?>" class="read-more bttn"><?php echo esc_attr($accesspresslite_settings['featured_post_readmore']); ?></a>
						<?php } ?>
					</div>
				<?php endwhile;
				wp_reset_postdata(); ?>
		
		</div>
	<?php } 

	if(!empty($featured_post3)) { ?>
		<div id="featured-post-3" class="featured-post<?php if($big_icons == 1){ echo ' big-icon'; } ?>">
			<?php
				$posttype = get_post_type($featured_post3);
				$postparam = ($posttype == 'page') ? 'page_id': 'p';
				$args = array(
					'post_type' => $posttype,
					$postparam => $featured_post3
				);
				$query4 = new WP_Query( $args );
				// the Loop
				while ($query4->have_posts()) : $query4->the_post(); 
					if( $show_fontawesome_icon == 0 ){
					?>
					<figure class="featured-image">
						<a href="<?php the_permalink(); ?>">
                        <div class="featured-overlay">
                			<span class="overlay-plus font-icon-plus"></span>
                		</div>
							<?php 							
							if( has_post_thumbnail()){
							$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'featured-thumbnail', false ); 
							?>
							<img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title(); ?>">
							<?php }else { ?>
							<img src="<?php echo get_template_directory_uri(); ?>/images/demo/featured-fallback.jpg" alt="<?php the_title(); ?>">
							<?php } 
							?>
						</a>
					</figure>
					<?php } ?>	

					<h2 class="<?php if($show_fontawesome_icon == 1){ echo 'has-icon'; }?>">
					<a href="<?php the_permalink(); ?>">
					<?php 
					if($show_fontawesome_icon == 1){ ?>

					<i class="fa <?php echo esc_attr($accesspresslite_settings['featured_post3_icon']) ?>"></i>
							
					<?php } ?>
					<span><?php the_title(); ?></span>
					</a>
					</h2>

					<div class="featured-content">
						<p><?php echo accesspresslite_excerpt( get_the_content() , 260 ) ?></p>
						<?php if(!empty($accesspresslite_settings['featured_post_readmore'])){?>
						<a href="<?php the_permalink(); ?>" class="read-more bttn"><?php echo esc_attr($accesspresslite_settings['featured_post_readmore']); ?></a>
						<?php } ?>
					</div>
				<?php endwhile;
				wp_reset_postdata(); ?>
		
		</div>
	<?php } 
	
	}else{ ?>
	
	<?php for($featured_post=1 ; $featured_post < 4; $featured_post++){ ?>
	<div id="featured-post-<?php echo $featured_post; ?>" class="featured-post">

		<figure class="featured-image">
		<a href="#">
		<div class="featured-overlay">
			<span class="overlay-plus font-icon-plus"></span>
		</div>

		<img src="<?php echo get_template_directory_uri().'/images/demo/featuredimage-'.$featured_post.'.jpg' ?>" alt="<?php echo 'featuredpost'.$featured_post; ?>">
		</a>
		</figure>

		<h2><a href="#"><?php _e('Featured Post','accesspresslite'); ?> <?php echo $featured_post; ?></a></h2>

		<div class="featured-content">
			<p><?php _e('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate...','accesspresslite'); ?></p>
			<a href="#" class="read-more bttn"><?php _e('Read More','accesspresslite'); ?></a>
		</div>
	</div>

	<?php }
	} ?>
</section>
<?php } 
?>

<?php if( $accesspresslite_layout !== 'Default' || empty($accesspresslite_layout) ){?>
<section id="ak-blog">
	<section class="ak-container" id="ak-blog-post">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php 
			while ( have_posts() ) : the_post(); 
			get_template_part( 'content' );
			endwhile;
			?>

			<?php accesspresslite_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>
		<?php wp_reset_query();
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
	
	<div id="secondary-right" class="widget-area right-sidebar sidebar">
		<?php if ( is_active_sidebar( 'blog-sidebar' ) ) : ?>
			<?php dynamic_sidebar( 'blog-sidebar' ); ?>
		<?php endif; ?>
	</div>
	</section>
</section>

<?php }
wp_reset_query(); ?>

<?php if($accesspresslite_featured_bar != 1) :?>
<section id="bottom-section">
	<div class="ak-container">
        <div class="text-box">
		<?php if ( is_active_sidebar( 'textblock-1' ) ) : ?>
		  <?php dynamic_sidebar( 'textblock-1' ); 
        
        else:  
        ?>
        <aside id="text-3" class="widget widget_text">
            <h3 class="widget-title"><?php _e('Strategy','accesspresslite'); ?></h3>
            <div class="textwidget">
                <ul>
                <li><?php _e('Multimodal Interfaces','accesspresslite'); ?></li>
                <li><?php _e('Visualization and Simulation','accesspresslite'); ?></li>
                <li><?php _e('Multimedia Information Retrieval and Visualization','accesspresslite'); ?></li>
                <li><?php _e('Personal Information Management','accesspresslite'); ?></li>
                <li><?php _e('Accessibility and Mobile Computing','accesspresslite'); ?></li>
                </ul>
            </div>
        </aside>
		<?php endif; ?>	
		</div>
        
        <div class="thumbnail-gallery clearfix">
        <?php 
        $gallery_code = $accesspresslite_settings['gallery_code'];
        if ( is_active_sidebar( 'textblock-2' ) ) : ?>
		  <?php dynamic_sidebar( 'textblock-2' ); ?>
		<?php elseif(!empty($gallery_code)): ?>	
		<h3><?php _e('Gallery','accesspresslite')?></h3>
        <?php 
        echo do_shortcode($gallery_code );
        else: ?>
        <h3>Gallery</h3>
        <div class="gallery">
            <dl class="gallery-item">
            <dt class="gallery-icon landscape">
            <a class="fancybox-gallery" href="<?php echo get_template_directory_uri();?>/images/demo/img1.jpg">
            <img class="attachment-thumbnail" width="150" height="150" alt="img1" src="<?php echo get_template_directory_uri();?>/images/demo/img1-thumb.jpg">
            </a>
            </dt>
            </dl>
            <dl class="gallery-item">
            <dt class="gallery-icon landscape">
            <a class="fancybox-gallery" href="<?php echo get_template_directory_uri();?>/images/demo/img2.jpg">
            <img class="attachment-thumbnail" width="150" height="150" alt="img2" src="<?php echo get_template_directory_uri();?>/images/demo/img2-thumb.jpg">
            </a>
            </dt>
            </dl>
            <br style="clearfix: both">
            <dl class="gallery-item">
            <dt class="gallery-icon landscape">
            <a class="fancybox-gallery" href="<?php echo get_template_directory_uri();?>/images/demo/img3.jpg">
            <img class="attachment-thumbnail" width="150" height="150" alt="img3" src="<?php echo get_template_directory_uri();?>/images/demo/img3-thumb.jpg">
            </a>
            </dt>
            </dl>
            <dl class="gallery-item">
            <dt class="gallery-icon landscape">
            <a class="fancybox-gallery" href="<?php echo get_template_directory_uri();?>/images/demo/img4.jpg">
            <img class="attachment-thumbnail" width="150" height="150" alt="img4" src="<?php echo get_template_directory_uri();?>/images/demo/img4-thumb.jpg">
            </a>
            </dt>
            </dl>
            <dl class="gallery-item">
            <dt class="gallery-icon landscape">
            <a class="fancybox-gallery" href="<?php echo get_template_directory_uri();?>/images/demo/img5.jpg">
            <img class="attachment-thumbnail" width="150" height="150" alt="img5" src="<?php echo get_template_directory_uri();?>/images/demo/img5-thumb.jpg">
            </a>
            </dt>
            </dl>
            <dl class="gallery-item">
            <dt class="gallery-icon landscape">
            <a class="fancybox-gallery" href="<?php echo get_template_directory_uri();?>/images/demo/img6.jpg">
            <img class="attachment-thumbnail" width="150" height="150" alt="img6" src="<?php echo get_template_directory_uri();?>/images/demo/img6-thumb.jpg">
            </a>
            </dt>
            </dl>
        </div>
        <?php endif; ?>	
		</div>        
        
		<div class="testimonial-slider-wrap">
		<?php 
		if ( is_active_sidebar( 'textblock-3' ) ) {
		  dynamic_sidebar( 'textblock-3' );
		}else{

		if(!empty($testimonial_category)) {	?>
 		<h3><?php echo get_cat_name($testimonial_category); ?></h3>
			<?php
				$loop2 = new WP_Query( array(
	                'cat' => $testimonial_category,
	                'posts_per_page' => 5,
	            )); ?>
	        <div class="testimonial-wrap">
		        <div class="testimonial-slider">
		        <?php while ($loop2->have_posts()) : $loop2->the_post(); ?>

		        	<div class="testimonial-slide">
			        	<div class="testimonial-list clearfix">
			        		<div class="testimonial-thumbnail">
			        		<?php 
                            if(has_post_thumbnail()){
                            the_post_thumbnail('thumbnail'); 
                            }else{ ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/images/testimonial-dummy.jpg" alt="no-image"/>
                            <?php }?>
			        		</div>

			        		<div class="testimonial-excerpt">
			        			<?php echo accesspresslite_excerpt( get_the_content() , 140 ) ?>
			        		</div>
			        	</div>
					<div class="testimoinal-client-name"><?php the_title(); ?></div>
					</div>
                <?php endwhile; ?>
				</div>
			</div>
			<a class="all-testimonial" href="<?php echo get_category_link( $testimonial_category ) ?>"><?php echo esc_html($accesspresslite_settings['view_all_text']); ?> <?php echo get_cat_name($testimonial_category); ?></a>
	        
	        
	        <?php wp_reset_postdata(); 
			}else{ 
			?>
			<h3 class="widget-title"><?php _e('Testimonials','accesspresslite'); ?></h3>
			<div class="testimonial-wrap">
				<div class="testimonial-slider">
					<div class="testimonial-slide">
			        	<div class="testimonial-list clearfix">
			        		<div class="testimonial-thumbnail">
			        		<img src="<?php echo get_template_directory_uri(); ?>/images/demo/Yanetxys-Torreblanca.jpg">
			        		</div>

			        		<div class="testimonial-excerpt"><?php _e('Thanks for delivering top quality services to your clients. It just takes a minute to get an answer from you when in difficulties.','accesspresslite'); ?></div>
			        	</div>
						<div class="testimoinal-client-name"><?php _e('Yanetxys Torreblanca','accesspresslite'); ?></div>
					</div>

					<div class="testimonial-slide">
			        	<div class="testimonial-list clearfix">
			        		<div class="testimonial-thumbnail">
			        		<img src="<?php echo get_template_directory_uri(); ?>/images/demo/David-Soriano.jpg">
			        		</div>

			        		<div class="testimonial-excerpt"><?php _e('Thank you very much the support team AccessPress lite for service, are really wonderful in their care and in the resolution of the problem.','accesspresslite'); ?></div>
			        	</div>
						<div class="testimoinal-client-name"><?php _e('David Soriano','accesspresslite'); ?></div>
					</div>

					<div class="testimonial-slide">
			        	<div class="testimonial-list clearfix">
			        		<div class="testimonial-thumbnail">
			        		<img src="<?php echo get_template_directory_uri(); ?>/images/demo/Jotta-Lima.jpg">
			        		</div>

			        		<div class="testimonial-excerpt"><?php _e('Hello, I would say I am much satisfied! I tested installing the theme AccessPress Lite on my blog and found it very good.','accesspresslite'); ?></div>
			        	</div>
						<div class="testimoinal-client-name"><?php _e('Jotta Lima','accesspresslite'); ?></div>
					</div>
				</div>
			</div>
				<a class="all-testimonial" href="#"><?php _e('View All Testimonials','accesspresslite'); ?></a>
			<?php } 
			}?>
		</div>
	</div>
</section>
<?php endif; ?>