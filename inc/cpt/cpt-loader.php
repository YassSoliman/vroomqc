<?php
/**
 * Custom Post Types Loader
 * 
 * Loads all custom post type registrations
 *
 * @package vroomqc
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Load custom post types
require_once get_template_directory() . '/inc/cpt/vehicle.php';

/**
 * Register custom post types
 */
add_action( 'init', 'vroomqc_register_custom_post_types' );

function vroomqc_register_custom_post_types() {
    // Custom post types will be registered by the individual files
}