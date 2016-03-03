<?php

$Voo_Loops = new Voo_Loops();

class Voo_Loops
{

   /**
    * Your first very simple loop, feel free to use! =)
    * @param array $args
    * @return string
    */

   public function basic_loop($args = array())
   {

      $default = array(
         'post_type' => 'post',
         'posts_per_page' => -1
      );

      $html = '';
      $args = wp_parse_args($args, $default);

      $posts = get_posts($args);

      foreach ($posts as $post) {
         setup_postdata($post);

         $html .= '<h1>'.get_the_title().'</h1>';
         $html .= get_the_content();

      }

      return $html;
   }

}