<?php
/**
 * The template for displaying the footer
 *
 * @package vroomqc
 */

?>

		<footer class="footer">
			<div class="footer__container">
				<div class="footer__body">
					<div class="footer__actions">
						<?php if ( has_custom_logo() ) : ?>
							<div class="footer__logo">
								<?php the_custom_logo(); ?>
							</div>
						<?php else : ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer__logo" aria-label="<?php esc_attr_e( 'homepage link', 'vroomqc' ); ?>">
								<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/main/logo-white.png' ); ?>" loading="lazy" alt="<?php bloginfo( 'name' ); ?>">
							</a>
						<?php endif; ?>
						
						<div class="footer__select select" data-select-menu>
							<h2 class="select__label"><?php esc_html_e( 'Language', 'vroomqc' ); ?></h2>
							<button class="select__header" type="button" aria-label="<?php esc_attr_e( 'choose language', 'vroomqc' ); ?>" data-select-menu-button>
								<span class="select__value" data-select-menu-value><?php esc_html_e( 'English', 'vroomqc' ); ?></span>
								<span class="select__icon">
									<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#drop-down-icon' ); ?>
								</span>
							</button>
							<ul class="select__body" data-select-menu-drop-down>
								<li class="select__item" data-select-menu-option>
									<a href="#" class="select__link"><span><?php esc_html_e( 'Ukrainian', 'vroomqc' ); ?></span></a>
								</li>
								<li class="select__item" data-select-menu-option>
									<a href="#" class="select__link"><span><?php esc_html_e( 'Italian', 'vroomqc' ); ?></span></a>
								</li>
							</ul>
						</div>
						
						<div class="footer__socials">
							<h2 class="footer__label"><?php esc_html_e( 'Social', 'vroomqc' ); ?></h2>
							<?php
							$social_links = vroomqc_get_social_links();
							if ( ! empty( $social_links ) ) :
								echo '<ul class="footer__list">';
								$social_icons = array(
									'twitter'   => 'social-icon_01.svg',
									'instagram' => 'social-icon_02.svg',
									'facebook'  => 'social-icon_03.svg',
									'youtube'   => 'social-icon_04.svg',
								);
								foreach ( $social_links as $platform => $url ) :
									$icon = isset( $social_icons[ $platform ] ) ? $social_icons[ $platform ] : 'social-icon_01.svg';
							?>
								<li class="footer__item">
									<a href="<?php echo esc_url( $url ); ?>" aria-label="<?php echo esc_attr( $platform ); ?>" class="footer__link" target="_blank" rel="noopener noreferrer">
										<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/icons/socials/' . $icon ); ?>" loading="lazy" alt="<?php echo esc_attr( $platform ); ?>">
									</a>
								</li>
							<?php
								endforeach;
								echo '</ul>';
							else :
								wp_nav_menu(
									array(
										'theme_location' => 'social',
										'menu_id'        => 'social-menu',
										'container'      => false,
										'items_wrap'     => '<ul class="footer__list">%3$s</ul>',
										'walker'         => new Footer_Nav_Walker(),
										'fallback_cb'    => 'vroomqc_social_menu_fallback',
									)
								);
							endif;
							?>
						</div>
					</div>
					
					<div class="navs-footer">
						<nav class="navs-footer__menu">
							<h2 class="navs-footer__title">
								<?php esc_html_e( 'Explore', 'vroomqc' ); ?>
							</h2>
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'footer-explore',
									'menu_id'        => 'footer-explore-menu',
									'container'      => false,
									'items_wrap'     => '<ul class="navs-footer__list">%3$s</ul>',
									'walker'         => new Footer_Nav_Walker(),
									'fallback_cb'    => 'vroomqc_footer_explore_fallback',
								)
							);
							?>
						</nav>
						
						<nav class="navs-footer__menu">
							<h2 class="navs-footer__title">
								<?php esc_html_e( 'Company', 'vroomqc' ); ?>
							</h2>
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'footer-company',
									'menu_id'        => 'footer-company-menu',
									'container'      => false,
									'items_wrap'     => '<ul class="navs-footer__list">%3$s</ul>',
									'walker'         => new Footer_Nav_Walker(),
									'fallback_cb'    => 'vroomqc_footer_company_fallback',
								)
							);
							?>
						</nav>
					</div>
				</div>
				
				<div class="footer__bottom bottom-footer">
					<div class="bottom-footer__copy">
						<?php
						$copyright_text = get_theme_mod( 'vroomqc_footer_copyright', 'Vroom - Canadian Car Dealership. All rights reserved.' );
						printf(
							/* translators: 1: Copyright year, 2: Copyright text */
							esc_html__( '© %1$s %2$s', 'vroomqc' ),
							date( 'Y' ),
							esc_html( $copyright_text )
						);
						?>
					</div>
					
					<nav class="bottom-footer__menu">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'footer-legal',
								'menu_id'        => 'footer-legal-menu',
								'container'      => false,
								'items_wrap'     => '<ul class="bottom-footer__list">%3$s</ul>',
								'walker'         => new Footer_Nav_Walker(),
								'fallback_cb'    => 'vroomqc_footer_legal_fallback',
							)
						);
						?>
					</nav>
				</div>
			</div>
		</footer>
	</div><!-- .wrapper -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
