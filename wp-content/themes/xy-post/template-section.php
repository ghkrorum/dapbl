<?php
/*
Template Name: Section
*/
get_header();
the_post();
$excludePostIdArray = array();
?>
				<section class="section-principal page-category">
                    <div class="container-fluid">
                        <div class="container">
                            <div class="row section">
                            	<?php
                            	$pageTitle = get_field('acf_title');

                            	if ( empty( $pageTitle ) ):
                            		$pageTitle = get_the_title();
                            	endif;
                            	?>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                    <h1 class="title-section Bebas-Neue-Bold"><i class="fa fa-window-minimize fa-left" aria-hidden="true"></i><?= $pageTitle; ?><i class="fa fa-window-minimize fa-right" aria-hidden="true"></i></h1>
                                </div>
                                <div class="col-lg-offset-4 col-lg-4 col-md-offset-4 col-md-4 col-sm-offset-4 col-sm-4 col-xs-6">
                                    <div class="section-newsletter Bebas-Neue-Light">
                                        <div class="content-new">
                                            <a href="" class="news" data-toggle="modal" data-target=".modal-newsletter">suscríbete al <strong>newsletter</strong></a>
                                        </div>
                                    </div>
                                </div>   
                            </div>

                            <?php
                            if ( have_rows('acf_featured_news_item') ) :
                            	the_row();

                            	if ( get_row_layout() == 'post' ) :
			                        $post = get_sub_field('acf_featured_news_item_post');
			                        setup_postdata( $post );
			                        $excludePostIdArray[] = $post->ID;

			                        get_template_part( 'template-parts/section/featured_news_item_post' );

			                        wp_reset_postdata();
			                    elseif ( get_row_layout() == 'custom' ) :

			                        get_template_part( 'template-parts/section/featured_news_item_custom' );

			                    endif;
			                endif;
                            ?>

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

                            <div class="row section-destacados HelveticaNeue-CondensedBold">
                                <?php
                                if ( have_rows('acf_blocks') ){
                                    while ( have_rows('acf_blocks') ) : the_row();

                                        if ( have_rows('acf_block_item') ):
                                            while ( have_rows('acf_block_item') ) : the_row();
                                                $layout = get_row_layout();
                                                if ( $layout == 'category' ) :
                                                    
                                                    include 'template-parts/section/_posts-block.php';
                                                    
                                                elseif ( $layout == 'custom' ) :
                                                    
                                                    include 'template-parts/section/_posts-block-custom.php';
                                                    
                                                endif;
                                            endwhile;
                                        endif;
                                    endwhile; 
                                }
                                ?>

                            </div>
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


                <?php
                $moreTerms = get_field('acf_load_more_terms');
                if ( $moreTerms ):
                    $termSlugs = array();
                    foreach ( $moreTerms as $term ) :
                        $termSlugs[] = $term->slug;
                    endforeach;
                ?>
                <section class="section-principal  mas-destacados">
                    <div class="container-fluid">
                        <div class="container">
                            <div class="row section section-ultimos destacados-last">

                                <?php echo do_shortcode('[ajax_load_more repeater="template_1" post_type="post" category="'.implode( ',', $termSlugs ).'" post__not_in="' . implode(",", $excludePostIdArray ) . '" posts_per_page="8" button_label = "Ver más" button_loading_label="Cargando más noticias" scroll="true"]'); ?>

                            </div>
                        </div>
                    </div>
                </section>
                <?php endif; ?>
<?php get_footer(); ?>