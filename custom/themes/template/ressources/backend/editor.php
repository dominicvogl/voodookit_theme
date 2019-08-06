<?php

// Add Filters for the functions
add_filter( 'mce_buttons_2', 'voo_mce_buttons' );
add_filter( 'tiny_mce_before_init', 'voo_mce_before_init_insert_formats' );

/**
 * @param $buttons
 * bring buttonformats to menu in backend
 * @return mixed
 */

function voo_mce_buttons( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}

/**
 * @param $init_array
 * define formats for TINY MCE Editor
 * @return mixed
 */

function voo_mce_before_init_insert_formats( $init_array ) {
	$style_formats = array(
		// Button
		array(
			'title' => 'Button',
			'selector' => 'a',
			'classes' => 'button',
		),
		// Textmarkierung
		array(
			'title' => 'Textmarkierung',
			'inline' => 'mark',
		),
		// Infobox
		array(
			'title' => 'Infobox',
			'block' => 'div',
			'classes' => 'infobox',
			'wrapper' => 'true',
		),
	);
	$init_array['style_formats'] = json_encode( $style_formats );
	return $init_array;
}

