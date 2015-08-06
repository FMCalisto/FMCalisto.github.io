<?php
/*
Plugin Name: WP Cards
Plugin URI: http://davidscotttufts.com/wp-cards/
Description: Allows for theme developers to add "cards" to their theme's homepage and header
Version: 1.5.1
Author: David S. Tufts
Author URI: http://davidscotttufts.com/
Text Domain: card design
License: GPL2
*/

/*	Copyright 2014	David S. Tufts	(email : david.tufts@rocketwood.com)

		This program is free software; you can redistribute it and/or modify
		it under the terms of the GNU General Public License, version 2, as
		published by the Free Software Foundation.

		This program is distributed in the hope that it will be useful,
		but WITHOUT ANY WARRANTY; without even the implied warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.	See the
		GNU General Public License for more details.

		You should have received a copy of the GNU General Public License
		along with this program; if not, write to the Free Software
		Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA	02110-1301	USA
*/

// Global plugin settings
$wp_cards_query_stack = array();
$view = 'list';
$valid_views = array( 'list' => 'List', 'grid' => 'Grid', 'tile' => 'Tile', 'mini' => 'Mini', 'spotlight' => 'Spotlight', 'banner' => 'Banner', 'featurette' => 'Featurette' );
		
add_action( 'plugins_loaded', 'wp_cards_load_textdomain' );
add_action( 'widgets_init', 'wp_cards_widgets_register');
add_action( 'admin_menu', 'wp_cards_plugin_menu' );

define( 'WPCARDSPATH', dirname( __FILE__ ) );
require_once( WPCARDSPATH.'/wp-cards-excerpt.php' );
require_once( WPCARDSPATH.'/wp-cards-plugin-options.php' );
require_once( WPCARDSPATH.'/class-page-templater.php' );

/** Run activation when the plugin is activated */
register_activation_hook( __FILE__, 'wp_cards_activation' );

/** Run deactivation when the plugin is deactivated */
register_deactivation_hook( __FILE__, 'wp_cards_deactivation' );

if ( function_exists('register_sidebar') ) {
	$default_sidebar = array(
		'id' => 'card_staging',
		'name' => 'Card Staging Area',
		'before_widget' => '', 
		'after_widget' => '', 
		'before_title' => '',
		'after_title' => ''
	);
	register_sidebar( $default_sidebar );
	if ( 'enable' == $wp_cards_plugin_options['enable_jumbotron_cards']['value'] ) {
		register_sidebar( array_merge( $default_sidebar, array( 'id' => 'jumbotron-cards', 'name' => 'Jumbotron Cards' ) ) );
	}
	if ( 'enable' == $wp_cards_plugin_options['enable_header_footer_cards']['value'] ) {
		register_sidebar( array_merge( $default_sidebar, array( 'id' => 'header-cards', 'name' => 'Header Cards' ) ) );
		register_sidebar( array_merge( $default_sidebar, array( 'id' => 'footer-cards', 'name' => 'Footer Cards' ) ) );
	}
	register_sidebar( array_merge( $default_sidebar, array( 'id' => 'home_page_cards', 'name' => 'Home Page Cards' ) ) );

	// Find all pages using the card-template.php
	$pages = get_pages(array(
		'meta_key' => '_wp_page_template',
		'meta_value' => 'wp-cards-template.php'
	));
	foreach ( $pages as $page ) {
		register_sidebar( array_merge( $default_sidebar, array( 'id' => $page->post_name . '-cards', 'name' => $page->post_title . ' Page Cards' ) ) );
	}
}

if ( ! is_admin() ) {
	// Adds WP Cards specific Styles and Scripts
	add_action( 'wp_enqueue_scripts', 'wp_cards_enqueue_scripts' );
}

function wp_cards_activation() {

}

function wp_cards_deactivation() {

}

function wp_cards_load_textdomain() {
	load_plugin_textdomain( 'wp_cards', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}

function wp_cards_enqueue_scripts() {
	global $wp_cards_plugin_options;
	wp_enqueue_style('wp-cards', plugins_url( 'wp-cards/includes/css/components.css' ), false, wp_cards_auto_version('/css/components.css', true), 'screen');

	// Bootstrap
	if ( 'enable' == $wp_cards_plugin_options['include_bootstrap_files']['value'] ) {
		wp_register_style('bootstrap-styles', $wp_cards_plugin_options['bootstrap_css_cdn']['value'], array(), null, 'all');
		wp_enqueue_style('bootstrap-styles');
		wp_register_script('bootstrap-scripts', $wp_cards_plugin_options['bootstrap_js_cdn']['value'], array('jquery'), null, true);
		wp_enqueue_script('bootstrap-scripts');
	}
}

function wp_cards_auto_version( $url, $plugin_dir = true ) {
	if ( $plugin_dir ) {
		$file_path = plugin_dir_path( __FILE__ ) . 'includes';
	} else {
		$file_path = $_SERVER['DOCUMENT_ROOT'];
	}

	return filemtime( $file_path.$url );
}

function wp_cards_widgets_register() {
	$paths = array(
		plugin_dir_path( __FILE__ ) . 'cards/',
		get_template_directory() . '/cards/',
		get_stylesheet_directory() . '/cards/'
	);

	foreach ( $paths as $path ) {
		if ( is_dir( $path ) && $dir = opendir( $path ) ) {
			while ( ( $file = readdir( $dir ) ) !== false ) {
				if ( preg_match( '/card-(.*)\.php/', $file, $match ) ) {
					$class = sprintf( 'wp_cards_%s_widget', str_replace( '-', '_', $match[1] ) );
					include_once $path . $file;
					register_widget( $class );
				}
			}

			closedir( $dir );
		}
	}
}

/**
 * Query Stack Section
 *
 * This section holds functions for managing nested queries
 */

function wp_cards_query($query) {
	global $wp_cards_query_stack;

	// push current query object onto stack
	$wp_cards_query_stack[] =& $GLOBALS['wp_query'];

	// nullify global query object pointer
	unset( $GLOBALS['wp_query'] );

	// assign global pointer to new query object
	$GLOBALS['wp_query'] = new WP_Query();

	// initialize new global query state
	$results = $GLOBALS['wp_query']->query($query);

	return $results;
}

function wp_cards_reset_query() {
	global $wp_cards_query_stack;

	// nullfiy global query object pointer
	unset($GLOBALS['wp_query']);

	// pop previous query object from stack
	// and assign global pointer to it
	if ( ! empty($wp_cards_query_stack) ) {
		$index = (count($wp_cards_query_stack) - 1);

		$GLOBALS['wp_query'] =& $wp_cards_query_stack[$index];

		// pop previous query object from stack
		array_pop($wp_cards_query_stack);
	}

	// restore previous global query state
	wp_reset_postdata();
}

function wp_cards_set_view( $new_view = '' ) {
	global $view;
	$view = $new_view;
	return $view;
}

function wp_cards_get_view() {
	global $view, $valid_views;
	if ( ! empty ( $_REQUEST['view'] ) && in_array( $_REQUEST['view'], $valid_views ) ) {
		return $_REQUEST['view'];
	} else {
		return $view;
	}
}

function wp_cards_boolean( $value = null, $default = false ) {
	// Ensure that the default is a boolean value
	if ( ! is_bool( $default ) )
		$default = wp_cards_boolean( $default );

	if ( is_null( $value ) ) {
		return $default;
	} elseif ( is_string( $value ) ) {
		$true_strings  = array( 'true',  'enable' );
		$false_strings = array( 'false', 'disable' );

		$lower_value = strtolower( $value );

		if ( in_array( $lower_value, $true_strings ) )
			return true;
		elseif ( in_array( $lower_value, $false_strings ) )
			return false;

		return (bool) trim( $value );
	} elseif ( is_scalar( $value ) ) {
		return (bool) $value;
	}

	return $default;
}

function wp_cards_toolbar() {
	
}

function wp_cards_load_more( $args = array() ) {
	global $wp_query;
	
	if ( ! ( $wp_query->max_num_pages > 1 ) ) return;

	$page = get_query_var( 'paged' );
	$page = ! empty( $page ) ? intval( $page ) : 1;
	$posts_per_page = intval( get_query_var( 'posts_per_page' ) );

	$default_args = array(
		'path'                   => '',
		'post_type'              => null,
		'max_num_pages'          => intval( ceil( $wp_query->found_posts / $posts_per_page ) ),
		'offset_by_id'           => null,
		'found_posts'            => $wp_query->found_posts,
		'target'                 => 'content'
	);
	
	$args = array_merge( $default_args, $args );
	extract( $args );

	$filter_pairs = wp_cards_filter_pairs();
	$max_num_pages = ( $posts_per_page != -1 ? ceil($found_posts / $posts_per_page) : 1 );

	if ( $max_num_pages > 1 && $page < $max_num_pages ) {
		$filter_pairs['page'] = ($page + 1);

		$query_string = wp_cards_query_string( $args, $filter_pairs, $path, (empty($path) ? true : false) );

		$html = sprintf( '
			<div class="load-more-toolbar">
				<a href="%1$s" rel="%2$s" class="%3$s" title="%4$s">%4$s</a>
			</div>',
			$query_string,
			$target,
			! empty ($class) ? $class : 'ajax-append',
			__('Load More', 'wp-cards')
		);

		add_action( 'wp_footer', 'wp_cards_ajax_footer' );

		echo $html;
	}
}

function wp_cards_filter_pairs() {
	global $wp_query;
	$filter_pairs = array();

	if ( $year = $wp_query->query_vars['year'] )
		$filter_pairs['year'] = $year;

	if ( $month = $wp_query->query_vars['monthnum'] )
		$filter_pairs['monthnum'] = $month;
	elseif ( isset($wp_query->query_vars['month']) )
		$filter_pairs['monthnum'] = $wp_query->query_vars['month'];

	if ( $day = $wp_query->query_vars['day'] )
		$filter_pairs['day'] = $day;

	if ( ! empty($_GET['s']) )
		$filter_pairs['search'] = esc_attr($_GET['s']);
	elseif ( $search = $wp_query->query_vars['s'] )
		$filter_pairs['search'] = $search;
	elseif ( isset($wp_query->query_vars['search']) )
		$filter_pairs['search'] = $wp_query->query_vars['search'];

	if ( isset($wp_query->query_vars['category']) )
		$filter_pairs['category'] = $wp_query->query_vars['category'];
	elseif ( isset($wp_query->query_vars['category_name']) )
		$filter_pairs['category'] = $wp_query->query_vars['category_name'];

	if ( $tag = $wp_query->query_vars['tag'] )
		$filter_pairs['tag'] = $tag;

	return $filter_pairs;
}

function wp_cards_query_string( $args = array(), $filter_pairs = array(), $path = '', $base = true ) {
	global $wp_query;
	$query_params = '';

	if ( $base ) {
		if ( ! empty( $args['id'] ) ) {
			$path = get_permalink( $args['id'] );
		}

		if ( '' == $path ) {
			// Figure out the current page
			if ( get_query_var('paged') )
				$cur_page = get_query_var('paged');
			elseif ( get_query_var('page') )
				$cur_page = get_query_var('page');
			else
				$cur_page = 1;

			if ( isset( $filter_pairs['page'] ) )
				$page = $filter_pairs['page'];
			else
				$page = 1;

			if ( ! ( ($cur_page == $page) && ( $page > 1 ) ) )
				$path = esc_url(get_pagenum_link($page));
			elseif ( ! empty($args['post_type']) )
				$path = '/'.$args['post_type'].'/';
			else
				$path = '/';
		}
	}

	// Get the ?query=string
	if ( $path_split = explode('?', $path) ) {
		$path = $path_split[0];
		if ( isset($path_split[1]) ) {
			$query_params = $path_split[1];
		}
	}

	if ( ! empty( $args['view'] ) ) {
		$query_params .= ( trim($query_params) != '' ? '&' : '' );
		$query_params .= 'view=' . $args['view'];
	}
	
	if ( trim($query_params) != '' ) {
		$path . '?' . $query_params;
	}
		
	return $path;
}

function wp_cards_ajax_footer() {
	$src = plugins_url( 'includes/js/wp-cards-ajax.js', __FILE__ );

	wp_register_script( 'ajax-reload', $src );
	wp_enqueue_script( 'ajax-reload' );
}

function wp_cards_loop( $args = array() ) {
	return wp_cards_get_loop( $args, true );
}

function wp_cards_get_loop( $args = array(), $load = false ) {
	$default_args = array(
		'post_type' => '',
		'view'      => ''
	);

	$args = wp_parse_args( $args, $default_args );
	extract( $args );

	$post_type = 'any' == $post_type ? null : $post_type;
	$template_names = array();

	if ( ! empty( $post_type ) ) {
		if ( ! empty( $view ) ) {
			$template_names[] = 'loop-' . $post_type . '-' . $view . '.php';
			$template_names[] = 'loop-' . $post_type . '.php';
			$template_names[] = 'loop-' . $view . '.php';
		} else {
			$template_names[] = 'loop-' . $post_type . '.php';
		}
	} elseif ( ! empty( $view ) ) {
		$template_names[] = 'loop-' . $view . '.php';
	}

	$template_names[] = 'loop.php';

	return wp_cards_locate_template( $template_names, $load, false );
}

function wp_cards_excerpt( $args = array() ) {
	return wp_cards_get_excerpt( $args, true );
}

function wp_cards_get_excerpt( $args = array(), $load = false ) {
	// File name order: 1. post_type - 2. view - 3. post_format
	$default_args = array(
		'post_type' => '',
		'view' => '',
		'post_format' => ''
	);

	$args = wp_parse_args( $args, $default_args );

	extract( $args );

	$post_type = 'any' == $post_type ? null : $post_type;

	$template_names = array();

	if ( ! empty( $post_type ) ) {
		if ( ! empty( $view ) ) {
			if ( ! empty( $post_format ) ) {
				$template_names[] = 'excerpt-' . $post_type . '-' . $view . '-' . $post_format . '.php';
				$template_names[] = 'excerpt-' . $post_type . '-' . $view . '.php';
				$template_names[] = 'excerpt-' . $post_type . '-' . $post_format . '.php';
				$template_names[] = 'excerpt-' . $post_type . '.php';
				$template_names[] = 'excerpt-' . $view . '-' . $post_format . '.php';
				$template_names[] = 'excerpt-' . $view . '.php';
				$template_names[] = 'excerpt-' . $post_format . '.php';
			} else {
				$template_names[] = 'excerpt-' . $post_type . '-' . $view . '.php';
				$template_names[] = 'excerpt-' . $post_type . '.php';
				$template_names[] = 'excerpt-' . $view . '.php';
			}
		} elseif ( ! empty( $post_format ) ) {
			$template_names[] = 'excerpt-' . $post_type . '-' . $post_format . '.php';
			$template_names[] = 'excerpt-' . $post_type . '.php';
			$template_names[] = 'excerpt-' . $post_format . '.php';
		} else {
			$template_names[] = 'excerpt-' . $post_type . '.php';
		}
	} elseif ( ! empty( $view ) ) {
		if ( ! empty( $post_format ) ) {
			$template_names[] = 'excerpt-' . $view . '-' . $post_format . '.php';
			$template_names[] = 'excerpt-' . $view . '.php';
			$template_names[] = 'excerpt-' . $post_format . '.php';
		} else {
			$template_names[] = 'excerpt-' . $view . '.php';
		}
	} elseif ( ! empty( $post_format ) ) {
		$template_names[] = 'excerpt-' . $post_format . '.php';
	}

	$template_names[] = 'excerpt.php';

	return wp_cards_locate_template( $template_names, $load, false );
}

function wp_cards_locate_template( $template_names, $load = false, $require_once = true ) {
	$wp_cards_path = plugin_dir_path( __FILE__ ) . 'templates/';
	$stylesheet_path = get_stylesheet_directory() . '/';
	$template_path = get_template_directory() . '/';
	$template_file = '';

	foreach ( (array) $template_names as $template_name ) {
		if ( empty( $template_name ) ) continue;

		if ( file_exists( $stylesheet_path . $template_name ) ) {
			$template_file = $stylesheet_path . $template_name;
			break;
		}

		if ( file_exists( $template_path . $template_name ) ) {
			$template_file = $template_path . $template_name;
			break;
		}

		if ( file_exists( $wp_cards_path . $template_name ) ) {
			$template_file = $wp_cards_path . $template_name;
			break;
		}
	}

	if ( '' != $template_file ) {
		if ( ! $load ) ob_start();

		load_template( $template_file, $require_once );

		if ( ! $load ) {
			$html = ob_get_contents();
			ob_end_clean();

			return ! empty( $html ) ? $html : false;
		}
	}

	return $template_file;
}

?>