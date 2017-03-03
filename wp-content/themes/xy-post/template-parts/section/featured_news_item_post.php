<div class="row section page-banner HelveticaNeue-CondensedBold">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <figure class="content-image">
            <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail( 'category_featured', array( 'class' => 'img-responsive' ) ); ?>
            </a>
            <figcaption class="content-txt Bebas-Neue-Bold">
                <div class="excerpt">
                    <p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
                </div>
            </figcaption> 
        </figure>
        <div class="button-send">
            <a href="<?php the_permalink(); ?>">Ver más</a>
        </div>
    </div>
</div>