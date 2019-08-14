<?php
/**
 * This is Voodookit!
 *
 * @since 1.0.0
 * @package Voodookit
 */


if ( ! function_exists( 'voodookit_before_header' ) ) {

	function voodookit_before_header    () {
		echo
			'<header class="row full-width align-bottom">';
	}

}

if ( ! function_exists( 'voodookit_after_header' ) ) {

	function voodookit_after_header() {
		echo
			'</header>';
	}

}


if ( ! function_exists( 'voodookit_header' ) ) {

	function voodookit_header() {

		do_action('voodookit_do_logo');
		do_action('voodookit_do_navigation');

	}

}

if ( ! function_exists( 'voodookit_logo' ) ) {

	function voodookit_logo() {

		if( ! get_theme_mod( 'evolution_logo' )) {
			return;
		}

		$logo_src = esc_url( get_theme_mod( 'evolution_logo' ) );
		list ( $logo_size ) = getimagesize( $logo_src );

		echo
			'<div class="column small-12 large-3">
				<div class="logo">
					<img src="' . $logo_src . '" width="'.$logo_size[0].'" height="'.$logo_size[1].'" />
				</div>
			</div>';

	}

}

if ( ! function_exists( 'voodookit_navigation' ) ) {

	function voodookit_navigation() {

		wp_nav_menu(
			[
				'container' => 'nav',
				'container_class' => 'column small-9 show-for-large',
				'menu_class' => 'navigation menu align-right',
				'theme_location' => 'primary'
			]
		);

	}

}

if ( ! function_exists( 'voodookit_navigation_mobile' ) ) {

	function voodookit_navigation_mobile() {

		wp_nav_menu(
			[
				'container' => 'nav',
				'container_class' => '',
				'menu_class' => 'navigation menu',
				'theme_location' => 'primary'
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
					</div>
				</div>
			</div>';
	}

}
