<?php
/**
 * Vehicle Bulk Export Functionality
 *
 * @package vroomqc
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add 'Generate CSV' button to the All Vehicles admin page
 */
add_action( 'restrict_manage_posts', function( $post_type ) {
    if ( $post_type === 'vehicle' && current_user_can( 'manage_options' ) ) {
        $export_url = admin_url( 'admin-post.php?action=export_unsold_vehicles_csv' );
        echo '<a href="' . esc_url( $export_url ) . '" class="button button-primary" style="margin-left:10px;">Generate CSV</a>';
    }
});

/**
 * Handle CSV export for unsold vehicles
 */
add_action( 'admin_post_export_unsold_vehicles_csv', function() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'Unauthorized' );
    }

    // Set headers for CSV download
    header( 'Content-Type: text/csv; charset=utf-8' );
    header( 'Content-Disposition: attachment; filename=vehicle-export-' . date( 'Ymd-His' ) . '.csv' );
    
    $output = fopen( 'php://output', 'w' );

    // CSV columns as per sample
    $columns = array(
        'AdLastModifiedDate', 'Type', 'StockNumber', 'Vin', 'Status', 'Year', 'Make', 'Model', 'Trim', 'KMS', 'Exterior Color', 'Interior Color', 'FuelType', 'Drive', 'Engine Size', 'Transmission', 'Doors', 'Cylinder', 'Price', 'Options', 'Description', 'MainPhoto', 'MainPhotoLastModifiedDate', 'ExtraPhotos', 'ExtraphotoLastModifiedDate', 'Displacement', 'FuelCapacity', 'BodyType', 'MSRP'
    );
    fputcsv( $output, $columns );

    // Query unsold vehicles
    $args = array(
        'post_type' => 'vehicle',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'meta_query' => array(
            array(
                'key' => 'vendu',
                'value' => '0',
                'compare' => '='
            )
        )
    );
    $query = new WP_Query( $args );

    foreach ( $query->posts as $post ) {
        $post_id = $post->ID;
        
        // Get ACF/meta fields - using get_field to get ACF values
        $vin = get_field( 'vin', $post_id ) ?: '';
        $stock = $vin; // StockNumber is VIN
        $status = 'used';
        $year = get_field( 'year', $post_id ) ?: '';
        $kms = get_field( 'mileage', $post_id ) ?: '';
        $doors = get_field( 'doors', $post_id ) ?: '';
        $cylinder = get_field( 'cylinder', $post_id ) ?: '';
        $price = get_field( 'price', $post_id ) ?: '';
        $options = get_field( 'options', $post_id ) ?: '';
        $short_description = get_field( 'short_description', $post_id ) ?: '';
        
        if ( $short_description ) {
            // Convert to plain text, preserve <br> for line breaks and empty lines
            $desc = strip_tags( $short_description, '<br>' );
            // Normalize all <br> tags
            $desc = preg_replace( '/<br\s*\/?>/i', "\n", $desc );
            // Convert all Windows/Mac line endings to \n
            $desc = str_replace( array( "\r\n", "\r" ), "\n", $desc );
            // Replace multiple consecutive newlines with <br><br>
            $desc = preg_replace( "/\n{2,}/", '<br><br>', $desc );
            // Replace single newlines with <br>
            $desc = preg_replace( "/\n/", '<br>', $desc );
        } else {
            $desc = '';
        }
        
        $displacement = get_field( 'displacementL', $post_id ) ?: '';
        $fuel_capacity = get_field( 'fuel_capacity', $post_id ) ?: '';
        $msrp = get_field( 'msrp', $post_id ) ?: '';

        // Taxonomies (get names, or empty string)
        $make = get_the_terms( $post_id, 'make' );
        $model = get_the_terms( $post_id, 'model' );
        $trim = get_the_terms( $post_id, 'trim' );
        $fuel_type = get_the_terms( $post_id, 'fuel-type' );
        $drive = get_the_terms( $post_id, 'drivetrain' );
        $transmission = get_the_terms( $post_id, 'transmission' );
        $body_type = get_the_terms( $post_id, 'body-style' );
        $exterior_color = get_the_terms( $post_id, 'exterior-color' );
        $interior_color = get_the_terms( $post_id, 'interior-color' );
        $cylinder_terms = get_the_terms( $post_id, 'cylinder' );

        $make_name = ( $make && ! is_wp_error( $make ) ) ? $make[0]->name : '';
        $model_name = ( $model && ! is_wp_error( $model ) ) ? $model[0]->name : '';
        $trim_name = ( $trim && ! is_wp_error( $trim ) ) ? $trim[0]->name : '';
        $fuel_type_name = ( $fuel_type && ! is_wp_error( $fuel_type ) ) ? $fuel_type[0]->name : '';
        $drive_name = ( $drive && ! is_wp_error( $drive ) ) ? $drive[0]->name : '';
        $transmission_name = ( $transmission && ! is_wp_error( $transmission ) ) ? $transmission[0]->name : '';
        $body_type_name = ( $body_type && ! is_wp_error( $body_type ) ) ? $body_type[0]->name : '';
        $exterior_color_name = ( $exterior_color && ! is_wp_error( $exterior_color ) ) ? $exterior_color[0]->name : '';
        $interior_color_name = ( $interior_color && ! is_wp_error( $interior_color ) ) ? $interior_color[0]->name : '';
        $cylinder_name = ( $cylinder_terms && ! is_wp_error( $cylinder_terms ) ) ? $cylinder_terms[0]->name : '';

        // Engine size (from engine field or constructed)
        $engine_size = get_field( 'engine', $post_id );
        $displacement_val = $displacement;
        $cylinder_val = $cylinder_name;
        if ( empty( $engine_size ) && $displacement_val && $cylinder_val ) {
            $engine_size = $displacement_val . 'L ' . $cylinder_val . 'cyl';
        }
        // If still empty, set to empty string
        $engine_size = $engine_size ?: '';

        // Main/Extra photos
        $gallery = get_field( 'vehicle_gallery', $post_id );
        $main_photo_url = '';
        $main_photo_date = '';
        $extra_photos = array();
        $extra_photos_dates = array();
        
        if ( ! empty( $gallery ) && is_array( $gallery ) ) {
            foreach ( $gallery as $i => $img ) {
                $img_url = $img['url'] ?: '';
                $img_date = $img['modified'] ?: '';
                if ( $i === 0 ) {
                    $main_photo_url = $img_url;
                    $main_photo_date = $img_date;
                } else {
                    $extra_photos[] = $img_url;
                    $extra_photos_dates[] = $img_date;
                }
            }
        }
        $extra_photos_str = implode( ',', $extra_photos );
        $extra_photos_dates_str = implode( ',', $extra_photos_dates );

        // AdLastModifiedDate: use post_modified
        $ad_last_modified = $post->post_modified ?: '';

        // Compose row
        $row = array(
            $ad_last_modified, // AdLastModifiedDate
            'PV', // Type
            $stock, // StockNumber (VIN)
            $vin,
            $status,
            $year,
            $make_name,
            $model_name,
            $trim_name,
            $kms,
            $exterior_color_name,
            $interior_color_name,
            $fuel_type_name,
            $drive_name,
            $engine_size,
            $transmission_name,
            $doors,
            $cylinder_name, // Use taxonomy name for Cylinders
            $price,
            $options,
            $desc, // Use processed short_description
            $main_photo_url,
            $main_photo_date,
            $extra_photos_str,
            $extra_photos_dates_str,
            $displacement,
            $fuel_capacity,
            $body_type_name,
            $msrp
        );
        fputcsv( $output, $row );
    }
    fclose( $output );
    exit;
});