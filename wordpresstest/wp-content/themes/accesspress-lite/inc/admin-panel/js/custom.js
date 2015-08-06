/**
 * Custom scripts needed for the colorpicker, image button selectors,
 * and navigation tabs.
 */

jQuery(document).ready(function($) {
	function accesspresslite_tabs() {

		// Hides all the .group sections to start
		$('.group').hide();

		// Find if a selected tab is saved in localStorage
		var active_tab = '';
		//if ( typeof(localStorage) != 'undefined' ) {
		//	active_tab = localStorage.getItem("active_tab");
		//}

		// If active tab is saved and exists, load it's .group
		if (active_tab != '' && $(active_tab).length ) {
			$(active_tab).fadeIn();
			$(active_tab + '-tab').addClass('nav-tab-active');
		} else {
			$('.group:first').fadeIn();
			$('.nav-tab-wrapper a:first').addClass('nav-tab-active');
		}

		// Bind tabs clicks
		$('.nav-tab-wrapper a').click(function(evt) {

			evt.preventDefault();

			// Remove active class from all tabs
			$('.nav-tab-wrapper a').removeClass('nav-tab-active');

			$(this).addClass('nav-tab-active').blur();

			var group = $(this).attr('href');

			//if (typeof(localStorage) != 'undefined' ) {
			//	localStorage.setItem("active_tab", $(this).attr('href') );
			//}

			$('.group').hide();
			$(group).fadeIn();


		});
	}

  $('#single_post_slider').click(function(){
    $('.post-as-slider').show();
    $('.cat-as-slider').hide();
  });

  $('#cat_post_slider').click(function(){
    $('.cat-as-slider').show();
    $('.post-as-slider').hide();
  });

  if($('#single_post_slider input').is(':checked')){
  	$('.post-as-slider').show();
  }

  if($('#cat_post_slider input').is(':checked')){
  	$('.cat-as-slider').show();
  }

	// Loads tabbed sections if they exist
	if ( $('.nav-tab-wrapper').length > 0 ) {
		accesspresslite_tabs();
	}

	$('.ap-popup-bg, .ap-popup-close').click(function(){
		$('.ap-popup-bg, .ap-popup-wrapper').fadeOut();
	});

	$('#upload-btn').click(function(){
		$('#form_options').attr('action','');
	});
});


