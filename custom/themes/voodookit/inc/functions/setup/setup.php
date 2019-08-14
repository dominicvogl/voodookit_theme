<?php
/**
 * This is Voodookit
 *
 * @package Voodookit
 * @since 1.0.0
 */

if ( ! function_exists( 'voodookit_setup' ) ) {

	function voodookit_setup() {

		// Load template translations
		load_theme_textdomain( 'voodookit', get_template_directory() . '/languages' );

		apply_filters( 'override_load_textdomain', true, 'voodookit', get_template_directory() . '/languages/de_DE.mo' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */

//		add_theme_support( 'title-tag' );

		// Add Support for Custom Backgrounds
//		add_theme_support( 'custom-background' );

		// activate support for images in posts
		add_theme_support( 'post-thumbnails' );

		// add more image sizes for template
		add_image_size( 'voodookit-slider', 1270, 1270 );

		// register and use wp_nav_menu() for navigation
		register_nav_menus( array(
			'primary' => __( 'Main Navigation', 'voodookit' ),
			'footer'  => __( 'Footer Navigation', 'voodookit' )
		) );

		add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ] );

		// add posts formats if necessary
		add_theme_support( 'post-formats', [ 'audio', 'gallery', 'video' ] );

		// This theme styles the visual editor to resemble the theme style.
		// @todo set right path for the editor later
		add_editor_style( array( 'css/normalize.css', 'style.css', 'css/editor-style.css' ) );

	}

}

add_action( 'init', 'voodookit_setup' );


/**
 * Remove XMLRPC Pingback
 *
 * @param $headers
 *
 * @return mixed
 */

if ( ! function_exists( 'remove_x_pingback' ) ) {

	function remove_x_pingback( $headers ) {
		unset( $headers['X-Pingback'] );

		return $headers;
	}

}

add_filter( 'wp_headers', 'remove_x_pingback' );


/**
 * add svg support
 *
 * @since 1.0.0
 */

if ( ! function_exists( 'voodookit_mime_types' ) ) {

	function voodookit_mime_types( $mimes ) {
		$mimes['svg'] = 'image/svg+xml';

		return $mimes;
	}
}

add_filter( 'upload_mimes', 'voodookit_mime_types' );


/**
 * Deactivate the wordpress autosave
 */

if ( ! function_exists( 'disable_autosave' ) ) {

	function disable_autosave() {
		wp_deregister_script( 'autosave' );
	}

}

add_action( 'admin_init', 'disable_autosave' );
