<?php
/**
 * evolution Theme Customizer
 *
 * @package evolution
 */

/**
 * Set the Customizer
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function evolution_customize_register( $wp_customize ) {

	class evolution_Read_Me extends WP_Customize_Control {
		public function render_content() {
			?>
			<div class="evolution-read-me">
				<p><?php esc_html_e( 'Thank you for using the Evolution Framework.', 'evolution' ); ?></p>
				<h3><?php esc_html_e( 'Documentation', 'evolution' ); ?></h3>
				<p class="evolution-read-me-text"><?php esc_html_e( 'For instructions on theme configuration, please see the documentation.', 'evolution' ); ?></p>
				<p class="evolution-read-me-link"><a href="<?php echo esc_url( __( 'https://andreas-hecht.com/docs/evolution/', 'evolution' ) ); ?>" target="_blank"><?php esc_html_e( 'Theme Documentation', 'evolution' ); ?></a></p>
			</div>
			<?php
		}
	}

	class evolution_Upgrade extends WP_Customize_Control {
		public function render_content() {
			esc_html_e( '', 'evolution' );
		}
	}

	// Site Identity
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	$wp_customize->add_setting( 'evolution_hide_blogdescription', array(
		'default'           => '',
		'sanitize_callback' => 'evolution_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'evolution_hide_blogdescription', array(
		'label'   => esc_html__( 'Hide Tagline', 'evolution' ),
		'section' => 'title_tagline',
		'type'    => 'checkbox',
	) );

	// READ ME
	$wp_customize->add_section( 'evolution_read_me', array(
		'title'    => esc_html__( 'IMPORTANT TO READ', 'evolution' ),
		'priority' => 1,
	) );
	$wp_customize->add_setting( 'evolution_read_me_text', array(
		'default'           => '',
		'sanitize_callback' => 'evolution_sanitize_checkbox',
	) );
	$wp_customize->add_control( new evolution_Read_Me( $wp_customize, 'evolution_read_me_text', array(
		'section'  => 'evolution_read_me',
		'priority' => 1,
	) ) );

	// Logo
	$wp_customize->add_section( 'evolution_logo', array(
		'title'       => esc_html__( 'Logo', 'evolution' ),
		'description' => esc_html__( 'In order to use a retina logo image, you must have a version of your logo that is doubled in size.', 'evolution' ),
		'priority'    => 55,
	) );
	$wp_customize->add_setting( 'evolution_logo', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw'
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'evolution_logo', array(
		'label'    => esc_html__( 'Upload Logo', 'evolution' ),
		'section'  => 'evolution_logo',
		'priority' => 11,
	) ) );

	// Footer ############################################################################################################

	$wp_customize->add_section( 'evolution_footer_options', array(
		'title'       => esc_html__( 'Footer', 'evolution' ),
		'description' => esc_html__( 'You can set the footer text and hide the theme credits from here.', 'evolution' ),
		'priority'    => 90,
	) );
    $wp_customize->add_setting('evolution_footer_hide', array(
        'default'           => '',
        'sanitize_callback' => 'evolution_checkbox_sanitize',
        'capability' => 'edit_theme_options',
        'priority' => 1
    ));
	$wp_customize->add_setting( 'evolution_footer_logo', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw'
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'evolution_footer_logo', array(
		'label'    => esc_html__( 'Upload additional footer logo (uses main logo from header by default)', 'evolution' ),
		'section'  => 'evolution_footer_options',
		'priority' => 11,
	) ) );

    // Die Eingabemöglichkeit erstellen
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        "evolution_footer_hide",
        array(
            "label" => __("Hide the theme credits", "evolution"),
            "section" => "evolution_footer_options",
            "settings" => "evolution_footer_hide",
            "type" => "checkbox",
        )
    ));
    $wp_customize->add_setting('evolution_footer_text', array(
        'default'           => '',
        'sanitize_callback' => 'evolution_textarea_sanitize',
        'capability' => 'edit_theme_options',
        'priority' => 2
    ));

    // Die Eingabemöglichkeit erstellen
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        "evolution_footer_text",
        array(
            "label" => __("Custom footer text. HTML allowed.", "evolution"),
            "section" => "evolution_footer_options",
            "settings" => "evolution_footer_text",
            "type" => "textarea",
        )
    ));

	// Menus
	$wp_customize->add_setting( 'evolution_hide_navigation', array(
		'default'           => '',
		'sanitize_callback' => 'evolution_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'evolution_hide_navigation', array(
		'label'    => esc_html__( 'Hide Main Navigation', 'evolution' ),
		'section'  => 'menu_locations',
		'type'     => 'checkbox',
		'priority' => 1,
	) );
	$wp_customize->add_setting( 'evolution_hide_search', array(
		'default'           => '',
		'sanitize_callback' => 'evolution_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'evolution_hide_search', array(
		'label'    => esc_html__( 'Hide Search on Main Navigation', 'evolution' ),
		'section'  => 'menu_locations',
		'type'     => 'checkbox',
		'priority' => 2,
	) );
}
add_action( 'customize_register', 'evolution_customize_register' );
