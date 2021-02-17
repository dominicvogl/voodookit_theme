<?php
/**
 * This is Voodookit!
 *
 * @package Voodookit
 * @since 1.0.0
 * @version  1.0.0
 */

get_header();

do_action( 'voodookit_do_before_main' );

if( !gutenberg_block_exists('acf/introwithimage' )) {
	do_action('voodookit_do_nav_breadcrumb');
}

do_action( 'voodookit_do_main' );

get_footer();
