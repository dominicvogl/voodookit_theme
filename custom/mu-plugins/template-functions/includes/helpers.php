<?php

//
// var_dump with <pre> tag
// ------------------------------------------------------

function varD($value) {

    echo '<pre>';
    var_dump($value);
    echo '</pre>';

}



//
// Check Post-Format
// ------------------------------------------------------

function is_post_format($post_id, $format) {

    if(get_post_format($post_id) == $format) {
        return true;
    }
    else {
        return false;
    }

}



//
// Check Page-Type
// ------------------------------------------------------

function is_page_type($format) {

    if(get_field('page_type') == $format) {
        return true;
    }
    else {
        return false;
    }

}



//
// Check Post-Type
// ------------------------------------------------------

function is_post_type($post_type) {

    if(get_post_type() == $post_type) {
        return true;
    } else {
        return false;
    }

}


function get_lang_from_browser($allowed_languages, $default_language, $lang_variable = NULL, $strict_mode = TRUE) {
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
	$current_q    = 0;
	// Nun alle mitgegebenen Sprachen abarbeiten
	foreach ($accepted_languages as $accepted_language) {
		// Alle Infos dieser Sprache rausholen
		$res = preg_match(
			'/^([a-z]{1,8}(?:-[a-z]{1,8})*)'.
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