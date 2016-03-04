<?php

$Voo_Frontend_Template = new Voo_Frontend_Template();

class Voo_Frontend_Template
{


   /**
    * Init all this stuff
    */

   public function __construct()
   {

   //      add_action('wp_head', array($this, 'add_favicons'));
   //      add_action('wp_head', array($this, 'load_css'));
   //      add_action('wp_footer', array($this, 'load_javascript'));
      add_action('init', array($this, 'clean_headers'));

   }

   /**
    * Load Favicons in Template
    */

   public function add_favicons()
   {

      $url = get_bloginfo('template_url');

      $html = '<link rel="Shortcut Icon" type="image/x-icon" href="' . $url . '/img/favicon.ico" />';
      $html .= '<link rel="Shortcut Icon" type="image/png" href="' . $url . '/img/favicon.png" />';

      return $html;

   }


   /**
    * Load CSS Files
    */

   public function load_css()
   {

      if (!is_admin()) {

         $files = array(

            array(
               'handle' => 'styles',
               'src' => get_template_directory_uri() . '/css/app.css',
               'deps' => array(),
            )

         );

         foreach ($files as $file) {

            wp_register_style($file['handle'], $file['src'], $file['deps'], BWRK_TEMPLATE_VERSION);
            wp_enqueue_style($file['handle']);

         }

      }

   }


   /**
    * Load Javascript files
    */

   public function load_javascript()
   {

      if (!is_admin()) {

         wp_deregister_script('jquery');

         $files = array(

            array(
               'handle' => 'app',
               'src' => get_template_directory_uri() . '/js/app.js',
               'deps' => array(),
            )

         );

         foreach ($files as $file) {

            wp_register_script($file['handle'], $file['src'], $file['deps'], BWRK_TEMPLATE_VERSION);
            wp_enqueue_script($file['handle']);

         }

      }

   }


   /**
    * Cleanup header
    */

   public function clean_headers()
   {
      // Remove links to the extra feeds (e.g. category feeds)
      remove_action('wp_head', 'feed_links_extra', 3);
      // Remove links to the general feeds (e.g. posts and comments)
      remove_action('wp_head', 'feed_links', 2);
      // Remove link to the RSD service endpoint, EditURI link
      remove_action('wp_head', 'rsd_link');
      // Remove link to the Windows Live Writer manifest file
      remove_action('wp_head', 'wlwmanifest_link');
      // Remove index link
      remove_action('wp_head', 'index_rel_link');
      // Remove prev link
      remove_action('wp_head', 'parent_post_rel_link', 10, 0);
      // Remove start link
      remove_action('wp_head', 'start_post_rel_link', 10, 0);
      // Display relational links for adjacent posts
      remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
      // Remove XHTML generator showing WP version
      remove_action('wp_head', 'wp_generator');
   }

}