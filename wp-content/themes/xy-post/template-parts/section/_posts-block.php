<?php
$sectionCat = get_sub_field('acf_block_item_cat');
if ( $sectionCat ) :
    $sectionCatPosts = get_posts(array(
        'post_status' => 'publish',
        'category' => $sectionCat->term_id,
        'exclude' => $excludePostIdArray,
    ));

    $total = count($sectionCatPosts);
?>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 first">
    <article class="item">
        <div class="content-description">
            <h1 class="category"><?= $sectionCat->name; ?></h1>
            <?php 
            if ($total) : 
                $post = $sectionCatPosts[0];
                $excludePostIdArray[] = $post->ID;
                setup_postdata( $post );
            ?>
            <h2 class="title HelveticaNeue-CondensedBold"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
            <div class="content-image">
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'horizontal_253x98', array( 'class' => 'img-responsive' ) ); ?></a>
            </div>
            <?php endif; ?>
            <div class="list-excerpt">
                <ul>
                    <?php 
                    for ( $i = 1 ; $i < $total ; $i++ ):
                        $post = $sectionCatPosts[$i];
                        $excludePostIdArray[] = $post->ID;
                        setup_postdata($post);
                    ?>
                    <li>
                        <p><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></p>
                        <time>1 minute ago</time>
                    </li>
                    <?php endfor; ?>
                </ul>
            </div>
        </div>
    </article>
    <?php ?>
    <div class="button-send">
        <a href="<?php echo esc_url( get_category_link($sectionCat->term_id) ); ?>" title="<?= $sectionCat->name; ?>" >Ver más</a>
    </div>
</div>
<?php 
    if ($total):
        wp_reset_postdata();
    endif;
endif; ?>