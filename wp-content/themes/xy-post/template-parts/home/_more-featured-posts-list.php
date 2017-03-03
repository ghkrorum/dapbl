<?php
$sectionCat = get_sub_field('block_item_cat');
if ( $sectionCat ) :

    $firstPost = null;
    $title = $sectionCat->name;

    $sectionCatPosts = get_posts(array(
        'post_status' => 'publish',
        'category' => $sectionCat->term_id,
        'exclude' => $excludePostIdArray,
    ));

    $total = count($sectionCatPosts);

    if ( $total ) :
        $firstPost = $sectionCatPosts[0];
    endif;

    $categoryLink = esc_url( get_category_link($sectionCat->term_id) );
?>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 <?= $blockClass; ?>">
    <article class="item">
        <div class="content-description">
            <h1 class="category"><a href="<?= $categoryLink; ?>" title="<?= $sectionCat->name; ?>"><?= $sectionCat->name; ?></a></h1>
            <?php 
            if ( $firstPost ) : 
                $post = $firstPost;
                $excludePostIdArray[] = $post->ID;
                setup_postdata( $post );
            ?>
            <h2 class="title HelveticaNeue-CondensedBold"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
            <div class="content-image">
                <?php if ( has_post_thumbnail() ) : ?>
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                    <img src="<?php the_post_thumbnail_url('horizontal_253x98'); ?>" class="img-responsive">
                </a>
                <?php endif; ?>
            </div>
            <?php 
            endif; 
            ?>
            <div class="list-excerpt">
                <ul>
                    <?php
                    for ( $i=1 ; $i < $total ; $i++ ) :
                        $post = $sectionCatPosts[$i];
                        $excludePostIdArray[] = $post->ID;
                        setup_postdata( $post );
                    ?>
                    <li>
                        <p><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></p>
                        <time><?= kxn_the_time_diff(); ?></time>
                    </li>
                    <?php endfor; ?>
                </ul>
            </div>
        </div>
    </article>
    <div class="button-send">
        <a href="<?= $categoryLink; ?>" title="Ver más">Ver más</a>
    </div>
</div>
<?php 
    if ( $total ) :
        wp_reset_postdata();
    endif;
endif; 
?>