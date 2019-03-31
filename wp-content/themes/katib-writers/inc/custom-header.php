<?php
/**
 * Custom header implementation
 */

function katib_writers_custom_header_setup() {

	add_theme_support( 'custom-header', apply_filters( 'katib_writers_custom_header_args', array(

		'default-text-color'     => 'fff',
		'header-text' 			 =>	false,
		'width'                  => 1600,
		'height'                 => 400,
		'wp-head-callback'       => 'katib_writers_header_style',
	) ) );
}

add_action( 'after_setup_theme', 'katib_writers_custom_header_setup' );

if ( ! function_exists( 'katib_writers_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see katib_writers_custom_header_setup().
 */
add_action( 'wp_enqueue_scripts', 'katib_writers_header_style' );
function katib_writers_header_style() {
	//Check if user has defined any header image.
	if ( get_header_image() ) :
	$custom_css = "
        #masthead .main-header{
			background-image:url('".esc_url(get_header_image())."');
			background-position: center top;
		}";
	   	wp_add_inline_style( 'katib-writers-basic-style', $custom_css );
	endif;
}
endif; // katib_writers_header_style