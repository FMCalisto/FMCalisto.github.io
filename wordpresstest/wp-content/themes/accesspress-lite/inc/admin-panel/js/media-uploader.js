jQuery(document).ready(function($){
  var _custom_media = true,
      _orig_send_attachment = wp.media.editor.send.attachment;

  $('.accesspresslite_fav_icon .button').click(function(e) {
    var send_attachment_bkp = wp.media.editor.send.attachment;
    var button = $(this);
    var id = button.attr('id').replace('_button', '');
    _custom_media = true;
    wp.media.editor.send.attachment = function(props, attachment){
      if ( _custom_media ) {
        $("#"+id).val(attachment.url);
        $('#accesspresslite_media_image').fadeIn();
        $("#accesspresslite_show_image").attr('src',attachment.url);
      } else {
        return _orig_send_attachment.apply( this, [props, attachment] );
      };
    }

    wp.media.editor.open(button);
    return false;
  });

  $('#accesspresslite_fav_icon_remove').click(function(){
  	$('#accesspresslite_media_image').hide();
  	$('#accesspresslite_media_image img').attr('src','');
  	$('#accesspresslite_media_upload').val('');
  });

  });