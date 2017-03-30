<?php
$title = get_sub_field('acf_block_item_title');
$posts = get_sub_field('acf_block_item_posts');
$moreLink = get_sub_field('acf_block_item_link');
$target = ( get_sub_field('acf_block_item_new_window') ) ? '_blank' : '_self' ;
?>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 first">
    <article class="item">
        <div class="content-description">
            <h1 class="category"><?= $title; ?></h1>

            <?php 
            $total = count($posts);
            if ( $total ):
                $post = $posts[0];
                $excludePostIdArray[] = $post->ID;
                setup_postdata( $post );
            ?>
                <h2 class="title HelveticaNeue-CondensedBold"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div class="content-image">
                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'horizontal_253x98', array( 'class' => 'img-responsive' ) ); ?></a>
                </div>

            <?php endif; ?>

            <div class="list-excerpt">
                <div class="list-caption">Más de <?= $title; ?></div>
                <ul>
                    <?php
                    for ( $i = 1 ; $i < $total ; $i++ ) : 
                        $post = $posts[$i];
                        $excludePostIdArray[] = $post->ID;
                        setup_postdata( $post );
                    ?>
                    <li>
                        <p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
                        <time>1 minute ago</time>
                    </li>
                    <?php endfor; ?>
                </ul>
            </div>
        </div>
    </article>
    <?php if ($moreLink) : ?>
    <div class="button-send">
        <a href="<?= $moreLink; ?>" target="<?= $target; ?>">Ver más</a>
    </div>
    <?php endif; ?>
</div>
<?php 
if ($total):
    wp_reset_postdata();
endif;
?>