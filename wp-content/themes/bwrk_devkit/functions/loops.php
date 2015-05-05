<?php

//
// Your first very simple loop, feel free to use! =)
// ----------------------------------------------------------------------------------------------

function first_loop($args = array()) {

    $default = array(
        'post_type' => 'post',
        'posts_per_page' => -1
    );

    $html = '';
    $args = wp_parse_args($args, $default);

    $posts = get_posts($args);

    foreach($posts as $post) {
        setup_postdata($post);

        $html = get_the_title();

    }

    return $html;
}