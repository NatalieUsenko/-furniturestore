<?php
get_header();
$categories = get_the_category();
$image_url_right = get_field('big_img_right');
?>
<div id="primary" class="content-area <?php echo $image_url_right?'top-news_img':'';?>" <?php echo $image_url_right?'style="background-image: url('.$image_url_right.');"':'';?>>
    <main id="main" class="site-main" role="main">
    <?php if ( !empty($categories) ) {
        if ($categories[0]->term_id==1){
            include_once('parts/single-news.php');
        } else {
            include_once('parts/single-catalogue.php');
        }
    }
    ?>

    </main><!-- .site-main -->
</div><!-- .content-area -->

<?php
get_footer();
