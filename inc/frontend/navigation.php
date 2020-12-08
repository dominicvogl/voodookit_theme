<?php

if (!function_exists('voodookit_navigation_breadcrumb')) {

	function voodookit_navigation_breadcrumb($args = array())
	{
		$defaults = array(
			'delimiter' => '&raquo;',
			'home' => 'Home',
			'before' => '<span class="current-page">',
			'after' => '</span>',
			'prefix' => __('you are here ', 'voodookit')
		);

		$args = array_merge($defaults, $args);

		if ((!is_home() && !is_front_page()) || is_paged()) {

			echo '<div class="row column"><nav class="navigation--breadcrumb">'. $args['prefix'];

			global $post;
			$homeLink = get_bloginfo('url');
			echo '<a href="' . $homeLink . '">' . $args['home'] . '</a> ' . $args['delimiter'] . ' ';

			if (is_category()) {
				global $wp_query;
				$cat_obj = $wp_query->get_queried_object();
				$thisCat = $cat_obj->term_id;
				$thisCat = get_category($thisCat);
				$parentCat = get_category($thisCat->parent);
				if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $args['delimiter'] . ' '));
				echo $args['before'] . single_cat_title('', false) . $args['after'];

			} elseif (is_day()) {
				echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $args['delimiter'] . ' ';
				echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $args['delimiter'] . ' ';
				echo $args['before'] . get_the_time('d') . $args['after'];

			} elseif (is_month()) {
				echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $args['delimiter'] . ' ';
				echo $args['before'] . get_the_time('F') . $args['after'];

			} elseif (is_year()) {
				echo $args['before'] . get_the_time('Y') . $args['after'];

			} elseif (is_single() && !is_attachment()) {
				if (get_post_type() != 'post') {
					$post_type = get_post_type_object(get_post_type());
					$slug = $post_type->rewrite;
					echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $args['delimiter'] . ' ';
					echo $args['before'] . get_the_title() . $args['after'];
				} else {
					$cat = get_the_category();
					$cat = $cat[0];
					echo get_category_parents($cat, TRUE, ' ' . $args['delimiter'] . ' ');
					echo $args['before'] . get_the_title() . $args['after'];
				}

			} elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
				$post_type = get_post_type_object(get_post_type());
				echo $args['before'] . $post_type->labels->singular_name . $args['after'];


			} elseif (is_attachment()) {
				$parent = get_post($post->post_parent);
				$cat = get_the_category($parent->ID);
				$cat = $cat[0];
				echo get_category_parents($cat, TRUE, ' ' . $args['delimiter'] . ' ');
				echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $args['delimiter'] . ' ';
				echo $args['before'] . get_the_title() . $args['after'];

			} elseif (is_page() && !$post->post_parent) {
				echo $args['before'] . get_the_title() . $args['after'];

			} elseif (is_page() && $post->post_parent) {
				$parent_id = $post->post_parent;
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
					$parent_id = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $args['delimiter'] . ' ';
				echo $args['before'] . get_the_title() . $args['after'];

			} elseif (is_search()) {
				echo $args['before'] . 'Ergebnisse für Ihre Suche nach "' . get_search_query() . '"' . $args['after'];

			} elseif (is_tag()) {
				echo $args['before'] . 'Beiträge mit dem Schlagwort "' . single_tag_title('', false) . '"' . $args['after'];

			} elseif (is_404()) {
				echo $args['before'] . 'Fehler 404' . $args['after'];
			}

			if (get_query_var('paged')) {
				if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo ' (';
				echo ': ' . __('Seite') . ' ' . get_query_var('paged');
				if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo ')';
			}

			echo '</nav></div>';

		}
	}
}
