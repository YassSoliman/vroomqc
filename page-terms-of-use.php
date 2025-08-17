<?php
/**
 * Template Name: Terms of Use
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
								<?php esc_html_e( 'Terms of Use', 'vroomqc' ); ?>
							</span>
						</li>
					</ul>
				</nav>
			</div>
			<h1 class="policy-header__title title">
				<?php esc_html_e( 'Terms of Use', 'vroomqc' ); ?>
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
						<?php esc_html_e( 'These Terms govern your access to and use of the website, content, and services provided by Automobile Mazzeo Inc., doing business as', 'vroomqc' ); ?> <strong><?php esc_html_e( 'Vroom Québec', 'vroomqc' ); ?></strong> ("<?php esc_html_e( '**Vroom Québec**', 'vroomqc' ); ?>", "<?php esc_html_e( '**we**', 'vroomqc' ); ?>", "<?php esc_html_e( '**us**', 'vroomqc' ); ?>", "<?php esc_html_e( '**our**', 'vroomqc' ); ?>").
					</p>
				</div>

				<div class="contact-block">
					<p><strong><?php esc_html_e( 'Contact', 'vroomqc' ); ?></strong></p>
					<p><strong><?php esc_html_e( 'Email:', 'vroomqc' ); ?></strong> <a href="mailto:info@vroomquebec.ca">info@vroomquebec.ca</a></p>
					<p><strong><?php esc_html_e( 'Mailing address:', 'vroomqc' ); ?></strong> <?php esc_html_e( '1635 boul. Manseau, Longueuil, Québec, J4K 3C3, Canada', 'vroomqc' ); ?></p>
				</div>

				<h2 id="acceptance"><?php esc_html_e( 'Acceptance', 'vroomqc' ); ?></h2>
				<p><?php esc_html_e( 'By using our site or services, you agree to these Terms, our', 'vroomqc' ); ?> <strong><?php esc_html_e( 'Privacy Policy', 'vroomqc' ); ?></strong>, <?php esc_html_e( 'and our', 'vroomqc' ); ?> <strong><?php esc_html_e( 'Cookie Policy', 'vroomqc' ); ?></strong>.</p>

				<h2 id="eligibility"><?php esc_html_e( 'Eligibility and accounts', 'vroomqc' ); ?></h2>
				<p><?php esc_html_e( 'You must be the age of majority in your province to use our services. You are responsible for maintaining the confidentiality of your credentials and for all activities under your account.', 'vroomqc' ); ?></p>

				<h2 id="site-content"><?php esc_html_e( 'Site content and availability', 'vroomqc' ); ?></h2>
				<p><?php esc_html_e( 'We aim to keep listings, specifications, photos, and pricing accurate. Availability can change at any time. If there is a material error in price or description, we may cancel or correct the order and will notify you. Taxes, registration, delivery, and government fees are additional unless stated otherwise.', 'vroomqc' ); ?></p>

				<h2 id="payments"><?php esc_html_e( 'Payments', 'vroomqc' ); ?></h2>
				<p><?php esc_html_e( 'Payments are processed by third-party providers, currently', 'vroomqc' ); ?> <strong><?php esc_html_e( 'Stripe', 'vroomqc' ); ?></strong> <?php esc_html_e( 'and', 'vroomqc' ); ?> <strong><?php esc_html_e( 'QuickBooks Payments', 'vroomqc' ); ?></strong>. <?php esc_html_e( 'Provider availability can vary. By paying, you authorize the applicable payment processor to charge your method and you agree to its terms. We do not store full card numbers on our systems.', 'vroomqc' ); ?></p>

				<h2 id="financing"><?php esc_html_e( 'Financing', 'vroomqc' ); ?></h2>
				<p><?php esc_html_e( 'Financing is provided by third-party lenders. Approvals, rates, and terms depend on lender criteria and verification. By submitting an application, you authorize us to share your information with lenders and credit bureaus as permitted by law and with your consent.', 'vroomqc' ); ?></p>

				<h2 id="test-drives"><?php esc_html_e( 'Test drives and delivery', 'vroomqc' ); ?></h2>
				<p><?php esc_html_e( 'You agree to provide valid identification and, if requested, proof of insurance. You are responsible for fines or damages that result from misuse during a test drive, subject to applicable law and our written terms. Delivery timelines are estimates and may vary due to factors outside our control.', 'vroomqc' ); ?></p>

				<h2 id="returns"><?php esc_html_e( 'Returns and exchanges', 'vroomqc' ); ?></h2>
				<p><?php esc_html_e( 'See our', 'vroomqc' ); ?> <strong><?php esc_html_e( 'Return Policy', 'vroomqc' ); ?></strong> <?php esc_html_e( 'for eligibility, conditions, and steps. Nothing in our policies limits your mandatory rights under the Civil Code of Québec and the Consumer Protection Act.', 'vroomqc' ); ?></p>

				<h2 id="acceptable-use"><?php esc_html_e( 'Acceptable use', 'vroomqc' ); ?></h2>
				<p><?php esc_html_e( 'You agree not to misuse the site, including by:', 'vroomqc' ); ?></p>
				<ul>
					<li><?php esc_html_e( 'accessing or collecting data without authorization,', 'vroomqc' ); ?></li>
					<li><?php esc_html_e( 'scraping or reverse engineering,', 'vroomqc' ); ?></li>
					<li><?php esc_html_e( 'introducing malware,', 'vroomqc' ); ?></li>
					<li><?php esc_html_e( 'attempting to bypass security,', 'vroomqc' ); ?></li>
					<li><?php esc_html_e( 'infringing third-party rights, or', 'vroomqc' ); ?></li>
					<li><?php esc_html_e( 'using the site for unlawful purposes.', 'vroomqc' ); ?></li>
				</ul>

				<h2 id="intellectual-property"><?php esc_html_e( 'Intellectual property', 'vroomqc' ); ?></h2>
				<p><?php esc_html_e( 'The site, logos, text, graphics, images, software, and other materials are owned by Automobile Mazzeo Inc. or licensed to us. You may not copy, modify, distribute, or create derivative works except as allowed by law.', 'vroomqc' ); ?></p>

				<h2 id="third-party"><?php esc_html_e( 'Third-party links and tools', 'vroomqc' ); ?></h2>
				<p><?php esc_html_e( 'Our site may link to or integrate third-party sites and tools, including payment processors, lenders, logistics providers, analytics, advertising platforms, and CRM tools. We are not responsible for third-party content or practices. Your use of third-party services is subject to their terms.', 'vroomqc' ); ?></p>

				<h2 id="disclaimers"><?php esc_html_e( 'Disclaimers', 'vroomqc' ); ?></h2>
				<p><?php esc_html_e( 'The site and services are provided on an "as is" and "as available" basis. To the extent permitted by Québec law, we disclaim implied warranties of merchantability, fitness for a particular purpose, and non-infringement. Consumer rights that cannot be excluded in Québec remain in force.', 'vroomqc' ); ?></p>

				<h2 id="limitation-liability"><?php esc_html_e( 'Limitation of liability', 'vroomqc' ); ?></h2>
				<p><?php esc_html_e( 'To the extent permitted by law, Vroom Québec is not liable for indirect, incidental, special, consequential, or punitive damages, or for loss of profits, revenue, data, or goodwill. For direct damages, our aggregate liability is limited to the amount you paid for the service that gave rise to the claim. These limits do not apply where prohibited by consumer protection laws.', 'vroomqc' ); ?></p>

				<h2 id="indemnity"><?php esc_html_e( 'Indemnity', 'vroomqc' ); ?></h2>
				<p><?php esc_html_e( 'You agree to indemnify and hold harmless Vroom Québec and its officers, directors, employees, and agents from claims arising out of your misuse of the site or violation of these Terms.', 'vroomqc' ); ?></p>

				<h2 id="governing-law"><?php esc_html_e( 'Governing law and venue', 'vroomqc' ); ?></h2>
				<p><?php esc_html_e( 'These Terms are governed by the laws of Québec and the federal laws of Canada that apply in Québec. Courts located in Québec have jurisdiction, subject to consumer protection rules that may grant you rights in your local district.', 'vroomqc' ); ?></p>

				<h2 id="changes"><?php esc_html_e( 'Changes', 'vroomqc' ); ?></h2>
				<p><?php esc_html_e( 'We may update these Terms from time to time. Continued use after changes means you accept the updated Terms.', 'vroomqc' ); ?></p>

				<h2 id="contact"><?php esc_html_e( 'Contact', 'vroomqc' ); ?></h2>
				<p><?php esc_html_e( 'For questions about these Terms:', 'vroomqc' ); ?> <strong><a href="mailto:info@vroomquebec.ca">info@vroomquebec.ca</a></strong>.</p>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();
?>