<?php
$author = get_field('acf_author');
$authorName = "";
$authorTwitter = "";
?>
<section class="page-nota">
    <div class="container-fluid">
        <div class="container">
            <div class="row section back">
                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                    <div class="content-title HelveticaNeue-CondensedBold">
                        <h1 class="title"><span><?php the_title(); ?></span></h1>
                    </div>
                </div>
                <?php if ( $author ) : 
                    $post = $author;
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
                    wp_reset_postdata();
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
                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
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
                    <div class="section-newsletter Bebas-Neue-Light">
                        <div class="content-new">
                            <div class="news">suscríbete al <strong>newsletter</strong></div>
                        </div>
                    </div>
                    <aside>
                        <div class="content-newsletter Bebas-Neue-Bold">
                            <!--<div class="msg-exit">
                                <div class="news"><strong>gracias</strong></div>
                                <h1>ya estas inscrito <span>a nuestro</span></h1>
                                <h2>·newsletter·</h2>
                            </div>-->
                            <h1>escribe tu mail <span>y suscríbete a nuestro</span></h1>
                            <h2>·newsletter·</h2>
                            <form>  
                                <div class="form-group">
                                    <input type="mail" class="form-control" name="name">
                                </div>
                                <div class="content-send">
                                    <button type="submit" class="btn btn-default">Enviar</button>
                                </div>
                            </form>

                        </div>    
                    </aside>
                    <div class="content-image">  
                        <img src="<?= THEME_URL; ?>/images/nota-image.jpg" class="img-responsive" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
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