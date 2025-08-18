<?php
/**
 * Template Name: Contact
 *
 * @package vroomqc
 */

get_header();
?>

<div class="page">
	<section class='hero-alt' aria-labelledby='hero-alt-title'>
		<div class='hero-alt__container'>
			<div class="hero-alt__info">
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
									<?php esc_html_e( 'Contact us', 'vroomqc' ); ?>
								</a>
							</li>
						</ul>
					</nav>
				</div>
				<h1 class="hero-alt__title" id="hero-alt-title">
					<?php esc_html_e( 'Reach out to us — we\'re here to help with anything', 'vroomqc' ); ?>
				</h1>
				<div class="hero-alt__subtitle">
					<?php esc_html_e( 'Just ask. We\'ll handle it.', 'vroomqc' ); ?>
				</div>
			</div>
			<div class="hero-alt__decor hero-alt__decor-nb ibg">
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/contact-us/hero-decor.jpg' ); ?>" fetchpriority="high" loading="eager" alt="<?php esc_attr_e( 'hero-decor', 'vroomqc' ); ?>">
			</div>
		</div>
	</section>
	
	<section class='contact-us' aria-labelledby='contact-us-title'>
		<div class='contact-us__container'>
			<div class="form-contact-us">
				<h2 class="form-contact-us__title" id="contact-us-title">
					<?php esc_html_e( 'Let\'s get started', 'vroomqc' ); ?>
				</h2>
				<form action="#" class="form-contact-us__form">
					<div class="form-contact-us__items">
						<div class="form-contact-us__item">
							<label for="full-name" class="form-contact-us__label"><?php esc_html_e( 'Full name', 'vroomqc' ); ?></label>
							<input type="text" id="full-name" class="form-contact-us__input" placeholder="<?php esc_attr_e( 'Pedro Resende', 'vroomqc' ); ?>">
						</div>
						<div class="form-contact-us__item">
							<label for="email" class="form-contact-us__label"><?php esc_html_e( 'Email address', 'vroomqc' ); ?></label>
							<input type="email" id="email" class="form-contact-us__input" placeholder="<?php esc_attr_e( 'you@example.com', 'vroomqc' ); ?>">
						</div>
						<div class="form-contact-us__item">
							<label for="phone" class="form-contact-us__label"><?php esc_html_e( 'Phone (Optional)', 'vroomqc' ); ?></label>
							<input type="tel" id="phone" class="form-contact-us__input" placeholder="<?php esc_attr_e( '+1 (514) 123‑4567', 'vroomqc' ); ?>">
						</div>
						<div class="form-contact-us__item">
							<label class="form-contact-us__label"><?php esc_html_e( 'What can we help you with?', 'vroomqc' ); ?></label>
							<div class="form-contact-us__select  select _first-choice" data-select-menu>
								<button class="select__header" type="button" aria-label="<?php esc_attr_e( 'choose reason', 'vroomqc' ); ?>" data-select-menu-button>
									<span class="select__value" data-select-menu-value>
										<?php esc_html_e( 'Select a reason', 'vroomqc' ); ?>
									</span>
									<span class="select__icon">
										<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#drop-down-icon' ); ?>
									</span>
								</button>
								<ul class="select__body" data-select-menu-drop-down hidden>
									<li class="select__item" data-select-menu-option>
										<button type="button" class="select__button"><?php esc_html_e( 'General inquiry', 'vroomqc' ); ?></button>
									</li>
									<li class="select__item" data-select-menu-option>
										<button type="button" class="select__button"><?php esc_html_e( 'Financing question', 'vroomqc' ); ?></button>
									</li>
									<li class="select__item" data-select-menu-option>
										<button type="button" class="select__button"><?php esc_html_e( 'Vehicle inquiry', 'vroomqc' ); ?></button>
									</li>
								</ul>
							</div>
						</div>
						<div class="form-contact-us__item">
							<label for="message" class="form-contact-us__label"><?php esc_html_e( 'Tell us more', 'vroomqc' ); ?></label>
							<textarea id="message" class="form-contact-us__textarea" placeholder="<?php esc_attr_e( 'Write your message here...', 'vroomqc' ); ?>"></textarea>
						</div>
					</div>
					<button type="submit" class="form-contact-us__button button">
						<?php esc_html_e( 'Send request', 'vroomqc' ); ?>
					</button>
				</form>
			</div>
			<div class="contact-us-info">
				<h3 class="contact-us-info__title">
					<?php esc_html_e( 'Contact us directly', 'vroomqc' ); ?>
				</h3>
				<div class="contact-us-info__items">
					<div class="contact-us-info__item">
						<div class="contact-us-info__icon">
							<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#contact-us-info-icon_01' ); ?>
						</div>
						<div class="contact-us-info__details">
							<h4 class="contact-us-info__label">
								<?php esc_html_e( 'Hours', 'vroomqc' ); ?>
							</h4>
							<div class="contact-us-info__text">
								<span><?php esc_html_e( 'Monday - Friday: 9:00 AM - 8:00 PM', 'vroomqc' ); ?></span>
								<span><?php esc_html_e( 'Saturday: 10:00 AM - 6:00 PM', 'vroomqc' ); ?></span>
								<span><?php esc_html_e( 'Sunday: Closed', 'vroomqc' ); ?></span>
							</div>
						</div>
					</div>
					<div class="contact-us-info__item">
						<div class="contact-us-info__icon">
							<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#contact-us-info-icon_02' ); ?>
						</div>
						<div class="contact-us-info__details">
							<h4 class="contact-us-info__label">
								<?php esc_html_e( 'Phone', 'vroomqc' ); ?>
							</h4>
							<div class="contact-us-info__text">
								<a href="tel:4165550123" class="contact-us-info__link">
									<?php esc_html_e( '(416) 555‑0123', 'vroomqc' ); ?>
								</a>
							</div>
						</div>
					</div>
					<div class="contact-us-info__item">
						<div class="contact-us-info__icon">
							<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#contact-us-info-icon_03' ); ?>
						</div>
						<div class="contact-us-info__details">
							<h4 class="contact-us-info__label">
								<?php esc_html_e( 'Email', 'vroomqc' ); ?>
							</h4>
							<div class="contact-us-info__text">
								<a href="mailto:info@vroom.com" class="contact-us-info__link">
									<?php esc_html_e( 'info@vroom.com', 'vroomqc' ); ?>
								</a>
							</div>
						</div>
					</div>
					<div class="contact-us-info__item">
						<div class="contact-us-info__icon">
							<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#contact-us-info-icon_04' ); ?>
						</div>
						<div class="contact-us-info__details">
							<h4 class="contact-us-info__label">
								<?php esc_html_e( 'Address', 'vroomqc' ); ?>
							</h4>
							<div class="contact-us-info__text">
								<address class="contact-us-info__address">
									<span><?php esc_html_e( '123 Maple Drive', 'vroomqc' ); ?></span>
									<span><?php esc_html_e( 'Toronto, ON M5V 2L7', 'vroomqc' ); ?></span>
								</address>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<?php
get_footer();