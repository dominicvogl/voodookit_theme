<?php

if ( function_exists('add_theme_support') ) {
	add_theme_support( 'post-thumbnails' );
}

/**
 * @param $attachmentID
 * @param string $size_args
 * @param bool $is_lazy
 * @param bool $echo
 * @param array $elem_args
 * Render image tag with size of svg's and a better image rendering as the original wp function! Check it out =)
 * @return string
 */

if (! function_exists('voo_get_image') ) {

	function voo_get_image($attachmentID, $size_args = 'thumbnail', $is_lazy = false, $echo = true, $elem_args = array()) {

		// Get path to the image
		$html = '';

		// Get alt attribute for image tag
		$attachment_attributes = bwrk_get_attachment($attachmentID);

		$image_ID = 'image-' . $attachmentID;
		if (!empty($elem_args['id'])) {
			$image_ID = $elem_args['id'];
		}

		$image_alt = '';
		if (!empty($attachment_attributes)) {
			if (!empty($attachment_attributes['alt'])) {
				$image_alt = $attachment_attributes['alt'];
			} elseif (!empty($attachment_attributes['caption'])) {
				$image_alt = $attachment_attributes['caption'];
			} else {
				$image_alt = $attachment_attributes['title'];
			}
		}

		$classes = '';
		if ($elem_args['alignment']) {
			$classes .= 'align' . $elem_args['alignment'];
		}
		if ($elem_args["image_behavior"]) {
			$classes .= ' behavior-' . $elem_args['image_behavior'];
		}

		$fallback_src = wp_get_attachment_image_src($attachmentID);

		if (is_array($size_args) && $elem_args["image_behavior"] != 'straight') {

			$html = '<img data-interchange="';

			foreach ($size_args as $size) {

				$image_uri = wp_get_attachment_image_src($attachmentID, $size["image_namespace"]);
				$html .= '[' . $image_uri[0] . ', (' . $size["media_query"] . ')], ';
			}

			//$sizes = bwrk_get_image_sizes($size_args[0]["image_namespace"]);
			$sizes = wp_get_attachment_image_src($attachmentID, $size_args[0]["image_namespace"]);
			$image_fallback = wp_get_attachment_image_src($attachmentID, $size_args[0]["image_namespace"]);
			//$image_fallback[] = 'http://placehold.it/100x100x/';

			$html = substr($html, 0, -2);
			$html .= '" src="' . $image_fallback[0] . '" width="' . $sizes[1] . '" height="' . $sizes[2] . '" id="' . $image_ID . '" class="' . $classes . '" alt="' . $image_alt . '"/>';

			//$html .= '<noscript><img src="'.$image_fallback[0].'" width="'.$sizes[1].'" height="'.$sizes[2].'" class="'.$classes.'" alt="'.$image_alt.'"/></noscript>';

		} else {

			//$size_args = 'full';

			$image_src = wp_get_attachment_image_src($attachmentID, $size_args);

			if ($image_src) {

				// Get image sizes
				$sizes = bwrk_get_image_sizes($size_args);

				if ($sizes == false) {
					$sizes = bwrk_get_image_sizes('thumbnail');
				} elseif (is_array($sizes[$size_args])) {
					$sizes = $sizes[$size_args];
				}

				// Get mime type
				$attachment = get_post($attachmentID);

				$mime = 'pixel';
				if ($attachment->post_mime_type == 'image/svg+xml') {
					$mime = 'vector';
				}

				// build array

				if ($is_lazy == true) {
					$image_data_attr = array(
						'data-lazy' => $image_src[0],
					);
				} else {
					$image_data_attr = array(
						'src' => $image_src[0],
					);
				}

				if ($elem_args["alignment"] == 'straight') {
					$size_args = $size_args[0]["image_namespace"];
				}


				$image_data = array(
					'class' => "attachment-$size_args wp-post-image $mime $classes",
					'width' => $sizes['width'],
					'height' => $sizes['height'],
					'alt' => $image_alt
				);

				$image_data = array_merge($image_data_attr, $image_data);


				// build html
				$html = rtrim("<img ");
				foreach ($image_data as $name => $value) {
					$html .= " $name=" . '"' . $value . '"';
				}
				$html .= ' />';

			}
		}

		if ($echo == true) {
			echo $html;
		} else {
			return $html;
		}

	}

}



//
// Get attachment meta
// ------------------------------------------------------

function voo_get_attachment($attachment_id)
{

	$attachment = get_post($attachment_id);
	return array(
		'alt' => get_post_meta($attachment->ID, '_wp_attachment_image_alt', true),
		'caption' => $attachment->post_excerpt,
		'description' => $attachment->post_content,
		'href' => get_permalink($attachment->ID),
		'src' => $attachment->guid,
		'title' => $attachment->post_title
	);
}



//
// Get array with image sizes
// ------------------------------------------------------

function voo_get_image_sizes($size = '')
{

	global $_wp_additional_image_sizes;

	$sizes = array();
	$get_intermediate_image_sizes = get_intermediate_image_sizes();

	// Create the full array with sizes and crop info
	foreach ($get_intermediate_image_sizes as $_size) {

		if (in_array($_size, array('thumbnail', 'medium', 'large'))) {

			$sizes[$_size]['width'] = get_option($_size . '_size_w');
			$sizes[$_size]['height'] = get_option($_size . '_size_h');
			$sizes[$_size]['crop'] = (bool)get_option($_size . '_crop');

		} elseif (isset($_wp_additional_image_sizes[$_size])) {

			$sizes[$_size] = array(
				'width' => $_wp_additional_image_sizes[$_size]['width'],
				'height' => $_wp_additional_image_sizes[$_size]['height'],
				'crop' => $_wp_additional_image_sizes[$_size]['crop']
			);

		}

	}

	// Get only 1 size if found
	if ($size) {

		//varD($sizes[ $size ]);

		if (isset($sizes[$size])) {
			return $sizes[$size];
		} else {
			return false;
		}

	}

	return $sizes;
}


function voo_get_srcset_image($image_ID, $image_sizes = array())
{

	// Define Variables
	$set = '';
	$srcset_list = '';
	$size_set = '';

	if (empty($image_sizes['srcset'])) {
		return false;
	}

	foreach ($image_sizes['srcset'] as $size) {
		$srcset_list[$size] = wp_get_attachment_image_src($image_ID, $size);
	}


	foreach ($srcset_list as $srcset) {
		$set .= $srcset[0] . ' ' . $srcset[1] . 'w, ';
	}

	$set = substr($set, 0, -2);


	foreach ($image_sizes["sizes"] as $sizes_set) {
		$size_set .= $sizes_set . ', ';
	}

	$size_set = substr($size_set, 0, -2);


	$html = '<img ';
	$html .= 'src="' . $srcset_list[$image_sizes['srcset'][0]][0] . '"';
	$html .= 'srcset="' . $set . '"';
	$html .= 'sizes="' . $size_set . '"';
	$html .= 'width="300" height="300"';
	$html .= ' />';

	return $html;

}


function wp_get_attachment_meta($attachment_id)
{

	$attachment = get_post($attachment_id);
	return array(
		'alt' => get_post_meta($attachment->ID, '_wp_attachment_image_alt', true),
		'caption' => $attachment->post_excerpt,
		'description' => $attachment->post_content,
		'href' => get_permalink($attachment->ID),
		'src' => $attachment->guid,
		'title' => $attachment->post_title
	);
}