<?php
/**
 * Plugin Name: Owl Carousel 2 Ultimate
 * Plugin URI: https://www.wponlinesupport.com/plugins
 * Description: Owl Carousel 2 : Touch enabled WordPress plugin that lets you create a beautiful responsive carousel slider.
 * Author: WP Online Support
 * Author URI: https://www.wponlinesupport.com
 * Text Domain: owl-carousel-ultimate
 * Domain Path: languages
 * Version: 1.1.1
 * 
 * @package WordPress
 * @author WP Online Support
 */

/**
 * Basic plugin definitions
 * 
 * @package Owl Carousel Ultimate
 * @since 1.0.0
 */
if( !defined( 'WPOCP_VERSION' ) ) {
	define( 'WPOCP_VERSION', '1.1.1' ); // Version of plugin
}
if( !defined( 'WPOCP_DIR' ) ) {
    define( 'WPOCP_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( !defined( 'WPOCP_URL' ) ) {
    define( 'WPOCP_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}
if( !defined( 'WPOCP_PLUGIN_BASENAME' ) ) {
	define( 'WPOCP_PLUGIN_BASENAME', plugin_basename( __FILE__ ) ); // plugin base name
}
if( !defined( 'WPOCP_POST_TYPE' ) ) {
    define( 'WPOCP_POST_TYPE', 'wpocup_slider' ); // Plugin post type
}
if( !defined( 'WPOCP_CAT' ) ) {
    define( 'WPOCP_CAT', 'wpocup_category' ); // Plugin category name
}
if( !defined( 'WPOCP_META_PREFIX' ) ) {
    define( 'WPOCP_META_PREFIX', '_wpocup_' ); // Plugin metabox prefix
}

/**
 * Load Text Domain
 * This gets the plugin ready for translation
 * 
 * @package Owl Carousel Ultimate
 * @since 1.0.0
 */
function wpocup_load_textdomain() { 

    global $wp_version;

    // Set filter for plugin's languages directory
    $wpocup_lang_dir = dirname( plugin_basename( __FILE__ ) ) . '/languages/';
    $wpocup_lang_dir = apply_filters( 'wpocup_languages_directory', $wpocup_lang_dir );
    
    // Traditional WordPress plugin locale filter.
    $get_locale = get_locale();

    if ( $wp_version >= 4.7 ) {
        $get_locale = get_user_locale();
    }

    // Traditional WordPress plugin locale filter
    $locale = apply_filters( 'plugin_locale',  $get_locale, 'owl-carousel-ultimate' );
    $mofile = sprintf( '%1$s-%2$s.mo', 'owl-carousel-ultimate', $locale );

    // Setup paths to current locale file
    $mofile_global  = WP_LANG_DIR . '/plugins/' . basename( WPOCP_DIR ) . '/' . $mofile;

    if ( file_exists( $mofile_global ) ) { // Look in global /wp-content/languages/plugin-name folder
        load_textdomain( 'owl-carousel-ultimate', $mofile_global );
    } else { // Load the default language files
        load_plugin_textdomain( 'owl-carousel-ultimate', false, $wpocup_lang_dir );
    }
}
add_action('plugins_loaded', 'wpocup_load_textdomain');

/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 * 
 * @package Owl Carousel Ultimate
 * @since 1.0.0
 */
register_activation_hook( __FILE__, 'wpocup_install' );

/**
 * Deactivation Hook
 * 
 * Register plugin deactivation hook.
 * 
 * @package Owl Carousel Ultimate
 * @since 1.0.0
 */
register_deactivation_hook( __FILE__, 'wpocup_uninstall');

/**
 * Plugin Setup (On Activation)
 * 
 * Does the initial setup,
 * stest default values for the plugin options.
 * 
 * @package Owl Carousel Ultimate
 * @since 1.0.0
 */
function wpocup_install() {

	// Get settings for the plugin
    $wpocup_options = get_option( 'wpocup_options' );
    
    if( empty( $wpocup_options ) ) { // Check plugin version option
        
        // Set default settings
        wpocup_default_settings();
        
        // Update plugin version to option
        update_option( 'wpocup_plugin_version', '1.0' );
    }

    // Register post type function
	wpocup_register_post_type();
    wpocup_register_taxonomies();

    // IMP need to flush rules for custom registered post type
    flush_rewrite_rules();	
}

/**
 * Plugin Setup (On Deactivation)
 * 
 * Delete  plugin options.
 * 
 * @package Owl Carousel Ultimate
 * @since 1.0.0
 */
function wpocup_uninstall() {
    
    // IMP need to flush rules for custom registered post type
    flush_rewrite_rules();
}

// Taking some globals
global $wpocup_options;

// Functions File
require_once( WPOCP_DIR . '/includes/wpocup-functions.php' );
$wpocup_options = wpocup_get_settings();

// Plugin Post Type File
require_once( WPOCP_DIR . '/includes/wpocup-post-types.php' );

// Script Class File
require_once( WPOCP_DIR . '/includes/class-wpocup-script.php' );

// Admin Class File
require_once( WPOCP_DIR . '/includes/admin/class-wpocup-admin.php' );

// Shortcode File
require_once( WPOCP_DIR . '/includes/shortcode/wpocup-carousel.php' );
require_once( WPOCP_DIR . '/includes/shortcode/wpocup-auto-width.php' );

// How it work file, Load admin files
if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
    require_once( WPOCP_DIR . '/includes/admin/wpocup-how-it-work.php' );	
}