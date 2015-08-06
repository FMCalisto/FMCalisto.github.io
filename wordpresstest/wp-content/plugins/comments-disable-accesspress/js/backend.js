(function ($) {
    $(function () {
	   //All the backend js for the plugin 
       
       $('input[name="all"]').click(function(){
          if($(this).val()==1){
              $('.cdap-post-types').attr('disabled','disabled');
          }
          else
          {
              $('.cdap-post-types').removeAttr('disabled');
          }
       });
       
       $('.cdap-tabs-trigger').click(function(){
           $('.cdap-tabs-trigger').closest('li').removeClass('cdap-active-tab');
           $(this).closest('li').addClass('cdap-active-tab');
          var attr_id = $(this).attr('id');
          var arr_id = attr_id.split('-');
          var id = arr_id[1];
          $('.cdap-inner-section').hide();
          $('.cdap-'+id).show();
       });
	   
	});
}(jQuery));
