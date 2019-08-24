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

if ( ! function_exists( 'voodookit_footer_logo' ) ) {

	function voodookit_footer_logo() {

		if( ! get_theme_mod( 'evolution_footer_logo' )) {
			return;
		}

		$logo_src = esc_url( get_theme_mod( 'evolution_footer_logo' ) );
		list ( $logo_size ) = getimagesize( $logo_src );

		echo
			'<div class="column small-12 large-6">
				<div class="logo">
					<a href="'.get_home_url().'" target="_self">
						<img src="' . $logo_src . '" width="'.$logo_size[0].'" height="'.$logo_size[1].'" />
					</a>
				</div>
			</div>';

	}

}
