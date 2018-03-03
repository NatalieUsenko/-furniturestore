<?php
/**
 * 'wpoc-owl-carousel' Shortcode
 * 
 * @package Owl Carousel Ultimate
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function wpocup_owl_carousel( $atts, $content = null ) {          
	
	// Shortcode Parameter
	extract(shortcode_atts(array(
		'limit'    			=> '15',
		'category' 			=> '',		
		'design' 			=> 'prodesign-1',
		'image_fit' 		=> 'true',
		'image_size' 		=> 'large',		
		'slide_to_show'     => '3',		
		'loop'   			=> 'true',
		'dots'     			=> 'true',
		'arrows'     		=> 'true',
		'autoplay'     		=> 'true',
		'autoplay_interval'	=> '3000',		
		'speed'             => '300',		
		'sliderheight'     	=> '',				
		'link_target'		=> 'self',
		'order'				=> 'DESC',
		'orderby'			=> 'date',
		'margin'			=> '10',
		'stage_padding'		=> '0',
		'auto_height'       => 'false',			
		), $atts,'wpoc-owl-carousel'));				
	
	$shortcode_designs 	= wpocup_carousel_designs();
	$limit 				= !empty($limit) 					? $limit 						: '15';	
	$cat 				= (!empty($category)) 				? explode(',', $category) 		: '';
	$loop 				= ( $loop == 'false' ) 				? false 						: true;
	$design 			= ($design && (array_key_exists(trim($design), $shortcode_designs))) ? trim($design) : 'prodesign-1';
	$sliderimage_size 	= !empty($image_size) 				? $image_size 					: 'large';
	$image_fit			= ($image_fit == 'false')			? false                         : true;	
	$dots 				= ( $dots == 'false' ) 				? false 						: true;
	$arrows 			= ( $arrows == 'false' ) 			? false 						: true;
	$autoplay 			= ( $autoplay == 'false' ) 			? false 						: true;	
	$slide_to_show	 	= (!empty($slide_to_show)) 			? $slide_to_show 				: 3;
	$autoplay_interval 	= (!empty($autoplay_interval)) 		? $autoplay_interval 			: 3000;
	$speed 				= (!empty($speed)) 					? $speed 						: 300;	
	$link_target 		= ($link_target == 'blank') 		? '_blank' 						: '_self';
	$order				= ( strtolower($order) == 'asc' ) 	? 'ASC' 						: 'DESC';
	$orderby			= !empty($orderby) 					? $orderby 						: 'date';	
	$sliderheight 		= (!empty($sliderheight)) 			? $sliderheight 				: '';
	$slider_height_css 	= (!empty($sliderheight))			? "style='height:{$sliderheight}px;'" : '';	
	$margin 			= !empty($margin) 					? $margin 						: '10';	
	$stagePadding 		= !empty($stage_padding) 			? $stage_padding 				: '0';
	$auto_height 		= ($auto_height == 'false')			? false                     	: true;	
	
	// Shortcode file
	$design_file_path 	= WPOCP_DIR . '/templates/carousel/' . $design . '.php';
	$design_file 		= (file_exists($design_file_path)) ? $design_file_path : '';
	
	// Enqueus required script
	wp_enqueue_script( 'wpos-owl-jquery' );
	wp_enqueue_script( 'wpocup-public-script' );
	
	// Taking some global
	global $post;

	// Taking some variables
	$unique				= wpocup_get_unique();	
	$image_fit_class	= ($image_fit) 	          ? 'wpocup-image-fit' : '';
	

	// WP Query Parameters
	$args = array (
		'posts_per_page' 		=> $limit,
		'post_type'     	 	=> WPOCP_POST_TYPE,
		'post_status' 			=> array( 'publish' ),
		'orderby'        		=> $orderby,
		'order'          		=> $order,		
		'ignore_sticky_posts'	=> true,
	);

	// Category Parameter
	if( $cat != "" ) {

		$args['tax_query'] = array(
			array(
					'taxonomy' 			=> WPOCP_CAT,
					'field' 			=> 'term_id',
					'terms' 			=> $cat,
					
				));

	} 

	// WP Query Parameters
	$query 				= new WP_Query($args);
	$post_count 		= $query->post_count;	
	$count 			    = 0; 
	$grid_count         = 1;

  	// Slider configuration
	$slider_conf = compact('slide_to_show', 'dots', 'arrows', 'autoplay','autoplay_interval','auto_height', 'speed', 'loop','margin', 'stagePadding');
	
	ob_start();

	// If post is there
	if ( $query->have_posts() ) { ?>
		
		<div class="wpocup-owl-carousel-wrp wpocup-clearfix">
			<div id="wpocup-owl-carousel-<?php echo $unique; ?>" class="wpocup-owl-carousel wpocup-owl-carousel-slider wpocup-clearfix <?php echo 'wpocup-'.$design.' '.$image_fit_class; ?>">
			<?php
				while ( $query->have_posts() ) : $query->the_post();
				$count++;
				$slider_img 	= wpocup_get_post_featured_image( $post->ID, $sliderimage_size, true );
				$read_more_url 	= get_post_meta( $post->ID, 'wpocup_slide_link', true );

					// Include shortcode html file
				if( $design_file ) {
					include( $design_file );
				}
				$grid_count++;	
				endwhile;
				?>
			</div>

			<div class="wpocup-carousel-conf wpocup-hide"><?php echo htmlspecialchars(json_encode($slider_conf)); ?></div>
		</div>
		
		<?php

	} // End have_posts()

	wp_reset_query(); // Reset WP Query

	$content .= ob_get_clean();
	return $content;
}

// 'wpoc-owl-carousel' shortcode
add_shortcode('wpoc-owl-carousel', 'wpocup_owl_carousel');