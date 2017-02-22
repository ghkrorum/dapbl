<li>
    <article class="item">
        <div class="content-image">
            <?php the_post_thumbnail( 'xplainer_thumb', array( 'class' => 'img-responsive' ) ); ?>
            <div class="mascara"></div>
            <div class="content-forma">
                <img src="<?= THEME_URL; ?>/images/back-thum-xplainer.png" class="img-responsive">
            </div>
            <h1 class="title HelveticaNeue-CondensedBold"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
        </div>
        <div class="content-txt">
            <div class="content-txt-scroll">
                <div class="content-txt-scroll-wrap">
                    <div class="content-txt-wrap">
                        <h2 class="subtitle HelveticaNeue-CondensedBold">
                            <?php the_field('acf_subtitle'); ?>
                        </h2>
                        <div class="txt Bebas-Neue-Regular">
                            <ol>
                                <?php 
                                if ( have_rows('acf_topics') )  : 
                                    while ( have_rows('acf_topics') ) : 
                                        the_row();
                                ?>
                                <li>
                                    <p><?php the_sub_field('acf_topic_title'); ?></p>
                                </li>

                                <?php 
                                    endwhile;
                                endif; 
                                ?>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="button-send Bebas-Neue-Bold">
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">Ver x-plainer</a>
        </div>
    </article>
</li>