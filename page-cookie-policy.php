<?php
/**
 * Template Name: Cookie Policy
 *
 * @package vroomqc
 */

get_header();
?>

<main class="page policy-page">
	<section class="policy-header">
		<div class="policy-header__container">
			<div class="breadcrumb">
				<nav class="breadcrumb__menu">
					<ul class="breadcrumb__list">
						<li class="breadcrumb__item">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="breadcrumb__link">
								<?php esc_html_e( 'Home', 'vroomqc' ); ?>
							</a>
						</li>
						<li class="breadcrumb__item">
							<span class="breadcrumb__link">
								<?php esc_html_e( 'Cookie Policy', 'vroomqc' ); ?>
							</span>
						</li>
					</ul>
				</nav>
			</div>
			<h1 class="policy-header__title title">
				<?php esc_html_e( 'Cookie Policy', 'vroomqc' ); ?>
			</h1>
			<p class="policy-header__updated">
				<em><?php esc_html_e( 'Last updated: August 17, 2025', 'vroomqc' ); ?></em>
			</p>
		</div>
	</section>

	<section class="policy-content">
		<div class="policy-content__container">
			<div class="policy-content__body text-block">
				<div class="policy-intro">
					<p>
						<?php esc_html_e( 'This policy explains how', 'vroomqc' ); ?> <strong><?php esc_html_e( 'Vroom Québec', 'vroomqc' ); ?></strong> <?php esc_html_e( 'uses cookies and similar technologies on our website, and how you can control them.', 'vroomqc' ); ?>
					</p>
				</div>

				<h2 id="what-are-cookies"><?php esc_html_e( 'What are cookies', 'vroomqc' ); ?></h2>
				<p><?php esc_html_e( 'Cookies are small files stored on your device by your browser. Similar technologies include SDKs, pixels, and local storage.', 'vroomqc' ); ?></p>

				<h2 id="cookie-categories"><?php esc_html_e( 'How we categorize cookies', 'vroomqc' ); ?></h2>
				<ul>
					<li><strong><?php esc_html_e( 'Strictly necessary', 'vroomqc' ); ?></strong>: <?php esc_html_e( 'required for core functions such as security, session management, checkout, and fraud prevention.', 'vroomqc' ); ?></li>
					<li><strong><?php esc_html_e( 'Preferences', 'vroomqc' ); ?></strong>: <?php esc_html_e( 'remember language and saved settings.', 'vroomqc' ); ?></li>
					<li><strong><?php esc_html_e( 'Analytics', 'vroomqc' ); ?></strong>: <?php esc_html_e( 'help us understand traffic and improve performance.', 'vroomqc' ); ?></li>
					<li><strong><?php esc_html_e( 'Advertising and measurement', 'vroomqc' ); ?></strong>: <?php esc_html_e( 'measure conversions and improve ad relevance.', 'vroomqc' ); ?></li>
				</ul>

				<h2 id="current-tools"><?php esc_html_e( 'Our current tools and examples', 'vroomqc' ); ?></h2>
				<p><?php esc_html_e( 'The exact cookies and lifespans may change based on updates from providers.', 'vroomqc' ); ?></p>
				
				<ul>
					<li><strong><?php esc_html_e( 'Stripe', 'vroomqc' ); ?></strong> <?php esc_html_e( '(necessary) for checkout and fraud prevention. Examples:', 'vroomqc' ); ?> <code>__stripe_mid</code> <?php esc_html_e( '(1 year),', 'vroomqc' ); ?> <code>__stripe_sid</code> <?php esc_html_e( '(30 minutes).', 'vroomqc' ); ?></li>
					<li><strong><?php esc_html_e( 'QuickBooks Payments', 'vroomqc' ); ?></strong> <?php esc_html_e( '(necessary) may set cookies on payment pages or embedded widgets that support checkout and security.', 'vroomqc' ); ?></li>
					<li><strong><?php esc_html_e( 'HubSpot', 'vroomqc' ); ?></strong> <?php esc_html_e( '(preferences, analytics) for CRM, forms, and site analytics. Examples:', 'vroomqc' ); ?> <code>hubspotutk</code> <?php esc_html_e( '(6 months),', 'vroomqc' ); ?> <code>__hstc</code> <?php esc_html_e( '(6 months),', 'vroomqc' ); ?> <code>__hssc</code> <?php esc_html_e( '(30 minutes),', 'vroomqc' ); ?> <code>__hssrc</code> <?php esc_html_e( '(session).', 'vroomqc' ); ?></li>
					<li><strong><?php esc_html_e( 'Aircall', 'vroomqc' ); ?></strong> <?php esc_html_e( '(necessary) may set cookies to enable embedded call or callback functionality where used.', 'vroomqc' ); ?></li>
					<li><strong><?php esc_html_e( 'Google Analytics 4', 'vroomqc' ); ?></strong> <?php esc_html_e( '(analytics) for site measurement. Examples:', 'vroomqc' ); ?> <code>_ga</code> <?php esc_html_e( '(2 years),', 'vroomqc' ); ?> <code>_ga_&lt;container&gt;</code> <?php esc_html_e( '(2 years),', 'vroomqc' ); ?> <code>_gid</code> <?php esc_html_e( '(24 hours).', 'vroomqc' ); ?></li>
					<li><strong><?php esc_html_e( 'Google Ads', 'vroomqc' ); ?></strong> <?php esc_html_e( '(advertising) for conversion tracking and ad performance. Example:', 'vroomqc' ); ?> <code>_gcl_au</code> <?php esc_html_e( '(3 months).', 'vroomqc' ); ?></li>
					<li><strong><?php esc_html_e( 'Meta (Facebook) Pixel', 'vroomqc' ); ?></strong> <?php esc_html_e( '(advertising) for ad measurement and retargeting. Examples:', 'vroomqc' ); ?> <code>_fbp</code> <?php esc_html_e( '(3 months),', 'vroomqc' ); ?> <code>_fbc</code> <?php esc_html_e( '(3 months where applicable).', 'vroomqc' ); ?></li>
				</ul>

				<h2 id="consent-control"><?php esc_html_e( 'Consent and control', 'vroomqc' ); ?></h2>
				<ul>
					<li><strong><?php esc_html_e( 'Consent', 'vroomqc' ); ?></strong>: <?php esc_html_e( 'analytics and advertising cookies are off until you choose to enable them in our banner.', 'vroomqc' ); ?></li>
					<li><strong><?php esc_html_e( 'Manage preferences', 'vroomqc' ); ?></strong>: <?php esc_html_e( 'use the banner to allow all, reject non-essential, or customize by category. You can change your choices at any time.', 'vroomqc' ); ?></li>
					<li><strong><?php esc_html_e( 'Browser controls', 'vroomqc' ); ?></strong>: <?php esc_html_e( 'you can block or delete cookies in your browser settings. Blocking some cookies may affect site functionality.', 'vroomqc' ); ?></li>
				</ul>

				<h2 id="do-not-track"><?php esc_html_e( 'Do Not Track and Global Privacy Control', 'vroomqc' ); ?></h2>
				<p><?php esc_html_e( 'Your browser may offer signals such as Do Not Track or Global Privacy Control. Where reasonably possible, we will interpret such signals as a request to opt out of non-essential cookies.', 'vroomqc' ); ?></p>

				<h2 id="contact"><?php esc_html_e( 'Contact', 'vroomqc' ); ?></h2>
				<p><?php esc_html_e( 'Questions about cookies and tracking:', 'vroomqc' ); ?> <strong><a href="mailto:info@vroomquebec.ca">info@vroomquebec.ca</a></strong>.</p>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();
?>