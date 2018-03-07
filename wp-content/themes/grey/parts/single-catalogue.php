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
            <pre>
               <?php var_dump($parts);?>
            </pre>
        </div>
    <?php }
}?>
