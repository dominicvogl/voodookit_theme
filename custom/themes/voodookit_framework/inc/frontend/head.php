<?php
/**
 * Init all this stuff
 *
 * @package Voodookit
 */


/**
 * Load Favicons in Template
 */

if (! function_exists('add_favicons') ) {

	function add_favicons() {

		$url = get_bloginfo('template_url');

		$html = '<link rel="Shortcut Icon" type="image/x-icon" href="' . $url . '/img/favicon.ico" />';
		$html .= '<link rel="Shortcut Icon" type="image/png" href="' . $url . '/img/favicon.png" />';

		return $html;

	}
}

add_action('init', 'add_favicons');


/**
 * Cleanup header
 */

if (! function_exists('clean_headers') ) {

	function clean_headers() {
		// Remove links to the extra feeds (e.g. category feeds)
		remove_action('wp_head', 'feed_links_extra', 3);
		// Remove links to the general feeds (e.g. posts and comments)
		remove_action('wp_head', 'feed_links', 2);
		// Remove link to the RSD service endpoint, EditURI link
		remove_action('wp_head', 'rsd_link');
		// Remove link to the Windows Live Writer manifest file
		remove_action('wp_head', 'wlwmanifest_link');
		// Remove index link
		remove_action('wp_head', 'index_rel_link');
		// Remove prev link
		remove_action('wp_head', 'parent_post_rel_link');
		// Remove start link
		remove_action('wp_head', 'start_post_rel_link');
		// Display relational links for adjacent posts
		remove_action('wp_head', 'adjacent_posts_rel_link');
		// Remove XHTML generator showing WP version
		remove_action('wp_head', 'wp_generator');
	}

}

// add_action('wp_head', array($this, 'add_favicons'));
add_action('init', 'clean_headers');