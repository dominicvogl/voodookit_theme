<?php

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

		add_theme_support( 'title-tag' );

		// Add Support for Custom Backgrounds
		add_theme_support( 'custom-background' );

		// activate support for images in posts
		add_theme_support( 'post-thumbnails' );

		// add more image sizes for template
		add_image_size( 'voodookit-gallery', 1120, 450 );

		// register and use wp_nav_menu() for navigation
		register_nav_menus(array(
			'primary' => esc_html__('Main Navigation', 'voodookit'),
			'footer' => esc_attr__('Footer Navigation', 'voodookit')
		));

	}

}

