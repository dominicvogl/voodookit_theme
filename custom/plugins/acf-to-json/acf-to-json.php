<?php

/*
Plugin Name: ACF To JSON (PRO)
Description: Write ACF Group Setups to JSON Files
Author: Dominic Vogl
Version: 1.0.2
Author URI: http://www.dominicvogl.de
*/

// If this file is called directly, abort.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if( ! class_exists('ACF_To_JSON')):

class ACF_To_JSON {

	public function __construct() {

		// add ACF JSON save point
		add_filter( 'acf/settings/save_json', array( $this, 'my_acf_json_save_point' ) );

		// add ACF JSON load point
		add_filter( 'acf/settings/load_json', array( $this, 'my_acf_json_load_point' ) );

	}

	public function my_acf_json_save_point( $path ) {

		// update path
		$path = get_template_directory() . '/acf/json';

		if ( ! file_exists( $path ) ) {
			mkdir( $path, 0777, true );
		}

		// return
		return $path;

	}

	public function my_acf_json_load_point( $paths ) {

		// remove original path (optional)
		unset( $paths[0] );

		// append path
		$paths[] = get_template_directory() . '/acf/json';

		// return
		return $paths;

	}
}

function ACF_To_JSON() {

	global $ACF_Options;

	if( !isset($ACF_Options) ) {

		$ACF_Options = new ACF_To_JSON();
	}

	return $ACF_Options;

}

// Initialize
ACF_To_JSON();


endif; // class exists check