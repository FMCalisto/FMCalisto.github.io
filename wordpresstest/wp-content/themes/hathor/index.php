<?php get_header(); ?>


 <!--Slider-->
 <?php if ( is_home() ) { ?>

<?php if( get_option( 'hathor' )){ ?>
<div class="row"> 

<div id="slider">

<?php get_template_part(''.$slides = of_get_option('slider_select', 'nivo').''); ?>

          
 	<?php }else{ ?>
 
 <?php get_template_part('dummy/dummy','nivo2'); ?>
        <?php } ?>  	
            
</div> <?php }?> 



</div>
</div></div>
<!--Slider end-->

<!--Service  Block-->
<div class="services-wrap row "> 
 
<?php if ( is_home() ) { ?>



<?php if( get_option( 'hathor' )){ ?>

  
    
<?php if(of_get_option('blocks_checkbox','hathor') == "1"){ ?>


<?php get_template_part(''.$block = of_get_option('block_select', 'service').''); ?>
<?php }?>
<?php }else{ ?>
 
 <?php get_template_part('dummy/dummy','bloks'); ?>
        <?php } ?>  
 
</div></div>		
<?php }?></div>
<!--Service Block End-->


<!--recent work-->
 
<?php if ( is_home() ) { ?>
<div class="row "> 

<div class="warp large-12 columns">

<?php if( get_option( 'hathor' )){ ?>
<?php if(of_get_option('recentwork_checkbox','hathor') == "1"){ ?>


<?php get_template_part('parts/mid','contant'); ?>

<?php }?>

<?php }else{ ?>
 
 <?php get_template_part('dummy/dummy','contant'); ?>
        <?php } ?> 

</div></div>		
<?php }?></div>




<!--recent work end-->
<!-- Start Callout section -->

<?php if ( is_home() ) { ?>

<div class="  warp row">
<div class=" large-12">
<?php if ( of_get_option('hathor_welcome') ) : ?>
<section id="callout">

            
            
            
            <?php echo apply_filters('the_content', of_get_option('hathor_welcome')); ?>
 </section>
  </div></div>         

            <?php endif; ?>
            <?php } ?> 
</div></div>

 <!-- END #callout -->

<!--LATEST POSTS-->
<?php if( get_option( 'hathor' )){ ?>
<?php if ( is_home() ) { ?>
<?php if(of_get_option('latstpst_checkbox') == "1"){ ?>
<div class="row "> 
<div class="warp columns ">
<div class="title">
<h2 class="blue1"><?php echo of_get_option('latest_blog'); ?></h2></div>
	
	<?php get_template_part(''.$os_lays = of_get_option('layout1_images','layout1').''); ?><?php } else { ?><?php } ?>
<?php } else { ?>
	<?php get_template_part(''.$os_lays = of_get_option('layout1_images', 'layout1').''); ?>
    
<?php } ?> 
<?php }else{ ?>
 
 <?php get_template_part('dummy/dummy','layout1'); ?>
        <?php } ?> 


</div>
</div>
</div></div></div>

<!--LATEST POSTS END-->

<!--Our team-->

<?php if ( is_home() ) { ?>
<div class="row "> 

<div class="warp large-12 columns">
<?php if( get_option( 'hathor' )){ ?>

<?php if(of_get_option('ourteam_checkbox','hathor') == "1"){ ?>


<?php get_template_part('parts/mid','team'); ?>


<?php }?>
<?php }else{ ?>
 
 <?php get_template_part('dummy/dummy','team'); ?>
        <?php } ?> 

</div></div>		
<?php }?></div></div>

<!--Our Team END-->

<!--Our client-->
<?php if( get_option( 'hathor' )){ ?>
<?php if(of_get_option('ourclient_checkbox','hathor') == "1"){ ?>
 <div class="row "> 

<div class=" warp columns">

<?php get_template_part('parts/our','client'); ?>


<?php }?>
<?php } else{ ?>
 
 <?php get_template_part('dummy/dummy','client'); ?>
        <?php } ?>
      </div></div>
<!--Our Client END-->




<?php get_footer(); ?>