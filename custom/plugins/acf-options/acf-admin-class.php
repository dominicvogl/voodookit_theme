<?php

$Voo_ACF_Admin = new Voo_ACF_Admin();

class Voo_ACF_Admin
{

   public function __construct()
   {

      // add ACF Option Page
      add_action('admin_menu', array($this, 'add_acf_option_pages'));

      // add ACF JSON save point
      add_filter('acf/settings/save_json', array($this, 'my_acf_json_save_point'));

      // add ACF JSON load point
      add_filter('acf/settings/load_json', array($this, 'my_acf_json_load_point'));

   }

   public function add_acf_option_pages()
   {

      if (function_exists('acf_add_options_page')) {

         acf_add_options_page(array(
            'page_title' => 'Theme General Settings',
            'menu_title' => 'Theme Settings',
            'menu_slug' => 'theme-general-settings',
            'capability' => 'edit_posts',
            'redirect' => false
         ));

         if(function_exists('acf_add_options_sub_page')) {

	         acf_add_options_sub_page(array(
		         'page_title' => 'archive-mitglied',
		         'menu_title' => 'Archiv: Mitglieder',
		         'parent_slug' => 'theme-general-settings',
	         ));

	         acf_add_options_sub_page(array(
		         'page_title' => 'Theme Footer Settings',
		         'menu_title' => 'Footer',
		         'parent_slug' => 'theme-general-settings',
	         ));

         }
      }
   }


   public function my_acf_json_save_point($path)
   {

      // update path
      $path = plugin_dir_path( __FILE__ ) . '/acf-json';


      // return
      return $path;

   }

   public function my_acf_json_load_point($paths)
   {

      // remove original path (optional)
      unset($paths[0]);


      // append path
      $paths[] = plugin_dir_path( __FILE__ ) . '/acf-json';


      // return
      return $paths;

   }

}
