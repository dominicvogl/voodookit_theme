<?php
/**
 * This is Voodookit!
 *
 * @package Voodookit
 * @since 1.0.0
 */

/**
 * Slideout
 */

add_action( 'voodookit_do_navigation_mobile', 'voodookit_logo', 5 );
add_action( 'voodookit_do_navigation_mobile', 'voodookit_navigation_mobile', 10 );



/**
 * header
 */

// header and wrapper of them
add_action( 'voodookit_do_header', 'voodookit_header', 10 );
// logo
add_action( 'voodookit_do_logo', 'voodookit_logo', 10 );
// slideout toggler
add_action( 'voodookit_do_slideout_toggler', 'voodookit_slideout_toggler', 10 );
// navigation
add_action( 'voodookit_do_navigation', 'voodookit_navigation', 10 );
// slideout
add_action( 'voodookit_do_slideout', 'voodookit_slideout', 10 );



/**
 * Main loop
 */

add_action( 'voodookit_do_before_main', 'voodookit_do_before_main_loop', 10 );
add_action( 'voodookit_do_main', 'voodookit_do_main_loop', 10 );
add_action( 'voodookit_do_main', 'voodookit_do_after_main_loop', 10 );



/**
 * Footer
 */

add_action( 'voodookit_do_before_footer', 'voodookit_before_footer', 10 );
add_action( 'voodookit_do_footer', 'voodookit_footer', 10 );
add_action( 'voodookit_do_footer', 'voodookit_copyright', 15 );



/**
 * Do the ACF Thing
 */
add_action( 'voodookit_do_acf', 'voodookit_do_acf_loop', 10 );
