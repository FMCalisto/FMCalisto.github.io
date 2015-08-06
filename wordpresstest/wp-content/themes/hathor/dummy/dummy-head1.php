
<div id="branding">
 <div class="row"> 
 <div class="large-12 columns">
 
 

    	<!--LOGO START-->
        <div id="site-title">
        <?php if (of_get_option('isis_logo_image')) : ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-img"><img src="<?php echo of_get_option('isis_logo_image'); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
                    <?php else : ?>
                    
       <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo('description'); ?>" rel="home"><?php bloginfo('name'); ?></a><?php endif; ?>	
       
        
        </div>
        
       
       
     
       
        
     
        <!--LOGO END-->
        
        <!--MENU STARTS-->
       
         
       
      
        <div id="menu_wrap"><div id="navmenu"><?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>   </div>
        
        </div>
         
    
       
   </div>
        
      </div>
      
      
</div>
             <!--MENU END-->
