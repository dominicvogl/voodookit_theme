<?php
/**
 * This is Voodookit
 *
 * @package Voodookit
 */

?>

<footer class="mod inner">
	<div class="row">
		<?php do_action('voodookit_do_before_footer'); ?>
		<?php do_action('voodookit_do_footer'); ?>
	</div>
</footer>

<?php

echo '</div>'; // slideout-panel

do_action('voodookit_do_slideout_toggler');

wp_footer();
