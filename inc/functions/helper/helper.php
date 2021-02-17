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
	 * @param $target object|string
	 * @param $label string
	 * @param $classes string
	 * @return void
	 */

	function voodookit_get_button( $target, string $label = '', string $classes = '') {

		// check if value is not a post object
		if(is_string($target)) {

			$args = [
				'link' => $target,
				'label' => $label
			];

		}

		if(is_object($target)) {

			$args = [
				'link' => get_permalink($target),
				'label' => (!empty($label) ? $label : $target->post_title)
			];
		}

		if(!is_object($target) && !is_string($target)) {
			return;
		}

		$args['classes'] = 'button';
		if(!empty($classes)) {
			$args['classes'] = $classes;
		}

		if (empty(trim($args['label']))) {
			return;
		}

		?>

		<div class="button-wrapper">
			<a class="<?php esc_attr_e($args['classes']); ?>" href="<?php echo esc_url($args['link']) ?>" title="<?php echo esc_attr($args['label']) ?>"><?php echo esc_html($args['label']); ?></a>
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

if(!function_exists('gutenberg_block_exists')) {

	/**
	 * Look for special Gutenberg block and check if it exists in this post
	 * @param object $post
	 * @param $needle
	 * @return bool
	 */

	function gutenberg_block_exists($needle) {

		$post = get_post( get_the_ID() );

		if(!is_object($post)) {
			return false;
		}

		if ( has_blocks( $post->post_content ) ) {
			$blocks = parse_blocks( $post->post_content );

			if ( in_array('acf/introwithimage', array_column($blocks, 'blockName')) ) {
				return true;
			}
		}

		return false;

	}

}


if(!function_exists('voodookit_build_target_url')) {

	/**
	 * Build target URL from url and anker ID
	 * @param $cta
	 * @return string
	 */

	function voodookit_build_target_url($cta) {

		$target = array();

		if (!empty($cta['target_url'])) {
			$target[] = $cta['target_url'];
		}

		if (!empty($cta['anker_id'])) {
			$target[] = '#' . $cta['anker_id'];
		}

		$target = trim( implode('', $target) );

		return $target;

	}

}


if (!function_exists('is_for_editor_only')) {

	/**
	 * check if block is allowd to show
	 * @return bool
	 */

	function is_for_editor_only() {

		$swe = get_field('show_when_editor');

		if( $swe && is_user_logged_in() ) {
			return false;
		}

		return true;

	}

}
