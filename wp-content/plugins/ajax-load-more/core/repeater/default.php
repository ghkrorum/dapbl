<?php
global $post;
$author = get_field('acf_author');
$authorName = "";
$authorTwitter = "";
$permalink = get_the_permalink();
$permalink = parse_url($permalink, PHP_URL_PATH);
?>
<section class="page-nota" data-post-id="<?= $post->ID?>" data-post-title="<?php the_title(); ?>" data-post-permalink="<?= $permalink; ?>">
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

                                </div>
                            </div>
                        </div>
                    </div>
                </section>