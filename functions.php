<?php
/**
 * This is Voodookit
 *
 * @package Voodookit
 * @since 1.0.0
 */


// Autoload Template Settings
$path = get_template_directory() . '/inc/init-voodookit.php';

if ( file_exists( $path ) ) {
	require_once( $path );
} else {
	error_log( 'Template Part "' . $path . '" could not be loaded' );
}
