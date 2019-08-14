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
define( 'VOODOOKIT_INC_DIR', PARENT_DIR . '/inc' );
define( 'VOODOOKIT_BACKEND_DIR', VOODOOKIT_INC_DIR . '/backend' );
define( 'VOODOOKIT_FRONTEND_DIR', VOODOOKIT_INC_DIR . '/frontend' );
define( 'VOODOOKIT_FUNCTIONS_DIR', VOODOOKIT_INC_DIR . '/functions' );
define( 'VOODOOKIT_ACF_DIR', VOODOOKIT_FRONTEND_DIR . '/acf' );
define( 'VOODOOKIT_ACF_BLOCKS', VOODOOKIT_ACF_DIR . '/blocks' );
define( 'VOODOOKIT_STRUCTURE_DIR', VOODOOKIT_INC_DIR . '/structure' );
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
require_once( VOODOOKIT_BACKEND_DIR . '/admin.php' );
require_once( VOODOOKIT_BACKEND_DIR . '/customizer.php' );
require_once( VOODOOKIT_BACKEND_DIR . '/editor.php' );

// load frontend stuff
require_once( VOODOOKIT_FRONTEND_DIR . '/head.php' );
// load acf settings
require_once( VOODOOKIT_ACF_DIR . '/acf-option-pages.php' );
require_once( VOODOOKIT_ACF_DIR . '/acf-to-json.php' );
require_once( VOODOOKIT_ACF_BLOCKS . '/acf-gutenberg-blocks.php' );

// load helper
require_once( VOODOOKIT_HELPER_DIR . '/helper.php' );
// load shortcodes
require_once( VOODOOKIT_HELPER_DIR . '/shortcodes.php' );

// load structure
require_once ( VOODOOKIT_STRUCTURE_DIR . '/slideout.php');
require_once ( VOODOOKIT_STRUCTURE_DIR . '/header.php');
require_once ( VOODOOKIT_STRUCTURE_DIR . '/index.php');
require_once ( VOODOOKIT_STRUCTURE_DIR . '/footer.php');

// load hooks
require_once ( VOODOOKIT_FUNCTIONS_DIR . '/voodookit-hooks.php');
