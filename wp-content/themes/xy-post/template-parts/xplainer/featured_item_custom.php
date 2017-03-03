<?php
$imageArray = get_sub_field('acf_featured_item_image');
$title = $the_title = get_sub_field('acf_featured_item_title');
$subtitle = get_sub_field('acf_featured_item_subtitle');
$link = get_sub_field('acf_featured_item_link');

$target = ( get_sub_field('featured_news_item_new_window') ) ? '_blank' : '_self';

if ( $link ) :
    $the_title = '<a href="'.$link.'" title="'.$title.'">'.$title.'</a>';
endif;
?>
<div class="row section page-banner HelveticaNeue-CondensedBold">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 box-position">
        <figure class="content-image">
            <?php if ( $link ) : ?>
            <a href="<?= $link; ?>" title="<?= $title; ?>">
            <?php endif; ?>
            <?= kxn_get_acf_image($imageArray, 'category_featured', 'img-responsive'); ?>
            <?php if ( $link ) : ?>
            </a>
            <?php endif; ?>
            <div class="degradado"></div>
            <div class="back-form">
                <div class="content-image">
                    <img src="<?= THEME_URL; ?>/images/back-full-xplainer.png" class="img-responsive">
                    <div class="txt Bebas-Neue-Regular">
                        <!-- <h1 class="title">This interactive</h1> -->
                        <p><?= $subtitle; ?></p>
                    </div>
                </div>
            </div>
            <div class="button-send left-button">
                <a href="<?= $link; ?>" title="<?= $title; ?>"><strong>ver</strong> x-plainer</a>
            </div> 
            <figcaption class="content-txt Bebas-Neue-Bold">
                <div class="excerpt">
                    <p><?= $the_title; ?></p>
                </div>
            </figcaption>
        </figure>
        <div class="button-send">
            <a href="<?= $link; ?>" title="<?= $title; ?>">Ver más</a>
        </div>
    </div>
</div>