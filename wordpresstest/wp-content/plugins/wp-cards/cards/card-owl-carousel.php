<?php

class wp_cards_owl_carousel_widget extends WP_Widget {
	public static $classname = __CLASS__;

	public function __construct() {
		parent::__construct( __CLASS__, 'Card - Owl Carousel', array(
			'description' => 'A responsive carousel card that uses the JavaScript library from owlcarousel.owlgraphic.com for full width "sidebars" (only shows top level categories).',
			'classname'   => self::$classname
		) );
	}

	public function widget( $args, $params ) {
		global $post;
		extract( $params );
		$parent_id = $post->ID;

		wp_enqueue_script( 'owl-carousel', plugins_url( 'wp-cards/includes/js/owl.carousel.min.js' ), false, wp_cards_auto_version( '/js/owl.carousel.min.js', true ) );
		wp_enqueue_style( 'owl-carousel', plugins_url( 'wp-cards/includes/css/owl.carousel.css' ), false, wp_cards_auto_version( '/css/owl.carousel.css', true ), 'screen' );

		// Grab the categories from the database
		if ( $the_term = get_term( $category, $taxonomy ) ) {
			$has_category = true;
		} else {
			$has_category = false;
		}
		$pages = ceil( $posts_per_page / $posts_per_slide );

		// Begin outputting the widget HTML
		if ( ! empty ( $args['before_widget'] ) ) {
			echo $args['before_widget'];
		}

		?>
		<style type="text/css">
			<?php echo $custom_css; ?>
		</style>

		<div id="<?php echo $args['widget_id']; ?>" class="section carousel category-carousel slide <?php echo ( ! empty( $custom_class ) ) ? $custom_class : '' ?>">
			<?php if ( ! empty( $title ) ) : ?>
			<h2 class="section-title"><span><?php echo $title; ?><span></h2>
			<?php elseif ( $has_category ) : ?>
			<h2 class="section-title"><a href="<?php echo get_term_link( $the_term, $taxonomy ); ?>"><?php _e( $the_term->name ); ?></a></h2>
			<?php else : ?>
			<h2 class="section-title" style="visibility:hidden;">&nbsp;</h2>
			<?php endif;
			if ( $has_category && 'on' === $enable_view_all ) : ?>
			<div class="category-view-all"><a href="<?php echo get_term_link( $the_term, $taxonomy ); ?>"><?php _e( $view_all_text ); ?></a></div>
			<?php endif;

				$current_page = 1;

				while( $current_page <= $pages ) :
					$offset = intval( ( $current_page - 1 ) * $posts_per_slide );
					$number_of_posts = $posts_per_page;
					//echo '<pre>';print_r($number_of_posts);echo '</pre>';
					// Create a new query instance
					$query_args = array(
						'post_type'        => $post_type,
						'posts_per_page'   => $number_of_posts,
						'suppress_filters' => true,
						'offset'           => $offset
					);
					if ( $has_category ) {
						$query_args['tax_query'] = array(
							array(
								'taxonomy'   => strtolower( $taxonomy ),
								'field'      => 'term_id',
								'terms'      => $the_term->term_id,
								'operator'   => 'IN'
							)
						);
					}
					wp_cards_query( $query_args );
					global $wp_query;

					if ( $wp_query->found_posts ) :
						$post_count = $wp_query->post_count;
						if ( $post_count <= $posts_per_slide ) {
							$navigation = 'false';
						} else {
							$navigation = 'true';
						}

						if ( current_user_can( 'manage_options' ) && 'on' === $debug_query ) {
							echo '<h3>Query Vars:</h3><pre>'; print_r($wp_query->query); echo '</pre>';
							echo '<h3>Request:</h3><pre>'; print_r($wp_query->request); echo '</pre>';
						}

						if ( current_user_can( 'manage_options' ) && 'on' === $debug_results ) {
							echo '<h3>Results:</h3><pre>'; print_r($wp_query->posts); echo '</pre>';
						}
						?>
						<div id="owl_<?php echo $args['widget_id']; ?>" class="owl-carousel">
							<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
							<div class="item entries <?php echo $template; ?>-view">
								<div class="entry">
									<div class="excerpt-wrapper" id="excerpt-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>" data-view="<?php echo $template; ?>">
										<?php wp_cards_excerpt( array( 'post_type' => get_post_type(), 'view' => $template ) ); ?>
									</div>
								</div>
							</div>
							<?php endwhile; rewind_posts(); endif; ?>
						</div><!-- /.owl-carousel -->
						<div class="clearfix"></div>
						<script type="text/javascript">
							jQuery(document).ready(function($){
								$("#owl_<?php echo $args['widget_id']; ?>").owlCarousel({
									items : <?php echo $posts_per_slide; ?>,
									nav : <?php echo $navigation; ?>,
									navText : ['<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>','<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>'],
								    margin : 30,
								    responsive:{
								        0:{items:1,nav:true},
								        600:{items:2,nav:true},
								        900:{items:3},
								        1100:{items:<?php echo $posts_per_slide; ?>}
								    }
								})
							});
						</script>
					<?php elseif ( current_user_can( 'manage_options' ) && 'on' === $debug_query ) : ?>
						<h3>No results for: </h3><pre><?php print_r($wp_query->query); ?></pre>
					<?php endif;

					// Reset Post Data
					wp_cards_reset_query();

					$current_page++;
				endwhile; // End current_page
			?>
		</div><!-- /#<?php echo $args['widget_id']; ?> -->
		<?php

		if ( ! empty ( $args['after_widget'] ) ) {
			echo $args['after_widget'];
		}
	}

	public function form( $instance ) {
		global $wpdb;

		$defaults = array(
			'title'                  => '',
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
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'wp-cards' ); ?>:</label>
	<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'posts_per_page' ); ?>"><?php _e( 'Maximum number of Posts per Category', 'wp-cards' ); ?>:</label>
	<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'posts_per_page' ); ?>" name="<?php echo $this->get_field_name( 'posts_per_page' ); ?>" value="<?php echo $instance['posts_per_page']; ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'posts_per_slide' ); ?>"><?php _e( 'Number of Posts per Slide', 'wp-cards' ); ?>:</label>
	<select name="<?php echo $this->get_field_name( 'posts_per_slide' ); ?>" id="<?php echo $this->get_field_id( 'posts_per_slide' ); ?>" class="postform">
		<?php foreach ( array('1','2','3','4','6') as $showing ) : ?>
		<option class="level-0" value="<?php echo $showing; ?>" <?php echo ( $instance['posts_per_slide'] == $showing ) ? ' selected="selected"' : ''; ?>><?php echo $showing; ?></option>
		<?php endforeach; ?>
	</select>
</p>
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
	<label><?php _e( 'Include', 'wp-cards' ); ?> <?php echo ucwords(str_replace(array("_","-"), " ", $instance['taxonomy'])); ?>:</label>
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category', 'odbm-base' ); ?>:</label>
	<select class="postform" id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>">
		<option value="-1">None</option>
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
	foreach( $categories as $category ) :
		$selected = $instance['category'] == $category->term_id ? ' selected="selected"' : ''; ?>
		<option value="<?php echo $category->term_id; ?>"<?php echo $selected; ?>><?php echo $category->cat_name; ?></option>
	<?php endforeach; ?>
	</select>
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
		$instance['posts_per_slide'] = strip_tags( $new_instance['posts_per_slide'] );
		$instance['enable_view_all'] = strip_tags( $new_instance['enable_view_all'] );
		$instance['view_all_text'] = strip_tags( $new_instance['view_all_text'] );
		$instance['template'] = strip_tags( $new_instance['template'] );
		$instance['post_type'] = strip_tags( $new_instance['post_type'] );
		$instance['category'] = strip_tags( $new_instance['category'] );
		$instance['taxonomy'] = strip_tags( $new_instance['taxonomy'] );
		$instance['custom_class'] = strip_tags( $new_instance['custom_class'] );
		$instance['custom_css'] = strip_tags( $new_instance['custom_css'] );
		$instance['debug_query'] = strip_tags( $new_instance['debug_query'] );
		$instance['debug_results'] = strip_tags( $new_instance['debug_results'] );

		return $instance;
	}
}

?>