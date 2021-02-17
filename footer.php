<?php
/**
 * This is Voodookit
 *
 * @package Voodookit
 * @since 1.0.0
 * @version 1.1.0
 */

do_action('voodookit_do_before_footer');

echo '<footer class="mod mod-inner">';
do_action('voodookit_do_footer');
echo '</footer>';

echo '</div>'; // slideout-panel for mobile navigation

do_action('voo_do_scrollToTop_button');

wp_footer();
