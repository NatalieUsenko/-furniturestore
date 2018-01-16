<?php

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

    add_theme_support('html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
    ));

    add_theme_support('custom-logo', array(
        'height' => 248,
        'width' => 248,
        'flex-height' => true,
    ));
}
add_action( 'after_setup_theme', 'grey_setup' );
endif;

function grey_scripts() {
	wp_enqueue_style( 'grey-style', get_stylesheet_uri() );
	wp_enqueue_script( 'grey-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20150330', true );
}
add_action( 'wp_enqueue_scripts', 'grey_scripts' );