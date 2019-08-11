<?php

if ( ! function_exists( 'voodookit_register_acf_blocks' ) ) {
	function voodookit_register_acf_blocks() {

		// check function exists
		if ( function_exists( 'acf_register_block' ) ) {

			// register a testimonial block
			acf_register_block( array(
				'name'            => 'carousel',
				'title'           => __( 'Carousel / Slider' ),
				'description'     => __( 'A slick slider block.' ),
				'render_callback' => 'acf_carousel_render_callback',
				'category'        => 'formatting',
				'icon'            => 'admin-comments',
				'keywords'        => array( 'carousel', 'slider', 'images' ),
			) );
		}
	}
}

add_action( 'acf/init', 'voodookit_register_acf_blocks' );


function acf_carousel_render_callback( $block ) {

	// convert name ("acf/testimonial") into path friendly slug ("testimonial")
	$slug = str_replace( 'acf/', '', $block['name'] );
	$path = "/inc/frontend/acf/blocks/{$slug}.php";

	// include a template part from within the "template-parts/block" folder
	if ( file_exists( get_theme_file_path( $path ) ) ) {
		include( get_theme_file_path( $path ) );
	}
}
