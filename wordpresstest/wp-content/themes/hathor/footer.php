<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 */
?>
<?php if( get_option( 'hathor' )){ ?>
 
 <?php get_template_part(''.$head = of_get_option('footer_select', 'footer').''); ?>
<?php }else{ ?>
 
 <?php get_template_part('dummy/dummy','footer'); ?>
        <?php } ?> 



<?php wp_footer(); ?>
</body>
</html>