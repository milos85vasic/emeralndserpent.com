<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
	</a>
	<?php endif; // End header image check. ?>
 *
 * @package writers
 */


	function writers_custom_header_setup() {
		add_theme_support( 'custom-header', apply_filters( 'writers_custom_header_args', array(
			'default-image'          => '%s/images/headers/writer-header-image.png',
			'default-text-color'     => 'fff',
			'width'                  => 1800,
			'height'                 => 848,
			'flex-height'            => true,
			'header-text'            => false,
			'flex-width'	         => true,
			'wp-head-callback'       => 'writers_header_style',
			) ) );
		register_default_headers( array(
			'mountains' => array(
				'url'           => '%s/images/headers/writer-header-image.png',
				'thumbnail_url' => '%s/images/headers/writer-header-image_thumbnail.png',
				'description'   => _x( 'food', 'header image description', 'writers' )
				),		
			) );
	}
	add_action( 'after_setup_theme', 'writers_custom_header_setup' );


	if ( ! function_exists( 'writers_header_small' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see headstart_custom_header_setup().
 */
function writers_header_small() {
	$header_text_color = get_header_textcolor();
	if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
		return;
	}
	?>
	<style type="text/css">
	<?php
	if ( 'blank' == $header_text_color ) :
		?>
	.site-title,
	.site-description {
		position: absolute;
		clip: rect(1px, 1px, 1px, 1px);
	}
	<?php
	else :
		?>
	.site-title a,
	.site-description {
		color: #<?php echo esc_attr( $header_text_color ); ?>;
	}
	<?php endif; ?>
	</style>
	<?php
}
endif; // writers_header_small



if ( ! function_exists( 'writers_header_style' ) ) :
	function writers_header_style() {
		$header_image = get_header_image();
		$header_text_color   = get_header_textcolor();
		if ( empty( $header_image ) && $header_text_color == get_theme_support( 'custom-header', 'default-text-color' ) ){
			return;
		}
		?>
		<style type="text/css" id="writers-header-css">
		<?php
		if ( ! empty( $header_image ) ) :
			$header_width = get_custom_header()->width;
		$header_height = get_custom_header()->height;
		$header_height1 = ($header_height / $header_width * 1600);
		?>
		.site-header {
			background: url(<?php header_image(); ?>) no-repeat scroll top;
			<?php if($header_height1 > 200){ ?>
				background-size: cover;
				background-position:bottom;
				<?php }else{ ?>
					background-size: cover;
					<?php } ?>
				}
				<?php endif; 
				if ( ! display_header_text() ) :
					?>
				<?php
				endif;
				if ( empty( $header_image ) ) :
					?>
				<?php
				else:		
					?>
				.site-title,
				.site-description {
					color: #<?php echo esc_attr( $header_text_color ); ?>;
				}
				.site-title::after{
					background: #<?php echo esc_attr( $header_text_color ); ?>;
					content:"";       
				}
				<?php endif; ?>

				</style>
				<?php
			}
			endif;




