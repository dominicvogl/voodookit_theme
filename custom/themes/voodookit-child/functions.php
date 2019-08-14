<?php
/**
 * This is a Voodookit child
 *
  * @since 1.0.0
 */

if(! function_exists('waht')) {
	function waht() {
		echo "<h1>Das ist noch total hässlich</h1>";
	}
}

//add_action( 'voodookit_do_main', 'waht', 9 );


if (! function_exists('voodookit_new_navigation')) {

	function voodookit_new_navigation() {

		remove_action( 'voodookit_do_header', 'voodookit_navigation', 10);
//		add_action( 'voodookit_do_header', 'voodookit_new_navigation', 10);

		wp_nav_menu( array(
				'container' => 'nav',
				'menu_class' => 'fucking-navigation menu',
				'theme_location' => 'primary'
			)
		);

	}

}


if(! function_exists('remove_voodookit_social') ) {

	function remove_voodookit_social() {
		remove_action( 'voodookit_do_social', 'voodookit_social');
	}

}

// add_action( 'init', 'remove_voodookit_social');


if (! function_exists('voodookit_new_stuff')) {

	function voodookit_new_stuff() {
		echo '<h1>This is awesome shit, you cannot stop!°</h1>';
	}

}

//add_action( 'voodookit_do_before_main', 'voodookit_new_stuff', 15);
