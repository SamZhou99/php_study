<?php
/**
 * The home page file.
 *
 * @package Omega
 */

function magazine_get_featured_posts() {
    $sticky = get_option( 'sticky_posts' );

    if ( empty( $sticky ) )
        return new WP_Query();

    $args = array(
        'post__in' => $sticky,
    );

    return new WP_Query( $args );
}

get_header(); ?>

	<main class="<?php echo apply_atomic( 'main_class', 'content' );?>" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">

		<?php 
		do_atomic( 'before_content' ); // omega_before_content 

		if(!is_paged()) :
			$featured_posts = magazine_get_featured_posts();
			if ( $featured_posts->have_posts() ) : 
				echo '<div id="carousel-example-generic" class="carousel slide entry">';
				$indicator ='<!-- Indicators -->
					  <ol class="carousel-indicators">';
				$slide = '<!-- Wrapper for slides -->
							  <div class="carousel-inner">';
				$counter = 0;
				while ( $featured_posts->have_posts() ) {
				    $featured_posts->the_post();

				    $indicator .='<li data-target="#carousel-example-generic" data-slide-to="'.$counter.'" class="'. ($counter == 0 ? 'active' : '') .'"></li>';
					$slide .='<div class="item '. ($counter == 0 ? 'active' : '') . '">
							      '. get_the_post_thumbnail( get_the_id(), 'sticky' ) .'
							      <div class="carousel-caption transparent">
							        <h4 class="notransparent"><a class="notransparent" href="'.get_permalink().'">'. get_the_title() .'</a></h4>
							      </div>
							    </div>';
				   
				    $counter++;
				}

				//echo $indicator.'</ol>';
				echo $slide.'</div>';
				echo '<!-- Controls -->
					  <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
					    <span class="icon-prev"></span>
					  </a>
					  <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
					    <span class="icon-next"></span>
					  </a>';
				echo '</div>';

			endif;

		wp_reset_postdata();
		endif;

		if ( have_posts() ) : 
			echo "<div class='mymasonry row'>";
			/* Start the Loop */ 
			while ( have_posts() ) : the_post(); 

				/* Include the Post-Format-specific template for the content.
				 * If you want to overload this in a child theme then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				//get_template_part( 'partials/content' );
			?>
				<article id="post-<?php the_ID(); ?>" class="col-xs-12 col-sm-6 grid" itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">	

					<div class="entry-wrap">
						
						<header class="entry-header">
							<h4 class="entry-title" itemprop="headline"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h4>

							<div class="entry-meta">
								<?php 
								if (is_multi_author()) {
									echo omega_apply_atomic_shortcode( 'entry_author', __( 'Posted by [post_author_posts_link] ', 'omega' ) ); 
								} else {
									echo omega_apply_atomic_shortcode( 'entry_author', __( 'Posted ', 'omega' ) ); 
								}?>
								<?php
								echo omega_apply_atomic_shortcode( 'entry_byline', __( 'on [post_date] [post_edit before=" | "]', 'omega' ) );								
								?>
							</div><!-- .entry-meta -->

						</header>
						<div class="entry-content">		

							<?php 
							if ( is_home() ) {
								get_the_image( array( 'meta_key' => 'Thumbnail', 'default_size' => 'Medium' )); 

								if ( omega_get_setting( 'content_archive_limit' ) )
									the_content_limit( (int) omega_get_setting( 'content_archive_limit' ), omega_get_setting( 'content_archive_more' ) );
								else
									the_excerpt();
								
							} 
							?>
							
						</div><!-- .entry-content -->

						<?php do_atomic( 'after_entry' ); // omega_after_entry ?>

					</div><!-- .entry-wrap -->
					
				</article><!-- #post-## -->
			<?php		
			endwhile; 

			echo "</div>";
			omega_content_nav( 'nav-below' ); 

		else :

			get_template_part( 'partials/no-results', 'index' );

		endif;
		
		do_atomic( 'after_content' ); // omega_after_content 
		?>

	</main><!-- .content -->

<?php get_footer(); ?>