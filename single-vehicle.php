<?php
/**
 * The template for displaying single vehicle posts
 *
 * @package vroomqc
 */

get_header();
?>

<div class="page">
	<section class="single-product">
		<div class="single-product__container">
			<div class="breadcrumb">
				<nav class="breadcrumb__menu">
					<ul class="breadcrumb__list">
						<li class="breadcrumb__item">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="breadcrumb__link">
								<?php esc_html_e( 'Home', 'vroomqc' ); ?>
							</a>
						</li>
						<li class="breadcrumb__item">
							<a href="#" class="breadcrumb__link">
								<?php esc_html_e( 'Inventory', 'vroomqc' ); ?>
							</a>
						</li>
						<li class="breadcrumb__item">
							<span class="breadcrumb__current">
								<?php esc_html_e( '2020 Honda Accord', 'vroomqc' ); ?>
							</span>
						</li>
					</ul>
				</nav>
			</div>
			
			<div class="single-product__body">
				<div class="single-product__gallery">
					<div class="product-gallery" id="product-gallery">
						<div class="gallery-main">
							<a href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/single-product/gallery/gallery-image_01.jpg' ); ?>" data-gallery-wrapper>
								<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/single-product/gallery/gallery-image_01.jpg' ); ?>" alt="<?php esc_attr_e( 'Vehicle main image', 'vroomqc' ); ?>">
							</a>
						</div>
						<div class="gallery-thumbs">
							<a href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/single-product/gallery/gallery-image_02.jpg' ); ?>" data-gallery-wrapper class="thumb">
								<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/single-product/gallery/gallery-image_02.jpg' ); ?>" alt="<?php esc_attr_e( 'Vehicle image', 'vroomqc' ); ?>">
							</a>
							<a href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/single-product/gallery/gallery-image_03.jpg' ); ?>" data-gallery-wrapper class="thumb">
								<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/single-product/gallery/gallery-image_03.jpg' ); ?>" alt="<?php esc_attr_e( 'Vehicle image', 'vroomqc' ); ?>">
							</a>
							<a href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/single-product/gallery/gallery-image_04.avif' ); ?>" data-gallery-wrapper class="thumb">
								<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/single-product/gallery/gallery-image_04.avif' ); ?>" alt="<?php esc_attr_e( 'Vehicle image', 'vroomqc' ); ?>">
							</a>
						</div>
					</div>
				</div>
				
				<div class="single-product__info">
					<div class="product-header">
						<h1 class="product-title"><?php esc_html_e( '2020 Honda Accord Sport', 'vroomqc' ); ?></h1>
						<div class="product-price">
							<span class="current-price">$24,990</span>
							<span class="financing-option"><?php esc_html_e( 'or $189/biweekly', 'vroomqc' ); ?></span>
						</div>
					</div>
					
					<div class="product-specs">
						<div class="spec-item">
							<span class="spec-label"><?php esc_html_e( 'Mileage:', 'vroomqc' ); ?></span>
							<span class="spec-value"><?php esc_html_e( '45,000 km', 'vroomqc' ); ?></span>
						</div>
						<div class="spec-item">
							<span class="spec-label"><?php esc_html_e( 'Transmission:', 'vroomqc' ); ?></span>
							<span class="spec-value"><?php esc_html_e( 'Automatic', 'vroomqc' ); ?></span>
						</div>
						<div class="spec-item">
							<span class="spec-label"><?php esc_html_e( 'Fuel Type:', 'vroomqc' ); ?></span>
							<span class="spec-value"><?php esc_html_e( 'Gasoline', 'vroomqc' ); ?></span>
						</div>
						<div class="spec-item">
							<span class="spec-label"><?php esc_html_e( 'Drive:', 'vroomqc' ); ?></span>
							<span class="spec-value"><?php esc_html_e( 'FWD', 'vroomqc' ); ?></span>
						</div>
					</div>
					
					<div class="product-features">
						<h3><?php esc_html_e( 'Key Features', 'vroomqc' ); ?></h3>
						<ul class="features-list">
							<li><?php esc_html_e( 'Leather Seats', 'vroomqc' ); ?></li>
							<li><?php esc_html_e( 'Sunroof', 'vroomqc' ); ?></li>
							<li><?php esc_html_e( 'Backup Camera', 'vroomqc' ); ?></li>
							<li><?php esc_html_e( 'Heated Seats', 'vroomqc' ); ?></li>
							<li><?php esc_html_e( 'Apple CarPlay', 'vroomqc' ); ?></li>
							<li><?php esc_html_e( 'Bluetooth', 'vroomqc' ); ?></li>
						</ul>
					</div>
					
					<div class="product-actions">
						<button class="button button-primary">
							<?php esc_html_e( 'Schedule Test Drive', 'vroomqc' ); ?>
						</button>
						<button class="button button-secondary">
							<?php esc_html_e( 'Get Financing', 'vroomqc' ); ?>
						</button>
						<button class="button button-outline">
							<?php esc_html_e( 'Contact Dealer', 'vroomqc' ); ?>
						</button>
					</div>
				</div>
			</div>
			
			<div class="vehicle-details">
				<div class="details-section">
					<h2><?php esc_html_e( 'Vehicle Details', 'vroomqc' ); ?></h2>
					<div class="details-grid">
						<div class="detail-item">
							<span class="detail-label"><?php esc_html_e( 'VIN:', 'vroomqc' ); ?></span>
							<span class="detail-value">1HGCV1F30JA123456</span>
						</div>
						<div class="detail-item">
							<span class="detail-label"><?php esc_html_e( 'Stock #:', 'vroomqc' ); ?></span>
							<span class="detail-value">VQ-001234</span>
						</div>
						<div class="detail-item">
							<span class="detail-label"><?php esc_html_e( 'Body Style:', 'vroomqc' ); ?></span>
							<span class="detail-value"><?php esc_html_e( 'Sedan', 'vroomqc' ); ?></span>
						</div>
						<div class="detail-item">
							<span class="detail-label"><?php esc_html_e( 'Engine:', 'vroomqc' ); ?></span>
							<span class="detail-value"><?php esc_html_e( '1.5L 4-Cylinder Turbo', 'vroomqc' ); ?></span>
						</div>
						<div class="detail-item">
							<span class="detail-label"><?php esc_html_e( 'Exterior Color:', 'vroomqc' ); ?></span>
							<span class="detail-value"><?php esc_html_e( 'Modern Steel Metallic', 'vroomqc' ); ?></span>
						</div>
						<div class="detail-item">
							<span class="detail-label"><?php esc_html_e( 'Interior Color:', 'vroomqc' ); ?></span>
							<span class="detail-value"><?php esc_html_e( 'Black Leather', 'vroomqc' ); ?></span>
						</div>
					</div>
				</div>
				
				<div class="carfax-section">
					<h2><?php esc_html_e( 'Vehicle History', 'vroomqc' ); ?></h2>
					<div class="carfax-report">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/single-product/carfax-logo.png' ); ?>" alt="<?php esc_attr_e( 'Carfax logo', 'vroomqc' ); ?>" class="carfax-logo">
						<p><?php esc_html_e( 'This vehicle comes with a clean Carfax report. No accidents reported.', 'vroomqc' ); ?></p>
						<button class="button button-outline">
							<?php esc_html_e( 'View Full Report', 'vroomqc' ); ?>
						</button>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<?php
get_footer();