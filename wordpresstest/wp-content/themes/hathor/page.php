<?php get_header(); ?>
<div class="row">


<!--Content-->
 <div id="sub_banner">
<h1>
<?php the_title(); ?>
</h1>
</div>
<div id="content">
<div class="top-content">

                   <?php if(have_posts()): ?><?php while(have_posts()): ?><?php the_post(); ?>
                <div <?php post_class(); ?> id="post-<?php the_ID(); ?>"> 
                
                <div class="post_content">
                   
                    <a class="postimg"><?php the_post_thumbnail('medium'); ?></a>
                   
                   
                   <div class="metadate"> <?php edit_post_link(); ?></div> 
                    </div>
                    <div style="clear:both"></div>	
                    <div class="post_info_wrap"><?php the_content(); ?> </div>
                    <div style="clear:both"></div>	
                    
            <div class="post_wrap_n">         
                   
                   
</div>

                
                        
            <?php endwhile ?> 
            
                </div>   
				<div class="comments_template"><?php comments_template('',true); ?></div>
            <?php endif ?>


</div>

    
    <!--POST END--> 
   
    
<?php if(of_get_option('nosidebar_checkbox') == "0"){ ?><?php get_sidebar();?><?php } ?>
</div>
</div>
</div>

<?php get_footer(); ?>