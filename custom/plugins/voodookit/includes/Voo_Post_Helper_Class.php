<?php

class Voo_Post_Helper
{

   /**
    * Return post thumbnail image
    * @param $size
    * @return string|void
    */

   public function post_thumbnails($size)
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

   public function get_attachement_alt($attachementID)
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

   public function get_post_category_names()
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

   public function get_term_id($taxonomy)
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

   public function get_converted_date($date)
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

   public function get_terms_str($taxonomy)
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

   public function get_slug()
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