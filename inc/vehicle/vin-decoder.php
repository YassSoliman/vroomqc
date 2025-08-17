<?php
/**
 * VIN Decoder functionality for Vehicle post type
 *
 * @package vroomqc
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Add VIN lookup functionality to admin
add_action( 'acf/input/admin_footer', function() {
    // Add nonce for AJAX
    wp_nonce_field( 'vin_lookup_nonce', 'vin_lookup_nonce' );
    ?>
    <script>
    jQuery(document).ready(function($) {
        // Only run on vehicle post type
        if (!$('body').hasClass('post-type-vehicle')) {
            return;
        }

        // Get the VIN field wrapper
        const $fieldWrapper = $('.acf-field[data-name="vin"]');
        const $vinField = $fieldWrapper.find('input[type="text"]');

        // Add lookup button after the input
        $vinField.after(`
            <div class="acf-vin-input-wrapper">
                <button type="button" class="button acf-vin-lookup">
                    <span class="dashicons dashicons-search"></span>
                    Lookup Vehicle
                </button>
            </div>
            <div class="acf-vin-response" style="display:none;">
                <pre class="acf-vin-response-content"></pre>
            </div>
        `);

        // Function to generate vehicle title
        function generateVehicleTitle(data) {
            const parts = [];
            
            // Add year if available
            if (data.ModelYear) {
                parts.push(data.ModelYear);
            }
            
            // Add make if available
            if (data.Make) {
                parts.push(data.Make.split(' ').map(word => 
                    word.charAt(0).toUpperCase() + word.slice(1).toLowerCase()
                ).join(' '));
            }
            
            // Add model if available
            if (data.Model) {
                parts.push(data.Model.split(' ').map(word => 
                    word.charAt(0).toUpperCase() + word.slice(1).toLowerCase()
                ).join(' '));
            }
            
            // Add trim if available (keep as-is from API)
            if (data.Trim || data.Series) {
                parts.push(data.Trim || data.Series);
            }
            
            // Add engine info if available
            if (data.DisplacementL && data.EngineCylinders) {
                parts.push(`${parseFloat(data.DisplacementL).toFixed(1)}L ${data.EngineCylinders}cyl`);
            }
            
            // Add transmission if available
            if (data.TransmissionStyle) {
                parts.push(data.TransmissionStyle.split(' ').map(word => 
                    word.charAt(0).toUpperCase() + word.slice(1).toLowerCase()
                ).join(' '));
            }
            
            return parts.join(' ');
        }

        // Function to normalize text
        function normalizeText(text, field) {
            // Keep manufacturer as-is
            if (field === 'manufacturer') {
                return text;
            }
            
            // Special handling for body style
            if (field === 'body-style') {
                const bodyStyles = {
                    'Convertible/cabriolet': 'Convertible',
                    'Sedan/saloon': 'Sedan',
                    'Sport utility vehicle (suv)/multi-purpose vehicle (mpv)': 'SUV',
                    'Hatchback/Liftback/Notchback': 'Hatchback'
                };
                
                // Check for exact matches first (case-insensitive)
                const textLower = text.toLowerCase();
                for (const [original, normalized] of Object.entries(bodyStyles)) {
                    if (textLower === original.toLowerCase()) {
                        return normalized;
                    }
                }
                
                // If no exact match, return as is
                return text;
            }
            
            // Special handling for transmission
            if (field === 'transmission') {
                if (text.toLowerCase() === 'continuously variable transmission (cvt)') {
                    return 'CVT';
                }
                return text;
            }

            // Special handling for drivetrain
            if (field === 'drivetrain') {
                const drivetrains = {
                    'AWD/All-Wheel Drive': 'AWD',
                    'RWD/Rear-Wheel Drive': 'RWD',
                    '4WD/4-Wheel Drive/4x4': '4WD',
                    'FWD/Front-Wheel Drive': 'FWD'
                };
                
                // Check for exact matches first (case-insensitive)
                const textLower = text.toLowerCase();
                for (const [original, normalized] of Object.entries(drivetrains)) {
                    if (textLower === original.toLowerCase()) {
                        return normalized;
                    }
                }
                
                // If no exact match, return as is
                return text;
            }
            
            // Special handling for colors
            if (field === 'exterior-color' || field === 'interior-color') {
                return text.charAt(0).toUpperCase() + text.slice(1).toLowerCase();
            }
            
            // Default normalization for other fields
            return text.charAt(0).toUpperCase() + text.slice(1).toLowerCase();
        }

        // Function to handle taxonomy term creation/selection
        async function handleTaxonomyTerm(taxonomy, termName) {
            // Normalize the term name based on field type
            termName = normalizeText(termName, taxonomy);
            
            console.log(`Processing taxonomy ${taxonomy} with term:`, termName);

            // Try different selectors to find the taxonomy field
            let $taxField = $(`.acf-field-taxonomy[data-taxonomy="${taxonomy}"]`);
            if (!$taxField.length) {
                $taxField = $(`.acf-field[data-name="${taxonomy}"]`);
            }
            if (!$taxField.length) {
                $taxField = $(`.acf-field[data-key*="${taxonomy}"]`);
            }

            if (!$taxField.length) {
                console.log(`Taxonomy field not found: ${taxonomy}`);
                return;
            }

            console.log(`Found taxonomy field for ${taxonomy}:`, {
                element: $taxField,
                attributes: {
                    taxonomy: $taxField.attr('data-taxonomy'),
                    name: $taxField.attr('data-name'),
                    key: $taxField.attr('data-key')
                }
            });

            // Get the select2 instance or input
            let $select = $taxField.find('select');
            if (!$select.length) {
                $select = $taxField.find('input[type="text"]');
            }
            if (!$select.length) {
                console.log(`No select/input found for taxonomy: ${taxonomy}`);
                return;
            }

            // For select2 fields
            if ($select.hasClass('select2-hidden-accessible')) {
                // Check if term exists in select options
                let $option = $select.find(`option:contains("${termName}")`);
                if ($option.length) {
                    console.log(`Found existing term for ${taxonomy}:`, termName);
                    $select.val($option.val()).trigger('change');
                } else {
                    // Create new term via AJAX
                    try {
                        console.log(`Creating new term for ${taxonomy}:`, termName);
                        const response = await $.ajax({
                            url: ajaxurl,
                            type: 'POST',
                            data: {
                                action: 'create_taxonomy_term',
                                nonce: $('#vin_lookup_nonce').val(),
                                taxonomy: taxonomy,
                                term_name: termName
                            }
                        });

                        if (response.success && response.data.term_id) {
                            console.log(`Created term for ${taxonomy}:`, response.data);
                            const newOption = new Option(termName, response.data.term_id, true, true);
                            $select.append(newOption).trigger('change');
                        }
                    } catch (error) {
                        console.error(`Error creating term for ${taxonomy}:`, error);
                    }
                }
            } else {
                // For text input fields
                console.log(`Setting text value for ${taxonomy}:`, termName);
                $select.val(termName).trigger('change');
            }
        }

        // Function to handle VIN lookup
        async function lookupVIN(vin) {
            const $response = $fieldWrapper.find('.acf-vin-response');
            const $content = $fieldWrapper.find('.acf-vin-response-content');
            
            // Show loading state
            $response.show().removeClass('error success');
            $content.html('Looking up VIN...');
            
            try {
                const response = await $.ajax({
                    url: `https://vpic.nhtsa.dot.gov/api/vehicles/decodevinvalues/${vin}?format=json`,
                    method: 'GET'
                });

                if (response.Results && response.Results[0]) {
                    const data = response.Results[0];
                    
                    if (data.ErrorCode === '0') {
                        // Generate and update the title
                        const title = generateVehicleTitle(data);
                        console.log('Generated title:', title);
                        
                        // Update the title via AJAX
                        $.ajax({
                            url: ajaxurl,
                            type: 'POST',
                            data: {
                                action: 'update_vehicle_title',
                                nonce: $('#vin_lookup_nonce').val(),
                                post_id: $('#post_ID').val(),
                                title: title
                            },
                            success: function(response) {
                                if (response.success) {
                                    // Update the title field in the UI
                                    $('#title').val(response.data.title);
                                    $('#title-prompt-text').hide();
                                    console.log('Title updated successfully');
                                }
                            }
                        });

                        // Update the slug via AJAX
                        $.ajax({
                            url: ajaxurl,
                            type: 'POST',
                            data: {
                                action: 'update_vehicle_slug',
                                nonce: $('#vin_lookup_nonce').val(),
                                post_id: $('#post_ID').val(),
                                vin: vin
                            },
                            success: function(response) {
                                if (response.success) {
                                    console.log('Slug updated successfully to:', response.data.slug);
                                    // Update the slug field in the UI if it exists
                                    if ($('#post_name').length) {
                                        $('#post_name').val(response.data.slug);
                                    }
                                    // Update the permalink sample if it exists
                                    if ($('#sample-permalink').length) {
                                        $('#sample-permalink').html($('#sample-permalink').html().replace(/\/[^\/]*\/$/, '/' + response.data.slug + '/'));
                                    }
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('Slug update error:', error);
                            }
                        });

                        // Handle taxonomy fields first
                        const taxonomyFields = {
                            'make': { value: data.Make, taxonomy: 'make' },
                            'model': { value: data.Model, taxonomy: 'model' },
                            'trim': { value: data.Trim || data.Series, taxonomy: 'trim' },
                            'body-style': { value: data.BodyClass, taxonomy: 'body-style' },
                            'transmission': { value: data.TransmissionStyle, taxonomy: 'transmission' },
                            'cylinder': { value: data.EngineCylinders, taxonomy: 'cylinder' },
                            'fuel-type': { value: data.FuelTypePrimary, taxonomy: 'fuel-type' },
                            'manufacturer': { value: data.Manufacturer, taxonomy: 'manufacturer' },
                            'drivetrain': { value: data.DriveType, taxonomy: 'drivetrain' }
                        };

                        // Process taxonomy fields
                        for (const [field, info] of Object.entries(taxonomyFields)) {
                            if (info.value) {
                                console.log(`Processing taxonomy ${field} with value:`, info.value);
                                await handleTaxonomyTerm(info.taxonomy, info.value);
                            }
                        }

                        // Handle number/text fields
                        const numberFields = {
                            'year': { value: data.ModelYear, type: 'number' },
                            'doors': { value: data.Doors, type: 'number' },
                            'displacementL': { value: data.DisplacementL, type: 'number' },
                            'cylinder': { value: data.EngineCylinders, type: 'number' }
                        };

                        // Process number fields
                        for (const [field, info] of Object.entries(numberFields)) {
                            if (info.value) {
                                // Try different selectors to find the field
                                let $field = $(`[name*="acf[${field}]"]`);
                                if (!$field.length) {
                                    $field = $(`.acf-field[data-name="${field}"] input`);
                                }
                                if (!$field.length) {
                                    $field = $(`.acf-field[data-key*="${field}"] input`);
                                }

                                if ($field.length) {
                                    console.log(`Setting ${field} to:`, info.value);
                                    
                                    // For number fields, ensure we're setting a number
                                    const value = info.type === 'number' ? parseFloat(info.value) : info.value;
                                    
                                    // Set the value
                                    $field.val(value);
                                    
                                    // Trigger necessary events
                                    $field.trigger('change');
                                    $field.trigger('input');
                                    
                                    // If it's a select2 field, update it
                                    if ($field.hasClass('select2-hidden-accessible')) {
                                        $field.select2('val', value);
                                    }
                                    
                                    // If the field is within a wrapper, also update the wrapper
                                    const $wrapper = $field.closest('.acf-input-wrap');
                                    if ($wrapper.length) {
                                        $wrapper.find('input, select').val(value).trigger('change');
                                    }
                                } else {
                                    console.log(`Field not found: ${field}`);
                                }
                            }
                        }

                        // Handle combined engine field
                        if (data.DisplacementL && data.EngineCylinders) {
                            const engineValue = `${data.DisplacementL}L ${data.EngineCylinders}cyl`;
                            
                            // Try different selectors to find the engine field
                            let $engineField = $(`[name*="acf[engine]"]`);
                            if (!$engineField.length) {
                                $engineField = $(`.acf-field[data-name="engine"] input`);
                            }
                            if (!$engineField.length) {
                                $engineField = $(`.acf-field[data-key*="engine"] input`);
                            }

                            if ($engineField.length) {
                                console.log('Setting engine to:', engineValue);
                                
                                // Set the value
                                $engineField.val(engineValue);
                                
                                // Trigger necessary events
                                $engineField.trigger('change');
                                $engineField.trigger('input');
                            }
                        }

                        // Format display info
                        const vehicleInfo = [
                            `Make: ${normalizeText(data.Make, 'make')}`,
                            `Model: ${normalizeText(data.Model, 'model')}`,
                            `Year: ${data.ModelYear || 'N/A'}`,
                            `Trim: ${normalizeText(data.Trim || data.Series, 'trim')}`,
                            `Body Style: ${normalizeText(data.BodyClass, 'body-style')}`,
                            `Engine: ${data.DisplacementL ? `${data.DisplacementL}L ${data.EngineCylinders}cyl` : 'N/A'}`,
                            `Transmission: ${normalizeText(data.TransmissionStyle, 'transmission')}`,
                            `Drivetrain: ${normalizeText(data.DriveType, 'drivetrain')}`,
                            `Fuel Type: ${normalizeText(data.FuelTypePrimary, 'fuel-type')}`,
                            `Manufacturer: ${normalizeText(data.Manufacturer, 'manufacturer')}`
                        ].filter(line => !line.includes('N/A')).join('\n');
                        
                        $content.html(vehicleInfo);
                        $response.addClass('success').removeClass('error');
                    } else {
                        $content.html('Invalid VIN number');
                        $response.addClass('error').removeClass('success');
                    }
                } else {
                    $content.html('Error: Could not decode VIN');
                    $response.addClass('error').removeClass('success');
                }
            } catch (error) {
                console.error('VIN lookup error:', error);
                $content.html('Error: Could not connect to VIN lookup service');
                $response.addClass('error').removeClass('success');
            }
        }
        
        // Handle lookup button click
        $fieldWrapper.on('click', '.acf-vin-lookup', function(e) {
            e.preventDefault();
            const vin = $vinField.val().trim();
            
            if (vin.length === 17) {
                lookupVIN(vin);
            } else {
                const $response = $fieldWrapper.find('.acf-vin-response');
                const $content = $fieldWrapper.find('.acf-vin-response-content');
                
                $response.show().addClass('error').removeClass('success');
                $content.html('Please enter a valid 17-character VIN');
            }
        });
        
        // Handle input enter key
        $vinField.on('keypress', function(e) {
            if (e.which === 13) {
                e.preventDefault();
                $fieldWrapper.find('.acf-vin-lookup').click();
            }
        });
    });
    </script>
    <style>
        .acf-field-vin-first {
            order: -1 !important;
        }
        .post-type-vehicle .acf-field-vin-first {
            margin-top: 0 !important;
        }
        .acf-vin-input-wrapper {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-top: 10px;
        }
        .acf-vin-lookup {
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 0 12px;
            height: 30px;
        }
        .acf-vin-lookup .dashicons {
            font-size: 16px;
            width: 16px;
            height: 16px;
        }
        .acf-vin-response {
            margin-top: 10px;
            padding: 10px;
            background: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .acf-vin-response-content {
            margin: 0;
            font-size: 13px;
            line-height: 1.4;
            white-space: pre-wrap;
        }
        .acf-vin-response.error {
            border-color: #dc3232;
            color: #dc3232;
        }
        .acf-vin-response.success {
            border-color: #46b450;
            color: #46b450;
        }
    </style>
    <?php
});

// AJAX handler for term creation
add_action( 'wp_ajax_create_taxonomy_term', function() {
    check_ajax_referer( 'vin_lookup_nonce', 'nonce' );
    
    $taxonomy = sanitize_text_field( $_POST['taxonomy'] );
    $term_name = sanitize_text_field( $_POST['term_name'] );
    
    // Use helper function from helpers.php
    $term_id = vroomqc_ensure_taxonomy_term( $taxonomy, $term_name );
    
    wp_send_json_success( array(
        'term_id' => $term_id,
        'term_name' => $term_name
    ) );
});

// Add AJAX handler for title update
add_action( 'wp_ajax_update_vehicle_title', function() {
    check_ajax_referer( 'vin_lookup_nonce', 'nonce' );
    
    $post_id = intval( $_POST['post_id'] );
    $title = sanitize_text_field( $_POST['title'] );
    
    if ( $post_id && current_user_can( 'edit_post', $post_id ) ) {
        wp_update_post( array(
            'ID' => $post_id,
            'post_title' => $title
        ) );
        wp_send_json_success( array( 'title' => $title ) );
    }
    
    wp_send_json_error( 'Failed to update title' );
});

// Add AJAX handler for slug update
add_action( 'wp_ajax_update_vehicle_slug', function() {
    check_ajax_referer( 'vin_lookup_nonce', 'nonce' );
    
    $post_id = intval( $_POST['post_id'] );
    $vin = sanitize_text_field( $_POST['vin'] );
    
    if ( $post_id && $vin && current_user_can( 'edit_post', $post_id ) ) {
        // Generate slug from VIN (convert to lowercase for consistency)
        $slug = sanitize_title( strtolower( $vin ) );
        
        wp_update_post( array(
            'ID' => $post_id,
            'post_name' => $slug
        ) );
        wp_send_json_success( array( 'slug' => $slug ) );
    }
    
    wp_send_json_error( 'Failed to update slug' );
});