<?php

// Autoload Template Settings

if ( ! function_exists( 'load_template_parts' ) ) {

	function load_template_parts() {

		$path = get_template_directory() . '/Ressources/init-voodookit.php';

		if ( file_exists( $path ) ) {
			require_once( $path );
		} else {
			error_log( 'Template Part "' . $path . '" could not be loaded' );
		}
	}

}

add_action( 'init', 'load_voodookit', 5 );