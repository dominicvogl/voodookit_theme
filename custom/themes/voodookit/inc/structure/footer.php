<?php
/**
 * This is Voodookit!
 *
 * @package Voodookit
 * @since 1.0.0
 */

if ( ! function_exists( 'voodookit_footer' ) ) {

	function voodookit_footer() {

		?>
		<footer class="row column">
			<div class="row">

				<div class="column medium-6">
					<?php do_action( 'voodookit_do_footer_nav' ); ?>
				</div>

				<div class="column medium-6">
					<?php do_action( 'voodookit_do_social' ); ?>
				</div>

			</div>
		</footer>
		<?php

	}

}

if ( ! function_exists( 'voodookit_social' ) ) {

	function voodookit_social() {

		?>
		<ul class="social-links">
			<li>FB</li>
			<li>IG</li>
			<li>PI</li>
			<li>WA</li>
			<li>TE</li>
		</ul>
		<?php

	}

}


if ( ! function_exists( 'voodookit_footer_nav' ) ) {

	function voodookit_footer_nav() {

		wp_nav_menu([
			'container' => 'nav',
			'container_class' => 'navigation footer-nav',
			'menu' => 'footer-nav'
		]);

	}

}
