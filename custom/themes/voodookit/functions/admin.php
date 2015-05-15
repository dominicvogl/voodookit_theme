<?php

//
// Register ACF options page
// ----------------------------------------------------------------------------------------

if( function_exists('acf_add_options_page') ) {

    $page = acf_add_options_page(array(
        'page_title'    => 'Theme General Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));

}



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
    $wp_admin_bar->remove_menu('view');
    //$wp_admin_bar->remove_menu('updates');
    $wp_admin_bar->remove_menu('wp-logo');
    $wp_admin_bar->remove_menu('comments');
    $wp_admin_bar->remove_menu('appearance');
    $wp_admin_bar->remove_menu('view-site');
    $wp_admin_bar->remove_menu('new-content');
    // $wp_admin_bar->remove_menu('my-account')

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
// Register navigations
// ----------------------------------------------------------------------------------------

add_action('wp_before_admin_bar_render', 'adjust_admin_bar');


register_nav_menus( array(
    'main-nav' => 'Hauptnavigation',
    'sub-nav' => 'Unternavigation'
));



//
// Register footer
// ----------------------------------------------------------------------------------------

function remove_footer_admin() {

    if(function_exists('get_field')) {

        $html = '';
        $test = '';
        $repeater = get_field('repeater_footer_imprints', 'options');

        if( !empty($repeater) ) {

            foreach($repeater as $values) {

                $after = ', ';
                if(!empty($values['label'])) {
                    $html .= $values['label'].': ';
                }
                else {
                    $after  = '';
                }

                $shortvalue = str_replace(' ', '', $values['value']);

                if(strstr($values['value'], '@') == true) {
                    $html .= ' <a href="mailto:'.$values['value'].'">'.$values['value'].'</a>'.$after;
                }
                elseif(strstr($values['value'], 'www') == true) {
                    $html .= ' <a href="http://'.$values['value'].'">'.$values['value'].'</a>'.$after;
                }
                elseif(ctype_digit($shortvalue)) {
                    $html .= ' <a href="tel:'.$shortvalue.'">'.$values['value'].'</a>'.$after;
                }
                else {
                    $html .= $values['value'].$after;
                }
            }

        }

        else {
            $html = 'Entwickelt von <a href="https://www.bergwerk.ag" target="_blank">BERGWERK Werbeagentur GmbH</a> auf Basis von <a href="http://www.wordpress.org/" target="_blank">Wordpress</a>';
        }
    }

    else {
        $html = 'Entwickelt auf Basis von <a href="http://www.wordpress.org/" target="_blank">Wordpress</a>';
    }

    return $html;
}

add_filter('admin_footer_text', 'remove_footer_admin');



//
// Dashboard Spalten begrenzen
// ----------------------------------------------------------------------------------------

function shapeSpace_screen_layout_columns($columns) {
    $columns['dashboard'] = 2;
    return $columns;
}

function shapeSpace_screen_layout_dashboard() {
    return 2;
}

// Execute functions via filter
add_filter('screen_layout_columns', 'shapeSpace_screen_layout_columns');
add_filter('get_user_option_screen_layout_dashboard', 'shapeSpace_screen_layout_dashboard');



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
add_filter( 'upload_mimes', 'cc_mime_types' );