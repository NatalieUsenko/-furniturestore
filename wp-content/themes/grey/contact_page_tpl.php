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
                        <div class="mt-50">
                            <?php
                            $phone = get_field('contacts_phone');
                            $addphone = get_field('contacts_addphones');
                            if ($phone | $addphone) {echo '<div class="page_phone">';}
                            if ($phone){ echo $phone;}
                            if ($phone & $addphone) {echo '<br />';}
                            if ($addphone){echo $addphone;}
                            if ($phone | $addphone) {echo '</div>';}
                            ?>

                            <?php
                            $email = get_field('contacts_email');
                            if ($email) {
                                echo '<div class="page_mail"><a href="mailto:'.$email.'" class="emaillink">'.$email.'</a></div>';
                            }
                            ?>

                            <?php
                            $adress = get_field('contacts_adress');
                            if ($adress) {
                                echo '<div class="page_address">'.$adress.'</div>';
                            }
                            ?>
                            <?php
                            the_content();
                            ?>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <?php
                        $map = get_field('contacts_map');
                        if ($map) {
                            echo '<pre>';
                            var_dump($map);
                            echo '</pre>';
                        }
                        ?>

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