<?php
/*
Template Name: Xplainer
*/
get_header();
the_post();
$excludePostIdArray = array();
?>
                <section class="section-principal page-category page-category-xplainer">
                    <div class="container-fluid">
                        <div class="container">
                            <div class="row section">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                    <h1 class="title-section Bebas-Neue-Bold"><i class="fa fa-window-minimize fa-left" aria-hidden="true"></i><?php the_title(); ?><i class="fa fa-window-minimize fa-right" aria-hidden="true"></i></h1>
                                </div> 
                            </div>
                            <?php
                            if ( have_rows('acf_featured_item') ) :
                                the_row();
                                if ( get_row_layout() == 'post' ) :
                                    $post = get_sub_field('acf_featured_item_post');
                                    setup_postdata( $post );
                                    $excludePostIdArray[] = $post->ID;

                                    get_template_part( 'template-parts/xplainer/featured_item_post' );

                                    wp_reset_postdata();
                                elseif ( get_row_layout() == 'custom' ) :

                                    get_template_part( 'template-parts/xplainer/featured_item_custom' );

                                endif;
                            endif;
                            ?>
                        </div>
                    </div>
                </section>                          
                
                <section class="section-article-xplaner">
                    <div class="container-fluid">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <ul class="list-inline">
                                        <?php 
                                        $explainers = get_field('acf_explainers');
                                        if ( $explainers ) :
                                            $counter = 0;
                                        
                                            foreach( $explainers as $post) : 
                                                setup_postdata($post); 
                                                $excludePostIdArray[] = $post->ID;
                                                $counter++;
                                                include 'template-parts/xplainer/_loop-item.php';
                                            endforeach; 
                                            wp_reset_postdata();
                                        endif;
                                        
                                        if ( get_field('acf_autoload') ) :

                                            if ( $counter % 3 != 0) :
                                                $next = kxn_round_up_to($counter, 3);
                                                $numberposts = $next - $counter;
                                                $moreExplainers = get_posts(array(
                                                    'numberposts' => $numberposts,
                                                    'exclude' => $excludePostIdArray,
                                                    'tax_query' => array(
                                                        array(
                                                            'taxonomy' => 'category',
                                                            'field'    => 'slug',
                                                            'terms'    => 'x-plainers',
                                                        ),
                                                    ),
                                                ));

                                                if ( $moreExplainers ) : 
                                                    foreach ( $moreExplainers as $post ) :
                                                        setup_postdata( $post ); 
                                                        $excludePostIdArray[] = $post->ID;
                                                        include 'template-parts/xplainer/_loop-item.php';
                                                    endforeach;
                                                    wp_reset_postdata();
                                                endif;
                                            endif; 
                                        endif;
                                        ?>
                                    </ul>
                                    <?php
                                    $moreTerms = get_field('acf_load_more_terms');
                                    if ( $moreTerms && get_field('acf_autoload') ):
                                        $termSlugs = array();
                                        foreach ( $moreTerms as $term ) :
                                            $termSlugs[] = $term->slug;
                                        endforeach;
                                    ?>
                                    <?php echo do_shortcode('[ajax_load_more container_type="ul" css_classes="list-inline" repeater="template_2" post_type="post" category="'.implode( ',', $termSlugs ).'" post__not_in="' . implode(",", $excludePostIdArray ) . '" posts_per_page="6" button_label = "Ver más" button_loading_label="Cargando más noticias" scroll="true"]'); ?>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
<?php get_footer(); ?>