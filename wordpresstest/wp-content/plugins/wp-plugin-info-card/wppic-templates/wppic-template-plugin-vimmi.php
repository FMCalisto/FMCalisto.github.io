<?php
/***************************************************************
 * $wppic_data Object contain the following values: 
 * url, name, icons, banners, version, author, requires, rating, num_ratings, downloaded, last_updated, download_link
 ***************************************************************/

//Fix for requiered version with extra info. EG: WP 3.9, BP 2.1+
if( is_numeric( $wppic_data->requires ) ){
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
} else if( isset( $icon ) ) {
	$bgImage = 'style="background-image: url(https:' . esc_attr( $icon ) . ');"';
} else {
	$bgImage = 'data="no-image"';
}

//Plugin banner
$banner = '';
if ( !empty( $wppic_data->banners['low'] ) ) {
	$banner = 'style="background-image: url(https:' . esc_attr( $wppic_data->banners['low'] ) . ');"';
}


/***************************************************************
 * Start template
 ***************************************************************/
?>
<div class="wp-pic-flip" style="display: none;">
	<div class="wp-pic-face wp-pic-front">
		<a class="wp-pic-logo" href="<?php echo $wppic_data->url ?>" <?php echo $bgImage ?> target="_blank" title="<?php _e('INESC-ID', 'wppic-translate') ?>"></a>
		<div class="wp-pic-bottom">
			<div class="wp-pic-download">
				<span><?php _e('More info', 'wppic-translate') ?></span>
			</div>
		</div>
	</div>
	<div class="wp-pic-face wp-pic-back">
		<div class="wp-pic-bottom">
			<a class="wp-pic-page" target="_blank" title="<?php _e('Back', 'wppic-translate') ?>"><?php _e('Web Page', 'wppic-translate') ?></a>
		</div>
		<div class="wp-pic-goback" title="<?php _e('Back', 'wppic-translate') ?>"><span></span></div>
		<?php echo $wppic_data->credit ?>
	</div>
</div>
<?php //end of template