<?php
/**
 * The Voodookit Framework
 * Loading all scripts and external files
 *
 * @package Voodookit
 */

/**
 * move javascript files the save way to the footer
 */

if( ! function_exists('voodookit_footer_enqueue_scripts') ) {

	function voodookit_footer_enqueue_scripts() {
		remove_action('wp_head', 'wp_print_scripts');
		remove_action('wp_head', 'wp_print_head_scripts', 9);
		remove_action('wp_head', 'wp_enqueue_scripts', 1);
		add_action('wp_footer', 'wp_print_scripts', 5);
		add_action('wp_footer', 'wp_enqueue_scripts', 5);
		add_action('wp_footer', 'wp_print_head_scripts', 5);
	}

}

add_action('wp_enqueue_scripts', 'voodookit_footer_enqueue_scripts');


/**
 * remove version query tag at the end of js and css files when they are embedded
 */

if( ! function_exists('voodookit_remove_wp_ver_css_js') ) {

	function voodookit_remove_wp_ver_css_js( $src ) {
		if ( strpos( $src, 'ver=' ) ) {
			$src = remove_query_arg( 'ver', $src );
		}

		return $src;
	}

}

//add_filter( 'style_loader_src', 'voodookit_remove_wp_ver_css_js', 9999 );
//add_filter( 'script_loader_src', 'voodookit_remove_wp_ver_css_js', 9999 );

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
					'src'    => get_asset('app.css')['path'],
					'deps'   => array(),
					'ver' => get_asset('app.css')['version']
				)

			);

			foreach ( $files as $file ) {

				wp_register_style( $file['handle'], $file['src'], $file['deps'], $file['ver'] );
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
			'src'    => get_asset('gutenberg.css')['path'],
			'deps'   => false,
			'ver' => get_asset('gutenberg.css')['version']
		];

		wp_register_style( $file['handle'], $file['src'], $file['deps'], $file['ver'] );
		wp_enqueue_style( $file['handle'] );

	}

}

add_action( 'enqueue_block_editor_assets', 'voodookit_gutenberg_styles' );


/**
 * Load Javascript files
 *
 * @since 1.0.0
 * @version 2.0.0
 */

if ( ! function_exists( 'voodookit_load_javascript' ) ) {

	function voodookit_load_javascript() {

		if ( ! is_admin() ) {

			wp_deregister_script( 'jquery' );
			
			$files = array(

				array(
					'handle' => 'app',
					'src'    => get_asset('app.js')['path'],
					'deps'   => array(),
					'ver' => get_asset('app.js')['version']
				)

			);

			foreach ( $files as $file ) {

				wp_register_script( $file['handle'], $file['src'], $file['deps'], $file['ver'], true );
				wp_enqueue_script( $file['handle'] );

			}

		}

	}

}

add_action( 'wp_footer', 'voodookit_load_javascript' );
