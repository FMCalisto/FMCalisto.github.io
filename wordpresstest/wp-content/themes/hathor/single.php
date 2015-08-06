
<?php get_header(); ?>
<div class="row">
   


<div id="content" >
<div class="top-content">
<!--Content-->
   <?php if(have_posts()): ?><?php while(have_posts()): ?><?php the_post(); ?>
                <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">  </div>
               
<div id="content" class="content_blog blog_style_b1" role="main">
			
					<article class="post_format_standard odd">
						<div class="post_info_1">
							<?php edit_post_link(); ?>
							<div class="post_date"> <a href="<?php the_permalink();?>" > <span class="day"><?php the_time( ('j') ); ?></span><span class="month"><?php the_time( ('M') ); ?></span></a></div>
                            
					        
			        	</div>
                        
						<div class="title_area">
							<h1 class="post_title"><a href="<?php the_permalink();?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
						</div>
                          <?php if(of_get_option('dissauth_checkbox') == "0"){ ?>
						<div class="post_info post_info_2">
                      
							<span class="post_author">Posted by: <a class="post_author"><?php the_author(); ?></a></span><?php } ?>
							<span class="post_info_delimiter"></span>
                            <?php if(of_get_option('disscats_checkbox') == "0"){ ?>
                           <?php if( has_category() ) { ?>
							<span class="post_categories">
								<span class="cats_label">Categories:</span>
								<a class="cat_link"><?php the_category(' '); ?></a>
							
							</span>
							
							<?php } ?>
                          <div class="post_comments"><a><span class="comments_number"> <?php comments_popup_link( __( 'No comments', 'hathor' ), __( '1 Comment', 'hathor' ), __( '% Comments', 'hathor' )); ?> </span><span class="icon-comment"></span></a></div>  
                            
						</div>
                        <?php } ?>
                        <?php if(of_get_option('thumb_checkbox') == "0"){ ?>
						<div class="pic_wrapper image_wrapper">
							<?php the_post_thumbnail('large'); ?>
						</div>
                        <?php } ?>
						<div class="post_content">
							<p><?php the_content(); ?></p>
						 <div class="post_wrap_n"><?php wp_link_pages('<p class="pages"><strong>'.__('Pages:').'</strong> ', '</p>', 'number'); ?></div>	
						</div>
						<div class="post_info post_info_3 clearboth">
                        <?php if(of_get_option('disscats_checkbox') == "0"){ ?>
							<span class="post_tags">
								<?php if( has_tag() ) { ?><span class="tags_label">Tags:</span><?php } ?>
								<?php if( has_tag() ) { ?><a class="tag_link"><?php the_tags('','  '); ?></a>
								
							</span><?php } ?><?php } ?>
						</div>
					</article>
                 <div class="wp-pagenavi">
                    <?php previous_post_link( '<div class="alignleft">%link</div>', '&laquo; %title' ); ?>
                    <?php next_post_link( '<div class="alignright">%link</div>', '%title &raquo; ' ); ?>
                </div> 
<div class="share">
					<?php get_template_part('share_this');?></div>
                    <div class="sep-20"><img  src="<?php echo get_template_directory_uri(); ?>/images/sep-shadow.png" /></div>			
                    </div>
  <?php endwhile ?>
    
    <!--POST END--> 
    <a class="comments_template"><?php comments_template('',true); ?></a>
            <?php endif ?></div>
   
    
<?php if(of_get_option('nosidebar_checkbox') == "0"){ ?><?php get_sidebar();?><?php } ?>
</div> 
</div>
</div>
</div>
<?php get_footer(); ?>