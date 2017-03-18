<?php
/*
Template Name: Home
*/
get_header();
the_post();
$excludePostIdArray = array();
?>
                <?php
                if ( have_rows('featured_news_item') ) :
                    the_row();

                    if ( get_row_layout() == 'post' ) :
                        $post = get_sub_field('featured_news_item_post');
                        setup_postdata( $post );
                        $excludePostIdArray[] = $post->ID;

                        get_template_part( 'template-parts/home/featured_news_item_post' );

                        wp_reset_postdata();
                    elseif ( get_row_layout() == 'custom' ) :

                        get_template_part( 'template-parts/home/featured_news_item_custom' );

                    endif;
                    
                endif; 
                ?>

                <?php
                $htmlBlocks = array();
                
                if ( have_rows('section_1_blocks') ){
                    $blockCount = 0;
                    $gradientClass = '';
                    while ( have_rows('section_1_blocks') ) : the_row();
                        switch ( $blockCount ) {
                            case 0:
                                # code...
                                $gradientClass = 'green';
                                break;
                            case 2:
                                # code...
                                $gradientClass = 'yellow';
                                break;
                            default:
                                # code...
                                $gradientClass = '';
                                break;
                        }

                        if ( have_rows('block_item') ):
                            
                            while ( have_rows('block_item') ) : the_row();

                                if ( get_row_layout() == 'category' ) :
                                    ob_start();
                                        include 'template-parts/home/_last-posts-list.php';
                                    $htmlBlocks[] = ob_get_clean();
                                elseif ( get_row_layout() == 'custom' ) :
                                    ob_start();
                                        include 'template-parts/home/_last-posts-list-custom.php';
                                    $htmlBlocks[] = ob_get_clean();
                                endif;
                                $blockCount++;
                            endwhile;
                        endif;

                    endwhile; 
                }

                ?>

                <section class="section-principal the-home">
                    <div class="container-fluid">
                        <div class="container">
                            <?php if ( is_active_sidebar( 'xy_home_banner_1' ) ) : ?>
                            <div class="banner-cont desktop">
                                <div class="banner_holder banner-1"> 
                                  <?php dynamic_sidebar( 'xy_home_banner_1' ); ?>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php if ( is_active_sidebar( 'xy_home_mobile_banner_1' ) ) : ?>
                            <div class="banner-cont mobile">
                                <div class="banner_holder mobile-banner-1"> 
                                  <?php dynamic_sidebar( 'xy_home_mobile_banner_1' ); ?>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="row section">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <h1 class="title-section HelveticaNeue-Bold"><i class="fa fa-window-minimize fa-left" aria-hidden="true"></i>
<?php the_field('section_1_title');?><i class="fa fa-window-minimize fa-right" aria-hidden="true"></i>
</h1>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                    <hr>
                                </div>    
                            </div>
                            <?php
                            $lastPosts = get_posts(array(
                                'numberposts' => 8,
                            ));
                            ?> 
                            <div class="row section section-ultimos">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 last-news-block">
                                    <div class="last-news-block-wrap">
                                        <div id="cycle-ultimo" class="post-last HelveticaNeue-CondensedBold">

                                            <?php
                                            if ( $lastPosts ) : 
                                                for ( $i=0 ; $i < count($lastPosts) ; $i++ ) : 
                                                    if ( $i % 4 == 0) :
                                                        echo '<div class="item"><ul>';
                                                    else:
                                                        echo '<li class="divider"></li>';
                                                    endif;

                                                    $post = $lastPosts[$i];

                                                    setup_postdata($post);
                                            ?>
                                                <li>
                                                    <p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
                                                    <time><?php kxn_the_time_diff(); ?></time>
                                                </li>
                                            <?php
                                                    if ( ($i+1) % 4 == 0 ):
                                                        echo '</ul></div>';
                                                    endif;
                                                endfor;
                                                wp_reset_postdata();
                                            endif;
                                            ?>
                                        </div>
                                        <ul class="the-pager">
                                            <li>
                                                <a href="#" class="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                                            </li>
                                            <li class="text-center">
                                                <a href="#" class="pager-item pager-item-0 active" data-index="0">&#8226;</a>
                                                <a href="#" class="pager-item pager-item-1" data-index="1">&#8226;</a>
                                            </li>
                                            <li>
                                                <a href="#" class="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                    <ul class="list-inline list-ultimos HelveticaNeue-Bold">
                                        <?= implode(' ', $htmlBlocks); ?>
                                    </ul>
                                </div>
                            </div>

                            <?php if ( is_active_sidebar( 'xy_home_mobile_banner_2' ) ) : ?>
                            <div class="banner-cont mobile">
                                <div class="banner_holder mobile-banner-2"> 
                                  <?php dynamic_sidebar( 'xy_home_mobile_banner_2' ); ?>
                                </div>
                            </div>
                            <?php endif; ?>
                            

                            <?php if ( have_rows('section_2_blocks') ): ?>

                            <div class="row section">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <h1 class="title-section HelveticaNeue-Bold"><i class="fa fa-window-minimize fa-left" aria-hidden="true"></i><?php the_field('section_2_title');?><i class="fa fa-window-minimize fa-right" aria-hidden="true"></i></h1>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                    <hr>
                                </div>    
                            </div>
                            <div class="row section-destacados HelveticaNeue-CondensedBold">

                                <?php 
                                $blockClass = 'first';
                                while ( have_rows('section_2_blocks') ) :  the_row(); 
                                    if ( have_rows('block_item') ):
                                        while ( have_rows('block_item') ) :  the_row(); 
                                            if ( get_row_layout() == 'category' ) :
                                                    include 'template-parts/home/_featured-posts-list.php';
                                                
                                            elseif ( get_row_layout() == 'custom' ) :
                                                    include 'template-parts/home/_featured-posts-list-custom.php';

                                            endif;
                                        endwhile;
                                    endif;
                                    $blockClass = '';
                                endwhile;
                                ?>

                            </div>

                            <?php endif; // if ( have_rows('section_2_blocks') ): ?>
                            
                            <?php if ( is_active_sidebar( 'xy_home_banner_2' ) ) : ?>
                            <div class="banner-cont desktop">
                                <div class="banner_holder banner-2"> 
                                  <?php dynamic_sidebar( 'xy_home_banner_2' ); ?>
                                </div>
                            </div>
                            <?php endif; ?>

                            <?php if ( is_active_sidebar( 'xy_home_mobile_banner_3' ) ) : ?>
                            <div class="banner-cont mobile">
                                <div class="banner_holder mobile-banner-3"> 
                                  <?php dynamic_sidebar( 'xy_home_mobile_banner_3' ); ?>
                                </div>
                            </div>
                            <?php endif; ?>

                            <?php 
                            $videos = get_field('section_3_videos');
                            if ( $videos ) : 
                                $moreLink = get_field('section_3_more_link');
                            ?>
                            <div class="row section">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <h1 class="title-section HelveticaNeue-Bold"><i class="fa fa-window-minimize fa-left" aria-hidden="true"></i><?php the_field('section_3_title'); ?><i class="fa fa-window-minimize fa-right" aria-hidden="true"></i></h1>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                    <hr>
                                </div>    
                            </div>
                            <div class="row section section-videos">
                                
                                <?php 
                                $post = $videos[0];
                                $excludePostIdArray[] = $post->ID;
                                setup_postdata($post);
                                ?>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <a href="<?php the_permalink(); ?>" class="content-video">
                                        <?php if ( has_post_thumbnail() ) : ?>
                                        <img src="<?php the_post_thumbnail_url('video_medum'); ?>" class="img-responsive">
                                        <?php endif;  ?>
                                        <div class="degradado"></div>
                                        <h3 class="title HelveticaNeue-CondensedBold"><span><?php the_title(); ?></span></h3>
                                        <img src="<?= THEME_URL; ?>/images/play-negro.png" class="btn-play">
                                    </a>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <?php 
                                    $total = count($videos);

                                    for ( $i=1 ; $i < $total ; $i++ ) :
                                        $post = $videos[$i];
                                        $excludePostIdArray[] = $post->ID;
                                        setup_postdata($post);
                                    ?>

                                    <?php if ( !( ($i+1) % 2 ) ) : ?>
                                    <ul class="content-videos HelveticaNeue-CondensedBold">
                                    <?php endif; ?>
                                    
                                        <li>
                                            <a href="<?php the_permalink(); ?>" class="content-video">
                                                <?php if ( has_post_thumbnail() ) : ?>
                                                <img src="<?php the_post_thumbnail_url('video_medum'); ?>" class="img-responsive">
                                                <?php endif; ?>
                                                <div class="layout-black"></div>
                                                <h3 class="title"><?php the_title(); ?></h3>
                                                <img src="<?= THEME_URL; ?>/images/play-negro.png" class="btn-play">
                                            </a>
                                        </li>

                                    <?php if ( !($i % 2) || ($i+1) == $total ) : ?>
                                    </ul>
                                    <?php endif; ?>

                                    <?php endfor; ?>
                                </div>
                            </div>
                            <?php 
                            if ( $moreLink ) : 
                            ?>
                            <div class="row section section-videos">
                                <div class="col-lg-offset-1 col-lg-9 col-md-offset-1 col-md-9 col-sm-offset-1 col-sm-8 col-xs-12"><hr>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
                                    <div class="button-send Bebas-Neue-Bold">
                                        <a href="<?= $moreLink; ?>">Ver más</a>
                                    </div>
                                </div>
                            </div>
                            <?php endif; // if ( $moreLink ) :  ?>
                            <?php 
                                wp_reset_postdata();
                            endif; // if ( $videos ) :  
                            ?>

                            <?php if ( is_active_sidebar( 'xy_home_banner_3' ) ) : ?>
                            <div class="banner-cont desktop">
                                <div class="banner_holder banner-3"> 
                                  <?php dynamic_sidebar( 'xy_home_banner_3' ); ?>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>
                <?php
                $postsSection4 = get_field('section_4_posts');
                if ( $postsSection4 ) :
                ?>
                <section class="section-banner">
                    <div class="container-fluid">
                        <div class="container">
                            <div class="row">
                                <?php 
                                foreach ( $postsSection4 as $post ) : setup_postdata($post); 
                                    $excludePostIdArray[] = $post->ID;
                                ?>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                        <article class="item">
                                            <div class="content-image">
                                                <?php if ( has_post_thumbnail() ) : ?>
                                                <img src="<?php the_post_thumbnail_url('vertical_221x436'); ?>" class="img-responsive">
                                                <?php endif; ?>
                                                <div class="img-degradado">
                                                    <h3 class="title HelveticaNeue-Bold"><?php the_title(); ?></h3>
                                                </div>
                                            </div>
                                        </article>
                                    </a>
                                    <div class="button-send Bebas-Neue-Bold">
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">Ver más</a>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </section>
                <?php 
                    wp_reset_postdata();
                endif; // if ( $postsSection4 ) :
                ?>

                <?php if ( is_active_sidebar( 'xy_home_banner_4' ) ) : ?>
                <div class="banner-cont desktop">
                    <div class="banner_holder banner-4"> 
                      <?php dynamic_sidebar( 'xy_home_banner_4' ); ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php 
                $explainers = get_field('section_5_posts');
                if ( $explainers ) :
                    $moreLink = get_field('section_5_more_link');
                    $moreCaption = get_field('section_5_more_caption');
                    
                ?>
                <section class="space-grey">
                    <div class="container-fluid">
                    </div>
                </section>       
                <section class="section-xplainer">
                    <div class="container-fluid">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                    <h1 class="title-section HelveticaNeue-Bold"><i class="fa fa-window-minimize fa-left" aria-hidden="true"></i><?php the_field('section_5_title'); ?><i class="fa fa-window-minimize fa-right" aria-hidden="true"></i></h1>
                                </div>
                                <?php if ( $moreLink ) : ?>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6">
                                    <div class="button-send Bebas-Neue-Bold"><i class="fa fa-plus-circle" aria-hidden="true"></i><a href="<?= $moreLink; ?>"><?= $moreCaption; ?></a></div>
                                </div>    
                                <?php endif; ?>
                            </div>
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
                                        foreach ( $explainers as $post ) : 
                                            $excludePostIdArray[] = $post->ID;
                                            setup_postdata($post);
                                            
                                            include 'template-parts/xplainer/_loop-item.php';
                                        
                                            
                                        endforeach; // foreach ( $explainers as $post ) : 
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <?php 
                    wp_reset_postdata();
                endif; // if ( $explainers ) :
                ?>

                <?php
                if ( have_rows('section_6_blocks') ) :
                    $title = get_field('section_6_title');
                    $moreLink = get_field('section_6_more_link');
                    $moreCaption = get_field('section_6_more_caption');
                    
                ?>
                <section class="section-xplainer">
                    <div class="container-fluid">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <h1 class="title-section HelveticaNeue-Bold"><i class="fa fa-window-minimize fa-left" aria-hidden="true"></i><?= $title; ?><i class="fa fa-window-minimize fa-right" aria-hidden="true"></i></h1>
                                </div>
                                <?php if ( $moreLink ) : ?>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <div class="button-send Bebas-Neue-Bold"><i class="fa fa-plus-circle" aria-hidden="true"></i><a href="<?= $moreLink; ?>"><?= $moreCaption; ?></a></div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="section-principal  mas-destacados">
                    <div class="container-fluid">
                        <div class="container">
                            <div class="row section section-destacados HelveticaNeue-CondensedBold">
                                <?php
                                while ( have_rows('section_6_blocks') ) : the_row();
                                    if ( have_rows('block_item') ):
                                        while ( have_rows('block_item') ) : the_row();
                                            if ( get_row_layout() == 'category' ) :

                                                include 'template-parts/home/_more-featured-posts-list.php';

                                            elseif ( get_row_layout() == 'custom' ) :

                                                include 'template-parts/home/_more-featured-posts-list-custom.php';

                                            endif;
                                        endwhile;
                                    endif;
                                endwhile;
                                ?>
                            </div>
                        </div>
                    </div>
                </section>
                <?php endif; // if ( have_rows('section_6_blocks') ) : ?>

                <section class="section-principal  mas-destacados">
                    <div class="container-fluid">
                        <div class="container">
                            <div class="row section section-ultimos destacados-last">

                                <?php echo do_shortcode('[ajax_load_more repeater="template_1" post_type="post" post__not_in="' . implode(",", $excludePostIdArray ) . '" posts_per_page="8" button_label = "Ver más" button_loading_label="Cargando más noticias" scroll="true"]'); ?>

                            </div>
                        </div>
                    </div>
                </section>
<?php get_footer(); ?>