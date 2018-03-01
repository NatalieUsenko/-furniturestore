<?php get_header();
$news_args = array(
    'posts_per_page' => 3,
    'post_status' => 'publish',
    'cat' => '1',
    'order' => 'DESC'
);
$news_query = new WP_Query($news_args);
$steps = get_posts(
    array(
        'name'      => 'steps',
        'post_type' => 'page'
    )
);

?>
    <div id="firstscreen">

    </div>
    <div id="catalogue">

    </div>
    <div id="steps">
        <?php if (!empty($steps)){?>
            <h2 class="text-center"><?php echo get_the_title($steps[0]->ID);?></h2>
        <?php }?>
        <div class="grey-bgr">
            <div class="container-fluid container as-table-row">
                <?php echo _e($steps[0]->post_content);?>
            </div>
        </div>
    </div>
    <div id="lastscreen">
        <div class="container-fluid container">
            <div class="row">
                <div class="col-md-6">
                    <h3>Связаться с нами</h3>
                    <div class="row">
                        <div class="col-md-10">
                            <?php echo do_shortcode('[contact-form-7 id="27" title="Связаться с нами"]'); ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h3>Статьи</h3>
                    <?php while ( $news_query->have_posts() ) {
                        $news_query->the_post();?>
                        <div class="post-list">
                            <div class="post-list_img"><?php the_post_thumbnail('thumbnail');?></div>
                            <div class="post-list_date"><?php echo get_the_date('d.m.Y');?></div>
                            <div class="post-list_title"><?php echo get_the_title();?></div>
                            <div class="post-list_expert"><?php echo cutString( get_the_content(), 100);?></div>
                            <div class="post-list_link-more"><a href="<?php echo get_the_permalink();?>">Детальнее</a></div>
                        </div>
                    <?php }?>

                </div>
            </div>
        </div>
    </div>
<?php get_footer();