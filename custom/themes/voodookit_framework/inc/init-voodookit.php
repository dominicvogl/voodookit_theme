<?php
/**
 * The Voodookit Framework
 * Loading all parts of Voodookit Framework
 *
 * @package Voodookit
 * @author Dominic Vogl
 * @since 1.0.0
 */

/**
 * Define some Voodookit constants
 *
 * @since 1.0.0
 */

// template directorys
define( 'PARENT_DIR', get_template_directory() );
define( 'CHILD_DIR', get_stylesheet_directory() );

// voodookit directories
define( 'VOODOOKIT_RESSOURCES_DIR', PARENT_DIR . '/inc' );
define( 'VOODOOKIT_BACKEND_DIR', VOODOOKIT_RESSOURCES_DIR . '/backend' );
define( 'VOODOOKIT_FRONTEND_DIR', VOODOOKIT_RESSOURCES_DIR . '/frontend' );
define( 'VOODOOKIT_FUNCTIONS_DIR', VOODOOKIT_RESSOURCES_DIR . '/functions' );
define( 'VOODOOKIT_SETUP_DIR', VOODOOKIT_FUNCTIONS_DIR . '/setup' );
define( 'VOODOOKIT_HELPER_DIR', VOODOOKIT_FUNCTIONS_DIR . '/helper' );


/**
 * Load party of the Voodookit Framework
 *
 * @since 1.0.0
 */

// setup the template
require_once( VOODOOKIT_SETUP_DIR . '/setup.php' );
// load external scripts
require_once( VOODOOKIT_SETUP_DIR . '/script-loader.php' );

// load backend stuff
require_once( VOODOOKIT_BACKEND_DIR . '/editor.php' );

// load frontend stuff
require_once( VOODOOKIT_FRONTEND_DIR . '/head.php' );

// load helper
require_once( VOODOOKIT_HELPER_DIR . '/helper.php' );
// load shortcodes
require_once( VOODOOKIT_HELPER_DIR . '/shortcodes.php' );

