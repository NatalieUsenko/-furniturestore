<?php
$image_thumb = [];
$image_url = get_field('big_img');
if (!empty($image_url)){
    $image_id = get_image_id($image_url);
    $image_thumb = wp_get_attachment_image_src($image_id, 'medium');
}
$recomend = get_field('recomended');
?>
<h1 style="display: none;"><?php echo esc_html( get_the_title() ); ?></h1>
<div class="container-fluid container" >
    <?php if ( have_posts() ) { while ( have_posts() ){ the_post();?>
        <div>
            <div class="post_img"><?php echo !empty($image_thumb[0])?'<img src="'.$image_thumb[0].'">':'';?>
                <div class="as-table-row">
                    <div class="col-xs-6 no-padding-left as-table-cell">
                        Рассказать друзьм <a href="javascript:fbshareCurrentPage()"><img src="<?php echo get_template_directory_uri();?>/img/fb-grey.png"></a>
                    </div>
                    <div class="col-xs-6 text-right no-padding-right as-table-cell"><a href="<?php echo esc_url(home_url());?>/stati"><img src="<?php echo get_template_directory_uri();?>/img/back-arrows-bl.png"> Все статьи</a></div>
                </div>
            </div>
            <div class="post_date"><?php echo get_the_date('d.m.Y');?></div>
            <div class="post_title"><?php echo esc_html( get_the_title() ); ?></div>
            <div class="post_content"><?php echo get_the_content_with_formatting();?></div>
        </div>
        <?php if ($recomend){?>
            <div class="post_title mt-50">Рекомендуем прочитать</div>
            <?php foreach ($recomend as $value){
                $categories = get_the_category($value);
                ?>
                <div class="col-md-6 post-list">
                    <div class="post-list_img"><?php echo get_the_post_thumbnail($value,'thumbnail');?></div>
                    <div class="post-list_date"><?php echo ($categories[0]->term_id==1)?get_the_date('d.m.Y', $value):$categories[0]->name;?></div>
                    <div class="post-list_title"><?php echo get_the_title($value);?></div>
                    <div class="post-list_expert"><?php echo cutString( get_the_content($value), 120);?></div>
                    <div class="post-list_link-more"><a href="<?php echo get_the_permalink($value);?>">Детальнее</a></div>
                </div>
            <?php }?>
        <?php }

        ?>
    <?php }
    }?>
</div>
<script language="javascript">
    function fbshareCurrentPage()
    {window.open("https://www.facebook.com/sharer/sharer.php?u="+escape(window.location.href)+"&t="+document.title, '',
        'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');
        return false; }
</script>