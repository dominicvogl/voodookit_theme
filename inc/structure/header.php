<?php
/**
 * This is Voodookit!
 *
 * @since 1.0.0
 * @package Voodookit
 */


if ( ! function_exists( 'voodookit_header' ) ) {

	function voodookit_header() {

		echo '<header class="page-header main-header row full-width align-middle">';
		echo '<div class="column small-12 large-3">';
		do_action('voodookit_do_logo');
		echo '</div>';
		do_action('voodookit_do_navigation');
		echo '</header>';
	}

}

if ( ! function_exists( 'voodookit_logo' ) ) {

	function voodookit_logo() {

		if( ! get_theme_mod( 'evolution_logo' )) {
			echo '<div class="callout alert">Logo required!</div>';
			return;
		}

		$logo_src = esc_url( get_theme_mod( 'evolution_logo' ) );
		list ( $logo_size ) = getimagesize( $logo_src );

		echo
			'<div class="logo">
				<a href="'.get_home_url().'" target="_self">
					<img src="' . $logo_src . '" width="'.$logo_size[0].'" height="'.$logo_size[1].'" />
				</a>
			</div>';

	}

}

if ( ! function_exists( 'voodookit_navigation' ) ) {

	function voodookit_navigation() {

		echo '<nav role="navigation" class="column small-9 show-for-large menu desktop horizontal">';
		wp_nav_menu(
			[
				'container' => '',
				'menu_class' => 'menu desktop horizontal',
				'theme_location' => 'primary'
			]
		);
		echo '</nav>';

	}

}

if ( ! function_exists( 'voodookit_navigation_mobile' ) ) {

	function voodookit_navigation_mobile() {

		wp_nav_menu(
			[
				'container' => 'nav',
				'container_class' => 'navigation-mobile',
				'menu_class' => 'js-accordion-menu menu mobile vertical accordion-menu',
				'theme_location' => 'primary'
			]
		);

		wp_nav_menu(
			[
				'container' => 'nav',
				'container_class' => 'navigation-mobile secondary',
				'menu_class' => 'js-accordion-menu menu mobile vertical accordion-menu',
				'theme_location' => 'footer'
			]
		);

	}

}

if ( ! function_exists('voodookit_slideout_toggler') ) {

	function voodookit_slideout_toggler() {

		echo
			'<div class="toggler-wrapper hide-for-large js-toggle-slideout">
				<div class="toggle-button">
					<span class="button-label">'.__("Nav Menu", "voodookit").'</span>
					<div class="button-bars">
						<span class="bar"></span>
						<span class="bar"></span>
						<span class="bar"></span>
					</div>
				</div>
			</div>';
	}

}
