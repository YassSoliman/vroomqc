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

	// Footer Description Setting
	$wp_customize->add_setting( 'vroomqc_footer_description', array(
		'default'           => '',
		'sanitize_callback' => 'wp_kses_post',
	) );

	$wp_customize->add_control( 'vroomqc_footer_description', array(
		'label'       => esc_html__( 'Footer Description', 'vroomqc' ),
		'section'     => 'vroomqc_theme_options',
		'type'        => 'textarea',
		'description' => esc_html__( 'Enter a description or SEO content for the footer area.', 'vroomqc' ),
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

	// Remove unnecessary default sections
	$wp_customize->remove_section( 'colors' );
	$wp_customize->remove_section( 'background_image' );
	$wp_customize->remove_panel( 'widgets' );

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