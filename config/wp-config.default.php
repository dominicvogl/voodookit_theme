<?php
/**
 * Default config settings
 *
 * Enter any WordPress config settings that are default to all environments
 * in this file. These can then be overridden in the environment config files.
 * 
 * Please note if you add constants in this file (i.e. define statements) 
 * these cannot be overridden in environment config files.
 * 
 * @package    Studio 24 WordPress Multi-Environment Config
 * @version    1.0
 * @author     Studio 24 Ltd  <info@studio24.net>
 */

// Define some other stuff
define('TEMPLATE_VERSION', '2.0');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'v w`;B,8#q+g:bo0lffe#R,o>//W3E+,caXW|%+e1U3P^0Z>h%d(wg+A>&[#+Tlo');
define('SECURE_AUTH_KEY',  '1-*qS#C#GBFT+q#!p|:+{R{G+gH#,$rBEcS~gW+<|d`0*@S#Sw)$|rer8%=_q>-G');
define('LOGGED_IN_KEY',    '-G;V41h]]p8~/`rp7i}c!*LD?*oysTGi9/96M:-$Dj7&|YP}]TQYWLhl|TeN.@R$');
define('NONCE_KEY',        'Ea0zJKMk YY#9N-r~4i%Ri9opdhT9`_P|!p>z/_Qrj;bp5%Y|vK?OC)VKkx2u{=%');
define('AUTH_SALT',        'p4U8yOyD2$0:%.Q+0;yC-M5:dJ*X;JfMV(zVM{>$Wj]Ua{uZ)@2J|+N`eQx`irGc');
define('SECURE_AUTH_SALT', 'luK{dU09sYX`Tt^_#;Ww`# 4{#:[raazSZuJZMK/;M<bt~cmQ[wrg2@uq2@/()NR');
define('LOGGED_IN_SALT',   '<.bC+|ew,h6%QU5OcHg;0q=K|f17QgoG,m~!Z~P![kj+4g6sulSe)_|52(s-E ko');
define('NONCE_SALT',       ';c(a]L|Hzn,.fF:2YI?@Dr:KytN`FS#x%`;{~<)40:;h`!SEU+t)$<o9%1?P):`n');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */

define('WPLANG', '');
define('DISALLOW_FILE_EDIT', true);

# Disable all core updates:
define( 'WP_AUTO_UPDATE_CORE', false );

// Disable all automatic Wordpress updates
define( 'AUTOMATIC_UPDATER_DISABLED', true );

// Define home and siteurl's
define('WP_HOME','http://'.$_SERVER['HTTP_HOST'].'/');
define('WP_SITEURL','http://'.$_SERVER['HTTP_HOST'].'/core');

// Post Revisions
define( 'WP_POST_REVISIONS', 3 );

// Set Cookie Domain
// define( 'COOKIE_DOMAIN', 'www.example.com' );

// Set Wordpress memory limit
// define( 'WP_MEMORY_LIMIT', '128M' );

// Show all defined constants
// print_r( @get_defined_constants() );
