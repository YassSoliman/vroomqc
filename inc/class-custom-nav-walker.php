<?php
/**
 * Custom Nav Walker Class
 *
 * @package vroomqc
 */

class Custom_Nav_Walker extends Walker_Nav_Menu {

	function start_lvl( &$output, $depth = 0, $args = null ) {
		$output .= '<div class="sub-menu"><ul class="sub-menu__list">';
	}

	function end_lvl( &$output, $depth = 0, $args = null ) {
		$output .= '</ul></div>';
	}

	function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		$has_children = in_array( 'menu-item-has-children', $classes );
		
		if ( $depth === 0 ) {
			$output .= '<li class="header-menu__item">';
			$attributes = '';
			if ( $has_children ) {
				$attributes .= ' data-with-submenu';
			}
			$output .= '<a href="' . esc_url( $item->url ) . '" class="header-menu__link"' . $attributes . '>';
			$output .= esc_html( $item->title );
			$output .= '</a>';
		} else {
			$output .= '<li class="sub-menu__item">';
			$output .= '<a href="' . esc_url( $item->url ) . '" class="sub-menu__link">';
			$output .= esc_html( $item->title );
			$output .= '</a>';
		}
	}

	function end_el( &$output, $item, $depth = 0, $args = null ) {
		$output .= '</li>';
	}
}