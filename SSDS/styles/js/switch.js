$(document).ready(function() {
    $('.switch-on').on('switch-change', function (e, data) {
        var $el = $(data.el)
          , value = data.value;
        if(value){//this is true if the switch is on
           $('.name-number-form').show();
        }else{
           $('.name-number-form').hide();
        }
    });
});