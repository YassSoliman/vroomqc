<?php
/**
 * Footer Nav Walker Class
 *
 * @package vroomqc
 */

class Footer_Nav_Walker extends Walker_Nav_Menu {

	public function start_lvl( &$output, $depth = 0, $args = null ) {
		// Start submenu (child items)
		if ( $depth === 0 ) {
			$output .= '<ul class="navs-footer__list">';
		}
	}

	public function end_lvl( &$output, $depth = 0, $args = null ) {
		// End submenu
		if ( $depth === 0 ) {
			$output .= '</ul>';
		}
	}

	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		
		// Special handling for footer-legal: always render as direct links
		if ( isset( $args->theme_location ) && $args->theme_location === 'footer-legal' ) {
			$output .= '<li class="bottom-footer__item">';
			$output .= '<a href="' . esc_url( $item->url ) . '" class="bottom-footer__link">';
			$output .= esc_html( $item->title );
			$output .= '</a>';
		} else {
			// Standard hierarchical behavior for footer-navigation
			if ( $depth === 0 ) {
				// Top-level items become section titles
				$output .= '<nav class="navs-footer__menu">';
				$output .= '<h2 class="navs-footer__title">' . esc_html( $item->title ) . '</h2>';
			} else {
				// Child items become links
				$output .= '<li class="navs-footer__item">';
				$output .= '<a href="' . esc_url( $item->url ) . '" class="navs-footer__link">';
				$output .= esc_html( $item->title );
				$output .= '</a>';
			}
		}
	}

	public function end_el( &$output, $item, $depth = 0, $args = null ) {
		// Special handling for footer-legal: always close list item
		if ( isset( $args->theme_location ) && $args->theme_location === 'footer-legal' ) {
			$output .= '</li>';
		} else {
			// Standard hierarchical behavior for footer-navigation
			if ( $depth === 0 ) {
				// Close the nav wrapper for top-level items
				$output .= '</nav>';
			} else {
				// Close list item for child items
				$output .= '</li>';
			}
		}
	}
}