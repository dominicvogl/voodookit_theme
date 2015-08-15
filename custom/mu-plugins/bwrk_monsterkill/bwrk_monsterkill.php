<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://git.bergwerk.ag/wordpress-extensions/bwrk_monsterkill.git
 * @since             1.0.0
 * @package           BWRK Monsterkill
 *
 * @wordpress-plugin
 * Plugin Name:       BWRK Monsterkill
 * Plugin URI:        https://git.bergwerk.ag/wordpress-extensions/bwrk_monsterkill.git
 * Description:       Backend Manipulations, WP Query functions, ACF render functions
 * Version:           1.0.0
 * Author:            BERGWERK [dv]
 * Author URI:        https://www.bergwerk.ag
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       bwrk-monsterkill
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

// List all file to import
$files = array(
   'helpers',
   'admin',
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