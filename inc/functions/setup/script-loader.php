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

if ( ! function_exists( 'voodookit_load_css' ) ) {

	function voodookit_load_css() {

		if ( ! is_admin() ) {

			$files = array(

				array(
					'handle' => 'styles',
					'src'    => get_theme_file_uri('/dist/assets/css/app.min.css'),
					'deps'   => array(),
					'ver' => last_file_modification( get_theme_file_uri('/dist/assets/css/app.min.css') )
				)

			);

			foreach ( $files as $file ) {

				wp_register_style( $file['handle'], $file['src'], $file['deps'] );
				wp_enqueue_style( $file['handle'] );

			}

		}

	}

}

add_action( 'wp_enqueue_scripts', 'voodookit_load_css' );


/**
 * Loads extra Gutenberg css in Wordpress backend
 */

if ( ! function_exists( 'voodookit_gutenberg_styles' ) ) {

	function voodookit_gutenberg_styles() {

		$file = [
			'handle' => 'gutenberg-css',
			'src'    => get_theme_file_uri('/dist/assets/css/gutenberg.min.css'),
			'deps'   => false,
			'ver' => last_file_modification( get_theme_file_uri('/dist/assets/css/gutenberg.min.css') )
		];

		wp_register_style( $file['handle'], $file['src'], $file['deps'] );
		wp_enqueue_style( $file['handle'] );

	}

}

add_action( 'enqueue_block_editor_assets', 'voodookit_gutenberg_styles' );


/**
 * Load Javascript files
 *
 * @since 1.0.0
 */

if ( ! function_exists( 'voodookit_load_javascript' ) ) {

	function voodookit_load_javascript() {

		if ( ! is_admin() ) {

			wp_deregister_script( 'jquery' );

			$files = array(

				array(
					'handle' => 'app',
					'src'    => get_theme_file_uri('/dist/assets/js/app.min.js'),
					'deps'   => array(),
					'ver' => last_file_modification( get_theme_file_uri('/dist/assets/js/app.min.js') )

				)

			);

			foreach ( $files as $file ) {

				wp_register_script( $file['handle'], $file['src'], $file['deps'] );
				wp_enqueue_script( $file['handle'] );

			}

		}

	}

}

add_action( 'wp_footer', 'voodookit_load_javascript' );
