<?php

/*
Plugin Name: Voodookit Functions
Description: Add basic Functionality for Administration Area
Author: Dominic Vogl
Version: 1.1.0
Author URI: http://www.dominicvogl.de
*/

// If this file is called directly, abort.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

// List all file to import
$files = array(
   'Voo_Admin_Class',
   'Voo_Frontend_Template_Class',
   'Voo_Helper_Class',
   'Voo_Images_Class',
   'Voo_Loops_Class',
   'Voo_Media.Class',
   'Voo_Post_Helper_Class',
   'Voo_Shortcodes_Class'
);

/**
 * Include Files for template functions
 * @param $files
 * @return bool
 */

function include_files($files)
{

	if (is_array($files))
		return false;

	foreach ($files as $filename) {
		include(plugin_dir_path( __FILE__ ) . 'includes/' . $filename . '.php');
	}

	return true;

}