<?php
/**
 * Vehicle Helper Functions
 *
 * @package vroomqc
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Helper to update ACF field or fallback to post meta if ACF not available
 */
if ( ! function_exists( 'vroomqc_set_acf_field' ) ) {
    function vroomqc_set_acf_field( $field_key, $value, $post_id ) {
        if ( function_exists( 'update_field' ) ) {
            // Use call_user_func to avoid static analysis complaining about undefined function
            call_user_func( 'update_field', $field_key, $value, $post_id );
        } else {
            update_post_meta( $post_id, $field_key, $value );
        }
    }
}

/**
 * Function to ensure taxonomy term exists
 */
if ( ! function_exists( 'vroomqc_ensure_taxonomy_term' ) ) {
    function vroomqc_ensure_taxonomy_term( $taxonomy, $term_name ) {
        // Normalize term name based on taxonomy type
        if ( $taxonomy === 'manufacturer' ) {
            // Keep manufacturer as-is
            $normalized_name = $term_name;
        } elseif ( $taxonomy === 'body-style' ) {
            // Normalize body styles
            $body_styles = array(
                'Convertible/cabriolet' => 'Convertible',
                'Sedan/saloon' => 'Sedan',
                'Sport utility vehicle (suv)/multi-purpose vehicle (mpv)' => 'SUV',
                'Hatchback/Liftback/Notchback' => 'Hatchback',
            );
            
            // Check for exact matches first (case-insensitive)
            $term_lower = strtolower( $term_name );
            foreach ( $body_styles as $original => $normalized ) {
                if ( $term_lower === strtolower( $original ) ) {
                    $normalized_name = $normalized;
                    break;
                }
            }
            // If no match found, use original
            if ( ! isset( $normalized_name ) ) {
                $normalized_name = $term_name;
            }
        } elseif ( $taxonomy === 'transmission' ) {
            // Normalize transmission
            if ( strtolower( $term_name ) === 'continuously variable transmission (cvt)' ) {
                $normalized_name = 'CVT';
            } else {
                $normalized_name = $term_name;
            }
        } elseif ( $taxonomy === 'drivetrain' ) {
            // Normalize drivetrain
            $drivetrains = array(
                'AWD/All-Wheel Drive' => 'AWD',
                'RWD/Rear-Wheel Drive' => 'RWD',
                '4WD/4-Wheel Drive/4x4' => '4WD',
                'FWD/Front-Wheel Drive' => 'FWD'
            );
            
            // Check for exact matches first (case-insensitive)
            $term_lower = strtolower( $term_name );
            foreach ( $drivetrains as $original => $normalized ) {
                if ( $term_lower === strtolower( $original ) ) {
                    $normalized_name = $normalized;
                    break;
                }
            }
            // If no match found, use original
            if ( ! isset( $normalized_name ) ) {
                $normalized_name = $term_name;
            }
        } elseif ( $taxonomy === 'exterior-color' || $taxonomy === 'interior-color' ) {
            // Normalize colors (first letter uppercase, rest lowercase)
            $normalized_name = ucfirst( strtolower( $term_name ) );
        } else {
            // Default normalization for other fields (first letter uppercase, rest lowercase)
            $normalized_name = ucfirst( strtolower( $term_name ) );
        }
        
        // Check if term exists
        $existing_term = get_term_by( 'name', $normalized_name, $taxonomy );
        if ( $existing_term ) {
            return $existing_term->term_id;
        }
        
        // Create new term
        $result = wp_insert_term( $normalized_name, $taxonomy );
        if ( ! is_wp_error( $result ) ) {
            return $result['term_id'];
        }
        
        return false;
    }
}

/**
 * Function to generate vehicle title with normalized values
 */
if ( ! function_exists( 'vroomqc_generate_vehicle_title' ) ) {
    function vroomqc_generate_vehicle_title( $data ) {
        $parts = array();
        
        // Add year if available
        if ( ! empty( $data['ModelYear'] ) ) {
            $parts[] = $data['ModelYear'];
        }
        
        // Add make if available (normalized)
        if ( ! empty( $data['Make'] ) ) {
            $parts[] = ucfirst( strtolower( $data['Make'] ) );
        }
        
        // Add model if available (normalized)
        if ( ! empty( $data['Model'] ) ) {
            $parts[] = ucfirst( strtolower( $data['Model'] ) );
        }
        
        // Add trim if available (keep as-is)
        if ( ! empty( $data['Trim'] ) || ! empty( $data['Series'] ) ) {
            $parts[] = $data['Trim'] ?? $data['Series'];
        }
        
        // Add engine info if available
        if ( ! empty( $data['DisplacementL'] ) && ! empty( $data['EngineCylinders'] ) ) {
            $parts[] = sprintf( "%.1fL %dcyl", 
                floatval( $data['DisplacementL'] ), 
                intval( $data['EngineCylinders'] )
            );
        }
        
        // Add transmission if available (normalized)
        if ( ! empty( $data['TransmissionStyle'] ) ) {
            if ( strtolower( $data['TransmissionStyle'] ) === 'continuously variable transmission (cvt)' ) {
                $parts[] = 'CVT';
            } else {
                $parts[] = $data['TransmissionStyle'];
            }
        }
        
        return implode( ' ', $parts );
    }
}

/**
 * Get vehicle image with proper fallback logic
 * 1. First check vehicle gallery for images
 * 2. If no gallery, check featured image  
 * 3. If no featured image, use fallback (ID: 4103)
 */
if ( ! function_exists( 'vroomqc_get_vehicle_image' ) ) {
    function vroomqc_get_vehicle_image( $vehicle_id, $size = 'large' ) {
        // First try to get from vehicle gallery
        $gallery = get_field( 'vehicle_gallery', $vehicle_id );
        if ( ! empty( $gallery ) && is_array( $gallery ) ) {
            $first_image = $gallery[0];
            if ( ! empty( $first_image['sizes'][$size] ) ) {
                return array(
                    'url' => $first_image['sizes'][$size],
                    'alt' => $first_image['alt'] ?: vroomqc_get_vehicle_title( $vehicle_id )
                );
            } elseif ( ! empty( $first_image['url'] ) ) {
                return array(
                    'url' => $first_image['url'],
                    'alt' => $first_image['alt'] ?: vroomqc_get_vehicle_title( $vehicle_id )
                );
            }
        }
        
        // If no gallery, try featured image
        $featured_id = get_post_thumbnail_id( $vehicle_id );
        if ( $featured_id ) {
            $featured_url = wp_get_attachment_image_url( $featured_id, $size );
            if ( $featured_url ) {
                return array(
                    'url' => $featured_url,
                    'alt' => get_post_meta( $featured_id, '_wp_attachment_image_alt', true ) ?: vroomqc_get_vehicle_title( $vehicle_id )
                );
            }
        }
        
        // If no featured image, use fallback (ID: 4103)
        $fallback_url = wp_get_attachment_image_url( 4103, $size );
        if ( $fallback_url ) {
            return array(
                'url' => $fallback_url,
                'alt' => get_post_meta( 4103, '_wp_attachment_image_alt', true ) ?: vroomqc_get_vehicle_title( $vehicle_id )
            );
        }
        
        // Final fallback to default image
        return array(
            'url' => get_template_directory_uri() . '/assets/images/inventory/products/product_01.jpg',
            'alt' => vroomqc_get_vehicle_title( $vehicle_id )
        );
    }
}