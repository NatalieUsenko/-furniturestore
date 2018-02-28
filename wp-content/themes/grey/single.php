<?php
get_header();
$image_url = get_field('big_img');
if (!empty($image_url)){
    $image_id = get_image_id($image_url);
    $image_thumb = wp_get_attachment_image_src($image_id, 'medium');
}

?>
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <div class="container-fluid container" >
            <?php if ( have_posts() ) { while ( have_posts() ){ the_post();?>

                <div>
                    <div class="post_img"><?php echo $image_thumb[0]?'<img src="'.$image_thumb[0].'">':'';?>
                        <div class="as-table-row">
                            <div class="col-xs-6 no-padding-left as-table-cell">
                                Рассказать друзьм <a href="javascript:void(0);"><img src="<?php echo get_template_directory_uri();?>/img/fb-grey.png"></a>
                            </div>
                            <div class="col-xs-6 text-right no-padding-right as-table-cell"><a href="<?php echo esc_url(home_url());?>/stati"><< Все статьи</a></div>
                        </div>
                    </div>
                    <p class="post_date"><?php echo get_the_date('d.m.Y');?></p>
                    <p class="post_title"><?php echo esc_html( get_the_title() ); ?></p>
                    <p class="post_content"><?php echo  get_the_content();?></p>
                </div>
            <?php }}?>
        </div>

    </main><!-- .site-main -->
</div><!-- .content-area -->

<?php
get_footer();
