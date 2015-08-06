<?php

class wp_cards_multi_view_widget extends WP_Widget {
	public static $classname = __CLASS__;
	
	public function __construct() {
		parent::__construct( __CLASS__, 'Card - Multi View', array(
			'description' => 'A multi-view customizable layout card for full width "sidebars".',
			'classname'   => self::$classname
		) );
	}

	public function widget( $args, $params ) {
		extract( $params );

		wp_cards_set_view( $template );

		// Figure out the current page
		if ( get_query_var('paged') )
			$page = get_query_var('paged');
		elseif ( get_query_var('page') )
			$page = get_query_var('page');
		else
			$page = 1;

		// Create a new query instance
		$query_args = array(
			'page'             => $page,
			'posts_per_page'   => $posts_per_page,
			'suppress_filters' => true,
			'post_type'        => $post_type,
			'offset'           => $offset,
			'orderby'          => $sort_field
		);

		if ( 'meta_field' == $sort_field && ! empty( $meta_sort_field ) ) {
			$query_args[ 'orderby' ]  = 'meta_value';
			$query_args[ 'meta_key' ] = $meta_sort_field;
			//$query_args[ 'meta_query' ] = array();			
		} else {
			$query_args[ 'orderby' ] = $sort_field;
		}

		$include_arr = array();

		if ( ! empty( $include ) ) {
			foreach ( $include as $key => $value ) {
				if ( 'on' === $value ) {
					$include_arr[] = $key;
				}
			}
		}

		if ( ! empty( $include_arr ) ) {
			$tax_query[] = array(
				'taxonomy' => $taxonomy,
				'field'    => 'id',
				'terms'    => $include_arr
			);
			$query_args['tax_query'] = $tax_query;
		}

		wp_cards_query( $query_args );
		global $wp_query;
		//echo '<pre>'; print_r($wp_query); echo '</pre>';
		
		if ( ! empty ( $args['before_widget'] ) ) {
			echo $args['before_widget'];
		}
		
		if ( current_user_can( 'manage_options' ) && 'on' === $debug_query ) {
			echo '<h3>Query Vars:</h3><pre>'; print_r($wp_query->query); echo '</pre>';
			echo '<h3>Request:</h3><pre>'; print_r($wp_query->request); echo '</pre>';
		}
	
		if ( current_user_can( 'manage_options' ) && 'on' === $debug_results ) {
			echo '<h3>Results:</h3><pre>'; print_r($wp_query->posts); echo '</pre>';
		}

		?>
		<div class="section content bg-base">
			<h2 class="section-title ribbon"><span><?php echo $title; ?></span></h2>
			<div class="entries row <?php echo $template; ?>-view">
				<?php
					$args = array(
						'view' => $template
					);
					wp_cards_loop( $args );
					
					// Reset Post Data
					wp_cards_reset_query();
				?>
			</div><!-- /.row.entries. -->
		</div><!--.section.content-->
		<?php

		if ( ! empty ( $args['after_widget'] ) ) {
			echo $args['after_widget'];
		}
	}
	
	public function form( $instance ) {
		global $wpdb;

		$defaults = array(
			'title'          => __( 'Recent Posts', 'wp-cards' ),
			'posts_per_page' => '12',
			'template'       => 'list',
			'post_type'      => 'post',
			'taxonomy'       => 'category',
			'sort_field'     => 'date',
			'sort_direction' => 'DESC',
			'offset'         => '0',
			'debug_query'    => '',
			'debug_results'  => ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
                
?>
<p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'wp-cards' ); ?>:</label> 
	<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'posts_per_page' ); ?>"><?php _e( 'Number of Posts', 'wp-cards' ); ?>:</label> 
	<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'posts_per_page' ); ?>" name="<?php echo $this->get_field_name( 'posts_per_page' ); ?>" value="<?php echo $instance['posts_per_page']; ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'template' ); ?>"><?php _e( 'View Template', 'wp-cards' ); ?>:</label>
	<select name="<?php echo $this->get_field_name( 'template' ); ?>" id="<?php echo $this->get_field_id( 'template' ); ?>" class="postform">
		<?php 
		$templates = array( 
			'list'       => 'List', 
			'grid'       => 'Grid', 
			'tile'       => 'Tile',
			'mini'       => 'Mini',
			'spotlight'  => 'Spotlight',
			'image'      => 'Image'
			/*, 
			'banner'     => 'Banner', 
			'featurette' => 'Featurette'
			*/
		);

		foreach ( $templates as $temp_key => $temp_val ) : ?>
			<option class="level-0" value="<?php echo $temp_key; ?>" <?php echo ( $instance['template'] == $temp_key ) ? ' selected="selected"' : ''; ?>><?php echo $temp_val; ?></option>
		<?php endforeach; ?>
	</select>
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
	<label for="<?php echo $this->get_field_id( 'taxonomy' ); ?>"><?php _e( 'Taxonomy Slug', 'wp-cards' ); ?>:</label> 
	<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'taxonomy' ); ?>" name="<?php echo $this->get_field_name( 'taxonomy' ); ?>" value="<?php echo $instance['taxonomy']; ?>" />
</p>
<p>
	<label><?php _e( 'Include', 'wp-cards' ); ?> <?php echo ucwords(str_replace(array("_","-"), " ", $instance['taxonomy'])); ?>:</label>
</p>
<?php 
	$uncategorized_id = get_cat_ID( 'Uncategorized' );

	$cat_args = array(
		'type'            => 'post',
		'order'           => 'ASC',
		'orderby'         => 'name',
		'parent'          => 0,
		'hide_empty'      => 1,
		'hierarchical'    => 0,
		'meta_sort_field' => '',
		'taxonomy'        => strtolower( $instance['taxonomy'] ),
		'exclude'         => $uncategorized_id
	);

	$categories = get_categories( $cat_args );
	foreach( $categories as $category ) : ?>
		<p><input class="checkbox" type="checkbox" <?php checked( (bool) $instance['include'][$category->term_id], true ); ?> name="<?php echo $this->get_field_name( 'include' ); ?>[<?php echo $category->term_id; ?>]"><?php echo $category->cat_name; ?></p>
	<?php endforeach; ?>
<p>
	<label for="<?php echo $this->get_field_id( 'sort_field' ); ?>"><?php _e( 'Sort Field', 'wp-cards' ); ?>:</label>
	<select name="<?php echo $this->get_field_name( 'sort_field' ); ?>" id="<?php echo $this->get_field_id( 'sort_field' ); ?>" class="postform">
		<?php 
		$sort_field = array( 
			'date'       => __( 'Date', 'wp-cards' ), 
			'title'      => __( 'Title', 'wp-cards' ),
			'meta_field' => __( 'Use a custom meta field', 'wp-cards' )
		);

		foreach ( $sort_field as $sort_key => $sort_val ) : ?>
			<option class="level-0" value="<?php echo $sort_key; ?>" <?php echo ( $instance['sort_field'] == $sort_key ) ? ' selected="selected"' : ''; ?>><?php echo $sort_val; ?></option>
		<?php endforeach; ?>
	</select>
	<script type="text/javascript">
		jQuery(document).ready( function($) {
			$('#<?php echo $this->get_field_id( 'sort_field' ); ?>').live('change', function(e) {
				var selected_value = this[this.selectedIndex].value;
				var selected_container = $('#<?php echo $this->get_field_id( 'sort_field' ); ?>-input');
				if ( selected_value == 'meta_field' ) {
		    		selected_container.css('display','block');
				} else {
		    		selected_container.css('display','none');
				}
			});
		});
	</script>
</p>
<p id="<?php echo $this->get_field_id( 'sort_field' ); ?>-input" <?php echo ( $instance['sort_field'] != 'meta_field' ) ? ' style="display:none;"' : ''; ?>>
	<label for="<?php echo $this->get_field_id( 'meta_sort_field' ); ?>"><?php _e( 'Meta Sort Field', 'wp-cards' ); ?>:</label>
	<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'meta_sort_field' ); ?>" name="<?php echo $this->get_field_name( 'meta_sort_field' ); ?>" value="<?php echo $instance['meta_sort_field']; ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'sort_direction' ); ?>"><?php _e( 'Sort Direction', 'wp-cards' ); ?>:</label> 
	<select name="<?php echo $this->get_field_name( 'sort_direction' ); ?>" id="<?php echo $this->get_field_id( 'sort_direction' ); ?>" class="postform">
		<?php 
		$sort_dir = array( 
			'ASC'       => __( 'Ascending', 'wp-cards' ), 
			'DESC'      => __( 'Descending', 'wp-cards' )
		);

		foreach ( $sort_dir as $sort_key => $sort_val ) : ?>
			<option class="level-0" value="<?php echo $sort_key; ?>" <?php echo ( $instance['sort_direction'] == $sort_key ) ? ' selected="selected"' : ''; ?>><?php echo $sort_val; ?></option>
		<?php endforeach; ?>
	</select>
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'offset' ); ?>"><?php _e( 'Query Offset', 'wp-cards' ); ?>:</label> 
	<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'offset' ); ?>" name="<?php echo $this->get_field_name( 'offset' ); ?>" value="<?php echo $instance['offset']; ?>" />
</p>
<?php if ( current_user_can( 'manage_options' ) ) : ?>
<h3><?php _e( 'Debug', 'wp-cards' ); ?></h3>
<p><small><?php _e( 'Logged in admin users will be able to see output on the screen for debugging purposes.', 'wp-cards' ); ?></small></p>
<p>
	<input class="checkbox" type="checkbox" <?php checked( (bool) $instance['debug_query'], true ); ?> name="<?php echo $this->get_field_name( 'debug_query' ); ?>" id="<?php echo $this->get_field_id( 'debug_query' ); ?>">
	<label for="<?php echo $this->get_field_id( 'debug_query' ); ?>"><?php _e( 'Show the query' ); ?></label>
</p>
<p>
	<input class="checkbox" type="checkbox" <?php checked( (bool) $instance['debug_results'], true ); ?> name="<?php echo $this->get_field_name( 'debug_results' ); ?>" id="<?php echo $this->get_field_id( 'debug_results' ); ?>">
	<label for="<?php echo $this->get_field_id( 'debug_results' ); ?>"><?php _e( 'Show the query results' ); ?></label>
</p>
<?php endif;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['posts_per_page'] = strip_tags( $new_instance['posts_per_page'] );
		$instance['template'] = strip_tags( $new_instance['template'] );
		$instance['post_type'] = strip_tags( $new_instance['post_type'] );
		$instance['taxonomy'] = strip_tags( $new_instance['taxonomy'] );
		$instance['sort_field'] = strip_tags( $new_instance['sort_field'] );
		$instance['sort_direction'] = strip_tags( $new_instance['sort_direction'] );
		$instance['meta_sort_field'] = strip_tags( $new_instance['meta_sort_field'] );
		$instance['offset'] = strip_tags( $new_instance['offset'] );
		$instance['debug_query'] = strip_tags( $new_instance['debug_query'] );
		$instance['debug_results'] = strip_tags( $new_instance['debug_results'] );
		$uncategorized_id = get_cat_ID( 'Uncategorized' );

		$cat_args = array(
			'type'         => 'post',
			'order'        => 'ASC',
			'orderby'      => 'name',
			'parent'       => 0,
			'hide_empty'   => 1,
			'hierarchical' => 0,
			'taxonomy'     => strtolower( $instance['taxonomy'] ),
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