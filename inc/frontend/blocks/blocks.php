<?php

if(! function_exists('voodookit_wrapping_core_blocks') ) {

	/**
	 * @param $block_content
	 * @param $block
	 * Extend some core gutenberg blocks with wrapping html and more classes for better styling
	 * @return string
	 * @since 1.0.0
	 */

	function voodookit_wrapping_core_blocks( $block_content, $block ) {

		$classes = [];
//		$classes = ['row', 'column'];

		// list of blocks to wrap
		$listOfBlocks = [
			'core/heading',
			'core/paragraph',
			'core/list',
			'core/html',
		];

		// check if current block is in the list
		if ( ! in_array( $block['blockName'], $listOfBlocks ) ) {
			return $block_content;
		}

		// add core blocknames as mod classes to the array
		$classes[] = 'block-' . str_replace( '/', '', strstr( $block['blockName'], '/' ) );

		// add extra class when is core/html
		if($block['blockName'] === 'core/html') {
			$classes[] = 'is-style-fixed-width-paragraph';
		}

		// transform array to string for usage in html
		$classes   = implode( ' ', $classes );

		// wrap the stuff up, then return
		return "<div class='$classes'>$block_content</div>";
	}

}

add_filter( 'render_block', 'voodookit_wrapping_core_blocks', 10, 3);
