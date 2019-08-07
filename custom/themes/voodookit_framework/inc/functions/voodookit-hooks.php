<?php
/**
 * This is Voodookit!
 *
 * @package Voodookit
 * @since 1.0.0
 */

/**
 * Logo
 */


/**
 * header
 */

add_action( 'voodookit_do_header', 'voodookit_logo', 5);
add_action( 'voodookit_do_header', 'voodookit_navigation', 10);

/**
 * main loop
 */
add_action( 'voodookit_do_main', 'voodookit_do_main_loop', 10 );
