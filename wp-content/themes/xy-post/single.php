<?php get_header(); ?>
                <?php
                global $post;
                while ( have_posts() ) : the_post();
                    $topics = get_field('acf_topics');
                    if ( $topics ) :
                        get_template_part( 'template-parts/post/xplainer' );
                    else : 
                        $excludePostIdArray[] = $post->ID;
                        $author = get_field('acf_author');
                        $authorName = "";
                        $authorTwitter = "";
                        $permalink = get_the_permalink();
                        $permalink = parse_url($permalink, PHP_URL_PATH);
                ?>
                <section class="page-nota" data-post-id="<?= $post->ID?>" data-post-title="<?php the_title(); ?>" data-post-permalink="<?= $permalink; ?>">
                    <?php if ( is_active_sidebar( 'xy_single_banner_1' ) ) : ?>
                    <div class="banner-cont desktop">
                        <div class="banner_holder single-banner-1"> 
                          <?php dynamic_sidebar( 'xy_single_banner_1' ); ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if ( is_active_sidebar( 'xy_single_mobile_banner_1' ) ) : ?>
                    <div class="banner-cont mobile">
                        <div class="banner_holder single-mobile-banner-1"> 
                          <?php dynamic_sidebar( 'xy_single_mobile_banner_1' ); ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="container-fluid">
                        <div class="container">
                            <div class="row section back">
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="content-title HelveticaNeue-CondensedBold">
                                        <h1 class="title"><span><?php the_title(); ?></span></h1>
                                    </div>
                                </div>
                                <?php if ( $author ) : 
                                    $currentPost = $post;
                                    $post = $author[0];
                                    setup_postdata( $post );
                                    $authorName = get_the_title();
                                    $authorTwitter = get_field('acf_twitter');
                                ?>
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 image">
                                    <figure class="content-image">
                                      <?php the_post_thumbnail( 'author_thumb', array('class' => 'img-responsive') ); ?>
                                      <figcaption class="BebasNeue-Thin">
                                            <h1><span>por</span> <?= $authorName; ?></h1>
                                        </figcaption>
                                    </figure>
                                </div>
                                <?php 
                                    $post = $currentPost;
                                    setup_postdata( $post );
                                endif; ?>
                            </div>
                            <?php if ( $authorTwitter ) : ?>
                            <div class="row title-twitter HelveticaNeue-CondensedBold">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    twitter: <a href="https://twitter.com/<?= $authorTwitter; ?>" target="_blank">@<?= $authorTwitter;?></a>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="row section">
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 post-content">
                                    <div class="content-nota Bebas-Neue-Regular">
                                        <div class="featured-image">
                                            <?php the_post_thumbnail( 'post_featured', array('class' => 'img-responsive') ); ?>
                                        </div>
                                        <ul class="list-inline content-date HelveticaNeue-CondensedBold">
                                            <?= kxn_the_time(); ?>
                                            <li><?= $authorName; ?></li>
                                        </ul>
                                        <div class="content-txt">
                                            <?php the_content(); ?>
                                        </div>
                                        <ul class="list-inline content-date HelveticaNeue-CondensedBold">
                                            <?= kxn_the_time(); ?>
                                            <li><?= $authorName; ?></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 aside">
                                    <?php if ( is_active_sidebar( 'xy_single_sidebar' ) ) : ?>
                                        <?php dynamic_sidebar( 'xy_single_sidebar' ); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if ( is_active_sidebar( 'xy_single_banner_2' ) ) : ?>
                    <div class="banner-cont desktop">
                        <div class="banner_holder single-banner-2"> 
                          <?php dynamic_sidebar( 'xy_single_banner_2' ); ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if ( is_active_sidebar( 'xy_single_mobile_banner_2' ) ) : ?>
                    <div class="banner-cont mobile">
                        <div class="banner_holder single-mobile-banner-2"> 
                          <?php dynamic_sidebar( 'xy_single_mobile_banner_2' ); ?>
                        </div>
                    </div>
                    <?php endif; ?>

                </section>
                <?php
                $relatedPosts = get_field('acf_related_posts');
                if ( $relatedPosts ) :
                ?>
                <section class="section-title-nota">
                    <div class="container-fluid section">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                    <h1 class="title-section Bebas-Neue-Bold"><i class="fa fa-window-minimize fa-left" aria-hidden="true"></i>noticias relacionadas<i class="fa fa-window-minimize fa-right" aria-hidden="true"></i></h1>
                                </div>
                                <div class="col-lg-offset-6 col-lg-3 col-md-offset-6 col-md-3 col-sm-offset-8 col-sm-4 col-xs-6">
                                    <div class="section-newsletter Bebas-Neue-Light">
                                        <div class="content-new">
                                            <a href="" class="news">suscríbete al <strong>newsletter</strong></a>
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        </div>
                    </div>
                </section> 
                <section class="section section-notas">
                    <div class="container-fluid Bebas-Neue-Bold">
                        <div class="container">              
                            <div class="row">
                                <?php 
                                foreach ( $relatedPosts as $post ) : 
                                    setup_postdata( $post );
                                ?>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <figure class="content-image">
                                      <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'related_thumb', array( 'class' => 'img-responsive' ) ); ?></a>
                                      <figcaption class="txt-img">
                                            <h1><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
                                            <div class="txt Bebas-Neue-Regular">
                                                <p><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php excerpt(70); ?></a></p>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </div>
                                <?php endforeach; ?>
                            </div>   
                        </div>
                    </div>
                </section>
                <?php endif; // if ( $relatedPosts ) : ?>

                <?php echo do_shortcode('[ajax_load_more post_type="post" post__not_in="' . implode(",", $excludePostIdArray ) . '" posts_per_page="1" category__not_in="3"]'); ?>


                <?php // echo do_shortcode('[ajax_load_more previous_post="true" previous_post_id="430" post_type="post" post__not_in="' . implode(",", $excludePostIdArray ) . '" posts_per_page="1" category__not_in="3"]'); ?>
                    
                <section class="section-loading">
                    <div class="container-fluid section">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-offset-4 col-lg-4 col-md-offset-4 col-md-4 col-sm-offset-4 col-sm-4 col-xs-offset-3 col-xs-6">
                                    <div class="content-icon"><i class="fa fa-spinner" aria-hidden="true"></i></div>
                                    <h1 class="title-section Bebas-Neue-Bold"><i class="fa fa-window-minimize fa-left" aria-hidden="true"></i>loading<i class="fa fa-window-minimize fa-right" aria-hidden="true"></i></h1>
                                </div>   
                            </div>
                        </div>
                    </div>
                </section>

                <?php endif; ?>

                <?php 
                endwhile; // while ( have_posts() ) :
                ?>
<?php get_footer(); ?>