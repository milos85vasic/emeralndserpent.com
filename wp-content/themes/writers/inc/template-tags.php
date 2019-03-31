<?php
/**
 * @package writers
 * Template tags functions
 */


/**
 * Fancy excerpts
 * 
 * @link: http://wptheming.com/2015/01/excerpt-versus-content-for-archives/
 */
function writers_fancy_excerpt() {
    global $post;
    if( is_archive() ) {
       the_excerpt();
        echo '<div class="continue-reading">';
        echo '<a class="more-link more-link-activated" href="' . esc_url( get_permalink() ) . '" title="' . esc_html__( 'Continue Reading ', 'writers' ) . get_the_title() . '" rel="bookmark">' . esc_html__( 'Continue Reading', 'writers' ) . '</a>'; 
        echo '</div>';
    } elseif ( is_page_template( 'page-templates/page-child-pages.php' ) ) {
        the_excerpt();
         echo '<div class="continue-reading">';
        echo '<a class="continue-reading-arrow" href="' . esc_url( get_permalink() ) . '" title="' . esc_html__( 'Continue Reading ', 'writers' ) . get_the_title() . '" rel="bookmark">&rarr;</a>'; 
        echo '</div>';
    } elseif ( has_excerpt() || is_page_template( 'page-templates/frontpage-portfolio.php' ) ) {
        the_excerpt();
        echo '<div class="continue-reading">';
        echo '<a class="more-link more-link-activated" href="' . esc_url( get_permalink() ) . '" title="' . esc_html__( 'Continue Reading ', 'writers' ) . get_the_title() . '" rel="bookmark">' . esc_html__( 'Continue Reading', 'writers' ) . '</a>'; 
        echo '</div>';
    } elseif ( strpos ( $post->post_content, '<!--more-->' ) ) {
        the_content();
                echo '<div class="continue-reading">';
        echo '<a class="more-link more-link-activated" href="' . esc_url( get_permalink() ) . '" title="' . esc_html__( 'Continue Reading ', 'writers' ) . get_the_title() . '" rel="bookmark">' . esc_html__( 'Continue Reading', 'writers' ) . '</a>'; 
        echo '</div>';
    } elseif ( str_word_count ( $post->post_content ) < 200 ) {
        the_excerpt();
    } else {
        the_excerpt();
        echo '<div class="continue-reading">';
        echo '<a class="more-link more-link-activated" href="' . esc_url( get_permalink() ) . '" title="' . esc_html__( 'Continue Reading ', 'writers' ) . get_the_title() . '" rel="bookmark">' . esc_html__( 'Continue Reading', 'writers' ) . '</a>'; 
        echo '</div>';
    }
}



function writers_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	delete_transient( 'writers_categories' );
}
add_action( 'edit_category', 'writers_category_transient_flusher' );
add_action( 'save_post',     'writers_category_transient_flusher' );


if ( ! function_exists( 'writers_entry_footer' ) ) :



	function writers_entry_footer() {

		if(is_single())
			echo '<hr>';

		if(!is_home() && !is_search() && !is_archive()){

			if ( 'post' == get_post_type() ) {
				$categories_list = get_the_category_list( esc_html__( ', ', 'writers' ) );
				echo '<div class="row">';
				if ( $categories_list && writers_categorized_blog() ) {
					printf( '<div class="col-md-6 cattegories"><span class="cat-links">
		 ' . '%1$s</span></div>', $categories_list ); // WPCS: XSS OK.
				}
				else{
					echo '<div class="col-md-6 cattegories"><span class="cat-links"></span></div>'; 
				}


				$tags_list = get_the_tag_list( '', esc_html__( ', ', 'writers' ) );
				if ( $tags_list ) {
					printf( '<div class="col-md-6 tags"><span class="tags-links">' . esc_html__( ' %1$s', 'writers' ) . '</span></div>', $tags_list ); // WPCS: XSS OK.
				}
				
				echo '</div>';
			}
		}

		edit_post_link( esc_html__( 'Edit This Post', 'writers' ), '<br><span>', '</span>' );
		
	}
	endif;



/**
 * Add an author box below posts
 * @link http://www.wpbeginner.com/wp-tutorials/how-to-add-an-author-info-box-in-wordpress-posts/
 */
function writers_author_box() {
    global $post;
    
    // Detect if a post author is set
    if ( isset( $post->post_author ) ) {
        
        /*
         * Get Author info
         */
        $display_name = get_the_author_meta( 'display_name', $post->post_author );                  // Get the author's display name  
            if ( empty ( $display_name ) ) $display_name = get_the_author_meta( 'nickname', $post->post_author ); // If display name is not available, use nickname
        $user_desc =    get_the_author_meta( 'user_description', $post->post_author );              // Get bio info
        $user_site =    get_the_author_meta( 'url', $post->post_author );                           // Website URL
        $user_posts =   get_author_posts_url( get_the_author_meta( 'ID', $post->post_author ) );    // Link to author archive page
        
        /*
         * Create the Author box
         */
        $author_details  = '<aside class="author_bio_section">';
        $author_details .= '<h3 class="author-title"><span>' . esc_html__( 'About ', 'writers' );
            if ( is_author() ) $author_details .= $display_name;        // If an author archive, just show the author name
            else $author_details .= esc_html__( 'the Author', 'writers' ); // If a regular page, show "About the Author"
        $author_details .= '</span></h3>';
        
        $author_details .= '<div class="author-box">';
        $author_details .= '<section class="author-avatar">' . get_avatar( get_the_author_meta( 'user_email' ), 120 ) . '</section>';
        $author_details .= '<section class="author-info">';
        
        if ( ! empty( $display_name ) && ! is_author() ) {          // Don't show this name on an author archive page
            $author_details .= '<h3 class="author-name">';
            $author_details .= '<a class="fn" href="' . esc_url( $user_posts ) . '">' . $display_name . '</a>';
            $author_details .= '</h3>';
        }
        if ( ! empty( $user_desc ) ) 
            $author_details .= '<p class="author-description">' . $user_desc . '</p>';
        
        if ( ! is_author() ) {  // Don't show the meta info on an author archive page
            $author_details .= '<p class="author-links entry-meta"><span class="vcard">' . esc_html__( 'All posts by', 'writers' ) . '<a class="fn" href="' . esc_url( $user_posts ) . '">' . $display_name . '</a></span>';

            // Check if author has a website in their profile
            if ( ! empty( $user_site ) ) 
                $author_details .= '<a class="author-site" href="' . esc_url( $user_site ) . '" target="_blank" rel="nofollow">' . esc_html__( 'Website', 'writers' ) . '</a></p>';
            else $author_details .= '</p>';
        }
        
        $author_details .= '</section>';
        $author_details .= '</div>';
        $author_details .= '<p class="show-hide-author label">' . esc_html__( 'Hide', 'writers' ) . '</p>';
        $author_details .= '</aside>';
        
        echo wp_kses_post( $author_details );

    }
    
}



	if ( ! function_exists( 'writers_posts_navigation' ) ) :
		function writers_posts_navigation() {
			if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
				return;
			}
			?>
			<nav class="navigation posts-navigation" role="navigation">
				<h2 class="screen-reader-text"><?php esc_html_e( 'Posts navigation', 'writers' ); ?></h2>
				<div class="nav-links">

					<div class="row">
						<?php if ( get_previous_posts_link() ) { ?>
						<div class="col-md-6 next-post">
							<?php previous_posts_link('<i class="fa fa-angle-double-left"></i>
							'. __( 'NEWER POSTS', 'writers' ) ); ?>
						</div>
						<?php } else {
							echo '<div class="col-md-6">';
							echo '</div>';
						} ?>			

						<?php if ( get_next_posts_link() ) { ?>	
						<div class="col-md-6 prev-post">		
							<?php next_posts_link( __( 'OLDER POSTS ', 'writers' ).'<i class="fa fa-angle-double-right"></i>' ); ?>
						</div>
						<?php }	else{
							echo '<div class="col-md-6">';
							echo '</div>';
						} ?>
					</div>		
				</div><!-- .nav-links -->
			</nav><!-- .navigation -->
			<?php
		}
		endif;



function writers_featured_image_disaplay(){
	if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) {  // check if the post has a Post Thumbnail assigned to it. 
		echo '<div class="featured-image">';
		the_post_thumbnail('writers-full-width');
		echo '</div>';
	} 
}

		if ( ! function_exists( 'writers_post_navigation' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function writers_post_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'writers' ); ?></h2>
		<div class="nav-links">
			<div class="row">
				<!-- Get Next Post -->
				<?php
				$prev_post = get_previous_post();
				if (!empty( $prev_post )){
					?>
					<div class="col-md-6 prev-post">
						<a class="" href="<?php echo esc_url(get_permalink( $prev_post->ID )); ?>"><span class="next-prev-text"><?php _e('PREVIOUS ','writers'); ?>
						</span><br><?php if(get_the_title( $prev_post->ID ) != ''){echo get_the_title( $prev_post->ID );} else { _e('Previous Post','writers'); }?></a>
					</div>
					<?php } 
					else { 
						echo '<div class="col-md-6">';
						echo '</div>';
					} ?>

					<?php
					$next_post = get_next_post();
					if ( is_a( $next_post , 'WP_Post' ) ) { 
						?>
						<div class="col-md-6 next-post">
							<a class="" href="<?php echo esc_url(get_permalink( $next_post->ID )); ?>"><span class="next-prev-text">
								<?php _e(' NEXT','writers'); ?></span><br><?php if(get_the_title( $next_post->ID ) != ''){echo get_the_title( $next_post->ID );} else {  _e('Next Post','writers'); }?></a>
							</div>
							<?php } 
							else { 
								echo '<div class="col-md-6">';
								echo '</div>';
							} ?>

							<!-- Get Previous Post -->


						</div>
					</div><!-- .nav-links -->
				</nav><!-- .navigation-->
				<?php
			}
			endif;

			if ( ! function_exists( 'writers_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function writers_posted_on() {

	$viewbyauthor_text = __( 'View all posts by', 'writers' ).' %s';

	$entry_meta = 'By <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>
	| <a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s </time></a><span class="byline"><span class="sep"></span>';

	$entry_meta = sprintf($entry_meta,
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( $viewbyauthor_text, get_the_author() ) ),
		esc_html( get_the_author() ));

	print $entry_meta;


}
endif;


if ( ! function_exists( 'writers_posted_on_no_link' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function writers_posted_on_no_link() {

	$viewbyauthor_text = __( 'View all posts by', 'writers' ).' %s';

	$entry_meta = '<time class="entry-date" datetime="%3$s" pubdate>%4$s </time>';

	$entry_meta = sprintf($entry_meta,
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_html( get_the_author() ));

	print $entry_meta;


}
endif;



/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function writers_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'writers_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
			) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'writers_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so writers_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so writers_categorized_blog should return false.
		return false;
	}
}
