<?php if ( $imgdata = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array('400','300') ) )  : ?>
<div class="panel panel-default has-thumb">
	<a href="<?php the_permalink(); ?>">
		<div class="excerpt-thumb cover-image" style="background-image:url('<?php echo $imgdata[0]; ?>');"></div>
	</a>
	<div class="panel-body">
<?php else: ?>
<div class="panel panel-default">
	<div class="excerpt-thumb"></div>
	<div class="panel-body">
<?php endif; ?>
		<h3><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'wp-cards' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
		<div class="entry-meta">
			<time class="entry-date" datetime="<?php echo get_the_date( 'c' ); ?>" pubdate><?php echo date_i18n( get_option( 'date_format' ), strtotime( $post->post_date ) ); ?></time>
			<span class="entry-author vcard"><a class="url fn n" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="View all posts by <?php the_author(); ?>"><?php the_author(); ?></a></span>
		</div>
		<?php
			// Get the excerpt
			if ( ! empty( $post->post_excerpt ) ) {
				$excerpt = $post->post_excerpt;
			} else {
				$excerpt_args = array(
					'text'   => get_the_content(),
					'length' => 60
				);
				$excerpt = wp_cards_the_excerpt( $excerpt_args );
			}

			echo wpautop( $excerpt );
		?>
	</div>
</div><!--/panel-->
<?php wp_cards_toolbar(); ?>