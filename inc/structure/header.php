<?php
/**
 * This is Voodookit!
 *
 * @since 1.0.0
 * @package Voodookit
 */


if ( ! function_exists( 'voodookit_header' ) ) {

	function voodookit_header() {

		echo '<header class="page-header main-header">';
		echo '<div class="row align-middle">';

		echo '<div class="column small-9 medium-3">';
		do_action('voodookit_do_logo');
		echo '</div>';
		echo '<div class="column small-3 hide-for-medium">';
		do_action('voodookit_do_slideout_toggler');
		echo '</div>';
		do_action('voodookit_do_navigation');

		echo '</div>';
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

		echo
			'<div class="logo">
				<a href="'.get_home_url().'" target="_self">
					' . wp_get_attachment_image( attachment_url_to_postid($logo_src), 'full' ) . '
				</a>
			</div>';

	}

}

if ( ! function_exists( 'voodookit_navigation' ) ) {

	function voodookit_navigation() {

		?>
		<nav role="navigation" class="column small-9 medium-9 show-for-medium">
			<ul class="menu desktop horizontal">

			<?php
			wp_nav_menu(
				[
					'container' => '',
					'items_wrap' => '%3$s',
					'theme_location' => 'primary'
				]
			);
			?>
			</ul>
		</nav>
		<?php

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
				'theme_location' => 'copyright'
			]
		);

		?>
		<?php

	}

}

if ( ! function_exists('voodookit_slideout_toggler') ) {

	function voodookit_slideout_toggler() {

		echo
			'<div class="toggler-wrapper js-toggle-slideout">
				<div class="toggle-button">
					<div class="button-bars">
						<span class="bar"></span>
						<span class="bar"></span>
						<span class="bar"></span>
					</div>
				</div>
			</div>';
	}

}
