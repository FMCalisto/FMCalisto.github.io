<?php	

/**
 * Hathor functions and definitions
 *
 * For more information on hooks, actions, and filters, @link http://codex.wordpress.org/Plugin_API
 */

/*
 * Set up the content width value based on the theme's design.
 *
 */

if ( ! isset( $content_width ) )
	$content_width = 630;



//Load Other CSS files

function hathor_other_css() { 
if ( !is_admin() ) {	
wp_enqueue_style( 'hathor_other', get_template_directory_uri() . '/css/foundation.css' );
wp_enqueue_style( 'hathor_other', get_template_directory_uri() . '/css/nivo-slider.css' );



}  }
add_action('wp_enqueue_scripts', 'hathor_other_css');	

function hathor_other1_css() { 
if ( !is_admin() ) {	
wp_enqueue_style( 'hathor_other1', get_template_directory_uri() . '/css/nivo-slider.css' );



}  }
add_action('wp_enqueue_scripts', 'hathor_other1_css');	

function hathor_other2_css() { 
if ( !is_admin() ) {	
wp_enqueue_style( 'hathor_other2', get_template_directory_uri() . '/fonts/awesome/css/font-awesome.min.css' );


}  }
add_action('wp_enqueue_scripts', 'hathor_other2_css');	



 
 



function hathor_fonts_css() { 
if ( !is_admin(
) ) {
{ ?>
<?php wp_enqueue_style('customfont',get_template_directory_uri().'/fonts/'.$os_fonts = of_get_option('font_select', 'raleway' ).'.css'); }
	}
}
add_action('wp_enqueue_scripts', 'hathor_fonts_css');	

//Load Custom CSS
function hathor_customstyle() { ?>
<?php if(of_get_option('sldrtxt_checkbox') == "0"){ ?>
<style type="text/css">
body .nivo-caption {
	display: none!important;
}
</style>
<?php } ?>


<?php if(of_get_option('sldrtitle_checkbox') == "0"){ ?>
<style type="text/css">
.nivo-caption h3 {
	display: none!important;
}
</style>
<?php } ?>

<?php if(of_get_option('sldrdes_checkbox') == "0"){ ?>
<style type="text/css">
.nivo-caption p {
	display: none!important;
}
</style>
<?php } ?>


<style type="text/css">
/*Secondary Elements Color*/



.postitle, .postitle a,.postitle2 a, .widgettitle,.widget-title, .entry-title a, .widgettitle2, #reply-title, #comments span, .catag_list a, .lay2 h2, .nivo-caption a, .nivo-caption,.entry-title,.content_blog .post_title a,.title h2.blue1,.title h2.green1 ,.postitle_lay a,#wp-calendar tr td a,.vcard a,.post_content a:link,.post_content p a,.comments_template,.post_info_wrap a{
color:<?php echo of_get_option('flavour_colorpicker');
?>!important;

}

.midrow_block,.style2.icon_img,.icon_img {border-color:<?php echo of_get_option('flavour_colorpicker');
?>!important;}

 .midbutton,.nivo-controlNav a.active,#sub_banner,#wp-calendar #today,#searchsubmit,#content .more-link,#submit,.nivo-caption h3,.post_info_1 .post_date,#navmenu ul > li::after,.scrollup,.midbutton2{
background-color:<?php echo of_get_option('flavour_colorpicker');
?>!important;
}

.view a.info:hover,#navmenu ul > li ul li:hover,#submit:hover,.midbutton:hover,#searchsubmit:hover ,.midbutton2:hover {
background-color:<?php echo of_get_option('hover_colorpicker');
?>!important; background:<?php echo of_get_option('hover_colorpicker');?>!important;

}
.ch-info a:hover,.widget_tag_cloud a:hover,.post_info a:hover,.post_views a:hover,
.post_comments a:hover,.wp-pagenavi:hover, .alignleft a:hover, .wp-pagenavi:hover ,.alignright a:hover,.comment-form a:hover,.port a:hover,.previous a:hover, .next a:hover,.our_team p.port_team a:hover{
color:<?php echo of_get_option('hover_colorpicker');
?>!important;}

</style>
<?php }

add_action( 'wp_head', 'hathor_customstyle' );



//Load Java Scripts to header
function hathor_head_js() { 
if ( !is_admin() ) {
wp_enqueue_script('jquery');
wp_enqueue_script('hathor_js',get_template_directory_uri().'/other2.js');
wp_enqueue_script('hathor_other',get_template_directory_uri().'/js/other.js');



if(of_get_option('slider_select') == "nivo"){ wp_enqueue_script('hathor_nivo',get_template_directory_uri().'/js/jquery.nivo.js');}
if(of_get_option('disslight_checkbox') == "0")
if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
}
}
add_action('wp_enqueue_scripts', 'hathor_head_js');

//Load Java Scripts to Footer
add_action('wp_footer', 'hathor_load_js');

function hathor_load_js() { ?>



<?php if(of_get_option('slider_select') == "nivo"){ ?>

<script type="text/javascript">
    jQuery(window).load(function() {
		// nivoslider init
		jQuery('#nivo') .nivoSlider({
				effect: 'random',
				animSpeed:700,
				pauseTime:<?php echo of_get_option('sliderspeed_text'); ?>,
				startSlide:0,
				slices:10,
				directionNav:true,
				directionNavHide:true,
				controlNav:true,
				controlNavThumbs:false,
				keyboardNav:true,
				pauseOnHover:true,
				captionOpacity:0.8,
				afterLoad: function(){
						if (jQuery(window).width() < 480) {
					jQuery(".nivo-caption ").animate({"opacity": "1", "right":"0"}, {easing:"easeOutBack", duration: 500});
					
						}else{
					jQuery(".nivo-caption").animate({"opacity": "1", "bottom":"15%"}, {easing:"easeOutBack", duration: 500});	
					jQuery(".nivo-caption ").has('.sld_layout3').addClass('sld3wrap');
							}
				},
				beforeChange: function(){
					jQuery(".nivo-caption ").animate({bottom:"-500px"}, {easing:"easeInBack", duration: 500});
					//jQuery(".nivo-caption").delay(400).removeClass('sld3wrap');
					jQuery('.nivo-caption ').animate({"opacity": "0"}, 100);
					jQuery('.nivo-caption ').delay(500).queue(function(next){
						jQuery(this).removeClass("sld3wrap");next();});

				},
				afterChange: function(){
						if (jQuery(window).width() < 480) {
					jQuery(".nivo-caption ").animate({"opacity": "1", "bottom":"0"}, {easing:"easeOutBack", duration: 500});
						}else{
					jQuery(".nivo-caption ").animate({"opacity": "1", "bottom":"15%"}, {easing:"easeOutBack", duration: 500});	
					jQuery(".nivo-caption ").has('.sld_layout3').addClass('sld3wrap');	
							}
				}
			});
	});
	

</script>



<?php } ?>



<script type="text/javascript">
	/* <![CDATA[ */
		jQuery().ready(function() {

	jQuery('#navmenu').prepend('<div id="menu-icon"><?php _e('Menu', 'hathor') ?></div>');
	jQuery("#menu-icon").on("click", function(){
		jQuery("#navmenu .menu").slideToggle();
		jQuery(this).toggleClass("menu_active");
	});

		});
	/* ]]> */
	</script>
    
<script type="text/javascript" charset="utf-8">
  
    jQuery(window).load(function() {
      jQuery('.tf-header-slider').flexslider({
        animation: "fade",
        maxItems: 11,
        controlNav: true
      });
    });
    
    jQuery(window).load(function() {
      jQuery('.tf-work-carousel').flexslider({
        animation: "slade",
        animationLoop: false,
        itemWidth: 280,
        itemMargin: 30,
        move: 1,
        start: function(slider){
          jQuery('body').removeClass('loading');
        }
      });
    });
    
   jQuery(window).load(function() {
      jQuery('.tf-footer-carousel').flexslider({
        animation: "slide",
        animationLoop: true,
        itemWidth: 140,
        itemMargin: 15,
        minItems: 1,
        maxItems: 6,
        move:1
      });
    });
    
	
	
	
	
    jQuery(document).ready(function($) {
				jQuery('#work-carousel' ).carouFredSel({
					next : "#work-carousel-next",
					prev : "#work-carousel-prev",
					auto: false,
					circular: false,
					infinite: true,	
					width: '100%',		
					scroll: {
						items : 1					
					}		
				});
			});
			
	
	jQuery(document).ready(function($) {
				jQuery('#work-carousel3' ).carouFredSel({
					next : "#work-carousel-next3",
					prev : "#work-carousel-prev3",
					auto: false,
					circular: false,
					infinite: true,	
					width: '100%',		
					scroll: {
						items : 1					
					}		
				});
			});	
			
		
		jQuery(document).ready(function($) {
				jQuery('#work-carousels' ).carouFredSel({
					next : "#work-carousel-next2",
					prev : "#work-carousel-prev2",
					auto: false,
					circular: false,
					infinite: true,	
					width: '100%',		
					scroll: {
						items : 1					
					}		
				});
			});					
			
  </script> 
<?php } 



 


/* hathor welcome text */








//hathor get the first image of the post Function
function hathor_get_images($overrides = '', $exclude_thumbnail = false)
{
    return get_posts(wp_parse_args($overrides, array(
        'numberposts' => -1,
        'post_parent' => get_the_ID(),
        'post_type' => 'attachment',
        'post_mime_type' => 'image',
        'order' => 'ASC',
        'exclude' => $exclude_thumbnail ? array(get_post_thumbnail_id()) : array(),
        'orderby' => 'menu_order ID'
    )));
}




//ADD FULL WIDTH BODY CLASS
add_filter( 'body_class', 'hathor_fullwdth_body_class');
function hathor_fullwdth_body_class( $classes ) {
     if(of_get_option('nosidebar_checkbox') == "1")
          $classes[] = 'hathor_fullwdth_body';
     return $classes;
}

//Custom Excerpt Length
function hathor_excerptlength_teaser($length) {
    return 30;
}
function hathor_excerptlength_index($length) {
    return 12;
}
function hathor_excerptmore($more) {
    return '...';
}

function hathor_excerpt($length_callback='', $more_callback='') {
    global $post;
    if(function_exists($length_callback)){
        add_filter('excerpt_length', $length_callback);
    }
    if(function_exists($more_callback)){
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>'.$output.'</p>';
    echo $output;
}


/*-----------------------------------------------------------------------------------*/
/* Display <title> tag
/*-----------------------------------------------------------------------------------*/

// filter function for wp_title
function hathor_filter_wp_title( $old_title, $sep, $sep_location ){
 
    // add padding to the sep
    $ssep = ' ' . $sep . ' ';
     
    // find the type of index page this is
    if( is_category() ) $insert = $ssep . __('Category','hathor');
    elseif( is_tag() ) $insert = $ssep . __('Tag','hathor');
    elseif( is_author() ) $insert = $ssep . __('Author','hathor');
    elseif( is_year() || is_month() || is_day() ) $insert = $ssep . __('Archives','hathor');
    elseif( is_home() ) $insert = $ssep . get_bloginfo('description');
    else $insert = NULL;
     
    // get the page number we're on (index)
    if( get_query_var( 'paged' ) )
    $num = $ssep . __('Page ','hathor') . get_query_var( 'paged' );
     
    // get the page number we're on (multipage post)
    elseif( get_query_var( 'page' ) )
    $num = $ssep . __('Page ','hathor') . get_query_var( 'page' );
     
    // else
    else $num = NULL;

     
    // concoct and return new title
    return get_bloginfo( 'name' ) . $insert . $old_title . $num;
}

add_filter( 'wp_title', 'hathor_filter_wp_title', 10, 3 );

function hathor_rss_title($title) {
    /* need to fix our add a | blog name to wp_title */
    $ft = str_replace(' | ','',$title);
    return str_replace(get_bloginfo('name'),'',$ft);
}
add_filter('get_wp_title_rss', 'hathor_rss_title',10,1);

	







//SIDEBAR
function hathor_widgets_init(){
	register_sidebar(array(
	'name'          => __('Right Sidebar', 'hathor'),
	'id'            => 'sidebar',
	'description'   => __('Right Sidebar', 'hathor'),
	'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget_wrap">',
	'after_widget'  => '</div></div>',
	'before_title'  => '<h3 class="widgettitle">',
	'after_title'   => '</h3>'
	));
	
	register_sidebar(array(
	'name'          => __('Footer Widgets', 'hathor'),
	'id'            => 'foot_sidebar',
	'description'   => __('Widget Area for the Footer', 'hathor'),
	'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget_wrap">',
	'after_widget'  => '</div></div>',
	'before_title'  => '<h3 class="widgettitle">',
	'after_title'   => '</h3>'
	));



 
	
	
}

add_action( 'widgets_init', 'hathor_widgets_init' );








//**************hathor SETUP******************//
function hathor_setup() {
//Custom Background
add_theme_support( 'custom-background', array(
	'default-color' => '',
	'default-image' => get_template_directory_uri() . ''
) );

add_theme_support('automatic-feed-links');

//Post Thumbnail	
   add_theme_support( 'post-thumbnails' );
   
   
//Register Menus
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation(Header)', 'hathor' ),
		
	) );

 // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');


// Make theme available for translation
 load_theme_textdomain('hathor', get_template_directory() . '/languages');  
	
	
        
    
/*
 * Loads the Options Panel
 *
 * If you're loading from a child theme use stylesheet_directory
 * instead of template_directory
 */

define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/admin/' );
require_once dirname( __FILE__ ) . '/admin/options-framework.php';

include(get_template_directory() . '/lib/widgets.php');


}
add_action( 'after_setup_theme', 'hathor_setup' );


?>
<?php 






