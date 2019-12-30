<?php
/**
 * @package web2feel
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="formatbox">
		<div class="formicon">
			<?php if ( 'quote' == get_post_format() ) : ?>
				<i class="icon-quote-right"></i>
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

	</header><!-- .entry-header -->

	<div class="entry-content">


		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'web2feel' ) ); ?>
		
		<span class="qlink"><a href=" <?php echo get_post_meta( get_the_ID(), '_format_quote_source_url', true ) ?>"> <?php echo get_post_meta( get_the_ID(), '_format_quote_source_name', true ) ?></a></span>
	</div><!-- .entry-content -->


	</article><!-- #post-## -->
