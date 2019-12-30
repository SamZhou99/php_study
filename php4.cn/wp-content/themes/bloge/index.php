<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bloge
 */
get_header();

global $bloge_theme_options;

$designlayout = $bloge_theme_options['bloge-layout'];

$side_col = 'right-s-bar ';


if( 'left-sidebar' == $designlayout ){

	$side_col = 'left-s-bar';
}
?>
	<div id="primary" class="content-area col-sm-8 col-md-8 col-xs-12 <?php echo esc_attr( $side_col) ;?>">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php
			endif;

			/* Start the Loop */


			while ( have_posts() ) : the_post();
				/*

				 * Include the Post-Format-specific template for the content.

				 * If you want to override this in a child theme, then include a file

				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.

				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

			do_action('bloge_action_navigation');

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>
<!-- </div> -->
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_sidebar();
get_footer();

