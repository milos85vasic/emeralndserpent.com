<?php
/**
 * Template part for displaying posts
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	
	<div class="blogger singlebox">
		<div class="post-image">
		    <?php 
		      if(has_post_thumbnail()) { 
		        the_post_thumbnail(); 
		      }
		    ?>
	 	</div>
		<div class="category">
		  <a href="<?php echo esc_url( get_permalink() ); ?>"><?php foreach((get_the_category()) as $category) { echo esc_html($category->cat_name) . ' '; } ?></a>
		</div>
		<div class="post-info">
			<i class="fa fa-calendar" aria-hidden="true"></i><span class="entry-date"> <?php echo esc_html(get_the_date()); ?></span>
		    <i class="fa fa-user" aria-hidden="true"></i><span class="entry-author"> <?php the_author(); ?></span>
		    <i class="fas fa-comments"></i><span class="entry-comments"><?php comments_number( __('0 Comments','katib-writers'), __('0 Comments','katib-writers'), __('% Comments','katib-writers') ); ?></span>
		</div>
		<h3><a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>"><?php the_title();?></a></h3>
		<div class="text">
	    	<?php the_content();?>
	  	</div>
	</div>
</article>