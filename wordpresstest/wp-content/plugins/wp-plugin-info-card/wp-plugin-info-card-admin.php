<?php
/***************************************************************
 * SECURITY : Exit if accessed directly
***************************************************************/
if ( !defined( 'ABSPATH' ) ) {
	die( 'Direct acces not allowed!' );
}


/***************************************************************
 * Back-End Scripts & Styles enqueueing
 ***************************************************************/
function wppic_admin_scripts() {
	wp_enqueue_script( 'wppic-admin-js', WPPIC_URL . 'js/wppic-admin-script.js', array( 'jquery' ),  NULL);
	wp_enqueue_script( 'wppic-js', WPPIC_URL . 'js/wppic-script.min.js', array( 'jquery' ),  NULL);
	wp_enqueue_script( 'jquery-ui-sortable', WPPIC_URL . '/wp-includes/js/jquery/ui/jquery.ui.sortable.min.js', array( 'jquery' ),  NULL);
}
function wppic_admin_css() {
	wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'wppic-admin-css', WPPIC_URL . 'css/wppic-admin-style.css', array(), NULL, NULL);
}


/***************************************************************
 * Create admin page menu
 ***************************************************************/
function wppic_create_menu() {

	$admin_page = add_options_page( WPPIC_NAME_FULL, WPPIC_NAME, 'manage_options', WPPIC_ID,  'wppic_settings_page' );

	//Enqueue sripts and style
	add_action( 'admin_print_scripts-' . $admin_page, 'wppic_admin_scripts' );
	add_action( 'admin_print_styles-' . $admin_page, 'wppic_admin_css' );

}
add_action('admin_menu', 'wppic_create_menu');


/***************************************************************
 * Register plugin settings 
 ***************************************************************/ 
function wppic_register_settings() {
	register_setting( 
		'wppic_settings', 
		'wppic_settings',
		'wppic_validate'
	);
	add_settings_section(
		'wppic_options',
		'', 
		'',
		WPPIC_ID . 'options'
	);
	add_settings_field(
		'wppic-color-scheme',
		__('Color scheme', 'wppic-translate'), 
		'wppic_color_scheme',
		WPPIC_ID . 'options',
		'wppic_options'
	);
	add_settings_field(
		'wppic-enqueue',
		__('Force enqueuing CSS & JS', 'wppic-translate'), 
		'wppic_checkbox',
		WPPIC_ID . 'options',
		'wppic_options',
		array(
            'id' 	=> 'wppic-enqueue',
            'name' 	=> 'enqueue',
			'label' => __('By default the plugin enqueues scripts (JS & CSS) only for pages containing the shortcode. If you wish to force scripts enqueuing, check this box.', 'wppic-translate')
        ) 
	);
	add_settings_field(
		'wppic-credit',
		__('Display a discrete credit', 'wppic-translate'), 
		'wppic_checkbox',
		WPPIC_ID . 'options',
		'wppic_options',
		array(
            'id' 	=> 'wppic-credit',
            'name' 	=> 'credit',
			'label' => __('If you like this plugin, check this box!', 'wppic-translate')
        ) 
	);

	add_settings_section(
		'wppic_list',
		'', 
		'',
		WPPIC_ID . 'widget'
	);
	add_settings_field(
		'wppic-list-widget',
		__('Enable dashboard widget', 'wppic-translate'), 
		'wppic_checkbox',
		WPPIC_ID . 'widget',
		'wppic_list',
		array(
            'id' 	=> 'wppic-widget',
            'name' 	=> 'widget',
			'label' => __('Help: Don\'t forget to open the dashboard option panel (top right) to display it on your dashboard.', 'wppic-translate')
        ) 
	);
	add_settings_field(
		'wppic-list-ajax',
		__('Ajaxify dashboard widget', 'wppic-translate'), 
		'wppic_checkbox',
		WPPIC_ID . 'widget',
		'wppic_list',
		array(
            'id' 	=> 'wppic-ajax',
            'name' 	=> 'ajax',
			'label' => __('Will load the data asynchronously with AJAX.', 'wppic-translate')
        ) 
	);
	add_settings_field(
		'wppic-list-form',
		__('List of items to display', 'wppic-translate'), 
		'wppic_list_form',
		WPPIC_ID . 'widget',
		'wppic_list'
	);

}
add_action( 'admin_init', 'wppic_register_settings' );


/***************************************************************
 * Admin page structure	
 ***************************************************************/
function wppic_settings_page() {
	global 	$wppicSettings;
	
	//Get default card color shceme
	$scheme = $wppicSettings['colorscheme'];
	if(	$scheme == 'default'){
		$scheme = '';
	}
	
	//Check if memcache is loaded (no transients purging)
	$memcache = '';
	if( !extension_loaded( 'Memcache' ) ){
		$memcache = '
			<p class="wppic-cache-clear">
				<button class="wppic-cache-clear-button first button button-primary" data-success="' . __('Cache was successfully cleared', 'wppic-translate') . '" data-error="' . __('Something went wrong', 'wppic-translate') . '">' . __('Empty all cache', 'wppic-translate') . '</button>
				<span class="wppic-cache-clear-loader" style="display: none; background-image: url(' . admin_url() . 'images/spinner-2x.gif);"></span>
			</p>
		';
	}
	
	echo '
	<div class="wrap">
		<h2>' . WPPIC_NAME_FULL . '</h2>
		<div id="post-body-content">
			' . wppic_plugins_about() . '
			<div id="wppic-admin-page" class="meta-box-sortabless">
				<div id="wppic-shortcode" class="postbox">
					<h3 class="hndle"><span>' . __('How to use WP Plugin Info Card shortcodes?', 'wppic-translate') . '</span></h3>
					<div class="inside">
						' . wppic_shortcode_function( array ( 'type' => 'plugin', 'slug' => 'wp-plugin-info-card', 'image' => '', 'align' => 'right', 'margin' => '0 0 0 20px', 'scheme' => $scheme  ) ) . '
						<h3 class="wp-pic-title">' . __('Shortcode parameters', 'wppic-translate') . '</h3>
						<ul>
							<li><strong>type:</strong> plugin, theme - ' . __('(default: plugin)', 'wppic-translate') . '</li>
							<li><strong>slug:</strong> ' . __('plugin slug name - Please refer to the plugin URL on wordpress.org to determine its slug: https://wordpress.org/plugins/THE-SLUG/', 'wppic-translate') . '</li>
							<li><strong>layout:</strong> ' . __('template layout to use - Default is "card" so you may leave this parameter empty. Available layouts are: card, large (default: empty)', 'wppic-translate') . '</li>
							<li><strong>scheme:</strong> ' . __('card color scheme: scheme1 through scheme10 (default: default color scheme defined in admin)', 'wppic-translate') . '</li>
							<li><strong>image:</strong> ' . __('Image URL to override default WP logo (default: empty)', 'wppic-translate') . '</li>
							<li><strong>align:</strong> center, left, right ' . __('(default: empty)', 'wppic-translate') . '</li>
							<li><strong>containerid:</strong> ' . __('custom div id, may be used for anchor (default: wp-pic-PLUGIN-NAME)', 'wppic-translate') . '</li>
							<li><strong>margin:</strong> ' . __('custom container margin - eg: "15px 0" (default: empty)', 'wppic-translate') . '</li>
							<li><strong>clear:</strong> ' . __('clear float before or after the card: before, after (default: empty', 'wppic-translate') . '</li>
							<li><strong>expiration:</strong> ' . __('cache duration in minutes - numeric format only (default: 720)', 'wppic-translate') . '</li>
							<li><strong>ajax: (BETA)</strong> ' . __('load the plugin data asynchronously with AJAX: yes, no (default: no)', 'wppic-translate') . '</li>
							<li><strong>custom:</strong> ' . __('value to display: (default: empty)', 'wppic-translate') . ' 
								<ul>
									<li>&nbsp;&nbsp;&nbsp;&nbsp;- ' . __('For plugins:', 'wppic-translate') . ' <i>url, name, icons, banners, version, author, requires, rating, num_ratings, downloaded, last_updated, download_link</i></li>
									<li>&nbsp;&nbsp;&nbsp;&nbsp;- ' . __('For themes:', 'wppic-translate') . ' <i>url, name, version, author, screenshot_url, rating, num_ratings, downloaded, last_updated, homepage, download_link</i></li>
								</ul>
							</li>
						</ul>
						<p>&nbsp;</p>
						<p>
							<pre> [wp-pic slug="adblock-notify-by-bweb" layout="large" scheme="scheme1" align="right" margin="0 0 0 20px" containerid="download-sexion" ajax="yes"] </pre>
						</p>
						<p class="documentation"><a href="http://b-website.com/wp-plugin-info-card-for-wordpress" target="_blank" title="'. __( 'Documentation and examples', 'wppic-translate' ) .'">'. __( 'Documentation and examples', 'wppic-translate' ) .' <span class="dashicons dashicons-external"></span></a></p>
						' . $memcache . '
					 </div>
				</div>
			</div>
	';
		?>
			<form method="post" id="wppic_settings" action="options.php">
				<?php settings_fields('wppic_settings') ?>
				<div class="meta-box-sortabless">
					<div id="wppic-form" class="postbox">
						<h3 class="hndle"><span><?php  _e('General options', 'wppic-translate') ?></span></h3>
						<div class="inside">
                            <table class="form-table">
                                <tr valign="top">
                                    <?php do_settings_sections(WPPIC_ID . 'options') ?>
                                </tr>
                            </table>
                            <?php submit_button() ?>
						</div>
					</div>
				</div>
				<div class="meta-box-sortabless">
					<div id="wppic-form" class="postbox">
						<h3 class="hndle"><span><?php  _e('Dashboard Widget Settings', 'wppic-translate') ?></span></h3>
						<div class="inside">
                            <table class="form-table">
                                <tr valign="top">
                                    <?php do_settings_sections(WPPIC_ID . 'widget') ?>
                                </tr>
                            </table>
                            <?php submit_button() ?>
						</div>
					</div>

				</div>
			</form> 
		</div>
    </div>
<?php
}


/***************************************************************
 * Color Scheme dropdown
 ***************************************************************/
function wppic_color_scheme() {
	global 	$wppicSettings;
	$scheme = $wppicSettings['colorscheme'];
	
	$content = '<td>';
		$content .= '<select id="wppic-color-scheme" name="wppic_settings[colorscheme]">';
		$content .= '<option value="default"  '. selected( $scheme, 'default', FALSE ) . ' >Default</option>';
		$content .= '<option value="scheme1"  '. selected( $scheme, 'scheme1', FALSE ) . ' >Color scheme 1</option>';
		$content .= '<option value="scheme2"  '. selected( $scheme, 'scheme2', FALSE ) . ' >Color scheme 2</option>';
		$content .= '<option value="scheme3"  '. selected( $scheme, 'scheme3', FALSE ) . ' >Color scheme 3</option>';
		$content .= '<option value="scheme4"  '. selected( $scheme, 'scheme4', FALSE ) . ' >Color scheme 4</option>';
		$content .= '<option value="scheme5"  '. selected( $scheme, 'scheme5', FALSE ) . ' >Color scheme 5</option>';
		$content .= '<option value="scheme6"  '. selected( $scheme, 'scheme6', FALSE ) . ' >Color scheme 6</option>';
		$content .= '<option value="scheme7"  '. selected( $scheme, 'scheme7', FALSE ) . ' >Color scheme 7</option>';
		$content .= '<option value="scheme8"  '. selected( $scheme, 'scheme8', FALSE ) . ' >Color scheme 8</option>';
		$content .= '<option value="scheme9"  '. selected( $scheme, 'scheme9', FALSE ) . ' >Color scheme 9</option>';
		$content .= '<option value="scheme10" '. selected( $scheme, 'scheme10', FALSE ) . '>Color scheme 10</option>';
		$content .= '</select>';
		$content .= '<label for="wppic-color-scheme">' . __('Default color scheme for your cards.', 'wppic-translate') . '</label>';
	$content .= '</td>';
	echo $content;
}


/***************************************************************
 * Checkbox input
 ***************************************************************/
function wppic_checkbox( $args ) {
	global 	$wppicSettings;
	$content = '<td>';
		$content .= '<input type="checkbox" id="' . $args[ 'id' ] . '" name="wppic_settings[' . $args[ 'name' ] . ']"  value="1" ';
		if( isset($wppicSettings[ $args[ 'name' ] ] ) ) {
			$content .= checked( 1, $wppicSettings[ $args[ 'name' ] ], false );
		}
		$content .= '/>';
		$content .= '<label for="' . $args[ 'id' ] . '">' . $args[ 'label' ] . '</label>';
	$content .= '</td>';
	echo $content;
}


/***************************************************************
 * Dashboard widget plugin list 
 ***************************************************************/
function wppic_list_form() {
	global 	$wppicSettings;
	$wppicListForm = array();
	$wppicListForm = apply_filters( 'wppic_add_list_form', $wppicListForm );	
	
	$content = '<td>';	
	
	if( !empty ( $wppicListForm ) ){
		foreach ( $wppicListForm as $wppicItemForm ){
			$content .= '<div class="form-list">';
				$content .= '<button class="button wppic-add-fields" data-type="' . $wppicItemForm[0] . '">' . $wppicItemForm[1] . '</button><input type="text" name="wppic-add" class="wppic-add"  value="">';
				$content .= '<ul id="wppic-' . $wppicItemForm[0] . '" class="wppic-list">';
						if( !empty( $wppicSettings[ $wppicItemForm[0] ] ) ){
							foreach($wppicSettings[ $wppicItemForm[0] ] as $item){
								$content .= '<li class="wppic-dd"><input type="text" name="wppic_settings[' . $wppicItemForm[0] . '][]"  value="' . $item . '"><span class="wppic-remove-field" title="remove"></span></li>';
							}
						}
				$content .= '</ul>';
				$content .= '<p>' . $wppicItemForm[2] . ' - <i>' . $wppicItemForm[3] . '</i> -<p>';               
			$content .= '</div>';
		}
	}
	
	$content .= '</td>';
	echo $content;
	
}


/***************************************************************
 * Form validator
 ***************************************************************/
function wppic_validate($input) {
	if( isset( $input['list'] ) && !empty( $input['list'] ) ){
		
		$validationList = array();
		$validationList = apply_filters( 'wppic_add_list_valdiation', $validationList );
		
		foreach($validationList as $element){		
			if( isset( $input[ $element[0] ] ) && !empty( $input[ $element[0] ] ) ){
				
				//remove duplicate 
				$input[ $element[0] ] = array_unique( $input[ $element[0] ] );
		
				foreach( $input[ $element[0] ] as $key => $item ){
					if( !preg_match( $element[2], $item ) ) {
						if( !empty ( $item ) ){
							add_settings_error(
								'wppic-admin-notice',
								'',
								'<i>"' . $item . '"</i> ' . $element[1],
								'error'
							);
						}
						unset( $input[ $element[0] ][ $key ]);
					}
				}
				
			}
		}
	}
	return $input;
}


/***************************************************************
 * About section
 ***************************************************************/
function wppic_plugins_about() {
	$content ='
		<div id="wppic-about-list">
			<a class="wppic-button wppic-pluginHome" href="http://b-website.com/wp-plugin-info-card-for-wordpress" target="_blank">' . __( 'Plugin homepage', 'wppic-translate' ) . '</a>
			<a class="wppic-button wppic-pluginOther" href="http://b-website.com/category/plugins" target="_blank">' . __( 'More plugins by b*web', 'wppic-translate' ) . '</a>
			<a class="wppic-button wppic-pluginPage" href="https://wordpress.org/plugins/wp-plugin-info-card/" target="_blank">WordPress.org</a>
			<a class="wppic-button wppic-pluginSupport" href="https://wordpress.org/support/plugin/wp-plugin-info-card" target="_blank">' . __( 'Support', 'wppic-translate' ) . '</a>
			<a class="wppic-button wppic-pluginRate" href="https://wordpress.org/support/view/plugin-reviews/wp-plugin-info-card?rate=5#postform" target="_blank">' . __( 'Give me five!', 'wppic-translate' ) . '</a>
			<a class="wppic-button wppic-pluginContact" href="http://b-website.com/contact" target="_blank">' . __( 'Any suggestion?', 'wppic-translate' ) . '</a>
			<a class="wppic-button wppic-pluginDonate" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=7Z6YVM63739Y8" target="_blank">' . __( 'Donate', 'wppic-translate' ) . '</a>
		</div>
	';
	return $content;
}


/***************************************************************
 * Clear plugin transients with ajax
 ***************************************************************/
function wppic_clear_cache() {
	wppic_delete_transients();
}
add_action( 'wp_ajax_async_wppic_clear_cache', 'wppic_clear_cache' );