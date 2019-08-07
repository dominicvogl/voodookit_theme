<?php

/*
Plugin Name: ACF PRO - Setup Theme Options
Description: Setup Theme Option Pages and Fields
Author: Dominic Vogl
Version: 0.1
Author URI: http://www.dominicvogl.de
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if (! function_exists( 'add_acf_option_pages' ) ) {

	function add_acf_option_pages() {

		if ( function_exists( 'acf_add_options_page' ) ) {

			acf_add_options_page( array(
				'page_title' => 'Theme General Settings',
				'menu_title' => 'Theme Settings',
				'menu_slug'  => 'theme-general-settings',
				'capability' => 'edit_posts',
				'redirect'   => false
			) );

			if ( function_exists( 'acf_add_options_sub_page' ) ) {

				acf_add_options_sub_page( array(
					'page_title'  => 'Theme Header Settings',
					'menu_title'  => 'Header',
					'parent_slug' => 'theme-general-settings',
				) );

				acf_add_options_sub_page( array(
					'page_title'  => 'Theme Footer Settings',
					'menu_title'  => 'Footer',
					'parent_slug' => 'theme-general-settings',
				) );

			}
		}
	}

}

add_action( 'admin_menu', 'add_acf_option_pages' );
