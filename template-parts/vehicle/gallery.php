<?php
/**
 * Vehicle Gallery Template Part
 *
 * @package vroomqc
 * @var int $vehicle_id Post ID (optional, defaults to current post)
 */

// Get post ID if not provided
if ( ! isset( $vehicle_id ) ) {
    $vehicle_id = get_the_ID();
}

// Get vehicle gallery
$gallery = get_field( 'vehicle_gallery', $vehicle_id );

if ( ! $gallery ) {
    // Fallback to featured image if no gallery
    $featured_image_id = get_post_thumbnail_id( $vehicle_id );
    if ( $featured_image_id ) {
        $gallery = array( $featured_image_id );
    }
}

if ( $gallery ) :
?>
<div class="product-gallery" id="product-gallery">
    <?php if ( count( $gallery ) > 0 ) : ?>
        <div class="gallery-main">
            <a href="<?php echo esc_url( wp_get_attachment_image_url( $gallery[0], 'full' ) ); ?>" data-gallery-wrapper>
                <img src="<?php echo esc_url( wp_get_attachment_image_url( $gallery[0], 'large' ) ); ?>" alt="<?php echo esc_attr( get_post_meta( $gallery[0], '_wp_attachment_image_alt', true ) ?: get_the_title( $vehicle_id ) ); ?>">
            </a>
        </div>
    <?php endif; ?>
    
    <?php if ( count( $gallery ) > 1 ) : ?>
        <div class="gallery-thumbs">
            <?php foreach ( array_slice( $gallery, 1 ) as $image_id ) : ?>
                <a href="<?php echo esc_url( wp_get_attachment_image_url( $image_id, 'full' ) ); ?>" data-gallery-wrapper class="thumb">
                    <img src="<?php echo esc_url( wp_get_attachment_image_url( $image_id, 'medium' ) ); ?>" alt="<?php echo esc_attr( get_post_meta( $image_id, '_wp_attachment_image_alt', true ) ?: get_the_title( $vehicle_id ) ); ?>">
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
<?php endif; ?>