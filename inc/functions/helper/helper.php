<?php

/**
 * var_dump with <pre> tag
 * @param $value
 */

function varD($value)
{

	echo '<pre>';
	var_dump($value);
	echo '</pre>';

}

/**
 * Check Post-Format
 * @param $post_id
 * @param $format
 * @return bool
 */

function is_post_format($post_id, $format)
{

	if (get_post_format($post_id) == $format) {
		return true;
	} else {
		return false;
	}

}


/**
 *  Check Page-Type
 * @param $format
 * @return bool|null
 */

function acf_is_page_type($format)
{

	if(function_exists('get_field')) {

		if (get_field('page_type') == $format) {
			return true;
		} else {
			return false;
		}

	}
	else {
		return NULL;
	}

}

/**
 * Check Post-Type
 * @param $post_type
 * @return bool
 */

function is_post_type($post_type)
{

	if (get_post_type() == $post_type) {
		return true;
	} else {
		return false;
	}

}


/**
 * Get right Language from Browser
 * @param $allowed_languages
 * @param $default_language
 * @param null $lang_variable
 * @param bool $strict_mode
 * @return string
 */

function get_lang_from_browser($allowed_languages, $default_language, $lang_variable = NULL, $strict_mode = TRUE)
{

	// $_SERVER['HTTP_ACCEPT_LANGUAGE'] verwenden, wenn keine Sprachvariable mitgegeben wurde
	if (NULL === $lang_variable)
		$lang_variable = $_SERVER['HTTP_ACCEPT_LANGUAGE'];

	// Wurde irgendwelche Information mitgeschickt?
	if (empty($lang_variable))
		return $default_language;

	// Den Header auftrennen
	$accepted_languages = preg_split('/,\s*/', $lang_variable);

	// Die Standardwerte einstellen
	$current_lang = $default_language;
	$current_q = 0;
	// Nun alle mitgegebenen Sprachen abarbeiten
	foreach ($accepted_languages as $accepted_language) {
		// Alle Infos dieser Sprache rausholen
		$res = preg_match(
			'/^([a-z]{1,8}(?:-[a-z]{1,8})*)' .
			'(?:;\s*q=(0(?:\.[0-9]{1,3})?|1(?:\.0{1,3})?))?$/i',
			$accepted_language,
			$matches
		);

		if (!$res)
			continue;

		// Sprachcode holen und dann sofort in die Einzelteile trennen
		$lang_code = explode('-', $matches[1]);

		// Wurde eine Qualität mitgegeben?
		if (isset($matches[2]))
			$lang_quality = (float)$matches[2];
		else
			$lang_quality = 1.0;

		// Bis der Sprachcode leer ist...
		while (count($lang_code)) {
			// Prüfen, ob der Sprachcode angeboten wird
			if (in_array(strtolower(join('-', $lang_code)), $allowed_languages)) {
				// Qualität prüfen
				if ($lang_quality > $current_q) {
					$current_lang = strtolower(join('-', $lang_code));
					$current_q = $lang_quality;
					break;
				}
			}
			// Wenn wir im strengen Modus sind, die Sprache nicht versuchen zu minimalisieren
			if ($strict_mode)
				break;

			// Den rechtesten Teil des Sprachcodes abschneiden
			array_pop($lang_code);
		}
	}

	return $current_lang;

}

/**
 * Return post thumbnail image
 * @param $size
 * @return string|void
 */

function post_thumbnails($size)
{

	$thumbnail = '';
	if (has_post_thumbnail()) {
		$thumbnail = the_post_thumbnail($size);
	}

	return $thumbnail;

}

/**
 * Return alternative text of an image
 * @param $attachementID
 * @return mixed|string
 */

function get_attachement_alt($attachementID)
{

	$attachment_alt = '';
	if (has_post_thumbnail()) {
		$attachment_alt = get_post_meta($attachementID, '_wp_attachment_image_alt', true);
	}

	return $attachment_alt;
}


/**
 * Render list with post categorys
 * @return bool|string
 */

function get_post_category_names()
{
	$categories = get_the_category();
	$separator = ' ';
	$num_cats = count($categories);
	$count = 0;
	$output = '';

	if ($categories) {
		foreach ($categories as $category) {
			$count++;
			if ($num_cats == $count) {
				$separator = '';
			}

			$output .= $category->slug . $separator;
		}

		return $output;
	} else {
		return false;
	}

}


/**
 * Get term id from taxonomy
 * @param $taxonomy
 * @return bool|string
 */

function get_term_id($taxonomy)
{

	$terms = wp_get_post_terms(get_the_ID(), $taxonomy);

	if (!empty($terms)) {
		$term_id = '';
		foreach ($terms as $term) {
			$term_id .= $term->term_id;
		}
		return $term_id;
	} else {
		return false;
	}
}


/**
 * Cleanup Date format
 * @param $date
 * @return bool|string
 */

function get_converted_date($date)
{

	if (!empty($date)) {
		$y = substr($date, 0, 4);
		$m = substr($date, 4, 2);
		$d = substr($date, 6, 2);

		// create UNIX
		$time = strtotime("{$d}-{$m}-{$y}");

		// format date (23/11/1988)
		return date('d.m.Y', $time);

	} else {
		return false;
	}

}


/**
 * Render term strings for data filter
 * @param $taxonomy
 * @return array|string
 */

function get_terms_str($taxonomy)
{

	$terms = get_the_terms(get_the_ID(), $taxonomy);

	if (!empty($terms)) {

		$termlist = array();
		foreach ($terms as $term) {
			$termlist[] .= $term->slug;
		}

		$termlist = rtrim(implode('", "', $termlist));
		$termlist = '"' . $termlist . '"';
	}

	return $termlist;
}


/**
 * Get Post Slug
 * @return string
 */

if (!function_exists('voodookit_get_post_slug')) {

	function voodookit_get_post_slug()
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


/**
 * get icon from sprite with name
 */

if (!function_exists('voodookit_get_icon')) {

	function voodookit_get_icon($iconslug, $echo = true)
	{

		if (empty($iconslug)) {
			$iconslug = 'default';
		}

		$path = get_stylesheet_directory_uri() . "/dist/assets/svg/sprite-symbol.svg#" . $iconslug;

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
	 * render button with individual options
	 * @version 0.1.2
	 * @since 0.1
	 * @author Dominic Vogl <dominic.vogl@cat-ia.de>
	 * @return void
	 */

	function voodookit_get_button($post, $args = array()) {

		if(!is_object($post)) {
			return;
		}

		$defaults = [
			"link" => get_permalink($post),
			"label" => $post->post_title,
			'class' => 'button'
		];

		$args = array_merge($defaults, $args);

		?>
		<div class="button-wrapper">
			<a class="<?php echo $args['class'] ?>" href="<?php echo $args['link'] ?>" title="<?php echo $args['label'] ?>"><?php _e('get more', 'voodookit'); ?></a>
		</div>

		<?php
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
