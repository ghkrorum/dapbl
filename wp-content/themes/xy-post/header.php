<!DOCTYPE html>
<html lang='<?php language_attributes(); ?>'>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
        <title>
            <?php wp_title(''); ?>
            <?php if(wp_title('', false)) { echo ' :'; } ?>
            <?php bloginfo('name'); ?>
        </title>
        <?php wp_head(); ?>
    </head>
    <body>
         <section class="wrapper">
            <section class="center-home">
                <header class="section-menu">
                    <div class="container-fluid">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <nav class="menu">
                                        <div class="btn-group Bebas-Neue-Bold mobile-menu">
                                            <button type="button" class="dropdown-toggle" data-toggle="dropdown">
                                                <span class="sr-only">Toggle navigation</span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                            </button>
                                            <h2>Secciones</h2>
                                            <?php wp_nav_menu( array( 
                                                'theme_location' => 'xy_post_mobile_menu',
                                                'container' => '',
                                                'items_wrap' => '<ul class="dropdown-menu" role="menu">%3$s</ul>'
                                            )); ?>
                                            <!-- <ul class="dropdown-menu" role="menu">
                                                <li><a href="#" class="active">x-plainers</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#">x-business</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#">x-tech</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#">w-news</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#">x-world</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#">x-me</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#">glosario</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#">video</a></li>
                                                <li class="divider"></li>
                                                <li><a class="newsletter" href="#">newsletter</a></li>
                                            </ul> -->
                                        </div>
                                        <figure class="content-image logo">
                                            <a href="<?php echo home_url();?>">
                                                <img class="img-responsive" src="<?= THEME_URL; ?>/images/logo.png" alt="xy Post"/>
                                            </a>
                                        </figure>

                                        <ul class="redes-sociales list-inline Bebas-Neue-Light">
                                            <li><a href="" data-toggle="modal" data-target=".modal-search"><i class="fa fa-search rounded-circle" aria-hidden="true"></i></a></li>
                                            <?php
                                            $facebook = get_field('acf_options_facebook', 'option');
                                            $twitter = get_field('acf_options_twitter', 'option');
                                            $youtube = get_field('acf_options_youtube', 'option');
                                            ?>
                                            <?php if ( $facebook ) : ?>
                                            <li><a href="<?= $facebook; ?>" target="_blank"><i class="fa fa-facebook rounded-circle" aria-hidden="true"></i></a></li>
                                            <?php endif; ?>
                                            <?php if ( $twitter ) : ?>
                                            <li><a href="<?= $twitter; ?>" target="_blank"><i class="fa fa-twitter rounded-circle" aria-hidden="true"></i></a></li>
                                            <?php endif; ?>
                                            <?php if ( $youtube ) : ?>
                                            <li><a href="<?= $youtube; ?>" target="_blank"><i class="fa fa-youtube-play rounded-circle" aria-hidden="true"></i></a></li>
                                            <?php endif; ?>
                                            <li><a href="<?php bloginfo('rss2_url'); ?>" target="_blank"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
                                        </ul>

                                        <div class="main-menu">
                                            <?php wp_nav_menu( array( 
                                                'theme_location' => 'xy_post_menu',
                                                'container' => '',
                                            )); ?>
                                        </div>
                                    </nav> 
                                </div>  
                            </div> 
                        </div>
                    </div>
                </header>