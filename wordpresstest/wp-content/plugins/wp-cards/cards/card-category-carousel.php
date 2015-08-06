<?php

class wp_cards_category_carousel_widget extends WP_Widget {
	public static $classname = __CLASS__;
	
	public function __construct() {
		parent::__construct( __CLASS__, 'Card - Category Carousel', array(
			'description' => 'A category carousel card for full width "sidebars" (only shows top level categories).',
			'classname'   => self::$classname
		) );
	}

	public function widget( $args, $params ) {
		extract( $params );

		$cat_args = array(
			'type'         => $post_type,
			'order'        => 'ASC',
			'parent'       => 0,
			'hide_empty'   => 1,
			'hierarchical' => 0,
			'taxonomy'     => strtolower( $taxonomy )
		);

		$include_arr = array();
		if ( is_single() && 'on' == $context_aware_taxonomy ) {
			global $post;
			if ( $local_terms = wp_get_post_terms( $post->ID, $taxonomy ) ) {
				foreach ( $local_terms as $term_key => $term_value ) {
					$include_arr[] = $term_value->term_id;
				}
			} else {
				// Let the admin know nothing was found and don't output the widget
				//return;
			}
		} else {
			if ( count( $include ) ) {
				foreach ( $include as $key => $value ) {
					if ( 'on' === $value ) {
						$include_arr[] = $key;
					}
				}
			}
		}

		if ( ! empty( $include_arr ) ) {
			$cat_args['include'] = implode(',', $include_arr);
		}

		// Grab the categories from the database
		$categories = get_categories( $cat_args );

		$first_slide = true;
		$pages = ceil( $posts_per_page / $posts_per_slide );

		// Begin outputting the widget HTML
		if ( ! empty ( $args['before_widget'] ) ) {
			echo $args['before_widget'];
		}

		?>
		<style type="text/css">
			#<?php echo $args['widget_id']; ?> .load-more-toolbar { display:none; }
			<?php echo $custom_css; ?>
		</style>

		<div id="<?php echo $args['widget_id']; ?>" class="section carousel category-carousel slide <?php echo ( ! empty( $custom_class ) ) ? $custom_class : '' ?>">
			<div class="carousel-inner">
			<?php foreach ( $categories as $category ) :
				$current_page = 1;
				
				while( $current_page <= $pages ) :

					$offset = intval( ( $current_page - 1 ) * $posts_per_slide );
					$number_of_posts = $current_page == $pages ? $posts_per_page - $offset : $posts_per_slide;
					//echo '<pre>';print_r($number_of_posts);echo '</pre>';
					// Create a new query instance
					/*'category__in'     => array( $category->term_id ),*/
					$query_args = array(
						'post_type'        => $post_type,
						'posts_per_page'   => $number_of_posts,
						'suppress_filters' => true,
						'offset'           => $offset,
						'tax_query'        => array(
							array(
								'taxonomy'   => strtolower( $taxonomy ),
								'field'      => 'term_id',
								'terms'      => $category->term_id,
								'operator'   => 'IN'
							)
						)
					);
					wp_cards_query( $query_args );
					global $wp_query;
					
					if ( $wp_query->found_posts ) : 
						if ( $first_slide ) {
							$active_class = ' active';
							$first_slide = false;
						} else {
							$active_class = '';
						}
					?>
				<div class="item<?php echo $active_class; ?> <?php echo $category->slug; ?>">
					<?php
					if ( current_user_can( 'manage_options' ) && 'on' === $debug_query ) {
						echo '<h3>Query Vars:</h3><pre>'; print_r($wp_query->query); echo '</pre>';
						echo '<h3>Request:</h3><pre>'; print_r($wp_query->request); echo '</pre>';
					}
					
					if ( current_user_can( 'manage_options' ) && 'on' === $debug_results ) {
						echo '<h3>Results:</h3><pre>'; print_r($wp_query->posts); echo '</pre>';
					}
					?>
					<h2 class="section-title ribbon ribbon-highlight"><a href="<?php echo get_term_link( $category, $taxonomy ); ?>"><?php _e( $category->cat_name ); ?></a></h2>
					<?php if ( 'on' === $enable_view_all ) : ?>
					<div class="category-view-all"><a href="<?php echo get_term_link( $category, $taxonomy ); ?>"><?php _e( $view_all_text ); ?></a></div>
					<?php endif; ?>
					<div class="entries row <?php echo $template; ?>-view">
						<?php wp_cards_loop( array( 'view' => $template ) ); ?>
						<div class="clearfix"></div>
					</div><!--/.row.entries-->
				</div><!--/.item-->
					<?php elseif ( current_user_can( 'manage_options' ) && 'on' === $debug_query ) : ?>
						<h3>No results for: </h3><pre><?php print_r($wp_query->query); ?></pre>
					<?php endif;

					// Reset Post Data
					wp_cards_reset_query();

					$current_page++; 
				endwhile; // End current_page
			endforeach; // End category foreach
			?>
			</div><!--/.carousel-inner-->
			<a class="left carousel-control" href="#<?php echo $args['widget_id']; ?>" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left"></span>
			</a>
			<a class="right carousel-control" href="#<?php echo $args['widget_id']; ?>" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right"></span>
			</a>
		</div><!-- /#<?php echo $args['widget_id']; ?> -->
		<?php

		if ( ! empty ( $args['after_widget'] ) ) {
			echo $args['after_widget'];
		}
	}
	
	public function form( $instance ) {
		global $wpdb;

		$defaults = array(
			'posts_per_page'         => '3',
			'posts_per_slide'        => '3',
			'template'               => 'tile',
			'post_type'              => 'post',
			'taxonomy'               => 'category',
			'context_aware_taxonomy' => '',
			'enable_view_all'        => 'on',
			'view_all_text'          => 'View All',
			'custom_class'           => '',
			'custom_css'             => '',
			'debug_query'            => '',
			'debug_results'          => ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
                
?>
<p>
	<label for="<?php echo $this->get_field_id( 'posts_per_page' ); ?>"><?php _e( 'Number of Posts per Category', 'wp-cards' ); ?>:</label> 
	<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'posts_per_page' ); ?>" name="<?php echo $this->get_field_name( 'posts_per_page' ); ?>" value="<?php echo $instance['posts_per_page']; ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'posts_per_slide' ); ?>"><?php _e( 'Number of Posts per Slide', 'wp-cards' ); ?>:</label> 
	<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'posts_per_slide' ); ?>" name="<?php echo $this->get_field_name( 'posts_per_slide' ); ?>" value="<?php echo $instance['posts_per_slide']; ?>" />
</p>
<!-- p>
	<input class="checkbox" type="checkbox" <?php checked( (bool) $instance['view_all_slide'], true ); ?> name="<?php echo $this->get_field_name( 'view_all_slide' ); ?>" id="<?php echo $this->get_field_id( 'view_all_slide' ); ?>">
	<label for="<?php echo $this->get_field_id( 'view_all_slide' ); ?>"><?php _e( 'Include a "View All" slide' ); ?></label>
</p -->
<p>
	<input class="checkbox" type="checkbox" <?php checked( (bool) $instance['enable_view_all'], true ); ?> name="<?php echo $this->get_field_name( 'enable_view_all' ); ?>" id="<?php echo $this->get_field_id( 'enable_view_all' ); ?>">
	<label for="<?php echo $this->get_field_id( 'enable_view_all' ); ?>"><?php _e( 'Enable "View All" link' ); ?></label>
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'view_all_text' ); ?>"><?php _e( '"View All" text', 'wp-cards' ); ?>:</label> 
	<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'view_all_text' ); ?>" name="<?php echo $this->get_field_name( 'view_all_text' ); ?>" value="<?php echo $instance['view_all_text']; ?>" />
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
	<label for="<?php echo $this->get_field_id( 'custom_class' ); ?>"><?php _e( 'Custom Class' ); ?>:</label>
	<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'custom_class' ); ?>" name="<?php echo $this->get_field_name( 'custom_class' ); ?>" value="<?php echo $instance['custom_class']; ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'custom_css' ); ?>"><?php _e( 'Custom CSS' ); ?>:</label>
	<textarea class="widefat" rows="2" cols="20" id="<?php echo $this->get_field_id( 'custom_css' ); ?>" name="<?php echo $this->get_field_name( 'custom_css' ); ?>"><?php echo $instance['custom_css']; ?></textarea>
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'taxonomy' ); ?>"><?php _e( 'Taxonomy Slug', 'wp-cards' ); ?>:</label> 
	<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'taxonomy' ); ?>" name="<?php echo $this->get_field_name( 'taxonomy' ); ?>" value="<?php echo $instance['taxonomy']; ?>" />
</p>
<p>
	<input class="checkbox" type="checkbox" <?php checked( (bool) $instance['context_aware_taxonomy'], true ); ?> name="<?php echo $this->get_field_name( 'context_aware_taxonomy' ); ?>" id="<?php echo $this->get_field_id( 'context_aware_taxonomy' ); ?>">
	<label for="<?php echo $this->get_field_id( 'context_aware_taxonomy' ); ?>"><?php _e( 'Enable "Context Aware" function' ); ?></label>
	<p><small><?php _e( 'The context aware function is only activated on single post views, it uses the taxonomy from the "Taxonomy Slug" and pull in "Related Posts" based on the current posts categories.', 'wp-cards' ); ?></small></p>
</p>
<p>
	<label><?php _e( 'Include', 'wp-cards' ); ?> <?php echo ucwords(str_replace(array("_","-"), " ", $instance['taxonomy'])); ?>:</label>
</p>
<?php 
	$uncategorized_id = get_cat_ID( 'Uncategorized' );

	$cat_args = array(
		'type'            => $instance['post_type'],
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
		$instance['posts_per_page'] = strip_tags( $new_instance['posts_per_page'] );
		$instance['posts_per_slide'] = strip_tags( $new_instance['posts_per_slide'] );
		//$instance['view_all_slide'] = strip_tags( $new_instance['view_all_slide'] );
		$instance['enable_view_all'] = strip_tags( $new_instance['enable_view_all'] );
		$instance['view_all_text'] = strip_tags( $new_instance['view_all_text'] );
		$instance['template'] = strip_tags( $new_instance['template'] );
		$instance['post_type'] = strip_tags( $new_instance['post_type'] );
		$instance['taxonomy'] = strip_tags( $new_instance['taxonomy'] );
		$instance['context_aware_taxonomy'] = strip_tags( $new_instance['context_aware_taxonomy'] );
		$instance['custom_class'] = strip_tags( $new_instance['custom_class'] );
		$instance['custom_css'] = strip_tags( $new_instance['custom_css'] );
		$instance['debug_query'] = strip_tags( $new_instance['debug_query'] );
		$instance['debug_results'] = strip_tags( $new_instance['debug_results'] );
		$uncategorized_id = get_cat_ID( 'Uncategorized' );

		$cat_args = array(
			'type'         => $instance['post_type'],
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