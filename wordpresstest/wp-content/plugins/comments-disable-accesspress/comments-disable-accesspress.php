<?php
if (!defined('ABSPATH'))
    die('No script kiddies please!');
/**
 * Plugin Name: Comments Disable - AccessPress
 * Plugin URI: http://accesspressthemes.com/plugins
 * Description: A plugin to disable plugin globally with various configurable options
 * Version: 1.0.1
 * Author: AccessPress Themes
 * Author URI: http://accesspressthemes.com
 * Text Domain: ap-comments-disable
 * Domain Path: /languages/
 * License: GPL2
 */
/**
 * Some Necessary Constants
 * */
if (!defined('CDAP_VERSION')) {
    define('CDAP_VERSION', '1.0.1'); // plugin version information
}

if (!defined('CDAP_TD')) {
    define('CDAP_TD', 'ap-comments-disable'); //plugin text domain 
}

if (!defined('CDAP_IMG_DIR')) {
    define('CDAP_IMG_DIR', plugin_dir_url(__FILE__) . 'images');
}

if (!defined('CDAP_JS_DIR')) {
    define('CDAP_JS_DIR', plugin_dir_url(__FILE__) . 'js');
}

if (!defined('CDAP_CSS_DIR')) {
    define('CDAP_CSS_DIR', plugin_dir_url(__FILE__) . 'css');
}

/**
 * Declaration of class
 * */
if (!class_exists('Comments_Disable_AP')) {

    class Comments_Disable_AP {

        var $cdap_settings;

        /**
         * Constructor
         * */
        function __construct() {
            $this->cdap_settings = get_option('cdap_settings');
            add_action('init', array($this, 'plugin_text_domain')); // loads plugin text domain
            add_action('admin_init', array($this, 'session_init')); //starts session on init
            register_activation_hook(__FILE__, array($this, 'load_default_settings')); //loads default settings for the plugin while activating the plugin
            add_action('admin_menu', array($this, 'plugin_option_page')); //adds plugin menu in settings submenu
            add_action('admin_enqueue_scripts', array($this, 'register_admin_assets')); //register plugin scripts and css in wp-admin
            add_action('admin_post_cdap_settings_save', array($this, 'save_settings')); //action to grab plugin settings
            add_action('wp_loaded', array($this, 'disable_comments'));
            add_filter( 'comments_open', array( $this, 'check_comments_open'), 10, 2 ); // override comments open status as per settings
            add_filter( 'pings_open', array( $this, 'check_comments_open' ), 20, 2 );
        }

        /**
         * Loads Plugin Text Domain for translation
         * */
        function plugin_text_domain() {
            load_plugin_textdomain(CDAP_TD, false, basename(dirname(__FILE__)) . '/languages/');
        }

        /**
         * Starts session on admin_init hook
         */
        function session_init() {
            if (!session_id()) {
                session_start();
            }
        }

        /**
         * Add Default Options on plugin activation
         * */
        function load_default_settings() {
            $cdap_settings = get_option('cdap_settings');
            if( !$cdap_settings ){
                $cdap_settings = $this->get_default_settings();
                update_option('cdap_settings', $cdap_settings);
            }
        }

        /**
         * Returns default settings
         * */
        function get_default_settings() {
            $cdap_settings = array('all' => 0, 'post_types' => array());
            return $cdap_settings;
        }

        function plugin_option_page() {
            add_options_page(__('AccessPress Comments Disable', CDAP_TD), __('AccessPress Comments Disable', CDAP_TD), 'manage_options', 'comments-disable-ap', array($this, 'plugin_settings'));
        }

        /**
         * Plugin Settings Page
         * */
        function plugin_settings() {
            include('inc/plugin-settings.php');
        }

        /**
         * Returns all the registered post types
         */
        function get_registered_post_types() {
            $post_types = get_post_types();
            unset($post_types['revision']);
            unset($post_types['nav_menu_item']);
            return $post_types;
        }

        /**
         * Registers js and css for admin
         */
        function register_admin_assets() {
            if (isset($_GET['page']) && $_GET['page'] == 'comments-disable-ap') {
                wp_enqueue_script('cdap-admin-js', CDAP_JS_DIR . '/backend.js', array('jquery'), CDAP_VERSION, true);
                wp_enqueue_style('cdap-admin-css', CDAP_CSS_DIR . '/backend-style.css', array(), CDAP_VERSION);
                wp_enqueue_style('cdap-fontawesome-css', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css', CDAP_VERSION );
            }
        }

        /**
         * Prints array in pre format
         */
        function print_array($array) {
            echo "<pre>";
            print_r($array);
            echo "</pre>";
        }

        /**
         * Saves settings to option table
         */
        function save_settings() {
            if ( !empty( $_POST ) && wp_verify_nonce( $_POST['cdap_settings_nonce'], 'cdap_settings_save') ) {
                $all = isset($_POST['all']) ? $_POST['all'] : 0;
                $post_types = isset( $_POST['post_types'] ) ? $_POST['post_types'] : array();
                $cdap_settings = array( 'all' => $all, 'post_types' => $post_types );
                update_option( 'cdap_settings', $cdap_settings );
                $_SESSION['cdap_message'] = __( 'Changes Saved Successfully', CDAP_TD );
                wp_redirect( admin_url() . 'options-general.php?page=comments-disable-ap' );
                exit;
            } else {
                die('No script kiddies please!');
            }
        }

        /**
         * Disables comments related fields from edit screens as per settings
         */
        function disable_comments() {
            $cdap_settings = $this->cdap_settings;
            if ( $cdap_settings['all'] == 1 ) {
                $post_types = $this->get_registered_post_types();
            } else {
                $post_types = $cdap_settings['post_types'];
            }
            foreach ( $post_types as $post_type ) {
                if ( post_type_supports( $post_type, 'comments' ) ) {
                    remove_post_type_support( $post_type, 'comments' );
                }
                if ( post_type_supports( $post_type, 'trackbacks' ) ) {
                    remove_post_type_support( $post_type, 'trackbacks' );
                }
            }
        }
        
        /**
         * Checks if comments are open for the disabled post types
         */
        function check_comments_open( $open, $post_id ){
            $post = get_post( $post_id );
            $cdap_settings = $this->cdap_settings;
            if($cdap_settings['all']==1){
                return false;
            }
            else
            {
                $post_type = $post->post_type;
                return ( in_array($post_type,$cdap_settings['post_types']))?false:$open;
            }
            
        }

    }

    /**
     * Execution of the plugin
     */
    $cdap_obj = new Comments_Disable_AP();
}