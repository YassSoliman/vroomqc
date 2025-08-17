<?php
/**
 * Vehicle Bulk Import Functionality
 *
 * @package vroomqc
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Add bulk import and duplicate checker buttons to vehicles list page
add_action( 'admin_footer-edit.php', function() {
    global $typenow;
    if ( $typenow !== 'vehicle' ) {
        return;
    }
    ?>
    <div id="bulk-import-modal" style="display:none;" class="bulk-import-modal">
        <div class="bulk-import-content">
            <h2>Bulk Import Vehicles</h2>
            <p>Upload a CSV file containing vehicle information. The file should have the following columns:</p>
            <ul>
                <li>VIN (required)</li>
                <li>Odometer (mileage)</li>
                <li>Exterior Color</li>
                <li>Interior Color</li>
            </ul>
            <form id="bulk-import-form" method="post" enctype="multipart/form-data">
                <?php wp_nonce_field( 'bulk_import_vehicles', 'bulk_import_nonce' ); ?>
                <input type="file" name="vehicle_csv" accept=".csv" required>
                <div class="import-progress" style="display:none;">
                    <div class="progress-bar">
                        <div class="progress-bar-fill"></div>
                    </div>
                    <div class="progress-status">Processing: 0%</div>
                </div>
                <div class="import-results" style="display:none;"></div>
                <div class="import-actions">
                    <button type="submit" class="button button-primary">Start Import</button>
                    <button type="button" class="button cancel-import">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Duplicate Checker Modal -->
    <div id="duplicate-checker-modal" style="display:none;" class="duplicate-checker-modal">
        <div class="duplicate-checker-content">
            <h2>Check for Duplicate Vehicles</h2>
            <p>This will find vehicles where the same VIN exists multiple times with different slugs.</p>
            <div class="duplicate-results" style="display:none;"></div>
            <div class="duplicate-actions">
                <button type="button" class="button button-primary duplicate-check-btn">Check for Duplicates</button>
                <button type="button" class="button button-primary duplicate-delete-btn" style="display:none; background-color: #dc3232; border-color: #dc3232;">Delete Duplicates</button>
                <button type="button" class="button cancel-duplicate-check">Cancel</button>
            </div>
        </div>
    </div>
    
    <style>
        .bulk-import-modal, .duplicate-checker-modal {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.7);
            z-index: 160000;
        }
        .bulk-import-content, .duplicate-checker-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #fff;
            padding: 20px;
            border-radius: 4px;
            min-width: 400px;
            max-width: 600px;
        }
        .progress-bar {
            height: 20px;
            background: #f0f0f0;
            border-radius: 10px;
            margin: 10px 0;
            overflow: hidden;
        }
        .progress-bar-fill {
            height: 100%;
            background: #2271b1;
            width: 0;
            transition: width 0.3s ease;
        }
        .import-results {
            margin-top: 15px;
            padding: 10px;
            border-radius: 4px;
        }
        .import-results.success {
            background: #d4edda;
            color: #155724;
        }
        .import-results.error {
            background: #f8d7da;
            color: #721c24;
        }
        .duplicate-results {
            margin-top: 15px;
            padding: 10px;
            border-radius: 4px;
            background: #f9f9f9;
            border: 1px solid #ddd;
            max-height: 400px;
            overflow-y: auto;
        }
        .duplicate-item {
            padding: 10px;
            margin: 5px 0;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 3px;
        }
        .duplicate-item.to-delete {
            background: #f8d7da;
            border-color: #dc3232;
        }
        .duplicate-item.to-keep {
            background: #d4edda;
            border-color: #28a745;
        }
        .duplicate-vin {
            font-weight: bold;
            color: #0073aa;
        }
        .duplicate-slug {
            font-family: monospace;
            background: #f1f1f1;
            padding: 2px 4px;
            border-radius: 2px;
        }
    </style>
    <script>
    jQuery(document).ready(function($) {
        // Add import and duplicate checker buttons to the page title area
        $('.wp-header-end').before(
            '<a href="#" class="page-title-action bulk-import-trigger">Bulk Import Vehicles</a>' +
            '<a href="#" class="page-title-action duplicate-checker-trigger" style="background-color: #dc3232; border-color: #dc3232; margin-left: 5px; color: white;">Check for Duplicates</a>'
        ); 

        // Show bulk import modal
        $('.bulk-import-trigger').on('click', function(e) {
            e.preventDefault();
            $('#bulk-import-modal').show();
        });

        // Show duplicate checker modal
        $('.duplicate-checker-trigger').on('click', function(e) {
            e.preventDefault();
            $('#duplicate-checker-modal').show();
        });

        // Hide modals
        $('.cancel-import').on('click', function() {
            $('#bulk-import-modal').hide();
            resetImportForm();
        });

        $('.cancel-duplicate-check').on('click', function() {
            $('#duplicate-checker-modal').hide();
            resetDuplicateChecker();
        });

        // Handle form submission
        $('#bulk-import-form').on('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            formData.append('action', 'bulk_import_vehicles');
            
            $('.import-progress').show();
            $('.import-actions button').prop('disabled', true);
            
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                xhr: function() {
                    const xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function(e) {
                        if (e.lengthComputable) {
                            const percent = Math.round((e.loaded / e.total) * 100);
                            updateProgress(percent);
                        }
                    }, false);
                    return xhr;
                },
                success: function(response) {
                    if (response.success) {
                        showResults('success', response.data.message);
                        if (response.data.redirect) {
                            setTimeout(function() {
                                window.location.href = response.data.redirect;
                            }, 2000);
                        }
                    } else {
                        showResults('error', response.data.message);
                    }
                },
                error: function() {
                    showResults('error', 'An error occurred during import.');
                },
                complete: function() {
                    $('.import-actions button').prop('disabled', false);
                }
            });
        });

        // Handle duplicate check
        $('.duplicate-check-btn').on('click', function() {
            $('.duplicate-results').show().html('Checking for duplicates...');
            $('.duplicate-check-btn').prop('disabled', true);
            
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'check_vehicle_duplicates',
                    nonce: $('#vin_lookup_nonce').val() || ''
                },
                success: function(response) {
                    if (response.success) {
                        if (response.data.duplicates.length > 0) {
                            displayDuplicates(response.data.duplicates);
                            $('.duplicate-check-btn').hide();
                            $('.duplicate-delete-btn').show();
                        } else {
                            $('.duplicate-results').html('<p style="color: green;">No duplicates found!</p>');
                        }
                    } else {
                        $('.duplicate-results').html('<p style="color: red;">Error: ' + response.data.message + '</p>');
                    }
                },
                error: function() {
                    $('.duplicate-results').html('<p style="color: red;">An error occurred while checking for duplicates.</p>');
                },
                complete: function() {
                    $('.duplicate-check-btn').prop('disabled', false);
                }
            });
        });

        // Handle duplicate deletion
        $('.duplicate-delete-btn').on('click', function() {
            if (!confirm('Are you sure you want to delete the duplicate vehicles? This action cannot be undone.')) {
                return;
            }
            
            const duplicateIds = [];
            $('.duplicate-item.to-delete').each(function() {
                duplicateIds.push($(this).data('post-id'));
            });
            
            $('.duplicate-delete-btn').prop('disabled', true).text('Deleting...');
            
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'delete_vehicle_duplicates',
                    nonce: $('#vin_lookup_nonce').val() || '',
                    duplicate_ids: duplicateIds
                },
                success: function(response) {
                    if (response.success) {
                        $('.duplicate-results').html('<p style="color: green;">' + response.data.message + '</p>');
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    } else {
                        $('.duplicate-results').html('<p style="color: red;">Error: ' + response.data.message + '</p>');
                    }
                },
                error: function() {
                    $('.duplicate-results').html('<p style="color: red;">An error occurred while deleting duplicates.</p>');
                },
                complete: function() {
                    $('.duplicate-delete-btn').prop('disabled', false).text('Delete Duplicates');
                }
            });
        });

        function displayDuplicates(duplicates) {
            let html = '<h4>Found ' + duplicates.length + ' duplicate groups:</h4>';
            
            duplicates.forEach(function(group) {
                html += '<div style="margin: 15px 0; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">';
                html += '<h5 class="duplicate-vin">VIN: ' + group.vin + '</h5>';
                
                group.posts.forEach(function(post) {
                    const isCorrect = post.slug === post.vin.toLowerCase();
                    const cssClass = isCorrect ? 'to-keep' : 'to-delete';
                    const status = isCorrect ? 'KEEP' : 'DELETE';
                    
                    html += '<div class="duplicate-item ' + cssClass + '" data-post-id="' + post.id + '">';
                    html += '<strong>' + status + '</strong> - ';
                    html += 'ID: ' + post.id + ' | ';
                    html += 'Title: ' + post.title + ' | ';
                    html += 'Slug: <span class="duplicate-slug">' + post.slug + '</span>' + ' | ';
                    html += 'Status: ' + (post.status || 'unknown');
                    html += '</div>';
                });
                
                html += '</div>';
            });
            
            $('.duplicate-results').html(html);
        }

        function updateProgress(percent) {
            $('.progress-bar-fill').css('width', percent + '%');
            $('.progress-status').text('Processing: ' + percent + '%');
        }

        function showResults(type, message) {
            $('.import-results')
                .removeClass('success error')
                .addClass(type)
                .html(message)
                .show();
        }

        function resetImportForm() {
            $('#bulk-import-form')[0].reset();
            $('.import-progress').hide();
            $('.import-results').hide();
            $('.progress-bar-fill').css('width', '0');
            $('.progress-status').text('Processing: 0%');
        }

        function resetDuplicateChecker() {
            $('.duplicate-results').hide().html('');
            $('.duplicate-check-btn').show().prop('disabled', false);
            $('.duplicate-delete-btn').hide().text('Delete Duplicates');
        }
    });
    </script>
    <?php
});

// Handle the bulk import AJAX request
add_action( 'wp_ajax_bulk_import_vehicles', function() {
    check_ajax_referer( 'bulk_import_vehicles', 'bulk_import_nonce' );
    
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error( array( 'message' => 'Permission denied.' ) );
    }

    // Enable error logging
    error_log( 'Starting bulk import process' );

    if ( ! isset( $_FILES['vehicle_csv'] ) || $_FILES['vehicle_csv']['error'] !== UPLOAD_ERR_OK ) {
        wp_send_json_error( array( 'message' => 'Please upload a valid CSV file.' ) );
    }

    $file = $_FILES['vehicle_csv']['tmp_name'];
    $handle = fopen( $file, 'r' );
    
    if ( ! $handle ) {
        wp_send_json_error( array( 'message' => 'Could not open the CSV file.' ) );
    }

    // Read headers
    $headers = fgetcsv( $handle );
    if ( ! $headers ) {
        fclose( $handle );
        wp_send_json_error( array( 'message' => 'Invalid CSV format.' ) );
    }

    error_log( 'CSV Headers: ' . print_r( $headers, true ) );

    // Map CSV columns to field names (case-insensitive)
    $column_map = array(
        'vin' => 'vin',
        'odometer' => 'mileage',
        'exterior color' => 'exterior-color',
        'interior color' => 'interior-color'
    );

    // Find column indices (case-insensitive)
    $column_indices = array();
    foreach ( $headers as $index => $header ) {
        $header_lower = strtolower( trim( $header ) );
        foreach ( $column_map as $csv_header => $field_name ) {
            if ( $header_lower === strtolower( $csv_header ) ) {
                $column_indices[ $field_name ] = $index;
                break;
            }
        }
    }

    error_log( 'Column Indices: ' . print_r( $column_indices, true ) );

    if ( ! isset( $column_indices['vin'] ) ) {
        fclose( $handle );
        wp_send_json_error( array(
            'message' => 'VIN column is required in the CSV file. Please ensure your CSV has a column named "VIN" (case-insensitive).'
        ) );
    }

    // Process each row
    $batch_data = array();
    $batch_map = array(); // Map to store row data for each VIN
    $seen_vins = array(); // Track VINs already seen in this CSV
    $imported = 0;
    $skipped = 0;
    $errors = 0;
    $import_errors = array();
    // Track skipped/existing vehicles by post_status (publish, draft, pending, etc.)
    $existing_status_counts = array();
    $row = 2; // Start from row 2 (after headers)

    // First, collect all VINs and check for existing ones
    while ( ( $data = fgetcsv( $handle ) ) !== false ) {
        $vin = sanitize_text_field( $data[ $column_indices['vin'] ] );
        
        error_log( "Processing row {$row} with VIN: {$vin}" );
        
        // Skip if VIN is empty
        if ( empty( $vin ) ) {
            $errors++;
            $import_errors[] = "Row {$row}: Empty VIN";
            error_log( "Row {$row}: Empty VIN, skipping" );
            $row++;
            continue;
        }

        // Check if we've already seen this VIN in the current CSV
        if ( isset( $seen_vins[ $vin ] ) ) {
            $skipped++;
            $import_errors[] = "Row {$row}: Duplicate VIN {$vin} in CSV (first seen at row {$seen_vins[ $vin ]})";
            error_log( "Row {$row}: Duplicate VIN {$vin} in CSV, skipping" );
            $row++;
            continue;
        }

        // Check if vehicle with this VIN already exists in database
        // Consider all statuses except trash
        $existing = get_posts( array(
            'post_type' => 'vehicle',
            'meta_key' => 'vin',
            'meta_value' => $vin,
            'posts_per_page' => 1,
            'post_status' => array( 'publish', 'draft', 'pending', 'private', 'future' )
        ) );

        if ( ! empty( $existing ) ) {
            $skipped++;
            $status = $existing[0]->post_status ?: 'other';
            if ( ! isset( $existing_status_counts[ $status ] ) ) {
                $existing_status_counts[ $status ] = 0;
            }
            $existing_status_counts[ $status ]++;
            error_log( "Row {$row}: VIN {$vin} already exists in database (status: {$status}), skipping" );
            $row++;
            continue;
        }

        // Mark this VIN as seen
        $seen_vins[ $vin ] = $row;

        // Store the row data for later use
        $batch_map[ $vin ] = array(
            'row' => $row,
            'data' => $data
        );

        // Add to batch data
        $batch_data[] = $vin;
        $row++;
    }

    // Process VINs in batches of 50
    $batches = array_chunk( $batch_data, 50 );
    foreach ( $batches as $batch_index => $batch ) {
        if ( $batch_index > 0 ) {
            // Wait 2 seconds between batches
            sleep( 2 );
        }

        // Build the batch data string
        $post_data = array();
        foreach ( $batch as $vin ) {
            $post_data[] = $vin;
        }
        $data_string = implode( ';', $post_data );

        // Make the batch API request
        $api_url = "https://vpic.nhtsa.dot.gov/api/vehicles/DecodeVINValuesBatch/";
        $response = wp_remote_post( $api_url, array(
            'body' => array(
                'DATA' => $data_string,
                'format' => 'json'
            ),
            'headers' => array(
                'Content-Type' => 'application/x-www-form-urlencoded'
            )
        ) );

        if ( is_wp_error( $response ) ) {
            $error_msg = $response->get_error_message();
            foreach ( $batch as $vin ) {
                $errors++;
                $import_errors[] = "VIN {$vin}: Batch API request failed - {$error_msg}";
            }
            continue;
        }

        $response_code = wp_remote_retrieve_response_code( $response );
        if ( $response_code !== 200 ) {
            foreach ( $batch as $vin ) {
                $errors++;
                $import_errors[] = "VIN {$vin}: Batch API request failed with code {$response_code}";
            }
            continue;
        }

        $body = json_decode( wp_remote_retrieve_body( $response ), true );
        if ( empty( $body ) || ! isset( $body['Results'] ) ) {
            foreach ( $batch as $vin ) {
                $errors++;
                $import_errors[] = "VIN {$vin}: Invalid batch API response structure";
            }
            continue;
        }

        // Process each result in the batch
        foreach ( $body['Results'] as $vehicle_data ) {
            $vin = $vehicle_data['VIN'];
            $row_data = $batch_map[ $vin ];
            $row = $row_data['row'];
            $csv_data = $row_data['data'];

            // Check for API error code
            if ( ! empty( $vehicle_data['ErrorCode'] ) && $vehicle_data['ErrorCode'] !== '0' ) {
                $errors++;
                $error_text = $vehicle_data['ErrorText'] ?? 'No error text';
                $import_errors[] = "VIN {$vin}: API Error - {$error_text}";
                continue;
            }

            // Check for minimum required data
            if ( empty( $vehicle_data['Make'] ) || empty( $vehicle_data['Model'] ) ) {
                $errors++;
                $import_errors[] = "VIN {$vin}: Missing required data (Make or Model)";
                continue;
            }

            // Double-check that this VIN doesn't exist (safety check for race conditions)
            $final_check = get_posts( array(
                'post_type' => 'vehicle',
                'meta_key' => 'vin',
                'meta_value' => $vin,
                'posts_per_page' => 1,
                'post_status' => array( 'publish', 'draft', 'pending', 'private', 'future' )
            ) );
            
            if ( ! empty( $final_check ) ) {
                $skipped++;
                $status = $final_check[0]->post_status ?: 'other';
                if ( ! isset( $existing_status_counts[ $status ] ) ) {
                    $existing_status_counts[ $status ] = 0;
                }
                $existing_status_counts[ $status ]++;
                error_log( "VIN {$vin}: Already exists at post creation time (status: {$status}), skipping" );
                continue;
            }

            // Create new vehicle post
            $post_id = wp_insert_post( array(
                'post_title' => 'Importing...', // Will be updated by VIN lookup
                'post_type' => 'vehicle',
                'post_status' => 'publish',
                'post_name' => $vin // Set the slug to be the VIN
            ) );

            if ( is_wp_error( $post_id ) ) {
                $errors++;
                $import_errors[] = "VIN {$vin}: Failed to create post - " . $post_id->get_error_message();
                continue;
            }

            // Set VIN
            vroomqc_set_acf_field( 'vin', $vin, $post_id );

            // Set additional fields if available
            if ( isset( $column_indices['mileage'] ) ) {
                vroomqc_set_acf_field( 'mileage', intval( $csv_data[ $column_indices['mileage'] ] ), $post_id );
            }
            if ( isset( $column_indices['exterior-color'] ) ) {
                vroomqc_set_acf_field( 'exterior-color', sanitize_text_field( $csv_data[ $column_indices['exterior-color'] ] ), $post_id );
            }
            if ( isset( $column_indices['interior-color'] ) ) {
                vroomqc_set_acf_field( 'interior-color', sanitize_text_field( $csv_data[ $column_indices['interior-color'] ] ), $post_id );
            }

            // Generate and set title
            $title = vroomqc_generate_vehicle_title( $vehicle_data );
            wp_update_post( array(
                'ID' => $post_id,
                'post_title' => $title
            ) );

            // Process taxonomy fields
            $taxonomy_fields = array(
                'make' => $vehicle_data['Make'],
                'model' => $vehicle_data['Model'],
                'trim' => $vehicle_data['Trim'] ?? $vehicle_data['Series'],
                'body-style' => $vehicle_data['BodyClass'],
                'transmission' => $vehicle_data['TransmissionStyle'],
                'cylinder' => $vehicle_data['EngineCylinders'],
                'fuel-type' => $vehicle_data['FuelTypePrimary'],
                'manufacturer' => $vehicle_data['Manufacturer'],
                'drivetrain' => $vehicle_data['DriveType'] ?? null
            );

            // Add colors from CSV if available
            if ( isset( $column_indices['exterior-color'] ) && ! empty( $csv_data[ $column_indices['exterior-color'] ] ) ) {
                $taxonomy_fields['exterior-color'] = sanitize_text_field( $csv_data[ $column_indices['exterior-color'] ] );
            }
            if ( isset( $column_indices['interior-color'] ) && ! empty( $csv_data[ $column_indices['interior-color'] ] ) ) {
                $taxonomy_fields['interior-color'] = sanitize_text_field( $csv_data[ $column_indices['interior-color'] ] );
            }

            $taxonomy_error = false;
            // Process all taxonomy fields
            foreach ( $taxonomy_fields as $taxonomy => $value ) {
                if ( ! empty( $value ) ) {
                    $term_id = vroomqc_ensure_taxonomy_term( $taxonomy, $value );
                    if ( $term_id ) {
                        $result = wp_set_object_terms( $post_id, $term_id, $taxonomy );
                        if ( is_wp_error( $result ) ) {
                            $taxonomy_error = true;
                            $import_errors[] = "VIN {$vin}: Error setting {$taxonomy} - " . $result->get_error_message();
                            break;
                        }
                    } else {
                        $taxonomy_error = true;
                        $import_errors[] = "VIN {$vin}: Failed to create/get term for {$taxonomy}: {$value}";
                        break;
                    }
                }
            }

            if ( $taxonomy_error ) {
                $errors++;
                wp_delete_post( $post_id, true );
                continue;
            }

            try {
                // Set number fields
                if ( ! empty( $vehicle_data['ModelYear'] ) ) {
                    vroomqc_set_acf_field( 'year', intval( $vehicle_data['ModelYear'] ), $post_id );
                }
                if ( ! empty( $vehicle_data['Doors'] ) ) {
                    vroomqc_set_acf_field( 'doors', intval( $vehicle_data['Doors'] ), $post_id );
                }
                if ( ! empty( $vehicle_data['DisplacementL'] ) ) {
                    vroomqc_set_acf_field( 'displacementL', floatval( $vehicle_data['DisplacementL'] ), $post_id );
                }

                // Set combined engine field
                if ( ! empty( $vehicle_data['DisplacementL'] ) && ! empty( $vehicle_data['EngineCylinders'] ) ) {
                    $engine_value = sprintf( "%.1fL %dcyl", 
                        floatval( $vehicle_data['DisplacementL'] ), 
                        intval( $vehicle_data['EngineCylinders'] )
                    );
                    vroomqc_set_acf_field( 'engine', $engine_value, $post_id );
                }

                $imported++;
            } catch ( Exception $e ) {
                $errors++;
                $import_errors[] = "VIN {$vin}: Exception while updating fields - " . $e->getMessage();
                wp_delete_post( $post_id, true );
                continue;
            }
        }
    }

    fclose( $handle );

    // Set admin notice for next page load
    $breakdown = '';
    if ( ! empty( $existing_status_counts ) ) {
        $parts = array();
        foreach ( $existing_status_counts as $status => $count ) {
            // We never queried trash, but guard anyway
            if ( $status === 'trash' || $count === 0 ) { 
                continue; 
            }
            $parts[] = sprintf( '%d %s', $count, $status );
        }
        if ( ! empty( $parts ) ) {
            $breakdown = ' (' . implode( ', ', $parts ) . ')';
        }
    }

    $message = sprintf(
        'Import completed. %d new vehicle(s), %d already existing%s, %d error(s).',
        $imported,
        $skipped,
        $breakdown,
        $errors
    );

    // If there were errors, add them to the message
    $detailed_message = $message;
    if ( ! empty( $import_errors ) ) {
        $detailed_message .= "\n\nError Details:\n" . implode( "\n", $import_errors );
    }
    
    error_log( "Import completed: " . $detailed_message );
    
    set_transient( 'vehicle_import_notice', array(
        'type' => $errors === 0 ? 'success' : 'warning',
        'message' => $message,
        'details' => $import_errors
    ), 45 );

    wp_send_json_success( array(
        'message' => $message,
        'redirect' => admin_url( 'edit.php?post_type=vehicle' )
    ) );
});

// Display admin notice after import
add_action( 'admin_notices', function() {
    $notice = get_transient( 'vehicle_import_notice' );
    if ( $notice ) {
        delete_transient( 'vehicle_import_notice' );
        ?>
        <div class="notice notice-<?php echo esc_attr( $notice['type'] ); ?> is-dismissible">
            <p><?php echo esc_html( $notice['message'] ); ?></p>
            <?php if ( ! empty( $notice['details'] ) ): ?>
                <div class="import-error-details" style="margin-top: 10px; padding: 10px; background: #fff; border: 1px solid #ddd;">
                    <h4 style="margin-top: 0;">Error Details:</h4>
                    <ul style="margin: 0;">
                        <?php foreach ( $notice['details'] as $error ): ?>
                            <li style="margin: 5px 0;"><?php echo esc_html( $error ); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
        <?php
    }
});

// AJAX handler to check for vehicle duplicates
add_action( 'wp_ajax_check_vehicle_duplicates', function() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error( array( 'message' => 'Permission denied.' ) );
    }

    // Get all vehicles with VINs (exclude trash)
    $vehicles = get_posts( array(
        'post_type' => 'vehicle',
        'posts_per_page' => -1,
        'post_status' => array( 'publish', 'draft', 'pending', 'private', 'future' ),
        'meta_query' => array(
            array(
                'key' => 'vin',
                'compare' => 'EXISTS'
            )
        )
    ) );

    // Group vehicles by VIN
    $vin_groups = array();
    foreach ( $vehicles as $vehicle ) {
        $vin = get_post_meta( $vehicle->ID, 'vin', true );
        if ( ! empty( $vin ) ) {
            $vin = sanitize_text_field( $vin );
            if ( ! isset( $vin_groups[ $vin ] ) ) {
                $vin_groups[ $vin ] = array();
            }
            $vin_groups[ $vin ][] = array(
                'id' => $vehicle->ID,
                'title' => $vehicle->post_title,
                'slug' => $vehicle->post_name,
                'vin' => $vin,
                'status' => $vehicle->post_status
            );
        }
    }

    // Find duplicates (VINs with more than one vehicle)
    $duplicates = array();
    foreach ( $vin_groups as $vin => $posts ) {
        if ( count( $posts ) > 1 ) {
            $duplicates[] = array(
                'vin' => $vin,
                'posts' => $posts
            );
        }
    }

    wp_send_json_success( array(
        'duplicates' => $duplicates,
        'total_groups' => count( $duplicates )
    ) );
});

// AJAX handler to delete duplicate vehicles
add_action( 'wp_ajax_delete_vehicle_duplicates', function() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error( array( 'message' => 'Permission denied.' ) );
    }

    $duplicate_ids = $_POST['duplicate_ids'] ?? array();
    
    if ( empty( $duplicate_ids ) || ! is_array( $duplicate_ids ) ) {
        wp_send_json_error( array( 'message' => 'No duplicate IDs provided.' ) );
    }

    $deleted_count = 0;
    $errors = array();

    foreach ( $duplicate_ids as $post_id ) {
        $post_id = intval( $post_id );
        
        // Verify this is a vehicle post
        $post = get_post( $post_id );
        if ( ! $post || $post->post_type !== 'vehicle' ) {
            $errors[] = "Invalid post ID: {$post_id}";
            continue;
        }

        // Delete the post
        $result = wp_delete_post( $post_id, true );
        if ( $result ) {
            $deleted_count++;
        } else {
            $errors[] = "Failed to delete post ID: {$post_id}";
        }
    }

    $message = "Successfully deleted {$deleted_count} duplicate vehicle(s).";
    if ( ! empty( $errors ) ) {
        $message .= " Errors: " . implode( ', ', $errors );
    }

    wp_send_json_success( array(
        'message' => $message,
        'deleted_count' => $deleted_count,
        'errors' => $errors
    ) );
});