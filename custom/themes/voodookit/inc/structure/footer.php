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

				<div class="column small-12 medium-6">
					<?php do_action( 'voodookit_do_footer_nav' ); ?>
				</div>

				<div class="column small-12 medium-6">
					<?php do_action( 'voodookit_do_social' ); ?>
				</div>

				<div class="column small-12 medium-12">
					<?php do_action('voodookit_do_copyright'); ?>
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

/**
 * Renders footer navigation with wp_nav_menu();
 */

if ( ! function_exists( 'voodookit_footer_nav' ) ) {

	function voodookit_footer_nav() {

		wp_nav_menu([
			'container' => 'nav',
			'container_class' => 'navigation footer-nav',
			'menu' => 'footer-nav'
		]);

	}

}

/**
 * Render template copyright
 */

if (! function_exists('voodookit_copyright') ) {

	function voodookit_copyright() {

		?>
		<div class="footer-copyright text-center">
			<p><?php _e('This template was made with Wordpress, Voodookit and love by'); ?> <a href="//dominicvogl.de" target="_blank"><?php _e('Author', 'voodookit'); ?></a></p>
		</div>
		<?php

	}

}
