<?php
/**
 * This is Voodookit
 *
 * @package Voodookit
 * @since 1.0.0
 * @version 1.1.0
 */

do_action('voodookit_do_before_footer');
do_action('voodookit_do_footer');

echo '</div>'; // slideout-panel for mobile navigation

do_action('voodookit_do_slideout_toggler');

wp_footer();
