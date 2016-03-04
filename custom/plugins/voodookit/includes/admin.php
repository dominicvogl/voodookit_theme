<?php

//
// Register ACF options page
// ----------------------------------------------------------------------------------------

function add_acf_option_pages()
{

    if( function_exists('acf_add_options_page') ) {

        acf_add_options_page(array(
           'page_title' 	=> 'Theme General Settings',
           'menu_title'	=> 'Theme Settings',
           'menu_slug' 	=> 'theme-general-settings',
           'capability'	=> 'edit_posts',
           'redirect'		=> false
        ));

        acf_add_options_sub_page(array(
           'page_title' 	=> 'Theme Header Settings',
           'menu_title'	=> 'Header',
           'parent_slug'	=> 'theme-general-settings',
        ));

        acf_add_options_sub_page(array(
           'page_title' 	=> 'Theme Footer Settings',
           'menu_title'	=> 'Footer',
           'parent_slug'	=> 'theme-general-settings',
        ));

    }
}

add_action('admin_menu', 'add_acf_option_pages');



//
// Admin Bar im Backend anpassen
// ----------------------------------------------------------------------------------------

function adjust_admin_bar() {
    /* Global */
    global $wp_admin_bar;

    /* Aktiv und Admin? */
    if ( !is_admin_bar_showing() or !is_admin() ) {
        return;
    }

    /* Einträge löschen */
    // $wp_admin_bar->remove_menu('view');
    //$wp_admin_bar->remove_menu('updates');
    $wp_admin_bar->remove_menu('wp-logo');
    //$wp_admin_bar->remove_menu('comments');
    // $wp_admin_bar->remove_menu('appearance');
    // $wp_admin_bar->remove_menu('view-site');
    // $wp_admin_bar->remove_menu('new-content');
    // $wp_admin_bar->remove_menu('my-account');

    /* Suche definieren */
    $form  = '<form action="' .esc_url( admin_url('edit.php') ). '" method="get" id="adminbarsearch">';
    $form .= '<input class="adminbar-input" name="s" tabindex="1" type="text" value="" maxlength="50" />';
    $form .= '<input type="submit" class="adminbar-button" value="' .__('Search'). '"/>';
    $form .= '</form>';

    /* Suche einbinden */
    $wp_admin_bar->add_menu(
        array(
            'parent' => 'top-secondary',
            'id'     => 'search',
            'title'  => $form,
            'meta'   => array(
                'class' => 'admin-bar-search'
            )
        )
    );
}



//
// Register Navigations
// ----------------------------------------------------------------------------------------

add_action('wp_before_admin_bar_render', 'adjust_admin_bar');

register_nav_menus( array(
    'main-nav' => 'Hauptnavigation',
    'sub-nav' => 'Unternavigation'
));

//
// Add theme support for post formats
// ----------------------------------------------------------------------------------------

// add_theme_support('post-formats', array('image'));



//
// ADD MIME SUPPORT FOR SVG's
// ----------------------------------------------------------------------------------------

function cc_mime_types( $mimes ){
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'bwrk_cc_mime_types' );