<?php
/*
Template Name: Page with No sidebar
*/
?>
<?php get_header(); ?>
<div class="row">
<div class="large-12">
<div id="sub_banner">
<h1>
<?php the_title(); ?>
</h1>
</div>
<!--Content-->
<div id="content">
<div class="top-content2">

                   <?php if(have_posts()): ?><?php while(have_posts()): ?><?php the_post(); ?>
                <div <?php post_class(); ?> id="post-<?php the_ID(); ?>"> 
                
                <div class="post_content">
              
                    <div class="metainfo"><?php edit_post_link(); ?></div>
                    <div class="post_info_wrap"><?php the_content(); ?> </div> 
                    <div style="clear:both"></div>
                  
                    
                    
                
                
                
            <?php endwhile ?> 
                </div>
             <div class="space35"></div>
			<div class="comments_template"><?php comments_template('',true); ?></div>
            <?php endif ?>

    </div>
   
    <!--PAGE END-->
    
</div></div>
</div></div>
<?php get_footer(); ?>