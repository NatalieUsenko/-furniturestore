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
                <?php if (!empty($parts[0])){
                    echo $parts[0];
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
                    $total = count($parts);
                    foreach ($parts as $key => $part){
                        if (($key!=0)&&($key==$total)){
                            echo $part;
                        }
                    }
                }
                ?>
            </div>

            <?php if (!empty($parts)){
                echo $part[$total];
            }
            ?>
        </div>
    <?php }
}?>
