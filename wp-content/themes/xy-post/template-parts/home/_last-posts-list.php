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
<li class="<?= $gradientClass; ?>">
    <article class="item">
        <div class="content-image">
        <?php 
        if ( $firstPost ) :
            $post = $firstPost;
            $excludePostIdArray[] = $post->ID;
            setup_postdata( $post );
        ?>
            <?php if ( has_post_thumbnail() ) : ?>
                <img src="<?php the_post_thumbnail_url('vertical_221x436'); ?>" class="img-responsive">
            <?php else: ?>
                <img src="<?= THEME_URL; ?>/images/ultimo-1.jpg" class="img-responsive">
            <?php endif; ?>
            
        <?php else: ?>
            <img src="<?= THEME_URL; ?>/images/ultimo-1.jpg" class="img-responsive">
        <?php endif; ?>
            <div class="degradado"></div>
        </div>
        <h1 class="category"><a href="<?= $categoryLink; ?>" title="<?php the_title(); ?>"><?= $sectionCat->name; ?></a></h1>
        <div class="content-description">
            <?php if ( $firstPost ) : ?>
                <h2 class="title HelveticaNeue-CondensedBold"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h2>
            <?php endif; ?>
            <div class="list-excerpt">
                <ul>
                    <?php
                    
                    for ( $i=1 ; $i < $total ; $i++ ) :
                        $post = $sectionCatPosts[$i];
                        $excludePostIdArray[] = $post->ID;
                        setup_postdata( $post );
                    ?>
                    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                    <?php endfor; ?>
                </ul>
            </div>
        </div>
    </article>

    <div class="button-send">
        <a href="<?= $categoryLink; ?>">Ver más</a>
    </div>

</li>
<?php 
    if ( $total ) :
        wp_reset_postdata();
    endif;
endif; 
?>