<?php
define("THEME_URL", get_stylesheet_directory_uri());

/**
 * Enqueue scripts and styles
 */
function xy_post_scripts() {

		/* CSS */
    // wp_enqueue_style( 'owl.carousel', THEME_URL . '/libraries/owl-carousel/owl.carousel.css' );
    // wp_enqueue_style( 'owl.theme', THEME_URL . '/libraries/owl-carousel/owl.theme.css' );
    wp_enqueue_style( 'font-awesome', THEME_URL . '/css/font-awesome.min.css' );
    wp_enqueue_style( 'bootstrap', THEME_URL . '/libraries/bootstrap-3.3.7-dist/css/bootstrap.min.css' );
	wp_enqueue_style( 'xypost.reset', THEME_URL . '/css/reset.css' );
    wp_enqueue_style( 'xypost.style', THEME_URL . '/css/style.css' );
		
		/* End CSS */

		/* Scripts */

    wp_enqueue_script("jquery");

    wp_enqueue_script( 'kxn-alm-previous-post', THEME_URL . '/js/kxn-alm-previous-post.js', array('jquery'), '1.0', false );

    wp_enqueue_script( 'xypost.main', THEME_URL . '/js/main.js', array('jquery'), '1.0', false );

    wp_enqueue_script( 'bootstrap-js', THEME_URL . '/libraries/bootstrap-3.3.7-dist/js/bootstrap.min.js', array('jquery'), '3.3.7', true );
       

    wp_enqueue_script( 'jquery.cycle', THEME_URL . '/libraries/cycle/jquery.cycle2.min.js', array('jquery'), '1.3.3', true );
    
    wp_localize_script( 'xypost.main', 'xyGlobal', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' )
        ));

		/* Scripts */

}
add_action( 'wp_enqueue_scripts', 'xy_post_scripts' );

function xy_post_theme_setup() {
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'home_featured', 1080, 274, true );
    add_image_size( 'category_featured', 974, 381, true );
    add_image_size( 'post_featured', 724, 400, true );
    add_image_size( 'video_medum', 489, 361, true );
    add_image_size( 'xplainer_post_thumb', 310, 240, true );
    add_image_size( 'related_thumb', 300, 262, true );
    add_image_size( 'vertical_207x413', 207, 413, true );
    add_image_size( 'horizontal_253x98', 253, 98, true );
    add_image_size( 'author_thumb', 296, 150, true );
    add_image_size( 'xplainer_thumb', 290, 180, true );
    add_image_size( 'vertical_221x436', 221, 436, true );

}
add_action( 'after_setup_theme', 'xy_post_theme_setup' );

// Register Menu
function xy_post_register_menu() {
  register_nav_menu( 'xy_post_menu', 'Main Menu' );
  register_nav_menu( 'xy_post_mobile_menu', 'Main Mobile Menu' );
  register_nav_menu( 'xy_post_footer_menu', 'Footer Menu' );
  register_nav_menu( 'xy_post_footer_menu_mobile', 'Footer Moblie Menu' );
}
add_action( 'init', 'xy_post_register_menu' );

function xy_alm_prev_post(){
    return true;
}
add_action( 'alm_prev_post_installed', 'xy_alm_prev_post', 10);



function xy_alm_prev_post_shortcode($previous_post_id, $previous_post_taxonomy, $options){
    /*global $post;
    
    if ( !empty($previous_post_id) && $previous_post_id != 'null' ){
        $post = get_post($previous_post_id);
    }else{
        $previous_post_id = $post->ID;
    }*/



    $ajaxloadmore = ' data-previous-post="true"';
    $ajaxloadmore .= ' data-previous-post-id="'.$previous_post_id.'"';
    $ajaxloadmore .= ' data-previous-post-taxonomy=""';
    $ajaxloadmore .= ' data-previous-post-title-template="{post-title}-{site-title}"';
    $ajaxloadmore .= ' data-previous-post-site-title="'.$post->post_title.'"';
    $ajaxloadmore .= ' data-previous-post-scroll="true"';
    $ajaxloadmore .= ' data-previous-post-scroll-speed="500"';
    $ajaxloadmore .= ' data-previous-post-scrolltop="0"';
    $ajaxloadmore .= ' data-previous-post-pageview="false"';

    wp_reset_postdata();
    return $ajaxloadmore;
}
add_action( 'alm_prev_post_shortcode', 'xy_alm_prev_post_shortcode', 10, 3);

function xy_alm_query_previous_post() {
    global $ajax_load_more;
    if ( isset($ajax_load_more) ){
        $ajax_load_more->alm_query_posts();
    }
    
}

add_action('wp_ajax_alm_query_previous_post', 'xy_alm_query_previous_post');
add_action('wp_ajax_nopriv_alm_query_previous_post', 'xy_alm_query_previous_post');

/**
 * Register our sidebars and widgetized areas.
 *
 */
function xy_register_sidebars() {

    register_sidebar( array(
        'name'          => 'Single Sidebar',
        'id'            => 'xy_single_sidebar',
        'before_widget' => '<div>',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="cat_name">',
        'after_title'   => '</h3>',
    ) );

}
add_action( 'widgets_init', 'xy_register_sidebars' );

function xy_init_post_types() {
    
    $authorLabels = array(
        'name' => 'Autores',
        'singular_name' => 'Autor',
        'add_new' => 'Agregar nuevo',
        'add_new_item' => 'Agregar nuevo',
        'edit_item' => 'Editar',
        'new_item' => 'Nuevo',
        'view_item' => 'Ver',
        'search_items' => 'Buscar',
        'not_found' =>  'No se han encontrado autores',
        'not_found_in_trash' => 'No se han encontrado autores',
        'parent_item_colon' => ''
    );
 
    $authorArgs = array( 'labels' => $authorLabels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => null,
        'menu_icon' => 'dashicons-businessman',
        'supports' => array('thumbnail', 'title', 'editor')
    );
    register_post_type( 'author', $authorArgs );

}
add_action( 'init', 'xy_init_post_types' );

function xy_ajax_search() {
 
    $args = array(
        'post_type' => array( 'post'),
        'post_status' => 'publish',
        'order' => 'DESC',
        'orderby' => 'date',
        's' => $_POST['term'],
        'posts_per_page' => 5
    );
     
    $query = new WP_Query( $args );
     
    // display results
    include 'template-parts/search/search-results.php';

    die();
}

add_action('wp_ajax_xy_ajax_search', 'xy_ajax_search');
add_action('wp_ajax_nopriv_xy_ajax_search', 'xy_ajax_search');

/**
 * Gets a nicely formatted string for the published date.
 */
function kxn_the_time() {
    global $post;

    $time_string = '<li>%1$s</li><li>%2$s </li>';

    $time_string = sprintf( $time_string,
        get_the_date('d/m/Y'),
        get_the_date('H:i')
    );

    // Wrap the time string in a link, and preface it with 'Posted on'.
    return $time_string;
}

function kxn_the_time_diff(){
    global $post;
    printf( _x( '%s ago', '%s = human-readable time difference', 'your-text-domain' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) );
}


function kxn_get_acf_image($imageObject, $size = '', $class=''){
    if ( $imageObject && is_array($imageObject) ){

        if (!empty($size)){

            // vars
            $url = $imageObject['url'];
            $alt = $imageObject['alt'];

            // thumbnail
            $thumb = $imageObject['sizes'][ $size ];
            $width = $imageObject['sizes'][ $size . '-width' ];
            $height = $imageObject['sizes'][ $size . '-height' ];

            $class = (!empty($class))?"class='".$class."'":'';

            $imageTag = '<img src="'.$thumb.'" alt="'.$alt.'" width="'.$width.'" height="'.$height.'" '.$class.' />';

            return $imageTag;
        }
    }
    return '';
}

function kxn_get_acf_image_src($imageObject, $size = ''){
    if ($imageObject){
        if (!empty($size)){
            // vars
            $url = $imageObject['url'];

            // img src
            $imgSrc = $imageObject['sizes'][ $size ];

            return $imgSrc;
        }
    }
    return '';
}

function more_posts() {
  global $wp_query;
  return $wp_query->current_post + 1 < $wp_query->post_count;
}

function excerpt($limit) {
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
    } else {
        $excerpt = implode(" ",$excerpt);
    } 
    $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
    return $excerpt;
}

function kxn_round_up_to($n,$x=5) {
    return round(($n+$x/2)/$x)*$x;
}

function kxn_posts_where( $where, &$wp_query )
{
    global $wpdb;
    if ( $kxn_title_like = $wp_query->get( 'kxn_title_like' ) ) {
        $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'' . esc_sql( $wpdb->esc_like( $kxn_title_like ) ) . '%\'';
    }
    
    return $where;
}
add_filter( 'posts_where', 'kxn_posts_where', 10, 2 );

/**
 * Generates an a tag with the name of the first category of
 * a given post, and a link to category's page.
 *
 * @param $post_id
 * @return string
 */
function kxn_get_first_category_link( $post_id ) {
    $category       = get_the_category( $post_id );

    if( !$category ) return '';

    $category_link  = get_category_link( $category[0]->term_id );
    $category_name  = $category[0]->cat_name;
    $link_tag       = '<a href="%s" class="cat-title" title="%s">%s</a>';
    $link_tag       = sprintf( $link_tag, $category_link, $category_name, $category_name );

    return $link_tag;
}

// function kxn_posttype_slug_template( $single_template ){
//     if( is_singular() && in_category( 'x-plainers' ) ){
//         $single_template = locate_template( 'my-custom-template.php' );
//     }
//     return $single_template;
// }
// add_filter( 'single_template', 'add_posttype_slug_template' );


if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page();
    
    acf_add_options_sub_page('General');
    
}

// Advanced Custom Fields Config
// include_once "acf-config.php";

//Debug custom function
if ( ! function_exists( '__pr' ) ) {
function __pr($var) {
    echo "<pre>";
    print_r($var);
    echo "</pre>";
}
}

require get_parent_theme_file_path( '/inc/kxn-sync.php' );