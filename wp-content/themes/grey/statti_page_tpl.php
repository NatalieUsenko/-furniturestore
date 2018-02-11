<?php
/*
Template Name: Статьи
Template Post Type: page
*/
get_header();
$top_args = array(
    'posts_per_page' => 1,
    'post_status' => 'publish',
    'order' => 'DESC',
    'meta_query' => array(
        'book_color' => array(
            'key'     => 'is_top',
            'compare' => 'EXISTS',
        ),
    ),
);
$top_news = new WP_Query($top_args);
?>
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <?php if ( have_posts() ) : ?>
                <div class="container-fluid container">
                    <?php
                    while ( $top_news->have_posts() ) {
                        $top_news->the_post();

                        the_title(); // выведем заголовок поста
                    }
                    ?>

                </div>
            <?php
            endif;
            ?>

        </main><!-- .site-main -->
    </div><!-- .content-area -->

<?php
include "parts/map.php";
get_footer();