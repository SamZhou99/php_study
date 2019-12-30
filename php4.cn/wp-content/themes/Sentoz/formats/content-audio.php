<?php
/**
 * @package web2feel
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="formatbox">
		<div class="formicon">
			<?php if ( 'audio' == get_post_format() ) : ?>
				<i class="icon-headphones"></i>
			<?php endif; ?>
		</div>
		<div class="combox">
			<i class="icon-comment"></i>
			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			<span><?php comments_popup_link( __( '0', 'web2feel' ), __( '1', 'web2feel' ), __( '%', 'web2feel' ) ); ?></span>
		<?php endif; ?>
		</div>
	</div>
	
	
	<header class="entry-header">
		<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
			<div class="entry-meta">
				<span class="author-meta ">	 POSTED BY <?php the_author_posts_link(); ?>	</span>
				<span class="clock-meta">	 POSTED ON <?php the_time('F j, Y'); ?></span>
				<span class="category-meta"> POSTED UNDER	<?php the_category(', '); ?></span>
			</div><!-- .entry-meta -->
			</div><!-- .entry-meta -->
		<?php endif; ?>
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'web2feel' ) ); ?>

	</div><!-- .entry-content -->


	</article><!-- #post-## -->
