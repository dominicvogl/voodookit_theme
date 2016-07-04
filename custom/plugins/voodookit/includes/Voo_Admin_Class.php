<?php

$Voo_Admin = new Voo_Admin();

class Voo_Admin
{

	public function __construct()
	{

		// Add Filters
		add_filter('upload_mimes', array($this, 'cc_mime_types'));

		// Add Actions
		add_action('wp_before_admin_bar_render', array($this, 'adjust_admin_bar'));

		/* Die XMLRPC-Schnittstelle komplett abschalten */
		add_filter('xmlrpc_enabled', '__return_false');

		/* Den HTTP-Header vom XMLRPC-Eintrag bereinigen */
		add_filter('wp_headers', array($this, 'remove_x_pingback'));

		// Register Navigations
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

	public function remove_x_pingback($headers)
	{
		unset($headers['X-Pingback']);
		return $headers;
	}

	/**
	 * Admin Bar im Backend anpassen
	 */

	public function adjust_admin_bar()
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
		//$wp_admin_bar->remove_menu('comments');
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

	public function cc_mime_types($mimes)
	{
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}

}