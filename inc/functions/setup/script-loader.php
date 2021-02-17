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

if(!function_exists('voodookit_deregister_styles')) {


	function voodookit_deregister_styles() {

		wp_deregister_style('wpdreams-ajaxsearchlite');
	}

	add_action( 'wp_enqueue_scripts', 'voodookit_deregister_styles', 100 );
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
					'src'    => get_theme_file_uri('/public/css/app.css'),
					'deps'   => array(),
					'ver' => get_asset('/public/css/app.css')['version']
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
			'src'    => get_theme_file_uri('/public/css/gutenberg.css'),
			'deps'   => false,
			'ver' => get_asset('/public/css/gutenberg.css')['version']
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

		// get current post ID
		$post = get_post(get_the_ID());

		if ( ! is_admin() ) {

			$files = array(

				array(
					'handle' => 'app',
					'src'    => get_theme_file_uri('/public/js/scripts.js'),
					'deps'   => array(),
					'ver' => get_asset('/public/js/scripts.js')['version']
				)
				
			);

			// load javascript api if google maps gutenberg block is used
			if ( has_blocks( $post->post_content ) ) {
				$blocks = parse_blocks( $post->post_content );

//				varD( array_column($blocks, 'blockName') );

				if ( array_search('acf/google-maps', array_column($blocks, 'blockName')) >= 1 ) {
					$files[] = array(
						'handle' => 'googlemaps',
						'src'    => 'https://maps.googleapis.com/maps/api/js?key=' . get_field('google_maps_api_key', 'option'),
						'deps'   => array(),
						'ver' 	=> '1.0'
					);
				}
			}

			foreach ( $files as $file ) {

				wp_register_script( $file['handle'], $file['src'], $file['deps'], $file['ver'], true );
				wp_enqueue_script( $file['handle'] );

			}

		}
	}

}

add_action( 'wp_footer', 'voodookit_load_javascript' );
