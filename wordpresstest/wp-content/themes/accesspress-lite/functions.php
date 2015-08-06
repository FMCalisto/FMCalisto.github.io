<?php
/**
 * AccesspressLite functions and definitions
 *
 * @package AccesspressLite
 */


if ( ! function_exists( 'accesspresslite_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function accesspresslite_setup() {
	/**
	 * Set the content width based on the theme's design and stylesheet.
	 */
	global $content_width;
	/**
	 * Global content width.
	 */
	 if (!isset($content_width))
     	$content_width = 750; /* pixels */

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on AccesspressLite, use a find and replace
	 * to change 'accesspresslite' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'accesspresslite', get_template_directory() . '/languages' );

	/**
	 * Add callback for custom TinyMCE editor stylesheets. (editor-style.css)
	 * @see http://codex.wordpress.org/Function_Reference/add_editor_style
	 */
	add_editor_style();	

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/* 
     * Let WordPress manage the document title. 
     * By adding theme support, we declare that this theme does not use a 
     * hard-coded <title> tag in the document head, and expect WordPress to 
     * provide it for us. 
     */ 
 	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'event-thumbnail', 135, 100, true); //Latest News Events Small Image
	add_image_size( 'featured-thumbnail', 350, 245, true); //Featured Image
	add_image_size( 'portfolio-thumbnail', 400, 450, true); //Portfolio Image		

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'accesspresslite' ),
	) );

	// Enable support for Post Formats.
	//add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'accesspresslite_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

}
endif; // accesspresslite_setup
add_action( 'after_setup_theme', 'accesspresslite_setup' );

/**
 * Implement the Theme Option feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Implement the Theme Option feature.
 */
require get_template_directory() . '/inc/admin-panel/theme-options.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Implement the custom metabox feature
 */
require get_template_directory() . '/inc/custom-metabox.php';

/**
 * Implement the TGM PLugin Activation Class
 */
require get_template_directory() . '/inc/class-tgm-plugin-activation.php';
