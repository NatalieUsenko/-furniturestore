<?php
/**
 * Plugin generic functions file
 *
 * @package Owl Carousel Ultimate
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Update default settings
 * 
 * @package Owl Carousel Ultimate
 * @since 1.0
 */
function wpocup_default_settings() {
  
    global $wpocup_options;

    $wpocup_options = array(
        'default_img' => '',
        'custom_css'  => '',
    );
    
    $default_options = apply_filters('wpocup_options_default_values', $wpocup_options );
    
    // Update default options
    update_option( 'wpocup_options', $default_options );
    
    // Overwrite global variable when option is update
    $wpocup_options = wpocup_get_settings();
}

/**
 * Get Settings From Option Page
 * 
 * Handles to return all settings value
 * 
 * @package Owl Carousel Ultimate
 * @since 1.0
 */
function wpocup_get_settings() {
  
    $options    = get_option('wpocup_options');
    $settings   = is_array($options)  ? $options : array();

    return $settings;
}

/**
 * Get an option
 * Looks to see if the specified setting exists, returns default if not
 * 
 * @package Owl Carousel Ultimate
 * @since 1.2.5
 */
function wpocup_get_option( $key = '', $default = false ) {
    global $wpocup_options;

    $value = ! empty( $wpocup_options[ $key ] ) ? $wpocup_options[ $key ] : $default;
    $value = apply_filters( 'wpocup_get_option', $value, $key, $default );
    
    return apply_filters( 'wpocup_get_option_' . $key, $value, $key, $default );
}

/**
 * Escape Tags & Slashes
 *
 * Handles escapping the slashes and tags
 *
 * @package Owl Carousel Ultimate
 * @since 1.0
 */
function wpocup_esc_attr($data) {
    return esc_attr( stripslashes($data) );
}

/**
 * Strip Slashes From Array
 *
 * @package Owl Carousel Ultimate
 * @since 1.0
 */
function wpocup_slashes_deep($data = array(), $flag = false) {
  
    if($flag != true) {
        $data = wpocup_nohtml_kses($data);
    }
    $data = stripslashes_deep($data);
    return $data;
}

/**
 * Strip Html Tags 
 * 
 * It will sanitize text input (strip html tags, and escape characters)
 * 
 * @package Owl Carousel Ultimate
 * @since 1.0
 */

function wpocup_nohtml_kses($data = array()) {
  
  if ( is_array($data) ) {
    
    $data = array_map('wpocup_nohtml_kses', $data);
    
  } elseif ( is_string( $data ) ) {
    $data = trim( $data );
    $data = wp_filter_nohtml_kses($data);
  }
  
  return $data;
}

/**
 * Function to unique number value
 * 
 * @package Owl Carousel Ultimate
 * @since 1.0
 */
function wpocup_get_unique() {
	static $unique = 0;
	$unique++;

	return $unique;
}

/**
 * Function to add array after specific key
 * 
 * @package Owl Carousel Ultimate
 * @since 1.0
 */
function wpocup_array(&$array, $value, $index, $from_last = false) {
    
    if( is_array($array) && is_array($value) ) {

        if( $from_last ) {
            $total_count    = count($array);
            $index          = (!empty($total_count) && ($total_count > $index)) ? ($total_count-$index): $index;
        }
        
        $split_arr  = array_splice($array, max(0, $index));
        $array      = array_merge( $array, $value, $split_arr);
    }
    
    return $array;
}

/**
 * Function to get post featured image
 * 
 * @package Owl Carousel Ultimate
 * @since 1.0
 */
function wpocup_get_post_featured_image( $post_id = '', $size = 'full', $default_img = false ) {
    $size   = !empty($size) ? $size : 'full';
    $image  = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size );

    if( !empty($image) ) {
        $image = isset($image[0]) ? $image[0] : '';
    }

    // Getting default image
    if( $default_img && empty($image) ) {
        $image = wpocup_get_option( 'default_img' );
    }

    return $image;
}


/**
 * Function to get 'wpoc-owl-carousel' shortcode designs
 * 
 * @package Owl Carousel Ultimate
 * @since 1.2.5
 */
function wpocup_carousel_designs() {
    $design_arr = array(
		'prodesign-1'  	=> __('Design 1', 'owl-carousel-ultimate'),        
	);
	return apply_filters('wpocup_carousel_designs', $design_arr );
}

/**
 * Function to get 'wpoc-owl-autowidth' shortcode designs
 * 
 * @package Owl Carousel Ultimate
 * @since 1.2.5
 */
function wpocup_autowidth_designs() {
    $design_arr = array(
		'prodesign-1'  	=> __('Design 1', 'owl-carousel-ultimate'),       
	);
	return apply_filters('wpocup_autowidth_designs', $design_arr );
}