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

add_action( 'voodookit_do_main', 'voodookit_do_before_main_loop', 5 );
add_action( 'voodookit_do_main', 'voodookit_do_main_loop', 10 );
add_action( 'voodookit_do_main', 'voodookit_do_after_main_loop', 15 );

/**
 * Do the ACF Thing
 */
add_action( 'voodookit_do_acf', 'voodookit_do_acf_loop', 10 );
