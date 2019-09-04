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

			// register a post newsfeed
			$postfeedcarousel = [
				'name'            => 'postfeedcarousel',
				'title'           => __( 'Post Feed Carousel' ),
				'description'     => __( 'Post Feed as Cards in Carousel' ),
				'render_callback' => 'acf_block_render_callback',
				'category'        => 'common',
				'icon'            => 'schedule',
				'keywords'        => [ 'carousel', 'feed', 'news', 'posts' ],
			];

			// register a post newsfeed
			$featuredcontents = [
				'name'            => 'featuredcontents',
				'title'           => __( 'Featured Text or Numbers' ),
				'description'     => __( 'Feature some contents in the Frontend' ),
				'render_callback' => 'acf_block_render_callback',
				'category'        => 'common',
				'icon'            => 'lightbulb',
				'keywords'        => [ 'content', 'feature' ],
			];

			// register a post newsfeed
			$voodookit_acf_block_intro_with_image = [
				'name'            => 'introwithimage',
				'title'           => __( 'Intro Header with CTA' ),
				'description'     => __( 'Intro Header with Images, Content and CTA' ),
				'render_callback' => 'acf_block_render_callback',
				'category'        => 'common',
				'icon'            => 'carrot',
				'keywords'        => [ 'intro', 'feature', 'cta', 'content' ],
			];

			// register a post newsfeed
			$voodookit_acf_block_image_and_content = [
				'name'            => 'imageandcontent',
				'title'           => __( 'Image with Content' ),
				'description'     => __( 'Block Element with Images and Contents together' ),
				'render_callback' => 'acf_block_render_callback',
				'category'        => 'common',
				'icon'            => 'gallery',
				'keywords'        => [ 'intro', 'feature', 'cta', 'content' ],
			];


			return [
				$carousel,
				$postfeed,
				$postfeedcarousel,
				$featuredcontents,
				$voodookit_acf_block_intro_with_image
			];
		}
	}

}
