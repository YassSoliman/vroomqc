<?php
/**
 * Vehicle Card Template Part
 *
 * @package vroomqc
 * @var int $vehicle_id Post ID (optional, defaults to current post)
 * @var string $card_class Additional CSS classes (optional)
 */

// Get post ID if not provided
if ( ! isset( $vehicle_id ) ) {
    $vehicle_id = get_the_ID();
}

// Get vehicle data
$year = get_field( 'year', $vehicle_id );
$mileage = get_field( 'mileage', $vehicle_id );
$biweekly_payment = get_field( 'biweekly_payment', $vehicle_id );
$vendu = get_field( 'vendu', $vehicle_id );

// Get taxonomy terms
$make_terms = get_the_terms( $vehicle_id, 'make' );
$model_terms = get_the_terms( $vehicle_id, 'model' );
$transmission_terms = get_the_terms( $vehicle_id, 'transmission' );

$make_name = ( $make_terms && ! is_wp_error( $make_terms ) ) ? $make_terms[0]->name : '';
$model_name = ( $model_terms && ! is_wp_error( $model_terms ) ) ? $model_terms[0]->name : '';
$transmission_name = ( $transmission_terms && ! is_wp_error( $transmission_terms ) ) ? $transmission_terms[0]->name : '';

// Build vehicle title
$vehicle_title = trim( $year . ' ' . $make_name . ' ' . $model_name );
if ( empty( $vehicle_title ) ) {
    $vehicle_title = get_the_title( $vehicle_id );
}

// Get vehicle image with proper fallback
$vehicle_image = vroomqc_get_vehicle_image( $vehicle_id, 'large' );
$image_url = $vehicle_image['url'];
$image_alt = $vehicle_image['alt'];

// Additional classes
$classes = isset( $card_class ) ? 'products__item ' . $card_class : 'products__item';
?>

<a href="<?php echo esc_url( get_permalink( $vehicle_id ) ); ?>" class="<?php echo esc_attr( $classes ); ?>">
    <div class="products__image ibg">
        <?php if ( $vendu ) : ?>
            <div class="products__sold-overlay">
                <span class="products__sold-text"><?php esc_html_e( 'Vendu', 'vroomqc' ); ?></span>
            </div>
        <?php endif; ?>
        <img src="<?php echo esc_url( $image_url ); ?>" loading="lazy" alt="<?php echo esc_attr( $image_alt ); ?>">
    </div>
    
    <div class="products__info">
        <h3 class="products__model">
            <?php echo esc_html( $vehicle_title ); ?>
        </h3>
        <div class="products__details">
            <?php if ( $mileage ) : ?>
                <span class="products__mileage">
                    <?php echo esc_html( number_format( $mileage ) . ' km' ); ?>
                </span>
            <?php endif; ?>
            <?php if ( $transmission_name ) : ?>
                <span class="products__gearbox">
                    <?php echo esc_html( $transmission_name ); ?>
                </span>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="products__footer">
        <div class="products__price">
            <?php 
            // Use the price display template part
            set_query_var( 'vehicle_id', $vehicle_id );
            get_template_part( 'template-parts/vehicle/price-display' );
            ?>
        </div>
        
        <?php if ( ! empty( $biweekly_payment ) && ! $vendu ) : ?>
            <div class="products__offer">
                <?php esc_html_e( 'or', 'vroomqc' ); ?> 
                <span class="products__option">$<?php echo esc_html( number_format( $biweekly_payment ) ); ?>/<?php esc_html_e( 'biweekly', 'vroomqc' ); ?></span> 
                <?php esc_html_e( '$0 cash down', 'vroomqc' ); ?>
            </div>
        <?php endif; ?>
    </div>
</a>