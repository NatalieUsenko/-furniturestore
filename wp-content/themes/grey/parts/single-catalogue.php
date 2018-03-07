<?php
?>
    <h1 style="display: none;"><?php echo esc_html( get_the_title() ); ?></h1>
    <div class="container-fluid container" >
<?php if ( have_posts() ) {
    while (have_posts()) {
        the_post(); ?>
        <div>

        </div>
    <?php }
}?>
