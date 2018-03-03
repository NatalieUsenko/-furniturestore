<?php
/**
 * Settings Page
 *
 * @package Owl Carousel Ultimate
 * @since 1.2.5
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
?>

<div class="wrap wpocup-settings">
	
	<h2><?php _e( 'Owl Carousel Ultimate Settings', 'owl-carousel-ultimate' ); ?></h2><br/>
	
	<?php
	// Success message
	if( isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true' ) {
		echo '<div id="message" class="updated notice notice-success is-dismissible">
				<p><strong>'.__("Your changes saved successfully.", "owl-carousel-ultimate").'</strong></p>
			  </div>';
	}
	?>
	
	<form action="options.php" method="POST" id="wpocup-settings-form" class="wpocup-settings-form">
		
		<?php
		    settings_fields( 'wpocup_plugin_options' );
		    global $wpocup_options;
		?>		
		<!-- Custom CSS Settings Starts -->
		<div id="wpocup-custom-css-sett" class="post-box-container wpocup-custom-css-sett">
			<div class="metabox-holder">
				<div class="meta-box-sortables ui-sortable">
					<div class="postbox">

						<button class="handlediv button-link" type="button"><span class="toggle-indicator"></span></button>

							<!-- Settings box title -->
							<h3 class="hndle">
								<span><?php _e( 'Custom CSS Settings', 'owl-carousel-ultimate' ); ?></span>
							</h3>
							
							<div class="inside">
							
							<table class="form-table wpocup-custom-css-tbl">
								<tbody>
									<tr>
										<th scope="row">
											<label for="wpocup-custom-css"><?php _e('Custom CSS', 'owl-carousel-ultimate'); ?>:</label>
										</th>
										<td>
											<textarea name="wpocup_options[custom_css]" class="large-text wpocup-custom-css" id="wpocup-custom-css" rows="15"><?php echo wpocup_esc_attr(wpocup_get_option('custom_css')); ?></textarea><br/>
											<span class="description"><?php _e('Enter custom CSS to override plugin CSS.', 'owl-carousel-ultimate'); ?></span>
										</td>
									</tr>
									<tr>
										<td colspan="2" valign="top" scope="row">
											<input type="submit" id="wpocup-settings-submit" name="wpocup-settings-submit" class="button button-primary right" value="<?php _e('Save Changes','owl-carousel-ultimate');?>" />
										</td>
									</tr>
								</tbody>
							 </table>

						</div><!-- .inside -->
					</div><!-- #wpocup-custom-css -->
				</div><!-- .meta-box-sortables ui-sortable -->
			</div><!-- .metabox-holder -->
		</div><!-- #wpocup-custom-css-sett -->
		<!-- Custom CSS Settings Ends -->
		
	</form><!-- end .wpocup-settings-form -->
	
</div><!-- end .wpocup-settings -->