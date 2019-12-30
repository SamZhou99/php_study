<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package web2feel
 */
?>

	</div><!-- #content -->
	
	<div id="bottom">
	<div class="container_12 clearfix">
		<ul>
		<?php if ( !function_exists('dynamic_sidebar')
		        || !dynamic_sidebar("Footer") ) : ?>  
		<?php endif; ?>
		</ul>
		<?php get_template_part( 'sponsors' ); ?>
	</div>
	</div>	
	
	
	<footer id="colophon" class="site-footer" role="contentinfo"> 
		<div class="container_12">
		<div class="site-info wrap grid_8">
			<div class="fcred">
				Copyright &copy; <?php echo date('Y');?> <a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a> - <?php bloginfo('description'); ?>.<br />
				<?php fflink(); ?> | <a href="http://topwpthemes.com/<?php echo wp_get_theme(); ?>/" ><?php echo wp_get_theme(); ?> Theme</a> 	
			</div>		

		</div><!-- .site-info -->
		
		<div class="social grid_4">
			<ul>
				<li> <a href="<?php echo of_get_option('w2f_facebook','facebook');?>"> <img src="<?php bloginfo('template_directory'); ?>/images/facebook.png" alt="facebook" /> </a> </li>
				
				<li> <a href="https://twitter.com/<?php echo of_get_option('w2f_twitter','twitter');?>"> <img src="<?php bloginfo('template_directory'); ?>/images/twitter.png" alt="twitter" /> </a> </li>
				
				<li> <a href="<?php echo of_get_option('w2f_linkedin','linkedin');?>"> <img src="<?php bloginfo('template_directory'); ?>/images/linkedin.png" alt="linkedin" /> </a> </li>
				<li> <a href="<?php bloginfo('rss2_url'); ?>"> <img src="<?php bloginfo('template_directory'); ?>/images/rss.png" alt="rss" /> </a> </li>
			</ul>
		</div>
		</div>
	</footer><!-- #colophon .site-footer -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>