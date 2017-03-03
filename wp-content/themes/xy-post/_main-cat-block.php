                                            <article class="item">
                                                <div class="content-image">
                                                    <?php the_post_thumbnail('207x413', array('alt' => get_the_title() )); ?>
                                                    <div class="degradado"></div>
                                                </div>
                                                <h1 class="category"><?= $term->name; ?></h1>
                                                <div class="content-description">
                                                    <h2 class="title HelveticaNeue-CondensedBold"><span><?php the_title(); ?></span></h2>
                                                    <div class="list-excerpt">
                                                        <ul>
                                                            <?php 
                                                            for($i=1 ; $i<$total ; $i++ ) :
                                                                $post = $mainPosts[$i];
                                                                setup_postdata( $post );
                                                            ?>
                                                            <li><i class="fa fa-plus" aria-hidden="true"></i><a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>"><?php the_title(); ?></a></li>
                                                            <?php endfor; ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </article>
                                            <div class="button-send">
                                                <a href="<?=  esc_url($category_link); ?>" alt="<?= $term->name; ?>">Ver más</a>
                                            </div>