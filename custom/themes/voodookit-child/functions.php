<?php

// silence


if(! function_exists('waht')) {

	function waht() {

		echo "<h1>Das ist noch total hässlich</h1>";

	}

}

add_action( 'voodookit_do_main', 'waht', 9 );


if (! function_exists('new_navigation')) {

	function voodookit_navigation() {

		remove_action( 'voodookit_do_header', 'voodookit_navigation', 10);
		add_action( 'voodookit_do_header', 'voodookit_navigation', 10);

		wp_nav_menu( array(
				'container' => 'nav',
				'menu_class' => 'fucking-navigation menu',
				'theme_location' => 'primary'
			)
		);

	}

}
