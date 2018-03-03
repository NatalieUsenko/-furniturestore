=== Owl Carousel 2 Ultimate  ===
Contributors: wponlinesupport, anoopranawat
Tags: owl slick,owl image slider,owl slider,owl autowidth slider, owl slick image slider,owl slider,owl image slider, owl header image slider,owl responsive image slider, owl responsive content slider, owl carousel, image carousel,owl carousel slider, owl coin slider,owl touch slider, owl responsive slider
Requires at least: 3.1
Tested up to: 4.9.2
Author URI: http://wponlinesupport.com
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Owl Carousel 2 : Touch enabled WordPress plugin that lets you create a beautiful responsive carousel owl.

== Description ==

Display multiple owl carousel using shortcode with category. Fully responsive, Swipe enabled, Desktop mouse dragging and  Infinite looping. Fully accessible with arrow key navigation  Autoplay, dots, arrows etc.

View [FREE DEMO](https://www.wponlinesupport.com/wp-plugin/owl-carousel-ultimate-pro/) | [PRO DEMO](https://www.wponlinesupport.com/wp-plugin/owl-carousel-ultimate-pro/) for more details.

It uses A custom post type and taxonomy to create a Owl Carousel , with almost unlimited options and support for multiple owls on any page.

= You can use 2 shortcodes =

<code>[wpoc-owl-carousel]</code> - Owl Carousel Ultimate 
<code>[wpoc-owl-autowidth]</code> - Owl Autowidth Ultimate 


= Here is Template code =

<code><?php echo do_shortcode('[wpoc-owl-carousel]'); ?></code>
<code><?php echo do_shortcode('[wpoc-owl-autowidth]'); ?></code>

= Use Following parameters with carousel shortcode =

<code>[wpoc-owl-carousel]</code>

* **Limit :**  [wpoc-owl-carousel limit="8"] (Limit number of owls. By default set to "15". if you want to display all owls then set limit to limit="-1".)
* **Category :**  [wpoc-owl-carousel category="category_ID"] ( Display owl slider by their category ID ).
* **Image Fit :**  [wpoc-owl-carousel image_fit="true"](set image fit to box)
* **Image Display Size :**  [wpoc-owl-carousel image_size="large"] ( Display appriate image size from WordPress. Default is "large". Values are thumbnail, medium, large, original.)
* **Slides Column :**  [wpoc-owl-carousel slide_to_show="3"] (Display number of owls at a time in owl slider.)
* **Loop :**  [wpoc-owl-carousel loop="true" ] (Create a Infinite loop sliding. By default value is "true". Options are "ture OR false").
* **Dots and arrows**  : [wpoc-owl-carousel dots="false" arrows="false"]
* **Autoplay :**  [wpoc-owl-carousel autoplay="true"] (Start owl slider automatically. Values are "true" OR "false".)
* **Autoplay Interval :**  [wpoc-owl-carousel autoplay_interval="3000"] (Delay between two owls.)
* **Speed :**  [wpoc-owl-carousel speed="3000"]
* **Link Target :**  [wpoc-owl-carousel link_target="blank"] (Open link in a same window or in a new tab. Values are "self" OR "blank".)
* **Order :**  [wpoc-owl-carousel order="DESC"] (Controls owls order. Values are "ASC" OR "DESC".)
* **Orderby :**  [wpoc-owl-carousel orderby="post_date"] (Display owls in your order. Values are "post_date", "modified", "title", "name" (Post Slug), "ID", "rand", "menu_order" (Sort Order), "comment_count".)
* **Slider Height:** [wpoc-owl-carousel sliderheight="400"] (Set Carousel Slider height.)
* **margin :** [wpoc-owl-carousel margin="10"] (Set margin b/w items.)
* **stage_padding :** [wpoc-owl-carousel stage_padding="0"] (Padding left and right on stage.)
* **auto_height:** [wpoc-owl-carousel auto_height="true"] (Set auto height of slider. Values are "true" OR "false". NOTE: image_fit value should be false during using this paramater image_fit="false")

= Use Following parameters with autowidth shortcode =

<code>[wpoc-owl-autowidth]</code>

* **Limit :**  [wpoc-owl-autowidth limit="8"] (Limit number of owls. By default set to "15". if you want to display all owls then set limit to limit="-1".)
* **Category :**  [wpoc-owl-autowidth category="category_ID"] ( Display owl slider by their category ID. )
* **Image Fit :**  [wpoc-owl-autowidth image_fit="true"](set image in box)
* **Image Size :**  [wpoc-owl-autowidth image_size="Full"](Display appriate image size from WordPress. Default is "large". Values are thumbnail, medium, large, original.)
* **Loop :**  [wpoc-owl-autowidth loop="true" ] (Create a Infinite loop sliding. By default value is "true". Options are "ture OR false").
* **Dots and arrows :**  [wpoc-owl-autowidth dots="false" arrows="false"]
* **Autoplay :**  [wpoc-owl-autowidth autoplay="true"] (Start owl slider automatically. Values are "true" OR "false".)
* **Stop on Hover :**  [wpoc-owl-autowidth autoplay_hover_pause="true"] (Stop owl slider whrn mouse hover. Values are "true" OR "false".)
* **Autoplay Interval :**  [wpoc-owl-autowidth autoplay_interval="3000"] (Delay between two owls.)
* **Speed :**  [wpoc-owl-autowidth speed="3000"] (Control speed of owl slider.)
* **Slider Height :**  [wpoc-owl-autowidth sliderheight="400" ] (Set Slider height. By default given 400px height.)
* **Auto Height :**  [wpoc-owl-autowidth auto_height="400" ] (Set Slider Auto height. Values are "true" and "false")
* **Link Target :**  [wpoc-owl-autowidth link_target="blank"] (Open link in a same window or in a new tab. Values are "self" OR "blank".)
* **Order :**  [wpoc-owl-autowidth order="DESC"] (Controls owls order. Values are "ASC" OR "DESC".)
* **Orderby :**  [wpoc-owl-autowidth orderby="post_date"] (Display owls in your order. Values are "post_date", "modified", "title", "name" (Post Slug), "ID", "rand", "menu_order" (Sort Order), "comment_count".)
* **margin :** [wpoc-owl-autowidth margin="10"] (Set margin b/w items.)

= Features include =

* Display unlimited number of owl slider and carousel with the help of category.
* Touch-enabled Navigation.
* Fully responsive. Scales with its container.
* Fully accessible with arrow key navigation.
* Responsive
* Given shortcode and template code.
* Use for header image owl slider.

= PRO Features : =
> <strong>Premium Version</strong><br>
>
> * 30 Beautiful Designs for Carousel
> * 30 Beautiful Designs for Center Mode
> * 21 Beautiful Designs for Auto Width
> * Title and Content show/hide option
> * Visual composer support
> * Custom CSS option
> * Fully responsive
>
> View [PRO DEMO and Features](https://www.wponlinesupport.com/wp-plugin/owl-carousel-ultimate-pro/) for additional information.
>


== Installation ==

1. Upload the 'owl-carousel-ultimate' folder to the '/wp-content/plugins/' directory.
2. Activate the "owl-carousel-ultimate" list plugin through the 'Plugins' menu in WordPress.
3. Add this short code where you want to display owl slider

<code>[wpoc-owl-autowidth] and [wpoc-owl-carousel]</code>

== Screenshots ==
1. Admin view
2. Admin view
3. Output


== Changelog ==

= 1.1.1 =
* [+] Added 3 new shortcode in <code>[wpoc-owl-carousel]</code> shortcode ie margin, stage_padding and auto_height.
* [+] Added 1 new shortcode in <code>[wpoc-owl-autowidth]</code> shortcode ie margin.

= 1.0.1 =
* [+] Added how it work

= 1.0 =
* Initial release.

== Upgrade Notice ==

= 1.1.1 =
* [+] Added 3 new shortcode in <code>[wpoc-owl-carousel]</code> shortcode ie margin, stage_padding and auto_height.
* [+] Added 1 new shortcode in <code>[wpoc-owl-autowidth]</code> shortcode ie margin.

= 1.0.1 =
* [+] Added how it work


= 1.0 =
* Initial release.
