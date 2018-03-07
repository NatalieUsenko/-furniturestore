<?php
get_header();
$categories = get_the_category();
?>
<div id="primary" class="content-area">
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
