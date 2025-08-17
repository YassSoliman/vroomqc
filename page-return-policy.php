<?php
/**
 * Template Name: Return Policy
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
								<?php esc_html_e( 'Return Policy', 'vroomqc' ); ?>
							</span>
						</li>
					</ul>
				</nav>
			</div>
			<h1 class="policy-header__title title">
				<?php esc_html_e( 'Return Policy', 'vroomqc' ); ?>
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
						<?php esc_html_e( 'We want you to be confident in your purchase. In addition to your legal warranty rights in Québec, we offer a satisfaction guarantee on eligible vehicles as described below.', 'vroomqc' ); ?>
					</p>
				</div>

				<h2 id="satisfaction-guarantee"><?php esc_html_e( '10-day satisfaction guarantee', 'vroomqc' ); ?></h2>
				<ul>
					<li><strong><?php esc_html_e( 'Period', 'vroomqc' ); ?></strong>: <?php esc_html_e( 'ten days or 500 km from delivery or pickup, whichever occurs first.', 'vroomqc' ); ?></li>
					<li><strong><?php esc_html_e( 'Eligibility', 'vroomqc' ); ?></strong>: <?php esc_html_e( 'vehicles that state eligibility in the listing or the bill of sale.', 'vroomqc' ); ?></li>
					<li><strong><?php esc_html_e( 'Condition', 'vroomqc' ); ?></strong>: <?php esc_html_e( 'the vehicle must be in the same condition as delivered, with normal test-drive use only. No collisions, new damage, liens, modifications, tampering, or smoke odors.', 'vroomqc' ); ?></li>
					<li><strong><?php esc_html_e( 'Refundable amounts', 'vroomqc' ); ?></strong>: <?php esc_html_e( 'the purchase price of the vehicle. Government fees, registration, plates, third-party warranty products, and delivery fees are not refundable.', 'vroomqc' ); ?></li>
					<li><strong><?php esc_html_e( 'Limit', 'vroomqc' ); ?></strong>: <?php esc_html_e( 'one return per household in any rolling twelve-month period.', 'vroomqc' ); ?></li>
				</ul>

				<h2 id="how-to-return"><?php esc_html_e( 'How to return', 'vroomqc' ); ?></h2>
				<ol>
					<li><strong><?php esc_html_e( 'Contact us', 'vroomqc' ); ?></strong> <?php esc_html_e( 'at', 'vroomqc' ); ?> <strong><a href="mailto:info@vroomquebec.ca">info@vroomquebec.ca</a></strong> <?php esc_html_e( 'within the guarantee period and include your order details.', 'vroomqc' ); ?></li>
					<li><strong><?php esc_html_e( 'Inspection', 'vroomqc' ); ?></strong> <?php esc_html_e( 'is scheduled for pickup or drop-off.', 'vroomqc' ); ?></li>
					<li><strong><?php esc_html_e( 'Refund', 'vroomqc' ); ?></strong> <?php esc_html_e( 'is processed to the original payment method after inspection. For financed purchases, we coordinate lender payoff and any balance adjustments. Refund timing depends on your bank or card issuer.', 'vroomqc' ); ?></li>
				</ol>

				<h2 id="exchanges"><?php esc_html_e( 'Exchanges', 'vroomqc' ); ?></h2>
				<p><?php esc_html_e( 'If you prefer an exchange, we can apply your refund toward another vehicle, subject to availability and any price difference.', 'vroomqc' ); ?></p>

				<h2 id="exceptions"><?php esc_html_e( 'Exceptions', 'vroomqc' ); ?></h2>
				<p><?php esc_html_e( 'The guarantee does not apply if the vehicle has been used commercially, raced or tracked, altered mechanically or cosmetically, involved in a collision, or if odometer tampering is suspected.', 'vroomqc' ); ?></p>

				<h2 id="legal-warranty"><?php esc_html_e( 'Legal warranty', 'vroomqc' ); ?></h2>
				<p><?php esc_html_e( 'This policy does not limit the legal warranty of quality and use under the Civil Code of Québec and the Consumer Protection Act. If this policy conflicts with your statutory rights, your statutory rights apply.', 'vroomqc' ); ?></p>

				<h2 id="contact"><?php esc_html_e( 'Contact', 'vroomqc' ); ?></h2>
				<div class="contact-block">
					<p><strong><?php esc_html_e( 'Email:', 'vroomqc' ); ?></strong> <a href="mailto:info@vroomquebec.ca">info@vroomquebec.ca</a></p>
					<p><strong><?php esc_html_e( 'Returns address:', 'vroomqc' ); ?></strong> <?php esc_html_e( '1635 boul. Manseau, Longueuil, Québec, J4K 3C3, Canada', 'vroomqc' ); ?></p>
				</div>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();
?>