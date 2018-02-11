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
    add_theme_support( 'custom-logo' );

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
    wp_enqueue_style( 'bootstrap-style', get_template_directory_uri(). '/css/bootstrap.min.css' );
    wp_enqueue_style( 'grey-style', get_stylesheet_uri() );
    wp_register_style( 'font-style', 'https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' );
    wp_enqueue_style( 'font-style');

	wp_register_script( 'grey-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20180118', true );
	wp_enqueue_script( 'grey-script');
    wp_register_script( 'bootstrap-script', get_template_directory_uri() . '/js/bootstrap.min.js', true );
    wp_enqueue_script( 'bootstrap-script');
}
add_action( 'wp_enqueue_scripts', 'grey_scripts' );

function themename_custom_logo_setup() {
    $defaults = array(
        'height'      => 83,
        'width'       => 272,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    );
    add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'themename_custom_logo_setup' );

function my_acf_google_map_api( $api ){
    $api['key'] = 'AIzaSyAe_0rVt1WvsSNi8WGYeBWbUYqp3oiiubg';
    return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

add_shortcode('contact_form', 'contact_form' );
function contact_form(){
    $content = file_get_contents(get_template_directory().'/parts/form.php');
    return $content;
}

function cutString($string, $maxlen) {
    $len = (mb_strlen($string) > $maxlen)? mb_strripos(mb_substr($string, 0, $maxlen), ' ') : $maxlen;
    $cutStr = mb_substr($string, 0, $len);
    return (mb_strlen($string) > $maxlen)? $cutStr.' ...' : $cutStr;
}

function true_load_posts(){

    $args = unserialize( stripslashes( $_POST['query'] ) );
    $args['paged'] = $_POST['page'] + 1; // следующая страница
    $args['post_status'] = 'publish';

    // обычно лучше использовать WP_Query, но не здесь
    query_posts( $args );
    // если посты есть
    $content = '';
    if( have_posts() ) :

        // запускаем цикл
        while( have_posts() ): the_post();
            $content .= '<div class="col-md-6 post-list">';
            $content .= '<div class="post-list_img">'.the_post_thumbnail('thumbnail').'</div>';
            $content .= '<div class="post-list_date">'.get_the_date('d.m.Y').'</div>';
            $content .= '<div class="post-list_title">'.get_the_title().'</div>';
            $content .= '<div class="post-list_expert">'.cutString( get_the_content(), 120).'</div>';
            $content .= '<div class="post-list_link-more"><a href="'.get_the_permalink().'">Детальнее</a></div>';
            $content .= '</div>';
        endwhile;

    endif;
    //die();
    return $content;
}


add_action('wp_ajax_loadmore', 'true_load_posts');
add_action('wp_ajax_nopriv_loadmore', 'true_load_posts');