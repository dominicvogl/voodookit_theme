<?php
/**
 * This is Voodookit!
 *
 * @since 1.0.0
 */

if ( ! function_exists( 'voodookit_logo' ) ) {

	function voodookit_logo() {

		echo '<div class="logo">';
		echo 'Logo';
		echo '</div>';

	}

}

if ( ! function_exists( 'voodookit_navigation' ) ) {

	function voodookit_navigation() {

		wp_nav_menu( array(
				'container' => 'nav',
				'menu_class' => 'navigation',
				'theme_location' => 'primary'
			)
		);

	}

}
