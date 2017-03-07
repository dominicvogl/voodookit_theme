<?php

// Autoload Template Settings

function load_template_parts()
{
	// Here we load from our includes directory

	// Load Frontend stuff

	$filelist = array(
		'voodookit/admin.php',
		'voodookit/frontend.php'
	);

	locate_template( $filelist, true, true );
}

add_action('init', 'load_template_parts');