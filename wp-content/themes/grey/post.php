<?php
get_header();
?>
<div id="primary" class="content-area <?php echo $big_img?'top-news_img':'';?>" <?php echo $big_img?'style="background-image: url('.$big_img.');"':'';?>>
    <main id="main" class="site-main" role="main">
        <div class="container-fluid container" >
            <?php if ( have_posts() ) { ?>
                <div class="post_date"><?php echo get_the_date('d.m.Y', $top_news_id);?></div>
                <h1 class="post_title"><?php echo esc_html( get_the_title() ); ?></h1>
                <div class="post_content"><?php echo  get_the_content();?></div>
            <?php }?>
        </div>

    </main><!-- .site-main -->
</div><!-- .content-area -->

<?php
get_footer();
