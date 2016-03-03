<?php

$Voo_Shortcodes = new Voo_Shortcodes();

class Voo_Shortcodes
{

   public function __construct()
   {

      add_shortcode( 'vimeo', array($this, 'vimeo_short') );
      add_shortcode( 'youtube', array($this, 'youtube_short') );

   }

   public function vimeo_short($video)
   {
      $html = '<div class="video-box"><iframe src="//player.vimeo.com/video/'.$video['id'].'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>';

      echo $html;
   }

   public function youtube_short($video)
   {
      $html = '<div class="video-box"><iframe width="560" height="315" src="//www.youtube.com/embed/'.$video['id'].'" frameborder="0" allowfullscreen></iframe></div>';

      echo $html;
   }

}