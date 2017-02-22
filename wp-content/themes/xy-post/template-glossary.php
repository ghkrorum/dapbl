<?php
/*
Template Name: Glossary
*/
get_header();
the_post();

$currentUrl = get_permalink(); 

$alphabet = array(
    'A',
    'B',
    'C',
    'D',
    'E',
    'F',
    'G',
    'H',
    'I',
    'J',
    'K',
    'L',
    'M',
    'N',
    'Ñ',
    'O',
    'P',
    'Q',
    'R',
    'S',
    'T',
    'U',
    'V',
    'W',
    'X',
    'Y',
    'Z',
);

$postIDs = array();

$wp_query = new WP_Query();

if ( isset( $_GET['glossary_term'] ) ) :
    $term = $_GET['glossary_term'];

    $wp_query->query( array( 
        'kxn_title_like' => $term,
        'post_type' => 'glossary',
        'posts_per_page' => -1,
        'caller_get_posts'=> 1
    ));

else:

    $first_char = ( isset( $_GET['letter'] ) )? $_GET['letter'] : 'A' ;

    $postIDs = $wpdb->get_col($wpdb->prepare("
    SELECT      ID
    FROM        $wpdb->posts
    WHERE       $wpdb->posts.post_type = 'glossary' AND SUBSTR($wpdb->posts.post_title,1,1) LIKE '%s'
    ORDER BY    $wpdb->posts.post_title",$first_char)); 

endif;

?>

                <section class="section-principal page-glosary">
                    <div class="container-fluid">
                        <div class="container">
                            <div class="row section">
                                <div class="col-lg-offset-4 col-lg-4 col-md-offset-4 col-md-4 col-sm-offset-4 col-sm-4 col-xs-offset-3 col-xs-6">
                                    <h1 class="title-section Bebas-Neue-Bold">
                                        <i class="fa fa-window-minimize fa-left" aria-hidden="true"></i>glosario<i class="fa fa-window-minimize fa-right" aria-hidden="true"></i></h1>
                                </div>   
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="content-glosary Bebas-Neue-Bold">
                                        <ul class="menu list-inline">
                                            <?php 
                                            foreach ( $alphabet as $letter ) : 
                                                $class = ( $first_char == $letter )?'active':'';
                                            ?>
                                            <li><a href="<?= $currentUrl; ?>?letter=<?= $letter; ?>" class="<?= $class; ?>"><?= $letter?></a></li>
                                            <?php endforeach; ?>

                                        </ul>
                                        <div class="content-form">
                                            <form method="get" action="<?= $currentUrl; ?>">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="glossary_term">
                                                </div>
                                            </form>
                                        </div>
                                        <ul class="list-search">
                                            <?php 
                                            if ( $wp_query->have_posts() ) :
                                                while ( $wp_query->have_posts() ) :
                                                    $wp_query->the_post();
                                                    get_template_part( 'template-parts/glossary/_item' );
                                                endwhile;
                                            endif; 
                                            ?>

                                            <?php 
                                            if ( $postIDs ) :
                                                $args = array(
                                                    'post__in' => $postIDs,
                                                    'post_type' => 'glossary',
                                                    'post_status' => 'publish',
                                                    'posts_per_page' => -1,
                                                    'caller_get_posts'=> 1
                                                );

                                                $my_query = null;
                                                $my_query = new WP_Query($args);

                                                if( $my_query->have_posts() ) :

                                                    while ( $my_query->have_posts() ) :
                                                        $my_query->the_post();
                                                        get_template_part( 'template-parts/glossary/_item' );
                                                    endwhile;
                                                endif; 
                                            endif; 
                                            ?>
                                        </ul>
                                        <ul class="menu list-inline">
                                            <?php 
                                            reset( $alphabet );
                                            foreach ( $alphabet as $letter ) :
                                                $class = ( $first_char == $letter )?'active':'';
                                            ?>
                                            <li><a href="<?= $currentUrl; ?>?letter=<?= $letter; ?>" class="<?= $class; ?>"><?= $letter; ?></a></li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <div class="content-form">
                                            <form method="get" action="<?= $currentUrl; ?>">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="glossary_term">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section> 
<?php get_footer(); ?>