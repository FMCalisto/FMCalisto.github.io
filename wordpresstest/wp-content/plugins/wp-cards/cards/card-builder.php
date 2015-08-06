<?php

class wp_cards_builder_widget extends WP_Widget {
	public static $classname = __CLASS__;

	public function __construct() {
		parent::__construct( __CLASS__, 'Card - Builder', array(
			'description' => 'A Builder card for customizing cards for full width "sidebars".',
			'classname'   => self::$classname
		) );
	}

	public function widget( $args, $params ) {
		extract( $params );
		
		$base_blog_switched = false;
		if ( is_multisite() ) {
			$current_blog_id = get_current_blog_id();
		} else {
			$current_blog_id = -1;
		}

		if ( '1' == $card_layout ) {
			$element_1_class = 'col-sm-12 col-md-4';
			$element_2_class = 'col-sm-12 col-md-4';
			$element_3_class = 'col-sm-12 col-md-4';
		} elseif ( '2' == $card_layout ) {
			$element_1_class = 'col-sm-12 col-md-4';
			$element_2_class = 'col-sm-12 col-md-8';
			$element_3_class = '';
		} elseif ( '3' == $card_layout ) {
			$element_1_class = 'col-sm-12 col-md-8';
			$element_2_class = 'col-sm-12 col-md-4';
			$element_3_class = '';
		} elseif ( '4' == $card_layout ) {
			$element_1_class = 'col-sm-12 col-md-6';
			$element_2_class = 'col-sm-12 col-md-6';
			$element_3_class = '';
		} elseif ( '5' == $card_layout ) {
			$element_1_class = 'col-sm-12 col-md-12';
			$element_2_class = '';
			$element_3_class = '';
		}

		if ( ! empty ( $args['before_widget'] ) ) {
			echo $args['before_widget'];
		}
		
		?>
		<style type="text/css">
			<?php echo $element_1_custom_css; ?>
			<?php echo $element_2_custom_css; ?>
			<?php echo $element_3_custom_css; ?>
		</style>

		<div class="section">
		<?php if ( ! empty( $title ) ) : ?>
			<h2 class="section-title ribbon"><span><?php echo $title; ?></span></h2>
		<?php endif; ?>
			<div class="row entries grid-view">
			<?php

				// Element 1 Query
				if ( ! empty( $element_1_post_type ) ) {

					// Switching the blog_id allows for content to be pulled in from another site
					if ( is_multisite() && ( $element_1_blog_id != $current_blog_id ) ) {
						switch_to_blog( $element_1_blog_id );
						$base_blog_switched = true;
					}

					$element_1_query = $this->build_query( $element_1_post_type );
					if ( isset( $element_1_offset ) && '0' !== $element_1_offset ) {
						$element_1_query[ 'offset' ] = $element_1_offset;
					}

					// Query the element 1 data
					$element_1 = wp_cards_query( $element_1_query );

					// Switch back to base blog_id
					if ( $base_blog_switched ) {
						restore_current_blog();
						$base_blog_switched = false;
					}
				} else {
					$element_1 = null;
				}

				if ( empty( $element_1 )  && ! empty( $element_1_default_post_id ) ) {
					wp_cards_reset_query();
					$element_1_post_type = get_post_type( $element_1_default_post_id );
					if ( 'page' == $element_1_post_type ) {
						wp_cards_query( array('page_id'=>$element_1_default_post_id,'suppress_filters'=>true) );
					} else {
						wp_cards_query( array('p'=>$element_1_default_post_id,'post_type'=>$element_1_post_type,'suppress_filters'=>true) );
					}
				}

			    if ( have_posts() ) {
					while ( have_posts() ) : the_post(); ?>
					<div class="entry col <?php echo $element_1_class; ?>">
						<div class="excerpt-wrapper<?php echo !empty( $element_1_css_class ) ? ' ' . $element_1_css_class : ''; ?>" id="excerpt-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>" data-view="<?php echo $element_1_view; ?>">
							<?php wp_cards_excerpt( array('post_type'=>$element_1_post_type,'view'=>$element_1_view) ); ?>
						</div><!-- /.excerpt-wrapper -->
					</div>
					<?php endwhile;
			    }

				// Reset post data for element 1
				if ( ! empty( $element_1_post_type ) ) {
					wp_cards_reset_query();
				}

				if ( '5' != $card_layout ) {
					// Element 2 Query
					if ( ! empty( $element_2_post_type ) ) {

						// Switching the blog_id allows for content to be pulled in from another site
						if ( is_multisite() && ( $element_2_blog_id != $current_blog_id ) ) {
							switch_to_blog( $element_2_blog_id );
							$base_blog_switched = true;
						}

						$element_2_query = $this->build_query( $element_2_post_type );
						if ( isset( $element_2_offset ) && '0' !== $element_2_offset ) {
							$element_2_query[ 'offset' ] = $element_2_offset;
						}

						// Query the element 2 data
						$element_2 = wp_cards_query( $element_2_query );

						// Switch back to base blog_id
						if ( $base_blog_switched ) {
							restore_current_blog();
							$base_blog_switched = false;
						}
					} else {
						$element_2 = null;
					}

					if ( empty( $element_2 )  && ! empty( $element_2_default_post_id ) ) {
						wp_cards_reset_query();
						$element_2_post_type = get_post_type( $element_2_default_post_id );
						if ( 'page' == $element_2_post_type ) {
							wp_cards_query( array('page_id'=>$element_2_default_post_id,'suppress_filters'=>true) );
						} else {
							wp_cards_query( array('p'=>$element_2_default_post_id,'post_type'=>$element_2_post_type,'suppress_filters'=>true) );
						}
					}

				    if ( have_posts() ) {
						while ( have_posts() ) : the_post(); ?>
						<div class="entry col <?php echo $element_2_class; ?>">
							<div class="excerpt-wrapper<?php echo !empty( $element_1_css_class ) ? ' ' . $element_1_css_class : ''; ?>" id="excerpt-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>" data-view="<?php echo $element_2_view; ?>">
								<?php wp_cards_excerpt( array('post_type'=>$element_2_post_type,'view'=>$element_2_view) ); ?>
							</div><!-- /.excerpt-wrapper -->
						</div>
						<?php endwhile;
				    }

					// Reset post data for element 2
					if ( ! empty( $element_2_post_type ) ) {
						wp_cards_reset_query();
					}
				}

				if ( '1' === $card_layout ) {
					// Element 3 Query
					if ( ! empty( $element_3_post_type ) ) {

						// Switching the blog_id allows for content to be pulled in from another site
						if ( is_multisite() && ( $element_3_blog_id != $current_blog_id ) ) {
							switch_to_blog( $element_3_blog_id );
							$base_blog_switched = true;
						}

						$element_3_query = $this->build_query( $element_3_post_type );
						if ( isset( $element_3_offset ) && '0' !== $element_3_offset ) {
							$element_3_query[ 'offset' ] = $element_3_offset;
						}

						// Query the element 3 data
						$element_3 = wp_cards_query( $element_3_query );

						// Switch back to base blog_id
						if ( $base_blog_switched ) {
							restore_current_blog();
							$base_blog_switched = false;
						}
					} else {
						$element_3 = null;
					}

					if ( empty( $element_3 )  && ! empty( $element_3_default_post_id ) ) {
						wp_cards_reset_query();
						$element_3_post_type = get_post_type( $element_3_default_post_id );
						if ( 'page' == $element_3_post_type ) {
							wp_cards_query( array('page_id'=>$element_3_default_post_id,'suppress_filters'=>true) );
						} else {
							wp_cards_query( array('p'=>$element_3_default_post_id,'post_type'=>$element_3_post_type,'suppress_filters'=>true) );
						}
					}

				    if ( have_posts() ) {
						while ( have_posts() ) : the_post(); ?>
						<div class="entry col <?php echo $element_3_class; ?>">
							<div class="excerpt-wrapper<?php echo !empty( $element_1_css_class ) ? ' ' . $element_1_css_class : ''; ?>" id="excerpt-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>" data-view="<?php echo $element_3_view; ?>">
								<?php wp_cards_excerpt( array('post_type'=>$element_3_post_type,'view'=>$element_3_view) ); ?>
							</div><!-- /.excerpt-wrapper -->
						</div>
						<?php endwhile;
				    }

					// Reset post data for element 3
					if ( ! empty( $element_3_post_type ) ) {
						wp_cards_reset_query();
					}
				}
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

		if ( is_multisite() ) {
			$sites = wp_get_sites();
			$current_blog_id = get_current_blog_id();
		} else {
			$sites = array();
			$current_blog_id = 1;
		}

		$defaults = array(
			'title'                     => '',
			'card_layout'               => 1,
			'element_1_post_type'       => 'post',
			'element_1_default_post_id' => NULL,
			'element_1_blog_id'         => $current_blog_id,
			'element_1_css_class'       => '',
			'element_1_custom_css'      => '',
			'element_1_view'            => 'grid',
			'element_1_offset'          => '0',
			'element_2_post_type'       => 'post',
			'element_2_default_post_id' => NULL,
			'element_2_blog_id'         => $current_blog_id,
			'element_2_css_class'       => '',
			'element_2_custom_css'      => '',
			'element_2_view'            => 'grid',
			'element_2_offset'          => '0',
			'element_3_post_type'       => 'post',
			'element_3_default_post_id' => NULL,
			'element_3_blog_id'         => $current_blog_id,
			'element_3_css_class'       => '',
			'element_3_custom_css'      => '',
			'element_3_view'            => 'grid',
			'element_3_offset'          => '0'
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

		$layout_options = array(
			1 => '<span class="span-4">#1</span><span class="span-4">#2</span><span class="span-4">#3</span>',
			2 => '<span class="span-4">#1</span><span class="span-8">#2</span>',
			3 => '<span class="span-8">#1</span><span class="span-4">#2</span>',
			4 => '<span class="span-6">#1</span><span class="span-6">#2</span>',
			5 => '<span class="span-12">#1</span>'
		);

		$valid_views = array( 
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
		
?>

<style type="text/css">
	.card-elements {border:1px solid #ccc;padding:0 10px;margin:10px -5px;clear:both;}
	.layout-options {display:block;float:left; margin:0px;}
	.layout-options span {margin:5px;height:20px;line-height:20px;text-align:center;display:block;float:left;}
	.layout-options .span-4 {border:1px solid #ccc;width:60px;}
	.layout-options .span-6 {border:1px solid #ccc;width:96px;}
	.layout-options .span-8 {border:1px solid #ccc;width:132px;}
	.layout-options .span-12 {border:1px solid #ccc;width:204px;}
</style>

<script type="text/javascript">
	jQuery(document).ready( function($) {
	    $("input[name='<?php echo $this->get_field_name( 'card_layout' ); ?>']").change(function(){
			if ( $(this).val() === '5' ) {
				$('#<?php echo $this->get_field_id( 'card_layout' ); ?>-col2').hide();
			} else {
				$('#<?php echo $this->get_field_id( 'card_layout' ); ?>-col2').show();
			}
			if ( $(this).val() === '1' ) {
				$('#<?php echo $this->get_field_id( 'card_layout' ); ?>-col3').show();
			} else {
				$('#<?php echo $this->get_field_id( 'card_layout' ); ?>-col3').hide();
			}
		});
	});
</script>
<div class="card-builder">
	<h4><?php _e( 'Custom Card Builder', 'wp-cards' ); ?></h4>
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title' ); ?>:</label> 
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>
	<h3><?php _e( 'Layout Options', 'wp-cards' ); ?>:</h3>
	<?php for ( $layout_option = 1; $layout_option < 6; $layout_option++ ) : ?>
    <p class="layout-options"><span><input type="radio" id="<?php echo $this->get_field_id( 'card_layout' ) . '_' . $layout_option; ?>" name="<?php echo $this->get_field_name( 'card_layout' ); ?>" value="<?php echo $layout_option; ?>"<?php echo $instance['card_layout'] == $layout_option ? ' checked' : ''; ?>></span><label for="<?php echo $this->get_field_id( 'card_layout' ); ?>_<?php echo $layout_option; ?>"> <?php echo $layout_options[$layout_option]; ?></label></p>
	<?php endfor; ?>
	<div class="clear:both;"></div>
</div>
<div id="<?php echo $this->get_field_id( 'card_layout' ); ?>-col1" class="card-elements">
	<h3><?php _e( 'Element 1', 'wp-cards' ); ?></h3>
	<p>
		<label for="<?php echo $this->get_field_id( 'element_1_post_type' ); ?>"><?php _e( 'Post Type' ); ?>:</label>
		<select id="<?php echo $this->get_field_id( 'element_1_post_type' ); ?>" name="<?php echo $this->get_field_name( 'element_1_post_type' ); ?>">
			<option value=""><?php _e( 'None' ); ?></option>
			<option value="post"<?php echo 'post' == $instance['element_1_post_type'] ? ' selected="selected"' : ''; ?>><?php _e( 'Post' ); ?></option>
			<?php foreach ( (array) get_post_types( array('show_ui' => true, '_builtin' => false ) ) as $post_type ) :
			$selected = $instance['element_1_post_type'] == $post_type ? ' selected="selected"' : ''; ?>
			<option value="<?php echo $post_type; ?>"<?php echo $selected; ?>><?php echo ucwords(str_replace(array("_","-"), " ", $post_type)); ?></option>
			<?php endforeach; ?>
		</select>
		<br><small>Enter a default post type, defualt is 'locations'</small>
	</p>
	<?php if ( is_multisite() ) : ?>
	<p>
		<label for="<?php echo $this->get_field_id( 'element_1_blog_id' ); ?>"><?php _e( 'Base Site', 'wp-cards' ); ?>:</label>
		<select id="<?php echo $this->get_field_id( 'element_1_blog_id' ); ?>" name="<?php echo $this->get_field_name( 'element_1_blog_id' ); ?>">
		<?php foreach ( $sites as $site ) :
			$selected = $instance['element_1_blog_id'] == $site['blog_id'] ? ' selected="selected"' : ''; ?>
			<option value="<?php echo $site['blog_id']; ?>"<?php echo $selected; ?>><?php echo $site['domain']; ?></option>
		<?php endforeach; ?>
		</select>
		<br><small>Enter a "Base Site" to to pull this content from (optional)</small>
	</p>
	<?php endif; ?>
	<p>
		<label for="<?php echo $this->get_field_id( 'element_1_default_post_id' ); ?>"><?php _e( 'Default Post ID', 'wp-cards' ); ?>:</label> 
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'element_1_default_post_id' ); ?>" name="<?php echo $this->get_field_name( 'element_1_default_post_id' ); ?>" value="<?php echo $instance['element_1_default_post_id']; ?>" />
		<br><small>Enter a default post to point to if there are no results for a given element (optional)</small>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'element_1_css_class' ); ?>"><?php _e( 'CSS Class', 'wp-cards' ); ?>:</label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'element_1_css_class' ); ?>" name="<?php echo $this->get_field_name( 'element_1_css_class' ); ?>" value="<?php echo $instance['element_1_css_class']; ?>" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'element_1_custom_css' ); ?>"><?php _e( 'Custom CSS', 'wp-cards' ); ?>:</label>
		<textarea class="widefat" rows="2" cols="20" id="<?php echo $this->get_field_id( 'element_1_custom_css' ); ?>" name="<?php echo $this->get_field_name( 'element_1_custom_css' ); ?>"><?php echo $instance['element_1_custom_css']; ?></textarea>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'element_1_view' ); ?>"><?php _e( 'View Template', 'wp-cards' ); ?>:</label>
		<select name="<?php echo $this->get_field_name( 'element_1_view' ); ?>" id="<?php echo $this->get_field_id( 'element_1_view' ); ?>" class="postform">
			<?php foreach ( $valid_views as $temp_key => $temp_val ) : ?>
				<option class="level-0" value="<?php echo $temp_key; ?>" <?php echo ( $instance['element_1_view'] == $temp_key ) ? ' selected="selected"' : ''; ?>><?php echo $temp_val; ?></option>
			<?php endforeach; ?>
		</select>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'element_1_offset' ); ?>"><?php _e( 'Query Offset', 'wp-cards' ); ?>:</label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'element_1_offset' ); ?>" name="<?php echo $this->get_field_name( 'element_1_offset' ); ?>" value="<?php echo $instance['element_1_offset']; ?>" />
	</p>
</div><!-- /.card-elements -->
<div id="<?php echo $this->get_field_id( 'card_layout' ); ?>-col2" class="card-elements"<?php echo '5' == $instance['card_layout'] ? ' style="display:none;"': ''; ?>>
	<h3><?php _e( 'Element 2', 'wp-cards' ); ?></h3>
	<p>
		<label for="<?php echo $this->get_field_id( 'element_2_post_type' ); ?>"><?php _e( 'Post Type' ); ?>:</label>
		<select id="<?php echo $this->get_field_id( 'element_2_post_type' ); ?>" name="<?php echo $this->get_field_name( 'element_2_post_type' ); ?>">
			<option value=""><?php _e( 'None' ); ?></option>
			<option value="post"<?php echo 'post' == $instance['element_2_post_type'] ? ' selected="selected"' : ''; ?>><?php _e( 'Post' ); ?></option>
			<?php foreach ( (array) get_post_types( array('show_ui' => true, '_builtin' => false ) ) as $post_type ) :
			$selected = $instance['element_2_post_type'] == $post_type ? ' selected="selected"' : ''; ?>
			<option value="<?php echo $post_type; ?>"<?php echo $selected; ?>><?php echo ucwords(str_replace(array("_","-"), " ", $post_type)); ?></option>
			<?php endforeach; ?>
		</select>
		<br><small>Enter a default post type, defualt is 'events'</small>
	</p>
	<?php if ( is_multisite() ) : ?>
	<p>
		<label for="<?php echo $this->get_field_id( 'element_2_blog_id' ); ?>"><?php _e( 'Base Site', 'wp-cards' ); ?>:</label>
		<select id="<?php echo $this->get_field_id( 'element_2_blog_id' ); ?>" name="<?php echo $this->get_field_name( 'element_2_blog_id' ); ?>">
		<?php foreach ( $sites as $site ) :
			$selected = $instance['element_2_blog_id'] == $site['blog_id'] ? ' selected="selected"' : ''; ?>
			<option value="<?php echo $site['blog_id']; ?>"<?php echo $selected; ?>><?php echo $site['domain']; ?></option>
		<?php endforeach; ?>
		</select>
		<br><small>Enter a "Base Site" to to pull this content from (optional)</small>
	</p>
	<?php endif; ?>
	<p>
		<label for="<?php echo $this->get_field_id( 'element_2_default_post_id' ); ?>"><?php _e( 'Default Post ID', 'wp-cards' ); ?>:</label> 
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'element_2_default_post_id' ); ?>" name="<?php echo $this->get_field_name( 'element_2_default_post_id' ); ?>" value="<?php echo $instance['element_2_default_post_id']; ?>" />
		<br><small>Enter a default post to point to if there are no results for a given element (optional)</small>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'element_2_css_class' ); ?>"><?php _e( 'CSS Class', 'wp-cards' ); ?>:</label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'element_2_css_class' ); ?>" name="<?php echo $this->get_field_name( 'element_2_css_class' ); ?>" value="<?php echo $instance['element_2_css_class']; ?>" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'element_2_custom_css' ); ?>"><?php _e( 'Custom CSS', 'wp-cards' ); ?>:</label>
		<textarea class="widefat" rows="2" cols="20" id="<?php echo $this->get_field_id( 'element_2_custom_css' ); ?>" name="<?php echo $this->get_field_name( 'element_2_custom_css' ); ?>"><?php echo $instance['element_2_custom_css']; ?></textarea>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'element_2_view' ); ?>"><?php _e( 'View Template', 'wp-cards' ); ?>:</label>
		<select name="<?php echo $this->get_field_name( 'element_2_view' ); ?>" id="<?php echo $this->get_field_id( 'element_2_view' ); ?>" class="postform">
			<?php foreach ( $valid_views as $temp_key => $temp_val ) : ?>
				<option class="level-0" value="<?php echo $temp_key; ?>" <?php echo ( $instance['element_2_view'] == $temp_key ) ? ' selected="selected"' : ''; ?>><?php echo $temp_val; ?></option>
			<?php endforeach; ?>
		</select>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'element_2_offset' ); ?>"><?php _e( 'Query Offset', 'wp-cards' ); ?>:</label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'element_2_offset' ); ?>" name="<?php echo $this->get_field_name( 'element_2_offset' ); ?>" value="<?php echo $instance['element_2_offset']; ?>" />
	</p>
</div><!-- /.card-elements -->
<div id="<?php echo $this->get_field_id( 'card_layout' ); ?>-col3" class="card-elements"<?php echo '1' !== $instance['card_layout'] ? ' style="display:none;"': ''; ?>>
	<h3><?php _e( 'Element 3', 'wp-cards' ); ?></h3>
	<p>
		<label for="<?php echo $this->get_field_id( 'element_3_post_type' ); ?>"><?php _e( 'Post Type' ); ?>:</label>
		<select id="<?php echo $this->get_field_id( 'element_3_post_type' ); ?>" name="<?php echo $this->get_field_name( 'element_3_post_type' ); ?>">
			<option value=""><?php _e( 'None' ); ?></option>
			<option value="post"<?php echo 'post' == $instance['element_3_post_type'] ? ' selected="selected"' : ''; ?>><?php _e( 'Post' ); ?></option>
			<?php foreach ( (array) get_post_types( array('show_ui' => true, '_builtin' => false ) ) as $post_type ) :
			$selected = $instance['element_3_post_type'] == $post_type ? ' selected="selected"' : ''; ?>
			<option value="<?php echo $post_type; ?>"<?php echo $selected; ?>><?php echo ucwords(str_replace(array("_","-"), " ", $post_type)); ?></option>
			<?php endforeach; ?>
		</select>
		<br><small>Enter a default post type, defualt is 'events'</small>
	</p>
	<?php if ( is_multisite() ) : ?>
	<p>
		<label for="<?php echo $this->get_field_id( 'element_3_blog_id' ); ?>"><?php _e( 'Base Site', 'wp-cards' ); ?>:</label>
		<select id="<?php echo $this->get_field_id( 'element_3_blog_id' ); ?>" name="<?php echo $this->get_field_name( 'element_3_blog_id' ); ?>">
		<?php foreach ( $sites as $site ) :
			$selected = $instance['element_3_blog_id'] == $site['blog_id'] ? ' selected="selected"' : ''; ?>
			<option value="<?php echo $site['blog_id']; ?>"<?php echo $selected; ?>><?php echo $site['domain']; ?></option>
		<?php endforeach; ?>
		</select>
		<br><small>Enter a "Base Site" to to pull this content from (optional)</small>
	</p>
	<?php endif; ?>
	<p>
		<label for="<?php echo $this->get_field_id( 'element_3_default_post_id' ); ?>"><?php _e( 'Default Post ID', 'wp-cards' ); ?>:</label> 
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'element_3_default_post_id' ); ?>" name="<?php echo $this->get_field_name( 'element_3_default_post_id' ); ?>" value="<?php echo $instance['element_3_default_post_id']; ?>" />
		<br><small>Enter a default post to point to if there are no results for a given element (optional)</small>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'element_3_css_class' ); ?>"><?php _e( 'CSS Class', 'wp-cards' ); ?>:</label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'element_3_css_class' ); ?>" name="<?php echo $this->get_field_name( 'element_3_css_class' ); ?>" value="<?php echo $instance['element_3_css_class']; ?>" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'element_3_custom_css' ); ?>"><?php _e( 'Custom CSS', 'wp-cards' ); ?>:</label>
		<textarea class="widefat" rows="2" cols="20" id="<?php echo $this->get_field_id( 'element_3_custom_css' ); ?>" name="<?php echo $this->get_field_name( 'element_3_custom_css' ); ?>"><?php echo $instance['element_3_custom_css']; ?></textarea>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'element_3_view' ); ?>"><?php _e( 'View Template', 'wp-cards' ); ?>:</label>
		<select name="<?php echo $this->get_field_name( 'element_3_view' ); ?>" id="<?php echo $this->get_field_id( 'element_3_view' ); ?>" class="postform">
			<?php foreach ( $valid_views as $temp_key => $temp_val ) : ?>
				<option class="level-0" value="<?php echo $temp_key; ?>" <?php echo ( $instance['element_3_view'] == $temp_key ) ? ' selected="selected"' : ''; ?>><?php echo $temp_val; ?></option>
			<?php endforeach; ?>
		</select>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'element_3_offset' ); ?>"><?php _e( 'Query Offset', 'wp-cards' ); ?>:</label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'element_3_offset' ); ?>" name="<?php echo $this->get_field_name( 'element_3_offset' ); ?>" value="<?php echo $instance['element_3_offset']; ?>" />
	</p>
</div><!-- /.card-elements -->
<?php 
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['card_layout'] = strip_tags( (int) $new_instance['card_layout'] );

		// Element 1
		$instance['element_1_post_type'] = strip_tags( $new_instance['element_1_post_type'] );
		$instance['element_1_default_post_id'] = strip_tags( $new_instance['element_1_default_post_id'] );
		$instance['element_1_blog_id'] = strip_tags( $new_instance['element_1_blog_id'] );
		$instance['element_1_css_class'] = strip_tags( $new_instance['element_1_css_class'] );
		$instance['element_1_custom_css'] = strip_tags( $new_instance['element_1_custom_css'] );
		$instance['element_1_view'] = strip_tags( $new_instance['element_1_view'] );
		$instance['element_1_offset'] = strip_tags( $new_instance['element_1_offset'] );

		// Element 2
		$instance['element_2_post_type'] = strip_tags( $new_instance['element_2_post_type'] );
		$instance['element_2_default_post_id'] = strip_tags( $new_instance['element_2_default_post_id'] );
		$instance['element_2_blog_id'] = strip_tags( $new_instance['element_2_blog_id'] );
		$instance['element_2_css_class'] = strip_tags( $new_instance['element_2_css_class'] );
		$instance['element_2_custom_css'] = strip_tags( $new_instance['element_2_custom_css'] );
		$instance['element_2_view'] = strip_tags( $new_instance['element_2_view'] );
		$instance['element_2_offset'] = strip_tags( $new_instance['element_2_offset'] );

		// Element 3
		$instance['element_3_post_type'] = strip_tags( $new_instance['element_3_post_type'] );
		$instance['element_3_default_post_id'] = strip_tags( $new_instance['element_3_default_post_id'] );
		$instance['element_3_blog_id'] = strip_tags( $new_instance['element_3_blog_id'] );
		$instance['element_3_css_class'] = strip_tags( $new_instance['element_3_css_class'] );
		$instance['element_3_custom_css'] = strip_tags( $new_instance['element_3_custom_css'] );
		$instance['element_3_view'] = strip_tags( $new_instance['element_3_view'] );
		$instance['element_3_offset'] = strip_tags( $new_instance['element_3_offset'] );

		return $instance;  
	}
	
	private function build_query( $post_type = 'post' ) {
		// Create a default query instance
		$query = array(
			'post_type'        => $post_type,
			'posts_per_page'   => 1,
			'suppress_filters' => true
		);

		if ( 'events' == $post_type ) {
			$today = date('Y-m-d H:i:s');
			$events_args = array(
				'post_status'  => array( 'future', 'publish' ),
			    'meta_query' => array(
			        array(
			            'key'     => '_end_time',
			            'value'   => $today,
			            'compare' => '>=',
						'type'    => 'DATETIME'
			        )
			    )
			);
			
			$query = array_merge( $query, $events_args );
		}

		date_default_timezone_set( $current_tz );
		return $query;
	}
}

?>