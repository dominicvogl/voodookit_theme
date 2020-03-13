<?php
/**
 * This is Voodookit!
 *
 * @package Voodookit
 * @since 1.0.0
 * @version 2.0.0
 */

if (class_exists('ACF')) {

	if (!function_exists('voodookit_json_save_point')) {

		function voodookit_json_save_point()
		{

			// update path
			$path = get_stylesheet_directory() .'/'. VOODOOKIT_ACF_DIR . '/json';

			if (!file_exists($path)) {
				if (!mkdir($path, 0755, true) && !is_dir($path)) {
					throw new \RuntimeException(sprintf('Directory "%s" was not created', $path));
				}
			}

			// return
			return $path;

		}

	}


	if (!function_exists('voodookit_json_load_point')) {

		function voodookit_json_load_point($paths)
		{

			// remove original path (optional)
			unset($paths[0]);

			// append path
			$paths[] = get_template_directory() . '/' . VOODOOKIT_ACF_DIR . '/json';
			$paths[] = get_stylesheet_directory() . '/' . VOODOOKIT_ACF_DIR . '/json';

			// return
			return $paths;

		}

	}

	// set filters
	add_filter('acf/settings/save_json', 'voodookit_json_save_point');
	add_filter('acf/settings/load_json', 'voodookit_json_load_point');

}
