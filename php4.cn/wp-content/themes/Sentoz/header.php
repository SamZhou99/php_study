<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package web2feel
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	
	<header id="masthead" class="site-header" role="banner">
		<div class="container_12">
			<div class="site-branding grid_6">
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			
		</div>
			
		<div class="grid_6">
				<?php get_search_form() ?>
			</div>
		</div>
		
	</header><!-- #masthead -->
	
	<div id="sitenavi">
		<div class="container_12">
			<nav id="site-navigation" class="main-navigation grid_12" role="navigation">
					<h1 class="menu-toggle"><?php _e( 'Menu', 'web2feel' ); ?></h1>
					<div class="screen-reader-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'web2feel' ); ?>"><?php _e( 'Skip to content', 'web2feel' ); ?></a></div>
		
					<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			</nav><!-- #site-navigation -->
		</div>
	</div>
	
	<div id="content" class="site-content container_12">
