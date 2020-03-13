<?php
/**
 * This is Voodookit
 *
 * @package Voodookit
 * @since 1.0.0
 */


/**
 * Check if file exists in child theme, if yes, use this
 */

if (!function_exists('voodookit_load_template_file')) {

	function voodookit_load_template_file($path)
	{

		$parent_dir = get_template_directory();
		$child_dir = get_stylesheet_directory();

		if (file_exists($parent_dir . $path) || file_exists($child_dir . $path)) {

			if (file_exists($parent_dir . $path)) {
				require_once($parent_dir . $path);
			}

			if (file_exists($child_dir . $path)) {
				require_once($child_dir . $path);
			}

		} else {
			error_log('Template Part "' . $path . '" could not be loaded');
		}

	}

}

// Autoload Template Settings
voodookit_load_template_file('/inc/init-voodookit.php');
