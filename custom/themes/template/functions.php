<?php

// Autoload Template Settings

function load_template_parts()
{

	// Here we load from our includes directory
	$filelist = array(
		'voodookit/helper.php',      // some helper functions
		'voodookit/frontend.php',    // load frontend stuff
		'voodookit/images.php',      // setup image sizes
		'voodookit/shortcodes.php',   // setup shortcodes

		'acf/acf-fields.php'    // load frontend stuff
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