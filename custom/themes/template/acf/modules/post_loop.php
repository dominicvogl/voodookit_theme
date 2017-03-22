<?php

/**
 * @var $module
 */

var_dump($module);

$post_args = array(
	'post_type' => $module['post_type'],
	'posts_per_page' => $module['posts_per_page'],
	'order' => $module['order']
);


$posts = get_posts($post_args);

var_dump($posts);   