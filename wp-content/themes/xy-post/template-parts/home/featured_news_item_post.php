<section class="featured-banner">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-13 col-md-12 col-sm-12 col-xs-12 padding-reset">
                <div class="content-image">
                    <img src="<?php the_post_thumbnail_url('home_featured'); ?>" class="img-responsive">
                    <a href="<?php the_permalink(); ?>">
                        <div class="txt-cont">
                            <div class="col-sm-6 col-sm-offset-6 col-md-6 col-md-offset-6">
                                <div class="txt-wrap">
                                    <h1>
                                        <?php the_title(); ?>
                                    <h1>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>