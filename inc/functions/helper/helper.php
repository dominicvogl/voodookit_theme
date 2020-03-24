<?php

/**
 * var_dump with <pre> tag
 * @param $value
 * @return void
 */

function varD($value) {
	echo '<pre>';
	var_dump($value);
	echo '</pre>';
}


if(! function_exists('get_slug')) {

	/**
	 * Get Post Slug
	 * @return string
	 * @deprecated
	 */

	function get_slug()
	{

		global $post;
		$slug = '';

		$post_data = get_post($post->ID, ARRAY_A);
		if ($post_data) {
			$slug = $post_data['post_name'];
		}

		return $slug;
	}
}


if (!function_exists('voodookit_get_icon')) {

	/**
	 * get icon from sprite with name
	 * @param $iconslug string
	 * @param $echo bool
	 * @return string|void
	 */

	function voodookit_get_icon($iconslug, $echo = true) {

		if (empty($iconslug)) {
			$iconslug = 'default';
		}

		$path = get_stylesheet_directory_uri() . '/dist/assets/svg/sprite-symbol.svg#' . $iconslug;

		$html =
			'<svg class="sprite sprite--' . $iconslug . '">
				<use xlink:href="' . $path . '"></use>
			</svg>';

		if ($echo) {
			echo $html;
		}

		return $html;

	}

}

if(! function_exists('voodookit_get_button') ) {

	/**
	 * Render button with wrapper
	 * @param object
	 * @return void
	 */

	function voodookit_get_button($post) {

		if(!is_object($post)) {
			return;
		}

		$args = [
			'link' => get_permalink($post),
			'label' => $post->post_title
		];

		?>
		<div class="button-wrapper">
			<a class="button" href="<?php echo $args['link'] ?>" title="<?php echo $args['label'] ?>"><?php _e('get more', 'voodookit'); ?></a>
		</div>

		<?php
	}

}


if(! function_exists('last_file_modification')) {

	/**
	 * Returns the version number of the template or the last modification date of the file, if exits
	 * @param string $file
	 * @return string
	 */

	function last_file_modification($file = '')
	{

		if (file_exists($file)) {
			return date('YmdHi', filemtime($file));
		}

		return wp_get_theme()->get('Version');
	}
}


if (!function_exists('get_asset')) {

	/**
	 * load files from template or child template (current stylesheet directory)
	 * @param $file
	 * @return array
	 * @since 1.2.1
	 * @version 1.2.1
	 */

	function get_asset($file)
	{
		$data = array(
			'path' => '',
			'version' => ''
		);

		$asset = substr(strstr($file, '.'), strlen('.'));
		$path = '/dist/assets/'. $asset .'/' . $file;

		if ( file_exists(get_stylesheet_directory() . $path ) ) {
			$data['path'] = get_stylesheet_directory_uri() . $path;
		}

		if( !empty( last_file_modification( get_stylesheet_directory() . $path ) ) ) {
			$data['version'] = last_file_modification( get_stylesheet_directory() . $path );
		}

		return $data;
	}

}



if(! function_exists('voodookit_check_fixed_width')) {

	function voodookit_check_fixed_width () {

		$fixed_width = get_field('fixed_width');

		if($fixed_width === false) {
			return 'full-width';
		}

		return NULL;
	}

}


if(!function_exists('voodookit_add_action')) {

	function voodookit_add_action($tag, $function, $priority) {

		var_dump(has_action($tag, $function));

		if(has_action($tag, $function)) {
			remove_action($tag, $function, $priority);
			add_action($tag, $function, $priority);

			return;
		}

		add_action($tag, $function, $priority);
	}

}
