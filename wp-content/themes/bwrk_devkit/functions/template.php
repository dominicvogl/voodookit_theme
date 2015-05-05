<?php

$f5_config = array();

if(function_exists('get_field')) {
    $f5_config['gmaps_api_key'] .= get_field('gmaps_api_key', 'options');
}



//
// Favicons laden
// ----------------------------------------------------------------------------------------

function blog_favicon() {
    $url = get_bloginfo('template_url');
    echo '<link rel="Shortcut Icon" type="image/x-icon" href="'.$url.'/img/favicon.ico" />';
    echo '<link rel="Shortcut Icon" type="image/png" href="'.$url.'/img/favicon.png" />';
}
add_action('wp_head', 'blog_favicon');



//
// Get Template dir
// --------------------------------------------------------------------

function get_dir($path) {

	return get_template_directory_uri().$path;

}



//
// Lade CSS
// ----------------------------------------------------------------------------------------

function load_css() {

	if(!is_admin()) {

		$styles = array(

			array(
				'handle'	=> 'gfonts',
				'src'		=> 'http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700|Roboto:400,500',
				'deps'		=> array(),
			),

			array(
				'handle'	=> 'styles',
				'src'		=> get_dir('/styles/styles.css'),
				'deps'		=> array(),
			)

		);

		if( is_page( array(1433, 1556)) ) {
			$styles = array(

				array(
					'handle'	=> 'gfonts',
					'src'		=> 'http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700|Roboto:400,500',
					'deps'		=> array(),
				),

				array(
					'handle'	=> 'styles',
					'src'		=> get_dir('/styles/styles.css'),
					'deps'		=> array(),
				),

				array(
					'handle'	=> 'schock',
					'src'		=> get_dir('/styles/schock.css'),
					'deps'		=> array(),
				)
			);

		}

		if( is_page(1556) ) {

			$styles[] = array(
				'handle'	=> 'video',
				'src'		=> get_dir('/styles/video-js.min.css'),
				'deps'		=> array(),
			);

		}

		foreach( $styles as $style ) {

			wp_register_style( $style['handle'], $style['src'], $style['deps'], '2.0' );
			wp_enqueue_style( $style['handle'] );

		}

	}

}

add_action('wp_enqueue_scripts', 'load_css');



//
// Remove standard wordpress jquery library
// ----------------------------------------------------------------------------------------

function modify_jquery() {
	if (!is_admin()) {
		wp_deregister_script('jquery');
	}
}

add_action('init', 'modify_jquery');



//
// Lade Javascript
// ----------------------------------------------------------------------------------------

function load_javascript() {

	if(!is_admin()) {

		$scripts = array(

			array(
				'handle'	=> 'modernizr',
				'src'		=> get_dir( '/js/cccc/modernizr.js' ),
				'deps'		=> array(),
			),

			array(
				'handle'	=> 'jquery',
				'src'		=> 'http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js',
				'deps'		=> array('modernizr'),
			),

			array(
				'handle'	=> 'fastclick',
				'src'		=> get_dir( '/js/cccc/fastclick.js' ),
				'deps'		=> array('jquery'),
			),

			array(
				'handle'	=> 'ssm',
				'src'		=> get_dir( '/js/cccc/ssm.min.js' ),
				'deps'		=> array('jquery'),
			),

			array(
				'handle'	=> 'jpanelmenu',
				'src'		=> get_dir( '/js/cccc/jquery.jpanelmenu.min.js' ),
				'deps'		=> array('jquery'),
			),

			array(
				'handle'	=> 'slick',
				'src'		=> get_dir( '/js/cccc/slick.min.js' ),
				'deps'		=> array('jquery'),
			),

			array(
				'handle'	=> 'strip',
				'src'		=> get_dir( '/js/cccc/strip.min.js' ),
				'deps'		=> array('jquery'),
			),

		);

		if(is_post_type('gallery')) {
			$scripts[] = array(
				'handle'	=> 'wookmark',
				'src'		=> get_dir( '/js/cccc/jquery.wookmark.min.js' ),
				'deps'		=> array('jquery'),
			);
		}

		if( is_page(1556) ) {

			$scripts[] = array(
				'handle'	=> 'video',
				'src'		=> get_dir( '/js/cccc/video.min.js' ),
				'deps'		=> array('jquery'),
			);

		}

		$scripts[] = array(
			'handle'	=> 'setup',
			'src'		=> get_dir( '/js/cccc/setup.js' ),
			'deps'		=> array('jquery'),
		);

		foreach( $scripts as $script ) {

			wp_register_script( $script['handle'], $script['src'], $script['deps'], '2.0' );
			wp_enqueue_script( $script['handle'] );

		}

	}

}

add_action('wp_footer', 'load_javascript');



//
// Header aufräumen
// ----------------------------------------------------------------------------------------

function remheadlink() {
    // Remove links to the extra feeds (e.g. category feeds)
    remove_action( 'wp_head', 'feed_links_extra', 3 );
    // Remove links to the general feeds (e.g. posts and comments)
    remove_action( 'wp_head', 'feed_links', 2 );
    // Remove link to the RSD service endpoint, EditURI link
    remove_action( 'wp_head', 'rsd_link' );
    // Remove link to the Windows Live Writer manifest file
    remove_action( 'wp_head', 'wlwmanifest_link' );
    // Remove index link
    remove_action( 'wp_head', 'index_rel_link' );
    // Remove prev link
    remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
    // Remove start link
    remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
    // Display relational links for adjacent posts
    remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
    // Remove XHTML generator showing WP version
    remove_action( 'wp_head', 'wp_generator' );
}

add_action('init', 'remheadlink');



//
// Shotcodes
// ----------------------------------------------------------------------------------------

function vimeo_short($video){
	//echo '<h3>'.$video['title'].'</h3>';
	echo '<div class="video-box"><iframe src="//player.vimeo.com/video/'.$video['id'].'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>';
}
add_shortcode( 'vimeo', 'vimeo_short' );

function youtube_short($video){
	//echo '<h3>'.$video['title'].'</h3>';
	echo '<div class="video-box"><iframe width="560" height="315" src="//www.youtube.com/embed/'.$video['id'].'" frameborder="0" allowfullscreen></iframe></div>';
}
add_shortcode( 'youtube', 'youtube_short' );