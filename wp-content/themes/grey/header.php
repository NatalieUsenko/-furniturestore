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
            <div class="container-fluid">
                <div class="row" style="border: 1px solid blueviolet;">
                    <div class="logo">
                    <?php
                    if ( function_exists( 'the_custom_logo' ) ) {
                        the_custom_logo();
                    } else {
                        echo '<img src="'.get_template_directory_uri().'/img/top-logo.png" />';
                    }
                    ?>
                    </div>
                </div>
            </div><!-- .site-branding -->
        </header><!-- .site-header -->


