<?php
/**
 * Secondary Menu Template
 */
?>	
<div class="container">
	<nav class="navbar navbar-default nav-secondary" role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
	
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".menu-secondary">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Menu</a>
    </div>

	<!-- Collect the nav links, forms, and other content for toggling -->
	<?php 
	wp_nav_menu( array(
          'menu'              => 'secondary',
          'theme_location'    => 'secondary',
          'depth'             => 2,
          'container'         => 'div',
          'container_class'   => 'collapse navbar-collapse menu-secondary',
          'menu_class'        => 'nav navbar-nav',
          'fallback_cb'       => 'bootwalker::fallback',
          'walker'            => new bootwalker())
      );
  	?>
  
	</nav><!-- .nav-secondary -->
</div><!-- /.container -->
