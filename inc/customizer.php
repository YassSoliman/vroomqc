<?php
/**
 * VroomQC Theme Customizer
 *
 * @package vroomqc
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function vroomqc_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'vroomqc_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'vroomqc_customize_partial_blogdescription',
		) );
	}

	// Theme Options Section
	$wp_customize->add_section( 'vroomqc_theme_options', array(
		'title'    => esc_html__( 'Theme Options', 'vroomqc' ),
		'priority' => 30,
	) );

	// Footer Copyright Setting
	$wp_customize->add_setting( 'vroomqc_footer_copyright', array(
		'default'           => esc_html__( 'Vroom - Canadian Car Dealership. All rights reserved.', 'vroomqc' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'vroomqc_footer_copyright', array(
		'label'       => esc_html__( 'Footer Copyright Text', 'vroomqc' ),
		'section'     => 'vroomqc_theme_options',
		'type'        => 'text',
		'description' => esc_html__( 'Enter the copyright text for the footer.', 'vroomqc' ),
	) );

	// Social Links Section
	$wp_customize->add_section( 'vroomqc_social_links', array(
		'title'    => esc_html__( 'Social Links', 'vroomqc' ),
		'priority' => 35,
	) );

	// Social Media Links
	$social_links = array(
		'twitter'   => esc_html__( 'Twitter URL', 'vroomqc' ),
		'facebook'  => esc_html__( 'Facebook URL', 'vroomqc' ),
		'instagram' => esc_html__( 'Instagram URL', 'vroomqc' ),
		'youtube'   => esc_html__( 'YouTube URL', 'vroomqc' ),
	);

	foreach ( $social_links as $social => $label ) {
		$wp_customize->add_setting( 'vroomqc_' . $social . '_url', array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		) );

		$wp_customize->add_control( 'vroomqc_' . $social . '_url', array(
			'label'   => $label,
			'section' => 'vroomqc_social_links',
			'type'    => 'url',
		) );
	}

	// Contact Information Section
	$wp_customize->add_section( 'vroomqc_contact_info', array(
		'title'    => esc_html__( 'Contact Information', 'vroomqc' ),
		'priority' => 40,
	) );

	// Phone Number
	$wp_customize->add_setting( 'vroomqc_phone_number', array(
		'default'           => '+1 (514) 123-4567',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'vroomqc_phone_number', array(
		'label'   => esc_html__( 'Phone Number', 'vroomqc' ),
		'section' => 'vroomqc_contact_info',
		'type'    => 'text',
	) );

	// Email Address
	$wp_customize->add_setting( 'vroomqc_email_address', array(
		'default'           => 'hello@vroomqc.com',
		'sanitize_callback' => 'sanitize_email',
	) );

	$wp_customize->add_control( 'vroomqc_email_address', array(
		'label'   => esc_html__( 'Email Address', 'vroomqc' ),
		'section' => 'vroomqc_contact_info',
		'type'    => 'email',
	) );

	// Address
	$wp_customize->add_setting( 'vroomqc_address', array(
		'default'           => '123 Main Street, Montreal, QC H3A 1A1',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );

	$wp_customize->add_control( 'vroomqc_address', array(
		'label'   => esc_html__( 'Address', 'vroomqc' ),
		'section' => 'vroomqc_contact_info',
		'type'    => 'textarea',
	) );

	// Hero Section
	$wp_customize->add_section( 'vroomqc_hero_section', array(
		'title'    => esc_html__( 'Hero Section', 'vroomqc' ),
		'priority' => 45,
	) );

	// Hero Title
	$wp_customize->add_setting( 'vroomqc_hero_title', array(
		'default'           => esc_html__( 'Buy or sell your car — 100% online.', 'vroomqc' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'vroomqc_hero_title', array(
		'label'   => esc_html__( 'Hero Title', 'vroomqc' ),
		'section' => 'vroomqc_hero_section',
		'type'    => 'text',
	) );

	// Hero Subtitle
	$wp_customize->add_setting( 'vroomqc_hero_subtitle', array(
		'default'           => esc_html__( 'Get pre-qualified in minutes. Delivery in 24h. Québec-based and human-backed.', 'vroomqc' ),
		'sanitize_callback' => 'sanitize_textarea_field',
	) );

	$wp_customize->add_control( 'vroomqc_hero_subtitle', array(
		'label'   => esc_html__( 'Hero Subtitle', 'vroomqc' ),
		'section' => 'vroomqc_hero_section',
		'type'    => 'textarea',
	) );
}
add_action( 'customize_register', 'vroomqc_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function vroomqc_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function vroomqc_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function vroomqc_customize_preview_js() {
	wp_enqueue_script( 'vroomqc-customizer', get_template_directory_uri() . '/assets/src/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'vroomqc_customize_preview_js' );

/**
 * Get social links for footer
 */
function vroomqc_get_social_links() {
	$social_links = array();
	$social_platforms = array( 'twitter', 'facebook', 'instagram', 'youtube' );
	
	foreach ( $social_platforms as $platform ) {
		$url = get_theme_mod( 'vroomqc_' . $platform . '_url' );
		if ( ! empty( $url ) ) {
			$social_links[ $platform ] = $url;
		}
	}
	
	return $social_links;
}