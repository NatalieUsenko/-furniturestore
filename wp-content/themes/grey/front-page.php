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

$page_args = array(
    'posts_per_page' => 8,
    'post_status' => 'publish',
    'post_type' => 'page',
    'order'     => 'DESC',
    'orderby'   => 'menu_order',
    'meta_query' => array(
        array(
            'key'     => 'show_in_front',
            'value' => '1',
            'compare' => 'LIKE',
        ),
    ),
);
$page_query = new WP_Query($page_args);

?>
    <div id="firstscreen">
        <div class="info__wrapper">
            <div class="info">
                <img src="<?php echo get_template_directory_uri();?>/img/main-logo.png" style="margin-bottom: 50px;">
                <?php
                $phone = get_field('contacts_phone', 7);
                if ($phone) {
                    echo '<p><img class="info__img" src="'.get_template_directory_uri().'/img/icon-phone.png" /> '.$phone.'</p>';
                }
                ?>
                <?php
                $email = get_field('contacts_email', 7);
                if ($email) {
                    echo '<p><a href="mailto:'.$email.'" class="emaillink"><img class="info__img" src="'.get_template_directory_uri().'/img/icon-mail.png" /> '.$email.'</a></p>';
                }
                ?>
                <?php
                $adress = get_field('contacts_adress', 7);
                if ($adress) {
                    echo '<p><img class="info__img" src="'.get_template_directory_uri().'/img/icon-pin.png" /> '.$adress.'</p>';
                }
                ?>
            </div>
        </div>
        <div class="slider">
            <?php echo do_shortcode('[owl-carousel category="main-slider" singleItem="true" items="1" navigation="true" pagination="true" lazyLoad="true" slideSpeed="900" paginationSpeed="400" animateOut="fade" animateIn="fade"]');?>
        </div>
        <div class="grey-line">
             <a id="owl-prev" href="javascript:void(0);"></a>
            <a href="#catalogue" class="go-to">Каталог мебели</a>
            <div id="slider-content"></div>
            <a id="owl-next" href="javascript:void(0);"></a>
        </div>
        <div class="clearfix"></div>
    </div>
    <div id="catalogue">
        <div class="container-fluid container">
        <?php if ($page_query->have_posts()) {?>
            <h2 class="text-center">Каталог мебели</h2>
            <div class="row mt-50">

        <?php while ( $page_query->have_posts() ) {
            $page_query->the_post();
            $page_id = get_the_ID();
        ?>
            <div class="col-md-3 col-sm-6 col-xs-12 catalogue__item">
                <a href="<?php echo get_the_permalink($page_id);?>">
                    <?php echo get_the_post_thumbnail($page_id, 'main-thumbnails');?>
                    <span><?php echo get_the_title($page_id);?></span>
                </a>
            </div>

            <?php }?>
            </div>
        <?php }?>
        </div>
    </div>
    <div id="steps">
        <?php if (!empty($steps)){?>
            <h2 class="text-center"><?php echo get_the_title($steps[0]->ID);?></h2>
        <?php }?>
        <div class="grey-bgr">
            <div class="container-fluid container">
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
                    <h3><a href="<?php echo get_category_link('1');?>">Статьи</a></h3>
                    <?php while ( $news_query->have_posts() ) {
                        $news_query->the_post();?>
                        <div class="post-list">
                            <div class="post-list_img"><?php the_post_thumbnail('thumbnail');?></div>
                            <div class="post-list_date"><?php echo get_the_date('d.m.Y');?></div>
                            <div class="post-list_title"><?php echo get_the_title();?></div>
                            <div class="post-list_expert"><?php echo cutString( strip_tags(get_the_content()), 100);?></div>
                            <div class="post-list_link-more"><a href="<?php echo get_the_permalink();?>">Подробнее</a></div>
                        </div>
                    <?php }?>

                </div>
            </div>
        </div>
    </div>
<?php get_footer();