<?php

class wp_cards_jumbotron_register_widget extends WP_Widget {
	public static $classname = __CLASS__;
	private $pages = array(
		'is_404'               => '404 Page',
		'is_archive'           => 'Archive Page',
		'is_author'            => 'Author Page',
		'is_category'          => 'Category Page',
		'is_front_page'        => 'Front Page',
		'is_home'              => 'Home Page',
		'is_page'              => 'Page',
		'is_post_type_archive' => 'Custom Post Type Archive',
		'is_search'            => 'Search Page',
		'is_single'            => 'Single Post or Page',
		'is_tag'               => 'Tags Page',
		'is_tax'               => 'Custom Taxonomy Page'
	);
	
	public function __construct() {
		parent::__construct( __CLASS__, 'Card - Jumbotron for Registration', array(
			'description' => 'A user registration jumbotron for full width "sidebars".',
			'classname'   => self::$classname
		) );
	}

	public function widget( $args, $params ) {
		$exit_widget = true;
		if ( is_user_logged_in() ) {
			// Don't need to register the user, they are logged in.
			return;
		}
		extract( $params );

		if ( ! empty ( $args['before_widget'] ) ) {
			echo $args['before_widget'];
		}

		$fixed_background = wp_cards_boolean( $fixed_background, true );

		if ( ! empty( $css ) ) : ?>
		<style type="text/css">
			<?php echo $css; ?>
		</style>
		<?php endif; ?>
		<!-- Main jumbotron for registration -->
		<div class="jumbotron register-jumbotron<?php echo ( $fixed_background ? ' fixed-background' : '' ); ?>" style="background-image:url('<?php echo $background_image_url; ?>'); height:<?php echo $height; ?>">		
			<div class="container">
				<div class="row">
					<div class="col register-block col-xs-12 col-sm-7 col-md-6">
						<h1><?php echo $title; ?></h1>
						<p><?php echo $text; ?></p>
						<form action="<?php echo site_url('wp-login.php?action=register', 'login_post') ?>" method="post" role="form">
							<div class="row">
								<div class="col col-xs-12 col-sm-6 col-md-6">
									<div class="form-group">
				                        <input type="text" name="first_name" id="first_name" class="form-control input-lg" placeholder="<?php _e( 'First Name', 'wp-cards' ); ?>" tabindex="1">
									</div>
								</div>
								<div class="col col-xs-12 col-sm-6 col-md-6">
									<div class="form-group">
										<input type="text" name="last_name" id="last_name" class="form-control input-lg" placeholder="<?php _e( 'Last Name', 'wp-cards' ); ?>" tabindex="2">
									</div>
								</div>
							</div>
							<div class="form-group">
								<input type="text" name="user_login" id="user_login" class="form-control input-lg" placeholder="<?php _e( 'Username', 'wp-cards' ); ?>" tabindex="3">
							</div>
							<div class="form-group">
								<input type="email" name="user_email" id="user_email" class="form-control input-lg" placeholder="<?php _e( 'Email Address', 'wp-cards' ); ?>" tabindex="4">
							</div>

							<?php if ( ! empty( $terms_link ) ) : ?>
							<div class="row">
								<div class="col col-xs-4 col-sm-3 col-md-3">
									<span class="checkbox">
        								<label for="agree"><input id="agree" name="agree" type="checkbox" value="y" /><?php _e( 'I Agree', 'wp-cards' ); ?></label>
									</span>
								</div>
								<div class="col col-xs-8 col-sm-9 col-md-9">
									 <p class="small"><?php printf( __( 'By clicking <label class="label label-primary" for="agree">Register</label>, you agree to the <a href="#" onclick="window.open(\'%s\', \'terms-and-conditions-dialog\', \'width=500,height=436\'); return false;">Terms and Conditions</a> set out by this site, including our Cookie Use.', 'wp-cards' ), $terms_link ); ?></p>
								</div>
							</div>
							<?php endif; ?>

							<?php do_action('register_form'); ?>

							<hr />
							<div class="row">
								<div class="col col-xs-12 col-md-6"><input type="submit" value="Register" id="register" class="btn btn-primary btn-block btn-lg" tabindex="7"></div>
								<div class="col col-xs-12 col-md-6"><a href="<?php echo wp_login_url( $login_redirect ); ?>" class="btn btn-success btn-block btn-lg"><?php _e( 'Sign In', 'wp-cards' ); ?></a></div>
							</div>
						</form>
						<p class="notice"><?php _e( 'A password will be e-mailed to you.', 'wp-cards' ); ?></p>
					</div>
					<?php if ( ! empty( $product_image_url ) ) : ?>
	                <div class="col col-xs-12 col-sm-5 col-md-6 pull-right">
						<img src="<?php echo $product_image_url; ?>" class="register-image img-responsive">
	                </div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php

		if ( ! empty ( $args['after_widget'] ) ) {
			echo $args['after_widget'];
		}
	}
	
	public function form( $instance ) {
		global $wpdb;
		$product_img = plugins_url( 'wp-cards/includes/images/imac.png' );
		$background_img = plugins_url( 'wp-cards/includes/images/maria_carrasco_rodriguez.jpg' );
		
		$defaults = array(
			'title'                => __( 'Sign-Up', 'wp-cards' ),
			'text'                 => __( "Register today to join the conversation", 'wp-cards' ),
			'product_image_url'    => $product_img,
			'background_image_url' => $background_img,
			'fixed_background'     => true,
			'height'               => 'auto',
			'terms_link'           => '',
			'css'                  => ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
                
?>
<p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'wp-cards' ); ?>:</label> 
	<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Text', 'wp-cards' ); ?>:</label>
	<textarea class="widefat" rows="2" cols="20" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $instance['text']; ?></textarea>
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'product_image_url' ); ?>"><?php _e( 'Product Image URL', 'wp-cards' ); ?>:</label> 
	<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'product_image_url' ); ?>" name="<?php echo $this->get_field_name( 'product_image_url' ); ?>" value="<?php echo $instance['product_image_url']; ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'background_image_url' ); ?>"><?php _e( 'Background Image URL', 'wp-cards' ); ?>:</label> 
	<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'background_image_url' ); ?>" name="<?php echo $this->get_field_name( 'background_image_url' ); ?>" value="<?php echo $instance['background_image_url']; ?>" />
</p>
<p>
	<input class="checkbox" type="checkbox" <?php checked( (bool) $instance['fixed_background'], true ); ?> name="<?php echo $this->get_field_name( 'fixed_background' ); ?>" id="<?php echo $this->get_field_id( 'fixed_background' ); ?>">
	<label for="<?php echo $this->get_field_id( 'fixed_background' ); ?>"><?php _e( 'Fixed Background Image', 'wp-cards' ); ?></label>
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e( 'Height', 'wp-cards' ); ?>:</label> 
	<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" value="<?php echo $instance['height']; ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'terms_link' ); ?>"><?php _e( 'Link to Terms & Conditions', 'wp-cards' ); ?>:</label> 
	<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'terms_link' ); ?>" name="<?php echo $this->get_field_name( 'terms_link' ); ?>" value="<?php echo $instance['terms_link']; ?>" />
	<p><?php _e( 'By having a "Terms and Conditions" link, an "I Accept" checkbox is added to the registration form.', 'wp-cards' ); ?></p>
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'css' ); ?>"><?php _e( 'Custom CSS', 'wp-cards' ); ?>:</label>
	<textarea class="widefat" rows="2" cols="20" id="<?php echo $this->get_field_id( 'css' ); ?>" name="<?php echo $this->get_field_name( 'css' ); ?>"><?php echo $instance['css']; ?></textarea>
</p>
<p>
	<label><?php _e( 'Show on Pages', 'wp-cards' ); ?>:</label>
</p>
<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$allowable = '<h1><h2><h3><h4><h5><h6><img><a><br><b><i><u><em><sub><sup><table><tr><td><th><dl><dt><dd><code><pre><center><div><span><p><font><ol><ul><li><q><s><strong><cite><embed><object><param><style><script>';

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['text'] = strip_tags( $new_instance['text'], $allowable );
		$instance['product_image_url'] = strip_tags( $new_instance['product_image_url'] );
		$instance['background_image_url'] = strip_tags( $new_instance['background_image_url'] );
		$instance['fixed_background'] = strip_tags( $new_instance['fixed_background'] );
		$instance['height'] = strip_tags( $new_instance['height'] );
		$instance['terms_link'] = strip_tags( $new_instance['terms_link'] );
		$instance['css'] = strip_tags( $new_instance['css'] );

		return $instance;
	}
}

?>