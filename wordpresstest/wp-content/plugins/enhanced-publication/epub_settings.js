jQuery(document).ready(function($) {
    $('#epub-option-tabs').tabs();
    $('.epub_users').suggest(ajaxurl + '?action=epub_site_editors',
        { delay: 100, multiple: true, multipleSep: ", "});

    $('#epub-conversion-form').dialog({
        autoOpen: false,
        height: 'auto',
        width: 400,
        modal: true,
        buttons: {
            "Convert": function() {
                var dialog = $(this);
                var data = $(this).closest('form').serialize();
                $.post(ajaxurl + '?action=epub_conversion', data, function(result){
                    $('#convert-result').html(result);
                });
            },
            Cancel: function() {
                $( this ).dialog("close");
            }
        }
    });

    $('#epub-conversion').click(function() {
        $('#epub-conversion-form').dialog('open');
    });
});
