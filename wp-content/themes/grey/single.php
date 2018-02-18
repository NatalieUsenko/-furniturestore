<?php
get_header();
$image_url = get_field('big_img');
if (!empty($image_url)){
    $image_id = get_image_id($image_url);
    $image_thumb = wp_get_attachment_image_src($image_id, 'middle');
    echo $image_thumb[0];
}

?>
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <div class="container-fluid container" >
            <?php if ( have_posts() ) { while ( have_posts() ){ the_post();?>
                <div class="post_img"><?php echo $image_thumb[0]?'<img src="'.$image_thumb[0].'">"':'';?></div>
                <div class="post_date"><?php echo get_the_date('d.m.Y');?></div>
                <h1 class="post_title"><?php echo esc_html( get_the_title() ); ?></h1>
                <div class="post_content"><?php echo  get_the_content();?></div>
            <?php }}?>
        </div>

    </main><!-- .site-main -->
</div><!-- .content-area -->

<?php
get_footer();
