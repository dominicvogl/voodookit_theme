<?php

// List all file to import

define('CURRENT_PAGE_ID', get_the_ID());

$files = array(
   'template',
);

if (is_array($files)) {
   foreach ($files as $filename) {
      include(TEMPLATEPATH . '/includes/' . $filename . '.php');
   }
}