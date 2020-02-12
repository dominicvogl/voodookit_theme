<?php

class voodookit_custom_nav_walker extends Walker_Nav_Menu {

	function start_el(&$output, $item, $depth=0, $args=array(), $id = 0) {

		// add custom walker to navigations

		var_dump($output);

	}

}
