<?php

class wp_cards_jumbotron_banner_widget extends WP_Widget {
	public static $classname = __CLASS__;
	
	public function __construct() {
		parent::__construct( __CLASS__, 'Card - Jumbotron Banner', array(
			'description' => 'A page banner jumbotron for full width "sidebars".',
			'classname'   => self::$classname
		) );
	}

	public function widget( $args, $params ) {
		extract( $params );

		if ( ! empty ( $args['before_widget'] ) ) {
			echo $args['before_widget'];
		}
		
		?>
		<!-- Main jumbotron for a primary marketing message or call to action -->
		<div class="jumbotron banner-jumbotron<?php echo ( $reverse_text ? ' dark' : '' ); echo ( $fixed_background ? ' fixed-background' : '' ); ?>" style="background-image:url('<?php echo $background_image_url; ?>'); height:<?php echo $height; ?>">
			<div class="container">
				<h1><?php echo $title; ?></h1>
				<p><?php echo $text; ?></p>
				<div class="btn-toolbar"><a href="<?php echo $link_url; ?>" class="btn btn-primary btn-lg" role="button"><?php echo $link_text; ?> &raquo;</a></div>
			</div>
		</div>
		<?php

		if ( ! empty ( $args['after_widget'] ) ) {
			echo $args['after_widget'];
		}
	}
	
	public function form( $instance ) {
		global $wpdb;
		$background_img = plugins_url( 'wp-cards/includes/images/maria_carrasco_rodriguez.jpg' );
		
		$defaults = array(
			'title'                => 'Big Title',
			'text'                 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat...',
			'link_url'             => 'http://example.com/',
			'link_text'            => __( 'Continue Reading', 'wp-cards' ),
			'background_image_url' => $background_img,
			'fixed_background'     => true,
			'reverse_text'         => true,
			'height'               => 'auto'
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
                
?>
<p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title' ); ?>:</label> 
	<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Text' ); ?>:</label>
	<textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $instance['text']; ?></textarea>
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'link_url' ); ?>"><?php _e( 'Link URL' ); ?>:</label> 
	<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'link_url' ); ?>" name="<?php echo $this->get_field_name( 'link_url' ); ?>" value="<?php echo $instance['link_url']; ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'link_text' ); ?>"><?php _e( 'Link Text' ); ?>:</label> 
	<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'link_text' ); ?>" name="<?php echo $this->get_field_name( 'link_text' ); ?>" value="<?php echo $instance['link_text']; ?>" />
</p>
<p>
	<input class="checkbox" type="checkbox" <?php checked( (bool) $instance['reverse_text'], true ); ?> name="<?php echo $this->get_field_name( 'reverse_text' ); ?>" id="<?php echo $this->get_field_id( 'reverse_text' ); ?>">
	<label for="<?php echo $this->get_field_id( 'reverse_text' ); ?>"><?php _e( 'Reverse Text' ); ?></label>
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'background_image_url' ); ?>"><?php _e( 'Background Image URL' ); ?>:</label> 
	<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'background_image_url' ); ?>" name="<?php echo $this->get_field_name( 'background_image_url' ); ?>" value="<?php echo $instance['background_image_url']; ?>" />
</p>
<p>
	<input class="checkbox" type="checkbox" <?php checked( (bool) $instance['fixed_background'], true ); ?> name="<?php echo $this->get_field_name( 'fixed_background' ); ?>" id="<?php echo $this->get_field_id( 'fixed_background' ); ?>">
	<label for="<?php echo $this->get_field_id( 'fixed_background' ); ?>"><?php _e( 'Fixed Background Image' ); ?></label>
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e( 'Height' ); ?>:</label> 
	<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" value="<?php echo $instance['height']; ?>" />
</p>
<?php 
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['text'] = $new_instance['text'];
		$instance['link_url'] = strip_tags( $new_instance['link_url'] );
		$instance['link_text'] = strip_tags( $new_instance['link_text'] );
		$instance['reverse_text'] = strip_tags( $new_instance['reverse_text'] );
		$instance['background_image_url'] = strip_tags( $new_instance['background_image_url'] );
		$instance['fixed_background'] = strip_tags( $new_instance['fixed_background'] );
		$instance['height'] = strip_tags( $new_instance['height'] );

		return $instance;  
	}
}

?>