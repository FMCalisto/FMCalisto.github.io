/**
 * Plugin Name: WP Plugin Info Card by b*web
 * Author: Brice CAPOBIANCO - b*web
 */
jQuery(document).ready(function($) {
	
	function wppicMediaLibrary(){
		$('i.mce-i-wppic-icon').live('click', function(){
				setTimeout(function() {
				$('.mce-wppic-media').after( "<span class='mce-wppic-media-button'>+</span>" );
			}, 100);
		});
		
		$('.mce-wppic-media-button').live('click', function(){
			var $this = $(this);
			 var wireframe;
			 if (wireframe) {
				 wireframe.open();
				 return;
			 }
	
			 wireframe = wp.media.frames.wireframe = wp.media({
				 /*title: 'Media Library Title',
				 button: {
					 text: 'Media Library Button Title'
				 },*/
				 multiple: false
			 });
	
			 wireframe.on('select', function() {
				attachment = wireframe.state().get('selection').first().toJSON();
				$this.parent().find('.mce-wppic-media').val(attachment.url);
			 });
	
			 wireframe.open();
		});
	};
	wppicMediaLibrary();
							
});