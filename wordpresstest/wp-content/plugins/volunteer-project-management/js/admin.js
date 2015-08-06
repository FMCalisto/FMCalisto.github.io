/**
 * @description Implement the rich layout for the module admin pages
 * @author Cláudio Esperança, Diogo Serra
 * @version 1.0
 */
var $j = jQuery.noConflict();

$j(function(){
    
    
    
    // Localize and set the common options for the calendars
    var calendarOptions = {
        closeText: vpmAdminL10n.closeText,
        currentText: vpmAdminL10n.currentText,
        dateFormat: vpmAdminL10n.dateFormat,
        dayNames: [
            vpmAdminL10n.dayNamesSunday,
            vpmAdminL10n.dayNamesMonday,
            vpmAdminL10n.dayNamesTuesday,
            vpmAdminL10n.dayNamesWednesday,
            vpmAdminL10n.dayNamesThursday,
            vpmAdminL10n.dayNamesFriday,
            vpmAdminL10n.dayNamesSaturday
        ],
        dayNamesMin: [
            vpmAdminL10n.dayNamesMinSu,
            vpmAdminL10n.dayNamesMinMo,
            vpmAdminL10n.dayNamesMinTu,
            vpmAdminL10n.dayNamesMinWe,
            vpmAdminL10n.dayNamesMinTh,
            vpmAdminL10n.dayNamesMinFr,
            vpmAdminL10n.dayNamesMinSa
        ],
        dayNamesShort: [
            vpmAdminL10n.dayNamesShortSun,
            vpmAdminL10n.dayNamesShortMon,
            vpmAdminL10n.dayNamesShortTue,
            vpmAdminL10n.dayNamesShortWed,
            vpmAdminL10n.dayNamesShortThu,
            vpmAdminL10n.dayNamesShortFri,
            vpmAdminL10n.dayNamesShortSat
        ],
        monthNames: [
            vpmAdminL10n.monthNamesJanuary,
            vpmAdminL10n.monthNamesFebruary,
            vpmAdminL10n.monthNamesMarch,
            vpmAdminL10n.monthNamesApril,
            vpmAdminL10n.monthNamesMay,
            vpmAdminL10n.monthNamesJune,
            vpmAdminL10n.monthNamesJuly,
            vpmAdminL10n.monthNamesAugust,
            vpmAdminL10n.monthNamesSeptember,
            vpmAdminL10n.monthNamesOctober,
            vpmAdminL10n.monthNamesNovember,
            vpmAdminL10n.monthNamesDecember
        ],
        monthNamesShort: [
            vpmAdminL10n.monthNamesShortJan,
            vpmAdminL10n.monthNamesShortFeb,
            vpmAdminL10n.monthNamesShortMar,
            vpmAdminL10n.monthNamesShortApr,
            vpmAdminL10n.monthNamesShortMay,
            vpmAdminL10n.monthNamesShortJun,
            vpmAdminL10n.monthNamesShortJul,
            vpmAdminL10n.monthNamesShortAug,
            vpmAdminL10n.monthNamesShortSep,
            vpmAdminL10n.monthNamesShortOct,
            vpmAdminL10n.monthNamesShortNov,
            vpmAdminL10n.monthNamesShortDec
        ],
        nextText: vpmAdminL10n.nextText,
        prevText: vpmAdminL10n.prevText,
        weekHeader: vpmAdminL10n.weekHeader,
        altFormat: "yy-m-d",
        autoSize: true,
        changeMonth: true,
        changeYear: true
    }, 
    timeDefaults = {
        'min': 0,
        'showOn': 'none',
        'width': 24,
        'mouseWheel': true,
        'step': 1,
        'largeStep': 1
    },
    startDate = null,
    endDate = null;
    
    
    // Hide the hidden elements
    $j(".start-hidden").hide();
    
    // Container function to show and style the fieldsets accordingly
    function showContainer(innerContainer, outerContainer, show){
        if(show){
            $j(outerContainer).addClass("vpm-visible");
            $j(innerContainer).show();
        }else{
            $j(innerContainer).hide();
            $j(outerContainer).removeClass("vpm-visible");
        }
    };
    
    $j("#vpm-enable-startdate").click(function(){
        showContainer("#vpm-startdate-container", "#vpm-enable-startdate-container", $j(this).is(":checked"));
        
        // Reset the minDate for the other calendar
        if(!$j(this).is(":checked")){
            $j("#vpm-enddate").datepicker("option", "minDate", null);
        }
    });
    $j("#vpm-enable-enddate").click(function(){
        showContainer("#vpm-enddate-container", "#vpm-enable-enddate-container", $j(this).is(":checked"));
        
        // Reset the minDate for the other calendar
        if(!$j(this).is(":checked")){
            $j("#vpm-startdate").datepicker("option", "maxDate", null);
        }
    });
    
    // Attach the date picker components and set their dates based on the timestamp values
    if($j("#vpm-hidden-startdate").val()){
        startDate = $j.datepicker.parseDate(calendarOptions.altFormat, $j("#vpm-hidden-startdate").val()) || null;
    }
    if($j("#vpm-hidden-enddate").val()){
        endDate = $j.datepicker.parseDate(calendarOptions.altFormat, $j("#vpm-hidden-enddate").val()) || null;
    }
    
    $j("#vpm-startdate").datepicker($j.extend(true, {}, calendarOptions, {
        defaultDate: "+1w",
        altField: "#vpm-hidden-startdate",
        maxDate: $j("#vpm-enable-enddate").is(":checked")?endDate:null,
        onSelect: function( selectedDate ) {
            if($j("#vpm-enable-enddate").is(":checked")){
                var instance = $j(this).data( "datepicker" ), 
                date = $j.datepicker.parseDate(instance.settings.dateFormat || $j.datepicker._defaults.dateFormat, selectedDate, instance.settings );
            
                $j("#vpm-enddate").datepicker( "option", "minDate", date );
            }else{
                $j("#vpm-enddate").datepicker( "option", "minDate", null );
            }
        }
    })).datepicker("setDate", startDate);
    
    $j("#vpm-enddate").datepicker($j.extend(true, {}, calendarOptions, {
        defaultDate: "+2w",
        altField: "#vpm-hidden-enddate",
        minDate: $j("#vpm-enable-startdate").is(":checked")?startDate:null,
        onSelect: function( selectedDate ) {
            if($j("#vpm-enable-startdate").is(":checked")){
                var instance = $j(this).data( "datepicker" ), 
                    date = $j.datepicker.parseDate(instance.settings.dateFormat || $j.datepicker._defaults.dateFormat, selectedDate, instance.settings );
                $j("#vpm-startdate").datepicker( "option", "maxDate", date );
            }else{
                $j("#vpm-startdate").datepicker( "option", "minDate", null );
            }
        }
    })).datepicker("setDate", endDate);
    
    // Set the initial visibility of the fieldsets
    showContainer("#vpm-startdate-container", "#vpm-enable-startdate-container", $j("#vpm-enable-startdate").is(":checked"));
    showContainer("#vpm-enddate-container", "#vpm-enable-enddate-container", $j("#vpm-enable-enddate").is(":checked"));
    

    // Since the link exists, we need to handle the case when the user clicks on it...
    $j('#vpm_projectFile_delete:checkbox').click(function(evt) {


            if($j(this).attr('checked')){
                // Hide the view link
                $j('a#vpm_projectFile_view').hide();
            }else{
                // Show the view link
                $j('a#vpm_projectFile_view').show();
            }

    });

    $j("#vpm_projectFile_download").click(function(){
        var old = parseInt($j('#vpm-downloadCounter').html(),10);
        $j('#vpm-downloadCounter').html(old+1);
        return true;
    });
    
});