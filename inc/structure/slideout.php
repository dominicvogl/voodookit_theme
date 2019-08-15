<?php
/**
 * This is Voodookit
 *
 * @package Voodookit
 * @since 1.0.0
 */

if(! function_exists('voodookit_slideout')) {

	function voodookit_slideout() {

		?>
		<div class="js-slideout-menu">
			<?php do_action('voodookit_do_navigation_mobile'); ?>
		</div>
		<?php

	}

}
