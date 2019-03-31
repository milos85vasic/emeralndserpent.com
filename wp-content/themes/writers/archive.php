<?php
/**
 * The template for displaying archive pages.
 *
 * @package writers
 */

get_header(); ?>
<div class="container">
	<div class="row">
		

		<?php if ( have_posts() ) : ?>

			<header class="archive-page-header">
				<?php						
				the_archive_title( '<h3 class="archive-page-title">', '</h3>' );
				the_archive_description ( '<div class="taxonomy-description">', '</div>' )
				?>
			</header>

			<div id="primary" class="col-md-9 content-area">
				<main id="main" class="site-main" role="main">

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php

								get_template_part( 'template-parts/content','excerpt');

								?>

							<?php endwhile; ?>

							<?php writers_posts_navigation(); ?>

						<?php else : ?>

							<?php get_template_part( 'template-parts/content', 'none' ); ?>

						<?php endif; ?>

					</main><!-- #main -->
				</div><!-- #primary -->

				<?php get_sidebar('sidebar-1'); ?>			

			</div> <!--.row-->            
		</div><!--.container-->
		<?php get_footer(); ?>