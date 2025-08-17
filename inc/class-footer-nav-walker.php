<?php
/**
 * Footer Nav Walker Class
 *
 * @package vroomqc
 */

class Footer_Nav_Walker extends Walker_Nav_Menu {

	function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		
		// Different classes based on menu location
		if ( isset( $args->theme_location ) ) {
			switch ( $args->theme_location ) {
				case 'footer-explore':
				case 'footer-company':
					$output .= '<li class="navs-footer__item">';
					$output .= '<a href="' . esc_url( $item->url ) . '" class="navs-footer__link">';
					break;
				case 'footer-legal':
					$output .= '<li class="bottom-footer__item">';
					$output .= '<a href="' . esc_url( $item->url ) . '" class="bottom-footer__link">';
					break;
				case 'social':
					$output .= '<li class="footer__item">';
					$output .= '<a href="' . esc_url( $item->url ) . '" class="footer__link" aria-label="' . esc_attr( $item->title ) . '">';
					break;
				default:
					$output .= '<li>';
					$output .= '<a href="' . esc_url( $item->url ) . '">';
					break;
			}
		} else {
			$output .= '<li>';
			$output .= '<a href="' . esc_url( $item->url ) . '">';
		}
		
		$output .= esc_html( $item->title );
		$output .= '</a>';
	}

	function end_el( &$output, $item, $depth = 0, $args = null ) {
		$output .= '</li>';
	}
}