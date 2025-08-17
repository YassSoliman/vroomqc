<?php
/**
 * The template for displaying single vehicle posts
 *
 * @package vroomqc
 */

get_header();

// Get vehicle data
$vehicle_id = get_the_ID();
$vin = get_field( 'vin', $vehicle_id );
$year = get_field( 'year', $vehicle_id );
$mileage = get_field( 'mileage', $vehicle_id );
$price = get_field( 'price', $vehicle_id );
$old_price = get_field( 'old_price', $vehicle_id );
$biweekly_payment = get_field( 'biweekly_payment', $vehicle_id );
$vendu = get_field( 'vendu', $vehicle_id );
$engine = get_field( 'engine', $vehicle_id );
$doors = get_field( 'doors', $vehicle_id );
$seats = get_field( 'seats', $vehicle_id );
$displacementL = get_field( 'displacementL', $vehicle_id );
$carfax_url = get_field( 'carfax_url', $vehicle_id );
$short_description = get_field( 'short_description', $vehicle_id );
$long_description = get_field( 'long_description', $vehicle_id );
$gallery = get_field( 'vehicle_gallery', $vehicle_id );

// Get taxonomy terms
$make_terms = get_the_terms( $vehicle_id, 'make' );
$model_terms = get_the_terms( $vehicle_id, 'model' );
$trim_terms = get_the_terms( $vehicle_id, 'trim' );
$transmission_terms = get_the_terms( $vehicle_id, 'transmission' );
$drivetrain_terms = get_the_terms( $vehicle_id, 'drivetrain' );
$fuel_type_terms = get_the_terms( $vehicle_id, 'fuel-type' );
$body_style_terms = get_the_terms( $vehicle_id, 'body-style' );
$exterior_color_terms = get_the_terms( $vehicle_id, 'exterior-color' );
$interior_color_terms = get_the_terms( $vehicle_id, 'interior-color' );

$make_name = ( $make_terms && ! is_wp_error( $make_terms ) ) ? $make_terms[0]->name : '';
$model_name = ( $model_terms && ! is_wp_error( $model_terms ) ) ? $model_terms[0]->name : '';
$trim_name = ( $trim_terms && ! is_wp_error( $trim_terms ) ) ? $trim_terms[0]->name : '';
$transmission_name = ( $transmission_terms && ! is_wp_error( $transmission_terms ) ) ? $transmission_terms[0]->name : '';
$drivetrain_name = ( $drivetrain_terms && ! is_wp_error( $drivetrain_terms ) ) ? $drivetrain_terms[0]->name : '';
$fuel_type_name = ( $fuel_type_terms && ! is_wp_error( $fuel_type_terms ) ) ? $fuel_type_terms[0]->name : '';
$body_style_name = ( $body_style_terms && ! is_wp_error( $body_style_terms ) ) ? $body_style_terms[0]->name : '';
$exterior_color_name = ( $exterior_color_terms && ! is_wp_error( $exterior_color_terms ) ) ? $exterior_color_terms[0]->name : '';
$interior_color_name = ( $interior_color_terms && ! is_wp_error( $interior_color_terms ) ) ? $interior_color_terms[0]->name : '';

// Build vehicle title
$vehicle_title = vroomqc_get_vehicle_title( $vehicle_id );
?>

<div class="page">
    <section class='single-product' aria-labelledby='single-product-title'>
        <div class='single-product__container'>
            <div class="single-product__header">
                <div class="breadcrumb">
                    <nav class="breadcrumb__menu">
                        <ul class="breadcrumb__list">
                            <li class="breadcrumb__item">
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="breadcrumb__link">
                                    <?php esc_html_e( 'Home', 'vroomqc' ); ?>
                                </a>
                            </li>
                            <li class="breadcrumb__item">
                                <a href="<?php echo esc_url( home_url( '/inventory/' ) ); ?>" class="breadcrumb__link">
                                    <?php esc_html_e( 'Inventory', 'vroomqc' ); ?>
                                </a>
                            </li>
                            <li class="breadcrumb__item">
                                <a href="#" class="breadcrumb__link">
                                    <?php echo esc_html( $vehicle_title ); ?>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <a href="#" class="share-button">
                    <span class="share-button__icon">
                        <?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#share-icon' ); ?>
                    </span>
                    <span class="share-button__text">
                        <?php esc_html_e( 'Share', 'vroomqc' ); ?>
                    </span>
                </a>
            </div>
            
            <div class="gallery-single-product" id="product-gallery">
                <?php if ( ! empty( $gallery ) && is_array( $gallery ) ) : ?>
                    <!-- Main image -->
                    <button type="button" class="gallery-single-product__main-image ibg" 
                        data-src="<?php echo esc_url( $gallery[0]['url'] ); ?>" data-gallery-wrapper>
                        <img src="<?php echo esc_url( $gallery[0]['url'] ); ?>" alt="<?php echo esc_attr( $gallery[0]['alt'] ?: $vehicle_title ); ?>">
                    </button>
                    
                    <div class="gallery-single-product__items">
                        <?php if ( isset( $gallery[1] ) ) : ?>
                        <button type="button" class="gallery-single-product__item ibg"
                            data-src="<?php echo esc_url( $gallery[1]['url'] ); ?>" data-gallery-wrapper>
                            <img src="<?php echo esc_url( $gallery[1]['url'] ); ?>" alt="<?php echo esc_attr( $gallery[1]['alt'] ?: $vehicle_title ); ?>">
                        </button>
                        <?php endif; ?>
                        
                        <?php if ( isset( $gallery[2] ) ) : ?>
                        <button type="button" class="gallery-single-product__item gallery-single-product__item-more ibg"
                            data-src="<?php echo esc_url( $gallery[2]['url'] ); ?>" data-gallery-wrapper>
                            <span class="gallery-single-product__button">
                                <?php esc_html_e( 'Show all photos', 'vroomqc' ); ?>
                            </span>
                            <img src="<?php echo esc_url( $gallery[2]['url'] ); ?>" alt="<?php echo esc_attr( $gallery[2]['alt'] ?: $vehicle_title ); ?>">
                        </button>
                        <?php endif; ?>
                    </div>
                    
                    <?php if ( count( $gallery ) > 3 ) : ?>
                    <div class="gallery-single-product__items-hide">
                        <?php for ( $i = 3; $i < count( $gallery ); $i++ ) : ?>
                        <div class="gallery-single-product__item-hide"
                            data-src="<?php echo esc_url( $gallery[$i]['url'] ); ?>" data-gallery-wrapper>
                            <img src="<?php echo esc_url( $gallery[$i]['url'] ); ?>" alt="<?php echo esc_attr( $gallery[$i]['alt'] ?: $vehicle_title ); ?>">
                        </div>
                        <?php endfor; ?>
                    </div>
                    <?php endif; ?>
                <?php else : 
                    // Fallback to featured image or default
                    $vehicle_image = vroomqc_get_vehicle_image( $vehicle_id, 'large' );
                    ?>
                    <button type="button" class="gallery-single-product__main-image ibg"
                        data-src="<?php echo esc_url( $vehicle_image['url'] ); ?>" data-gallery-wrapper>
                        <img src="<?php echo esc_url( $vehicle_image['url'] ); ?>" alt="<?php echo esc_attr( $vehicle_image['alt'] ); ?>">
                    </button>
                <?php endif; ?>
            </div>
            
            <div class="description-single-product">
                <div class="description-single-product__info">
                    <h1 class="description-single-product__title" id="single-product-title">
                        <?php echo esc_html( $vehicle_title ); ?>
                    </h1>
                    <div class="description-single-product__details">
                        <?php if ( $mileage ) : ?>
                        <div class="description-single-product__item">
                            <?php echo esc_html( number_format( $mileage ) . ' km' ); ?>
                        </div>
                        <?php endif; ?>
                        <?php if ( $transmission_name ) : ?>
                        <div class="description-single-product__item">
                            <?php echo esc_html( $transmission_name ); ?>
                        </div>
                        <?php endif; ?>
                        <?php if ( $drivetrain_name ) : ?>
                        <div class="description-single-product__item">
                            <?php echo esc_html( $drivetrain_name ); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php if ( $short_description || $long_description ) : ?>
                    <div class="description-single-product__content" data-show-more>
                        <h2 class="description-single-product__label title title-small">
                            <?php esc_html_e( 'Overview', 'vroomqc' ); ?>
                        </h2>
                        <div class="description-single-product__text text-block" data-show-more-content>
                            <?php if ( $short_description ) : ?>
                                <?php echo wpautop( $short_description ); ?>
                            <?php endif; ?>
                            <?php if ( $long_description ) : ?>
                                <?php echo wp_kses_post( $long_description ); ?>
                            <?php endif; ?>
                        </div>
                        <button type="button"
                            class="description-single-product__button button button-transparent"
                            data-show-more-button>
                            <?php esc_html_e( 'Show more', 'vroomqc' ); ?>
                        </button>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="description-single-product__values">
                    <div class="description-single-product__price">
                        <?php if ( $price ) : ?>
                            <?php if ( $old_price && $old_price > $price ) : ?>
                                <span class="description-single-product__old-price">$<?php echo number_format( $old_price ); ?></span>
                                <span class="description-single-product__new-price">$<?php echo number_format( $price ); ?></span>
                            <?php else: ?>
                            $<?php echo number_format( $price ); ?>
                            <?php endif; ?>
                        <?php else : ?>
                            <?php esc_html_e( 'Contact us', 'vroomqc' ); ?>
                        <?php endif; ?>
                    </div>
                    <?php if ( $biweekly_payment && ! $vendu ) : ?>
                    <div class="description-single-product__offer">
                        <?php esc_html_e( 'or', 'vroomqc' ); ?> <span>$<?php echo number_format( $biweekly_payment ); ?>/<?php esc_html_e( 'biweekly', 'vroomqc' ); ?></span> <?php esc_html_e( '$0 cash down', 'vroomqc' ); ?>
                    </div>
                    <?php endif; ?>
                    <ul class="description-single-product__list">
                        <li class="description-single-product__row">
                            <?php esc_html_e( 'Certified & inspected', 'vroomqc' ); ?>
                        </li>
                        <li class="description-single-product__row">
                            <?php esc_html_e( '7-day return', 'vroomqc' ); ?>
                        </li>
                        <li class="description-single-product__row">
                            <?php esc_html_e( 'Delivery in 24h across Québec', 'vroomqc' ); ?>
                        </li>
                    </ul>
                    <a href="" class="description-single-product__reserve button">
                        <?php esc_html_e( 'Reserve this car', 'vroomqc' ); ?>
                    </a>
                    <div class="description-single-product__disclaimer">
                        <?php esc_html_e( 'No payment required to reserve', 'vroomqc' ); ?>
                    </div>
                </div>
            </div>
            
            <div class="highlights-single-product">
                <h2 class="highlights-single-product__title title title-small">
                    <?php esc_html_e( 'Key highlights', 'vroomqc' ); ?>
                </h2>
                <ul class="highlights-single-product__list">
                    <?php if ( $drivetrain_name && strpos( strtolower( $drivetrain_name ), 'awd' ) !== false ) : ?>
                    <li class="highlights-single-product__item">
                        <span class="highlights-single-product__icon">
                            <?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#single-product-highlights-icon_01' ); ?>
                        </span>
                        <span class="highlights-single-product__name">
                            <?php esc_html_e( 'AWD capability', 'vroomqc' ); ?>
                        </span>
                    </li>
                    <?php else : ?>
                    <li class="highlights-single-product__item">
                        <span class="highlights-single-product__icon">
                            <?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#single-product-highlights-icon_01' ); ?>
                        </span>
                        <span class="highlights-single-product__name">
                            <?php esc_html_e( 'AWD capability', 'vroomqc' ); ?> <small style="color: #666;">(TODO)</small>
                        </span>
                    </li>
                    <?php endif; ?>
                    <li class="highlights-single-product__item">
                        <span class="highlights-single-product__icon">
                            <?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#single-product-highlights-icon_02' ); ?>
                        </span>
                        <span class="highlights-single-product__name">
                            <?php esc_html_e( 'Delivery in 24h', 'vroomqc' ); ?>
                        </span>
                    </li>
                    <li class="highlights-single-product__item">
                        <span class="highlights-single-product__icon">
                            <?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#single-product-highlights-icon_03' ); ?>
                        </span>
                        <span class="highlights-single-product__name">
                            <?php esc_html_e( 'Fuel efficient', 'vroomqc' ); ?> <small style="color: #666;">(TODO)</small>
                        </span>
                    </li>
                    <li class="highlights-single-product__item">
                        <span class="highlights-single-product__icon">
                            <?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#single-product-highlights-icon_04' ); ?>
                        </span>
                        <span class="highlights-single-product__name">
                            <?php esc_html_e( '7-day return', 'vroomqc' ); ?>
                        </span>
                    </li>
                    <?php if ( $transmission_name ) : ?>
                    <li class="highlights-single-product__item">
                        <span class="highlights-single-product__icon">
                            <?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#single-product-highlights-icon_05' ); ?>
                        </span>
                        <span class="highlights-single-product__name">
                            <?php echo esc_html( $transmission_name . ' transmission' ); ?>
                        </span>
                    </li>
                    <?php endif; ?>
                    <li class="highlights-single-product__item">
                        <span class="highlights-single-product__icon">
                            <?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#single-product-highlights-icon_06' ); ?>
                        </span>
                        <span class="highlights-single-product__name">
                            <?php esc_html_e( 'Inspection completed', 'vroomqc' ); ?>
                        </span>
                    </li>
                    <?php if ( $seats ) : ?>
                    <li class="highlights-single-product__item">
                        <span class="highlights-single-product__icon">
                            <?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#single-product-highlights-icon_07' ); ?>
                        </span>
                        <span class="highlights-single-product__name">
                            <?php printf( esc_html__( '%d passengers', 'vroomqc' ), intval( $seats ) ); ?>
                        </span>
                    </li>
                    <?php else : ?>
                    <li class="highlights-single-product__item">
                        <span class="highlights-single-product__icon">
                            <?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#single-product-highlights-icon_07' ); ?>
                        </span>
                        <span class="highlights-single-product__name">
                            <?php esc_html_e( '5 passengers', 'vroomqc' ); ?> <small style="color: #666;">(TODO)</small>
                        </span>
                    </li>
                    <?php endif; ?>
                    <?php if ( $carfax_url ) : ?>
                    <li class="highlights-single-product__item">
                        <span class="highlights-single-product__icon">
                            <?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#single-product-highlights-icon_08' ); ?>
                        </span>
                        <span class="highlights-single-product__name">
                            <?php esc_html_e( 'Clean Carfax', 'vroomqc' ); ?>
                        </span>
                    </li>
                    <?php else : ?>
                    <li class="highlights-single-product__item">
                        <span class="highlights-single-product__icon">
                            <?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#single-product-highlights-icon_08' ); ?>
                        </span>
                        <span class="highlights-single-product__name">
                            <?php esc_html_e( 'Clean Carfax', 'vroomqc' ); ?> <small style="color: #666;">(TODO)</small>
                        </span>
                    </li>
                    <?php endif; ?>
                    <li class="highlights-single-product__item">
                        <span class="highlights-single-product__icon">
                            <?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#single-product-highlights-icon_09' ); ?>
                        </span>
                        <span class="highlights-single-product__name">
                            <?php esc_html_e( 'Certified used', 'vroomqc' ); ?>
                        </span>
                    </li>
                    <li class="highlights-single-product__item">
                        <span class="highlights-single-product__icon">
                            <?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#single-product-highlights-icon_10' ); ?>
                        </span>
                        <span class="highlights-single-product__name">
                            <?php esc_html_e( 'Winter-ready', 'vroomqc' ); ?> <small style="color: #666;">(TODO)</small>
                        </span>
                    </li>
                </ul>
            </div>
            
            <div class="specifications-single-product">
                <h2 class="specifications-single-product__title title title-small">
                    <?php esc_html_e( 'Specifications', 'vroomqc' ); ?>
                </h2>
                <table class="table">
                    <tbody class="table__tbody">
                        <?php if ( $exterior_color_name ) : ?>
                        <tr class="table__tr">
                            <td class="table__td"><?php esc_html_e( 'Exterior color', 'vroomqc' ); ?></td>
                            <td class="table__td"><?php echo esc_html( $exterior_color_name ); ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if ( $interior_color_name ) : ?>
                        <tr class="table__tr">
                            <td class="table__td"><?php esc_html_e( 'Interior color', 'vroomqc' ); ?></td>
                            <td class="table__td"><?php echo esc_html( $interior_color_name ); ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if ( $drivetrain_name ) : ?>
                        <tr class="table__tr">
                            <td class="table__td"><?php esc_html_e( 'Drivetrain', 'vroomqc' ); ?></td>
                            <td class="table__td"><?php echo esc_html( $drivetrain_name ); ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if ( $fuel_type_name ) : ?>
                        <tr class="table__tr">
                            <td class="table__td"><?php esc_html_e( 'Fuel type', 'vroomqc' ); ?></td>
                            <td class="table__td"><?php echo esc_html( $fuel_type_name ); ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if ( $engine ) : ?>
                        <tr class="table__tr">
                            <td class="table__td"><?php esc_html_e( 'Engine', 'vroomqc' ); ?></td>
                            <td class="table__td"><?php echo esc_html( $engine ); ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if ( $vin ) : ?>
                        <tr class="table__tr">
                            <td class="table__td"><?php esc_html_e( 'Stock #', 'vroomqc' ); ?></td>
                            <td class="table__td"><?php echo esc_html( $vin ); ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if ( $mileage ) : ?>
                        <tr class="table__tr">
                            <td class="table__td"><?php esc_html_e( 'Mileage', 'vroomqc' ); ?></td>
                            <td class="table__td"><?php echo esc_html( number_format( $mileage ) . ' km' ); ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if ( $year ) : ?>
                        <tr class="table__tr">
                            <td class="table__td"><?php esc_html_e( 'Year', 'vroomqc' ); ?></td>
                            <td class="table__td"><?php echo esc_html( $year ); ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if ( $seats ) : ?>
                        <tr class="table__tr">
                            <td class="table__td"><?php esc_html_e( 'Seating', 'vroomqc' ); ?></td>
                            <td class="table__td"><?php printf( esc_html__( '%d passengers', 'vroomqc' ), intval( $seats ) ); ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if ( $vin ) : ?>
                        <tr class="table__tr">
                            <td class="table__td"><?php esc_html_e( 'VIN', 'vroomqc' ); ?></td>
                            <td class="table__td table__td-doble" data-copy>
                                <span class="table__text" data-copy-text><?php echo esc_html( $vin ); ?></span>
                                <button type="button" aria-label="<?php esc_attr_e( 'copy code', 'vroomqc' ); ?>" class="table__copy"
                                    data-copy-button>
                                    <span class="table__message" data-copy-message>
                                        <?php esc_html_e( 'Copied', 'vroomqc' ); ?>
                                    </span>
                                    <span class="table__icon">
                                        <?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#copy-icon' ); ?>
                                    </span>
                                </button>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <?php if ( $carfax_url ) : ?>
            <div class="history-single-product">
                <h2 class="history-single-product__title title title-small">
                    <?php esc_html_e( 'Vehicle history by CARFAX', 'vroomqc' ); ?>
                </h2>
                <div class="history-single-product__subtitle">
                    <table class="history-single-product__table table">
                        <tbody class="table__tbody">
                            <tr class="table__tr">
                                <td class="table__td"><?php esc_html_e( 'Accidents or damage', 'vroomqc' ); ?></td>
                                <td class="table__td"><?php esc_html_e( 'None reported', 'vroomqc' ); ?> <small style="color: #666;">(TODO)</small></td>
                            </tr>
                            <tr class="table__tr">
                                <td class="table__td"><?php esc_html_e( '1-owner vehicle', 'vroomqc' ); ?></td>
                                <td class="table__td"><?php esc_html_e( 'Yes', 'vroomqc' ); ?> <small style="color: #666;">(TODO)</small></td>
                            </tr>
                            <tr class="table__tr">
                                <td class="table__td"><?php esc_html_e( 'Personal use only', 'vroomqc' ); ?></td>
                                <td class="table__td"><?php esc_html_e( 'No', 'vroomqc' ); ?> <small style="color: #666;">(TODO)</small></td>
                            </tr>
                            <tr class="table__tr">
                                <td class="table__td"><?php esc_html_e( 'Last registered in', 'vroomqc' ); ?></td>
                                <td class="table__td"><?php esc_html_e( 'Québec', 'vroomqc' ); ?> <small style="color: #666;">(TODO)</small></td>
                            </tr>
                            <tr class="table__tr">
                                <td class="table__td"><?php esc_html_e( 'Open recalls', 'vroomqc' ); ?></td>
                                <td class="table__td"><?php esc_html_e( '0 found', 'vroomqc' ); ?> <small style="color: #666;">(TODO)</small></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="history-single-product__footer">
                        <a href="<?php echo esc_url( $carfax_url ); ?>" class="history-single-product__button button button-transparent" target="_blank">
                            <div class="history-single-product__logo">
                                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/single-product/carfax-logo.png' ); ?>" alt="<?php esc_attr_e( 'carfax-logo', 'vroomqc' ); ?>">
                            </div>    
                            <span class="history-single-product__text"><?php esc_html_e( 'View full report', 'vroomqc' ); ?></span>
                            <span class="history-single-product__icon">
                                <?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#link-icon' ); ?>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            
            <div class="protect-single-product">
                <h2 class="protect-single-product__title title title-small">
                    <?php esc_html_e( 'Protect your investment', 'vroomqc' ); ?> <small style="color: #666;">(TODO)</small>
                </h2>
                <div class="protect-single-product__columns">
                    <article class="protect-single-product__column">
                        <h3 class="protect-single-product__label">
                            <?php esc_html_e( 'Basic', 'vroomqc' ); ?>
                        </h3>
                        <p><?php esc_html_e( 'Protection plan details will be added here.', 'vroomqc' ); ?></p>
                    </article>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
get_footer();