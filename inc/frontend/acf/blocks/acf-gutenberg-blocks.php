<?php

if ( ! function_exists( 'voodookit_register_acf_blocks' ) ) {

	function voodookit_register_acf_blocks() {

		// check function exists
		if ( function_exists( 'acf_register_block' ) ) {

			$blocks = acf_block_get_blocks();

			foreach ( $blocks as $block ) {
				acf_register_block_type( $block );
			}

		}
	}
}

add_action( 'acf/init', 'voodookit_register_acf_blocks' );


/**
 * ACF Render Callback for loading block template for backend & frontend
 *
 * @since 1.0.0
 */

if ( ! function_exists( 'acf_block_render_callback' ) ) {

	function acf_block_render_callback( $block ) {

		// convert name ("acf/XXXXX") into path friendly slug ("XXXXX")
		$slug = str_replace( 'acf/', '', $block['name'] );
		$path = "/inc/frontend/acf/blocks/{$slug}.php";

		// include a template part from within the "template-parts/block" folder
		if ( file_exists( get_theme_file_path( $path ) ) ) {
			include( get_theme_file_path( $path ) );
		}
	}

}


/**
 * Building array for the blocks to create
 *
 * @since 1.0.0
 */

if ( ! function_exists( 'acf_block_get_blocks' ) ) {

	function acf_block_get_blocks() {

		// check function exists
		if ( function_exists( 'acf_register_block' ) ) {

			$blocks = array(
				// register a carousel slider block
				[
					'name'            => 'carousel',
					'title'           => __( 'Carousel / Slider' ),
					'icon'            => 'admin-comments',
				],
				// register a post newsfeed
				[
					'name'            => 'postfeed',
					'title'           => __( 'Post Feed' ),
					'icon'            => 'schedule',
				],

				// register a post newsfeed
				[
					'name'            => 'postfeedcarousel',
					'title'           => __( 'Post Feed Carousel' ),
					'icon'            => 'schedule',
				],

				// register a post newsfeed
				[
					'name'            => 'featuredcontents',
					'title'           => __( 'Featured Text or Numbers' ),
					'icon'            => 'lightbulb',
				],

				// register a post newsfeed
				[
					'name'            => 'introwithimage',
					'title'           => __( 'Intro Header with CTA' ),
					'icon'            => 'carrot',
				],

				// register a post newsfeed
				[
					'name'            => 'imageandcontent',
					'title'           => __( 'Image with Content' ),
					'icon'            => 'gallery',
				]
			);


			return return_acf_blocks($blocks);
		}
	}

	function return_acf_blocks( $blocks ) {

		$returningBlocks = array();

		foreach($blocks as $block) {

			$returningBlocks[] = array(
				'name'            => $block['name'],
				'title'           => $block['title'],
				'description'     => $block['title'],
				'render_callback' => 'acf_block_render_callback',
				'category'        => 'common',
				'icon'            => $block['icon'],
				'keywords'        => [ 'acf', 'content'],
			);
		}

		return $returningBlocks;

	}

}
