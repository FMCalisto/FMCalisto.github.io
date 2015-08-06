<?php
/***************************************************************
 * $wppic_data Object contain the following values: 
 * slug, url, name, version, author, screenshot_url, rating, num_ratings, downloaded, last_updated, homepage, download_link
 ***************************************************************/

//ScreenShot URL
//$image is the custom image URL if you provided it
$banner = '';
if( !empty( $image ) ){
	$banner = '<img src="' . $image . '" alt="' . $wppic_data->name . '" />';
} else if( !empty( $wppic_data->screenshot_url ) ){
	$banner = '<img src="https:' . esc_attr( $wppic_data->screenshot_url ) . '" alt="' . $wppic_data->name . '" />';
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
					<a href="https://wordpress.org/support/view/theme-reviews/<?php echo $wppic_data->slug ?>" class="wp-pic-rating" target="_blank" title="<?php _e('Ratings', 'wppic-translate') ?>">
						<?php echo $wppic_data->rating ?>%<em><?php _e('Ratings', 'wppic-translate') ?></em>
					</a>
					<a href="<?php echo $wppic_data->download_link ?>" class="wp-pic-downloaded" target="_blank" title="<?php _e('Direct download', 'wppic-translate') ?>">
						<?php echo $wppic_data->downloaded ?><em><?php _e('Downloads', 'wppic-translate') ?></em>
					</a>
					<a href="<?php echo $wppic_data->url ?>" class="wp-pic-version" target="_blank" title="<?php _e('WordPress.org Plugin Page', 'wppic-translate') ?>">
						<?php echo $wppic_data->version ?><em><?php _e('Version', 'wppic-translate') ?></em>
					</a>
				</div>
			</div>
		</div>
	</div>	
</div>
<?php //end of template