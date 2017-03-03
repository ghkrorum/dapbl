<?php
$greenCount = $alm_query->current_post + 3;
$blueCount = $alm_query->current_post + 2;
$gradientClass = 'yellow';

if ( $greenCount % 4 == 0 ){
    $gradientClass = 'green';
}
if ( $blueCount % 4 == 0 ){
    $gradientClass = 'blue';
}
?>
<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
    <div class="list-inline list-ultimos Bebas-Neue-Bold <?= $gradientClass?>">
        <article class="item">
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
            <div class="content-image">
                <?php the_post_thumbnail( 'vertical_221x436', array( 'class' => 'img-responsive' ) ); ?>
                <div class="degradado"></div>
            </div>
            <h1 class="category"><?= kxn_get_first_category_link(); ?></h1>
            <div class="content-description">
                <h2 class="title HelveticaNeue-CondensedBold"><span><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" ><?php the_title(); ?></a></span></h2>
            </div>
            </a>
        </article>
        <div class="button-send">
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">Ver más</a>
        </div>
    </div>
</div>