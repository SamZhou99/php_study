<?php
function startbiz_css() {
	$parent_style = 'startkit-parent-style';
	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'startbiz-style', get_stylesheet_uri(), array( $parent_style ));
	
	wp_enqueue_style('startbiz-color-default',get_stylesheet_directory_uri() .'/css/colors/default.css');
	wp_dequeue_style('startkit-color-default');
	
	wp_enqueue_style('startbiz-responsive',get_stylesheet_directory_uri().'/css/responsive.css');
	wp_dequeue_style('startkit-responsive');

}
add_action( 'wp_enqueue_scripts', 'startbiz_css',999);
   	

function startbiz_setup()	{	
	add_editor_style( array( 'css/editor-style.css', startbiz_google_font() ) );
}
add_action( 'after_setup_theme', 'startbiz_setup' );
	
/**
 * Register Google fonts for StartBiz.
 */
function startbiz_google_font() {
	
   $get_fonts_url = '';
		
    $font_families = array();
 
	$font_families = array('Open Sans:300,400,600,700,800', 'Raleway:400,700');
 
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $get_fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

    return $get_fonts_url;
}

/**
 * Remove Customize Panel from parent theme
 */
function startbiz_remove_parent_setting( $wp_customize ) {
	$wp_customize->remove_control('breadcrumb_background_setting');
}
add_action( 'customize_register', 'startbiz_remove_parent_setting',99 );


function startbiz_scripts_styles() {
    wp_enqueue_style( 'startbiz-fonts', startbiz_google_font(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'startbiz_scripts_styles' );