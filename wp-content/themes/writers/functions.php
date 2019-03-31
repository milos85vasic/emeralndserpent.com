<?php
/**
 * @package writers
 */


add_action( 'admin_menu', 'writers_update_info' );
function writers_update_info() {
	add_theme_page( __('Writers Theme', 'writers'), __('Writers Theme', 'writers'), 'edit_theme_options', 'writers-theme-page.php', 'writers_page_img');
}

function writers_page_img(){ ?>
<style>
.writers-update-link img{
    display: inline-block;
    margin: auto;
    text-align: center;
    box-shadow: 0px 0px 30px #b3b3b3;
    margin-top:20px;
}
.writers-center-img {
	width:100%;
	text-align:center;
}
</style>
<div class="writers-center-img">
<a class="writers-update-link" href="https://creativemarket.com/Writersthemes/2184320-Writers-Premium" target="_blank">
<img src="http://madeforwriters.com/demo/writers/updt.png" alt="Update">
</a>
</div>
<?php }



if ( ! function_exists( 'writers_setup' ) ) :


function writers_setup() {

	load_theme_textdomain( 'writers', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 604, 270);
	add_image_size( 'writers-full-width', 1038, 576, true );
    register_nav_menus( array(
            'primary' => esc_html__( 'Top Primary Menu', 'writers' ),
    ) );
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		) );
}


endif;
add_action( 'after_setup_theme', 'writers_setup' );


function writers_modify_archive_title( $title ) {
    if( is_page_template( 'archive-jetpack-portfolio.php' ) || is_page_template( 'archive-jetpack-testimonial.php' ) ) {
        return esc_html__( 'All ', 'writers' ) . $title;
    } else {
        return $title;
    }
}



function writers_google_fonts() {
	$query_args = array(

		'family' => 'Lato:400,400italic,600,600italic,700,700i,900'
		);
    wp_enqueue_style( 'writers-googlefonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), array(), null );
}

add_action('wp_enqueue_scripts', 'writers_google_fonts');


function writers_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'writers_content_width', 640 );
}
add_action( 'after_setup_theme', 'writers_content_width', 0 );


function writers_logo() {
	add_theme_support('custom-logo', array(
		'size' => 'writers-logo',
		'width'                  => 250,
		'height'                 => 50,
		'flex-height'            => true,
		));
}

add_action('after_setup_theme', 'writers_logo');

function writers_footer_widget_left_init() {

	register_sidebar( array(
		'name' => esc_html__('Footer Widget left', 'writers'),
		'id' => 'footer_widget_left',
		'description'   => esc_html__( 'Widgets here will appear in your footer', 'writers' ),
		'before_widget' => '<div class="footer-widgets">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		) );
}
add_action( 'widgets_init', 'writers_footer_widget_left_init' );

function writers_footer_widget_middle_init() {

	register_sidebar( array(
		'name' => esc_html__('Footer Widget middle', 'writers'),
		'id' => 'footer_widget_middle',
		'description'   => esc_html__( 'Widgets here will appear in your footer', 'writers' ),
		'before_widget' => '<div class="footer-widgets">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		) );
}
add_action( 'widgets_init', 'writers_footer_widget_middle_init' );

function writers_footer_widget_right_init() {

	register_sidebar( array(
		'name' => esc_html__('Footer Widget right', 'writers'),
		'id' => 'footer_widget_right',
		'before_widget' => '<div class="footer-widgets">',
		'description'   => esc_html__( 'Widgets here will appear in your footer', 'writers' ),
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		) );
}
add_action( 'widgets_init', 'writers_footer_widget_right_init' );

function writers_bottom_widget_left_init() {

	register_sidebar( array(
		'name' => esc_html__('Bottom Widget left', 'writers'),
		'id' => 'bottom_widget_left',
		'before_widget' => '<div class="bottom-widgets">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'description'   => esc_html__( 'Widgets here will appear above the footer', 'writers' ),
		'after_title' => '</h3>',
		) );
}
add_action( 'widgets_init', 'writers_bottom_widget_left_init' );


function writers_bottom_widget_middle_init() {

	register_sidebar( array(
		'name' => esc_html__('Bottom Widget middle', 'writers'),
		'id' => 'bottom_widget_middle',
		'before_widget' => '<div class="bottom-widgets">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'description'   => esc_html__( 'Widgets here will appear above the footer', 'writers' ),
		'after_title' => '</h3>',
		) );
}
add_action( 'widgets_init', 'writers_bottom_widget_middle_init' );

function writers_bottom_widget_right_init() {

	register_sidebar( array(
		'name' => esc_html__('Bottom Widget right', 'writers'),
		'id' => 'bottom_widget_right',
		'before_widget' => '<div class="bottom-widgets">',
		'after_widget' => '</div>',
		'description'   => esc_html__( 'Widgets here will appear above the footer', 'writers' ),
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		) );
}
add_action( 'widgets_init', 'writers_bottom_widget_right_init' );

function writers_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'writers' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Widgets here will appear in your sidebar', 'writers' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="sidebar-headline-wrapper"><div class="widget-title-lines"></div><h4 class="widget-title">',
		'after_title'   => '</h4></div>',
		) );
}
add_action( 'widgets_init', 'writers_widgets_init' );


function writers_scripts ( $in_footer ) {
	wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/css/bootstrap.css',true );  
	wp_enqueue_style( 'writers-style', get_stylesheet_uri() );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/font-awesome/css/font-awesome.min.css',true );   
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.js',array('jquery'),'',true);  
	wp_enqueue_script( 'writers-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array('jquery'), '20130115', true );
	wp_enqueue_script( 'html5shiv', get_template_directory_uri().'/js/html5shiv.js', array(),'3.7.3',false );
	wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'writers_scripts' );

function writers_new_excerpt_more( $more ) {
	if ( is_admin() ) {
		return $more;
	}

		$link = sprintf( '<p class="read-more"><a class="readmore-btn" href="'. esc_url(get_permalink( get_the_ID() )) . '' . '">' . __('+', 'writers') . '<span class="screen-reader-text"> '. __(' Read More', 'writers').'</span></a></p>',
		esc_url( get_permalink( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;

}
add_filter( 'excerpt_more', 'writers_new_excerpt_more' );


require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/extras.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/jetpack.php';
if(!class_exists('wp_bootstrap_navwalker')){
require get_template_directory() . '/inc/navwalker.php';
}
