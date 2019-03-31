<?php

/**
 * In this section all customizer relevant functions are collected
 */

function writers_customize_control_js() {
	wp_enqueue_script( 'writers-color-scheme-control', get_template_directory_uri() . '/js/color-scheme-control.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), '20141216', true );
}
add_action( 'customize_controls_enqueue_scripts', 'writers_customize_control_js' );


function writers_customize_preview_js() {
	wp_enqueue_script( 'writers_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'writers_customize_preview_js' );


function writers_customize_register( $wp_customize ) {



    $wp_customize->add_section(
        'writers_customizer_update',
        array(
            'title' => __('Access All Features', 'writers'),
            'priority' => 0,
            'description' => __(' <a href="https://creativemarket.com/Writersthemes/2184320-Writers-Premium" target="_blank"><img src="http://madeforwriters.com/demo/writers/updt.png"></a>', 'writers'),
            )
        );  
    $wp_customize->add_setting('writers_customizer_update_image', array(
        'sanitize_callback' => 'writers-sanitize',
        'type' => 'info_control',
        'capability' => 'edit_theme_options',
        )
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'writers_img_update', array(
        'section' => 'writers_customizer_update',
        'settings' => 'writers_customizer_update_image',
        'type' => 'writers-info',
        'priority' => 0
        ) )
    );  
	$wp_customize->add_setting( 'header_bg_color', array(
		'default'           => '#1b1b1b',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_bg_color', array(
		'label'       => __( 'Header Background Color', 'writers' ),
		'description' => __( 'Applied to header background.', 'writers' ),
		'section'     => 'header_image',
		'settings'    => 'header_bg_color',
		) ) );
	$wp_customize->add_section( 'site_identity' , array(
		'priority'   => 3,
		));
	$wp_customize->add_section( 'header_image' , array(
		'title'      => __('Front Page: Header', 'writers'),
		'priority'   => 4,
		));
	$wp_customize->add_setting( 'header_image_text_color', array(
		'default'           => '#1c1c1c',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_image_text_color', array(
		'label'       => __( 'Header Image Headline Color', 'writers' ),
		'description' => __( 'Choose a color for the header image headline.', 'writers' ),
		'priority' 			=> 2,
		'section'     => 'header_image',
		'settings'    => 'header_image_text_color',
		) ) );
	$wp_customize->add_setting( 'header_image_tagline_color', array(
		'default'           => '#7b7b7b',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_image_tagline_color', array(
		'label'       => __( 'Header Image Tagline Color', 'writers' ),
		'description' => __( 'Choose a color for the header tagline headline.', 'writers' ),
		'section'     => 'header_image',
		'priority'   => 2,
		'settings'    => 'header_image_tagline_color',
		) ) );
	$wp_customize->add_setting( 'hero_image_title', array(
		'type'              => 'theme_mod',
		'sanitize_callback' => 'wp_kses_post',
		'capability'        => 'edit_theme_options',
		'default'  => __( '', 'writers' ),
		) );
	$wp_customize->add_control( 'hero_image_title', array(
		'label'    => __( "Header Image Title", 'writers' ),
		'section'  => 'header_image',
		'description' => __( 'Add a title to your header image! If you dont want any, you can press SPACE inside, leaving it blank.', 'writers' ),
		'type'     => 'text',
		'priority' => 1,
		) );
	$wp_customize->add_setting( 'hero_image_subtitle', array(
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'wp_kses_post',
		'default'  => __( '', 'writers' ),
		) );

	$wp_customize->add_control( 'hero_image_subtitle', array(
		'label'    => __( "Header Image Tagline", 'writers' ),
		'section'  => 'header_image',
		'description' => __( 'Add a tagline to your header image! If you dont want any, you can press SPACE inside, leaving it blank.', 'writers' ),
		'type'     => 'text',
		'priority' => 1,
		) );
	$wp_customize->add_setting( 'blog_post_author_image', array(
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'esc_url',
		) );
	$wp_customize->add_control( 'blog_post_author_image', array(
		'label'    => __( "Author Image URL", 'writers' ),
		'description' => __( 'Displayed above headline on blog posts. Paste in the link to your author image, 50x50 size is recommended.', 'writers' ),
		'section'  => 'post_page_options',
		'type'     => 'url',
		'priority' => 1,
		) );
	$wp_customize->add_setting( 'background_elements_color', array(
		'default'           => '#eeeeee',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'background_elements_color', array(
		'label'       => __( 'Background Elements Color', 'writers' ),
		'description' => __( 'Choose the color of background elements.', 'writers' ),
		'section'     => 'website_background_color',
		'settings'    => 'background_elements_color',
		'priority' => 1,
		) ) );

	$wp_customize->add_section(
		'blog_feed_customization',
		array(
			'title'     => __('Blog Feed','writers'),
			'priority'  => 1,
			)
		);

		$wp_customize->add_setting( 'toggle_fallback_img', array(
        'default' => 0,
        'priority' => 1,
        'sanitize_callback' => 'sanitize_text_field',
    ) );
   	
	$wp_customize->add_control( 'toggle_fallback_img', array(
	    'label'    => __( 'Hide Blog Feed Quote Image', 'writers' ),
	    'section'  => 'blog_feed_customization',
	    'settings' => 'toggle_fallback_img',
	    'priority' => 1,
	    'type'     => 'checkbox',
) );
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_section('header_image')->title = __( 'Front Page Header', 'writers' );
	$wp_customize->get_section('colors')->title = __( 'Background Color', 'writers' );
	$wp_customize->add_section(
		'website_background_color',
		array(
			'title'     => __('Background Color','writers'),
			'priority'  => 2
			)
		);

	$wp_customize->add_setting('post_display_option', array(
		'default'        => 'post-excerpt',
		'sanitize_callback' => 'writers_sanitize_post_display_option',
		'transport'         => 'refresh'
		));
	
}
add_action( 'customize_register', 'writers_customize_register' );

if(! function_exists('writers_customizer_outputs' ) ):
function writers_customizer_outputs(){
	?>
	<style type="text/css">	.site-header { background: <?php echo esc_attr(get_theme_mod( 'header_bg_color')); ?>; }.footer-widgets h3 { color: <?php echo esc_attr(get_theme_mod( 'footer_widget_title_colors')); ?>; }.site-footer { background: <?php echo esc_attr(get_theme_mod( 'footer_copyright_background_color')); ?>; }.footer-widget-wrapper { background: <?php echo esc_attr(get_theme_mod( 'footer_colors')); ?>; } .row.site-info { color: <?php echo esc_attr(get_theme_mod( 'footer_copyright_text_color')); ?>; } #secondary h3.widget-title, #secondary h4.widget-title { color: <?php echo esc_attr(get_theme_mod( 'sidebar_headline_colors')); ?>; } #secondary .widget li, #secondary .textwidget, #secondary .tagcloud { background: <?php echo esc_attr(get_theme_mod( 'sidebar_background_color')); ?>; } #secondary .widget a { color: <?php echo esc_attr(get_theme_mod( 'sidebar_link_color')); ?>; } .navbar-default,.navbar-default li>.dropdown-menu, .navbar-default .navbar-nav .open .dropdown-menu > .active > a, .navbar-default .navbar-nav .open .dr { background-color: <?php echo esc_attr(get_theme_mod( 'navigation_background_color')); ?>; } .navbar-default .navbar-nav>li>a, .navbar-default li>.dropdown-menu>li>a { color: <?php echo esc_attr(get_theme_mod( 'navigation_text_color')); ?>; } .navbar-default .navbar-brand, .navbar-default .navbar-brand:hover, .navbar-default .navbar-brand:focus { color: <?php echo esc_attr(get_theme_mod( 'navigation_logo_color')); ?>; } h1.entry-title, .entry-header .entry-title a { color: <?php echo esc_attr(get_theme_mod( 'headline_color')); ?>; } .entry-content, .entry-summary, .post-feed-wrapper p { color: <?php echo esc_attr(get_theme_mod( 'post_content_color')); ?>; } h5.entry-date, h5.entry-date a { color: <?php echo esc_attr(get_theme_mod( 'author_line_color')); ?>; } .top-widgets { background: <?php echo esc_attr(get_theme_mod( 'top_widget_background_color')); ?>; } .top-widgets h3 { color: <?php echo esc_attr(get_theme_mod( 'top_widget_title_color')); ?>; } .top-widgets, .top-widgets p { color: <?php echo esc_attr(get_theme_mod( 'top_widget_text_color')); ?>; } .bottom-widgets { background: <?php echo esc_attr(get_theme_mod( 'bottom_widget_background_color')); ?>; } .bottom-widgets h3 { color: <?php echo esc_attr(get_theme_mod( 'bottom_widget_title_color')); ?>; } .frontpage-site-title { color: <?php echo esc_attr(get_theme_mod( 'header_image_text_color')) ?>; } .frontpage-site-description { color: <?php echo esc_attr(get_theme_mod( 'header_image_tagline_color')) ?>; } .bottom-widgets, .bottom-widgets p { color: <?php echo esc_attr(get_theme_mod( 'bottom_widget_text_color')); ?>; } .footer-widgets, .footer-widgets p { color: <?php echo esc_attr(get_theme_mod( 'footer_widget_text_color')); ?>; } .home .lh-nav-bg-transform .navbar-nav>li>a { color: <?php echo esc_attr(get_theme_mod( 'navigation_frontpage_menu_color')); ?>; } .home .lh-nav-bg-transform.navbar-default .navbar-brand { color: <?php echo esc_attr(get_theme_mod( 'navigation_frontpage_logo_color')); ?>; }
	body, #secondary h4.widget-title { background-color: <?php echo esc_attr(get_theme_mod( 'background_elements_color')); ?>; }
	@media (max-width:767px){	 .lh-nav-bg-transform button.navbar-toggle, .navbar-toggle, .navbar-default .navbar-toggle:hover, .navbar-default .navbar-toggle:focus { background-color: <?php echo esc_attr(get_theme_mod( 'navigation_text_color')); ?>; } .home .lh-nav-bg-transform, .navbar-default .navbar-toggle .icon-bar, .navbar-default .navbar-toggle:focus .icon-bar, .navbar-default .navbar-toggle:hover .icon-bar { background-color: <?php echo esc_attr(get_theme_mod( 'navigation_background_color')); ?> !important; } .navbar-default .navbar-nav .open .dropdown-menu>li>a, .home .lh-nav-bg-transform .navbar-nav>li>a {color: <?php echo esc_attr(get_theme_mod( 'navigation_text_color')); ?>; } .home .lh-nav-bg-transform.navbar-default .navbar-brand { color: <?php echo esc_attr(get_theme_mod( 'navigation_logo_color')); ?>; }}</style>
	<?php }
	add_action( 'wp_head', 'writers_customizer_outputs' );
	endif;


/**
 * Checkbox sanitization callback
 * @link    https://github.com/WPTRT/code-examples/blob/master/customizer/sanitization-callbacks.php
 * 
 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
 * as a boolean value, either TRUE or FALSE.
 * 
 * @param   bool    $checked    Whether the checkbox is checked.
 * @return  bool                Whether the checkbox is checked.
 */
function writers_sanitize_checkbox( $checked ) {
    // Boolean check
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
}





