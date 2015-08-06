/**
 * Plugin Name: WP Plugin Info Card by b*web
 * Plugin URI: http://b-website.com/
 * Author: Brice CAPOBIANCO - b*web
 */	
jQuery(document).ready(function($) {
	
	// fadeIn on page load
	$('.wp-pic > div').fadeIn(600);
	
	$('.wp-pic').delegate('.wp-pic-flip', 'mouseover', function() {
		$('.wp-pic-flip').each(function(){
			var timeoutFlip;
			var $this = $(this);
			$this.on('mouseenter', function() {
				clearTimeout(timeoutFlip);
			}).on('mouseleave', function() {
				timeoutFlip = setTimeout( function () {
					$this.removeClass('wp-pic-flipped');
				 }, 2000);
			});
		});
	});

	$('.wp-pic').on('click','.wp-pic-download', function(){
		$(this).closest('.wp-pic-flip').addClass('wp-pic-flipped');
		return true;
	});

	$('.wp-pic').on('click','.wp-pic-goback', function(){
		$(this).closest('.wp-pic-flip').removeClass('wp-pic-flipped');
		return true;
	});

	$('.wp-pic').on('click','.wp-pic-dl-ico, .wp-pic-dl-link', function(){
		$(this).closest('.wp-pic-back').find('.wp-pic-dl-ico').addClass('wp-pic-dl-effet');
		setTimeout( function () {
			$('.wp-pic-dl-ico.wp-pic-dl-effet').removeClass('wp-pic-dl-effet');
		}, 1200);
		return true;
	});


	//Card ajax load
	if ($('.wp-pic.wp-pic-ajax').length > 0){

		//ajax request and callback
		$('.wp-pic.wp-pic-ajax').each(function(){
			var $this = $(this);
			var data = {
				'action': 'async_wppic_shortcode_content',
				'type': $this.data('type'),
				'slug': $this.data('slug'),
				'image': $this.data('image'),
				'expiration': $this.data('expiration'),
				'layout': $this.data('layout'),
			};
			$.post(wppicAjax.ajaxurl, data, function(response) {
				$this.append(response);
				$this.find('div').fadeIn(600, function() {
					$this.find('.wp-pic-body-loading').remove();
				});
			});
		});
		
	}

});