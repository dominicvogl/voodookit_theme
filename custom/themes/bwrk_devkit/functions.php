<?php

// List all file to import
$files = array(
   'template',
);

if (is_array($files)) {
   foreach ($files as $filename) {
      include(TEMPLATEPATH . '/includes/' . $filename . '.php');
   }
}