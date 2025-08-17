<?php
/**
 * ACF Loader
 * 
 * Loads all ACF field groups and related functionality
 *
 * @package vroomqc
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Load field groups
require_once get_template_directory() . '/inc/acf/field-groups/vehicle-details.php';
require_once get_template_directory() . '/inc/acf/field-groups/vehicle-taxonomies.php';

/**
 * Register ACF field groups
 */
add_action( 'acf/include_fields', 'vroomqc_register_acf_field_groups' );

function vroomqc_register_acf_field_groups() {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    // Field groups will be registered by the individual files
}