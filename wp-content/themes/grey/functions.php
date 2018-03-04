<?php
add_filter('pre_site_transient_update_core',create_function('$a', "return null;"));
wp_clear_scheduled_hook('wp_version_check');
remove_action('load-update-core.php','wp_update_themes');
add_filter('pre_site_transient_update_themes',create_function('$a', "return null;"));
wp_clear_scheduled_hook('wp_update_themes');
remove_action( 'load-update-core.php', 'wp_update_plugins' );
add_filter( 'pre_site_transient_update_plugins', create_function( '$a', "return null;" ) );
wp_clear_scheduled_hook( 'wp_update_plugins' );

if ( ! function_exists( 'grey_setup' ) ) :
function grey_setup(){
    load_theme_textdomain('grey');
    add_theme_support('title-tag');
    add_theme_support( 'custom-logo' );

    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(825, 510, true);

    add_theme_support('catalouge-thumbnails');
    set_post_thumbnail_size(550, 350, true);

    add_theme_support('main-thumbnails');
    set_post_thumbnail_size(410, 305, true);

    register_nav_menus(array(
        'primary' => __('Primary Menu', 'grey'),
        'social' => __('Social Links Menu', 'grey'),
    ));
}
add_action( 'after_setup_theme', 'grey_setup' );
endif;

function grey_scripts() {
    wp_enqueue_style( 'bootstrap-style', get_template_directory_uri(). '/css/bootstrap.min.css' );
    wp_enqueue_style( 'grey-style', get_stylesheet_uri() );
    wp_register_style( 'font-style', 'https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' );
    wp_enqueue_style( 'font-style');

	wp_register_script( 'grey-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20180118', true );
	wp_enqueue_script( 'grey-script');
    wp_register_script( 'bootstrap-script', get_template_directory_uri() . '/js/bootstrap.min.js', true );
    wp_enqueue_script( 'bootstrap-script');
}
add_action( 'wp_enqueue_scripts', 'grey_scripts' );

function themename_custom_logo_setup() {
    $defaults = array(
        'height'      => 83,
        'width'       => 272,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    );
    add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'themename_custom_logo_setup' );

function my_acf_google_map_api( $api ){
    $api['key'] = 'AIzaSyAe_0rVt1WvsSNi8WGYeBWbUYqp3oiiubg';
    return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

add_shortcode('contact_form', 'contact_form' );
function contact_form(){
    $content = file_get_contents(get_template_directory().'/parts/form.php');
    return $content;
}

function cutString($string, $maxlen) {
    $len = (mb_strlen($string) > $maxlen)? mb_strripos(mb_substr($string, 0, $maxlen), ' ') : $maxlen;
    $cutStr = mb_substr($string, 0, $len);
    return (mb_strlen($string) > $maxlen)? $cutStr.' ...' : $cutStr;
}

function true_load_posts(){
    $args = unserialize( stripslashes( $_POST['query'] ) );
    $args['paged'] = $_POST['page'] + 1; // следующая страница
    $args['post_status'] = 'publish';

    // обычно лучше использовать WP_Query, но не здесь
    query_posts( $args );
    // если посты есть
    if( have_posts() ) :
        $i= 0;
        // запускаем цикл
        while( have_posts() ): the_post();
            if($i % 2 == 0) {
                echo '<div class="row">';
            }?>
            <div class="col-md-6 post-list">
                <div class="post-list_img"><?php the_post_thumbnail('thumbnail');?></div>
                <div class="post-list_date"><?php echo get_the_date('d.m.Y');?></div>
                <div class="post-list_title"><?php echo get_the_title();?></div>
                <div class="post-list_expert"><?php echo cutString( get_the_content(), 120);?></div>
                <div class="post-list_link-more"><a href="<?php echo get_the_permalink();?>">Детальнее</a></div>
            </div>
        <?php  $i++;
            if($i % 2 == 0) {
                echo '</div>';
            }
            endwhile;

    endif;
    die();
}
add_action('wp_ajax_loadmore', 'true_load_posts');
add_action('wp_ajax_nopriv_loadmore', 'true_load_posts');

function true_load_posts_catalogue(){
    $args = unserialize( stripslashes( $_POST['query'] ) );
    $args['paged'] = $_POST['page'] + 1; // следующая страница
    $args['post_status'] = 'publish';

    // обычно лучше использовать WP_Query, но не здесь
    query_posts( $args );
    // если посты есть
    if( have_posts() ) :

        // запускаем цикл
        while( have_posts() ): the_post();?>
            <div class="col-md-4 post-list_catalogue">
                <?php the_post_thumbnail('catalouge-thumbnails');?>
                <div class="post-list_title">
                    <?php echo get_the_title();?>
                    <div class="post-list_link-more"><a href="<?php echo get_the_permalink();?>">Все фото >></a></div>
                </div>
            </div>
        <?php endwhile;
    endif;
    die();
}
add_action('wp_ajax_loadmore_catalogue', 'true_load_posts_catalogue');
add_action('wp_ajax_nopriv_loadmore_catalogue', 'true_load_posts_catalogue');

// retrieves the attachment ID from the file URL
function get_image_id($image_url) {
    global $wpdb;
    $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ));
    return $attachment[0];
}

function get_the_content_with_formatting ($more_link_text = '(more...)', $stripteaser = 0, $more_file = '') {
	$content = get_the_content($more_link_text, $stripteaser, $more_file);
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);
	return $content;
}