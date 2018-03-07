<?php
$image_thumb = [];
$image_url_left = get_field('big_img_left');
$image_url_right = get_field('big_img_right');
?>
    <h1 style="display: none;"><?php echo esc_html( get_the_title() ); ?></h1>
    <div class="container-fluid catalogue__inner" >
        <div class="page-title"><?php echo esc_html( get_the_title() ); ?></div>
<?php if ( have_posts() ) {
    while (have_posts()) {
        the_post();
        $orig_content = get_the_content_with_formatting();
        $parts = explode('</p>', $orig_content);

        ?>
        <div class="row catalogue__inner_row">
            <div id="right-img"<?php if (!empty($image_url_right)){
                echo ' style="background-image:url('.$image_url_right.');"';
            }
            ?>></div>

            <div id="left-text" class="catalogue__inner_dark">
                <?php if (!empty($parts)){
                    echo array_shift($parts)."</p>";
                }
                ?>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row catalogue__inner_row">
            <div id="left-img">
                <?php if (!empty($image_url_left)){
                    echo '<img src="'.$image_url_left.'" />';
                }
                ?>
            </div>
            <div id="right-text"  class="catalogue__inner_dark">
                <?php if (!empty($parts)){
                    $last = array_pop($parts);
                    $find   = 'gallery-item';
                    $pos = strpos($last, $find);
                    if ($pos === false) {
                        array_push($parts, $last);
                        $last = '';
                    }
                    echo join("</p>",$parts);
                }
                ?>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="container">
            <div class="row">
                <?php if (!empty($parts)){
                    echo $last;
                }
                ?>
            </div>
        </div>
    <?php }
}?>
