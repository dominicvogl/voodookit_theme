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
			'core/buttons',
			'core/quote',
			'contact-form-7/contact-form-selector'
		];

		// check if current block is in the list
		if ( ! in_array( $block['blockName'], $listOfBlocks ) ) {
			return $block_content;
		}

		// add core blocknames as mod classes to the array
		$prefix = str_replace( '/', '', strstr( $block['blockName'], '/' ) );
		$classes[] = 'block-' . $prefix;

		// add extra class when is core/html
		if($block['blockName'] === 'core/html') {
			$classes[] = 'is-style-fixed-width-paragraph';
		}

		// transform array to string for usage in html
		$classes   = implode( ' ', $classes );

		// add data attribute to block on headlines for anker navigation
		if($block['blockName'] === 'core/heading') {
			return "<div class='$classes' data-anchor='$prefix'>$block_content</div>";
		}

		// wrap the stuff up, then return
		return "<div class='$classes'>$block_content</div>";
	}

}

add_filter( 'render_block', 'voodookit_wrapping_core_blocks', 10, 3);



if(!function_exists('voodookit_allowed_block_types')) {

	function voodookit_allowed_block_types( $allowed_block_types, $post ) {
		if ( $post->post_type === 'libro' ) {
			return array(
				'core/paragraph',
				'core/image',
				'core/list'
			);
		}
		return $allowed_block_types;
	}
}

//add_filter( 'allowed_block_types', 'voodookit_allowed_block_types', 10, 2 );
