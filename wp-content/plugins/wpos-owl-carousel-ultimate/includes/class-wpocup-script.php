<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package owl-carousel-ultimate
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wpocup_Script {
	
	function __construct() {
		
		// Action to add style at front side
		add_action( 'wp_enqueue_scripts', array($this, 'wpocup_front_style') );
		
		// Action to add script at front side
		add_action( 'wp_enqueue_scripts', array($this, 'wpocup_front_script') );
		
		// Action to add style in backend
		add_action( 'admin_enqueue_scripts', array($this, 'wpocup_admin_style') );
		
		// Action to add script at admin side
		add_action( 'admin_enqueue_scripts', array($this, 'wpocup_admin_script') );
		
		// Action to add custom css in head
		add_action( 'wp_head', array($this, 'wpocup_add_custom_css'), 20 );
	}

	/**
	 * Function to add style at front side
	 * 
	 * @package owl-carousel-ultimate
	 * @since 1.0.0
	 */
	function wpocup_front_style() {		
		
		// Registring and enqueing slick slider css
		if( !wp_style_is( 'wpos-owl-style', 'registered' ) ) {
			wp_register_style( 'wpos-owl-style', WPOCP_URL.'assets/css/owl.carousel.css', array(), WPOCP_VERSION );
			wp_enqueue_style( 'wpos-owl-style' );
		}
		
		// Registring and enqueing public css
		wp_register_style( 'wpocup-public-style', WPOCP_URL.'assets/css/wpocup-public.css', array(), WPOCP_VERSION );
		wp_enqueue_style( 'wpocup-public-style' );
	}
	
	/**
	 * Function to add script at front side
	 * 
	 * @package owl-carousel-ultimate
	 * @since 1.0.0
	 */
	function wpocup_front_script() {		
		// Registring slick slider script
		if( !wp_script_is( 'wpos-owl-jquery', 'registered' ) ) {
			wp_register_script( 'wpos-owl-jquery', WPOCP_URL.'assets/js/owl.carousel.min.js', array('jquery'), WPOCP_VERSION, true );
		}		
		// Registring and enqueing public script
		wp_register_script( 'wpocup-public-script', WPOCP_URL.'assets/js/wpocup-public.js', array('jquery'), WPOCP_VERSION, true );		
	}

	/**
	 * Enqueue admin styles
	 * 
	 * @package owl-carousel-ultimate
	 * @since 1.2.5
	 */
	function wpocup_admin_style( $hook ) {

		global $typenow;

		// Pages array
		$pages_array = array( WPOCP_POST_TYPE );
		
		// If page is plugin setting page then enqueue script
		if( in_array($typenow, $pages_array) ) {
			
			// Registring admin script
			wp_register_style( 'wpocup-admin-style', WPOCP_URL.'assets/css/wpocup-admin.css', null, WPOCP_VERSION );
			wp_enqueue_style( 'wpocup-admin-style' );
		}
	}

	/**
	 * Function to add script at admin side
	 * 
	 * @package owl-carousel-ultimate
	 * @since 1.2.5
	 */
	function wpocup_admin_script( $hook ) {
		
		global $wp_version, $wp_query, $post_type;		

		// Slider sorting - only when sorting by menu order on the blog listing page
		if ( $post_type == WPOCP_POST_TYPE && isset( $wp_query->query['orderby'] ) && $wp_query->query['orderby'] == 'menu_order title' ) {
			wp_register_script( 'wpocup-ordering', WPOCP_URL . 'assets/js/wpocup-ordering.js', array( 'jquery-ui-sortable' ), WPOCP_VERSION, true );
			wp_enqueue_script( 'wpocup-ordering' );
		}
	}

	/**
	 * Add custom css to head
	 * 
	 * @package owl-carousel-ultimate
	 * @since 1.2.5
	 */
	function wpocup_add_custom_css() {

		$custom_css = wpocup_get_option('custom_css');
		
		if( !empty($custom_css) ) {
			$css  = '<style type="text/css">' . "\n";
			$css .= $custom_css;
			$css .= "\n" . '</style>' . "\n";

			echo $css;
		}
	}
}

$wpocup_script = new Wpocup_Script();