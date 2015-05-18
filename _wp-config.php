<?php

//
// Load database info and local development parameters
// ------------------------------------------------------------------------

//define( 'WP_LOCAL_DEV', true );
// Connect Database
define( 'DB_NAME', 'wp_devkit' );
define( 'DB_USER', 'root' );
define( 'DB_PASSWORD', 'root' );
define( 'DB_HOST', 'localhost' ); // Probably 'localhost'

// Define some other stuff
define('BWRK_TEMPLATE_VERSION', '2.0');

// Define Base URLS
define('WP_HOME','http://localhost');
define('WP_SITEURL','http://localhost/core');

//
// Custom Content Directory
// ------------------------------------------------------------------------

define( 'WP_CONTENT_DIR', dirname( __FILE__ ) . '/custom' );
define( 'WP_CONTENT_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/custom' );

//
// You almost certainly do not want to change these
// ------------------------------------------------------------------------

define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );

//
// Salts, for security
// Grab these from: https://api.wordpress.org/secret-key/1.1/salt
// ------------------------------------------------------------------------

define('AUTH_KEY',         '|?inxg*]rq;E_g@>9tV^YscQ&}X5Dm2J3nt2e+g8v7zP=uu.)DDv*=xg?6ZC?%j(');
define('SECURE_AUTH_KEY',  '~C|BtvkC`O=C|D$CYe|RumC|x%U0 `N?|_Y|72}e-Dk~$DAVYCk5Bc##L/3?-aVk');
define('LOGGED_IN_KEY',    '3Wq4i>&_nV`{/1nt/8hT+>Mc+n EAq|]tk;1U@CJ>,QT[,5x9$8ScTLGzK}Q!^tX');
define('NONCE_KEY',        'hQ$z>oL;zis[=^,$b#K8v~S7ea_f+94 7y.O{_2!w(!Hc14HpmCH1*&1;(j6_oMU');
define('AUTH_SALT',        '/^^|JdtH-%~?W(a=FvE WBAfo8fo9m:L&LO^](#$$H|qh6#~/Lz2$TwYtOExKJcE');
define('SECURE_AUTH_SALT', '}FBjZ;{9 v]d*SBe,+E<NY(PuxUUFSoF 9 O;[#pU0e_-T.L4h!` d!vbAD#aIP;');
define('LOGGED_IN_SALT',   '9B%vQD}?94jE3n}/R)I^X/q.TejG(lIKGa5Da=I7>K$HJwM5h5mdY;.v+<8|IZ$a');
define('NONCE_SALT',       '-+niI(r0PlsIgB>}9Am^S|y1<-|L2h+M|K~+f*9//aNtI1d{QSIefrr[?4|-#K+e');

//
// Table prefix
// Change this if you have multiple installs in the same database
// ------------------------------------------------------------------------

$table_prefix  = 'wp_';

//
// Defintions
// Leave blank for American English
// ------------------------------------------------------------------------

define( 'WPLANG', '' );

// Hide errors
ini_set( 'display_errors', 0 );
define( 'WP_DEBUG_DISPLAY', false );

// Disallow automatic core updates
define( 'AUTOMATIC_UPDATER_DISABLED', true );

// Disallow file modification in backend
define( 'DISALLOW_FILE_EDIT', true );
define( 'DISALLOW_FILE_MODS', true );

// Set Reviosions
define( 'WP_POST_REVISIONS', 3 );

// Debugging? Enable these. Can also enable them in local-config.php
// define( 'SAVEQUERIES', true );
// define( 'WP_DEBUG', true );

// Define memory limit
// define( 'WP_MEMORY_LIMIT', '96M' );

// Override file permissions
// define( 'FS_CHMOD_DIR', ( 0755 & ~ umask() ) );
// define( 'FS_CHMOD_FILE', ( 0644 & ~ umask() ) );

// Load a Memcached config if we have one
if ( file_exists( dirname( __FILE__ ) . '/memcached.php' ) )
	$memcached_servers = include( dirname( __FILE__ ) . '/memcached.php' );

// This can be used to programatically set the stage when deploying (e.g. production, staging)
define( 'WP_STAGE', '%%WP_STAGE%%' );
define( 'STAGING_DOMAIN', '%%WP_STAGING_DOMAIN%%' ); // Does magic in WP Stack to handle staging domain rewriting

// Bootstrap WordPress
if ( !defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/core/' );
require_once( ABSPATH . 'wp-settings.php' );