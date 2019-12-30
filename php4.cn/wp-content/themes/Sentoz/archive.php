<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package web2feel
 */

get_header(); ?>

	<section id="primary" class="content-area grid_12">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

		
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to overload this in a child theme then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'formats/content', get_post_format() );
				?>

			<?php endwhile; ?>

			<div class="paginate"> <?php kriesi_pagination(); ?> </div>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'archive' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->


<?php get_footer(); ?>
