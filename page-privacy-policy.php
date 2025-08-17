<?php
/**
 * Template Name: Privacy Policy
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
								<?php esc_html_e( 'Privacy Policy', 'vroomqc' ); ?>
							</span>
						</li>
					</ul>
				</nav>
			</div>
			<h1 class="policy-header__title title">
				<?php esc_html_e( 'Privacy Policy', 'vroomqc' ); ?>
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
						<?php esc_html_e( 'Automobile Mazzeo Inc., doing business as', 'vroomqc' ); ?> <strong><?php esc_html_e( 'Vroom Québec', 'vroomqc' ); ?></strong> ("<?php esc_html_e( '**Vroom Québec**', 'vroomqc' ); ?>", "<?php esc_html_e( '**we**', 'vroomqc' ); ?>", "<?php esc_html_e( '**us**', 'vroomqc' ); ?>", "<?php esc_html_e( '**our**', 'vroomqc' ); ?>") <?php esc_html_e( 'operates a virtual used-vehicle dealership that serves customers across Québec.', 'vroomqc' ); ?>
					</p>
				</div>

				<div class="contact-block">
					<p><strong><?php esc_html_e( 'Contact', 'vroomqc' ); ?></strong></p>
					<p><strong><?php esc_html_e( 'Email:', 'vroomqc' ); ?></strong> <a href="mailto:info@vroomquebec.ca">info@vroomquebec.ca</a></p>
					<p><strong><?php esc_html_e( 'Mailing address:', 'vroomqc' ); ?></strong> <?php esc_html_e( '1635 boul. Manseau, Longueuil, Québec, J4K 3C3, Canada', 'vroomqc' ); ?></p>
					<p><strong><?php esc_html_e( 'Privacy Officer:', 'vroomqc' ); ?></strong> <?php esc_html_e( 'Yasser Soliman, info@vroomquebec.ca', 'vroomqc' ); ?></p>
				</div>

				<h2 id="scope"><?php esc_html_e( 'Scope', 'vroomqc' ); ?></h2>
				<p><?php esc_html_e( 'This policy describes how we collect, use, disclose, and protect personal information when you browse our site, inquire about a vehicle, schedule a test drive, apply for financing, complete a purchase, request support, or otherwise interact with us.', 'vroomqc' ); ?></p>

				<h2 id="what-we-collect"><?php esc_html_e( 'What we collect', 'vroomqc' ); ?></h2>
				<ul>
					<li><strong><?php esc_html_e( 'Identity and contact', 'vroomqc' ); ?></strong>: <?php esc_html_e( 'name, email, phone, billing and delivery addresses, government identifiers you provide for financing or test drives, date of birth.', 'vroomqc' ); ?></li>
					<li><strong><?php esc_html_e( 'Customer and vehicle data', 'vroomqc' ); ?></strong>: <?php esc_html_e( 'preferred models, VIN, trade-in details, offers, test drive, delivery and pickup logistics.', 'vroomqc' ); ?></li>
					<li><strong><?php esc_html_e( 'Financing data', 'vroomqc' ); ?></strong>: <?php esc_html_e( 'employment, income, consented credit information that lenders and bureaus require.', 'vroomqc' ); ?></li>
					<li><strong><?php esc_html_e( 'Transaction data', 'vroomqc' ); ?></strong>: <?php esc_html_e( 'orders, invoices, payments, refunds, signatures, warranties, return or exchange records.', 'vroomqc' ); ?></li>
					<li><strong><?php esc_html_e( 'Technical data', 'vroomqc' ); ?></strong>: <?php esc_html_e( 'device type, browser, IP address, approximate location, pages viewed, events, cookies and similar technologies.', 'vroomqc' ); ?></li>
					<li><strong><?php esc_html_e( 'Communications', 'vroomqc' ); ?></strong>: <?php esc_html_e( 'emails, chats, web forms, reviews, and', 'vroomqc' ); ?> <strong><?php esc_html_e( 'recorded phone calls', 'vroomqc' ); ?></strong>. <?php esc_html_e( 'We record and store customer calls using Aircall for quality, training, compliance, and recordkeeping.', 'vroomqc' ); ?></li>
				</ul>

				<h2 id="sources"><?php esc_html_e( 'Sources', 'vroomqc' ); ?></h2>
				<ul>
					<li><strong><?php esc_html_e( 'Directly from you', 'vroomqc' ); ?></strong>, <?php esc_html_e( 'including through forms, checkout, financing applications, email, chat, and calls.', 'vroomqc' ); ?></li>
					<li><strong><?php esc_html_e( 'Automatically', 'vroomqc' ); ?></strong>, <?php esc_html_e( 'through our website and integrated tools.', 'vroomqc' ); ?></li>
					<li><strong><?php esc_html_e( 'From third parties you authorize', 'vroomqc' ); ?></strong>, <?php esc_html_e( 'including lenders, identity verification providers, logistics partners, analytics and advertising platforms, and our CRM.', 'vroomqc' ); ?></li>
				</ul>

				<h2 id="why-we-use"><?php esc_html_e( 'Why we use it', 'vroomqc' ); ?></h2>
				<ul>
					<li><strong><?php esc_html_e( 'Provide services', 'vroomqc' ); ?></strong>: <?php esc_html_e( 'listings, guidance, test drives, sales, delivery, returns or exchanges, and support.', 'vroomqc' ); ?></li>
					<li><strong><?php esc_html_e( 'Payments and fraud prevention', 'vroomqc' ); ?></strong>: <?php esc_html_e( 'process transactions, authenticate payment methods, reduce fraud.', 'vroomqc' ); ?></li>
					<li><strong><?php esc_html_e( 'Financing', 'vroomqc' ); ?></strong>: <?php esc_html_e( 'verify identity, assess eligibility, prepare and submit applications with your consent.', 'vroomqc' ); ?></li>
					<li><strong><?php esc_html_e( 'Operations', 'vroomqc' ); ?></strong>: <?php esc_html_e( 'order management, accounting, tax, warranty and recall notices, safety communications.', 'vroomqc' ); ?></li>
					<li><strong><?php esc_html_e( 'Improvement', 'vroomqc' ); ?></strong>: <?php esc_html_e( 'diagnostics, troubleshooting, analytics, A/B testing, service development.', 'vroomqc' ); ?></li>
					<li><strong><?php esc_html_e( 'Marketing with consent where required', 'vroomqc' ); ?></strong>: <?php esc_html_e( 'email updates, promotions, analytics, and ads. You can opt out at any time.', 'vroomqc' ); ?></li>
					<li><strong><?php esc_html_e( 'Legal compliance', 'vroomqc' ); ?></strong>: <?php esc_html_e( 'recordkeeping, audits, and responses to lawful requests.', 'vroomqc' ); ?></li>
				</ul>

				<h2 id="service-providers"><?php esc_html_e( 'Service providers and partners', 'vroomqc' ); ?></h2>
				<p><?php esc_html_e( 'We use reputable vendors to run our business. These providers may process data outside Québec and Canada.', 'vroomqc' ); ?></p>
				
				<ul>
					<li><strong><?php esc_html_e( 'Payments', 'vroomqc' ); ?></strong>: <strong><?php esc_html_e( 'Stripe', 'vroomqc' ); ?></strong> <?php esc_html_e( 'and', 'vroomqc' ); ?> <strong><?php esc_html_e( 'QuickBooks Payments', 'vroomqc' ); ?></strong> <?php esc_html_e( 'process transactions, authenticate payment methods, and help prevent fraud. Shared data includes name, email, billing and shipping details, payment method token, and transaction information.', 'vroomqc' ); ?></li>
					<li><strong><?php esc_html_e( 'CRM and forms', 'vroomqc' ); ?></strong>: <strong><?php esc_html_e( 'HubSpot', 'vroomqc' ); ?></strong> <?php esc_html_e( 'stores contacts, leads, form submissions, communications metadata, and related analytics.', 'vroomqc' ); ?></li>
					<li><strong><?php esc_html_e( 'Call recording and telephony', 'vroomqc' ); ?></strong>: <strong><?php esc_html_e( 'Aircall', 'vroomqc' ); ?></strong> <?php esc_html_e( 'provides call routing and recording. Call recordings and related metadata are retained according to our retention schedule.', 'vroomqc' ); ?></li>
					<li><strong><?php esc_html_e( 'Analytics', 'vroomqc' ); ?></strong>: <strong><?php esc_html_e( 'Google Analytics 4', 'vroomqc' ); ?></strong> <?php esc_html_e( 'helps us understand site usage and improve services. GA4 collects device and usage data such as pages viewed, events, approximate location, and online identifiers.', 'vroomqc' ); ?></li>
					<li><strong><?php esc_html_e( 'Advertising and measurement', 'vroomqc' ); ?></strong>: <strong><?php esc_html_e( 'Meta (Facebook) Pixel', 'vroomqc' ); ?></strong> <?php esc_html_e( 'and', 'vroomqc' ); ?> <strong><?php esc_html_e( 'Google Ads', 'vroomqc' ); ?></strong> <?php esc_html_e( 'measure conversions and support ad relevance. These tools record events like page views and purchases and may use online identifiers. We activate advertising tools only after consent where required.', 'vroomqc' ); ?></li>
				</ul>

				<p><?php esc_html_e( 'We do', 'vroomqc' ); ?> <strong><?php esc_html_e( 'not', 'vroomqc' ); ?></strong> <?php esc_html_e( 'sell personal information.', 'vroomqc' ); ?></p>

				<h2 id="international-transfers"><?php esc_html_e( 'International transfers', 'vroomqc' ); ?></h2>
				<p><?php esc_html_e( 'When we use these providers, your information may be transferred to jurisdictions that have different data protection standards, including the United States. We use contractual and organizational safeguards. Contact us if you would like information about these safeguards.', 'vroomqc' ); ?></p>

				<h2 id="your-rights"><?php esc_html_e( 'Your choices and rights in Québec and Canada', 'vroomqc' ); ?></h2>
				<p><?php esc_html_e( 'Subject to limits in law, you may:', 'vroomqc' ); ?></p>
				<ul>
					<li><strong><?php esc_html_e( 'Access and portability', 'vroomqc' ); ?></strong>: <?php esc_html_e( 'request a copy of your personal information.', 'vroomqc' ); ?></li>
					<li><strong><?php esc_html_e( 'Correction', 'vroomqc' ); ?></strong>: <?php esc_html_e( 'update inaccurate or incomplete data.', 'vroomqc' ); ?></li>
					<li><strong><?php esc_html_e( 'Deletion', 'vroomqc' ); ?></strong>: <?php esc_html_e( 'request deletion where permitted.', 'vroomqc' ); ?></li>
					<li><strong><?php esc_html_e( 'Consent management', 'vroomqc' ); ?></strong>: <?php esc_html_e( 'withdraw consent to analytics, advertising, and marketing at any time.', 'vroomqc' ); ?></li>
					<li><strong><?php esc_html_e( 'Restriction and objection', 'vroomqc' ); ?></strong>: <?php esc_html_e( 'ask us to limit certain processing, including profiling for targeted advertising.', 'vroomqc' ); ?></li>
				</ul>

				<p><?php esc_html_e( 'To exercise rights, contact the Privacy Officer. You may also file a complaint with the', 'vroomqc' ); ?> <strong><?php esc_html_e( 'Commission d\'accès à l\'information du Québec', 'vroomqc' ); ?></strong> <?php esc_html_e( 'or the', 'vroomqc' ); ?> <strong><?php esc_html_e( 'Office of the Privacy Commissioner of Canada', 'vroomqc' ); ?></strong>.</p>

				<h2 id="security"><?php esc_html_e( 'Security', 'vroomqc' ); ?></h2>
				<p><?php esc_html_e( 'We apply administrative, technical, and physical safeguards appropriate to the sensitivity of the information. No system is perfectly secure. If a breach creates a risk of serious injury, we will notify affected individuals and regulators as required by law.', 'vroomqc' ); ?></p>

				<h2 id="retention"><?php esc_html_e( 'Retention', 'vroomqc' ); ?></h2>
				<p><?php esc_html_e( 'We retain personal information only as long as needed for the purposes above, for legal and regulatory requirements, for dispute resolution, and to enforce agreements. We use criteria such as account status, legal obligations, warranty and recall periods, and limitation periods.', 'vroomqc' ); ?></p>

				<h2 id="cookies"><?php esc_html_e( 'Cookies and tracking', 'vroomqc' ); ?></h2>
				<p><?php esc_html_e( 'See our', 'vroomqc' ); ?> <strong><?php esc_html_e( 'Cookie Policy', 'vroomqc' ); ?></strong> <?php esc_html_e( 'for categories, examples, and how to manage preferences.', 'vroomqc' ); ?></p>

				<h2 id="children"><?php esc_html_e( 'Children', 'vroomqc' ); ?></h2>
				<p><?php esc_html_e( 'Our services are intended for adults who have reached the age of majority. If we learn that we collected information from a minor without appropriate consent, we will delete it.', 'vroomqc' ); ?></p>

				<h2 id="changes"><?php esc_html_e( 'Changes', 'vroomqc' ); ?></h2>
				<p><?php esc_html_e( 'We may update this policy from time to time. The "Last updated" date shows when changes took effect. Material changes will be communicated through our website or direct notice where appropriate.', 'vroomqc' ); ?></p>

				<h2 id="cookie-policy"><?php esc_html_e( 'Cookie Policy', 'vroomqc' ); ?></h2>
				<p><em><?php esc_html_e( 'Last updated: August 17, 2025', 'vroomqc' ); ?></em></p>
				
				<p><?php esc_html_e( 'This policy explains how', 'vroomqc' ); ?> <strong><?php esc_html_e( 'Vroom Québec', 'vroomqc' ); ?></strong> <?php esc_html_e( 'uses cookies and similar technologies on our website, and how you can control them.', 'vroomqc' ); ?></p>

				<h3 id="what-are-cookies"><?php esc_html_e( 'What are cookies', 'vroomqc' ); ?></h3>
				<p><?php esc_html_e( 'Cookies are small files stored on your device by your browser. Similar technologies include SDKs, pixels, and local storage.', 'vroomqc' ); ?></p>

				<h3 id="cookie-categories"><?php esc_html_e( 'How we categorize cookies', 'vroomqc' ); ?></h3>
				<ul>
					<li><strong><?php esc_html_e( 'Strictly necessary', 'vroomqc' ); ?></strong>: <?php esc_html_e( 'required for core functions such as security, session management, checkout, and fraud prevention.', 'vroomqc' ); ?></li>
					<li><strong><?php esc_html_e( 'Preferences', 'vroomqc' ); ?></strong>: <?php esc_html_e( 'remember language and saved settings.', 'vroomqc' ); ?></li>
					<li><strong><?php esc_html_e( 'Analytics', 'vroomqc' ); ?></strong>: <?php esc_html_e( 'help us understand traffic and improve performance.', 'vroomqc' ); ?></li>
					<li><strong><?php esc_html_e( 'Advertising and measurement', 'vroomqc' ); ?></strong>: <?php esc_html_e( 'measure conversions and improve ad relevance.', 'vroomqc' ); ?></li>
				</ul>

				<h3 id="current-tools"><?php esc_html_e( 'Our current tools and examples', 'vroomqc' ); ?></h3>
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

				<h3 id="consent-control"><?php esc_html_e( 'Consent and control', 'vroomqc' ); ?></h3>
				<ul>
					<li><strong><?php esc_html_e( 'Consent', 'vroomqc' ); ?></strong>: <?php esc_html_e( 'analytics and advertising cookies are off until you choose to enable them in our banner.', 'vroomqc' ); ?></li>
					<li><strong><?php esc_html_e( 'Manage preferences', 'vroomqc' ); ?></strong>: <?php esc_html_e( 'use the banner to allow all, reject non-essential, or customize by category. You can change your choices at any time.', 'vroomqc' ); ?></li>
					<li><strong><?php esc_html_e( 'Browser controls', 'vroomqc' ); ?></strong>: <?php esc_html_e( 'you can block or delete cookies in your browser settings. Blocking some cookies may affect site functionality.', 'vroomqc' ); ?></li>
				</ul>

				<h3 id="do-not-track"><?php esc_html_e( 'Do Not Track and Global Privacy Control', 'vroomqc' ); ?></h3>
				<p><?php esc_html_e( 'Your browser may offer signals such as Do Not Track or Global Privacy Control. Where reasonably possible, we will interpret such signals as a request to opt out of non-essential cookies.', 'vroomqc' ); ?></p>

				<h3 id="cookie-contact"><?php esc_html_e( 'Contact', 'vroomqc' ); ?></h3>
				<p><?php esc_html_e( 'Questions about cookies and tracking:', 'vroomqc' ); ?> <strong><a href="mailto:info@vroomquebec.ca">info@vroomquebec.ca</a></strong>.</p>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();
?>