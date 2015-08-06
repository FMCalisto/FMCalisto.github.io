/* <![CDATA[ */
//hathor JavaScript 

jQuery(window).load(function($) {

	
	//MENU Animation
	if (jQuery(window).width() > 768) {
	jQuery('#navmenu ul > li').hoverIntent(function(){
	jQuery(this).find('.sub-menu:first, ul.children:first').slideDown({ duration: 200});
		jQuery(this).find('a').not('.sub-menu a').stop().animate({"color":primarycolor}, 200);
	}, function(){
	jQuery(this).find('.sub-menu:first, ul.children:first').slideUp({ duration: 200});	
		jQuery(this).find('a').not('.sub-menu a').stop().animate({"color":menutext}, 200);
	
	});

	jQuery('#navmenu ul li').not('#navmenu ul li ul li').hover(function(){
	jQuery(this).addClass('menu_hover');
	}, function(){
	jQuery(this).removeClass('menu_hover');	
	});
	jQuery('#navmenu li').has("ul").addClass('zn_parent_menu');
	jQuery('.zn_parent_menu > a').append('<span></span>');
	}
	











	//Comment Form
jQuery('.comment-form-author, .comment-form-email, .comment-form-url').wrapAll('<div class="field_wrap" />');

jQuery(".comment-reply-link").click(function () {
      jQuery('#respond_wrap .single_skew_comm, #respond_wrap .single_skew').hide();
    });
jQuery("#cancel-comment-reply-link").click(function () {
      jQuery('#respond_wrap .single_skew_comm, #respond_wrap .single_skew').show();
    });	
	
	
/**
	 * Scrolling to top of page
	 */	
	jQuery('.scrollup').click(function() {
		jQuery('html, body').animate({ scrollTop: 0 }, 2000, 'easeOutQuint');
		return false;
	}); 	
	
	
	
	
});










/* ]]> */