jQuery(document).ready(function($) { 

	// For carousel
	$( '.wpocup-owl-carousel-slider' ).each(function( index ) {
		
		var slider_id   = $(this).attr('id');
		var slider_conf = $.parseJSON( $(this).closest('.wpocup-owl-carousel-wrp').find('.wpocup-carousel-conf').text());	
			
		if( typeof(slider_id) != 'undefined' && slider_id != '' ) {
			jQuery('#'+slider_id).owlCarousel({
				items					: parseInt(slider_conf.slide_to_show),				
				nav						: (slider_conf.arrows) 		? true : false,
				dots					: (slider_conf.dots) 		? true : false,
				loop					: (slider_conf.loop)    	? true : false,
				autoplay				: (slider_conf.autoplay) 	? true : false,				
				autoplaySpeed           : parseInt(slider_conf.autoplay_interval),
				navSpeed                : parseInt(slider_conf.speed),
				dotsSpeed				: parseInt(slider_conf.speed),
				autoHeight              : (slider_conf.auto_height) ? true : false,
				margin					: parseInt(slider_conf.margin),
				stagePadding			: parseInt(slider_conf.stagePadding),		
				autoWidth               : false,				
				navText					: ["Prev","Next"],
				responsive:{
				0:{
					items:1
				},
				640:{
					items:2
				},
				768:{
					items: parseInt(slider_conf.slide_to_show)
				}
			}
			});
		}		
		
	});	
	// For Auto Width
	$( '.wpocup-owl-autowidth' ).each(function( index ) {
		
		var slider_id   = $(this).attr('id');
		var slider_conf = $.parseJSON( $(this).closest('.wpocup-owl-autowidth-wrp').find('.wpocup-carousel-conf').text());	
		
		if( typeof(slider_id) != 'undefined' && slider_id != '' ) {
			jQuery('#'+slider_id).owlCarousel({
				items					: 1,				
				nav						: (slider_conf.arrows) 		? true : false,
				dots					: (slider_conf.dots) 		? true : false,
				loop					: (slider_conf.loop)    	? true : false,
				autoplay				: (slider_conf.autoplay) 	? true : false,				
				autoplayHoverPause      : (slider_conf.autoplay_hover_pause) ? true : false, 
				autoplaySpeed           : parseInt(slider_conf.autoplay_interval),
				navSpeed                : parseInt(slider_conf.speed),
				dotsSpeed				: parseInt(slider_conf.speed),	
				autoHeight              : (slider_conf.auto_height) ? true : false,
				margin					: parseInt(slider_conf.margin),
				center					: true,	
				autoWidth               : true,				
				navText					: ["Prev","Next"],
				responsive:{
				0:{
					items:1,
					autoWidth  : false
				},
				640:{
					items:1,
					autoWidth  : false
				},
				768:{
					items: 1
				}
			}
			});
		}		
		
	});	
});