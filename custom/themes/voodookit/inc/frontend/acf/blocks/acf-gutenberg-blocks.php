<?php

if ( ! function_exists( 'voodookit_register_acf_blocks' ) ) {

	function voodookit_register_acf_blocks() {

		// check function exists
		if ( function_exists( 'acf_register_block' ) ) {

			$blocks = acf_block_get_blocks();

			foreach($blocks as $block) {
				acf_register_block_type($block);
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

			// register a carousel slider block
			$carousel = [
				'name'            => 'carousel',
				'title'           => __( 'Carousel / Slider' ),
				'description'     => __( 'A slick slider block.' ),
				'render_callback' => 'acf_block_render_callback',
				'category'        => 'common',
				'icon'            => 'admin-comments',
				'keywords'        => [ 'carousel', 'slider', 'images' ],
			];

			// register a post newsfeed
			$postfeed = [
				'name'            => 'postfeed',
				'title'           => __( 'Post Feed' ),
				'description'     => __( 'Post Feed as Cards' ),
				'render_callback' => 'acf_block_render_callback',
				'category'        => 'common',
				'icon'            => 'schedule',
				'keywords'        => [ 'carousel', 'feed', 'news', 'posts' ],
			];


			return [
				$carousel,
				$postfeed
			];
		}
	}

}
