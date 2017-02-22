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
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 <?= $blockClass?>">
    <article class="item">
        <div class="content-description">
            <h1 class="category"><?= $title; ?></h1>
            <h2 class="title HelveticaNeue-CondensedBold"><a hreF="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
            <div class="content-image">
                <?php if ( has_post_thumbnail() ) : ?>
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                    <img src="<?php the_post_thumbnail_url('horizontal_253x98'); ?>" class="img-responsive">
                </a>
                <?php else: ?>
                    <!--img src="<?= THEME_URL; ?>/images/thumb-destacado.jpg" class="img-responsive"-->
                <?php endif; ?>
            </div>
            <div class="list-excerpt">
                <ul>
                    <?php
                    $total = count($posts);
                    for ( $i=1 ; $i < $total ; $i++ ) :
                        $post = $posts[$i];
                        $excludePostIdArray[] = $post->ID;
                        setup_postdata( $post );
                    ?>
                    <li>
                        <p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
                        <time><?php kxn_the_time_diff(); ?></time>
                    </li>
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
</div>
<?php 
    wp_reset_postdata();
endif; ?>