<?php
/***************************************************************
 * SECURITY : Exit if accessed directly
***************************************************************/
if ( !defined( 'ABSPATH' ) ) {
	die( 'Direct acces not allowed!' );
}


/***************************************************************
 * Enqueue style on dashboard if widget is activated
 * Action is call during widget registration
 ***************************************************************/ 
function wppic_widget_enqueue( $hook ) {
    if ( 'index.php' != $hook ) {
        return;
    }
	//Enqueue sripts and style
	wppic_admin_scripts();
	wppic_admin_css();
}


/***************************************************************
 * Register Dashboard Widget
 ***************************************************************/ 
if ( !function_exists( 'wppic_dashboard_widgets' ) ) {
	function wppic_add_dashboard_widgets() {
		global 	$wppicSettings;
		if( isset( $wppicSettings['widget'] ) && $wppicSettings['widget'] == true ){
			wp_add_dashboard_widget( 'wppic-dashboard-widget', '<img src="' . WPPIC_URL . 'img/wppic.svg" class="wppic-logo" alt="b*web" style="display:none"/>&nbsp;&nbsp;' . WPPIC_NAME . ' board', 'wppic_widgets' );
			add_action( 'admin_enqueue_scripts', 'wppic_widget_enqueue' );
		}
	}
}
add_action( 'wp_dashboard_setup', 'wppic_add_dashboard_widgets' );


/***************************************************************
 * Dashboard Widget function 
 ***************************************************************/  
function wppic_widgets() {
	global 	$wppicSettings;
	$listState = false;
	$ajaxClass = '';

	if( isset( $wppicSettings['ajax'] ) && $wppicSettings['ajax'] == true )
		$ajaxClass = 'ajax-call';
	
	
	$wppicTypes = array();
	$wppicTypes = apply_filters( 'wppic_add_widget_type', $wppicTypes );
	
	$content = '<div class="wp-pic-list ' . $ajaxClass . '">';

	foreach( $wppicTypes as $wppicType ){
		
		$rows = array();
		
		if( isset( $wppicSettings[$wppicType[1]] ) && !empty( $wppicSettings[$wppicType[1]] ) ){
			
			$listState = true;
			$otherLists = false;
			
			foreach( $wppicTypes as $wppicList ){
				if( $wppicType[1] != $wppicList[1] )
				$rows[] = $wppicList[1];
			}

			foreach( $rows as $row ){
				if( isset( $wppicSettings[$row] ) && !empty( $wppicSettings[$row] ) ){
					$otherLists = true;					
				}
			}

			if( $otherLists ){
				$content .= '<h4>' . $wppicType[2] . '</h4>';
			}
		
			if( isset( $wppicSettings['ajax'] ) && $wppicSettings['ajax'] == true ){
				$content .= '<div class="wp-pic-loading" style="background-image: url(' . admin_url() . 'images/spinner-2x.gif);" data-type="' . $wppicType[0] . '" data-list="' . htmlspecialchars( json_encode( ( $wppicSettings[$wppicType[1]] ) ), ENT_QUOTES, 'UTF-8' ) . '"></div>';
			} else {
				$content .= wppic_widget_render( $wppicType[0], $wppicSettings[$wppicType[1]] );
			}
			
		}
		
	}
		
	//Nothing found
	if( !$listState ) {

		$content .= '<div class="wp-pic-item" style="display:block;">';
		$content .= '<span class="wp-pic-no-item"><a href="admin.php?page=' . WPPIC_ID . '">' . __('Nothing found, please add at least one item in the WP Plugin Info Card settings page.', 'wppic-translate') . '</a></span>';
		$content .= '</div>';
		
	}

	$content .= '</div>';
	
	echo $content;
		
} //end of wppic_widgets


/***************************************************************
 * Widget Ajax callback 
 ***************************************************************/  
function wppic_widget_render( $type=NULL, $slugs=NULL ){

	if( isset( $_POST['wppic-type'] ) && !empty( $_POST['wppic-type'] ) ){
		$type = esc_html( $_POST['wppic-type'] );
	} 
	
	if( isset( $_POST['wppic-list'] ) && !empty( $_POST['wppic-list'] ) ){
		$slugs = array( esc_html( $_POST['wppic-list'] ) );
	} 
	
	$content = '';

	if( !empty( $slugs ) ) {
		foreach( $slugs as $slug){
			$wppic_data = wppic_api_parser( $type, $slug, '5', true );

			if( !$wppic_data ){

				$content .= '<div class="wp-pic-item ' . $slug . '">';
				$content .= '<span class="wp-pic-no-item">' . __('Item not found:', 'wppic-translate') . ' "' . $slug . '" ' . __('does not exist.', 'wppic-translate') . '</span>';
				$content .= '</div>';
			
			} else {

				$content = apply_filters( 'wppic_add_widget_item', $content, $wppic_data, $type );	
				
			}
		}
		
	}

	if( !empty( $_POST['wppic-list'] ) ) {
		echo $content;
		die();	
	} else {
		return $content;
	}
			
}
add_action( 'wp_ajax_wppic_widget_render', 'wppic_widget_render' );