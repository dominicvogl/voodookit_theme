<?php
/**
 * This is Voodookit!
 *
 * @package voodookit
 * @since 1.0.0
 */

if ( ! function_exists( 'voodookit_do_before_main_loop' ) ) {

	/**
	 * Render something before the main content loop
	 * @since 1.0.0
	 */

	function voodookit_do_before_main_loop() {
		echo '<main class="row column mod">';
	}

}

if ( ! function_exists( 'voodookit_do_after_main_loop' ) ) {

	/**
	 * Render something after the main content loop
	 * @since 1.0.0
	 */

	function voodookit_do_after_main_loop() {
		echo '</main>';
	}

}

if ( ! function_exists( 'voodookit_do_main_loop' ) ) {

	/**
	 * Render the main content loop
	 * @since 1.0.0
	 */

	function voodookit_do_main_loop() {

		if ( have_posts() ) {

			while ( have_posts() ) {
				the_post();

				if(!is_front_page() && !is_home()) {
					the_title('<h1>', '</h1>');
				}

				the_content();

				// the_acf_modules();
			}

		}
	}

}
