<?php
/**
 * vroomqc functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package vroomqc
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function vroomqc_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on vroomqc, use a find and replace
		* to change 'vroomqc' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'vroomqc', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// Custom image sizes.
	add_image_size( 'vroomqc-hero', 1920, 800, true );
	add_image_size( 'vroomqc-card', 800, 600, true );
	add_image_size( 'vroomqc-square', 600, 600, true );

	// This theme uses wp_nav_menu() in multiple locations.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'vroomqc' ),
			'footer-explore' => esc_html__( 'Footer Explore', 'vroomqc' ),
			'footer-company' => esc_html__( 'Footer Company', 'vroomqc' ),
			'footer-legal' => esc_html__( 'Footer Legal', 'vroomqc' ),
			'social' => esc_html__( 'Social Links', 'vroomqc' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'vroomqc_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'vroomqc_setup' );

/**
 * Expose custom sizes in the media chooser.
 */
function vroomqc_custom_image_sizes_choose( $sizes ) {
	return array_merge(
		$sizes,
		array(
			'vroomqc-hero'   => __( 'Hero (1920x800 hard crop)', 'vroomqc' ),
			'vroomqc-card'   => __( 'Card (800x600 hard crop)', 'vroomqc' ),
			'vroomqc-square' => __( 'Square (600x600 hard crop)', 'vroomqc' ),
		)
	);
}
add_filter( 'image_size_names_choose', 'vroomqc_custom_image_sizes_choose' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function vroomqc_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'vroomqc_content_width', 640 );
}
add_action( 'after_setup_theme', 'vroomqc_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function vroomqc_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'vroomqc' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'vroomqc' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'vroomqc_widgets_init' );

/**
 * Check if we're in development mode
 */
function vroomqc_is_development() {
	return defined( 'WP_ENV' ) && WP_ENV === 'development';
}

/**
 * Get Vite manifest
 */
function vroomqc_get_vite_manifest() {
	$manifest_path = get_template_directory() . '/assets/dist/.vite/manifest.json';
	
	if ( ! file_exists( $manifest_path ) ) {
		return null;
	}
	
	$manifest = file_get_contents( $manifest_path );
	return json_decode( $manifest, true );
}

/**
 * Enqueue scripts and styles.
 */
function vroomqc_scripts() {
	$version = _S_VERSION;
	
	if ( vroomqc_is_development() ) {
		// Development mode - use Vite dev server
		wp_enqueue_script( 'vroomqc-vite-client', 'http://localhost:5173/@vite/client', array(), null, false );
		wp_enqueue_script( 'vroomqc-main', 'http://localhost:5173/assets/src/js/main.js', array(), null, true );
		wp_enqueue_style( 'vroomqc-style', 'http://localhost:5173/assets/src/scss/style.scss', array(), null );
	} else {
		// Production mode - use compiled assets
		$manifest = vroomqc_get_vite_manifest();
		
		if ( $manifest ) {
			// Enqueue CSS
			if ( isset( $manifest['assets/src/scss/style.scss'] ) ) {
				$css_file = $manifest['assets/src/scss/style.scss']['file'];
				wp_enqueue_style( 'vroomqc-style', get_template_directory_uri() . '/assets/dist/' . $css_file, array(), $version );
			}
			
			// Enqueue JS
			if ( isset( $manifest['assets/src/js/main.js'] ) ) {
				$js_file = $manifest['assets/src/js/main.js']['file'];
				wp_enqueue_script( 'vroomqc-main', get_template_directory_uri() . '/assets/dist/' . $js_file, array(), $version, true );
				
				// Add module type for ES modules
				wp_script_add_data( 'vroomqc-main', 'type', 'module' );
			}
		} else {
			// Fallback to default WordPress styles
			wp_enqueue_style( 'vroomqc-style', get_stylesheet_uri(), array(), $version );
		}
	}

	// The original static site uses only the main script.js file - no separate navigation.js needed

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'vroomqc_scripts' );

/**
 * Include the custom nav walker classes
 */
require get_template_directory() . '/inc/class-custom-nav-walker.php';
require get_template_directory() . '/inc/class-footer-nav-walker.php';

/**
 * SVG Helper Function
 */
function vroomqc_get_svg( $svg_path ) {
	$svg_file = get_template_directory() . '/assets/images/' . $svg_path;
	
	if ( file_exists( $svg_file ) ) {
		return file_get_contents( $svg_file );
	}
	
	// Fallback for SVG sprite usage
	if ( strpos( $svg_path, '#' ) !== false ) {
		return '<svg><use xlink:href="' . esc_url( get_template_directory_uri() . '/assets/images/' . $svg_path ) . '"></use></svg>';
	}
	
	return '';
}

/**
 * Social menu fallback
 */
function vroomqc_social_menu_fallback() {
	echo '<ul class="footer__list">';
	echo '<li class="footer__item"><a href="#" aria-label="x" class="footer__link"><img src="' . esc_url( get_template_directory_uri() . '/assets/images/icons/socials/social-icon_01.svg' ) . '" loading="lazy" alt="footer"></a></li>';
	echo '<li class="footer__item"><a href="#" aria-label="instagram" class="footer__link"><img src="' . esc_url( get_template_directory_uri() . '/assets/images/icons/socials/social-icon_02.svg' ) . '" loading="lazy" alt="footer"></a></li>';
	echo '<li class="footer__item"><a href="#" aria-label="facebook" class="footer__link"><img src="' . esc_url( get_template_directory_uri() . '/assets/images/icons/socials/social-icon_03.svg' ) . '" loading="lazy" alt="footer"></a></li>';
	echo '<li class="footer__item"><a href="#" aria-label="youtube" class="footer__link"><img src="' . esc_url( get_template_directory_uri() . '/assets/images/icons/socials/social-icon_04.svg' ) . '" loading="lazy" alt="footer"></a></li>';
	echo '</ul>';
}

/**
 * Footer explore menu fallback
 */
function vroomqc_footer_explore_fallback() {
	echo '<ul class="navs-footer__list">';
	echo '<li class="navs-footer__item"><a href="#" class="navs-footer__link">' . esc_html__( 'Find a car', 'vroomqc' ) . '</a></li>';
	echo '<li class="navs-footer__item"><a href="#" class="navs-footer__link">' . esc_html__( 'Sell or trade', 'vroomqc' ) . '</a></li>';
	echo '<li class="navs-footer__item"><a href="#" class="navs-footer__link">' . esc_html__( 'Financing', 'vroomqc' ) . '</a></li>';
	echo '<li class="navs-footer__item"><a href="#" class="navs-footer__link">' . esc_html__( 'Warranty', 'vroomqc' ) . '</a></li>';
	echo '<li class="navs-footer__item"><a href="#" class="navs-footer__link">' . esc_html__( 'Contact', 'vroomqc' ) . '</a></li>';
	echo '</ul>';
}

/**
 * Footer company menu fallback
 */
function vroomqc_footer_company_fallback() {
	echo '<ul class="navs-footer__list">';
	echo '<li class="navs-footer__item"><a href="#" class="navs-footer__link">' . esc_html__( 'About', 'vroomqc' ) . '</a></li>';
	echo '<li class="navs-footer__item"><a href="#" class="navs-footer__link">' . esc_html__( 'Careers', 'vroomqc' ) . '</a></li>';
	echo '<li class="navs-footer__item"><a href="#" class="navs-footer__link">' . esc_html__( 'Blog', 'vroomqc' ) . '</a></li>';
	echo '<li class="navs-footer__item"><a href="#" class="navs-footer__link">' . esc_html__( 'FAQs', 'vroomqc' ) . '</a></li>';
	echo '</ul>';
}

/**
 * Footer legal menu fallback
 */
function vroomqc_footer_legal_fallback() {
	echo '<ul class="bottom-footer__list">';
	echo '<li class="bottom-footer__item"><a href="#" class="bottom-footer__link">' . esc_html__( 'Privacy policy', 'vroomqc' ) . '</a></li>';
	echo '<li class="bottom-footer__item"><a href="#" class="bottom-footer__link">' . esc_html__( 'Terms & conditions', 'vroomqc' ) . '</a></li>';
	echo '</ul>';
}

/**
 * Recursively include all PHP files inside the `inc` directory and its subdirectories.
 */
function vroomqc_require_inc_recursive( $directory_path ) {
	if ( ! is_dir( $directory_path ) ) {
		return;
	}

	$iterator = new RecursiveIteratorIterator(
		new RecursiveDirectoryIterator( $directory_path, FilesystemIterator::SKIP_DOTS ),
		RecursiveIteratorIterator::SELF_FIRST
	);

	foreach ( $iterator as $file_info ) {
		if ( $file_info->isFile() && strtolower( $file_info->getExtension() ) === 'php' ) {
			require_once $file_info->getPathname();
		}
	}
}

vroomqc_require_inc_recursive( get_template_directory() . '/inc' );

/**
 * WooCommerce support (lean).
 */
function vroomqc_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'vroomqc_add_woocommerce_support' );

/**
 * Disable block editor everywhere except the blog posts.
 */
function vroomqc_use_block_editor_for_post_type( $use_block_editor, $post_type ) {
	return ( $post_type === 'post' );
}
add_filter( 'use_block_editor_for_post_type', 'vroomqc_use_block_editor_for_post_type', 10, 2 );

// Disable block-based widgets editor.
add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );
add_filter( 'use_widgets_block_editor', '__return_false' );
