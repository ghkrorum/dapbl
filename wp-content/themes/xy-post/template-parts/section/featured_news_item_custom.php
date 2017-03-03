<?php 
$imageArray = get_sub_field('acf_featured_news_item_image');
$link = get_sub_field('acf_featured_news_item_link');
$target = ( get_sub_field('acf_featured_news_item_new_window') ) ? '_blank' : '_self';
$title = get_sub_field('acf_featured_news_item_title');

if ($link):
    $title = '<a href="'.$link.'" target="'.$target.'">'.$title.'</a>';
endif;
?>
<div class="row section page-banner HelveticaNeue-CondensedBold">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <figure class="content-image">
            <?php if ($link) : ?>
            <a href="<?= $link; ?>" target="<?= $target; ?>">
            <?php endif; ?>

            <?= kxn_get_acf_image($imageArray, 'category_featured', 'img-responsive'); ?>

            <?php if ($link) : ?>
            </a>
            <?php endif; ?>
            <figcaption class="content-txt Bebas-Neue-Bold">
                <div class="excerpt">
                    <p><?= $title; ?></p>
                </div>
            </figcaption> 
        </figure>
        <?php if ($link): ?>
        <div class="button-send">
            <a href="<?= $link; ?>" target="<?= $target; ?>">Ver más</a>
        </div>
        <?php endif; ?>
    </div>
</div>