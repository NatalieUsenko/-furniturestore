<?php
$image_thumb = [];
$image_url_left = get_field('big_img_left');

?>
    <h1 style="display: none;"><?php echo esc_html( get_the_title() ); ?></h1>
    <div class="container-fluid container" >
        <div class="page-title"><?php echo esc_html( get_the_title() ); ?></div>
<?php if ( have_posts() ) {
    while (have_posts()) {
        the_post();
        $orig_content = get_the_content_with_formatting();
        $parts = explode('</p>', $orig_content);

        ?>
        <div>
            <div class="top-news_dark">
                <?php if (!empty($parts)){
                    echo array_shift($parts)."</p>";
                }
                ?>
            </div>
            <div id="#left-img_catalogue">
                <?php if (!empty($image_url_left)){
                    echo '<img src="'.$image_url_left.'" />';
                }
                ?>
            </div>
            <div class="top-news_dark">
                <?php if (!empty($parts)){
                    $last = array_pop($parts);
                    echo join("</p>",$parts);
                }
                ?>
            </div>

            <?php if (!empty($parts)){
                echo $last;
            }
            ?>
        </div>
    <?php }
}?>
