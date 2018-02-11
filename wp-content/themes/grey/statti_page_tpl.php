<?php
/*
Template Name: Статьи
Template Post Type: page
*/
get_header();
$current_page_id = get_the_ID();
$top_news_id = 0;
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
    $top_news_id = get_the_ID();
    $big_img = get_field('big_img', get_the_ID());
    $top_news_content = get_the_content();
}
$news_args = array(
    'posts_per_page' => 4,
    'post_status' => 'publish',
    'order' => 'DESC',
    'post__not_in' => 'array(41)'
);
$list_news = new WP_Query($news_args);

?>
    <div id="primary" class="content-area <?php echo $big_img?'top-news_img':'';?>" <?php echo $big_img?'style="background-image: url('.$big_img.');"':'';?>>
        <main id="main" class="site-main" role="main">
            <div class="container-fluid container" >
                <h1 class="page-title"><?php echo esc_html( get_the_title($current_page_id) ); ?></h1>
            </div>
                <?php if ( have_posts() ) : ?>
                    <?php if ( $top_news->have_posts() ) { ?>

                    <div class="top-news_dark">
                        <div class="post-top_date"><?php echo get_the_date('d.m.Y', $top_news_id);?></div>
                        <div class="post-top_title"><?php echo get_the_title($top_news_id);?></div>
                        <div class="post-top_expert"><?php echo cutString( $top_news_content, 150);?></div>
                        <div class="post-top_more-link"><a href="<?php echo get_the_permalink($top_news_id);?>">Детальнее</a></div>
                    </div>

                    <?php }?>
                     <div class="container-fluid container">
                    <?php while ( $list_news->have_posts() ) {
                        $list_news->the_post();?>
                        <div class="col-md-6">
                            <div class="post-list_img"><?php the_post_thumbnail('thumbnail');?></div>
                            <div class="post-list_date"><?php echo get_the_date('d.m.Y');?></div>
                            <div class="post-list_title"><?php echo get_the_title();?></div>
                            <div class="post-list_expert"><?php echo cutString( get_the_content(), 120);?></div>
                            <div class="post-list_link-more"><a href="<?php echo get_the_permalink();?>">Детальнее</a></div>
                        </div>



                    <?php }?>
                    </div>
                <?php endif;?>


        </main><!-- .site-main -->
    </div><!-- .content-area -->

<?php
get_footer();