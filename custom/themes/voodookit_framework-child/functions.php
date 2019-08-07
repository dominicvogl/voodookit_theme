<?php

// silence

add_action( 'voodookit_do_main', 'voodookit_do_main_loop', 10 );

if(! function_exists('voodookit_do_main_loop')) {

	function voodookit_do_main_loop() {

		if(have_posts()) {

			while(have_posts()) {
				the_post();
				the_title();
				echo "<h1>Das sucked hart!</h1>";
				the_content();
			}

		}

	}

}
