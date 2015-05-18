<?php

get_header();

if(have_posts()) {
   while(have_posts()) {
      the_post();

      the_title();
      the_content();

      $fields = get_fields(CURRENT_PAGE_ID);

      bwrk_get_flexible_fields($fields['flexModules']);

   }
}

get_footer();