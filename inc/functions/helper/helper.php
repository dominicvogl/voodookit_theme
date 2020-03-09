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


if(! function_exists('is_post_format')) {

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

}


/**
 * Check Page-Type
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
 * @deprecated
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
 * @deprecated
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
 * @return string
 * @deprecated
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
 * @deprecated
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
 * @deprecated
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
 * @deprecated
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
 * @deprecated
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



if(! function_exists('voodookit_get_icon') ) {

	/**
	 * get icon from sprite with name
	 * @return void
	 */

	function voodookit_get_icon($iconslug) {

		if(empty($iconslug)) {
			return;
		}

		$path = get_stylesheet_directory_uri() . "/dist/assets/svg/sprite-symbol.svg#" . $iconslug;

		?>
		<svg class="sprite sprite--<?php echo $iconslug; ?>">
			<use xlink:href="<?php echo $path ?>"></use>
		</svg>
		<?php
	}

}



if(! function_exists('voodookit_get_button') ) {

	/**
	 * Render button with wrapper
	 * @return void
	 */

	function voodookit_get_button($post) {

		if(!is_object($post)) {
			return;
		}

		$args = [
			"link" => get_permalink($post),
			"label" => $post->post_title
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

	function last_file_modification($file = '') {

		if(file_exists( $file)) {
			return date( 'YmdHi', filemtime( $file ) );
		}

		return wp_get_theme()->get( 'Version' );

	}

}
