
<?php
/**
 * Template part for displaying posts.
 *
 *  
 * @package writers
 */

?>
<article id="post-<?php the_ID(); ?>"  <?php post_class('post-content'); ?>>

	<div class="row row-eq-height post-feed-wrapper">
		<!-- Display fallback img-->
		<?php if ( get_theme_mod( 'toggle_fallback_img' ) == '' ) : ?>
			<div class="col-md-5 col-xs-12 post-thumbnail-wrap">
				<?php
				if ( is_sticky() && is_home() && ! is_paged() ) {
					printf( '<span class="sticky-post">%s</span>', __( 'Featured', 'writers' ) );
				} ?>
				<?php if ( has_post_thumbnail() ) : ?>
					<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );?>
					<a href="<?php the_permalink(); ?>" rel="bookmark">
						<div class="post-thumbnail" style="background-image: url('<?php echo $thumb['0'];?>')"></div>
					</a>
				<?php else : ?>
					<a href="<?php the_permalink(); ?>" rel="bookmark">
						<div class="post-thumbnail post-thumbnail-missing" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/quotation-marks.png')"></div>
					</a>
				<?php endif; ?>
			</div>
		<?php else : ?>
		<?php endif; ?>
		<!-- Display fallback img end -->
		<?php if ( get_theme_mod( 'toggle_fallback_img' ) == '' ) : ?>
			<div class="col-md-7 col-xs-12">
			<?php else : ?>
				<div class="col-md-12 col-xs-12">
				<?php endif; ?>

				<div class="blog-feed-contant">
					<header class="entry-header">	
						<span class="screen-reader-text"><?php the_title();?></span>

						<?php if ( is_single() ) : ?>
							<h1 class="entry-title"><?php the_title(); ?></h1>
						<?php else : ?>
							<h2 class="entry-title">
								<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
							</h2>
						<?php endif; // is_single() ?>

						<?php if ( 'post' == get_post_type() ) : ?>
							<div class="entry-meta">
								<h5 class="entry-date"><?php writers_posted_on(); ?>
									<?php if ( get_theme_mod( 'toggle_fallback_img' ) == '' ) : ?>
									<?php else : ?>
										<?php
										if ( is_sticky() && is_home() && ! is_paged() ) {
											printf( '%s', __( '| Featured', 'writers' ) );
										} ?>
									<?php endif; ?>

								</h5>
							</div><!-- .entry-meta -->
						<?php endif; ?>
					</header><!-- .entry-header -->

					<div class="entry-summary">

						<?php the_excerpt(); ?>
					</div><!-- .entry-summary -->		   	
				</div>
			</div>
		</div>


	</article><!-- #post-## -->
