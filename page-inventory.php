<?php
/**
 * Template Name: Inventory
 *
 * @package vroomqc
 */

get_header();
?>

<div class="page">
	<section class='products' aria-labelledby='products-title'>
		<div class='products__container'>
			<div class="header-products">
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
						</ul>
					</nav>
				</div>
				<h1 class='header-products__title title' id='products-title'>
					<?php esc_html_e( 'Browse certified used cars', 'vroomqc' ); ?>
				</h1>
			</div>
			
			<div class="body-products">
				<aside class="body-products-aside" data-filter>
					<div class="body-products-aside__wrapper">
						<div class="body-products-aside__items" data-spollers>
							<div class="body-products-aside__item">
								<button type="button" class="body-products-aside__header" data-spoller>
									<span class="body-products-aside__text-base">
										<?php esc_html_e( 'Price range', 'vroomqc' ); ?>
									</span>
									<span class="body-products-aside__icon">
										<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#drop-down-icon' ); ?>
									</span>
								</button>
								<div class="body-products-aside__body">
									<?php
					// Get dynamic price range
					$price_range = vroomqc_get_price_range();
					?>
					<div class="body-products-aside__range-slider" id="products-range-slider" data-min-value="<?php echo esc_attr( $price_range['min'] ); ?>" data-max-value="<?php echo esc_attr( $price_range['max'] ); ?>"></div>
									<div class="body-products-aside__input-boxes">
										<div class="body-products-aside__input-box">
											<label for="producs-price-min-input" class="body-products-aside__label"><?php esc_html_e( 'Min', 'vroomqc' ); ?></label>
											<input type="text" value="$<?php echo number_format( $price_range['min'] ); ?>" aria-label="<?php esc_attr_e( 'min-price', 'vroomqc' ); ?>" id="producs-price-min-input" autocomplete="off" data-input-numb class="body-products-aside__value">
										</div>
										<div class="body-products-aside__input-box">
											<label for="producs-price-max-input" class="body-products-aside__label"><?php esc_html_e( 'Max', 'vroomqc' ); ?></label>
											<input type="text" value="$<?php echo number_format( $price_range['max'] ); ?>" aria-label="<?php esc_attr_e( 'max-price', 'vroomqc' ); ?>" id="producs-price-max-input" autocomplete="off" data-input-numb class="body-products-aside__value">
										</div>
									</div>
								</div>
							</div>
							<?php vroomqc_render_year_filter(); ?>
							<?php vroomqc_render_taxonomy_filter( 'make', __( 'Make', 'vroomqc' ), true ); ?>
							<?php vroomqc_render_model_filter_grouped( true ); ?>
							<?php vroomqc_render_taxonomy_filter( 'body-style', __( 'Body type', 'vroomqc' ) ); ?>
							<?php vroomqc_render_mileage_filter(); ?>
							<?php vroomqc_render_taxonomy_filter( 'transmission', __( 'Transmission', 'vroomqc' ) ); ?>
							<?php vroomqc_render_taxonomy_filter( 'drivetrain', __( 'Drivetrain', 'vroomqc' ) ); ?>
							<?php vroomqc_render_taxonomy_filter( 'fuel-type', __( 'Fuel Type', 'vroomqc' ) ); ?>
							<?php vroomqc_render_taxonomy_filter( 'cylinder', __( 'Cylinders', 'vroomqc' ) ); ?>
							<?php vroomqc_render_taxonomy_filter( 'trim', __( 'Trim', 'vroomqc' ) ); ?>
							<?php vroomqc_render_taxonomy_filter( 'exterior-color', __( 'Exterior Color', 'vroomqc' ) ); ?>
							<?php vroomqc_render_taxonomy_filter( 'interior-color', __( 'Interior Color', 'vroomqc' ) ); ?>
						</div>
						<button type="button" class="body-products-aside__button-apply button" data-close-filter>
							<?php esc_html_e( 'Apply filters', 'vroomqc' ); ?>
						</button>
					</div>
				</aside>
				
				<div class="body-products-main">
					<div class="header-products-main">
						<div class="header-products-main__search-bar">
							<div class="header-products-main__icon">
								<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#search-icon' ); ?>
							</div>
							<input type="text" placeholder="<?php esc_attr_e( 'Search by make, model, or keyword', 'vroomqc' ); ?>" name="search product" class="header-products-main__input" id="vehicle-search" data-search-input>
						</div>
						
						<!-- Filter Pills -->
						<div class="filter-pills" id="filter-pills" style="display: none;">
							<div class="filter-pills__container">
								<!-- Pills will be dynamically inserted here -->
							</div>
						</div>
						<div class="header-products-main__footer">
							<div class="header-products-main__quantity" id="vehicle-count">
								<?php 
								// Get total count of unsold vehicles for initial display
								$unsold_count = get_posts( array(
									'post_type' => 'vehicle',
									'posts_per_page' => -1,
									'meta_query' => array(
										array(
											'key' => 'vendu',
											'value' => '0',
											'compare' => '='
										)
									),
									'fields' => 'ids'
								) );
								$total_count = count( $unsold_count );
								$showing_count = min( 15, $total_count );
								
								if ( $total_count > 0 ) {
									printf( 
										'<span class="showing-count">%d</span> %s <span class="total-count">%d</span> %s',
										$showing_count,
										esc_html__( 'of', 'vroomqc' ),
										$total_count,
										esc_html( _n( 'vehicle', 'vehicles', $total_count, 'vroomqc' ) )
									);
								} else {
									esc_html_e( 'No vehicles available', 'vroomqc' );
								}
								?>
							</div>
							<button type="button" class="header-products-main__filter-button button" data-open-filter>
								<?php esc_html_e( 'Filters', 'vroomqc' ); ?>
							</button>
							<div class="header-products-main__sort">
								<span class="header-products-main__caption">
									<?php esc_html_e( 'Sort by', 'vroomqc' ); ?>
								</span>
								<div class="header-products-main__select select" data-select-menu>
									<button class="select__header" type="button" aria-label="<?php esc_attr_e( 'choose sorting', 'vroomqc' ); ?>" data-select-menu-button>
										<span class="select__value" data-select-menu-value><?php esc_html_e( 'Newest listings', 'vroomqc' ); ?></span>
										<span class="select__icon">
											<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#drop-down-icon' ); ?>
										</span>
									</button>
									<ul class="select__body" data-select-menu-drop-down>
										<li class="select__item" data-select-menu-option data-sort-value="newest">
											<button type="button" class="select__button"><?php esc_html_e( 'Newest listings', 'vroomqc' ); ?></button>
										</li>
										<li class="select__item" data-select-menu-option data-sort-value="price_low">
											<button type="button" class="select__button"><?php esc_html_e( 'Price: Low to High', 'vroomqc' ); ?></button>
										</li>
										<li class="select__item" data-select-menu-option data-sort-value="price_high">
											<button type="button" class="select__button"><?php esc_html_e( 'Price: High to Low', 'vroomqc' ); ?></button>
										</li>
										<li class="select__item" data-select-menu-option data-sort-value="mileage_low">
											<button type="button" class="select__button"><?php esc_html_e( 'Mileage: Low to High', 'vroomqc' ); ?></button>
										</li>
										<li class="select__item" data-select-menu-option data-sort-value="mileage_high">
											<button type="button" class="select__button"><?php esc_html_e( 'Mileage: High to Low', 'vroomqc' ); ?></button>
										</li>
										<li class="select__item" data-select-menu-option data-sort-value="year_new">
											<button type="button" class="select__button"><?php esc_html_e( 'Year: Newest to Oldest', 'vroomqc' ); ?></button>
										</li>
										<li class="select__item" data-select-menu-option data-sort-value="year_old">
											<button type="button" class="select__button"><?php esc_html_e( 'Year: Oldest to Newest', 'vroomqc' ); ?></button>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="body-products-main__products" id="vehicles-container">
						<div class="products products-alt" id="vehicles-grid">
							<?php
							// Query for vehicles (not sold)
							$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
							$inventory_vehicles = new WP_Query( array(
								'post_type' => 'vehicle',
								'posts_per_page' => 15,
								'paged' => $paged,
								'meta_query' => array(
									array(
										'key' => 'vendu',
										'value' => '0',
										'compare' => '='
									)
								),
								'orderby' => 'date',
								'order' => 'DESC'
							) );

							if ( $inventory_vehicles->have_posts() ) :
								while ( $inventory_vehicles->have_posts() ) : $inventory_vehicles->the_post();
									set_query_var( 'vehicle_id', get_the_ID() );
									get_template_part( 'template-parts/vehicle/card' );
								endwhile;
								wp_reset_postdata();
							else :
								echo '<p class="no-vehicles-message">' . esc_html__( 'No vehicles available at the moment.', 'vroomqc' ) . '</p>';
							endif;
							?>
						</div>
						
						<!-- Pagination will be inserted here dynamically -->
						<div id="pagination-container">
							<?php
							// Generate initial pagination if needed
							if ( $inventory_vehicles->max_num_pages > 1 ) {
								echo vroomqc_generate_pagination( $paged, $inventory_vehicles->max_num_pages );
							}
							?>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<?php
get_footer();