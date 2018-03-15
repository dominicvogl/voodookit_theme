<?php

// Autoload Template Settings

function load_template_parts()
{

	// Here we load from our includes directory
	$filelist = array(
		'voodookit/helper.php',         // some helper functions
		'voodookit/editor.php',         // load frontend stuff
		'voodookit/frontend.php',       // load frontend stuff
		'voodookit/images.php',         // setup image sizes
		'voodookit/shortcodes.php',     // setup shortcodes
		'voodookit/tracking.php',       // setup tracking

		'acf/acf-fields.php'            // load frontend ACF stuff
	);

	foreach($filelist as $file) {

		$path = get_template_directory() .'/'. $file;

		if(file_exists($path)) {
			include($path);
		}
		else {
			error_log('Template Part "' . $file . '" could not be loaded');
		}

	}
}

add_action('init', 'load_template_parts');