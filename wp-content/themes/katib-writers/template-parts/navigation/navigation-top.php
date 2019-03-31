<?php
/**
 * Displays top navigation
 */
?>

<div class="header-menu">
	<div class="row m-0">
		<div class="col-lg-11 col-md-11">
			<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'katib-writers' ); ?>">
				<button class="menu-toggle" aria-controls="top-menu" aria-expanded="false">
					<?php
						esc_html_e( 'Menu', 'katib-writers' );
					?>
				</button>

				<?php wp_nav_menu( array(
					'theme_location' => 'top',
					'menu_id'        => 'top-menu',
				) ); ?>				
			</nav>
		</div>
		<div class="search-box col-lg-1 col-md-1">
	     	<span><i class="fas fa-search"></i></span>
		</div>
	</div>
	<div class="serach_outer">
	    <div class="closepop"><i class="far fa-window-close"></i></div>
	    <div class="serach_inner">
	      <?php get_search_form(); ?>
	    </div>
	</div>
</div>