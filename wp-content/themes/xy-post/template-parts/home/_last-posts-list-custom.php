<?php
$title = get_sub_field('block_item_title');
$posts = get_sub_field('block_item_posts');
$moreLink = get_sub_field('block_item_link');
$target = ( get_sub_field('block_item_new_window') ) ? '_blank' : '_self' ;

if ( $posts ) :
    $post = $posts[0];
    $excludePostIdArray[] = $post->ID;
    setup_postdata( $post );
?>
<li class="<?= $gradientClass; ?>">
    <article class="item">
        <div class="content-image">
            <?php if ( has_post_thumbnail() ) : ?>
                <img src="<?php the_post_thumbnail_url('vertical_221x436'); ?>" class="img-responsive">
            <?php else: ?>
                <img src="<?= THEME_URL; ?>/images/ultimo-1.jpg" class="img-responsive">
            <?php endif; ?>
            <div class="degradado"></div>
        </div>
        <h1 class="category"><?= $title; ?></h1>
        <div class="content-description">
            <h2 class="title HelveticaNeue-CondensedBold"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h2>
            <div class="list-excerpt">
                <div class="list-caption">Más de <?= $title; ?></div>
                <ul>
                    <?php
                    $total = count($posts);
                    for ( $i=1 ; $i < $total ; $i++ ) :
                        $post = $posts[$i];
                        $excludePostIdArray[] = $post->ID;
                        setup_postdata( $post );
                    ?>
                    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                    <?php endfor; ?>
                </ul>
            </div>
        </div>
    </article>
    <?php if ( $moreLink ) : ?>
    <div class="button-send">
        <a href="<?= $moreLink; ?>" target="<?= $target; ?>">Ver más</a>
    </div>
    <?php endif; ?>
</li>
<?php 
    wp_reset_postdata();
endif; ?>