<footer class="section-footer">
                    <div class="container-fluid">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5">
                                    <figure class="content-image logo">
                                        <img src="<?= THEME_URL; ?>/images/xy-logo.png" class="img-responsive" alt="XY Post">
                                    </figure>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-4 col-xs-7 section-newsletter Bebas-Neue-Light">
                                    <div class="content-new">
                                        <a href="" class="news" data-toggle="modal" data-target=".modal-newsletter">suscríbete al <strong>newsletter</strong></a>
                                    </div>
                                    <?php wp_nav_menu( array( 
                                        'theme_location' => 'xy_post_footer_menu',
                                        'container' => '',
                                        'items_wrap' => '<ul class="list-inline Bebas-Neue-Bold screen" >%3$s</ul>'
                                    )); ?>
                                    <!-- <ul class="list-inline Bebas-Neue-Bold screen">
                                        <li><a href="">Terminos y condiciones</a></li>
                                        <li><a href="">Aviso de privacidad</a></li>
                                        <li><a href="">Contacto</a></li>
                                    </ul> -->
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 redes">
                                    <?php wp_nav_menu( array( 
                                        'theme_location' => 'xy_post_footer_menu_mobile',
                                        'container' => '',
                                        'items_wrap' => '<ul class="list-inline Bebas-Neue-Bold movil" >%3$s</ul>'
                                    )); ?>
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
                                </div>
                            </div>    
                        </div>
                    </div>
                </footer>
            </section>
        </section>
        <!--modal newsletter-->
        <div class="modal fade bd-modal-lg modal-newsletter" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-center">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header Bebas-Neue-Light">
                            <span class="title-close">Back</span>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <section class="section-xplainer Bebas-Neue-Regular">
                                <h1 class="title">suscríbete a nuestro </h1>
                                <h2 class="title-section Bebas-Neue-Bold"><i class="fa fa-window-minimize fa-left" aria-hidden="true"></i>newsletter<i class="fa fa-window-minimize fa-right" aria-hidden="true"></i></h2>
                                <?php echo do_shortcode( '[contact-form-7 id="481" title="Newsletter"]' ); ?>
                            </section>
                        </div>
                    </div>
                </div>    
            </div>    
        </div>
        <!--End--> 
        <!--modal Search-->
        <div class="modal fade bd-modal-lg modal-search" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-center">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header Bebas-Neue-Light">
                            <span class="title-close">Back</span>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <section class="section-xplainer Bebas-Neue-Regular">
                                <h2 class="title-section Bebas-Neue-Bold"><i class="fa fa-window-minimize fa-left" aria-hidden="true"></i>buscar<i class="fa fa-window-minimize fa-right" aria-hidden="true"></i></h2>
                                <div class="form-cont">
                                    <div class="form-group">
                                        <input id="search-term-input" class="form-control" placeholder="Search" name="term" type="text">
                                        <button id="search-submit" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></button>
                                    </div>
                                    <div class="required-msg">
                                        escribe al menos 3 letras para buscar
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div id="search-results" class="content-results Bebas-Neue-Regular">
                            
                        </div>
                    </div>
                </div>    
            </div>    
        </div>
        <!--End-->                      
        <?php wp_footer();?>
    </body>
</html>