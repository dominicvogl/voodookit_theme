<?php

/*
Plugin Name: Custom Admin Settings
Description: Set some Admin Settings or change some things
Author: Dominic Vogl
Version: 1.0
Author URI: http://www.cat.ia.de
*/

/**
 * Add Filters
 */

// Update mime types
add_filter('upload_mimes', 'cc_mime_types');

// add debug informations in footer for super admin
add_filter( 'admin_footer_text', 'ds_footer_debug_infos' );

/* Die XMLRPC-Schnittstelle komplett abschalten */
add_filter('xmlrpc_enabled', '__return_false');

/* Den HTTP-Header vom XMLRPC-Eintrag bereinigen */
add_filter('wp_headers', 'remove_x_pingback');

/**
 * Add Actions
 */

// update backend admin bar and remove some crap
add_action('wp_before_admin_bar_render', 'adjust_admin_bar');


/**
 * Registrations
 */

// Register Navigationsmenus in Backend
add_action('init', 'register_navigations');

// Register Navigations
function register_navigations() {

	register_nav_menus(array(
		'main-nav' => 'Hauptnavigation',
		'sub-nav' => 'Unternavigation'
	));

}

/**
 * Remove XMLRPC Pingback
 * @param $headers
 * @return mixed
 */

function remove_x_pingback($headers)
{
	unset($headers['X-Pingback']);
	return $headers;
}

/**
 * Admin Bar im Backend anpassen
 */

function adjust_admin_bar()
{
	/* Global */
	global $wp_admin_bar;

	/* Aktiv und Admin? */
	if (!is_admin_bar_showing() or !is_admin()) {
		return;
	}

	/* Einträge löschen */
	// $wp_admin_bar->remove_menu('view');
	//$wp_admin_bar->remove_menu('updates');
	$wp_admin_bar->remove_menu('wp-logo');
	$wp_admin_bar->remove_menu('comments');
	// $wp_admin_bar->remove_menu('appearance');
	// $wp_admin_bar->remove_menu('view-site');
	// $wp_admin_bar->remove_menu('new-content');
	// $wp_admin_bar->remove_menu('my-account');

	/* Suche definieren */
	$form = '<form action="' . esc_url(admin_url('edit.php')) . '" method="get" id="adminbarsearch">';
	$form .= '<input class="adminbar-input" name="s" tabindex="1" type="text" value="" maxlength="50" />';
	$form .= '<input type="submit" class="adminbar-button" value="' . __('Search') . '"/>';
	$form .= '</form>';

	/* Suche einbinden */
	$wp_admin_bar->add_menu(
		array(
			'parent' => 'top-secondary',
			'id' => 'search',
			'title' => $form,
			'meta' => array(
				'class' => 'admin-bar-search'
			)
		)
	);
}

function cc_mime_types($mimes)
{
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}


function ds_footer_debug_infos( $text )
{
	if ( ! is_super_admin() )
		return $text;

	$text  = 'Time : ' . timer_stop( 0 ) . ' | ';
	$text .= 'DB Queries: ' . $GLOBALS['wpdb']->num_queries . ' | ';
	$text .= 'Memory: ' . number_format( ( memory_get_peak_usage()/1024/1024 ), 1, ',', '' ) . '/' . ini_get( 'memory_limit' ) . ' | ';

	$ch = empty( $GLOBALS['wp_object_cache']->cache_hits ) ? 0 : $GLOBALS['wp_object_cache']->cache_hits;
	$cm = empty( $GLOBALS['wp_object_cache']->cache_misses ) ? 0 : $GLOBALS['wp_object_cache']->cache_misses;
	$text .= 'Cache Hits: ' . $ch . ' | Cache Misses: ' . $cm . ' | ';

	$ap = count( get_option('active_plugins') );
	$text .= 'Active Plugins: ' . $ap;


	return $text;
}