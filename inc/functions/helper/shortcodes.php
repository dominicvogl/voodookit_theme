<?php
/**
 * The Voodookit framework
 * Add Shortcodes for use in tiny mce
 *
 * @package Voodookit
 * @since 1.0.0
 * @author Dominic Vogl
 */

add_shortcode( 'vimeo', 'vimeo_short' );

/**
 * Vimeo shortcode for use in mce editor
 *
 * @since 1.0.0
 */

if ( ! function_exists( 'vimeo_short' ) ) {
	function vimeo_short ( $video ) {
		echo '<div class="video-box"><iframe src="//player.vimeo.com/video/' . $video['id'] . '?title=0&amp;byline=0&amp;portrait=0&amp;" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>';
	}
}

add_shortcode( 'youtube', 'youtube_short' );


/**
 * Youtube shortcode for use in mce editor
 *
 * @since 1.0.0
 */

if ( ! function_exists( 'youtube_short' ) ) {
	function youtube_short( $video ) {
		echo '<div class="video-box"><iframe width="560" height="315" src="//www.youtube.com/embed/' . $video['id'] . '" frameborder="0" allowfullscreen></iframe></div>';
	}
}

add_shortcode( 'gaoptout', 'google_opt_out' );


/**
 * Add Shortcode for google tracking deactivation
 *
 * @since 1.0.0
 */

if ( ! function_exists( 'google_opt_out' ) ) {


	function google_opt_out( $atts, $content = null ) {

		// Write [gaoptout]Google Analytics deaktivieren[/gaoptout] in on your privacy passus
		return '<a href=javascript:gaOptout()>' . $content . '</a>';

	}
}
