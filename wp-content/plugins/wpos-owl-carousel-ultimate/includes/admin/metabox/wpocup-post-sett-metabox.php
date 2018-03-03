<?php
/**
 * Handles Post Setting metabox HTML
 *
 * @package Owl Carousel Ultimate
 * @since 1.2.5
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

global $post;

$prefix = WPOCP_META_PREFIX; // Metabox prefix

// Getting saved values
$read_more_link = get_post_meta( $post->ID, 'wpocup_slide_link', true );
?>

<table class="form-table wpocup-post-sett-table">
	<tbody>
		<tr valign="top">
			<th scope="row">
				<label for="wpocup-more-link"><?php _e('Read More Link', 'owl-carousel-ultimate'); ?></label>
			</th>
			<td>
				<input type="url" value="<?php echo esc_url($read_more_link); ?>" class="large-text wpocup-more-link" id="wpocup-more-link" name="<?php echo $prefix; ?>more_link" /><br/>
				<span class="description"><?php _e('Enter read more link. eg. http://wponlinesupport.com', 'owl-carousel-ultimate'); ?></span>
			</td>
		</tr>
	</tbody>
</table><!-- end .wtwp-tstmnl-table -->