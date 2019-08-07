<?php
/**
 * This is Voodookit!
 *
 *
 * @since 1.0.0
 */

if(!function_exists('voodookit_do_main_loop')) {

	function voodookit_do_main_loop() {

		if(have_posts()) {

			while(have_posts()) {
				the_post();
				the_title();
				the_content();
				// the_acf_modules();
			}

		}

	}

}
