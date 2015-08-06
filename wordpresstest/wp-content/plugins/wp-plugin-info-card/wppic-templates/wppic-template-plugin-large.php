<?php
/***************************************************************
 * $wppic_data Object contain the following values: 
 * slug, url, name, icons, banners, version, author, requires, rating, num_ratings, downloaded, last_updated, download_link
 ***************************************************************/

//Fix for requiered version with extra info. EG: WP 3.9, BP 2.1+
if(is_numeric($wppic_data->requires)){
	$wppic_data->requires = 'WP ' . $wppic_data->requires . '+';
}
	
//Icon URL
if ( !empty( $wppic_data->icons['svg'] ) ) {
	$icon = $wppic_data->icons['svg'];
} elseif ( !empty( $wppic_data->icons['2x'] ) ) {
	$icon = $wppic_data->icons['2x'];
} elseif ( !empty( $wppic_data->icons['1x'] ) ) {
	$icon = $wppic_data->icons['1x'];
}

//Define card image
//$image is the custom image URL if you provided it
if( !empty( $image ) ){
	$bgImage = 'style="background-image: url(' . $image . ');"';
} else if( isset($icon) ) {
	$bgImage = 'style="background-image: url(https:' . esc_attr( $icon ) . ');"';
} else {
	$bgImage = 'data="no-image"';
}

//Plugin banner
$banner = '';
if ( !empty( $wppic_data->banners['low'] ) ) {
	$banner = '<img src="https:' . esc_attr( $wppic_data->banners['low'] ) . '" alt="' . $wppic_data->name . '" />';
}


/***************************************************************
 * Start template
 ***************************************************************/
?>
<div class="wp-pic-large" style="display: none;">
	<div class="wp-pic-large-content">
		<a class="wp-pic-asset-bg" href="<?php echo $wppic_data->url ?>" target="_blank" title="<?php _e('WordPress.org Plugin Page', 'wppic-translate') ?>">
			<?php echo $banner ?> 
			<span class="wp-pic-asset-bg-title"><span><?php echo $wppic_data->name ?></span></span>
		</a>
		<div class="wp-pic-half-first">
			<a class="wp-pic-logo" href="<?php echo $wppic_data->url ?>" <?php echo $bgImage ?> target="_blank" title="<?php _e('WordPress.org Plugin Page', 'wppic-translate') ?>"></a>
			<p class="wp-pic-author"><?php _e('Author(s):', 'wppic-translate') ?> <?php echo $wppic_data->author ?></p>
			<p class="wp-pic-version"><span><?php _e('Current Version:', 'wppic-translate') ?></span> <?php echo $wppic_data->version ?></p>
			<p class="wp-pic-updated"><span><?php _e('Last Updated:', 'wppic-translate') ?></span> <?php echo $wppic_data->last_updated ?></p>
			<p><a class="wp-pic-dl-link" href="<?php echo $wppic_data->download_link ?>" title="<?php _e('Direct download', 'wppic-translate') ?>"><?php echo basename($wppic_data->download_link) ?></a></p>
            <?php echo $wppic_data->credit ?>
		</div>
		<div class="wp-pic-half-last">
			<div class="wp-pic-bottom">
				<div class="wp-pic-bar">
					<a href="https://wordpress.org/support/view/plugin-reviews/<?php echo $wppic_data->slug ?>" class="wp-pic-rating" target="_blank" title="<?php _e('Ratings', 'wppic-translate') ?>">
						<?php echo $wppic_data->rating ?>%<em><?php _e('Ratings', 'wppic-translate') ?></em>
					</a>
					<a href="<?php echo $wppic_data->download_link ?>" class="wp-pic-downloaded" target="_blank" title="<?php _e('Direct download', 'wppic-translate') ?>">
						<?php echo $wppic_data->downloaded ?><em><?php _e('Downloads', 'wppic-translate') ?></em>
					</a>
					<a href="<?php echo $wppic_data->url ?>" class="wp-pic-requires" target="_blank" title="<?php _e('WordPress.org Plugin Page', 'wppic-translate') ?>">
						<?php echo $wppic_data->requires ?><em><?php _e('Requires', 'wppic-translate') ?></em>
					</a>
				</div>
			</div>
		</div>
	</div>	
</div>
<?php //end of template