<?php
/**
 * This is Voodookit
 *
 * @package Voodookit
 */

if(class_exists('ACF')) {

	add_filter('acf/settings/save_json', 'my_acf_json_save_point');

	function my_acf_json_save_point() {

		// update path
		$path = VOODOOKIT_ACF_DIR . '/json';

		if ( ! file_exists( $path ) ) {
			if ( ! mkdir( $path, 0755, true ) && ! is_dir( $path ) ) {
				throw new \RuntimeException( sprintf( 'Directory "%s" was not created', $path ) );
			}
		}

		// return
		return $path;

	}

	add_filter('acf/settings/load_json', 'my_acf_json_load_point');

	function my_acf_json_load_point( $paths ) {

		// remove original path (optional)
		unset($paths[0]);

		// append path
		$paths[] = VOODOOKIT_ACF_DIR . '/json';

		// return
		return $paths;

	}

}
