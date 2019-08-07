<?php
/**
 * @package Voodookit
 *
 * @since 1.0.0
 */

if ( ! function_exists('the_acf_modules') ) {

	function the_acf_modules() {

		global $post;
		$path_modules  = get_template_directory() . '/acf/modules/';
		$path_partials = get_template_directory() . '/acf/partials/';

		if ( ! class_exists( 'acf' ) ) {
			return;
		}

		$acf_modules = get_field( 'modules', $post->ID );
		var_dump( $acf_modules );

		if ( ! is_array( $acf_modules ) ) {
			return;
		}

		foreach ( $acf_modules as $module ) {

			// Import template part
			$path_current = $path_modules . $module['acf_fc_layout'] . '.php';

			if ( file_exists( $path_current ) ) {
				include( $path_current );
			} else {
				echo ( 'Could not find acf template module "' . $module['acf_fc_layout'] . '"' );
			}


		}

	}

}
