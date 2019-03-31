<?php
/**
 * Template part for displaying posts
 */
?>

<div class="col-lg-4 col-md-4">
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="blogger">
			<div class="category">
			  <a href="<?php echo  the_permalink(); ?>"><?php foreach((get_the_category()) as $category) { echo esc_html($category->cat_name) . ' '; } ?></a>
			</div>
			<h3><a href="<?php echo  the_permalink();  ?>" title="<?php the_title_attribute(); ?>"><?php the_title();?></a></h3>
			<div class="date"><?php the_time( get_option( 'date_format' ) ); ?></div>
			<div class="post-image">
			    <?php 
			      if(has_post_thumbnail()) { 
			        the_post_thumbnail(); 
			      }
			    ?>
		 	</div>
		 	<div class="text">
		    	<?php the_excerpt();?>
		  	</div>
		  	<a class="post-link" href="<?php echo esc_url( get_permalink() ); ?>"><?php esc_html_e( 'Continue Reading....','katib-writers' ); ?></a>
		</div>
	</div>
</div>