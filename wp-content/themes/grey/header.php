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

        <header id="masthead" class="site-header" role="banner">
            <div class="container container-fluid">
                <div class="row">
                    <div class="logo left-block">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                            <?php
                            if ( function_exists( 'the_custom_logo' ) ) {
                                the_custom_logo();
                            } else {
                                echo '<img src="'.get_template_directory_uri().'/img/top-logo.png" />';
                            }
                            ?>
                        </a>
                    </div>
                    <div class="center-block">
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
                            $phone = get_field('contacts_email', 7);
                            if ($phone) {
                                echo '<img src="'.get_template_directory_uri().'/img/icon-mail.png" /> '.$phone;
                            }
                            ?>
                        </div>
                        <div class="center-block-el">
                            <?php
                            $phone = get_field('contacts_adress', 7);
                            if ($phone) {
                                echo '<img src="'.get_template_directory_uri().'/img/icon-pin.png" /> '.$phone;
                            }
                            ?>
                        </div>
                    </div>
                    <div class="right-block">
                        <?php
                        $url = get_field('contacts_fb', 7);
                        if (@file_get_contents($url)){
                           echo '<a href="'.$url.'" target="_blank" rel=""><img src="'.get_template_directory_uri().'/img/fb-logo.png" /></a>';
                        }
                        ?>
                        <div class="menu">
                            <img src="<?php echo get_template_directory_uri();?>/img/menu-burger.png" />
                        </div>
                    </div>

                </div>
            </div><!-- .site-branding -->
        </header><!-- .site-header -->


