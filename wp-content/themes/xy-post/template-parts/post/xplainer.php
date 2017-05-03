<?php

?>
<section class="page-xplainer">
    <div class="container-fluid">
        <div class="container section">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <figure class="content-image">
                        <?php the_post_thumbnail( 'xplainer_post_thumb', array( 'class' => 'img-responsive' ) ); ?>
                        <div class="mascara"></div>
                        <h1 class="category Bebas-Neue-Regular"><img src="<?= THEME_URL; ?>/images/icon-xplainer.png">plainers</h1>
                        <figcaption class="HelveticaNeue-CondensedBold txt">
                            <h2 class="title"><?php the_title(); ?></h2>
                            <h3 class="subtitle"><?php the_field('acf_subtitle'); ?></h3>
                        </figcaption>
                    </figure>
                    <ol class="menu-xplainer Bebas-Neue-Regular">
                        <?php
                        $topics = get_field('acf_topics');
                        $counter = 0;
                        if ( $topics ) :
                            foreach ( $topics as $topic ) :
                                $class = ($counter)?'':'active';

                        ?>
                        <li><a href="#" class="pager-item pager-item-<?= $counter; ?> <?= $class;?>" data-index="<?= $counter; ?>"><?= $topic['acf_topic_title']; ?></a></li>
                        <?php 
                                $counter++;
                            endforeach;
                        endif; 
                        ?>
                    </ol>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="content-xplainer">
                        <div class="content-back">
                            <div class="" id="xplainer-carousel">
                                <?php
                                if ( $topics ) :
                                    reset( $topics );
                                    foreach ( $topics as $topic ) :
                                ?>
                                <article class="item">
                                    <div class="scroll-white HelveticaNeue-CondensedBold">
                                        <?= $topic['acf_topic_content']; ?>
                                    </div>
                                </article>
                                <?php 
                                    endforeach;
                                endif;
                                ?>
                            </div> 
                            <?php echo do_shortcode('[ssbp title="'.get_the_title().'" url="'.get_permalink().'"]'); ?>
                        </div>
                        <a href="#" class="cycle-pager cycle-prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                        <a href="#" class="cycle-pager cycle-next"><i class="glyphicon glyphicon-chevron-right"></i></a>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>