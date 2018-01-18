<?php
add_filter('pre_site_transient_update_core',create_function('$a', "return null;"));
wp_clear_scheduled_hook('wp_version_check');
remove_action('load-update-core.php','wp_update_themes');
add_filter('pre_site_transient_update_themes',create_function('$a', "return null;"));
wp_clear_scheduled_hook('wp_update_themes');
remove_action( 'load-update-core.php', 'wp_update_plugins' );
add_filter( 'pre_site_transient_update_plugins', create_function( '$a', "return null;" ) );
wp_clear_scheduled_hook( 'wp_update_plugins' );

if ( ! function_exists( 'grey_setup' ) ) :
function grey_setup(){
    load_theme_textdomain('grey');
    add_theme_support('title-tag');

    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(825, 510, true);

    register_nav_menus(array(
        'primary' => __('Primary Menu', 'grey'),
        'social' => __('Social Links Menu', 'grey'),
    ));
}
add_action( 'after_setup_theme', 'grey_setup' );
endif;

function grey_scripts() {
	wp_enqueue_style( 'grey-style', get_stylesheet_uri() );
    wp_enqueue_style( 'bootstrap-style', get_template_directory_uri() . '/css/bootstrap.min.css' );
    wp_enqueue_style( 'font-style', 'https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' );

	wp_enqueue_script( 'grey-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20180118', true );
    wp_enqueue_script( 'bootstrap-script', get_template_directory_uri() . '/js/bootstrap.min.js', true );
}
add_action( 'wp_enqueue_scripts', 'grey_scripts' );

function my_acf_google_map_api( $api ){
    $api['key'] = 'AIzaSyAe_0rVt1WvsSNi8WGYeBWbUYqp3oiiubg';
    return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');