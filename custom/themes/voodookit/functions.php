<?php

// List all file to import
$files = array(
   'template'
);

if (is_array($files)) {
   foreach ($files as $filename) {
      include(plugin_dir_path( __FILE__ ) . 'includes/' . $filename . '.php');
   }
}