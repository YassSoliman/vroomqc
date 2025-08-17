<?php
/**
 * Small Vehicle Card Template Part (for homepage)
 *
 * @package vroomqc
 * @var int $vehicle_id Post ID (optional, defaults to current post)
 * @var string $filter_content Data filter content for JavaScript
 */

// Get post ID if not provided
if ( ! isset( $vehicle_id ) ) {
    $vehicle_id = get_the_ID();
}

// Set default filter content if not provided
if ( ! isset( $filter_content ) ) {
    $filter_content = '';
}

// Pass the filter content as card class for the main card template
$card_class = '_show';
if ( ! empty( $filter_content ) ) {
    $card_class .= '" data-filter-content="' . esc_attr( $filter_content );
}

// Use the main vehicle card template with additional class
set_query_var( 'vehicle_id', $vehicle_id );
set_query_var( 'card_class', $card_class );
get_template_part( 'template-parts/vehicle/card' );