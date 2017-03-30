<?php 
get_header(); 
$currentCategory = get_category(get_query_var('cat'));
$excludePostIdArray = array();
?>
                <section class="section-principal page-category">
                    <div class="container-fluid">
                        <div class="container">
                            <div class="row section">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                    <h1 class="title-section Bebas-Neue-Bold"><i class="fa fa-window-minimize fa-left" aria-hidden="true"></i><?php single_cat_title();?><i class="fa fa-window-minimize fa-right" aria-hidden="true"></i></h1>
                                </div>
                                <div class="col-lg-offset-4 col-lg-4 col-md-offset-4 col-md-4 col-sm-offset-4 col-sm-4 col-xs-6">
                                    <div class="section-newsletter Bebas-Neue-Light">
                                        <div class="content-new">
                                            <a href="" class="news" data-toggle="modal" data-target=".modal-newsletter">suscríbete al <strong>newsletter</strong></a>
                                        </div>
                                    </div>
                                </div>   
                            </div>
                            <?php if ( have_posts() ) : the_post(); $excludePostIdArray[] = $post->ID; ?>
                            <div class="row section page-banner HelveticaNeue-CondensedBold">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <figure class="content-image">
                                        <?php if ( '' !== get_the_post_thumbnail() ) : ?>
                                            <?php the_post_thumbnail( 'twentyseventeen-featured-image', array( 'class' => 'img-responsive' ) ); ?>
                                        <?php endif; ?>
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
                            <?php endif; ?>
                            
                            <?php if ( is_active_sidebar( 'xy_section_banner_1' ) ) : ?>
                            <div class="banner-cont desktop">
                                <div class="banner_holder section-banner-1"> 
                                  <?php dynamic_sidebar( 'xy_section_banner_1' ); ?>
                                </div>
                            </div>
                            <?php endif; ?>

                            <?php if ( is_active_sidebar( 'xy_section_mobile_banner_1' ) ) : ?>
                            <div class="banner-cont mobile">
                                <div class="banner_holder section-mobile-banner-1"> 
                                  <?php dynamic_sidebar( 'xy_section_mobile_banner_1' ); ?>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <?php 
                            $counter = 0;
                            while ( more_posts()) : the_post(); 
                                $excludePostIdArray[] = $post->ID;
                            ?>  

                            <?php if ( $counter % 12 == 0) : ?>
                            <div class="row section-destacados HelveticaNeue-CondensedBold">
                            <?php endif; ?>

                            <?php if ( $counter % 4 == 0 ) : ?>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">

                                <article class="item">
                                    <div class="content-description">
                                        <h1 class="category"><?php single_cat_title(); ?></h1>
                                        <h2 class="title HelveticaNeue-CondensedBold"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                        <div class="content-image">
                                            <?php if ( '' !== get_the_post_thumbnail() ) : ?>
                                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" >
                                                <?php the_post_thumbnail( 'horizontal_253x98', array( 'class' => 'img-responsive' ) ); ?>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                        <div class="list-excerpt">
                                            <div class="list-caption">Más de <?php single_cat_title(); ?></div>
                                            <ul>

                            <?php else : ?>
                                                <li>
                                                    <p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
                                                    <time>1 minute ago</time>
                                                </li>
                            <?php endif; ?>
                                                
                            <?php if ( ($counter+1) % 4 == 0 ||  !more_posts() ) : ?>

                                            </ul>
                                        </div>
                                    </div>
                                </article>
                                <div class="button-send">
                                    <a href="<?php the_permalink();?>" title="<?php the_title(); ?>">Ver más</a>
                                </div>
                            </div>
                            <?php endif; ?>

                            <?php if ( ($counter+1) % 12 == 0 ||  !more_posts() ) : ?>
                            </div>
                            <?php endif; ?>

                            <?php 
                                $counter++;
                            endwhile; 
                            ?>


                            
                            
                        </div>
                    </div>
                </section>

                <?php if ( is_active_sidebar( 'xy_section_banner_2' ) ) : ?>
                <div class="banner-cont desktop">
                    <div class="banner_holder section-banner-2"> 
                      <?php dynamic_sidebar( 'xy_section_banner_2' ); ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ( is_active_sidebar( 'xy_section_mobile_banner_2' ) ) : ?>
                <div class="banner-cont mobile">
                    <div class="banner_holder section-mobile-banner-2"> 
                      <?php dynamic_sidebar( 'xy_section_mobile_banner_2' ); ?>
                    </div>
                </div>
                <?php endif; ?>

                <section class="section-principal  mas-destacados">
                    <div class="container-fluid">
                        <div class="container">
                            <div class="row section section-ultimos destacados-last">

                                <?php echo do_shortcode('[ajax_load_more repeater="template_1" post_type="post" category="'.$currentCategory->slug.'" post__not_in="' . implode(",", $excludePostIdArray ) . '" posts_per_page="8" button_label = "Ver más" button_loading_label="Cargando más noticias" scroll="true"]'); ?>

                            </div>
                        </div>
                    </div>
                </section>
<?php get_footer(); ?>