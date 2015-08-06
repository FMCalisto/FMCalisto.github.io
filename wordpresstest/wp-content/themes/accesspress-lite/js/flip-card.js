/* === Register Flip Card Function === */

function ontouchmove()
{
    // Register the script like this for a plugin:
    wp_register_script( 'custom-script', plugins_url( '/js/custom-script.js', __FILE__ ) );
    // or
    // Register the script like this for a theme:
    wp_register_script( 'custom-script', get_template_directory_uri() . '/js/custom-script.js' );
 
    // For either a plugin or a theme, you can then enqueue the script:
    wp_enqueue_script( 'custom-script' );
}
add_action( 'wp_enqueue_scripts', 'wptuts_scripts_basic' );

/* === Flip Card === */

document.ontouchmove = function(event) {
  event.preventDefault();
}

$(document).ready(function() {
  $('.cci-press-card__wrap').on("click", function() {
    $(this).toggleClass('rotate-3d');
    $('.card--back').toggleClass('z-up');
  })
})