<?php
/**
 * The front page template file
 *
 * @package vroomqc
 */

get_header();
?>

<main class="page">
	<section class="hero-home" aria-labelledby="hero-home-title">
		<div class="hero-home__background ibg">
			<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/homepage/hero/hero-bakcground.jpg' ); ?>" fetchpriority="high" loading="eager" alt="<?php esc_attr_e( 'hero background', 'vroomqc' ); ?>">
		</div>
		<div class="hero-home__container">
			<div class="hero-home__body">
				<div class="hero-home__info">
					<h1 class="hero-home__title" id="hero-home-title">
						<?php esc_html_e( 'Buy or sell your car — 100% online.', 'vroomqc' ); ?>
					</h1>
					<div class="hero-home__subtitle">
						<?php esc_html_e( 'Get pre-qualified in minutes. Delivery in 24h. Québec-based and human-backed.', 'vroomqc' ); ?>
					</div>
					<div class="hero-home__stats">
						<div class="hero-home__icon">
							<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#google-icon' ); ?>
						</div>
						<div class="hero-home__reviews">
							<div class="hero-home__caption">
								<span class="hero-home__rating">
									<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#rating-icon' ); ?>
								</span>
								<span class="hero-home__text">
									<?php esc_html_e( '4.9 Google (1,800+)', 'vroomqc' ); ?>
								</span>
							</div>
							<div class="hero-home__details">
								<?php esc_html_e( '"Approved and delivered in 24h." – Claire T.', 'vroomqc' ); ?>
							</div>
						</div>
					</div>
				</div>
				<div class="actions-hero-home">
					<h2 class="actions-hero-home__title">
						<?php esc_html_e( 'Get pre-approved in 2 minutes', 'vroomqc' ); ?>
					</h2>
					<form action="#" class="actions-hero-home__form">
						<div class="actions-hero-home__items">
							<div class="actions-hero-home__item">
								<label for="full-name" class="actions-hero-home__label"><?php esc_html_e( 'Full name', 'vroomqc' ); ?></label>
								<input type="text" placeholder="<?php esc_attr_e( 'Pedro Resende', 'vroomqc' ); ?>" name="name" id="full-name" class="actions-hero-home__input">
							</div>
							<div class="actions-hero-home__item">
								<label for="email" class="actions-hero-home__label"><?php esc_html_e( 'Email address', 'vroomqc' ); ?></label>
								<input type="email" placeholder="<?php esc_attr_e( 'you@example.com', 'vroomqc' ); ?>" name="email" id="email" class="actions-hero-home__input">
							</div>
							<div class="actions-hero-home__item">
								<label for="phone" class="actions-hero-home__label"><?php esc_html_e( 'Phone (Optional)', 'vroomqc' ); ?></label>
								<input type="tel" placeholder="<?php esc_attr_e( '+1 (514) 123‑4567', 'vroomqc' ); ?>" name="phone" id="phone" class="actions-hero-home__input">
							</div>
						</div>
						<button type="submit" class="actions-hero-home__button button">
							<?php esc_html_e( 'Get started', 'vroomqc' ); ?>
						</button>
						<div class="actions-hero-home__disclaimer">
							<?php esc_html_e( 'Takes 2 minutes. No impact on your credit.', 'vroomqc' ); ?>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>

	<section class="offer" aria-labelledby="offer-title">
		<div class="offer__container">
			<div class="offer__body">
				<div class="offer__decor">
					<h2 class="offer__title title" id="offer-title">
						<?php esc_html_e( 'Skip the hassle. Buy or sell.', 'vroomqc' ); ?>
					</h2>
					<div class="offer__image">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/homepage/buy-or-sell/decor.jpg' ); ?>" loading="lazy" alt="<?php esc_attr_e( 'car', 'vroomqc' ); ?>">
					</div>
				</div>
				<div class="offer__content">
					<div class="offer__column">
						<h3 class="offer__caption">
							<?php esc_html_e( 'Buy a car', 'vroomqc' ); ?>
						</h3>
						<ul class="offer__list">
							<li class="offer__item">
								<?php esc_html_e( '100% online, no dealerships', 'vroomqc' ); ?>
							</li>
							<li class="offer__item">
								<?php esc_html_e( 'Fast pre-approval', 'vroomqc' ); ?>
							</li>
							<li class="offer__item">
								<?php esc_html_e( '24h home delivery', 'vroomqc' ); ?>
							</li>
							<li class="offer__item">
								<?php esc_html_e( 'Trusted local support', 'vroomqc' ); ?>
							</li>
						</ul>
						<a href="#" class="offer__button button">
							<?php esc_html_e( 'Browse cars', 'vroomqc' ); ?>
						</a>
					</div>
					<div class="offer__column offer__column-dbg">
						<h3 class="offer__caption">
							<?php esc_html_e( 'Sell your car', 'vroomqc' ); ?>
						</h3>
						<ul class="offer__list">
							<li class="offer__item">
								<?php esc_html_e( 'Instant local offers', 'vroomqc' ); ?>
							</li>
							<li class="offer__item">
								<?php esc_html_e( 'Sell or trade-in fast', 'vroomqc' ); ?>
							</li>
							<li class="offer__item">
								<?php esc_html_e( 'No listings or haggling', 'vroomqc' ); ?>
							</li>
							<li class="offer__item">
								<?php esc_html_e( 'Drop-off or pickup', 'vroomqc' ); ?>
							</li>
						</ul>
						<a href="#" class="offer__button button button-transparent">
							<?php esc_html_e( 'Get an offer', 'vroomqc' ); ?>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="top-picks" aria-labelledby="top-picks-title">
		<div class="top-picks__container">
			<h2 class="top-picks__title title" id="top-picks-title">
				<?php esc_html_e( 'Top picks in Québec', 'vroomqc' ); ?>
			</h2>
			<div class="top-picks__body" data-filter>
				<div class="top-picks__nav nav-top-picks">
					<div class="nav-top-picks__items">
						<button type="button" class="nav-top-picks__button _active" data-filter-category='all'>
							<?php esc_html_e( 'All', 'vroomqc' ); ?>
						</button>
						<button type="button" class="nav-top-picks__button" data-filter-category='suv'>
							<?php esc_html_e( 'SUV', 'vroomqc' ); ?>
						</button>
						<button type="button" class="nav-top-picks__button" data-filter-category='sedan'>
							<?php esc_html_e( 'Sedan', 'vroomqc' ); ?>
						</button>
						<button type="button" class="nav-top-picks__button" data-filter-category='hybrid'>
							<?php esc_html_e( 'Hybrid', 'vroomqc' ); ?>
						</button>
						<button type="button" class="nav-top-picks__button" data-filter-category='up-to-15k'>
							<?php esc_html_e( 'Budget (<$15K)', 'vroomqc' ); ?>
						</button>
						<button type="button" class="nav-top-picks__button" data-filter-category='awd'>
							<?php esc_html_e( 'AWD / 4WD', 'vroomqc' ); ?>
						</button>
						<button type="button" class="nav-top-picks__button" data-filter-category='new'>
							<?php esc_html_e( 'New arrivals', 'vroomqc' ); ?>
						</button>
						<button type="button" class="nav-top-picks__button" data-filter-category='fuel-efficient'>
							<?php esc_html_e( 'Fuel efficient', 'vroomqc' ); ?>
						</button>
						<button type="button" class="nav-top-picks__button" data-filter-category='more'>
							<?php esc_html_e( '+ More', 'vroomqc' ); ?>
						</button>
					</div>
				</div>
				<div class="content-top-picks">
					<div class="products">
						<?php
						// Query for featured vehicles (not sold)
						$featured_vehicles = new WP_Query( array(
							'post_type' => 'vehicle',
							'posts_per_page' => 6,
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

						if ( $featured_vehicles->have_posts() ) :
							$filter_options = array( 'suv', 'hybrid,up-to-15k', 'awd,new', 'fuel-efficient,more', 'suv,sedan', 'awd,new' );
							$index = 0;
							
							while ( $featured_vehicles->have_posts() ) : $featured_vehicles->the_post();
								$filter_content = isset( $filter_options[ $index ] ) ? $filter_options[ $index ] : '';
								
								set_query_var( 'vehicle_id', get_the_ID() );
								set_query_var( 'filter_content', $filter_content );
								get_template_part( 'template-parts/vehicle/card-small' );
								
								$index++;
							endwhile;
							wp_reset_postdata();
						else :
							// Fallback: Show message if no vehicles found
							echo '<p class="no-vehicles-message">' . esc_html__( 'No vehicles available at the moment.', 'vroomqc' ) . '</p>';
						endif;
						?>
					</div>
				</div>
			</div>
			<div class="top-picks__footer">
				<ul class="top-picks__list">
					<li class="top-picks__item">
						<a href="#" class="top-picks__link">
							<?php esc_html_e( 'Explore more SUVs', 'vroomqc' ); ?>
						</a>
					</li>
					<li class="top-picks__item">
						<a href="#" class="top-picks__link">
							<?php esc_html_e( 'See full inventory', 'vroomqc' ); ?>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</section>

	<section class="home-about" aria-labelledby="home-about-title">
		<div class="home-about__container">
			<div class="home-about__body" data-filter>
				<div class="home-about__info">
					<h2 class="home-about__title title" id="home-about-title">
						<?php esc_html_e( 'How it works — start to finish', 'vroomqc' ); ?>
					</h2>
					<div class="home-about__subtitle">
						<?php esc_html_e( 'Learn how we make buying, selling, and financing your car 100% online — with fast approvals, local support, and zero pressure.', 'vroomqc' ); ?>
					</div>
					<div class="nav-home-about">
						<div class="nav-home-about__items">
							<button type="button" class="nav-home-about__button _active" data-filter-category='financing'>
								<span class="nav-home-about__icon">
									<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#how-works-icon_01' ); ?>
								</span>
								<span class="nav-home-about__caption">
									<?php esc_html_e( 'Financing', 'vroomqc' ); ?>
								</span>
							</button>
							<button type="button" class="nav-home-about__button" data-filter-category='buy-car'>
								<span class="nav-home-about__icon">
									<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#how-works-icon_02' ); ?>
								</span>
								<span class="nav-home-about__caption">
									<?php esc_html_e( 'Buy a car', 'vroomqc' ); ?>
								</span>
							</button>
							<button type="button" class="nav-home-about__button" data-filter-category='sell-car'>
								<span class="nav-home-about__icon">
									<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#how-works-icon_03' ); ?>
								</span>
								<span class="nav-home-about__caption">
									<?php esc_html_e( 'Sell your car', 'vroomqc' ); ?>
								</span>
							</button>
							<button type="button" class="nav-home-about__button" data-filter-category='trade-in'>
								<span class="nav-home-about__icon">
									<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#how-works-icon_04' ); ?>
								</span>
								<span class="nav-home-about__caption">
									<?php esc_html_e( 'Trade-In', 'vroomqc' ); ?>
								</span>
							</button>
							<button type="button" class="nav-home-about__button" data-filter-category='estimate-value'>
								<span class="nav-home-about__icon">
									<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#how-works-icon_05' ); ?>
								</span>
								<span class="nav-home-about__caption">
									<?php esc_html_e( 'Estimate value', 'vroomqc' ); ?>
								</span>
							</button>
						</div>
					</div>
				</div>
				<div class="content-home-about">
					<div class="content-home-about__items">
						<div class="content-home-about__item _show" data-filter-content="financing">
							<h2 class="content-home-about__title">
								<?php esc_html_e( 'Financing', 'vroomqc' ); ?>
							</h2>
							<div class="content-home-about__rows">
								<div class="content-home-about__row">
									<div class="content-home-about__icon content-home-about__icon-01">
										<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#how-works-icon_06' ); ?>
									</div>
									<div class="content-home-about__details">
										<h3 class="content-home-about__caption">
											<?php esc_html_e( 'Apply in 2 minutes', 'vroomqc' ); ?>
										</h3>
										<div class="content-home-about__text">
											<?php esc_html_e( 'Fill out a short form. No credit impact.', 'vroomqc' ); ?>
										</div>
									</div>
								</div>
								<div class="content-home-about__row">
									<div class="content-home-about__icon content-home-about__icon-02">
										<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#how-works-icon_07' ); ?>
									</div>
									<div class="content-home-about__details">
										<h3 class="content-home-about__caption">
											<?php esc_html_e( 'We\'ll connect you with a local lender', 'vroomqc' ); ?>
										</h3>
										<div class="content-home-about__text">
											<?php esc_html_e( 'We\'ll connect you with a local lender.', 'vroomqc' ); ?>
										</div>
									</div>
								</div>
								<div class="content-home-about__row">
									<div class="content-home-about__icon content-home-about__icon-03">
										<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#how-works-icon_08' ); ?>
									</div>
									<div class="content-home-about__details">
										<h3 class="content-home-about__caption">
											<?php esc_html_e( 'You\'re approved', 'vroomqc' ); ?>
										</h3>
										<div class="content-home-about__text">
											<?php esc_html_e( 'We confirm your offer and prep your car.', 'vroomqc' ); ?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="content-home-about__item" data-filter-content="buy-car">
							<h2 class="content-home-about__title">
								<?php esc_html_e( 'Buy a car', 'vroomqc' ); ?>
							</h2>
							<div class="content-home-about__rows">
								<div class="content-home-about__row">
									<div class="content-home-about__icon content-home-about__icon-01">
										<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#how-works-icon_06' ); ?>
									</div>
									<div class="content-home-about__details">
										<h3 class="content-home-about__caption">
											<?php esc_html_e( 'Browse online', 'vroomqc' ); ?>
										</h3>
										<div class="content-home-about__text">
											<?php esc_html_e( 'Shop our quality pre-owned inventory online.', 'vroomqc' ); ?>
										</div>
									</div>
								</div>
								<div class="content-home-about__row">
									<div class="content-home-about__icon content-home-about__icon-02">
										<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#how-works-icon_07' ); ?>
									</div>
									<div class="content-home-about__details">
										<h3 class="content-home-about__caption">
											<?php esc_html_e( 'Choose delivery', 'vroomqc' ); ?>
										</h3>
										<div class="content-home-about__text">
											<?php esc_html_e( 'We deliver to your home in 24-48 hours.', 'vroomqc' ); ?>
										</div>
									</div>
								</div>
								<div class="content-home-about__row">
									<div class="content-home-about__icon content-home-about__icon-03">
										<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#how-works-icon_08' ); ?>
									</div>
									<div class="content-home-about__details">
										<h3 class="content-home-about__caption">
											<?php esc_html_e( 'Drive with confidence', 'vroomqc' ); ?>
										</h3>
										<div class="content-home-about__text">
											<?php esc_html_e( 'All cars come with our quality guarantee.', 'vroomqc' ); ?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="content-home-about__item" data-filter-content="sell-car">
							<h2 class="content-home-about__title">
								<?php esc_html_e( 'Sell your car', 'vroomqc' ); ?>
							</h2>
							<div class="content-home-about__rows">
								<div class="content-home-about__row">
									<div class="content-home-about__icon content-home-about__icon-01">
										<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#how-works-icon_06' ); ?>
									</div>
									<div class="content-home-about__details">
										<h3 class="content-home-about__caption">
											<?php esc_html_e( 'Get a quote', 'vroomqc' ); ?>
										</h3>
										<div class="content-home-about__text">
											<?php esc_html_e( 'Tell us about your car and get an instant quote.', 'vroomqc' ); ?>
										</div>
									</div>
								</div>
								<div class="content-home-about__row">
									<div class="content-home-about__icon content-home-about__icon-02">
										<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#how-works-icon_07' ); ?>
									</div>
									<div class="content-home-about__details">
										<h3 class="content-home-about__caption">
											<?php esc_html_e( 'Schedule pickup', 'vroomqc' ); ?>
										</h3>
										<div class="content-home-about__text">
											<?php esc_html_e( 'We\'ll pick up your car or you can drop it off.', 'vroomqc' ); ?>
										</div>
									</div>
								</div>
								<div class="content-home-about__row">
									<div class="content-home-about__icon content-home-about__icon-03">
										<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#how-works-icon_08' ); ?>
									</div>
									<div class="content-home-about__details">
										<h3 class="content-home-about__caption">
											<?php esc_html_e( 'Get paid fast', 'vroomqc' ); ?>
										</h3>
										<div class="content-home-about__text">
											<?php esc_html_e( 'Once we inspect, you get paid on the spot.', 'vroomqc' ); ?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="content-home-about__item" data-filter-content="trade-in">
							<h2 class="content-home-about__title">
								<?php esc_html_e( 'Trade-In', 'vroomqc' ); ?>
							</h2>
							<div class="content-home-about__rows">
								<div class="content-home-about__row">
									<div class="content-home-about__icon content-home-about__icon-01">
										<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#how-works-icon_06' ); ?>
									</div>
									<div class="content-home-about__details">
										<h3 class="content-home-about__caption">
											<?php esc_html_e( 'Get trade-in value', 'vroomqc' ); ?>
										</h3>
										<div class="content-home-about__text">
											<?php esc_html_e( 'Find out what your car is worth instantly.', 'vroomqc' ); ?>
										</div>
									</div>
								</div>
								<div class="content-home-about__row">
									<div class="content-home-about__icon content-home-about__icon-02">
										<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#how-works-icon_07' ); ?>
									</div>
									<div class="content-home-about__details">
										<h3 class="content-home-about__caption">
											<?php esc_html_e( 'Apply credit', 'vroomqc' ); ?>
										</h3>
										<div class="content-home-about__text">
											<?php esc_html_e( 'Use trade-in value toward your new car.', 'vroomqc' ); ?>
										</div>
									</div>
								</div>
								<div class="content-home-about__row">
									<div class="content-home-about__icon content-home-about__icon-03">
										<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#how-works-icon_08' ); ?>
									</div>
									<div class="content-home-about__details">
										<h3 class="content-home-about__caption">
											<?php esc_html_e( 'Complete the deal', 'vroomqc' ); ?>
										</h3>
										<div class="content-home-about__text">
											<?php esc_html_e( 'We handle all the paperwork for you.', 'vroomqc' ); ?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="content-home-about__item" data-filter-content="estimate-value">
							<h2 class="content-home-about__title">
								<?php esc_html_e( 'Estimate value', 'vroomqc' ); ?>
							</h2>
							<div class="content-home-about__rows">
								<div class="content-home-about__row">
									<div class="content-home-about__icon content-home-about__icon-01">
										<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#how-works-icon_06' ); ?>
									</div>
									<div class="content-home-about__details">
										<h3 class="content-home-about__caption">
											<?php esc_html_e( 'Enter vehicle details', 'vroomqc' ); ?>
										</h3>
										<div class="content-home-about__text">
											<?php esc_html_e( 'Tell us about your car\'s make, model, and condition.', 'vroomqc' ); ?>
										</div>
									</div>
								</div>
								<div class="content-home-about__row">
									<div class="content-home-about__icon content-home-about__icon-02">
										<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#how-works-icon_07' ); ?>
									</div>
									<div class="content-home-about__details">
										<h3 class="content-home-about__caption">
											<?php esc_html_e( 'Get instant estimate', 'vroomqc' ); ?>
										</h3>
										<div class="content-home-about__text">
											<?php esc_html_e( 'Receive an accurate market value estimate.', 'vroomqc' ); ?>
										</div>
									</div>
								</div>
								<div class="content-home-about__row">
									<div class="content-home-about__icon content-home-about__icon-03">
										<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#how-works-icon_08' ); ?>
									</div>
									<div class="content-home-about__details">
										<h3 class="content-home-about__caption">
											<?php esc_html_e( 'Make informed decisions', 'vroomqc' ); ?>
										</h3>
										<div class="content-home-about__text">
											<?php esc_html_e( 'Use the estimate to plan your next move.', 'vroomqc' ); ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="reviews" aria-labelledby="reviews-title">
		<div class="reviews__container">
			<div class="reviews__body">
				<div class="reviews__info">
					<h2 class="reviews__title title" id="reviews-title">
						<?php esc_html_e( 'What our customers say', 'vroomqc' ); ?>
					</h2>
					<div class="reviews__subtitle">
						<p>
							<?php esc_html_e( 'Our customers love how quickly they get pre-approved and receive their vehicles. Most deliveries happen within 24-48 hours!', 'vroomqc' ); ?>
						</p>
					</div>
					<div class="reviews__nav">
						<button type="button" class="reviews__arrow reviews__arrow-prev">
							<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#arrow-icon-prev' ); ?>
						</button>
						<button type="button" class="reviews__arrow reviews__arrow-next">
							<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#arrow-icon-next' ); ?>
						</button>
					</div>
				</div>
				<div class="reviews__content content-reviews">
					<div class='content-reviews__swiper swiper'>
						<div class='content-reviews__wrapper swiper-wrapper'>
							<div class='content-reviews__slide swiper-slide'>
								<div class="content-reviews__body">
									<div class="content-reviews__header">
										<div class="content-reviews__avatar">
											<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/homepage/reviews/avatar_01.jpg' ); ?>" loading="lazy" alt="<?php esc_attr_e( 'avatar', 'vroomqc' ); ?>">
										</div>
										<div class="content-reviews__details">
											<h3 class="content-reviews__name">
												<?php esc_html_e( 'Claire Kelly', 'vroomqc' ); ?>
											</h3>
											<div class="content-reviews__time">
												<?php esc_html_e( '2 weeks ago', 'vroomqc' ); ?>
											</div>
										</div>
										<div class="content-reviews__icon">
											<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#google-icon' ); ?>
										</div>
									</div>
									<div class="content-reviews__rating">
										<span class="content-reviews__rating-item">
											<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#rating-icon' ); ?>
										</span>
										<span class="content-reviews__rating-item">
											<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#rating-icon' ); ?>
										</span>
										<span class="content-reviews__rating-item">
											<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#rating-icon' ); ?>
										</span>
										<span class="content-reviews__rating-item">
											<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#rating-icon' ); ?>
										</span>
										<span class="content-reviews__rating-item">
											<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#rating-icon' ); ?>
										</span>
									</div>
									<div class="content-reviews__text">
										<?php esc_html_e( 'I got pre-approved super fast and had my car delivered the next day. The whole process was seamless and the team was incredibly helpful throughout.', 'vroomqc' ); ?>
									</div>
								</div>
							</div>
							<div class='content-reviews__slide swiper-slide'>
								<div class="content-reviews__body">
									<div class="content-reviews__header">
										<div class="content-reviews__avatar">
											<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/homepage/reviews/avatar_02.jpg' ); ?>" loading="lazy" alt="<?php esc_attr_e( 'avatar', 'vroomqc' ); ?>">
										</div>
										<div class="content-reviews__details">
											<h3 class="content-reviews__name">
												<?php esc_html_e( 'Marcus Rodriguez', 'vroomqc' ); ?>
											</h3>
											<div class="content-reviews__time">
												<?php esc_html_e( '1 month ago', 'vroomqc' ); ?>
											</div>
										</div>
										<div class="content-reviews__icon">
											<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#google-icon' ); ?>
										</div>
									</div>
									<div class="content-reviews__rating">
										<span class="content-reviews__rating-item">
											<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#rating-icon' ); ?>
										</span>
										<span class="content-reviews__rating-item">
											<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#rating-icon' ); ?>
										</span>
										<span class="content-reviews__rating-item">
											<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#rating-icon' ); ?>
										</span>
										<span class="content-reviews__rating-item">
											<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#rating-icon' ); ?>
										</span>
										<span class="content-reviews__rating-item">
											<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#rating-icon' ); ?>
										</span>
									</div>
									<div class="content-reviews__text">
										<?php esc_html_e( 'Sold my old car and bought a new one through Vroom Quebec. Both transactions were smooth and I got great value. Highly recommend!', 'vroomqc' ); ?>
									</div>
								</div>
							</div>
							<div class='content-reviews__slide swiper-slide'>
								<div class="content-reviews__body">
									<div class="content-reviews__header">
										<div class="content-reviews__avatar">
											<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/homepage/reviews/avatar_03.jpg' ); ?>" loading="lazy" alt="<?php esc_attr_e( 'avatar', 'vroomqc' ); ?>">
										</div>
										<div class="content-reviews__details">
											<h3 class="content-reviews__name">
												<?php esc_html_e( 'Sarah Thompson', 'vroomqc' ); ?>
											</h3>
											<div class="content-reviews__time">
												<?php esc_html_e( '3 weeks ago', 'vroomqc' ); ?>
											</div>
										</div>
										<div class="content-reviews__icon">
											<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#google-icon' ); ?>
										</div>
									</div>
									<div class="content-reviews__rating">
										<span class="content-reviews__rating-item">
											<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#rating-icon' ); ?>
										</span>
										<span class="content-reviews__rating-item">
											<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#rating-icon' ); ?>
										</span>
										<span class="content-reviews__rating-item">
											<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#rating-icon' ); ?>
										</span>
										<span class="content-reviews__rating-item">
											<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#rating-icon' ); ?>
										</span>
										<span class="content-reviews__rating-item">
											<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#rating-icon' ); ?>
										</span>
									</div>
									<div class="content-reviews__text">
										<?php esc_html_e( 'Amazing experience! The financing was approved quickly and the delivery was right on time. The car was exactly as described online.', 'vroomqc' ); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class='brochure-home' aria-labelledby='brochure-home-title'>
		<div class='brochure-home__container'>
			<div class="brochure-home__body">
				<div class="brochure-home__info">
					<h2 class='brochure-home__title title' id='brochure-home-title'>
						<?php esc_html_e( 'Québec\'s smarter way to buy a car', 'vroomqc' ); ?>
					</h2>
					<div class="brochure-home__subtitle">
						<p>
							<?php esc_html_e( 'We make car buying simple. Browse our certified inventory, get pre-approved online, and enjoy delivery right to your door.', 'vroomqc' ); ?>
						</p>
					</div>
					<a href="#" class='brochure-home__button button'>
						<?php esc_html_e( 'Browse cars', 'vroomqc' ); ?>
					</a>
				</div>
				<div class="brochure-home__image">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/homepage/brochure/brochure__image_01.jpg' ); ?>" loading="lazy" alt="<?php esc_attr_e( 'brochure', 'vroomqc' ); ?>">
				</div>
			</div>
			<div class="brochure-home__footer">
				<div class="brochure-home__items">
					<div class="brochure-home__item">
						<div class="brochure-home__icon">
							<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#brochure-icon_01' ); ?>
						</div>
						<div class="brochure-home__details">
							<h3 class="brochure-home__name">
								<?php esc_html_e( 'Certified & road-ready', 'vroomqc' ); ?>
							</h3>
							<div class="brochure-home__text">
								<?php esc_html_e( 'Every car is inspected by local experts.', 'vroomqc' ); ?>
							</div>
						</div>
					</div>
					<div class="brochure-home__item">
						<div class="brochure-home__icon">
							<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#brochure-icon_02' ); ?>
						</div>
						<div class="brochure-home__details">
							<h3 class="brochure-home__name">
								<?php esc_html_e( 'Transparent pricing', 'vroomqc' ); ?>
							</h3>
							<div class="brochure-home__text">
								<?php esc_html_e( 'No hidden fees or surprise charges.', 'vroomqc' ); ?>
							</div>
						</div>
					</div>
					<div class="brochure-home__item">
						<div class="brochure-home__icon">
							<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#brochure-icon_03' ); ?>
						</div>
						<div class="brochure-home__details">
							<h3 class="brochure-home__name">
								<?php esc_html_e( '7-day return policy', 'vroomqc' ); ?>
							</h3>
							<div class="brochure-home__text">
								<?php esc_html_e( 'Not satisfied? Return within 7 days.', 'vroomqc' ); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class='faq' aria-labelledby='faq-title'>
		<div class='faq__container'>
			<div class="faq__body">
				<div class="faq__info">
					<h2 class='faq__title title' id='faq-title'>
						<?php esc_html_e( 'FAQ', 'vroomqc' ); ?>
					</h2>
					<div class="faq__subtitle">
						<?php esc_html_e( 'Answers to commonly asked questions about our car buying and selling process.', 'vroomqc' ); ?>
					</div>
				</div>
				<div class="content-faq" data-spollers data-one-spoller>
					<div class="content-faq__item">
						<button type="button" class="content-faq__header" data-spoller>
							<h3 class="content-faq__caption">
								<?php esc_html_e( 'How fast can I get pre-approved?', 'vroomqc' ); ?>
							</h3>
							<div class="content-faq__icon"></div>
						</button>
						<div class="content-faq__body">
							<?php esc_html_e( 'Most customers get pre-approved within 2 minutes. We use a soft credit check, so it won\'t impact your credit score.', 'vroomqc' ); ?>
						</div>
					</div>
					<div class="content-faq__item">
						<button type="button" class="content-faq__header" data-spoller>
							<h3 class="content-faq__caption">
								<?php esc_html_e( 'How long does delivery take?', 'vroomqc' ); ?>
							</h3>
							<div class="content-faq__icon"></div>
						</button>
						<div class="content-faq__body">
							<?php esc_html_e( 'We deliver most vehicles within 24-48 hours anywhere in Quebec. Delivery is free for most locations.', 'vroomqc' ); ?>
						</div>
					</div>
					<div class="content-faq__item">
						<button type="button" class="content-faq__header" data-spoller>
							<h3 class="content-faq__caption">
								<?php esc_html_e( 'What if I don\'t like the car?', 'vroomqc' ); ?>
							</h3>
							<div class="content-faq__icon"></div>
						</button>
						<div class="content-faq__body">
							<?php esc_html_e( 'We offer a 7-day return policy. If you\'re not completely satisfied, you can return the vehicle for a full refund.', 'vroomqc' ); ?>
						</div>
					</div>
					<div class="content-faq__item">
						<button type="button" class="content-faq__header" data-spoller>
							<h3 class="content-faq__caption">
								<?php esc_html_e( 'Do you accept trade-ins?', 'vroomqc' ); ?>
							</h3>
							<div class="content-faq__icon"></div>
						</button>
						<div class="content-faq__body">
							<?php esc_html_e( 'Yes! Get an instant quote for your trade-in online. We accept most vehicles and offer competitive prices.', 'vroomqc' ); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class='brands' aria-labelledby='brands-title'>
		<div class='brands__container'>
			<h2 class='brands__title title' id='brands-title'>
				<?php esc_html_e( 'Browse by brand', 'vroomqc' ); ?>
			</h2>
			<div class="brands__items">
				<a href="#" class="brands__item">
					<div class="brands__logo">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/homepage/brands/brand_01.png' ); ?>" loading="lazy" alt="<?php esc_attr_e( 'brand logo', 'vroomqc' ); ?>">
					</div>
					<div class="brands__name">
						<?php esc_html_e( 'Toyota', 'vroomqc' ); ?>
					</div>
				</a>
				<a href="#" class="brands__item">
					<div class="brands__logo">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/homepage/brands/brand_02.png' ); ?>" loading="lazy" alt="<?php esc_attr_e( 'brand logo', 'vroomqc' ); ?>">
					</div>
					<div class="brands__name">
						<?php esc_html_e( 'BMW', 'vroomqc' ); ?>
					</div>
				</a>
				<a href="#" class="brands__item">
					<div class="brands__logo">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/homepage/brands/brand_03.png' ); ?>" loading="lazy" alt="<?php esc_attr_e( 'brand logo', 'vroomqc' ); ?>">
					</div>
					<div class="brands__name">
						<?php esc_html_e( 'Chevrolet', 'vroomqc' ); ?>
					</div>
				</a>
				<a href="#" class="brands__item">
					<div class="brands__logo">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/homepage/brands/brand_04.png' ); ?>" loading="lazy" alt="<?php esc_attr_e( 'brand logo', 'vroomqc' ); ?>">
					</div>
					<div class="brands__name">
						<?php esc_html_e( 'Ford', 'vroomqc' ); ?>
					</div>
				</a>
				<a href="#" class="brands__item">
					<div class="brands__logo">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/homepage/brands/brand_05.png' ); ?>" loading="lazy" alt="<?php esc_attr_e( 'brand logo', 'vroomqc' ); ?>">
					</div>
					<div class="brands__name">
						<?php esc_html_e( 'Honda', 'vroomqc' ); ?>
					</div>
				</a>
				<a href="#" class="brands__item">
					<div class="brands__logo">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/homepage/brands/brand_06.png' ); ?>" loading="lazy" alt="<?php esc_attr_e( 'brand logo', 'vroomqc' ); ?>">
					</div>
					<div class="brands__name">
						<?php esc_html_e( 'Mazda', 'vroomqc' ); ?>
					</div>
				</a>
				<a href="#" class="brands__item">
					<div class="brands__logo">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/homepage/brands/brand_07.png' ); ?>" loading="lazy" alt="<?php esc_attr_e( 'brand logo', 'vroomqc' ); ?>">
					</div>
					<div class="brands__name">
						<?php esc_html_e( 'Nissan', 'vroomqc' ); ?>
					</div>
				</a>
				<a href="#" class="brands__item">
					<div class="brands__logo">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/homepage/brands/brand_08.png' ); ?>" loading="lazy" alt="<?php esc_attr_e( 'brand logo', 'vroomqc' ); ?>">
					</div>
					<div class="brands__name">
						<?php esc_html_e( 'Volkswagen', 'vroomqc' ); ?>
					</div>
				</a>
				<a href="#" class="brands__item">
					<div class="brands__logo">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/homepage/brands/brand_09.png' ); ?>" loading="lazy" alt="<?php esc_attr_e( 'brand logo', 'vroomqc' ); ?>">
					</div>
					<div class="brands__name">
						<?php esc_html_e( 'Subaru', 'vroomqc' ); ?>
					</div>
				</a>
				<a href="#" class="brands__item">
					<div class="brands__logo">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/homepage/brands/brand_10.png' ); ?>" loading="lazy" alt="<?php esc_attr_e( 'brand logo', 'vroomqc' ); ?>">
					</div>
					<div class="brands__name">
						<?php esc_html_e( 'Hyundai', 'vroomqc' ); ?>
					</div>
				</a>
				<a href="#" class="brands__item">
					<div class="brands__logo">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/homepage/brands/brand_11.png' ); ?>" loading="lazy" alt="<?php esc_attr_e( 'brand logo', 'vroomqc' ); ?>">
					</div>
					<div class="brands__name">
						<?php esc_html_e( 'Kia', 'vroomqc' ); ?>
					</div>
				</a>
				<a href="#" class="brands__item">
					<div class="brands__logo">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/homepage/brands/brand_12.png' ); ?>" loading="lazy" alt="<?php esc_attr_e( 'brand logo', 'vroomqc' ); ?>">
					</div>
					<div class="brands__name">
						<?php esc_html_e( 'Audi', 'vroomqc' ); ?>
					</div>
				</a>
			</div>
			<div class="brands__more">
				<a href="#" class="brands__button button">
					<?php esc_html_e( 'Show all brands', 'vroomqc' ); ?>
				</a>
			</div>
		</div>
	</section>

</main>

<?php
get_footer();