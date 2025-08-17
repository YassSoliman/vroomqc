<?php
/**
 * Vehicle Filter AJAX Handlers
 * 
 * Handles AJAX requests for vehicle filtering, sorting, and pagination
 *
 * @package vroomqc
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Filter vehicles via AJAX
 */
function vroomqc_filter_vehicles() {
    check_ajax_referer( 'vroomqc_filter_nonce', 'nonce' );
    
    $page = isset( $_POST['page'] ) ? intval( $_POST['page'] ) : 1;
    $search = isset( $_POST['search'] ) ? sanitize_text_field( $_POST['search'] ) : '';
    $sort = isset( $_POST['sort'] ) ? sanitize_text_field( $_POST['sort'] ) : 'newest';
    $filters = isset( $_POST['filters'] ) ? $_POST['filters'] : array();
    
    // Log incoming data for debugging
    error_log( '🔍 VROOMQC Filter Request: ' . print_r( array(
        'page' => $page,
        'search' => $search,
        'sort' => $sort,
        'filters_raw' => $filters
    ), true ) );
    
    // Sanitize filters
    $sanitized_filters = array();
    foreach ( $filters as $key => $value ) {
        if ( is_array( $value ) ) {
            $sanitized_filters[ sanitize_key( $key ) ] = array_map( 'sanitize_text_field', $value );
        } else {
            $sanitized_filters[ sanitize_key( $key ) ] = sanitize_text_field( $value );
        }
    }
    
    error_log( '🧹 VROOMQC Sanitized Filters: ' . print_r( $sanitized_filters, true ) );
    
    $result = vroomqc_get_filtered_vehicles( $page, $search, $sort, $sanitized_filters );
    
    error_log( '📊 VROOMQC Filter Result: Found ' . $result['total_vehicles'] . ' vehicles' );
    
    wp_send_json_success( $result );
}
add_action( 'wp_ajax_filter_vehicles', 'vroomqc_filter_vehicles' );
add_action( 'wp_ajax_nopriv_filter_vehicles', 'vroomqc_filter_vehicles' );

/**
 * Get filtered vehicles with pagination
 */
function vroomqc_get_filtered_vehicles( $page = 1, $search = '', $sort = 'newest', $filters = array() ) {
    $posts_per_page = 15;
    
    // Base query args
    $args = array(
        'post_type' => 'vehicle',
        'posts_per_page' => $posts_per_page,
        'paged' => $page,
        'post_status' => 'publish',
        'meta_query' => array(
            array(
                'key' => 'vendu',
                'value' => '0',
                'compare' => '='
            )
        )
    );
    
    // Add search
    if ( ! empty( $search ) ) {
        $args['s'] = $search;
    }
    
    // Add sorting
    switch ( $sort ) {
        case 'price_low':
            $args['meta_key'] = 'price';
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'ASC';
            break;
        case 'price_high':
            $args['meta_key'] = 'price';
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'DESC';
            break;
        case 'mileage_low':
            $args['meta_key'] = 'mileage';
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'ASC';
            break;
        case 'mileage_high':
            $args['meta_key'] = 'mileage';
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'DESC';
            break;
        case 'year_new':
            $args['meta_key'] = 'year';
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'DESC';
            break;
        case 'year_old':
            $args['meta_key'] = 'year';
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'ASC';
            break;
        case 'newest':
        default:
            $args['orderby'] = 'date';
            $args['order'] = 'DESC';
            break;
    }
    
    // Add taxonomy filters
    $tax_query = array();
    $taxonomies = array( 'make', 'model', 'body-style', 'transmission', 'drivetrain', 'fuel-type', 'trim', 'cylinder', 'exterior-color', 'interior-color' );
    
    foreach ( $taxonomies as $taxonomy ) {
        if ( isset( $filters[ $taxonomy ] ) && ! empty( $filters[ $taxonomy ] ) ) {
            $tax_query[] = array(
                'taxonomy' => $taxonomy,
                'field' => 'slug',
                'terms' => is_array( $filters[ $taxonomy ] ) ? $filters[ $taxonomy ] : array( $filters[ $taxonomy ] ),
                'operator' => 'IN'
            );
        }
    }
    
    if ( ! empty( $tax_query ) ) {
        $tax_query['relation'] = 'AND';
        $args['tax_query'] = $tax_query;
    }
    
    // Add price range filter
    if ( isset( $filters['price_min'] ) || isset( $filters['price_max'] ) ) {
        $price_query = array(
            'key' => 'price',
            'type' => 'NUMERIC',
            'compare' => 'BETWEEN'
        );
        
        $min = isset( $filters['price_min'] ) ? intval( $filters['price_min'] ) : 0;
        $max = isset( $filters['price_max'] ) ? intval( $filters['price_max'] ) : 999999;
        
        $price_query['value'] = array( $min, $max );
        $args['meta_query'][] = $price_query;
        $args['meta_query']['relation'] = 'AND';
    }
    
    // Add mileage range filter
    if ( isset( $filters['mileage_min'] ) || isset( $filters['mileage_max'] ) ) {
        $mileage_query = array(
            'key' => 'mileage',
            'type' => 'NUMERIC',
            'compare' => 'BETWEEN'
        );
        
        $min = isset( $filters['mileage_min'] ) ? intval( $filters['mileage_min'] ) : 0;
        $max = isset( $filters['mileage_max'] ) ? intval( $filters['mileage_max'] ) : 999999;
        
        $mileage_query['value'] = array( $min, $max );
        $args['meta_query'][] = $mileage_query;
        $args['meta_query']['relation'] = 'AND';
    }
    
    // Add year range filter
    if ( isset( $filters['year_min'] ) || isset( $filters['year_max'] ) ) {
        $year_query = array(
            'key' => 'year',
            'type' => 'NUMERIC',
            'compare' => 'BETWEEN'
        );
        
        $min = isset( $filters['year_min'] ) ? intval( $filters['year_min'] ) : 1900;
        $max = isset( $filters['year_max'] ) ? intval( $filters['year_max'] ) : date('Y') + 1;
        
        $year_query['value'] = array( $min, $max );
        $args['meta_query'][] = $year_query;
        $args['meta_query']['relation'] = 'AND';
    }
    
    // Execute query
    $query = new WP_Query( $args );
    
    // Get vehicle cards HTML
    $vehicles_html = '';
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            ob_start();
            set_query_var( 'vehicle_id', get_the_ID() );
            get_template_part( 'template-parts/vehicle/card' );
            $vehicles_html .= ob_get_clean();
        }
        wp_reset_postdata();
    }
    
    // Calculate pagination
    $total_pages = $query->max_num_pages;
    $total_vehicles = $query->found_posts;
    $showing_from = ( ( $page - 1 ) * $posts_per_page ) + 1;
    $showing_to = min( $page * $posts_per_page, $total_vehicles );
    
    return array(
        'vehicles' => $vehicles_html,
        'pagination' => vroomqc_generate_pagination( $page, $total_pages ),
        'total_vehicles' => $total_vehicles,
        'showing_from' => $showing_from,
        'taxonomy_counts' => vroomqc_get_taxonomy_counts( $filters ),
        'showing_to' => $showing_to,
        'current_page' => $page,
        'total_pages' => $total_pages
    );
}

/**
 * Generate pagination HTML
 */
function vroomqc_generate_pagination( $current_page, $total_pages ) {
    if ( $total_pages <= 1 ) {
        return '';
    }
    
    $pagination = '<div class="pagination" role="navigation" aria-label="' . esc_attr__( 'Pagination Navigation', 'vroomqc' ) . '">';
    
    // First page button
    if ( $current_page > 1 ) {
        $pagination .= '<button type="button" class="pagination__button pagination__button--first" data-page="1" aria-label="' . esc_attr__( 'Go to first page', 'vroomqc' ) . '">';
        $pagination .= '<span class="pagination__icon">' . vroomqc_get_svg( 'icons/icons-sprite.svg#pagination-first' ) . '</span>';
        $pagination .= '</button>';
    }
    
    // Previous page button
    if ( $current_page > 1 ) {
        $pagination .= '<button type="button" class="pagination__button pagination__button--prev" data-page="' . ( $current_page - 1 ) . '" aria-label="' . esc_attr__( 'Go to previous page', 'vroomqc' ) . '">';
        $pagination .= '<span class="pagination__icon">' . vroomqc_get_svg( 'icons/icons-sprite.svg#pagination-prev' ) . '</span>';
        $pagination .= '</button>';
    }
    
    // Page numbers
    $start = max( 1, $current_page - 2 );
    $end = min( $total_pages, $current_page + 2 );
    
    for ( $i = $start; $i <= $end; $i++ ) {
        $active_class = ( $i === $current_page ) ? ' pagination__button--active' : '';
        $aria_current = ( $i === $current_page ) ? ' aria-current="page"' : '';
        
        $pagination .= '<button type="button" class="pagination__button pagination__button--page' . $active_class . '" data-page="' . $i . '"' . $aria_current . '>';
        $pagination .= '<span class="pagination__text">' . $i . '</span>';
        $pagination .= '</button>';
    }
    
    // Next page button
    if ( $current_page < $total_pages ) {
        $pagination .= '<button type="button" class="pagination__button pagination__button--next" data-page="' . ( $current_page + 1 ) . '" aria-label="' . esc_attr__( 'Go to next page', 'vroomqc' ) . '">';
        $pagination .= '<span class="pagination__icon">' . vroomqc_get_svg( 'icons/icons-sprite.svg#pagination-next' ) . '</span>';
        $pagination .= '</button>';
    }
    
    // Last page button
    if ( $current_page < $total_pages ) {
        $pagination .= '<button type="button" class="pagination__button pagination__button--last" data-page="' . $total_pages . '" aria-label="' . esc_attr__( 'Go to last page', 'vroomqc' ) . '">';
        $pagination .= '<span class="pagination__icon">' . vroomqc_get_svg( 'icons/icons-sprite.svg#pagination-last' ) . '</span>';
        $pagination .= '</button>';
    }
    
    $pagination .= '</div>';
    
    return $pagination;
}

/**
 * Get taxonomy counts based on current filters
 */
function vroomqc_get_taxonomy_counts( $filters = array() ) {
    $taxonomies = array( 'make', 'model', 'body-style', 'transmission', 'drivetrain', 'fuel-type', 'cylinder', 'trim', 'exterior-color', 'interior-color' );
    $counts = array();
    
    foreach ( $taxonomies as $taxonomy ) {
        $counts[ $taxonomy ] = array();
        
        // Get all terms for this taxonomy
        $terms = get_terms( array(
            'taxonomy' => $taxonomy,
            'hide_empty' => true
        ) );
        
        if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
            foreach ( $terms as $term ) {
                // Build query args excluding current taxonomy if it's in filters
                $query_filters = $filters;
                if ( isset( $query_filters[ $taxonomy ] ) ) {
                    unset( $query_filters[ $taxonomy ] );
                }
                
                // Add this specific term to the query
                $query_filters[ $taxonomy ] = array( $term->slug );
                
                $args = array(
                    'post_type' => 'vehicle',
                    'posts_per_page' => -1,
                    'fields' => 'ids',
                    'meta_query' => array(
                        array(
                            'key' => 'vendu',
                            'value' => '0',
                            'compare' => '='
                        )
                    )
                );
                
                // Apply taxonomy filters
                $tax_query = array();
                $taxonomies_list = array( 'make', 'model', 'body-style', 'transmission', 'drivetrain', 'fuel-type', 'cylinder', 'trim', 'exterior-color', 'interior-color' );
                
                foreach ( $query_filters as $filter_key => $filter_values ) {
                    if ( in_array( $filter_key, $taxonomies_list ) && is_array( $filter_values ) && ! empty( $filter_values ) ) {
                        $tax_query[] = array(
                            'taxonomy' => $filter_key,
                            'field' => 'slug',
                            'terms' => $filter_values,
                            'operator' => 'IN'
                        );
                    }
                }
                
                if ( ! empty( $tax_query ) ) {
                    $args['tax_query'] = $tax_query;
                    if ( count( $tax_query ) > 1 ) {
                        $args['tax_query']['relation'] = 'AND';
                    }
                }
                
                // Apply range filters
                // Price range filter
                if ( isset( $query_filters['price_min'] ) || isset( $query_filters['price_max'] ) ) {
                    $price_query = array(
                        'key' => 'price',
                        'type' => 'NUMERIC',
                        'compare' => 'BETWEEN'
                    );
                    
                    $min = isset( $query_filters['price_min'] ) ? intval( $query_filters['price_min'] ) : 0;
                    $max = isset( $query_filters['price_max'] ) ? intval( $query_filters['price_max'] ) : 999999;
                    
                    $price_query['value'] = array( $min, $max );
                    $args['meta_query'][] = $price_query;
                    $args['meta_query']['relation'] = 'AND';
                }
                
                // Mileage range filter
                if ( isset( $query_filters['mileage_min'] ) || isset( $query_filters['mileage_max'] ) ) {
                    $mileage_query = array(
                        'key' => 'mileage',
                        'type' => 'NUMERIC',
                        'compare' => 'BETWEEN'
                    );
                    
                    $min = isset( $query_filters['mileage_min'] ) ? intval( $query_filters['mileage_min'] ) : 0;
                    $max = isset( $query_filters['mileage_max'] ) ? intval( $query_filters['mileage_max'] ) : 999999;
                    
                    $mileage_query['value'] = array( $min, $max );
                    $args['meta_query'][] = $mileage_query;
                    $args['meta_query']['relation'] = 'AND';
                }
                
                // Year range filter
                if ( isset( $query_filters['year_min'] ) || isset( $query_filters['year_max'] ) ) {
                    $year_query = array(
                        'key' => 'year',
                        'type' => 'NUMERIC',
                        'compare' => 'BETWEEN'
                    );
                    
                    $min = isset( $query_filters['year_min'] ) ? intval( $query_filters['year_min'] ) : 1900;
                    $max = isset( $query_filters['year_max'] ) ? intval( $query_filters['year_max'] ) : date('Y') + 1;
                    
                    $year_query['value'] = array( $min, $max );
                    $args['meta_query'][] = $year_query;
                    $args['meta_query']['relation'] = 'AND';
                }
                
                $query = new WP_Query( $args );
                $counts[ $taxonomy ][ $term->slug ] = $query->found_posts;
                wp_reset_postdata();
            }
        }
    }
    
    return $counts;
}

/**
 * Get dynamic filter data
 */
function vroomqc_get_filter_data() {
    check_ajax_referer( 'vroomqc_filter_nonce', 'nonce' );
    
    $result = array(
        'price_range' => vroomqc_get_price_range(),
        'mileage_range' => vroomqc_get_mileage_range(),
        'year_range' => vroomqc_get_year_range(),
        'taxonomies' => vroomqc_get_taxonomy_options()
    );
    
    wp_send_json_success( $result );
}
add_action( 'wp_ajax_get_filter_data', 'vroomqc_get_filter_data' );
add_action( 'wp_ajax_nopriv_get_filter_data', 'vroomqc_get_filter_data' );

/**
 * Get price range from vehicles
 */
function vroomqc_get_price_range() {
    global $wpdb;
    
    $result = $wpdb->get_row( "
        SELECT 
            MIN(CAST(pm1.meta_value AS UNSIGNED)) as min_price,
            MAX(CAST(pm1.meta_value AS UNSIGNED)) as max_price
        FROM {$wpdb->postmeta} pm1
        INNER JOIN {$wpdb->posts} p ON pm1.post_id = p.ID
        INNER JOIN {$wpdb->postmeta} pm2 ON p.ID = pm2.post_id
        WHERE p.post_type = 'vehicle' 
        AND p.post_status = 'publish'
        AND pm1.meta_key = 'price'
        AND pm1.meta_value != ''
        AND pm2.meta_key = 'vendu'
        AND pm2.meta_value = '0'
    " );
    
    $min = 0;
    $max = $result && $result->max_price ? ceil( $result->max_price / 10000 ) * 10000 : 100000;
    
    return array( 'min' => $min, 'max' => $max );
}

/**
 * Get mileage range from vehicles
 */
function vroomqc_get_mileage_range() {
    global $wpdb;
    
    $result = $wpdb->get_row( "
        SELECT 
            MIN(CAST(pm1.meta_value AS UNSIGNED)) as min_mileage,
            MAX(CAST(pm1.meta_value AS UNSIGNED)) as max_mileage
        FROM {$wpdb->postmeta} pm1
        INNER JOIN {$wpdb->posts} p ON pm1.post_id = p.ID
        INNER JOIN {$wpdb->postmeta} pm2 ON p.ID = pm2.post_id
        WHERE p.post_type = 'vehicle' 
        AND p.post_status = 'publish'
        AND pm1.meta_key = 'mileage'
        AND pm1.meta_value != ''
        AND pm2.meta_key = 'vendu'
        AND pm2.meta_value = '0'
    " );
    
    $min = 0;
    $max = $result && $result->max_mileage ? ceil( $result->max_mileage / 50000 ) * 50000 : 300000;
    
    return array( 'min' => $min, 'max' => $max );
}

/**
 * Get year range from vehicles
 */
function vroomqc_get_year_range() {
    global $wpdb;
    
    $result = $wpdb->get_row( "
        SELECT 
            MIN(CAST(pm1.meta_value AS UNSIGNED)) as min_year,
            MAX(CAST(pm1.meta_value AS UNSIGNED)) as max_year
        FROM {$wpdb->postmeta} pm1
        INNER JOIN {$wpdb->posts} p ON pm1.post_id = p.ID
        INNER JOIN {$wpdb->postmeta} pm2 ON p.ID = pm2.post_id
        WHERE p.post_type = 'vehicle' 
        AND p.post_status = 'publish'
        AND pm1.meta_key = 'year'
        AND pm1.meta_value != ''
        AND pm2.meta_key = 'vendu'
        AND pm2.meta_value = '0'
    " );
    
    $min = $result && $result->min_year ? $result->min_year : date('Y') - 20;
    $max = $result && $result->max_year ? $result->max_year : date('Y');
    
    return array( 'min' => (int)$min, 'max' => (int)$max );
}

/**
 * Get taxonomy options for filters
 */
function vroomqc_get_taxonomy_options() {
    $taxonomies = array( 'make', 'model', 'body-style', 'transmission', 'drivetrain', 'fuel-type', 'trim', 'cylinder', 'exterior-color', 'interior-color' );
    $options = array();
    
    foreach ( $taxonomies as $taxonomy ) {
        // Get terms that have vehicles associated with them
        $terms = get_terms( array(
            'taxonomy' => $taxonomy,
            'hide_empty' => true,
            'orderby' => 'count',
            'order' => 'DESC'
        ) );
        
        if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
            $filtered_terms = array();
            
            // Filter terms to only include those with unsold vehicles
            foreach ( $terms as $term ) {
                $vehicle_count = get_posts( array(
                    'post_type' => 'vehicle',
                    'posts_per_page' => -1,
                    'tax_query' => array(
                        array(
                            'taxonomy' => $taxonomy,
                            'field' => 'term_id',
                            'terms' => $term->term_id
                        )
                    ),
                    'meta_query' => array(
                        array(
                            'key' => 'vendu',
                            'value' => '0',
                            'compare' => '='
                        )
                    ),
                    'fields' => 'ids'
                ) );
                
                if ( ! empty( $vehicle_count ) ) {
                    $filtered_terms[] = array(
                        'slug' => $term->slug,
                        'name' => $term->name,
                        'count' => count( $vehicle_count )
                    );
                }
            }
            
            if ( ! empty( $filtered_terms ) ) {
                $options[ $taxonomy ] = $filtered_terms;
            }
        }
    }
    
    return $options;
}