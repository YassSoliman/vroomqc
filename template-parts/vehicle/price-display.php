<?php
/**
 * Vehicle Price Display Template Part
 *
 * @package vroomqc
 * @var int $vehicle_id Post ID (optional, defaults to current post)
 */

// Get post ID if not provided
if ( ! isset( $vehicle_id ) ) {
    $vehicle_id = get_the_ID();
}

// Get price fields
$price = get_field( 'price', $vehicle_id );
$old_price = get_field( 'old_price', $vehicle_id );

// Display logic
if ( empty( $price ) ) {
    // No price set - show contact us
    echo '<span class="products__value">' . esc_html__( 'Contact us', 'vroomqc' ) . '</span>';
} elseif ( ! empty( $old_price ) && $old_price > $price ) {
    // Old price exists and is higher - show discount pricing
    echo '<span class="products__last-price">$' . number_format( $old_price ) . '</span>';
    echo '<span class="products__current-price">$' . number_format( $price ) . '</span>';
} else {
    // Regular pricing
    echo '<span class="products__value">$' . number_format( $price ) . '</span>';
}