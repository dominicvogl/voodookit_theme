<?php

get_header();

if(have_posts()) {

	while(have_posts()) {
		the_post();
		the_title();
		the_content();
		// the_acf_modules();
	}

}

get_footer();
