<?php

/*
Plugin Name: Hello World!
Description: This is just a test.
Author: Jérémy Heleine
Version: 1.0
Author URI: http://jeremyheleine.me
*/

// If this file is called directly, abort.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

// List all file to import
$files = array(
   'helpers',
   'admin',
   'template',
   'acf-blocks',
   'images',
   'items',
   'loops'
);

if (is_array($files)) {
   foreach ($files as $filename) {
      include(plugin_dir_path( __FILE__ ) . 'includes/' . $filename . '.php');
   }
}