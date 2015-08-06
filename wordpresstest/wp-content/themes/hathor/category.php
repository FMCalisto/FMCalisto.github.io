
<?php 
/**
 * The template for displaying Category pages
 * Imonthemes
 */


get_header(); ?>
<div class=" warp row ">


 <div id="sub_banner">
<h1>
<?php printf( __( ' %s', 'hathor' ), single_cat_title( '', false ) ); ?>
</h1>
</div>

<?php get_template_part(''.$hathor = of_get_option('layout1_images').''); ?>


</div>

<?php get_footer(); ?>