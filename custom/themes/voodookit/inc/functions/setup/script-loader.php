<?php
/**
 * The Voodookit Framework
 * Loading all scripts and external files
 *
 * @package Voodookit
 */

/**
 * Load CSS Files
 *
 * @since 1.0.0
 */

if ( ! function_exists( 'load_css' ) ) {

	function load_css() {

		if ( ! is_admin() ) {

			$files = array(

				array(
					'handle' => 'styles',
					'src'    => get_template_directory_uri() . '/dist/assets/css/app.min.css',
					'deps'   => array(),
				)

			);

			foreach ( $files as $file ) {

				wp_register_style( $file['handle'], $file['src'], $file['deps'] );
				wp_enqueue_style( $file['handle'] );

			}

		}

	}

}

add_action( 'wp_enqueue_scripts', 'load_css' );


/**
 * Load Javascript files
 *
 * @since 1.0.0
 */

if ( ! function_exists( 'load_javascript' ) ) {

	function load_javascript() {

		if ( ! is_admin() ) {

			wp_deregister_script( 'jquery' );

			$files = array(

				array(
					'handle' => 'app',
					'src'    => get_template_directory_uri() . '/dist/assets/js/app.min.js',
					'deps'   => array(),
				)

			);

			foreach ( $files as $file ) {

				wp_register_script( $file['handle'], $file['src'], $file['deps'] );
				wp_enqueue_script( $file['handle'] );

			}

		}

	}

}

add_action( 'wp_footer', 'load_javascript' );
