<?php
/***************************************************************
 * SECURITY : Exit if accessed directly
***************************************************************/
if ( !defined( 'ABSPATH' ) ) {
	die( 'Direct acces not allowed!' );
}


/***************************************************************
 * Hooks custom TinyMCE button function
 ***************************************************************/ 
function wppic_add_mce_button() {

	if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) )
	return;
	
	if ( 'true' == get_user_option( 'rich_editing' ) ) {
		
		add_filter( 'mce_external_plugins', 'wppic_tinymce_plugin' );
		add_filter( 'mce_buttons', 'wppic_register_mce_button' );
		
		// Load stylesheet for tinyMCE button only
		wp_enqueue_style( 'wppic-admin-css', WPPIC_URL . 'css/wppic-admin-style.css', array(), NULL, NULL );
		wp_enqueue_script( 'wppic-ui-scripts', WPPIC_URL . 'js/wppic-ui-scripts.js', array( 'jquery' ),  NULL );

		//Define additionnal hookable MCE parameters
		$mceAddParam = array(
				'types' => array(),
				'layouts' => array(
					array( 'text' => __('Card (default)', 'wppic-translate'), 'value' => '' ),
					array( 'text' => __('Large', 'wppic-translate'), 'value' => 'large' )
				)

			);
		$mceAddParam = apply_filters( 'wppic_add_mce_type', $mceAddParam );
		$mceAddParam = json_encode( $mceAddParam );
		
		echo '<script>// <![CDATA[
		  var wppicMceList = '. $mceAddParam .';
		// ]]></script>';
		
	}
	
}
add_action('admin_head', 'wppic_add_mce_button');


/***************************************************************
 * Load plugin translation for - TinyMCE API
 ***************************************************************/ 
function wppic_add_tinymce_lang( $arr ){
    $arr[] = plugin_dir_path( __FILE__ ) . 'wp-plugin-info-card-ui-lang.php';
    return $arr;
}
add_filter( 'mce_external_languages', 'wppic_add_tinymce_lang', 10, 1 );


/***************************************************************
 * Load custom js options - TinyMCE API
 ***************************************************************/ 
function wppic_tinymce_plugin( $plugin_array ) {
	$plugin_array['wppic_mce_button'] = WPPIC_URL . 'js/wppic-ui-mce.js';
	return $plugin_array;
}


/***************************************************************
 * Register new standard button in the editor
 ***************************************************************/ 
function wppic_register_mce_button( $buttons ) {
	array_push( $buttons, 'wppic_mce_button' );
	return $buttons;
}