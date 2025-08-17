<?php
/**
 * Homepage Top Picks Filter AJAX Handlers
 * 
 * Handles AJAX requests for filtering vehicles on the homepage
 *
 * @package vroomqc
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Filter homepage vehicles via AJAX
 */
function vroomqc_filter_homepage_vehicles() {
    check_ajax_referer( 'vroomqc_filter_nonce', 'nonce' );
    
    $category = isset( $_POST['category'] ) ? sanitize_text_field( $_POST['category'] ) : 'all';
    
    // Log incoming data for debugging
    error_log( '🏠 VROOMQC Homepage Filter Request: ' . $category );
    
    $result = vroomqc_get_filtered_homepage_vehicles( $category );
    
    error_log( '📊 VROOMQC Homepage Filter Result: Found ' . count( $result['vehicles'] ) . ' vehicles' );
    
    wp_send_json_success( $result );
}
add_action( 'wp_ajax_filter_homepage_vehicles', 'vroomqc_filter_homepage_vehicles' );
add_action( 'wp_ajax_nopriv_filter_homepage_vehicles', 'vroomqc_filter_homepage_vehicles' );

/**
 * Get filtered vehicles for homepage based on category
 */
function vroomqc_get_filtered_homepage_vehicles( $category = 'all' ) {
    $posts_per_page = 6;
    
    // Base query args
    $args = array(
        'post_type' => 'vehicle',
        'posts_per_page' => $posts_per_page,
        'post_status' => 'publish',
        'meta_query' => array(
            array(
                'key' => 'vendu',
                'value' => '0',
                'compare' => '='
            )
        )
    );
    
    // Add category-specific filtering
    switch ( $category ) {
        case 'suv':
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'body-style',
                    'field' => 'slug',
                    'terms' => 'suv'
                )
            );
            break;
            
        case 'sedan':
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'body-style',
                    'field' => 'slug',
                    'terms' => 'sedan'
                )
            );
            break;
            
        case 'hybrid':
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'fuel-type',
                    'field' => 'slug',
                    'terms' => array( 'hybrid', 'electric' )
                )
            );
            break;
            
        case 'up-to-15k':
            $args['meta_query'][] = array(
                'key' => 'price',
                'value' => 15000,
                'type' => 'NUMERIC',
                'compare' => '<='
            );
            $args['meta_query']['relation'] = 'AND';
            break;
            
        case 'awd':
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'drivetrain',
                    'field' => 'slug',
                    'terms' => array( 'awd', '4wd', 'all-wheel-drive', '4-wheel-drive' )
                )
            );
            break;
            
        case 'new':
            // New arrivals - last 30 days or most recent
            $args['date_query'] = array(
                array(
                    'after' => '30 days ago'
                )
            );
            $args['orderby'] = 'date';
            $args['order'] = 'DESC';
            break;
            
        case 'fuel-efficient':
            // Fuel efficient - hybrid, electric, or high MPG
            $args['tax_query'] = array(
                'relation' => 'OR',
                array(
                    'taxonomy' => 'fuel-type',
                    'field' => 'slug',
                    'terms' => array( 'hybrid', 'electric' )
                )
            );
            break;
            
        case 'more':
            // Redirect to inventory page
            wp_send_json_success( array( 
                'redirect' => get_permalink( 582 )
            ) );
            return;
            
        case 'all':
        default:
            // Show all vehicles, no additional filtering
            $args['orderby'] = 'date';
            $args['order'] = 'DESC';
            break;
    }
    
    // Execute query
    $query = new WP_Query( $args );
    
    // Generate vehicles HTML
    $vehicles_html = '';
    $vehicles_data = array();
    
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            
            // Get vehicle card HTML
            ob_start();
            set_query_var( 'vehicle_id', get_the_ID() );
            set_query_var( 'card_class', '_show' );
            get_template_part( 'template-parts/vehicle/card' );
            $vehicle_html = ob_get_clean();
            
            $vehicles_data[] = array(
                'id' => get_the_ID(),
                'html' => $vehicle_html
            );
        }
        wp_reset_postdata();
    }
    
    // Generate explore more link data
    $explore_more_data = vroomqc_get_explore_more_data( $category );
    
    return array(
        'vehicles' => $vehicles_data,
        'category' => $category,
        'count' => count( $vehicles_data ),
        'explore_more' => $explore_more_data
    );
}

/**
 * Get explore more link data based on category
 */
function vroomqc_get_explore_more_data( $category ) {
    $base_url = get_permalink( 582 );
    
    switch ( $category ) {
        case 'suv':
            return array(
                'text' => __( 'Explore more SUV', 'vroomqc' ),
                'url' => $base_url . '?body-style=suv'
            );
            
        case 'sedan':
            return array(
                'text' => __( 'Explore more Sedan', 'vroomqc' ),
                'url' => $base_url . '?body-style=sedan'
            );
            
        case 'hybrid':
            return array(
                'text' => __( 'Explore more Hybrid', 'vroomqc' ),
                'url' => $base_url . '?fuel-type=hybrid'
            );
            
        case 'up-to-15k':
            return array(
                'text' => __( 'Explore more Budget', 'vroomqc' ),
                'url' => $base_url . '?price_max=15000'
            );
            
        case 'awd':
            return array(
                'text' => __( 'Explore more AWD', 'vroomqc' ),
                'url' => $base_url . '?drivetrain=awd'
            );
            
        case 'new':
            return array(
                'text' => __( 'Explore more New arrivals', 'vroomqc' ),
                'url' => $base_url . '?sort=newest'
            );
            
        case 'fuel-efficient':
            return array(
                'text' => __( 'Explore more Fuel efficient', 'vroomqc' ),
                'url' => $base_url . '?fuel-type=hybrid'
            );
            
        case 'all':
        default:
            return array(
                'text' => __( 'Explore more SUV', 'vroomqc' ),
                'url' => $base_url . '?body-style=suv'
            );
    }
}