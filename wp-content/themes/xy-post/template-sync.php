<?php
/*
Template Name: Sync
*/
get_header();

$currentPostId = ( isset($_GET['id']) ) ? $_GET['id'] : 0 ;

if ( !$currentPostId ) {
    $latestPost = get_posts( array(
        'numberposts' => 1
    ) );

    if ( !empty( $latestPost ) ) {

        $currentPostId = $latestPost[0]->ID;
    }
}
    

if ( $currentPostId ) :

?>

<div id="status-log" data-last-post="<?= $currentPostId; ?>">
    
</div>

<?php endif; ?>
                
<?php get_footer(); ?>