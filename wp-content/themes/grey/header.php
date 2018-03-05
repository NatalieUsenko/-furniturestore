<?php
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">

    <div id="content" class="site-content">

        <header id="masthead" class="site-header not-fixed" role="banner">
            <div class="container container-fluid">
                <div class="as-table-row">
                    <div class="logo as-table-cell text-left">
                            <?php
                            if ( function_exists( 'the_custom_logo' ) ) {
                                the_custom_logo();
                            } else {
                                echo '<a href="'.esc_url( home_url() ).'" rel="home"><img src="'.get_template_directory_uri().'/img/top-logo.png" />';
                            }
                            ?>
                    </div>
                    <div class="as-table-cell text-center">
                        <div id="top-contacts">
                            <div class="center-block-el">
                            <?php
                            $phone = get_field('contacts_phone', 7);
                            if ($phone) {
                                echo '<img src="'.get_template_directory_uri().'/img/icon-phone.png" /> '.$phone;
                            }
                            ?>
                            </div>
                            <div class="center-block-el">
                                <?php
                                $email = get_field('contacts_email', 7);
                                if ($email) {
                                    echo '<a href="mailto:'.$email.'" class="emaillink"><img src="'.get_template_directory_uri().'/img/icon-mail.png" /> '.$email.'</a>';
                                }
                                ?>
                            </div>
                            <div class="center-block-el">
                                <?php
                                $adress = get_field('contacts_adress', 7);
                                if ($adress) {
                                    echo '<img src="'.get_template_directory_uri().'/img/icon-pin.png" /> '.$adress;
                                }
                                ?>
                            </div>
                        </div>
                        <div id="top-menu" role="navigation">
                            <?php wp_nav_menu( array(
                                'container_class' => 'top-menu',
                                'theme_location' => 'primary'
                            ) ); ?>
                        </div>
                    </div>
                    <div class="as-table-cell text-right show-always">
                        <?php
                        $url = get_field('contacts_fb', 7);
                        if (@file_get_contents($url)){
                           echo '<a href="'.$url.'" target="_blank" rel=""><img src="'.get_template_directory_uri().'/img/fb-logo.png" /></a>';
                        }
                        ?>
                        <div class="menu-btn"></div>
                    </div>

                </div>
            </div><!-- .site-branding -->
        </header><!-- .site-header -->


