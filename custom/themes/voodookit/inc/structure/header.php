<?php
/**
 * This is Voodookit!
 *
 * @since 1.0.0
 */


if ( ! function_exists( 'voodookit_do_before_header' ) ) {

	function voodookit_do_before_header() {
		echo '<header class="row align-bottom	">';
	}

}

if ( ! function_exists( 'voodookit_do_after_header' ) ) {

	function voodookit_do_after_header() {
		echo '</header>';
	}

}

if ( ! function_exists( 'voodookit_logo' ) ) {

	function voodookit_logo() {

		if( ! get_theme_mod( 'evolution_logo' )) {
			return;
		}

		$logo_src = esc_url( get_theme_mod( 'evolution_logo' ) );
		list ( $logo_size ) = getimagesize( $logo_src );

		echo '<div class="column small-3">';
		echo '<div class="logo">';
		echo '<img src="' . $logo_src . '" width="'.$logo_size[0].'" height="'.$logo_size[1].'" />';
		echo '</div>';
		echo '</div>';

	}

}

if ( ! function_exists( 'voodookit_navigation' ) ) {

	function voodookit_navigation() {

		wp_nav_menu( array(
				'container' => 'nav',
				'container_class' => 'column small-9',
				'menu_class' => 'navigation menu',
				'theme_location' => 'primary'
			)
		);

	}

}
