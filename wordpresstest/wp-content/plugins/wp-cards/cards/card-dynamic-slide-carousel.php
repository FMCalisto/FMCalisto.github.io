<?php

class wp_cards_dynamic_slide_carousel_widget extends WP_Widget {
	public static $classname = __CLASS__;
	
	public function __construct() {
		parent::__construct( __CLASS__, 'Card - Dynamic Slide Carousel', array(
			'description' => 'A dynamic slide carousel card that pulls slides in based on a selected post type and categories for full width "sidebars".',
			'classname'   => self::$classname
		) );
	}

	public function widget( $args, $params ) {
		$indicators = '';
		$slides = '';
		$slide_counter = 0;
		extract( $params );

		$include_arr = array();
		foreach ( $include as $key => $value ) {
			if ( 'on' === $value ) {
				$include_arr[] = $key;
			}
		}

		// Create a new query instance
		$query_args = array(
			'post_type'        => $post_type,
			'posts_per_page'   => $posts_per_page,
			'suppress_filters' => true,
			'meta_key'         => '_thumbnail_id'
		);
		
		if ( ! empty( $include_arr ) ) {
			$query_args[ 'category__in' ] = $include_arr;
		}

		kickpress_query( $query_args );

		// Start the Loop.
		while ( have_posts() ) {
			the_post();
			global $post;
			$active_class = ( 0 == $slide_counter ? ' class="active"' : '' );
			$active_slide = ( 0 == $slide_counter ? ' active' : '' );
			$indicators .= '<li data-target="#' . $args['widget_id'] . '" data-slide-to="' . $slide_counter . '"' . $active_class . '></li>';
			
			if ( $imgdata = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array('960','400') ) ) {
				$post_thumb = $imgdata[0];
			} else {
				$post_thumb = null;
			}

			// Get the excerpt
			if ( empty( $post->post_excerpt ) ) {
				$excerpt_args = array(
					'text'   => get_the_content(),
					'length' => $excerpt_length
				);
				$excerpt = wp_cards_the_excerpt( $excerpt_args );
			} else {
				$excerpt = $post->post_excerpt;
			}

			// Get the excerpt
			if ( ! empty( $read_more_override[ $slide_counter + 1 ] ) ) {
				$content_link = $read_more_override[ $slide_counter + 1 ];
			} elseif ( ! $content_link = get_post_meta( get_the_ID(), '_content_link', true ) ) {
				$content_link = get_permalink();
			}
			
			$slides .= '
		        <div class="item cover-image' . $active_slide . '" style="background-image:url(' . $post_thumb .');">
		          <div class="container">
		            <div class="carousel-caption">
		              <h1>' . $post->post_title . '</h1>
		              ' . wpautop( $excerpt ) . '
		              <p><a class="btn btn-lg btn-primary" href="' . $content_link . '" role="button">' . $read_more_text . '</a></p>
		            </div>
		          </div>
		        </div>';

			$slide_counter++;
		}

		// Reset Post Data
		kickpress_reset_query();
		
		if ( 0 == $slide_counter ) {
			return;
		}

		if ( ! empty ( $args['before_widget'] ) ) {
			echo $args['before_widget'];
		}
		
		?>
		<style type="text/css">
			<?php if ( ! empty( $height ) ) : ?>
			.maga-carousel, .maga-carousel .item, .maga-carousel .carousel-inner > .item {
				height: <?php echo $height; ?>;
			}
			<?php endif; ?>
			<?php if ( ! empty( $css ) ) : ?>
			<?php echo $css; ?>
			<?php endif; ?>
		</style>
	    <div id="<?php echo $args['widget_id']; ?>" class="maga-carousel carousel slide" data-ride="carousel">
			<!-- Indicators -->
			<?php if ( $slide_counter > 1 ) : ?>
			<ol class="carousel-indicators">
				<?php echo $indicators; ?>
			</ol>
			<?php endif; ?>
			<div class="carousel-inner">
				<?php echo $slides; ?>
			</div>
			<?php if ( $slide_counter > 1 ) : ?>
			<a class="left carousel-control" href="#<?php echo $args['widget_id']; ?>" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
			<a class="right carousel-control" href="#<?php echo $args['widget_id']; ?>" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
			<?php endif; ?>
		</div><!-- /.carousel -->
		<?php

		if ( ! empty ( $args['after_widget'] ) ) {
			echo $args['after_widget'];
		}
	}

	public function form( $instance ) {
		$defaults = array(
			'height'             => '500px',
			'post_type'          => 'post',
			'posts_per_page'     => '3',
			'read_more_text'     => __( 'Continue Reading', 'odbm-base' ),
			'excerpt_length'     => '30',
			'css'                => ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
?>
<p><small><?php _e( 'Suggestion: Create a custom post type called "banners" and assign it a custom meta field called "_content_link" and specify that this carousel use the "banners" custom post type.  This carousel will look for "_content_link" and, if it exists, automatically assign that url to the "Continue Reading" button.  Otherwise, you can use the "Read More Overrides" to override the default links.', 'wp-cards' ); ?></small></p>
<p>
	<label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e( 'Slider Min Height', 'wp-cards' ); ?>:</label> 
	<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" value="<?php echo $instance['height']; ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'excerpt_length' ); ?>"><?php _e( 'Excerpt Length (optional)', 'wp-cards' ); ?>:</label> 
	<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'excerpt_length' ); ?>" name="<?php echo $this->get_field_name( 'excerpt_length' ); ?>" value="<?php echo $instance['excerpt_length']; ?>" />
	<br>
	<small><?php _e( 'This carousel defaults to using the full excerpt field value. If one does not exist, the post content will be truncated to the length specified here.', 'wp-cards' ); ?></small>
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'post_type' ); ?>"><?php _e( 'Post Type' ); ?>:</label> 
	<select id="<?php echo $this->get_field_id( 'post_type' ); ?>" name="<?php echo $this->get_field_name( 'post_type' ); ?>">
		<option value="post"<?php echo 'post' == $instance['post_type'] ? ' selected="selected"' : ''; ?>><?php _e( 'Post' ); ?></option>
	<?php foreach ( (array) get_post_types( array('show_ui' => true, '_builtin' => false ) ) as $post_type ) :
		$selected = $instance['post_type'] == $post_type ? ' selected="selected"' : ''; ?>
		<option value="<?php echo $post_type; ?>"<?php echo $selected; ?>><?php echo ucwords(str_replace(array("_","-"), " ", $post_type)); ?></option>
	<?php endforeach; ?>
	</select>
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'posts_per_page' ); ?>"><?php _e( 'Post Count', 'wp-cards' ); ?>:</label> 
	<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'posts_per_page' ); ?>" name="<?php echo $this->get_field_name( 'posts_per_page' ); ?>" value="<?php echo $instance['posts_per_page']; ?>" />
	<br>
	<small><?php _e( 'Click "Save" to update the number of "Read More Overrides" listed bellow.', 'wp-cards' ); ?></small>
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'post_type' ); ?>"><?php _e( 'Post Type' ); ?>:</label> 
	<select id="<?php echo $this->get_field_id( 'post_type' ); ?>" name="<?php echo $this->get_field_name( 'post_type' ); ?>">
		<option value="post"<?php echo 'post' == $instance['post_type'] ? ' selected="selected"' : ''; ?>><?php _e( 'Post' ); ?></option>
	<?php foreach ( (array) get_post_types( array('show_ui' => true, '_builtin' => false ) ) as $post_type ) :
		$selected = $instance['post_type'] == $post_type ? ' selected="selected"' : ''; ?>
		<option value="<?php echo $post_type; ?>"<?php echo $selected; ?>><?php echo ucwords(str_replace(array("_","-"), " ", $post_type)); ?></option>
	<?php endforeach; ?>
	</select>
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'read_more_text' ); ?>"><?php _e( 'Read More Text', 'wp-cards' ); ?>:</label> 
	<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'read_more_text' ); ?>" name="<?php echo $this->get_field_name( 'read_more_text' ); ?>" value="<?php echo $instance['read_more_text']; ?>" />
</p>
<p>
	<label><?php _e( 'Read More Overrides', 'wp-cards' ); ?>:</label>
	<?php $i = 1; while ( $i <= $instance['posts_per_page'] ) : ?>
	<br><?php _e( 'Slide', 'wp-cards' ); ?> <?php echo $i; ?> <?php _e( '(optional)', 'wp-cards' ); ?>: <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'read_more_override' ); ?>_<?php echo $i; ?>" name="<?php echo $this->get_field_name( 'read_more_override' ); ?>[<?php echo $i; ?>]" value="<?php echo $instance['read_more_override'][$i]; ?>" />
	<?php $i++; endwhile; ?>
	<br>
	<small><?php _e( 'Override the url desination on the "Continue Reading" links for any slide.', 'wp-cards' ); ?></small>
</p>
<p>
	<label><?php _e( 'Include Categories', 'wp-cards' ); ?>:</label>
<?php 
	$uncategorized_id = get_cat_ID( 'Uncategorized' );

	$cat_args = array(
		'type'         => 'post',
		'order'        => 'ASC',
		'orderby'      => 'name',
		'parent'       => 0,
		'hide_empty'   => 1,
		'hierarchical' => 0,
		'taxonomy'     => 'category',
		'exclude'      => $uncategorized_id
	);

	$categories = get_categories( $cat_args );
	foreach( $categories as $category ) : ?>
		<br><input class="checkbox" type="checkbox" <?php checked( (bool) $instance['include'][$category->term_id], true ); ?> name="<?php echo $this->get_field_name( 'include' ); ?>[<?php echo $category->term_id; ?>]"><?php echo $category->cat_name; ?>
	<?php endforeach; ?>
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'css' ); ?>"><?php _e( 'Custom CSS', 'wp-cards' ); ?>:</label>
	<textarea class="widefat" rows="2" cols="20" id="<?php echo $this->get_field_id( 'css' ); ?>" name="<?php echo $this->get_field_name( 'css' ); ?>"><?php echo $instance['css']; ?></textarea>
</p>
	<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['height'] = strip_tags( $new_instance['height'] );
		$instance['excerpt_length'] = strip_tags( $new_instance['excerpt_length'] );
		$instance['post_type'] = strip_tags( $new_instance['post_type'] );
		$instance['posts_per_page'] = strip_tags( $new_instance['posts_per_page'] );
		$instance['read_more_text'] = strip_tags( $new_instance['read_more_text'] );
		$instance['css'] = strip_tags( $new_instance['css'] );
		$instance['read_more_override'] = array();

		foreach( $new_instance['read_more_override'] as $override_key => $override_value ) {
			if ( ! empty ( $new_instance['read_more_override'][ $override_key ] ) ) {
				$instance['read_more_override'][ $override_key ] = strip_tags( $new_instance['read_more_override'][ $override_key ] );
			} else {
				$instance['read_more_override'][ $override_key ] = '';
			}
		}

		$uncategorized_id = get_cat_ID( 'Uncategorized' );

		$cat_args = array(
			'type'         => 'post',
			'order'        => 'ASC',
			'orderby'      => 'name',
			'parent'       => 0,
			'hide_empty'   => 1,
			'hierarchical' => 0,
			'taxonomy'     => 'category',
			'exclude'      => $uncategorized_id
		);

		$categories = get_categories( $cat_args );
		foreach( $categories as $category ) {
			// $instance['include'][ $category->term_id ] = ( 'on' == $new_instance['include'][ $category->term_id ] ) ? 'yes' : 'no';
			if ( isset( $new_instance['include'][ $category->term_id ] ) ) {
				$instance['include'][ $category->term_id ] = strip_tags( $new_instance['include'][ $category->term_id ] );
			} else {
				$instance['include'][ $category->term_id ] = 0;
			}
		}

		return $instance;
	}
}

?>