<?php

class wp_cards_featurette_by_category_widget extends WP_Widget {
	public static $classname = __CLASS__;
	
	public function __construct() {
		parent::__construct( __CLASS__, 'Card - Featurette by Category', array(
			'description' => 'A recent posts card for full width "sidebars" featuring the lastest posts from a selected category.',
			'classname'   => self::$classname
		) );
	}

	public function widget( $args, $params ) {
		extract( $params );

		// Create a new query instance
		if ( ! empty( $post_id ) ) {
			$query_args = array(
				'p'                => $post_id,
				'suppress_filters' => true
			);
		} else {
			$query_args = array(
				'posts_per_page'   => $posts_per_page,
				'suppress_filters' => true
			);
		
			if ( ! empty( $category ) ) {
				$query_args[ 'category__in' ] = $category;
			}
		}

		if ( ! empty ( $args['before_widget'] ) ) {
			echo $args['before_widget'];
		}
		
		?>
		<div class="section content bg-base">
			<h2 class="section-title ribbon"><span><?php echo $title; ?></span></h2>
			<div class="entries featurette-view">
			<?php
				// Query the data
				wp_cards_query( $query_args );
				$post_count = 1; 
				while ( have_posts() ) : the_post(); 
					$thumb_class = ( $post_count % 2 ) ? 'pull-right' : 'pull-left';
				?>
				<div class="row">
					<div class="col col-6 col-sm-12 col-md-6 <?php echo $thumb_class; ?>">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<?php the_post_thumbnail( array( '460', '300' ), array( 'class' => "featurette-image img-responsive" ) ); ?>
						</a>
					</div>
					<div class="col col-6 col-sm-12 col-md-6">
						<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
						<?php
					
						// Get the excerpt
						if ( empty( $post->post_excerpt ) ) {
							$excerpt_args = array(
								'text'   => get_the_content(),
								'length' => 60
							);
							$excerpt = wp_cards_the_excerpt( $excerpt_args );
						} else {
							$excerpt = $post->post_excerpt;
						}

						echo wpautop( $excerpt );
					
						?>
						<span class="read-more"><a href="<?php the_permalink(); ?>" rel="bookmark" class="btn btn-success"><?php _e( 'Continue Reading', 'wp-cards' ); ?><i class="icon icon-long-arrow-right"></i></a></span>
					</div>
				</div><!-- /.featurette.row -->
				<hr class="featurette-divider">
				<?php $post_count++; endwhile; ?>
			</div><!-- /.entries -->
		</div><!--.section.content-->
		<?php
		// Reset Post Data
		wp_cards_reset_query();
		
		if ( ! empty ( $args['after_widget'] ) ) {
			echo $args['after_widget'];
		}
	}
	
	public function form( $instance ) {
		global $wpdb;

		$defaults = array(
			'title'          => __( 'Latest Post', 'wp-cards' ),
			'post_id'        => NULL,
			'posts_per_page' => '4',
			'category'       => $instance['category']
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
                
?>
<p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'wp-cards' ); ?>:</label> 
	<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'post_id' ); ?>"><?php _e( 'Post ID', 'wp-cards' ); ?>:</label> 
	<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'post_id' ); ?>" name="<?php echo $this->get_field_name( 'post_id' ); ?>" value="<?php echo $instance['post_id']; ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'posts_per_page' ); ?>"><?php _e( 'Number of Posts', 'wp-cards' ); ?>:</label> 
	<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'posts_per_page' ); ?>" name="<?php echo $this->get_field_name( 'posts_per_page' ); ?>" value="<?php echo $instance['posts_per_page']; ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category', 'wp-cards' ); ?>:</label>
	<?php wp_dropdown_categories( array( 'hide_empty' => 0, 'name' => $this->get_field_name( 'category' ), 'orderby' => 'name', 'selected' => $instance['category'], 'hierarchical' => true, 'show_option_none' => __('None') ) ); ?>
</p>
<?php 
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['post_id'] = strip_tags( $new_instance['post_id'] );
		$instance['posts_per_page'] = strip_tags( $new_instance['posts_per_page'] );
		$instance['category'] = strip_tags( $new_instance['category'] );

		return $instance;  
	}
}

?>