<?php
/**
 * This file holds all of the plugin options
 */

$wp_cards_plugin_options = array(
	'include_bootstrap_files'  => array(
		'type'    => 'checkbox',
		'id'      => 'wp_cards_include_bootstrap_files',
		'default' => 'disable'
	),
	'bootstrap_css_cdn'  => array(
		'type'    => 'text',
		'id'      => 'wp_cards_bootstrap_css_cdn',
		'default' => '//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css'
	),
	'bootstrap_js_cdn'  => array(
		'type'    => 'text',
		'id'      => 'wp_cards_bootstrap_js_cdn',
		'default' => '//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js'
	),
	'page_container_id'  => array(
		'type'    => 'text',
		'id'      => 'wp_cards_page_container_id',
		'default' => 'page-body'
	),
	'page_content_id'  => array(
		'type'    => 'text',
		'id'      => 'wp_cards_page_content_id',
		'default' => 'content'
	),
	'enable_jumbotron_cards'  => array(
		'type'    => 'checkbox',
		'id'      => 'wp_cards_enable_jumbotron_cards',
		'default' => 'enable'
	),
	'enable_header_footer_cards'  => array(
		'type'    => 'checkbox',
		'id'      => 'wp_cards_enable_header_footer_cards',
		'default' => 'enable'
	)
);

foreach ( $wp_cards_plugin_options as $key => $value ) {
	$option_value = null;

	if ( isset( $value['id'] ) ) {
		if ( ! $option_value = get_option( $value['id'] ) ) {
			if ( isset( $value['default'] ) )
				$option_value = $value['default'];
		}

		// Set the value
		$wp_cards_plugin_options[$key]['value'] = $option_value;
	}
}

function wp_cards_plugin_menu() {
	global $wp_cards_plugin_options;

	if ( function_exists( 'current_user_can' ) && ! current_user_can( 'manage_options' ) )
		return;
		//die(__('Cheatin&#8217; uh?'));

	if ( ! empty( $_REQUEST['page'] ) && esc_attr( $_REQUEST['page'] ) == 'wp_cards_options' ) {
		$postback_url = '/wp-admin/admin.php?page=' . esc_attr( $_REQUEST['page'] )
		              . '&on_' . esc_attr( $_REQUEST['action'] ) . '=true';

		if ( ! empty( $_REQUEST['action'] ) && 'save' == esc_attr( $_REQUEST['action'] ) ) {
			foreach ( $wp_cards_plugin_options as $key => $value ) {
				if ( ! empty( $value['type'] ) && 'checkbox' == $value['type'] ) {
					if ( isset( $_REQUEST[$value['id']] ) )
						update_option( $value['id'], 'enable' );
					else
						update_option( $value['id'], 'disable' );
				} else {
					if ( ! empty( $value['id'] ) && ! empty( $_REQUEST[$value['id']] ) )
						update_option( $value['id'], esc_attr( $_REQUEST[$value['id']] ) );
					elseif ( isset( $value['id'] ) )
						delete_option( $value['id'] );
				}
			}

			header( 'Location: ' . $postback_url );
			die;
		} elseif ( 'reset' == esc_attr( $_REQUEST['action'] ) ) {
			foreach ( $wp_cards_plugin_options as $key => $value ) {
				delete_option( $value['id'] );
			}

			header( 'Location: ' . $postback_url);
			die;
		}
	}

	add_options_page( 'WP-Cards Options', 'WP-Cards', 'manage_options', 'wp_cards_options', 'wp_cards_options_form' );
	// add_theme_page( 'WP-Cards Options', 'WP-Cards', 'edit_theme_options', basename(__FILE__), 'wp_cards_options_form' );
	// add_menu_page( 'WP-Cards', 'WP-Cards', 'manage_options', basename(__FILE__), 'wp_cards_options_form' );
}

function wp_cards_options_form() {
	global $wp_cards_plugin_options;
	extract($wp_cards_plugin_options);
	$current_page = esc_attr( $_GET['page'] );
?>
<div class="wrap">
	<div class="icon32" id="icon-themes"><br /></div>
	<h2><?php _e( 'WP Cards Plugin Options', 'wp-cards' ); ?></h2>
	<?php if ( !empty( $_REQUEST['on_save'] ) && esc_attr( $_REQUEST['on_save'] ) ) : ?>
	<div id="message" class="updated fade"><p><strong><?php _e( 'Plugin settings saved.', 'wp-cards' ); ?></strong></p></div>
	<?php endif; ?>
	<form method="post">
		<input type="hidden" name="action" value="save">
		<input type="hidden" name="page" value="<?php echo $current_page; ?>" id="current_module">
		<div id="edge-mode" class="updated fade">
			<h3>Bootstrap</h3>
			<p><?php _e( 'WP Cards uses the CSS and JavaScript files from Bootstrap for its responsive layout and rotating carousels.', 'wp-cards' ); ?></p>
		</div>
		<table class="form-table">
			<tr valign="top" class="checkbox">
				<th scope="row"><label for="wp_cards_include_bootstrap_files"><?php _e( 'Include Bootstrap files', 'wp-cards' ); ?></label></th>
				<td colspan="2">
					<input id="wp_cards_include_bootstrap_files"<?php echo ( 'enable' == $include_bootstrap_files['value'] ? ' checked="checked"' : '' ); ?> type="checkbox" name="wp_cards_include_bootstrap_files" value="<?php echo $include_bootstrap_files['value']; ?>">
					<label for="wp_cards_include_bootstrap_files"><?php _e( 'WP Cards can add Bootstrap to the theme, if the current theme already includes Bootstap, do not check this box.', 'wp-cards' ); ?></label>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="wp_cards_bootstrap_css_cdn"><?php _e( 'Bootstrap CDN Path for CSS', 'wp-cards' ); ?></label></th>
				<td>
					<input name="wp_cards_bootstrap_css_cdn" type="text" id="wp_cards_bootstrap_css_cdn" value="<?php echo $bootstrap_css_cdn['value']; ?>" class="regular-text code">
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="wp_cards_bootstrap_js_cdn"><?php _e( 'Bootstrap CDN Path for JS', 'wp-cards' ); ?></label></th>
				<td>
					<input name="wp_cards_bootstrap_js_cdn" type="text" id="wp_cards_bootstrap_js_cdn" value="<?php echo $bootstrap_js_cdn['value']; ?>" class="regular-text code">
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="wp_cards_page_container_id"><?php _e( 'CSS ID for page container', 'wp-cards' ); ?></label></th>
				<td>
					<input name="wp_cards_page_container_id" type="text" id="wp_cards_page_container_id" value="<?php echo $page_container_id['value']; ?>" class="regular-text">
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="wp_cards_page_content_id"><?php _e( 'CSS ID for page content', 'wp-cards' ); ?></label></th>
				<td>
					<input name="wp_cards_page_content_id" type="text" id="wp_cards_page_content_id" value="<?php echo $page_content_id['value']; ?>" class="regular-text">
				</td>
			</tr>
			<tr valign="top" class="checkbox">
				<th scope="row"><label for="wp_cards_enable_jumbotron_cards"><?php _e( 'Enable Jumbotron Cards', 'wp-cards' ); ?></label></th>
				<td colspan="2">
					<input id="wp_cards_enable_jumbotron_cards"<?php echo ( 'enable' == $enable_jumbotron_cards['value'] ? ' checked="checked"' : '' ); ?> type="checkbox" name="wp_cards_enable_jumbotron_cards" value="<?php echo $enable_jumbotron_cards['value']; ?>">
					<label for="wp_cards_enable_jumbotron_cards"><?php _e( 'WP Cards can add a Jumbotron Cards area to pages that use the WP Cards Template, this will also add the corresponding widget area to the website admin.', 'wp-cards' ); ?></label>
				</td>
			</tr>
			<tr valign="top" class="checkbox">
				<th scope="row"><label for="wp_cards_enable_header_footer_cards"><?php _e( 'Enable Header/Footer Cards', 'wp-cards' ); ?></label></th>
				<td colspan="2">
					<input id="wp_cards_enable_header_footer_cards"<?php echo ( 'enable' == $enable_header_footer_cards['value'] ? ' checked="checked"' : '' ); ?> type="checkbox" name="wp_cards_enable_header_footer_cards" value="<?php echo $enable_header_footer_cards['value']; ?>">
					<label for="wp_cards_enable_header_footer_cards"><?php _e( 'WP Cards can add header and footer card areas to pages that use the WP Cards Template, this will also add the corresponding widget areas to the website admin.', 'wp-cards' ); ?></label>
				</td>
			</tr>
		</table>
		<p class="submit"><input type="submit" name="Submit" value="<?php _e( 'Save Changes', 'wp-cards' ); ?>" class="button-primary"></p>
	</form>
</div>
<?php
}

?>