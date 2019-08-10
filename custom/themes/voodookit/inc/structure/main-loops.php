<?php
/**
 * This is Voodookit!
 *
 *
 * @since 1.0.0
 */

if ( ! function_exists( 'voodookit_do_before_main_loop' ) ) {

	function voodookit_do_before_main_loop() {

		$class = 'voodookit row column';

		echo '<main class="'. $class .'">';

	}

}

if ( ! function_exists( 'voodookit_do_after_main_loop' ) ) {

	function voodookit_do_after_main_loop() {

		echo '</main>';

	}

}

if ( ! function_exists( 'voodookit_do_main_loop' ) ) {

	function voodookit_do_main_loop() {

		if ( have_posts() ) {

			while ( have_posts() ) {
				the_post();
				the_title();
				the_content();
				// the_acf_modules();

//				do_action('voodookit_do_acf');
			}

		}

		?>
		<div class="slick-slider">
			<div>wacken</div>
			<div>ist</div>
			<div>total</div>
			<div>geil</div>
		</div>
		<?php

	}

}
