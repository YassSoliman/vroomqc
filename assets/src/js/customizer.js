/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );

	// Hero title
	wp.customize( 'vroomqc_hero_title', function( value ) {
		value.bind( function( to ) {
			$( '.hero-home__title' ).text( to );
		} );
	} );

	// Hero subtitle
	wp.customize( 'vroomqc_hero_subtitle', function( value ) {
		value.bind( function( to ) {
			$( '.hero-home__subtitle' ).text( to );
		} );
	} );

	// Footer copyright
	wp.customize( 'vroomqc_footer_copyright', function( value ) {
		value.bind( function( to ) {
			$( '.bottom-footer__copy' ).text( '© ' + new Date().getFullYear() + ' ' + to );
		} );
	} );

} )( jQuery );