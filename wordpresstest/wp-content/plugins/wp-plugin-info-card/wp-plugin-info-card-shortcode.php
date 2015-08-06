<?php
/***************************************************************
 * SECURITY : Exit if accessed directly
***************************************************************/
if ( !defined( 'ABSPATH' ) ) {
	die( 'Direct acces not allowed!' );
}


/***************************************************************
 * Register default plugin scripts
 ***************************************************************/
function wppic_register_sripts() {
	wp_enqueue_style( 'wppic-style', WPPIC_URL . 'css/wppic-style.min.css', NULL, NULL );
	wp_enqueue_script( 'wppic-script', WPPIC_URL . 'js/wppic-script.min.js', array( 'jquery' ),  NULL, true );
}
add_action( 'wppic_enqueue_scripts', 'wppic_register_sripts' );


/***************************************************************
 * Enqueue Scripts action hook
 ***************************************************************/
function wppic_print_sripts() {
	global 	$wppicSettings;
	
	$wppicAjax = '<script>// <![CDATA[ 
	var wppicAjax = { ajaxurl : "'.admin_url( 'admin-ajax.php' ).'" };
	 // ]]></script>';

	if( isset( $wppicSettings['enqueue'] ) && $wppicSettings['enqueue'] == true ){

		echo $wppicAjax;
		do_action( 'wppic_enqueue_scripts' );
	
	} else {
		
		//Enqueue Scripts when shortcode is in page
		global $wppicSripts;
		if ( ! $wppicSripts )
			return;
		
		echo $wppicAjax;
		do_action( 'wppic_enqueue_scripts' );
		
	}

}
add_action( 'wp_footer', 'wppic_print_sripts' );


/***************************************************************
 * Main shortcode function
 ***************************************************************/
function wppic_shortcode_function( $atts, $content="" ) {

	//Retrieve & extract shorcode parameters
	extract( shortcode_atts( array(  
		"type"			=> '',	//plugin | theme
		"slug" 			=> '',	//plugin slug name
		"image" 		=> '',	//image url to replace WP logo (175px X 175px)
		"align" 		=> '',	//center|left|right
		"containerid" 	=> '',	//custom Div ID (could be use for anchor)
		"margin" 		=> '',	//custom container margin - eg: "15px 0"
		"clear" 		=> '',	//clear float before or after the card: before|after
		"expiration" 	=> '',	//transient duration in minutes - 0 for never expires
		"ajax" 			=> '',	//load plugin data async whith ajax: yes|no (default: no)
		"scheme" 		=> '',	//color scheme : default|scheme1->scheme10 (default: empty)
		"layout" 		=> '',	//card | flat
		"custom" 		=> '',	//value to print : url|name|version|author|requires|rating|num_ratings|downloaded|last_updated|download_link
	), $atts));
	
	global 	$wppicSettings;

	//Global var to enqueue scripts + ajax param if is set to yes
	global $wppicSripts;
	$wppicSripts = true;

	$addClass = array();
			
	//Remove unnecessary spaces
	$type = trim( $type );
	$slug = trim( esc_html( $slug ) );
	$image = trim( $image );
	$containerid = trim( $containerid );
	$margin = trim( $margin );
	$clear = trim( $clear );
	$expiration = trim( $expiration );
	$ajax = trim( $ajax);
	$scheme = trim( $scheme);
	$layout = trim( $layout);
	$custom = trim( $custom);

	if( empty( $layout ) )
		$layout = 'card';
		
	$addClass[] = $layout;
	
	//Random slug: comma-separated list
	if ( strpos( $slug,',' ) !== false ) {
		$slug = explode( ',', $slug );
		$slug = $slug[ array_rand( $slug ) ];
	}

	//For old plugin versions
	if(empty($type)){
		$type = 'plugin';
	}
	$addClass[] = $type;
	
	if( !empty( $custom ) ){

		$wppic_data = wppic_api_parser( $type, $slug, $expiration );
		
		if( !$wppic_data )
		return '<strong>' . __('Item not found:', 'wppic-translate') . ' "' . $slug . '" ' . __('does not exist.', 'wppic-translate') . '</strong>';
	
		if( !empty( $wppic_data->$custom ) )
		$content .= $wppic_data->$custom;
		
	} else {
		
		//Ajax required data
		$ajaxData = '';
		if($ajax == 'yes'){
			$addClass[] = 'wp-pic-ajax';
			$ajaxData = 'data-type="' . $type . '" data-slug="' . $slug . '" data-image="' . $image . '" data-expiration="' . $expiration . '"  data-layout="' . $layout . '" ';
		}

		//Align card
		$alignCenter = false;
		if( $align == 'right' || $align == 'left' ) {
			$align = 'float: ' . $align . '; ';
		}
		if( $align == 'center') {
			$alignCenter = true;
			$align = '';
		}
		
		//Extra container ID
		if( !empty( $containerid ) ){
			$containerid = ' id="' . $containerid . '"';
		} else {
			$containerid = ' id="wp-pic-'. esc_html( $slug ) . '"';
		}

		//Custom container margin
		if( !empty( $margin ) ){
			$margin = 'margin:' . $margin . ';';
		}

		//Custom style
		$style = '';
		if( !empty( $margin ) || !empty( $align ) ){
			$style = 'style="' . $align . $margin . '"';
		}

		//Color scheme
		if(empty($scheme)){
			$scheme = $wppicSettings['colorscheme'];
			if(	$scheme == 'default' ){
				$scheme = '';
			}
		}
		$addClass[] = $scheme;

		//Output
		if($clear == 'before')
		$content .= '<div style="clear:both"></div>';
		
		if($alignCenter)
		$content .= '<div class="wp-pic-center">';
		
		//Data attribute for ajax call
		$content .= '<div class="wp-pic ' . implode( ' ',$addClass ) . '" ' . $containerid . $style . $ajaxData .' >';

		if( $ajax != 'yes' ){
			$content .= wppic_shortcode_content( $type, $slug, $image, $expiration, $layout );
		} else {
			$content .= '<div class="wp-pic-body-loading"><div class="signal"></div></div>';
		}

		$content .= '</div>';
		
		//Align center
		if( $alignCenter )
		$content .= '</div>';
		
		if( $clear == 'after' )
		$content .= '<div style="clear:both"></div>';

	}
	
	return $content;
		
} //end of wppic_Shortcode

add_shortcode( 'wp-pic', 'wppic_shortcode_function' );

/***************************************************************
 * Content shortcode function
 ***************************************************************/
function wppic_shortcode_content( $type=NULL, $slug=NULL, $image=NULL, $expiration=NULL, $layout=NULL ){
	
	if( !empty( $_POST['type'] ) ){
		$type = $_POST['type'];
	} 
	if( !empty( $_POST['slug'] ) ){
		$slug = $_POST['slug'];
	} 
	if( !empty( $_POST['image'] ) ){
		$image = $_POST['image'];
	} 
	if( !empty( $_POST['expiration'] ) ){
		$expiration = $_POST['expiration'];
	} 
	if( !empty( $_POST['layout'] ) ){
		$layout = $_POST['layout'];
	} 

	$type = esc_html( $type );
	$slug = esc_html( $slug );
	$image = esc_html( $image );
	$expiration = esc_html( $expiration );
	$layout = esc_html( $layout );
	
	$wppic_data = wppic_api_parser( $type, $slug, $expiration );
		
	
	//if plugin does not exists
	if( !$wppic_data ){
		
		$error = '<div class="wp-pic-flip" style="display: none;">';
			$error .= '<div class="wp-pic-face wp-pic-front error">';

				$error .=  '<span class="wp-pic-no-plugin">' . __('Item not found:', 'wppic-translate') . '</br><i>"' . $slug . '"</i></br>' . __('does not exist.', 'wppic-translate') . '</span>';
				$error .=  	'<div class="monster-wrapper">
								<div class="eye-left"></div>
								<div class="eye-right"></div>
								<div class="mouth">
									<div class="tooth-left"></div>
									<div class="tooth-right"></div>
								</div>
								<div class="arm-left"></div>
								<div class="arm-right"></div>
								<div class="dots"></div>
							</div>';
			$error .= '</div>';
		$error .= '</div>';
		
		if( !empty( $_POST['slug'] ) ) {
			echo $error;
			die();
		} else {
			return $error;
		}
		
	}
	
	//Date format Internationalizion
	global 	$wppicDateFormat;
	$wppic_data->last_updated = date_i18n( $wppicDateFormat, strtotime( $wppic_data->last_updated ) );

	//Prepare the credit
	global 	$wppicSettings;
	$credit = '';
	if( isset( $wppicSettings['credit'] ) && $wppicSettings['credit'] == true ){
		$credit .= '<a class="wp-pic-credit" href="http://b-website.com/wp-plugin-info-card-for-wordpress" target="_blank" data-tooltip="';
		$credit .= __('This card has been generated with WP Plugin Info Card', 'wppic-translate');
		$credit .= '"></a>';
	}
	$wppic_data->credit = $credit;
	
	
	//Load theme or plugin template
	$content = '';	
	$content = apply_filters( 'wppic_add_template', $content, array( $type, $wppic_data, $image, $layout ) );
	
	
	if(!empty($_POST['slug'])) {
		echo $content;
		die();
	} else {
		return $content;
	}
	
}
add_action( 'wp_ajax_async_wppic_shortcode_content', 'wppic_shortcode_content' );
add_action( 'wp_ajax_nopriv_async_wppic_shortcode_content', 'wppic_shortcode_content' );