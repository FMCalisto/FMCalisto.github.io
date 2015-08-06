<?php

class wp_cards_jumbotron_search_widget extends WP_Widget {
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
		parent::__construct( __CLASS__, 'Card - Jumbotron for Search', array(
			'description' => 'A search jumbotron for full width "sidebars".',
			'classname'   => self::$classname
		) );
	}

	public function widget( $args, $params ) {
		$exit_widget = true;
		extract( $params );
		
		if ( ! empty ( $args['before_widget'] ) ) {
			echo $args['before_widget'];
		}
		
		$search_value = ( isset( $_GET[ 's' ] ) ? ' value="' . $_GET[ 's' ] . '"' : '' );
		$fixed_background = wp_cards_boolean( $fixed_background, true );

		?>
		<!-- Main jumbotron for the search -->
		<div class="jumbotron search-jumbotron<?php echo ( $fixed_background ? ' fixed-background' : '' ); ?>" style="background-image:url('<?php echo $image_url; ?>'); min-height:<?php echo $height; ?>">
			<div class="container">
				<h1><?php echo $title; ?></h1>
				<p><?php echo $text; ?></p>
				<div class="full-search-bar">
					<form class="form-inline search-form" name="searchform-jumbo" name="searchform" action="<?php bloginfo('url') ?>" method="get" role="search">
						<input class="xlarge" id="s-jumbo" name="s" type="text" placeholder="<?php echo $search_text; ?>"<?php echo $search_value; ?>>
						<button class="btn btn-large btn-primary" id="searchsubmit-jumbo" type="submit"><span class="glyphicon glyphicon-search"></span></button>
					</form>
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
		$background_img = plugins_url( 'wp-cards/includes/images/afroz_nawaf.jpg' );
		
		$defaults = array(
			'title'            => __( 'Search our Website', 'wp-cards' ),
			'text'             => __( "Find what you are looking for by performing a keyword search of our website", 'wp-cards' ),
			'search_text'      => __( 'Type a question or keyword here...', 'wp-cards' ),
			'image_url'        => $background_img,
			'fixed_background' => true,
			'height'           => '350px'
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
	<label for="<?php echo $this->get_field_id( 'search_text' ); ?>"><?php _e( 'Search Box Placeholder Text', 'wp-cards' ); ?>:</label> 
	<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'search_text' ); ?>" name="<?php echo $this->get_field_name( 'search_text' ); ?>" value="<?php echo $instance['search_text']; ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'image_url' ); ?>"><?php _e( 'Background Image URL', 'wp-cards' ); ?>:</label> 
	<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'image_url' ); ?>" name="<?php echo $this->get_field_name( 'image_url' ); ?>" value="<?php echo $instance['image_url']; ?>" />
</p>
<p>
	<input class="checkbox" type="checkbox" <?php checked( (bool) $instance['fixed_background'], true ); ?> name="<?php echo $this->get_field_name( 'fixed_background' ); ?>" id="<?php echo $this->get_field_id( 'fixed_background' ); ?>">
	<label for="<?php echo $this->get_field_id( 'fixed_background' ); ?>"><?php _e( 'Fixed Background Image', 'wp-cards' ); ?></label>
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e( 'Min Height', 'wp-cards' ); ?>:</label> 
	<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" value="<?php echo $instance['height']; ?>" />
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
		$instance['search_text'] = strip_tags( $new_instance['search_text'] );
		$instance['image_url'] = strip_tags( $new_instance['image_url'] );
		$instance['height'] = strip_tags( $new_instance['height'] );

		return $instance;  
	}
}

?>