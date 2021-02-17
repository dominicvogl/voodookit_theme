<?php
/**
 * This is Voodookit!
 *
 * @package voodookit
 * @since 1.0.0
 */

if ( ! function_exists( 'voodookit_do_before_main_loop' ) ) {

	/**
	 * Render something before the main content loop
	 * @since 1.0.0
	 */

	function voodookit_do_before_main_loop() {
		echo '<main class="app--wrapper">';
	}

}

if ( ! function_exists( 'voodookit_do_after_main_loop' ) ) {

	/**a
	 * Render something after the main content loop
	 * @since 1.0.0
	 */

	function voodookit_do_after_main_loop() {
		echo '</main>';
	}

}

if ( ! function_exists( 'voodookit_do_main_loop' ) ) {

	/**
	 * Render the main content loop
	 * @since 1.0.0
	 */

	function voodookit_do_main_loop() {

		if ( have_posts() ) {

			while ( have_posts() ) {
				the_post();

				if( !gutenberg_block_exists('acf/introwithimage') && !is_front_page() ) {

					$alignment_headline = get_field('alignment_headline', get_the_ID());
					$page_title_classes = array(
						'page-title',
						($alignment_headline === 'right' || $alignment_headline === 'center') ? 'text-'. $alignment_headline : ''
					);

					the_title('<div class="row column"><h1 class="'.trim(implode(' ', $page_title_classes) ).'">', '</h1></div>');
				}

				the_content();

				if(is_page(26)) {
					get_template_part('inc/partials/page', 'styleguide');
				}
			}

			wp_reset_postdata();

		}
	}

}
