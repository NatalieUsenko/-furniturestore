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
            'value' => '1',
            'compare' => 'LIKE',
        ),
    ),
);
$top_news = new WP_Query($top_args);
while ( $top_news->have_posts() ) {
    $top_news->the_post();
    $big_img = get_field('big_img', get_the_ID());
    $top_news_content = get_the_content();
}

?>
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
                <div class="container-fluid container" <?php echo $big_img?'style="background-image: url('.$big_img.');"':'';?>>
                    <h1 class="page-title"><?php echo esc_html( get_the_title() ); ?></h1>
                    <?php if ( have_posts() ) : ?>

                    <?php
                    while ( $top_news->have_posts() ) { ?>

                    <div class="col-md-5">
                        <?php
                        the_date('d.m.Y');
                        the_title(); // выведем заголовок поста
                        echo cutString( the_content(), 50);
                        ?>
                    </div>
                    <?php }?>
                    <?php endif;?>
                </div>

        </main><!-- .site-main -->
    </div><!-- .content-area -->

<?php
get_footer();