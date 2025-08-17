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
							<li class="breadcrumb__item">
								<a href="#" class="breadcrumb__link">
									<?php esc_html_e( 'Used cars', 'vroomqc' ); ?>
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
								<button type="button" class="body-products-aside__header _active" data-spoller>
									<span class="body-products-aside__text-base">
										<?php esc_html_e( 'Price range', 'vroomqc' ); ?>
									</span>
									<span class="body-products-aside__icon">
										<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#drop-down-icon' ); ?>
									</span>
								</button>
								<div class="body-products-aside__body">
									<div class="body-products-aside__range-slider" id="products-range-slider" data-min-value="1000" data-max-value="50000"></div>
									<div class="body-products-aside__input-boxes">
										<div class="body-products-aside__input-box">
											<label for="producs-price-min-input" class="body-products-aside__label"><?php esc_html_e( 'Min', 'vroomqc' ); ?></label>
											<input type="text" value="$13,200" aria-label="<?php esc_attr_e( 'min-price', 'vroomqc' ); ?>" id="producs-price-min-input" autocomplete="off" data-input-numb class="body-products-aside__value">
										</div>
										<div class="body-products-aside__input-box">
											<label for="producs-price-max-input" class="body-products-aside__label"><?php esc_html_e( 'Max', 'vroomqc' ); ?></label>
											<input type="text" value="$32,000" aria-label="<?php esc_attr_e( 'max-price', 'vroomqc' ); ?>" id="producs-price-max-input" autocomplete="off" data-input-numb class="body-products-aside__value">
										</div>
									</div>
								</div>
							</div>
							<div class="body-products-aside__item">
								<button type="button" class="body-products-aside__header _active" data-spoller>
									<span class="body-products-aside__text-base">
										<?php esc_html_e( 'Make', 'vroomqc' ); ?>
									</span>
									<span class="body-products-aside__icon">
										<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#drop-down-icon' ); ?>
									</span>
								</button>
								<div class="body-products-aside__body">
									<div class="body-products-aside__rows">
										<div class="body-products-aside__row">
											<input type="checkbox" id="Toyota" class="body-products-aside__checkbox" checked>
											<label for="Toyota" class="body-products-aside__caption"><?php esc_html_e( 'Toyota', 'vroomqc' ); ?></label>
										</div>
										<div class="body-products-aside__row">
											<input type="checkbox" id="Honda" class="body-products-aside__checkbox" checked>
											<label for="Honda" class="body-products-aside__caption"><?php esc_html_e( 'Honda', 'vroomqc' ); ?></label>
										</div>
										<div class="body-products-aside__row">
											<input type="checkbox" id="Hyundai" class="body-products-aside__checkbox" checked>
											<label for="Hyundai" class="body-products-aside__caption"><?php esc_html_e( 'Hyundai', 'vroomqc' ); ?></label>
										</div>
										<div class="body-products-aside__row">
											<input type="checkbox" id="Kia" class="body-products-aside__checkbox">
											<label for="Kia" class="body-products-aside__caption"><?php esc_html_e( 'Kia', 'vroomqc' ); ?></label>
										</div>
										<div class="body-products-aside__row">
											<input type="checkbox" id="Mazda" class="body-products-aside__checkbox">
											<label for="Mazda" class="body-products-aside__caption"><?php esc_html_e( 'Mazda', 'vroomqc' ); ?></label>
										</div>
										<div class="body-products-aside__row">
											<input type="checkbox" id="Ford" class="body-products-aside__checkbox">
											<label for="Ford" class="body-products-aside__caption"><?php esc_html_e( 'Ford', 'vroomqc' ); ?></label>
										</div>
										<div class="body-products-aside__row">
											<input type="checkbox" id="Chevrolet" class="body-products-aside__checkbox">
											<label for="Chevrolet" class="body-products-aside__caption"><?php esc_html_e( 'Chevrolet', 'vroomqc' ); ?></label>
										</div>
										<div class="body-products-aside__row">
											<input type="checkbox" id="Volkswagen" class="body-products-aside__checkbox">
											<label for="Volkswagen" class="body-products-aside__caption"><?php esc_html_e( 'Volkswagen', 'vroomqc' ); ?></label>
										</div>
										<div class="body-products-aside__row">
											<input type="checkbox" id="Nissan" class="body-products-aside__checkbox" checked>
											<label for="Nissan" class="body-products-aside__caption"><?php esc_html_e( 'Nissan', 'vroomqc' ); ?></label>
										</div>
										<div class="body-products-aside__row">
											<input type="checkbox" id="BMW" class="body-products-aside__checkbox">
											<label for="BMW" class="body-products-aside__caption"><?php esc_html_e( 'BMW', 'vroomqc' ); ?></label>
										</div>
										<div class="body-products-aside__row">
											<input type="checkbox" id="Audi" class="body-products-aside__checkbox" checked>
											<label for="Audi" class="body-products-aside__caption"><?php esc_html_e( 'Audi', 'vroomqc' ); ?></label>
										</div>
										<div class="body-products-aside__row">
											<input type="checkbox" id="Mercedes-Benz" class="body-products-aside__checkbox">
											<label for="Mercedes-Benz" class="body-products-aside__caption"><?php esc_html_e( 'Mercedes-Benz', 'vroomqc' ); ?></label>
										</div>
									</div>
									<button type="button" class="body-products-aside__button">
										<?php esc_html_e( 'See more', 'vroomqc' ); ?>
									</button>
								</div>
							</div>
							<div class="body-products-aside__item">
								<button type="button" class="body-products-aside__header _active" data-spoller>
									<span class="body-products-aside__text-base">
										<?php esc_html_e( 'Body type', 'vroomqc' ); ?>
									</span>
									<span class="body-products-aside__icon">
										<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#drop-down-icon' ); ?>
									</span>
								</button>
								<div class="body-products-aside__body">
									<div class="body-products-aside__rows">
										<div class="body-products-aside__row">
											<input type="checkbox" id="SUV" class="body-products-aside__checkbox" checked>
											<label for="SUV" class="body-products-aside__caption"><?php esc_html_e( 'SUV', 'vroomqc' ); ?></label>
										</div>
										<div class="body-products-aside__row">
											<input type="checkbox" id="Sedan" class="body-products-aside__checkbox" checked>
											<label for="Sedan" class="body-products-aside__caption"><?php esc_html_e( 'Sedan', 'vroomqc' ); ?></label>
										</div>
										<div class="body-products-aside__row">
											<input type="checkbox" id="Hatchback" class="body-products-aside__checkbox">
											<label for="Hatchback" class="body-products-aside__caption"><?php esc_html_e( 'Hatchback', 'vroomqc' ); ?></label>
										</div>
										<div class="body-products-aside__row">
											<input type="checkbox" id="Coupe" class="body-products-aside__checkbox">
											<label for="Coupe" class="body-products-aside__caption"><?php esc_html_e( 'Coupe', 'vroomqc' ); ?></label>
										</div>
									</div>
								</div>
							</div>
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
							<input type="text" placeholder="<?php esc_attr_e( 'Search by make, model, or keyword', 'vroomqc' ); ?>" name="search product" class="header-products-main__input">
						</div>
						<div class="header-products-main__footer">
							<div class="header-products-main__quantity">
								<?php 
								// Get total count of unsold vehicles
								$total_vehicles = wp_count_posts( 'vehicle' );
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
								$count = count( $unsold_count );
								
								if ( $count > 0 ) {
									printf( 
										'%s <span>%d</span> %s',
										esc_html__( 'Over', 'vroomqc' ),
										$count,
										esc_html( _n( 'car available', 'cars available', $count, 'vroomqc' ) )
									);
								} else {
									esc_html_e( 'No cars available at the moment', 'vroomqc' );
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
										<li class="select__item" data-select-menu-option>
											<button type="button" class="select__button"><?php esc_html_e( 'cheapest', 'vroomqc' ); ?></button>
										</li>
										<li class="select__item" data-select-menu-option>
											<button type="button" class="select__button"><?php esc_html_e( 'most expensive', 'vroomqc' ); ?></button>
										</li>
										<li class="select__item" data-select-menu-option>
											<button type="button" class="select__button"><?php esc_html_e( 'Newest listings', 'vroomqc' ); ?></button>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="body-products-main__products">
						<div class="products products-alt">
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
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<?php
get_footer();