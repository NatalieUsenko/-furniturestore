<?php
/*
Template Name: Каталог
Template Post Type: page
*/
get_header();
$current_page_id = get_the_ID();
$big_img = get_field('big_img');
$linked_category = get_field('linked_category');
?>
<div id="primary" class="content-area <?php echo $big_img?'top-catalogue_img':'';?>" <?php echo $big_img?'style="background-image: url('.$big_img.');"':'';?>>
	<main id="main" class="site-main" role="main">
	<div class="container-fluid container" >
		<h1 class="page-title"><?php echo esc_html( get_the_title($current_page_id) ); ?></h1>
	</div>
    <?php if ( have_posts() ) :
        while ( have_posts() ) :
            the_post(); ?>
            <div class="top-catalogue_dark">
                <div class="hidden-lg hidden-md hidden-sm"><img src="<?php echo $big_img?$big_img:'';?>"></div>
                <div class="post-top_content"><?php echo get_the_content_with_formatting();?></div>
                <div class="post-top_more-link__catalogue text-uppercase hidden-sm hidden-xs"><a href="<?php echo esc_url( home_url() );?>/#catalogue">Каталог мебели</a></div>
            </div>
        <?php endwhile;?>
	<div class="clearfix"></div>
	<div class="container-fluid container mt-50">
        <?php if ($linked_category){
            $exclude_ids = array();
            $left_args = array(
                'posts_per_page' => 1,
                'post_status' => 'publish',
                'cat' => $linked_category,
                'order' => 'DESC',
                'meta_query' => array(
                     array(
                        'key'     => 'position',
                        'value' => 'left',
                        'compare' => 'LIKE',
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
                'cat' => $linked_category,
                'order' => 'DESC',
                'meta_query' => array(
                    array(
                        'key'     => 'position',
                        'value' => 'right',
                        'compare' => 'LIKE',
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
            $cat_args = array(
                //'posts_per_page' => 2,
                'post_status' => 'publish',
                'cat' => $linked_category,
                'order' => 'DESC',
                'paged' => $paged,
                'post__not_in' => $exclude_ids
            );
            $wp_query = new WP_Query($cat_args);
            $i = 0;
            ?>
            <div class="row">
            <?php while ( $wp_query->have_posts() ) {
                $wp_query->the_post();
                if ($i==0){
                    if (!empty($left_el_id)){
                        $left_img = get_field('big_img', $left_el_id);?>
                        <div id="left-item_catalogue" class="post-list_catalogue" style="background-image: url(<?php echo $left_img;?>);">
                            <div class="post-list_title">
                                <?php echo get_the_title($left_el_id);?>
                                <div class="post-list_link-more"><a href="<?php echo get_the_permalink($left_el_id);?>">Все фото <img src="<?php echo get_template_directory_uri();?>/img/more-arrows.png"></a></div>
                            </div>
                        </div>
                    <?php
                    }
                }
                if ($i==2){
                    if (!empty($right_el_id)){
                        $right_img = get_field('big_img', $right_el_id);?>
                        <div id="right-item_catalogue" class="post-list_catalogue" style="background-image: url(<?php echo $right_img;?>);">
                            <div class="post-list_title">
                                <?php echo get_the_title($right_el_id);?>
                                <div class="post-list_link-more"><a href="<?php echo get_the_permalink($right_el_id);?>">Все фото <img src="<?php echo get_template_directory_uri();?>/img/more-arrows.png"></a></div>
                            </div>
                        </div>
                        <?php
                    }
                }

                ?>
                <div class="col-md-4 col-sm-6 post-list_catalogue">
                    <?php the_post_thumbnail('catalouge-thumbnails');?>
                    <div class="post-list_title">
                        <?php echo get_the_title();?>
                        <div class="post-list_link-more"><a href="<?php echo get_the_permalink();?>">Все фото <img src="<?php echo get_template_directory_uri();?>/img/more-arrows.png"></a></div>
                    </div>
                </div>
            <?php
            $i++;
            }?>
            </div>
            <?php if (  $wp_query->max_num_pages > 1 ) : ?>
            <script>
                var ajaxurl = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
                var true_posts = '<?php echo serialize($wp_query->query_vars); ?>';
                var current_page = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
                var max_pages = '<?php echo $wp_query->max_num_pages; ?>';
            </script>
            <div align="center" id="true_loadmore_catalugue"><img src="<?php echo get_template_directory_uri();?>/img/more-arrow-circle.png" /></div>
        <?php endif; ?>

        <?php }?>

	</div>
    <?php endif;?>

	</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php
get_footer();