<?php
/**
 * Vehicle Details List Template Part
 *
 * @package vroomqc
 * @var int $vehicle_id Post ID (optional, defaults to current post)
 */

// Get post ID if not provided
if ( ! isset( $vehicle_id ) ) {
    $vehicle_id = get_the_ID();
}

// Get all vehicle details
$year = get_field( 'year', $vehicle_id );
$mileage = get_field( 'mileage', $vehicle_id );
$engine = get_field( 'engine', $vehicle_id );
$doors = get_field( 'doors', $vehicle_id );
$seats = get_field( 'seats', $vehicle_id );
$fuel_city = get_field( 'fuel_city', $vehicle_id );
$fuel_hwy = get_field( 'fuel_hwy', $vehicle_id );

// Get taxonomy terms
$make_terms = get_the_terms( $vehicle_id, 'make' );
$model_terms = get_the_terms( $vehicle_id, 'model' );
$trim_terms = get_the_terms( $vehicle_id, 'trim' );
$fuel_type_terms = get_the_terms( $vehicle_id, 'fuel-type' );
$transmission_terms = get_the_terms( $vehicle_id, 'transmission' );
$drivetrain_terms = get_the_terms( $vehicle_id, 'drivetrain' );
$body_style_terms = get_the_terms( $vehicle_id, 'body-style' );
$cylinder_terms = get_the_terms( $vehicle_id, 'cylinder' );
$exterior_color_terms = get_the_terms( $vehicle_id, 'exterior-color' );
$interior_color_terms = get_the_terms( $vehicle_id, 'interior-color' );

// Helper function to get term name
function get_term_name( $terms ) {
    return ( $terms && ! is_wp_error( $terms ) ) ? $terms[0]->name : '';
}

// Prepare details array
$details = array();

if ( $year ) $details[ __( 'Year', 'vroomqc' ) ] = $year;
if ( get_term_name( $make_terms ) ) $details[ __( 'Make', 'vroomqc' ) ] = get_term_name( $make_terms );
if ( get_term_name( $model_terms ) ) $details[ __( 'Model', 'vroomqc' ) ] = get_term_name( $model_terms );
if ( get_term_name( $trim_terms ) ) $details[ __( 'Trim', 'vroomqc' ) ] = get_term_name( $trim_terms );
if ( $mileage ) $details[ __( 'Mileage', 'vroomqc' ) ] = number_format( $mileage ) . ' km';
if ( get_term_name( $fuel_type_terms ) ) $details[ __( 'Fuel Type', 'vroomqc' ) ] = get_term_name( $fuel_type_terms );
if ( get_term_name( $transmission_terms ) ) $details[ __( 'Transmission', 'vroomqc' ) ] = get_term_name( $transmission_terms );
if ( get_term_name( $drivetrain_terms ) ) $details[ __( 'Drivetrain', 'vroomqc' ) ] = get_term_name( $drivetrain_terms );
if ( get_term_name( $body_style_terms ) ) $details[ __( 'Body Style', 'vroomqc' ) ] = get_term_name( $body_style_terms );
if ( $engine ) $details[ __( 'Engine', 'vroomqc' ) ] = $engine;
if ( get_term_name( $cylinder_terms ) ) $details[ __( 'Cylinders', 'vroomqc' ) ] = get_term_name( $cylinder_terms );
if ( $doors ) $details[ __( 'Doors', 'vroomqc' ) ] = $doors;
if ( $seats ) $details[ __( 'Seats', 'vroomqc' ) ] = $seats;
if ( get_term_name( $exterior_color_terms ) ) $details[ __( 'Exterior Color', 'vroomqc' ) ] = get_term_name( $exterior_color_terms );
if ( get_term_name( $interior_color_terms ) ) $details[ __( 'Interior Color', 'vroomqc' ) ] = get_term_name( $interior_color_terms );

if ( $fuel_city && $fuel_hwy ) {
    $details[ __( 'Fuel Economy', 'vroomqc' ) ] = $fuel_city . 'L/100km city, ' . $fuel_hwy . 'L/100km hwy';
} elseif ( $fuel_city ) {
    $details[ __( 'Fuel Economy (City)', 'vroomqc' ) ] = $fuel_city . 'L/100km';
} elseif ( $fuel_hwy ) {
    $details[ __( 'Fuel Economy (Hwy)', 'vroomqc' ) ] = $fuel_hwy . 'L/100km';
}

if ( ! empty( $details ) ) :
?>
<div class="vehicle-details">
    <?php foreach ( $details as $label => $value ) : ?>
        <div class="vehicle-details__item">
            <span class="vehicle-details__label"><?php echo esc_html( $label ); ?>:</span>
            <span class="vehicle-details__value"><?php echo esc_html( $value ); ?></span>
        </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>