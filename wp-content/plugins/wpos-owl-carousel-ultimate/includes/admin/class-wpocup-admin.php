<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package Owl Carousel Ultimate
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wposup_Admin {

	function __construct() {
		
		// Action to add metabox
		add_action( 'add_meta_boxes', array($this, 'wpocup_post_sett_metabox') );

		// Action to save metabox
		add_action( 'save_post', array($this, 'wpocup_save_metabox_value') );

		// Action to register admin menu
		add_action( 'admin_menu', array($this, 'wpocup_register_menu') );

		// Action to register plugin settings
		add_action ( 'admin_init', array($this, 'wpocup_register_settings') );

		// Action to add category filter dropdown
		add_action( 'restrict_manage_posts', array($this, 'wpocup_add_post_filters'), 50 );

		// Filter to add row data
		add_filter( 'post_row_actions', array($this, 'wpocup_add_post_row_data'), 10, 2 );

		// Filter to add extra column in slider `category` table
		add_filter( 'manage_edit-'.WPOCP_CAT.'_columns', array($this, 'wpocup_manage_category_columns') );
		add_filter( 'manage_'.WPOCP_CAT.'_custom_column', array($this, 'wpocup_category_data'), 10, 3 );

		// Action to add custom column to Slider listing
		add_filter( 'manage_'.WPOCP_POST_TYPE.'_posts_columns', array($this, 'wpocup_posts_columns') );

		// Action to add custom column data to Slider listing
		add_action('manage_'.WPOCP_POST_TYPE.'_posts_custom_column', array($this, 'wpocup_post_columns_data'), 10, 2);

		// Action to add sorting link at Slider listing page
		add_filter( 'views_edit-'.WPOCP_POST_TYPE, array($this, 'wpocup_sorting_link') );

		// Action to add `Save Order` button
		add_action( 'restrict_manage_posts', array($this, 'wpocup_restrict_manage_posts') );

		// Ajax call to update option
		add_action( 'wp_ajax_wpocup_update_post_order', array($this, 'wpocup_update_post_order'));
		add_action( 'wp_ajax_nopriv_wpocup_update_post_order',array( $this, 'wpocup_update_post_order'));

		// Filter to add plugin links
		add_filter( 'plugin_row_meta', array( $this, 'wpocup_plugin_row_meta' ), 10, 2 );
	}

	/**
	 * Post Settings Metabox
	 * 
	 * @package Owl Carousel Ultimate
	 * @since 1.2.5
	 */
	function wpocup_post_sett_metabox() {
		add_meta_box( 'wpocup-post-sett', __( 'Owl Carousel Ultimate - Settings', 'owl-carousel-ultimate' ), array($this, 'wpocup_post_sett_mb_content'), WPOCP_POST_TYPE, 'normal', 'high' );
	}

	/**
	 * Post Settings Metabox HTML
	 * 
	 * @package Owl Carousel Ultimate
	 * @since 1.2.5
	 */
	function wpocup_post_sett_mb_content() {
		include_once( WPOCP_DIR .'/includes/admin/metabox/wpocup-post-sett-metabox.php');
	}

	/**
	 * Function to save metabox values
	 * 
	 * @package Owl Carousel Ultimate
	 * @since 1.0
	 */
	function wpocup_save_metabox_value( $post_id ) {

		global $post_type;
		
		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )                	// Check Autosave
		|| ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] )  	// Check Revision
		|| ( $post_type !=  WPOCP_POST_TYPE ) )              					// Check if current post type is supported.
		{
		  return $post_id;
		}

		$prefix = WPOCP_META_PREFIX; // Taking metabox prefix
		
		// Taking variables
		$read_more_link = isset($_POST[$prefix.'more_link']) ? wpocup_slashes_deep($_POST[$prefix.'more_link']) : '';
		
		update_post_meta($post_id, 'wpocup_slide_link', $read_more_link);
	}

	/**
	 * Function register setings
	 * 
	 * @package Owl Carousel Ultimate
	 * @since 1.2.5
	 */
	function wpocup_register_settings() {
		register_setting( 'wpocup_plugin_options', 'wpocup_options', array($this, 'wpocup_validate_options') );
	}
	
	/**
	 * Validate Settings Options
	 * 
	 * @package Owl Carousel Ultimate
	 * @since 1.2.5
	 */
	function wpocup_validate_options( $input ) {
		
		$input['default_img'] 	= isset($input['default_img']) 	? wpocup_slashes_deep($input['default_img']) 		: '';
		$input['custom_css'] 	= isset($input['custom_css']) 	? wpocup_slashes_deep($input['custom_css'], true) 	: '';
		
		return $input;
	}
	
	/**
	 * Function to register admin menus
	 * 
	 * @package Owl Carousel Ultimate
	 * @since 1.2.5
	 */
	function wpocup_register_menu() {
		add_submenu_page( 'edit.php?post_type='.WPOCP_POST_TYPE, __('Settings', 'owl-carousel-ultimate'), __('Settings', 'owl-carousel-ultimate'), 'manage_options', 'wpocup-settings', array($this, 'wpocup_settings_page') );
	}

	/**
	 * Function to handle the setting page html
	 * 
	 * @package Owl Carousel Ultimate
	 * @since 1.2.5
	 */
	function wpocup_settings_page() {
		include_once( WPOCP_DIR . '/includes/admin/settings/wpocup-settings.php' );
	}

	/**
	 * Add category dropdown to Slider listing page
	 * 
	 * @package Owl Carousel Ultimate
	 * @since 1.2.5
	 */
	function wpocup_add_post_filters() {
		
		global $typenow;
		
		if( $typenow == WPOCP_POST_TYPE ) {

			$wpocup_pro_cat = isset($_GET[WPOCP_CAT]) ? $_GET[WPOCP_CAT] : '';

			$dropdown_options = apply_filters('wpocup_pro_cat_filter_args', array(
					'show_option_none'  => __('All Categories', 'owl-carousel-ultimate'),
					'option_none_value' => '',
					'hide_empty' 		=> 1,
					'hierarchical' 		=> 1,
					'show_count' 		=> 0,
					'orderby' 			=> 'name',
					'name'				=> WPOCP_CAT,
					'taxonomy'			=> WPOCP_CAT,
					'selected' 			=> $wpocup_pro_cat,
					'value_field'		=> 'slug',
				));
			wp_dropdown_categories( $dropdown_options );
		}
	}

	/**
	 * Function to add custom quick links at post listing page
	 * 
	 * @package Owl Carousel Ultimate
	 * @since 1.3.1
	 */
	function wpocup_add_post_row_data( $actions, $post ) {
		
		if( $post->post_type == WPOCP_POST_TYPE ) {
			return array_merge( array( 'wpocup_id' => 'ID: ' . $post->ID ), $actions );
		}
		
		return $actions;
	}

	/**
	 * Add extra column to news category
	 * 
	 * @package Owl Carousel Ultimate
	 * @since 1.0.0
	 */
	function wpocup_manage_category_columns($columns) {

		$new_columns['wpocup_shortcode'] = __( 'Category Shortcode', 'owl-carousel-ultimate' );

		$columns = wpocup_array( $columns, $new_columns, 2 );

		return $columns;
	}

	/**
	 * Add data to extra column to news category
	 * 
	 * @package Owl Carousel Ultimate
	 * @since 1.0.0
	 */
	function wpocup_category_data($ouput, $column_name, $tax_id) {
		
		if( $column_name == 'wpocup_shortcode' ) {
			$ouput .= '[wpoc-owl-carousel category="' . $tax_id. '"]<br />';
			$ouput .= '[wpoc-owl-autowidth category="' . $tax_id. '"]';	
	    }
		
	    return $ouput;
	}

	/**
	 * Add custom column to Post listing page
	 * 
	 * @package Owl Carousel Ultimate
	 * @since 1.2.5
	 */
	function wpocup_posts_columns( $columns ){

		$new_columns['wpocup_pro_image'] 	= __( 'Image', 'owl-carousel-ultimate' );
	    $new_columns['wpocup_pro_order'] 	= __('Order', 'owl-carousel-ultimate');

	    $columns = wpocup_array( $columns, $new_columns, 1, true );

	    return $columns;
	}

	/**
	 * Add custom column data to Post listing page
	 * 
	 * @package Owl Carousel Ultimate
	 * @since 1.2.5
	 */
	function wpocup_post_columns_data( $column, $post_id ) {

		global $post;

	    switch ($column) {
			case 'wpocup_pro_image':
				
				echo get_the_post_thumbnail( $post_id, array(50, 50) );
				break;

			case 'wpocup_pro_order':

		        $post_menu_order = isset($post->menu_order) ? $post->menu_order : '';
		        
		        echo $post_menu_order;
		        echo "<input type='hidden' value='{$post_id}' name='wpocup_post[]' class='wpocup-post-order' id='wpocup-post-order-{$post_id}' />";
		        break;
		}
	}

	/**
	 * Add 'Sort Slides' link at Slider listing page
	 * 
	 * @package Owl Carousel Ultimate
	 * @since 1.2.5
	 */
	function wpocup_sorting_link( $views ) {
	    
	    global $post_type, $wp_query;

	    $class            = ( isset( $wp_query->query['orderby'] ) && $wp_query->query['orderby'] == 'menu_order title' ) ? 'current' : '';
	    $query_string     = remove_query_arg(array( 'orderby', 'order' ));
	    $query_string     = add_query_arg( 'orderby', urlencode('menu_order title'), $query_string );
	    $query_string     = add_query_arg( 'order', urlencode('ASC'), $query_string );
	    $views['byorder'] = '<a href="' . esc_url( $query_string ) . '" class="' . esc_attr( $class ) . '">' . __( 'Sort Slides', 'owl-carousel-ultimate' ) . '</a>';

	    return $views;
	}

	/**
	 * Add Save button to Slider listing page
	 * 
	 * @package Owl Carousel Ultimate
	 * @since 1.2.5
	 */
	function wpocup_restrict_manage_posts() {

		global $typenow, $wp_query;

		if( $typenow == WPOCP_POST_TYPE && isset($wp_query->query['orderby']) && $wp_query->query['orderby'] == 'menu_order title' ) {

			$html  = '';
			$html .= "<span class='spinner wpocup-spinner'></span>";
			$html .= "<input type='button' name='wpocup_pro_save_order' class='button button-secondary right wpocup-save-order' id='wpocup-save-order' value='".__('Save Sort Order', 'owl-carousel-ultimate')."' />";
			echo $html;
		}
	}

	/**
	 * Update Slider order
	 * 
	 * @package Owl Carousel Ultimate
	 * @since 1.2.5
	 */
	function wpocup_update_post_order() {

		// Taking some defaults
		$result 			= array();
		$result['success'] 	= 0;
		$result['msg'] 		= __('Sorry, Something happened wrong.', 'owl-carousel-ultimate');

		if( !empty($_POST['form_data']) ) {

			$form_data 			= parse_str($_POST['form_data'], $output_arr);
			$wpocup_posts 	= !empty($output_arr['wpocup_post']) ? $output_arr['wpocup_post'] : '';

			if( !empty($wpocup_posts) ) {

				$post_menu_order = 0;

				// Loop od ids
				foreach ($wpocup_posts as $wpocup_post_key => $wpocup_post) {
					
					// Update post order
					$update_post = array(
						'ID'           => $wpocup_post,
						'menu_order'   => $post_menu_order,
					);

					// Update the post into the database
					wp_update_post( $update_post );

					$post_menu_order++;
				}

				$result['success'] 	= 1;
				$result['msg'] 		= __('Slides order saved successfully.', 'owl-carousel-ultimate');
			}
		}

		echo json_encode($result);
		exit;
	}

	/**
	 * Function to unique number value
	 * 
	 * @package Owl Carousel Ultimate
	 * @since 1.0.0
	 */
	function wpocup_plugin_row_meta( $links, $file ) {
		
		if ( $file == WPOCP_PLUGIN_BASENAME ) {
			
			$row_meta = array(
				'docs'    => '<a href="' . esc_url('https://wordpress.org/plugins/wpos-owl-carousel-ultimate/') . '" title="' . esc_attr( __( 'View Documentation', 'owl-carousel-ultimate' ) ) . '" target="_blank">' . __( 'Docs', 'owl-carousel-ultimate' ) . '</a>',
				'support' => '<a href="' . esc_url('https://www.wponlinesupport.com/') . '" title="' . esc_attr( __( 'Visit Customer Support', 'owl-carousel-ultimate' ) ) . '" target="_blank">' . __( 'Support', 'owl-carousel-ultimate' ) . '</a>',
			);
			return array_merge( $links, $row_meta );
		}
		return (array) $links;
	}
}

$wpocup_admin = new Wposup_Admin();