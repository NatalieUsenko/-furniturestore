<?php
/*
Template Name: Каталог
Template Post Type: page
*/
get_header();
$current_page_id = get_the_ID();
$big_img = get_field('big_img');
?>
<div id="primary" class="content-area <?php echo $big_img?'top-catalogue_img':'';?>" <?php echo $big_img?'style="background-image: url('.$big_img.');"':'';?>>
	<main id="main" class="site-main" role="main">
	<div class="container-fluid container" >
		<h1 class="page-title"><?php echo esc_html( get_the_title($current_page_id) ); ?></h1>
	</div>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<div class="top-catalogue_dark top-news_dark">
		<div class="hidden-lg hidden-md"><img src="<?php echo $big_img?$big_img:'';?>"></div>
		<div class="post-top_content"><?php echo get_the_content_with_formatting();?></div>
		<div class="post-top_more-link__catalogue text-uppercase"><a href="javascript:void(0);">Каталог мебели</a></div>
	</div>

	<div class="clearfix"></div>
	<div class="container-fluid container mt-50">

	</div>
    <?php
    endwhile;
    endif;
    ?>

	</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php
get_footer();