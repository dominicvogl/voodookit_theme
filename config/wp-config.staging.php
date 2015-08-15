<?php
/**
 * Development environment config settings
 *
 * Enter any WordPress config settings that are specific to this environment 
 * in this file.
 * 
 * @package    Studio 24 WordPress Multi-Environment Config
 * @version    1.0
 * @author     Studio 24 Ltd  <info@studio24.net>
 */
  

// ** MySQL settings - You can get this info from your web host ** //
define( 'DB_NAME', 'kd_zaigler' );
define( 'DB_USER', 'root_extern' );
define( 'DB_PASSWORD', '4,19slepedC8LCP*2013' );
define( 'DB_HOST', '192.168.189.201' ); // Probably 'localhost'

define('WP_HOME','http://localhost');
define('WP_SITEURL','http://localhost/core');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */

define('WP_DEBUG', true);
define('WP_DEBUG_DISPLAY', true);