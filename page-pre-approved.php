<?php
/**
 * Template Name: Pre-Approved
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
									<?php esc_html_e( 'Pre-approved', 'vroomqc' ); ?>
								</a>
							</li>
						</ul>
					</nav>
				</div>
				<h1 class="hero-alt__title" id="hero-alt-title">
					<?php esc_html_e( 'Get approved online — no credit hit, no pressure.', 'vroomqc' ); ?>
				</h1>
				<div class="hero-alt__subtitle">
					<?php esc_html_e( '2-minute check. Free delivery in Québec.', 'vroomqc' ); ?>
				</div>
				<a href="#" class="hero-alt__button button">
					<?php esc_html_e( 'Check eligibility', 'vroomqc' ); ?>
				</a>
				<div class="hero-alt__disclaimer">
					<?php esc_html_e( 'No credit impact. Takes less than 2 minutes.', 'vroomqc' ); ?>
				</div>
			</div>
			<div class="hero-alt__decor ibg">
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/pre-approved/hero-decor.jpg' ); ?>" fetchpriority="high" loading="eager" alt="<?php esc_attr_e( 'hero-decor', 'vroomqc' ); ?>">
			</div>
		</div>
	</section>
	
	<section class='pre-approved-about' aria-labelledby='pre-approved-about-title'>
		<div class='pre-approved-about__container'>
			<h2 class="pre-approved-about__title title" id="pre-approved-about-title">
				<?php esc_html_e( 'Why get pre-approved?', 'vroomqc' ); ?>
			</h2>
			<div class="pre-approved-about__items">
				<article class="pre-approved-about__item">
					<div class="pre-approved-about__icon">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/pre-approved/about/about-icon_01.jpg' ); ?>" alt="<?php esc_attr_e( 'about-icon', 'vroomqc' ); ?>">
					</div>
					<div class="pre-approved-about__info">
						<h3 class="pre-approved-about__caption">
							<?php esc_html_e( 'No credit impact', 'vroomqc' ); ?>
						</h3>
						<div class="pre-approved-about__details">
							<?php esc_html_e( 'Checking your eligibility won\'t affect your score.', 'vroomqc' ); ?>
						</div>
					</div>
				</article>
				<article class="pre-approved-about__item">
					<div class="pre-approved-about__icon">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/pre-approved/about/about-icon_02.jpg' ); ?>" alt="<?php esc_attr_e( 'about-icon', 'vroomqc' ); ?>">
					</div>
					<div class="pre-approved-about__info">
						<h3 class="pre-approved-about__caption">
							<?php esc_html_e( 'Faster process', 'vroomqc' ); ?>
						</h3>
						<div class="pre-approved-about__details">
							<?php esc_html_e( 'Get matched instantly and skip paperwork later.', 'vroomqc' ); ?>
						</div>
					</div>
				</article>
				<article class="pre-approved-about__item">
					<div class="pre-approved-about__icon">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/pre-approved/about/about-icon_03.jpg' ); ?>" alt="<?php esc_attr_e( 'about-icon', 'vroomqc' ); ?>">
					</div>
					<div class="pre-approved-about__info">
						<h3 class="pre-approved-about__caption">
							<?php esc_html_e( 'See your real rate', 'vroomqc' ); ?>
						</h3>
						<div class="pre-approved-about__details">
							<?php esc_html_e( 'Understand your options before picking your car.', 'vroomqc' ); ?>
						</div>
					</div>
				</article>
				<article class="pre-approved-about__item">
					<div class="pre-approved-about__icon">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/pre-approved/about/about-icon_04.jpg' ); ?>" alt="<?php esc_attr_e( 'about-icon', 'vroomqc' ); ?>">
					</div>
					<div class="pre-approved-about__info">
						<h3 class="pre-approved-about__caption">
							<?php esc_html_e( 'Fully online', 'vroomqc' ); ?>
						</h3>
						<div class="pre-approved-about__details">
							<?php esc_html_e( 'Do everything from home, at your own pace.', 'vroomqc' ); ?>
						</div>
					</div>
				</article>
			</div>
		</div>
	</section>
	
	<section class='pre-approved-how' aria-labelledby='pre-approved-how-title'>
		<div class='pre-approved-how__container'>
			<div class="pre-approved-how__header">
				<h2 class="pre-approved-how__title title" id="pre-approved-how-title">
					<?php esc_html_e( 'How it works', 'vroomqc' ); ?>
				</h2>
				<div class="pre-approved-how__subtitle text-block">
					<?php esc_html_e( 'We\'ve made it simple — get pre-approved in minutes and take the stress out of car shopping. Here\'s what to expect:', 'vroomqc' ); ?>
				</div>
			</div>
			<div class="pre-approved-how__items">
				<article class="pre-approved-how__item">
					<div class="pre-approved-how__number"></div>
					<div class="pre-approved-how__info">
						<h3 class="pre-approved-how__label">
							<?php esc_html_e( 'Apply online', 'vroomqc' ); ?>
						</h3>
						<div class="pre-approved-how__description text-block">
							<p>
								<?php esc_html_e( 'Complete a short form in under 2 minutes. No credit impact, no pressure. Just a soft check to get started and see your options.', 'vroomqc' ); ?>
							</p>
						</div>
					</div>
				</article>
				<article class="pre-approved-how__item">
					<div class="pre-approved-how__number"></div>
					<div class="pre-approved-how__info">
						<h3 class="pre-approved-how__label">
							<?php esc_html_e( 'Get matched', 'vroomqc' ); ?>
						</h3>
						<div class="pre-approved-how__description text-block">
							<p>
								<?php esc_html_e( 'Based on your profile, we\'ll match you with financing options that fit your budget — no guesswork, just clarity.', 'vroomqc' ); ?>
							</p>
						</div>
					</div>
				</article>
				<article class="pre-approved-how__item">
					<div class="pre-approved-how__number"></div>
					<div class="pre-approved-how__info">
						<h3 class="pre-approved-how__label">
							<?php esc_html_e( 'Choose your car', 'vroomqc' ); ?>
						</h3>
						<div class="pre-approved-how__description text-block">
							<p>
								<?php esc_html_e( 'Explore available vehicles, compare offers, and select the one that works for you. We\'ll handle the rest — including delivery.', 'vroomqc' ); ?>
							</p>
						</div>
					</div>
				</article>
			</div>
			<a href="#" class="pre-approved-how__button button button-transparent">
				<span class="pre-approved-how__button-text">
					<?php esc_html_e( 'Check eligibility', 'vroomqc' ); ?>
				</span>
				<span class="pre-approved-how__button-icon">
					<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#arrow-icon-next' ); ?>
				</span>
			</a>
		</div>
	</section>
	
	<section class='faq' aria-labelledby='faq-title'>
		<div class='faq__container'>
			<div class="faq__body">
				<div class="faq__info">
					<h2 class="faq__title title" id="faq-title">
						<?php esc_html_e( 'Got questions?', 'vroomqc' ); ?>
					</h2>
					<div class="faq__subtitle">
						<?php esc_html_e( 'Here are some quick answers to help you feel confident before getting started.', 'vroomqc' ); ?>
					</div>
				</div>
				<div class="faq__content content-faq">
					<div class="content-faq__items" data-spollers data-one-spoller>
						<div class="content-faq__item">
							<button tabindex="-1" type="button" data-spoller class="content-faq__header _active">
								<span class="content-faq__caption"><?php esc_html_e( 'Does this affect my credit score?', 'vroomqc' ); ?></span>
								<span class="content-faq__icon"></span>
							</button>
							<div class="content-faq__body text-block">
								<p>
									<?php esc_html_e( 'No. We only run a soft inquiry, which means your credit score remains untouched. You can explore your eligibility without any long-term financial impact.', 'vroomqc' ); ?>
								</p>
							</div>
						</div>
						<div class="content-faq__item">
							<button tabindex="-1" type="button" data-spoller class="content-faq__header">
								<span class="content-faq__caption"><?php esc_html_e( 'Do I need to buy a car right now?', 'vroomqc' ); ?></span>
								<span class="content-faq__icon"></span>
							</button>
							<div class="content-faq__body text-block">
								<p>
									<?php esc_html_e( 'Not at all. Getting pre-approved is just the first step. You can take your time shopping for the right vehicle that fits your needs and budget.', 'vroomqc' ); ?>
								</p>
							</div>
						</div>
						<div class="content-faq__item">
							<button tabindex="-1" type="button" data-spoller class="content-faq__header">
								<span class="content-faq__caption"><?php esc_html_e( 'What happens after I get approved?', 'vroomqc' ); ?></span>
								<span class="content-faq__icon"></span>
							</button>
							<div class="content-faq__body text-block">
								<p>
									<?php esc_html_e( 'Once you submit your information, we typically respond within 24 to 48 hours — often the same day. While you relax, we work in the background to match you with the best local financing partner.', 'vroomqc' ); ?>
								</p>
							</div>
						</div>
						<div class="content-faq__item">
							<button tabindex="-1" type="button" data-spoller class="content-faq__header">
								<span class="content-faq__caption"><?php esc_html_e( 'Is it really 100% online?', 'vroomqc' ); ?></span>
								<span class="content-faq__icon"></span>
							</button>
							<div class="content-faq__body text-block">
								<p>
									<?php esc_html_e( 'Yes! The entire process is online, from application to approval to delivery. You never need to visit a dealership unless you want to.', 'vroomqc' ); ?>
								</p>
							</div>
						</div>
						<div class="content-faq__item">
							<button tabindex="-1" type="button" data-spoller class="content-faq__header">
								<span class="content-faq__caption"><?php esc_html_e( 'What if I have questions during the process?', 'vroomqc' ); ?></span>
								<span class="content-faq__icon"></span>
							</button>
							<div class="content-faq__body text-block">
								<p>
									<?php esc_html_e( 'Our customer support team is available to help you through every step. You can reach us by phone, email, or live chat during business hours.', 'vroomqc' ); ?>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<section class='pre-approved-brochure' aria-labelledby='pre-approved-brochure-title'>
		<div class='pre-approved-brochure__container'>
			<div class="pre-approved-brochure__decor">
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/pre-approved/brochure/decor.jpg' ); ?>" loading="lazy" alt="<?php esc_attr_e( 'brochure-decor', 'vroomqc' ); ?>">
			</div>
			<div class="pre-approved-brochure__info">
				<h2 class="pre-approved-brochure__title title" id="pre-approved-brochure-title">
					<?php esc_html_e( 'Get approved the easy, stress-free way', 'vroomqc' ); ?>
				</h2>
				<div class="pre-approved-brochure__subtitle text-block">
					<p>
						<?php esc_html_e( 'Apply online in minutes — no pressure, no credit impact. We\'ll handle the rest so you can focus on the car you want.', 'vroomqc' ); ?>
					</p>
				</div>
				<a href="#" class="pre-approved-brochure__button button">
					<?php esc_html_e( 'Get pre-approved', 'vroomqc' ); ?>
				</a>
			</div>
		</div>
	</section>
</div>

<?php
get_footer();