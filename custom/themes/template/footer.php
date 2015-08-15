<?php

if ( current_user_can( 'administrator' ) ) {
   global $wpdb;
   echo "<pre>";
   print_r( $wpdb->queries );
   echo "</pre>";
}

wp_footer();