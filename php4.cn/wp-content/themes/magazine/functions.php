<?php
/**
 * Omega functions and definitions
 *
 * @package Omega
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */

require_once('inc/bootwalker.php');
require_once('inc/wp_bootstrap_navwalker_1.4.4.php');

add_action( 'after_setup_theme', 'magazine_theme_setup', 11  );

function magazine_theme_setup() {

	add_action('init', 'magazine_init', 1);

	/* Load the primary menu. */
	remove_action( 'omega_before_header', 'omega_get_primary_menu' );
	add_action( 'omega_before', 'omega_get_primary_menu' );

	add_action('omega_after_header', 'magazine_get_secondary_menu' );

	add_action ('omega_header', 'magazine_header_right');

	add_filter('omega_sidebar_class', 'magazine_sidebar_class');
	add_filter('omega_main_class', 'magazine_main_class');
	add_filter('omega_title_area_class', 'magazine_title_area_class');

	add_image_size( 'sticky', '980', '400', true );

	/* Register custom menus. */
	add_action( 'init', 'magazine_register_menu' );
}

function magazine_register_menu() {
	register_nav_menu( 'secondary',   _x( 'Secondary', 'nav menu location', 'magazine' ) );
}

function magazine_get_secondary_menu() {
	get_template_part( 'partials/menu', 'secondary' );
}

function magazine_header_right() {
	get_template_part( 'partials/header', 'right' );
}

function magazine_title_area_class($default) {
	return $default . ' col-xs-12 col-md-4';
}

function magazine_sidebar_class() {
	return 'sidebar col-xs-12 col-sm-4';
}

function magazine_main_class() {
	$layout = get_theme_mod( 'theme_layout' );

	if ("1c" == $layout) 
		return 'col-xs-12 col-sm-12';
	else
		return 'col-xs-12 col-sm-8';
}

add_filter('omega_wrap_open', 'magazine_container_open');
add_filter('omega_wrap_close', 'magazine_container_close');

function magazine_wrap_class() {
	return 'container';
}

function magazine_container_open() {
  echo '<div class="container"><div class="row">';
}

function magazine_container_close() {
  echo '</div><!-- .row --></div><!-- .container -->';
}

function magazine_init(){
	if(!is_admin()){
		wp_enqueue_style("magazine-bootstrap", get_stylesheet_directory_uri() . '/css/bootstrap.css');
		wp_enqueue_script("magazine-bootstrap", get_stylesheet_directory_uri() . '/js/bootstrap.js', array('jquery'));

		if(is_home()) {
			
		}
		wp_enqueue_script("masonry", get_stylesheet_directory_uri() . '/js/jquery.masonry.min.js', array('jquery'));
	} 
}



/**
 * Register widgetized area and update sidebar with default widgets
 */
function magazine_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Header Right', 'magazine' ),
		'id'            => 'header-right',
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget'  => '</div></section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'magazine_widgets_init', 12 );

function magazine_exclude_sticky( $query ) {	
    if ( $query->is_home() && $query->is_main_query() ) {
    	$sticky = get_option( 'sticky_posts' );
        $query->set( 'post__not_in', $sticky );
        $query->set( 'ignore_sticky_posts', true );
    }
}

add_action( 'pre_get_posts', 'magazine_exclude_sticky' );