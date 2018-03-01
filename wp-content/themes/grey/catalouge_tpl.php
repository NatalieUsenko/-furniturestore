<?php
/*
Template Name: Каталог
Template Post Type: page
*/
get_header();
$current_page_id = get_the_ID();
$big_img = get_field('big_img');
$linked_category = get_field('linked_category');
var_dump($linked_category);
?>
<div id="primary" class="content-area <?php echo $big_img?'top-catalogue_img':'';?>" <?php echo $big_img?'style="background-image: url('.$big_img.');"':'';?>>
	<main id="main" class="site-main" role="main">
	<div class="container-fluid container" >
		<h1 class="page-title"><?php echo esc_html( get_the_title($current_page_id) ); ?></h1>
	</div>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<div class="top-catalogue_dark">
		<div class="hidden-lg hidden-md"><img src="<?php echo $big_img?$big_img:'';?>"></div>
		<div class="post-top_content"><?php echo get_the_content_with_formatting();?></div>
		<div class="post-top_more-link__catalogue text-uppercase"><a href="javascript:void(0);">Каталог мебели</a></div>
	</div>

	<div class="clearfix"></div>
	<div class="container-fluid container mt-50">
        <?php if ($linked_category){
            $exclude_ids = array();
            $left_args = array(
                'posts_per_page' => 1,
                'post_status' => 'publish',
                'order' => 'DESC',
                'meta_query' => array(
                    'position' => array(
                        'key'     => 'position',
                        'value' => '1',
                        'compare' => 'left',
                    ),
                ),
            );
            $left_el = new WP_Query($left_args);
            while ( $left_el->have_posts() ) {
                $left_el->the_post();
                $left_el_id = get_the_ID();
                array_push($exclude_ids, $left_el_id);
                $left_el_img = get_field('big_img', $left_el_id);
                $left_el_content = get_the_content();
            }
            $right_args = array(
                'posts_per_page' => 1,
                'post_status' => 'publish',
                'order' => 'DESC',
                'meta_query' => array(
                    'position' => array(
                        'key'     => 'position',
                        'value' => '1',
                        'compare' => 'right',
                    ),
                ),
            );
            $right_el = new WP_Query($right_args);
            while ( $right_el->have_posts() ) {
                $right_el->the_post();
                $right_el_id = get_the_ID();
                array_push($exclude_ids, $right_el_id);
                $right_el_img = get_field('big_img', $right_el_id);
                $right_el_content = get_the_content();
            }
            $paged = (get_query_var('page')) ? get_query_var('page') : 1;
            $news_args = array(
                // 'posts_per_page' => 2,
                'post_status' => 'publish',
                'cat' => $linked_category,
                'order' => 'DESC',
                'paged' => $paged,
                'post__not_in' => $exclude_ids
            );
            $wp_query = new WP_Query($news_args);

            ?>
            <?php while ( $wp_query->have_posts() ) {
                $wp_query->the_post();
                echo 'Left = '.$left_el_id.' Right = '.$right_el_id;
                ?>
                <div class="col-md-6 post-list">
                    <div class="post-list_img"><?php the_post_thumbnail('thumbnail');?></div>
                    <div class="post-list_date"><?php echo get_the_date('d.m.Y');?></div>
                    <div class="post-list_title"><?php echo get_the_title();?></div>
                    <div class="post-list_expert"><?php echo cutString( get_the_content(), 120);?></div>
                    <div class="post-list_link-more"><a href="<?php echo get_the_permalink();?>">Детальнее</a></div>
                </div>
            <?php }?>

        <?php }?>

	</div>
    <?php
    endwhile;
    endif;
    ?>

	</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php
get_footer();