<?php

get_header();

if(have_posts()) {
   while(have_posts()) {
      the_post();

      the_title();
      the_content();
      echo first_loop();

   }
}

get_footer();