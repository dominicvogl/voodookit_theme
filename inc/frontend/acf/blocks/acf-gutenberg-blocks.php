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

if ( ! function_exists( 'acf_block_render_callback' ) && class_exists('ACF')) {

	function acf_block_render_callback( $block ) {

		// convert name ("acf/XXXXX") into path friendly slug ("XXXXX")
		$slug = str_replace( 'acf/', '', $block['name'] );
		$path = "/inc/frontend/acf/blocks/$slug.php";

		// check if current should only be shown to editors
		if( is_for_editor_only() ) {
			// include a template part from within the "template-parts/block" folder
			if ( file_exists( get_theme_file_path( $path ) ) ) {
				include( get_theme_file_path( $path ) );
			}
			else {
				throw new Exception(__('Cannot find / load a file with name ', 'voodookit') . $block['name']);
			}
		}
	}

}



if ( ! function_exists( 'acf_block_get_blocks' ) ) {

	/**
	 * Building array for the blocks to create
	 * @return array
	 * @since 1.0.0
	 */

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
					'name'            => 'callout',
					'title'           => __( 'Callout' ),
					'icon'            => 'lightbulb',
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
				],

				// register isotope Gallery
				[
					'name'            => 'downloadcenter',
					'title'           => __( 'PDF Download Center' ),
					'icon'            => 'download',
				],

				// register isotope Gallery
				[
					'name'            => 'coverimagewithtext',
					'title'           => __( 'Full width Image with Text' ),
					'icon'            => 'gallery',
				],

				// register two teaser
				[
					'name'            => 'twoteaser',
					'title'           => __( 'Two column Content' ),
					'icon'            => 'tickets-alt',
				],

				// register Image Page Teaser Carousel
				[
					'name'            => 'imagepagecarousel',
					'title'           => __( 'Image Page Carousel' ),
					'icon'            => 'images-alt',
				],

				// register Accordion element
				[
					'name'            => 'accordion',
					'title'           => __( 'Accordion' ),
					'icon'            => 'editor-ul',
				],
				
				// register google maps javascript api for gutenberg blocks
				[
					'name'            => 'google_maps',
					'title'           => __( 'Google Maps' ),
					'icon'            => 'google',
				],

				// register small teaser blocks
				[
					'name'            => 'smallteasers',
					'title'           => __( 'Small Teaser' ),
					'icon'            => 'images-alt',
				],

				// register table of cotents element
				[
					'name'            => 'tableofcontents',
					'title'           => __( 'Table of Contents' ),
					'icon'            => 'editor-ul',
				],

				// register custom image gallery with swipebox and lazyload
				[
					'name'            => 'imagegallery',
					'title'           => __( 'Image Gallery with Lazyload' ),
					'icon'            => 'gallery',
				]
			);


			return return_acf_blocks($blocks);
		}

		return array();
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

	if (!function_exists('acf_google_map_api_key') && class_exists('ACF')) {

		/**
		 * register API key for Google Maps ACF Block usage
		 * @since 1.0
		 */

		function acf_google_map_api_key()
		{

			$api_key = get_field('google_maps_api_key', 'option');

			if (empty($api_key)) {
				return;
			}

			acf_update_setting('google_api_key', $api_key);
		}

		add_action('acf/init', 'acf_google_map_api_key');

	}

}

