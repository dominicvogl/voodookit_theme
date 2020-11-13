<?php
/**
 * The Voodookit Framework
 * Loading all parts of Voodookit Framework
 *
 * @package Voodookit
 * @author Dominic Vogl
 * @since 1.0.0
 * @version 1.2
 */


/**
 * Define some Voodookit constants
 * @since 1.0.0
 * @version 1.2
 */

define( 'VOODOOKIT_INC_DIR', '/inc' );
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
 * @since 1.0.0
 */

// setup template
voodookit_load_template_file( VOODOOKIT_SETUP_DIR . '/setup.php' ); // setup the template
voodookit_load_template_file( VOODOOKIT_SETUP_DIR . '/script-loader.php' ); // load external scripts

// load backend stuff
voodookit_load_template_file( VOODOOKIT_BACKEND_DIR . '/admin.php' );
voodookit_load_template_file( VOODOOKIT_BACKEND_DIR . '/customizer.php' );
voodookit_load_template_file( VOODOOKIT_BACKEND_DIR . '/editor.php' );

// load frontend stuff
voodookit_load_template_file( VOODOOKIT_FRONTEND_DIR . '/head.php' );
voodookit_load_template_file( VOODOOKIT_FRONTEND_DIR . '/images.php' );
voodookit_load_template_file( VOODOOKIT_FRONTEND_DIR . '/navigation.php' );

// extend core blocks
voodookit_load_template_file( VOODOOKIT_FRONTEND_DIR . '/blocks/blocks.php' );

// load acf settings
voodookit_load_template_file( VOODOOKIT_ACF_DIR . '/acf-option-pages.php' );
voodookit_load_template_file( VOODOOKIT_ACF_DIR . '/acf-to-json.php' );
voodookit_load_template_file( VOODOOKIT_ACF_BLOCKS . '/acf-gutenberg-blocks.php' );

// load helper
voodookit_load_template_file( VOODOOKIT_HELPER_DIR . '/helper.php' );

// load shortcodes
voodookit_load_template_file( VOODOOKIT_HELPER_DIR . '/shortcodes.php' );

// load custom nav walker
voodookit_load_template_file( VOODOOKIT_HELPER_DIR . '/nav-walker.php' );


// load structure
voodookit_load_template_file( VOODOOKIT_STRUCTURE_DIR . '/slideout.php');
voodookit_load_template_file( VOODOOKIT_STRUCTURE_DIR . '/header.php');
voodookit_load_template_file( VOODOOKIT_STRUCTURE_DIR . '/index.php');
voodookit_load_template_file(VOODOOKIT_STRUCTURE_DIR . '/sidebar.php');
voodookit_load_template_file(VOODOOKIT_STRUCTURE_DIR . '/footer.php');

// load hooks
voodookit_load_template_file(VOODOOKIT_FUNCTIONS_DIR . '/voodookit-hooks.php');
