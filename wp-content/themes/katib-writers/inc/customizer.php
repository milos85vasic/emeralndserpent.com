<?php
/**
 * Katib Writers: Customizer
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function katib_writers_customize_register( $wp_customize ) {

	$wp_customize->add_panel( 'katib_writers_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Theme Settings', 'katib-writers' ),
	    'description' => __( 'Description of what this panel does.', 'katib-writers' ),
	) );

	$wp_customize->add_section( 'katib_writers_general_option', array(
    	'title'      => __( 'Sidebar Settings', 'katib-writers' ),
		'priority'   => 30,
		'panel' => 'katib_writers_panel_id'
	) );

	// Add Settings and Controls for Layout
	$wp_customize->add_setting('katib_writers_layout_settings',array(
        'default' => __('Right Sidebar','katib-writers'),
        'sanitize_callback' => 'katib_writers_sanitize_choices'	        
	));

	$wp_customize->add_control('katib_writers_layout_settings',array(
        'type' => 'radio',
        'label'     => __('Theme Sidebar Layouts', 'katib-writers'),
        'description'   => __('This option work for blog page, blog single page, archive page and search page.', 'katib-writers'),
        'section' => 'katib_writers_general_option',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','katib-writers'),
            'Right Sidebar' => __('Right Sidebar','katib-writers'),
            'One Column' => __('Full Width','katib-writers'),
            'Grid Layout' => __('Grid Layout','katib-writers')
        ),
	));

	//home page slider
	$wp_customize->add_section( 'katib_writers_banner' , array(
    	'title'      => __( 'Slider Settings', 'katib-writers' ),
		'priority'   => null,
		'panel' => 'katib_writers_panel_id'
	) );

	$wp_customize->add_setting( 'katib_writers_banner_page', array(
		'default'           => '',
		'sanitize_callback' => 'katib_writers_sanitize_dropdown_pages'
	) );

	$wp_customize->add_control( 'katib_writers_banner_page', array(
		'label'    => __( 'Select Banner Image Page', 'katib-writers' ),
		'section'  => 'katib_writers_banner',
		'type'     => 'dropdown-pages'
	) );

	$wp_customize->add_setting('katib_writers_call',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('katib_writers_call',array(
		'label'	=> __('Contact No.','katib-writers'),
		'section'	=> 'katib_writers_banner',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('katib_writers_email',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('katib_writers_email',array(
		'label'	=> __('Email Address','katib-writers'),
		'section'	=> 'katib_writers_banner',
		'type'		=> 'text'
	));

	//About
	$wp_customize->add_section('katib_writers_about',array(
		'title'	=> __('About','katib-writers'),
		'description'	=> __('Add About Section below.','katib-writers'),
		'panel' => 'katib_writers_panel_id',
	));

	$wp_customize->add_setting( 'katib_writers_about_page', array(
		'default'           => '',
		'sanitize_callback' => 'katib_writers_sanitize_dropdown_pages'
	) );
	$wp_customize->add_control( 'katib_writers_about_page', array(
		'label'    => __( 'Select About Page', 'katib-writers' ),
		'section'  => 'katib_writers_about',
		'type'     => 'dropdown-pages'
	) );

	//Footer
	$wp_customize->add_section( 'katib_writers_footer' , array(
    	'title'      => __( 'Footer Text', 'katib-writers' ),
		'priority'   => null,
		'panel' => 'katib_writers_panel_id'
	) );

	$wp_customize->add_setting('katib_writers_footer_text',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('katib_writers_footer_text',array(
		'label'	=> __('Add Copyright Text','katib-writers'),
		'section'	=> 'katib_writers_footer',
		'setting'	=> 'katib_writers_footer_text',
		'type'		=> 'text'
	));


	$wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport  = 'postMessage';

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title a',
		'render_callback' => 'katib_writers_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => 'katib_writers_customize_partial_blogdescription',
	) );
	
}
add_action( 'customize_register', 'katib_writers_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Katib Writers 1.0
 * @see katib-writers_customize_register()
 *
 * @return void
 */
function katib_writers_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Katib Writers 1.0
 * @see katib-writers_customize_register()
 *
 * @return void
 */
function katib_writers_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Return whether we're on a view that supports a one or two column layout.
 */
function katib_writers_is_view_with_layout_option() {
	// This option is available on all pages. It's also available on archives when there isn't a sidebar.
	return ( is_page() || ( is_archive() && ! is_active_sidebar( 'footer-1' ) ) );
}

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class katib_writers_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'Katib_Writers_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new Katib_Writers_Customize_Section_Pro(
				$manager,
				'example_1',
				array(
					'priority' => 9,
					'title'    => esc_html__( 'Katib Writers Pro', 'katib-writers' ),
					'pro_text' => esc_html__( 'Go Pro', 'katib-writers' ),
					'pro_url'  => esc_url('https://www.themeseye.com/wordpress/wordpress-themes-for-writers/'),
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'katib-writers-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'katib-writers-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
katib_writers_Customize::get_instance();