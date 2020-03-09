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

do_action( 'voodookit_do_main' );

get_footer();
