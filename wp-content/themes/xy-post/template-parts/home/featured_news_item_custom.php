<?php 
$imageArray = get_sub_field('featured_news_item_image');
$link = get_sub_field('featured_news_item_link');
$target = ( get_sub_field('featured_news_item_new_window') ) ? '_blank' : '_self';
?>
<section class="featured-banner">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-13 col-md-12 col-sm-12 col-xs-12 padding-reset">
                <div class="content-image">
                    <?= kxn_get_acf_image($imageArray, 'home_featured', 'img-responsive'); ?>
                    <?php if ($link): ?>
                    <a href="<?= $link; ?>" target="<?= $target; ?>">
                    <?php endif; ?>
                        <div class="txt-cont">
                            <div class="col-sm-6 col-sm-offset-6 col-md-6 col-md-offset-6">
                                <div class="txt-wrap">
                                    <h1>
                                        <?php the_sub_field('featured_news_item_title'); ?>
                                    </h1>
                                </div>
                            </div>
                        </div>
                    <?php if ($link): ?>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>