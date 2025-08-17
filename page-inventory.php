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
				<h1 class='header-products__title' id='products-title'>
					<?php esc_html_e( 'Used cars for sale in Quebec', 'vroomqc' ); ?>
				</h1>
				<div class="header-products__subtitle">
					<?php esc_html_e( 'Browse our selection of quality used vehicles. All cars are inspected and come with our guarantee.', 'vroomqc' ); ?>
				</div>
			</div>
			
			<div class="body-products">
				<aside class="body-products__aside" data-filter>
					<div class="body-products-aside__wrapper">
						<div class="body-products-aside__header">
							<h2 class="body-products-aside__title">
								<?php esc_html_e( 'Filters', 'vroomqc' ); ?>
							</h2>
							<button class="body-products-aside__close" data-close-filter aria-label="<?php esc_attr_e( 'close filter', 'vroomqc' ); ?>">
								<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#cross-red' ); ?>
							</button>
						</div>
						
						<div class="body-products-aside__content">
							<div class="body-products-aside__content-slider">
								<div class="body-products-aside__price-slider">
									<h3 class="body-products-aside__title-sm">
										<?php esc_html_e( 'Price', 'vroomqc' ); ?>
									</h3>
									<div id="products-range-slider" data-min-value="10000" data-max-value="60000"></div>
									<div class="body-products-aside__price-inputs">
										<input type="text" class="body-products-aside__price-input" id="producs-price-min-input" readonly>
										<input type="text" class="body-products-aside__price-input" id="producs-price-max-input" readonly>
									</div>
								</div>
							</div>
							
							<div class="body-products-aside__group">
								<h3 class="body-products-aside__title-sm">
									<?php esc_html_e( 'Body type', 'vroomqc' ); ?>
								</h3>
								<div class="body-products-aside__checkboxes">
									<label class="body-products-aside__checkbox">
										<input type="checkbox" class="body-products-aside__checkbox-input">
										<span class="body-products-aside__checkbox-fake"></span>
										<span class="body-products-aside__checkbox-text"><?php esc_html_e( 'SUV', 'vroomqc' ); ?></span>
									</label>
									<label class="body-products-aside__checkbox">
										<input type="checkbox" class="body-products-aside__checkbox-input">
										<span class="body-products-aside__checkbox-fake"></span>
										<span class="body-products-aside__checkbox-text"><?php esc_html_e( 'Sedan', 'vroomqc' ); ?></span>
									</label>
									<label class="body-products-aside__checkbox">
										<input type="checkbox" class="body-products-aside__checkbox-input">
										<span class="body-products-aside__checkbox-fake"></span>
										<span class="body-products-aside__checkbox-text"><?php esc_html_e( 'Hatchback', 'vroomqc' ); ?></span>
									</label>
									<label class="body-products-aside__checkbox">
										<input type="checkbox" class="body-products-aside__checkbox-input">
										<span class="body-products-aside__checkbox-fake"></span>
										<span class="body-products-aside__checkbox-text"><?php esc_html_e( 'Coupe', 'vroomqc' ); ?></span>
									</label>
								</div>
							</div>
							
							<div class="body-products-aside__group">
								<h3 class="body-products-aside__title-sm">
									<?php esc_html_e( 'Make', 'vroomqc' ); ?>
								</h3>
								<div class="body-products-aside__checkboxes">
									<label class="body-products-aside__checkbox">
										<input type="checkbox" class="body-products-aside__checkbox-input">
										<span class="body-products-aside__checkbox-fake"></span>
										<span class="body-products-aside__checkbox-text"><?php esc_html_e( 'Honda', 'vroomqc' ); ?></span>
									</label>
									<label class="body-products-aside__checkbox">
										<input type="checkbox" class="body-products-aside__checkbox-input">
										<span class="body-products-aside__checkbox-fake"></span>
										<span class="body-products-aside__checkbox-text"><?php esc_html_e( 'Toyota', 'vroomqc' ); ?></span>
									</label>
									<label class="body-products-aside__checkbox">
										<input type="checkbox" class="body-products-aside__checkbox-input">
										<span class="body-products-aside__checkbox-fake"></span>
										<span class="body-products-aside__checkbox-text"><?php esc_html_e( 'Nissan', 'vroomqc' ); ?></span>
									</label>
									<label class="body-products-aside__checkbox">
										<input type="checkbox" class="body-products-aside__checkbox-input">
										<span class="body-products-aside__checkbox-fake"></span>
										<span class="body-products-aside__checkbox-text"><?php esc_html_e( 'BMW', 'vroomqc' ); ?></span>
									</label>
									<label class="body-products-aside__checkbox">
										<input type="checkbox" class="body-products-aside__checkbox-input">
										<span class="body-products-aside__checkbox-fake"></span>
										<span class="body-products-aside__checkbox-text"><?php esc_html_e( 'Mercedes-Benz', 'vroomqc' ); ?></span>
									</label>
									<label class="body-products-aside__checkbox">
										<input type="checkbox" class="body-products-aside__checkbox-input">
										<span class="body-products-aside__checkbox-fake"></span>
										<span class="body-products-aside__checkbox-text"><?php esc_html_e( 'Audi', 'vroomqc' ); ?></span>
									</label>
								</div>
							</div>
							
							<div class="body-products-aside__group">
								<h3 class="body-products-aside__title-sm">
									<?php esc_html_e( 'Year', 'vroomqc' ); ?>
								</h3>
								<div class="body-products-aside__checkboxes">
									<label class="body-products-aside__checkbox">
										<input type="checkbox" class="body-products-aside__checkbox-input">
										<span class="body-products-aside__checkbox-fake"></span>
										<span class="body-products-aside__checkbox-text"><?php esc_html_e( '2023', 'vroomqc' ); ?></span>
									</label>
									<label class="body-products-aside__checkbox">
										<input type="checkbox" class="body-products-aside__checkbox-input">
										<span class="body-products-aside__checkbox-fake"></span>
										<span class="body-products-aside__checkbox-text"><?php esc_html_e( '2022', 'vroomqc' ); ?></span>
									</label>
									<label class="body-products-aside__checkbox">
										<input type="checkbox" class="body-products-aside__checkbox-input">
										<span class="body-products-aside__checkbox-fake"></span>
										<span class="body-products-aside__checkbox-text"><?php esc_html_e( '2021', 'vroomqc' ); ?></span>
									</label>
									<label class="body-products-aside__checkbox">
										<input type="checkbox" class="body-products-aside__checkbox-input">
										<span class="body-products-aside__checkbox-fake"></span>
										<span class="body-products-aside__checkbox-text"><?php esc_html_e( '2020', 'vroomqc' ); ?></span>
									</label>
									<label class="body-products-aside__checkbox">
										<input type="checkbox" class="body-products-aside__checkbox-input">
										<span class="body-products-aside__checkbox-fake"></span>
										<span class="body-products-aside__checkbox-text"><?php esc_html_e( '2019', 'vroomqc' ); ?></span>
									</label>
								</div>
							</div>
							
							<div class="body-products-aside__group">
								<h3 class="body-products-aside__title-sm">
									<?php esc_html_e( 'Transmission', 'vroomqc' ); ?>
								</h3>
								<div class="body-products-aside__checkboxes">
									<label class="body-products-aside__checkbox">
										<input type="checkbox" class="body-products-aside__checkbox-input">
										<span class="body-products-aside__checkbox-fake"></span>
										<span class="body-products-aside__checkbox-text"><?php esc_html_e( 'Automatic', 'vroomqc' ); ?></span>
									</label>
									<label class="body-products-aside__checkbox">
										<input type="checkbox" class="body-products-aside__checkbox-input">
										<span class="body-products-aside__checkbox-fake"></span>
										<span class="body-products-aside__checkbox-text"><?php esc_html_e( 'Manual', 'vroomqc' ); ?></span>
									</label>
									<label class="body-products-aside__checkbox">
										<input type="checkbox" class="body-products-aside__checkbox-input">
										<span class="body-products-aside__checkbox-fake"></span>
										<span class="body-products-aside__checkbox-text"><?php esc_html_e( 'CVT', 'vroomqc' ); ?></span>
									</label>
								</div>
							</div>
						</div>
					</div>
				</aside>
				
				<div class="body-products__content">
					<div class="body-products-content__header">
						<div class="body-products-content__found">
							<?php esc_html_e( '234 cars found', 'vroomqc' ); ?>
						</div>
						<button class="body-products-content__filter-button" data-open-filter>
							<?php esc_html_e( 'Filters', 'vroomqc' ); ?>
						</button>
					</div>
					
					<div class="products-grid products products-alt">
						<a href="#" class="products__item">
							<div class="products__image ibg">
								<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/inventory/products/product_01.jpg' ); ?>" loading="lazy" alt="<?php esc_attr_e( 'car', 'vroomqc' ); ?>">
							</div>
							<div class="products__info">
								<h2 class="products__model">
									<?php esc_html_e( '2020 Honda CR-V', 'vroomqc' ); ?>
								</h2>
								<div class="products__details">
									<span class="products__mileage">
										<?php esc_html_e( '65,783 km', 'vroomqc' ); ?>
									</span>
									<span class="products__gearbox">
										<?php esc_html_e( 'Automatic', 'vroomqc' ); ?>
									</span>
								</div>
							</div>
							<div class="products__footer">
								<div class="products__price">
									<span class="products__value">$30,490</span>
								</div>
								<div class="products__offer">
									<?php esc_html_e( 'or', 'vroomqc' ); ?> <span class="products__option">$205/<?php esc_html_e( 'biweekly', 'vroomqc' ); ?></span> <?php esc_html_e( '$0 cash down', 'vroomqc' ); ?>
								</div>
							</div>
						</a>
						<a href="#" class="products__item">
							<div class="products__image ibg">
								<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/inventory/products/product_02.jpg' ); ?>" loading="lazy" alt="<?php esc_attr_e( 'car', 'vroomqc' ); ?>">
							</div>
							<div class="products__info">
								<h2 class="products__model">
									<?php esc_html_e( '2022 Volkswagen Tiguan', 'vroomqc' ); ?>
								</h2>
								<div class="products__details">
									<span class="products__mileage">
										<?php esc_html_e( '49,972 km', 'vroomqc' ); ?>
									</span>
									<span class="products__gearbox">
										<?php esc_html_e( 'Automatic', 'vroomqc' ); ?>
									</span>
								</div>
							</div>
							<div class="products__footer">
								<div class="products__price">
									<span class="products__value">$30,990</span>
								</div>
								<div class="products__offer">
									<?php esc_html_e( 'or', 'vroomqc' ); ?> <span class="products__option">$208/<?php esc_html_e( 'biweekly', 'vroomqc' ); ?></span> <?php esc_html_e( '$0 cash down', 'vroomqc' ); ?>
								</div>
							</div>
						</a>
						<a href="#" class="products__item">
							<div class="products__image ibg">
								<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/inventory/products/product_03.jpg' ); ?>" loading="lazy" alt="<?php esc_attr_e( 'car', 'vroomqc' ); ?>">
							</div>
							<div class="products__info">
								<h2 class="products__model">
									<?php esc_html_e( '2023 Toyota RAV4', 'vroomqc' ); ?>
								</h2>
								<div class="products__details">
									<span class="products__mileage">
										<?php esc_html_e( '63,205 km', 'vroomqc' ); ?>
									</span>
									<span class="products__gearbox">
										<?php esc_html_e( 'Automatic', 'vroomqc' ); ?>
									</span>
								</div>
							</div>
							<div class="products__footer">
								<div class="products__price">
									<span class="products__value">$33,990</span>
								</div>
								<div class="products__offer">
									<?php esc_html_e( 'or', 'vroomqc' ); ?> <span class="products__option">$227/<?php esc_html_e( 'biweekly', 'vroomqc' ); ?></span> <?php esc_html_e( '$0 cash down', 'vroomqc' ); ?>
								</div>
							</div>
						</a>
						<a href="#" class="products__item">
							<div class="products__image ibg">
								<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/inventory/products/product_04.jpg' ); ?>" loading="lazy" alt="<?php esc_attr_e( 'car', 'vroomqc' ); ?>">
							</div>
							<div class="products__info">
								<h2 class="products__model">
									<?php esc_html_e( '2022 Hyundai Santa Fe', 'vroomqc' ); ?>
								</h2>
								<div class="products__details">
									<span class="products__mileage">
										<?php esc_html_e( '54,430 km', 'vroomqc' ); ?>
									</span>
									<span class="products__gearbox">
										<?php esc_html_e( 'Manual', 'vroomqc' ); ?>
									</span>
								</div>
							</div>
							<div class="products__footer">
								<div class="products__price">
									<span class="products__value">$30,490</span>
								</div>
								<div class="products__offer">
									<?php esc_html_e( 'or', 'vroomqc' ); ?> <span class="products__option">$205/<?php esc_html_e( 'biweekly', 'vroomqc' ); ?></span> <?php esc_html_e( '$0 cash down', 'vroomqc' ); ?>
								</div>
							</div>
						</a>
						<a href="#" class="products__item">
							<div class="products__image ibg">
								<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/inventory/products/product_05.jpg' ); ?>" loading="lazy" alt="<?php esc_attr_e( 'car', 'vroomqc' ); ?>">
							</div>
							<div class="products__info">
								<h2 class="products__model">
									<?php esc_html_e( '2022 Toyota RAV4', 'vroomqc' ); ?>
								</h2>
								<div class="products__details">
									<span class="products__mileage">
										<?php esc_html_e( '40,676 km', 'vroomqc' ); ?>
									</span>
									<span class="products__gearbox">
										<?php esc_html_e( 'Manual', 'vroomqc' ); ?>
									</span>
								</div>
							</div>
							<div class="products__footer">
								<div class="products__price">
									<span class="products__value">$35,990</span>
								</div>
								<div class="products__offer">
									<?php esc_html_e( 'or', 'vroomqc' ); ?> <span class="products__option">$240/<?php esc_html_e( 'biweekly', 'vroomqc' ); ?></span> <?php esc_html_e( '$0 cash down', 'vroomqc' ); ?>
								</div>
							</div>
						</a>
						<a href="#" class="products__item">
							<div class="products__image ibg">
								<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/inventory/products/product_06.jpg' ); ?>" loading="lazy" alt="<?php esc_attr_e( 'car', 'vroomqc' ); ?>">
							</div>
							<div class="products__info">
								<h2 class="products__model">
									<?php esc_html_e( '2023 Nissan Rogue', 'vroomqc' ); ?>
								</h2>
								<div class="products__details">
									<span class="products__mileage">
										<?php esc_html_e( '6,645 km', 'vroomqc' ); ?>
									</span>
									<span class="products__gearbox">
										<?php esc_html_e( 'Automatic', 'vroomqc' ); ?>
									</span>
								</div>
							</div>
							<div class="products__footer">
								<div class="products__price">
									<span class="products__value">$33,490</span>
								</div>
								<div class="products__offer">
									<?php esc_html_e( 'or', 'vroomqc' ); ?> <span class="products__option">$224/<?php esc_html_e( 'biweekly', 'vroomqc' ); ?></span> <?php esc_html_e( '$0 cash down', 'vroomqc' ); ?>
								</div>
							</div>
						</a>
						<a href="#" class="products__item">
							<div class="products__image ibg">
								<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/inventory/products/product_07.jpg' ); ?>" loading="lazy" alt="<?php esc_attr_e( 'car', 'vroomqc' ); ?>">
							</div>
							<div class="products__info">
								<h2 class="products__model">
									<?php esc_html_e( '2021 Mazda CX-5', 'vroomqc' ); ?>
								</h2>
								<div class="products__details">
									<span class="products__mileage">
										<?php esc_html_e( '35,420 km', 'vroomqc' ); ?>
									</span>
									<span class="products__gearbox">
										<?php esc_html_e( 'Automatic', 'vroomqc' ); ?>
									</span>
								</div>
							</div>
							<div class="products__footer">
								<div class="products__price">
									<span class="products__value">$28,990</span>
								</div>
								<div class="products__offer">
									<?php esc_html_e( 'or', 'vroomqc' ); ?> <span class="products__option">$195/<?php esc_html_e( 'biweekly', 'vroomqc' ); ?></span> <?php esc_html_e( '$0 cash down', 'vroomqc' ); ?>
								</div>
							</div>
						</a>
						<a href="#" class="products__item">
							<div class="products__image ibg">
								<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/inventory/products/product_08.jpg' ); ?>" loading="lazy" alt="<?php esc_attr_e( 'car', 'vroomqc' ); ?>">
							</div>
							<div class="products__info">
								<h2 class="products__model">
									<?php esc_html_e( '2020 Subaru Outback', 'vroomqc' ); ?>
								</h2>
								<div class="products__details">
									<span class="products__mileage">
										<?php esc_html_e( '78,234 km', 'vroomqc' ); ?>
									</span>
									<span class="products__gearbox">
										<?php esc_html_e( 'CVT', 'vroomqc' ); ?>
									</span>
								</div>
							</div>
							<div class="products__footer">
								<div class="products__price">
									<span class="products__value">$26,490</span>
								</div>
								<div class="products__offer">
									<?php esc_html_e( 'or', 'vroomqc' ); ?> <span class="products__option">$178/<?php esc_html_e( 'biweekly', 'vroomqc' ); ?></span> <?php esc_html_e( '$0 cash down', 'vroomqc' ); ?>
								</div>
							</div>
						</a>
						<a href="#" class="products__item">
							<div class="products__image ibg">
								<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/inventory/products/product_09.jpg' ); ?>" loading="lazy" alt="<?php esc_attr_e( 'car', 'vroomqc' ); ?>">
							</div>
							<div class="products__info">
								<h2 class="products__model">
									<?php esc_html_e( '2023 Ford Escape', 'vroomqc' ); ?>
								</h2>
								<div class="products__details">
									<span class="products__mileage">
										<?php esc_html_e( '12,450 km', 'vroomqc' ); ?>
									</span>
									<span class="products__gearbox">
										<?php esc_html_e( 'Automatic', 'vroomqc' ); ?>
									</span>
								</div>
							</div>
							<div class="products__footer">
								<div class="products__price">
									<span class="products__value">$31,990</span>
								</div>
								<div class="products__offer">
									<?php esc_html_e( 'or', 'vroomqc' ); ?> <span class="products__option">$215/<?php esc_html_e( 'biweekly', 'vroomqc' ); ?></span> <?php esc_html_e( '$0 cash down', 'vroomqc' ); ?>
								</div>
							</div>
						</a>
						<a href="#" class="products__item">
							<div class="products__image ibg">
								<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/inventory/products/product_10.jpg' ); ?>" loading="lazy" alt="<?php esc_attr_e( 'car', 'vroomqc' ); ?>">
							</div>
							<div class="products__info">
								<h2 class="products__model">
									<?php esc_html_e( '2019 Chevrolet Equinox', 'vroomqc' ); ?>
								</h2>
								<div class="products__details">
									<span class="products__mileage">
										<?php esc_html_e( '89,567 km', 'vroomqc' ); ?>
									</span>
									<span class="products__gearbox">
										<?php esc_html_e( 'Automatic', 'vroomqc' ); ?>
									</span>
								</div>
							</div>
							<div class="products__footer">
								<div class="products__price">
									<span class="products__value">$22,490</span>
								</div>
								<div class="products__offer">
									<?php esc_html_e( 'or', 'vroomqc' ); ?> <span class="products__option">$152/<?php esc_html_e( 'biweekly', 'vroomqc' ); ?></span> <?php esc_html_e( '$0 cash down', 'vroomqc' ); ?>
								</div>
							</div>
						</a>
						<a href="#" class="products__item">
							<div class="products__image ibg">
								<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/inventory/products/product_11.jpg' ); ?>" loading="lazy" alt="<?php esc_attr_e( 'car', 'vroomqc' ); ?>">
							</div>
							<div class="products__info">
								<h2 class="products__model">
									<?php esc_html_e( '2021 Kia Sorento', 'vroomqc' ); ?>
								</h2>
								<div class="products__details">
									<span class="products__mileage">
										<?php esc_html_e( '45,821 km', 'vroomqc' ); ?>
									</span>
									<span class="products__gearbox">
										<?php esc_html_e( 'Automatic', 'vroomqc' ); ?>
									</span>
								</div>
							</div>
							<div class="products__footer">
								<div class="products__price">
									<span class="products__value">$29,990</span>
								</div>
								<div class="products__offer">
									<?php esc_html_e( 'or', 'vroomqc' ); ?> <span class="products__option">$201/<?php esc_html_e( 'biweekly', 'vroomqc' ); ?></span> <?php esc_html_e( '$0 cash down', 'vroomqc' ); ?>
								</div>
							</div>
						</a>
						<a href="#" class="products__item">
							<div class="products__image ibg">
								<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/inventory/products/product_12.jpg' ); ?>" loading="lazy" alt="<?php esc_attr_e( 'car', 'vroomqc' ); ?>">
							</div>
							<div class="products__info">
								<h2 class="products__model">
									<?php esc_html_e( '2020 Jeep Grand Cherokee', 'vroomqc' ); ?>
								</h2>
								<div class="products__details">
									<span class="products__mileage">
										<?php esc_html_e( '72,145 km', 'vroomqc' ); ?>
									</span>
									<span class="products__gearbox">
										<?php esc_html_e( 'Automatic', 'vroomqc' ); ?>
									</span>
								</div>
							</div>
							<div class="products__footer">
								<div class="products__price">
									<span class="products__value">$34,990</span>
								</div>
								<div class="products__offer">
									<?php esc_html_e( 'or', 'vroomqc' ); ?> <span class="products__option">$235/<?php esc_html_e( 'biweekly', 'vroomqc' ); ?></span> <?php esc_html_e( '$0 cash down', 'vroomqc' ); ?>
								</div>
							</div>
						</a>
						<a href="#" class="products__item">
							<div class="products__image ibg">
								<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/inventory/products/product_13.jpg' ); ?>" loading="lazy" alt="<?php esc_attr_e( 'car', 'vroomqc' ); ?>">
							</div>
							<div class="products__info">
								<h2 class="products__model">
									<?php esc_html_e( '2022 BMW X3', 'vroomqc' ); ?>
								</h2>
								<div class="products__details">
									<span class="products__mileage">
										<?php esc_html_e( '28,567 km', 'vroomqc' ); ?>
									</span>
									<span class="products__gearbox">
										<?php esc_html_e( 'Automatic', 'vroomqc' ); ?>
									</span>
								</div>
							</div>
							<div class="products__footer">
								<div class="products__price">
									<span class="products__value">$45,990</span>
								</div>
								<div class="products__offer">
									<?php esc_html_e( 'or', 'vroomqc' ); ?> <span class="products__option">$309/<?php esc_html_e( 'biweekly', 'vroomqc' ); ?></span> <?php esc_html_e( '$0 cash down', 'vroomqc' ); ?>
								</div>
							</div>
						</a>
						<a href="#" class="products__item">
							<div class="products__image ibg">
								<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/inventory/products/product_14.jpg' ); ?>" loading="lazy" alt="<?php esc_attr_e( 'car', 'vroomqc' ); ?>">
							</div>
							<div class="products__info">
								<h2 class="products__model">
									<?php esc_html_e( '2021 Audi Q5', 'vroomqc' ); ?>
								</h2>
								<div class="products__details">
									<span class="products__mileage">
										<?php esc_html_e( '38,921 km', 'vroomqc' ); ?>
									</span>
									<span class="products__gearbox">
										<?php esc_html_e( 'Automatic', 'vroomqc' ); ?>
									</span>
								</div>
							</div>
							<div class="products__footer">
								<div class="products__price">
									<span class="products__value">$42,990</span>
								</div>
								<div class="products__offer">
									<?php esc_html_e( 'or', 'vroomqc' ); ?> <span class="products__option">$289/<?php esc_html_e( 'biweekly', 'vroomqc' ); ?></span> <?php esc_html_e( '$0 cash down', 'vroomqc' ); ?>
								</div>
							</div>
						</a>
						<a href="#" class="products__item">
							<div class="products__image ibg">
								<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/inventory/products/product_15.jpg' ); ?>" loading="lazy" alt="<?php esc_attr_e( 'car', 'vroomqc' ); ?>">
							</div>
							<div class="products__info">
								<h2 class="products__model">
									<?php esc_html_e( '2020 Mercedes-Benz GLC', 'vroomqc' ); ?>
								</h2>
								<div class="products__details">
									<span class="products__mileage">
										<?php esc_html_e( '52,384 km', 'vroomqc' ); ?>
									</span>
									<span class="products__gearbox">
										<?php esc_html_e( 'Automatic', 'vroomqc' ); ?>
									</span>
								</div>
							</div>
							<div class="products__footer">
								<div class="products__price">
									<span class="products__value">$48,990</span>
								</div>
								<div class="products__offer">
									<?php esc_html_e( 'or', 'vroomqc' ); ?> <span class="products__option">$329/<?php esc_html_e( 'biweekly', 'vroomqc' ); ?></span> <?php esc_html_e( '$0 cash down', 'vroomqc' ); ?>
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<?php
get_footer();