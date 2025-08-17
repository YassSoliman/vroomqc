<?php
/**
 * Taxonomies Loader
 * 
 * Loads all taxonomy registrations
 *
 * @package vroomqc
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Load taxonomies
require_once get_template_directory() . '/inc/taxonomies/vehicle-taxonomies.php';

/**
 * Register taxonomies
 */
add_action( 'init', 'vroomqc_register_taxonomies' );

function vroomqc_register_taxonomies() {
    // Taxonomies will be registered by the individual files
}