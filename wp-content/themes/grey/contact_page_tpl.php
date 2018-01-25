<?php
/*
Template Name: Контакты
Template Post Type: page
*/
get_header(); ?>
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <?php if ( have_posts() ) : ?>
                <div class="container-fluid container">
                    <?php
                    // Start the loop.
                    while ( have_posts() ) : the_post();
                    ?>
                    <div class="col-md-5">
                        <h1 class="page-title"><?php echo esc_html( get_the_title() ); ?></h1>
                    </div>
                    <div class="col-md-7">

                    </div>
                    <?php
                    endwhile;
                    ?>
                </div>
            <?php
            endif;
            ?>

        </main><!-- .site-main -->
    </div><!-- .content-area -->

<?php get_footer();