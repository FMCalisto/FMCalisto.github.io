/**
 * @description Implement the rich layout for the module admin pages
 * @author Cláudio Esperança, Diogo Serra
 * @version 1.0
 */
var $j = jQuery.noConflict();

$j(function(){
    
    
    
   if($j("#plugin_cap_check").attr('checked')){
       $j("#vpm-cap-container").show();
   }
        
    $j("#plugin_cap_check").click(function(){
        
        if(this.checked){
            $j("#vpm-cap-container").show();
        }else{
            $j("#vpm-cap-container").hide();
        }
    });
    
});