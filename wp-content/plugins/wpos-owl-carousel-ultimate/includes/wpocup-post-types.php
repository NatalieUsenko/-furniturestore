<?php
/**
 * Register Post type functionality
 *
 * @package Owl Carousel Ultimate
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to register post type
 * 
 * @package Owl Carousel Ultimate
 * @since 1.0.0
 */
function wpocup_register_post_type() {

	$wpocup_post_lbls = apply_filters( 'wpocup_post_labels', array(
								'name'                 	=> __('Owl Carousel', 'owl-carousel-ultimate'),
								'singular_name'        	=> __('Owl Carousel', 'owl-carousel-ultimate'),
								'add_new'              	=> __('Add Slide', 'owl-carousel-ultimate'),
								'add_new_item'         	=> __('Add New Slide', 'owl-carousel-ultimate'),
								'edit_item'            	=> __('Edit Owl Carousel', 'owl-carousel-ultimate'),
								'new_item'             	=> __('New Owl Carousel', 'owl-carousel-ultimate'),
								'view_item'            	=> __('View Owl Carousel', 'owl-carousel-ultimate'),
								'search_items'         	=> __('Search Slide', 'owl-carousel-ultimate'),
								'not_found'            	=> __('No Items found', 'owl-carousel-ultimate'),
								'not_found_in_trash'   	=> __('No Items found in Trash', 'owl-carousel-ultimate'),
								'parent_item_colon'    	=> '',
								'menu_name'            	=> __('Owl Carousel', 'owl-carousel-ultimate'),
								'featured_image'		=> __('Owl Slide Image', 'owl-carousel-ultimate'),
								'set_featured_image'	=> __('Set owl Slide image', 'owl-carousel-ultimate'),
								'remove_featured_image'	=> __('Remove Slide image', 'owl-carousel-ultimate'),
								'use_featured_image'	=> __('Use as owl Slide image', 'owl-carousel-ultimate'),
							));
	
	$wpocup_slider_args = array(
		'labels'				=> $wpocup_post_lbls,
		'public'              	=> false,
		'show_ui'             	=> true,
		'query_var'           	=> false,
		'rewrite'             	=> false,
		'capability_type'     	=> 'post',
		'hierarchical'        	=> false,
		'menu_icon'				=> 'dashicons-format-image',
		'supports'            	=> apply_filters('wpocup_post_supports', array('title','thumbnail', 'page-attributes')),
	);
	
	// Register wpoc-owl-carousel post type
	register_post_type( WPOCP_POST_TYPE, apply_filters( 'wpocup_registered_post_type_args', $wpocup_slider_args ) );
}

// Action to register plugin post type
add_action('init', 'wpocup_register_post_type');

/**
 * Function to register taxonomy
 * 
 * @package Owl Carousel Ultimate
 * @since 1.0.0
 */
function wpocup_register_taxonomies() {

	$wpocup_cat_lbls = apply_filters('wpocup_cat_labels', array(
		'name'              => __( 'Category', 'owl-carousel-ultimate' ),
		'singular_name'     => __( 'Category', 'owl-carousel-ultimate' ),
		'search_items'      => __( 'Search Category', 'owl-carousel-ultimate' ),
		'all_items'         => __( 'All Category', 'owl-carousel-ultimate' ),
		'parent_item'       => __( 'Parent Category', 'owl-carousel-ultimate' ),
		'parent_item_colon' => __( 'Parent Category:', 'owl-carousel-ultimate' ),
		'edit_item'         => __( 'Edit Category', 'owl-carousel-ultimate' ),
		'update_item'       => __( 'Update Category', 'owl-carousel-ultimate' ),
		'add_new_item'      => __( 'Add New Category', 'owl-carousel-ultimate' ),
		'new_item_name'     => __( 'New Category Name', 'owl-carousel-ultimate' ),
		'menu_name'         => __( 'Slider Category', 'owl-carousel-ultimate' ),
	));

    $wpocup_cat_args = array(
    	'public'			=> false,
        'hierarchical'      => true,
        'labels'            => $wpocup_cat_lbls,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => false,
    );
    
    // Register wpoc-owl-carousel category
    register_taxonomy( WPOCP_CAT, array( WPOCP_POST_TYPE ), apply_filters('wpocup_registered_cat_args', $wpocup_cat_args) );
}

// Action to register plugin taxonomies
add_action( 'init', 'wpocup_register_taxonomies');

/**
 * Function to update post message for team showcase
 * 
 * @package Owl Carousel Ultimate
 * @since 1.0.0
 */
function wpocup_post_updated_messages( $messages ) {
	
	global $post, $post_ID;
	
	$messages[WPOCP_POST_TYPE] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __( 'Slider updated.', 'owl-carousel-ultimate' ) ),
		2 => __( 'Custom field updated.', 'owl-carousel-ultimate' ),
		3 => __( 'Custom field deleted.', 'owl-carousel-ultimate' ),
		4 => __( 'Slider updated.', 'owl-carousel-ultimate' ),
		5 => isset( $_GET['revision'] ) ? sprintf( __( 'Slider restored to revision from %s', 'owl-carousel-ultimate' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __( 'Slider published.', 'owl-carousel-ultimate' ) ),
		7 => __( 'Slider saved.', 'owl-carousel-ultimate' ),
		8 => sprintf( __( 'Slider submitted.', 'owl-carousel-ultimate' ) ),
		9 => sprintf( __( 'Slider scheduled for: <strong>%1$s</strong>.', 'owl-carousel-ultimate' ),
		  date_i18n( 'M j, Y @ G:i', strtotime( $post->post_date ) ) ),
		10 => sprintf( __( 'Slider draft updated.', 'owl-carousel-ultimate' ) ),
	);
	
	return $messages;
}

// Filter to update slider post message
add_filter( 'post_updated_messages', 'wpocup_post_updated_messages' );