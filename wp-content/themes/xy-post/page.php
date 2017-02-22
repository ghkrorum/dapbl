<?php get_header(); 
the_post();
?>
                <section class="section-principal page-aviso">
                    <div class="container-fluid">
                        <div class="container">
                            <div class="row section">
                                <div class="col-lg-offset-1 col-lg-9 col-md-offset-1 col-md-9 col-sm-12 col-xs-12">
                                    <h1 class="title-section"><?php the_title(); ?></h1>
                                    <div class="content-line">
                                        <hr>
                                    </div>
                                    <div class="content-description Bebas-Neue-Regular">
                                        <?php the_content(); ?>
                                    </div>
                                </div>   
                            </div>
                        </div>
                    </div>
                </section> 
<?php get_footer(); ?>