<?php
/**
 * This is Voodookit!
 *
 * @package Voodookit
 * @since 1.0.0
 */


if ( ! function_exists( 'voodookit_social' ) ) {

	function voodookit_social() {
		?>

		<div class="column small-12 large-6">
			<ul class="social-links">
				<li><a href="#">FB</a></li>
				<li><a href="#">IG</a></li>
				<li><a href="#">PI</a></li>
				<li><a href="#">WA</a></li>
				<li><a href="#">TE</a></li>
			</ul>
		</div>

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
			'container_class' => 'column small-12 large-6 navigation footer-nav',
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
		<div class="column small-12">
			<div class="footer-copyright text-center">
				<p><?php _e('This framework was made with Wordpress, Voodookit and love by'); ?> <a href="//dominicvogl.de" target="_blank"><?php _e('Author', 'voodookit'); ?></a></p>
			</div>
		</div>
		<?php

	}

}


if(! function_exists('voodookit_footer_logo') ) {

	/**
	 * Wrap the logo for the footer in the default grid
	 */

	function voodookit_footer_logo() {

		echo '<div class="column small-12.large-6">';
		do_action('voodookit_do_logo');
		echo '</div>';

	}

}
