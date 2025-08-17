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
			'footer-navigation' => esc_html__( 'Footer Navigation', 'vroomqc' ),
			'footer-legal' => esc_html__( 'Footer Legal', 'vroomqc' ),
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

	// Enqueue lightGallery CSS and JS
	wp_enqueue_style( 'lightgallery', get_template_directory_uri() . '/assets/lib/lightgallery.min.css', array(), $version );
	wp_enqueue_script( 'lightgallery', get_template_directory_uri() . '/assets/lib/lightgallery.min.js', array(), $version, true );

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
 * Header menu fallback - outputs empty structure for dynamic adapt compatibility
 */
function vroomqc_header_menu_fallback() {
	echo '<ul class="header-menu__list"></ul>';
}


/**
 * Footer navigation menu fallback - outputs empty structure
 */
function vroomqc_footer_navigation_fallback() {
	// Output empty structure to maintain layout
}

/**
 * Footer legal menu fallback - outputs empty structure
 */
function vroomqc_footer_legal_fallback() {
	echo '<ul class="bottom-footer__list"></ul>';
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
 * Load ACF, CPT, and Taxonomies
 */
require_once get_template_directory() . '/inc/acf/acf-loader.php';
require_once get_template_directory() . '/inc/cpt/cpt-loader.php';
require_once get_template_directory() . '/inc/taxonomies/taxonomies-loader.php';

/**
 * Vehicle Helper Functions
 */

/**
 * Get formatted vehicle title
 */
function vroomqc_get_vehicle_title( $post_id = null ) {
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }
    
    $year = get_field( 'year', $post_id );
    $make_terms = get_the_terms( $post_id, 'make' );
    $model_terms = get_the_terms( $post_id, 'model' );
    
    $make_name = ( $make_terms && ! is_wp_error( $make_terms ) ) ? $make_terms[0]->name : '';
    $model_name = ( $model_terms && ! is_wp_error( $model_terms ) ) ? $model_terms[0]->name : '';
    
    $vehicle_title = trim( $year . ' ' . $make_name . ' ' . $model_name );
    
    return ! empty( $vehicle_title ) ? $vehicle_title : get_the_title( $post_id );
}

/**
 * Get vehicle price display HTML
 */
function vroomqc_get_vehicle_price_display( $post_id = null ) {
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }
    
    $price = get_field( 'price', $post_id );
    $old_price = get_field( 'old_price', $post_id );
    
    ob_start();
    
    if ( empty( $price ) ) {
        echo '<span class="products__value">' . esc_html__( 'Contact us', 'vroomqc' ) . '</span>';
    } elseif ( ! empty( $old_price ) && $old_price > $price ) {
        echo '<span class="products__last-price">$' . number_format( $old_price ) . '</span>';
        echo '<span class="products__current-price">$' . number_format( $price ) . '</span>';
    } else {
        echo '<span class="products__value">$' . number_format( $price ) . '</span>';
    }
    
    return ob_get_clean();
}

/**
 * Get vehicle payment info
 */
function vroomqc_get_vehicle_payment_info( $post_id = null ) {
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }
    
    $biweekly_payment = get_field( 'biweekly_payment', $post_id );
    $vendu = get_field( 'vendu', $post_id );
    
    if ( ! empty( $biweekly_payment ) && ! $vendu ) {
        return array(
            'amount' => $biweekly_payment,
            'formatted' => '$' . number_format( $biweekly_payment ) . '/' . __( 'biweekly', 'vroomqc' )
        );
    }
    
    return null;
}

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

/**
 * Include Vehicle functionality
 */
require_once get_template_directory() . '/inc/vehicle/helpers.php';
require_once get_template_directory() . '/inc/vehicle/vin-decoder.php';
require_once get_template_directory() . '/inc/vehicle/bulk-import.php';
require_once get_template_directory() . '/inc/vehicle/bulk-export.php';

/**
 * Set fallback featured image for vehicles
 */
add_filter( 'post_thumbnail_id', function( $thumbnail_id, $post ) {
    // Only handle vehicles with no thumbnail
    if ( get_post_type( $post ) === 'vehicle' && ( ! $thumbnail_id || empty( $thumbnail_id ) ) ) {
        return 4103;
    }
    return $thumbnail_id;
}, 10, 2 );

/**
 * Set fallback featured image for vehicles in regular WordPress context
 */
add_filter( 'post_thumbnail_html', function( $html, $post_id ) {
    // Only handle empty thumbnails for vehicle post type
    if ( empty( $html ) && get_post_type( $post_id ) === 'vehicle' ) {
        return wp_get_attachment_image( 4103, 'post-thumbnail' );
    }
    return $html;
}, 10, 2 );

/**
 * Google Analytics
 */
add_action( 'wp_head', function() {
    ?>
  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-1V45PR0PQY"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-1V45PR0PQY');
  </script>
    <?php
}, 1 ); // Priority 1 to load early

/**
 * Add Meta Pixel
 */
add_action( 'wp_head', function() {
    ?>
  <!-- Meta Pixel Code -->
  <script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '660702693633529');
  fbq('track', 'PageView');
  </script>
  <noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=660702693633529&ev=PageView&noscript=1"
  /></noscript>
  <!-- End Meta Pixel Code -->
    <?php
}, 2 ); // Priority 2 to load after GA
