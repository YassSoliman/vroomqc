<?php
/**
 * The header for our theme
 *
 * @package vroomqc
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link href="https://fonts.googleapis.com/css?family=Inter:regular,500,600&display=swap" rel="stylesheet">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<div class="wrapper">
		<header class="header">
			<div class="header__wrapper">
				<div class="header__container">
					<?php if ( has_custom_logo() ) : ?>
						<div class="header__logo">
							<?php the_custom_logo(); ?>
						</div>
					<?php else : ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header__logo" aria-label="<?php esc_attr_e( 'homepage link', 'vroomqc' ); ?>">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/main/logo-black.jpg' ); ?>" alt="<?php bloginfo( 'name' ); ?>">
						</a>
					<?php endif; ?>
					
					<nav class="header-menu">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'menu-1',
								'menu_id'        => 'primary-menu',
								'container'      => false,
								'items_wrap'     => '<ul class="header-menu__list">%3$s</ul>',
								'walker'         => new Custom_Nav_Walker(),
								'fallback_cb'    => 'vroomqc_header_menu_fallback',
							)
						);
						?>
					</nav>
					
					<div class="actions-header">
						<ul class="actions-header__list">
							<li class="actions-header__item" data-da=".header-menu__list,514,last">
								<a href="#" class="actions-header__link actions-header__link-icon">
									<span class="actions-header__icon">
										<?php echo vroomqc_get_svg( 'icons/icons-sprite.svg#lang-icon' ); ?>
									</span>
									<span class="actions-header__text">
										<?php esc_html_e( 'English', 'vroomqc' ); ?>
									</span>
								</a>
							</li>
							<li class="actions-header__item" data-da=".header-menu__list,514,last">
								<a href="#" class="actions-header__link">
									<?php esc_html_e( 'Sign in', 'vroomqc' ); ?>
								</a>
							</li>
							<li class="actions-header__item">
								<a href="<?php echo esc_url( get_permalink( 520 ) ); ?>" class="actions-header__link button">
									<?php esc_html_e( 'Pre-qualify', 'vroomqc' ); ?>
								</a>
							</li>
						</ul>
					</div>
					
					<button class="burger-menu" aria-label="<?php esc_attr_e( 'open/close menu', 'vroomqc' ); ?>">
						<span class="burger-menu__line burger-menu__line_1"></span>
						<span class="burger-menu__line burger-menu__line_2"></span>
						<span class="burger-menu__line burger-menu__line_3"></span>
					</button>
				</div>
			</div>
			
			<div class="header__message">
				<?php esc_html_e( 'Pre-qualify in 2 minutes  won\'t affect your credit score.', 'vroomqc' ); ?> 
				<a href="<?php echo esc_url( get_permalink( 520 ) ); ?>" class="header__link"><?php esc_html_e( 'Get started', 'vroomqc' ); ?></a>
			</div>
		</header>