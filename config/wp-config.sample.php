<?php
/**
 * @var $hostname
 */
  

// ** MySQL settings - You can get this info from your web host ** //
define( 'DB_NAME', 'DBNAME' );
define( 'DB_USER', 'USER' );
define( 'DB_PASSWORD', 'USER' );
define( 'DB_HOST', 'localhost' ); // Probably 'localhost'

define('WP_HOME','http://localhost/');
define('WP_SITEURL','http://localhost/core');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */

// Schaltet den Debug Mode ein. Dadurch sind Fehler im Frontend sichtbar.
define( 'WP_DEBUG', true );

// Verhindert, dass Fehlermeldungen im Frontend sichtbar sind.
define( 'WP_DEBUG_DISPLAY', false );

// Zeige verschiedene Fehler an
// E_ALL
// E_ERROR | E_WARNING | E_PARSE | E_NOTICE
@ini_set( 'display_errors', 0 );

// Aktiviert das Logfile und legt es im Verzeichnis /wp-content/debug.log ab.
define( 'WP_DEBUG_LOG', true );

// Use dev versions of core JS and CSS files (only needed if you are modifying these core files)
define( 'SCRIPT_DEBUG', false );