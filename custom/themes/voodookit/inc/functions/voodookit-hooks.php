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

add_action( 'voodookit_do_header', 'voodookit_do_before_header', 5);
add_action( 'voodookit_do_header', 'voodookit_logo', 10);
add_action( 'voodookit_do_header', 'voodookit_navigation', 15);
add_action( 'voodookit_do_header', 'voodookit_do_after_header', 20);

/**
 * Main loop
 */

add_action( 'voodookit_do_main', 'voodookit_do_before_main_loop', 5 );
add_action( 'voodookit_do_main', 'voodookit_do_main_loop', 10 );
add_action( 'voodookit_do_main', 'voodookit_do_after_main_loop', 15 );

/**
 * Footer
 */

add_action('voodookit_do_footer', 'voodookit_footer', 10);
add_action('voodookit_do_social', 'voodookit_social', 10);
add_action('voodookit_do_footer_nav', 'voodookit_footer_nav', 10);


/**
 * Do the ACF Thing
 */
add_action( 'voodookit_do_acf', 'voodookit_do_acf_loop', 10 );

