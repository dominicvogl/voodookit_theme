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
   'helpers',
   'admin',
   'template',
   'images',
   'items',
   'loops'
);

if (is_array($files)) {
   foreach ($files as $filename) {
      include(plugin_dir_path( __FILE__ ) . 'includes/' . $filename . '.php');
   }
}