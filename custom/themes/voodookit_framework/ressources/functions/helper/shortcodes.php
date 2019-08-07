<?php

if(function_exists('add_shortcode')) {

	add_shortcode( 'vimeo', 'vimeo_short' );
	add_shortcode( 'youtube', 'youtube_short');
	add_shortcode( 'gaoptout', 'google_opt_out');

}

function vimeo_short( $video ) {
	echo '<div class="video-box"><iframe src="//player.vimeo.com/video/' . $video['id'] . '?title=0&amp;byline=0&amp;portrait=0&amp;" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>';
}

function youtube_short( $video ) {
	echo '<div class="video-box"><iframe width="560" height="315" src="//www.youtube.com/embed/' . $video['id'] . '" frameborder="0" allowfullscreen></iframe></div>';
}

// Add Shortcode for google tracking deactivation
function google_opt_out( $atts, $content = null ) {

	// Write [gaoptout]Google Analytics deaktivieren[/gaoptout] in on your privacy passus
	return '<a href=javascript:gaOptout()>'.$content.'</a>';

}