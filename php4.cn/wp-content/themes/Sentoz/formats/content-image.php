<?php
/**
 * @package web2feel
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="formatbox">
		<div class="formicon">
			<?php if ( 'image' == get_post_format() ) : ?>
				<i class="icon-camera"></i>
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
	
			<?php
				$thumb = get_post_thumbnail_id();
				$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
				$image = aq_resize( $img_url, 700, 9999, false ); //resize & crop the image
			?>
			
			<?php if($image) : ?>
				<a href="<?php the_permalink(); ?>"><img class="postimg" src="<?php echo $image ?>"/></a>
			<?php endif; ?>

		<h3><?php the_title(); ?></h3>
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'web2feel' ) ); ?>

	</div><!-- .entry-content -->


	</article><!-- #post-## -->
