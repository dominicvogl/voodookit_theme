<?php

get_header();

$args = array();

if(is_page(get_the_ID())) {

   $args = array(
      'post_type' => 'page',
      'posts_per_page' => 1,
      'p' => get_the_ID()
   );

}


echo $Voo_Loops->basic_loop($args);

get_footer();