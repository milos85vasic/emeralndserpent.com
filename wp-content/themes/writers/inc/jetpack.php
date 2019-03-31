<?php
/**
 * Jetpack Compatibility File
 * See: https://jetpack.me/
 *
 *  
 * @package writers
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function writers_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'writers_infinite_scroll_render',
		'footer'    => 'page',
	) );
} // end function writers_jetpack_setup
add_action( 'after_setup_theme', 'writers_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function writers_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', get_post_format() );
	}
} // end function writers_infinite_scroll_render
