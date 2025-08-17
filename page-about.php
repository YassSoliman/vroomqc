<?php
/**
 * Template Name: About
 *
 * @package vroomqc
 */

get_header();
?>

<div class="page">
	<div class="about-us-hero ibg">
		<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/about-us/about-us-hero-decor.jpg' ); ?>" fetchpriority="high" loading="eager" alt="<?php esc_attr_e( 'about-us-hero-decor', 'vroomqc' ); ?>">
	</div>
	
	<section class="about-us-info" aria-labelledby="about-us-info-title">
		<div class="about-us-info__container">
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
								<?php esc_html_e( 'About us', 'vroomqc' ); ?>
							</a>
						</li>
					</ul>
				</nav>
			</div>
			<h2 class="about-us-info__title title" id="about-us-info-title">
				<?php esc_html_e( 'Built for Québec.', 'vroomqc' ); ?>
			</h2>
			<div class="about-us-info__subtitle text-block">
				<p>
					<?php esc_html_e( 'We started VROOM with a simple idea: buying or selling a car shouldn\'t be stressful, slow, or confusing. We believe it should be fast, fully online, and built around how you actually live — with local service, no pressure, and full transparency.', 'vroomqc' ); ?>
				</p>
				<p>
					<?php esc_html_e( 'That\'s why we\'re reimagining the car experience for Québec. No showrooms. No awkward sales calls. Just certified cars, clear pricing, and human support when you need it.', 'vroomqc' ); ?>
				</p>
			</div>
		</div>
	</section>
	
	<section class='about-us-stats' aria-labelledby='about-us-stats-title'>
		<div class='about-us-stats__container'>
			<h2 class="about-us-stats__title title" id="about-us-stats-title">
				<?php esc_html_e( 'By the numbers', 'vroomqc' ); ?>
			</h2>
			<div class="about-us-stats__items">
				<div class="about-us-stats__item">
					<dl class="about-us-stats__values">
						<dt class="about-us-stats__value">
							<?php esc_html_e( '1,800+', 'vroomqc' ); ?>
						</dt>
						<dd class="about-us-stats__description">
							<?php esc_html_e( '5-star reviews', 'vroomqc' ); ?>
						</dd>
					</dl>
				</div>
				<div class="about-us-stats__item">
					<dl class="about-us-stats__values">
						<dt class="about-us-stats__value">
							<?php esc_html_e( '24h', 'vroomqc' ); ?>
						</dt>
						<dd class="about-us-stats__description">
							<?php esc_html_e( 'Delivery across Québec', 'vroomqc' ); ?>
						</dd>
					</dl>
				</div>
				<div class="about-us-stats__item">
					<dl class="about-us-stats__values">
						<dt class="about-us-stats__value">
							<?php esc_html_e( '7', 'vroomqc' ); ?>
						</dt>
						<dd class="about-us-stats__description">
							<?php esc_html_e( 'Day return policy', 'vroomqc' ); ?>
						</dd>
					</dl>
				</div>
				<div class="about-us-stats__item">
					<dl class="about-us-stats__values">
						<dt class="about-us-stats__value">
							<?php esc_html_e( '100%', 'vroomqc' ); ?>
						</dt>
						<dd class="about-us-stats__description">
							<?php esc_html_e( 'Online process', 'vroomqc' ); ?>
						</dd>
					</dl>
				</div>
				<div class="about-us-stats__item">
					<dl class="about-us-stats__values">
						<dt class="about-us-stats__value">
							<?php esc_html_e( '0', 'vroomqc' ); ?>
						</dt>
						<dd class="about-us-stats__description">
							<?php esc_html_e( 'Pressure to decide', 'vroomqc' ); ?>
						</dd>
					</dl>
				</div>
				<div class="about-us-stats__item">
					<dl class="about-us-stats__values">
						<dt class="about-us-stats__value">
							<?php esc_html_e( '9,000+', 'vroomqc' ); ?>
						</dt>
						<dd class="about-us-stats__description">
							<?php esc_html_e( 'Cars delivered', 'vroomqc' ); ?>
						</dd>
					</dl>
				</div>
				<div class="about-us-stats__item">
					<dl class="about-us-stats__values">
						<dt class="about-us-stats__value">
							<?php esc_html_e( '12min', 'vroomqc' ); ?>
						</dt>
						<dd class="about-us-stats__description">
							<?php esc_html_e( 'Avg. approval time', 'vroomqc' ); ?>
						</dd>
					</dl>
				</div>
				<div class="about-us-stats__item">
					<dl class="about-us-stats__values">
						<dt class="about-us-stats__value">
							<?php esc_html_e( '95%', 'vroomqc' ); ?>
						</dt>
						<dd class="about-us-stats__description">
							<?php esc_html_e( 'Québec-based clients', 'vroomqc' ); ?>
						</dd>
					</dl>
				</div>
			</div>
		</div>
	</section>
	
	<section class='about-us-founders' aria-labelledby='about-us-founders-title'>
		<div class='about-us-founders__container'>
			<h2 class="about-us-founders__title title" id="about-us-founders-title">
				<?php esc_html_e( 'Meet the founders', 'vroomqc' ); ?>
			</h2>
			<div class="about-us-founders__items">
				<article class="about-us-founders__item ibg">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/about-us/about-us-founders_image_01.jpg' ); ?>" loading="lazy" alt="<?php esc_attr_e( 'founder', 'vroomqc' ); ?>">
					<div class="about-us-founders__decor">
						<div class="about-us-founders__footer">
							<h3 class="about-us-founders__name">
								<?php esc_html_e( 'Jean-Pierre Tremblay', 'vroomqc' ); ?>
							</h3>
							<div class="about-us-founders__position">
								<?php esc_html_e( 'Co-Founder & CEO', 'vroomqc' ); ?>
							</div>
						</div>
					</div>
				</article>
				<article class="about-us-founders__item ibg">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/about-us/about-us-founders_image_02.jpg' ); ?>" loading="lazy" alt="<?php esc_attr_e( 'founder', 'vroomqc' ); ?>">
					<div class="about-us-founders__decor">
						<div class="about-us-founders__footer">
							<h3 class="about-us-founders__name">
								<?php esc_html_e( 'Sarah Williams', 'vroomqc' ); ?>
							</h3>
							<div class="about-us-founders__position">
								<?php esc_html_e( 'Co-Founder & COO', 'vroomqc' ); ?>
							</div>
						</div>
					</div>
				</article>
				<article class="about-us-founders__item ibg">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/about-us/about-us-founders_image_03.jpg' ); ?>" loading="lazy" alt="<?php esc_attr_e( 'founder', 'vroomqc' ); ?>">
					<div class="about-us-founders__decor">
						<div class="about-us-founders__footer">
							<h3 class="about-us-founders__name">
								<?php esc_html_e( 'Michael Chen', 'vroomqc' ); ?>
							</h3>
							<div class="about-us-founders__position">
								<?php esc_html_e( 'Co-Founder & CTO', 'vroomqc' ); ?>
							</div>
						</div>
					</div>
				</article>
			</div>
		</div>
	</section>
</div>

<?php
get_footer();