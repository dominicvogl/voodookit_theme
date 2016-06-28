<?php

/*
Plugin Name: Simple Maintenance
Description: Activate Maintenance mode
Author: Dominic Vogl
Version: 1.0.0
Author URI: http://www.dominicvogl.de
*/

// If this file is called directly, abort.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

class maintenance {
	
	public function __construct()
	{

		add_action('get_header', array($this, 'wp_maintenance_mode'));
		
	}

	public function wp_maintenance_mode()
	{

		// Aktiviere den WordPress Maintenance Mode
		if (!current_user_can('edit_themes') || !is_user_logged_in()) {
			wp_die('<h1 style="color:red">Website im Wartungsmodus</h1><br />Wir müssen mal kurz an der Website schrauben. Bitte habe etwas Geduld, wir sind so schnell wie möglich wieder online.');
		}

	}
	
}