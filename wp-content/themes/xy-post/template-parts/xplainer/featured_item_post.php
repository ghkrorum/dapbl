<?php

?>
<div class="row section page-banner HelveticaNeue-CondensedBold">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 box-position">
        <figure class="content-image">
        	<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'category_featured', array( 'class' => 'img-responsive' ) ); ?></a>
            <div class="degradado"></div>
            <div class="back-form">
                <div class="content-image">
                    <img src="<?= THEME_URL; ?>/images/back-full-xplainer.png" class="img-responsive">
                    <div class="txt Bebas-Neue-Regular">
                        <h1 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
                        <p><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_field('acf_subtitle'); ?></a></p>
                    </div>
                </div>
            </div>
            <div class="button-send left-button">
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><strong>ver</strong> x-plainer</a>
            </div> 
            <figcaption class="content-txt Bebas-Neue-Bold">
                <div class="excerpt">
                    <p><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></p>
                </div>
            </figcaption>
        </figure>
        <div class="button-send">
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">Ver más</a>
        </div>
    </div>
</div>