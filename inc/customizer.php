<?php
/**
 * colelawson Theme Customizer
 *
 * @package colelawson
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function colelawson_customize_register( $wp_customize ) {

	// Load custom controls.
	require get_template_directory() . '/inc/customizer-controls.php';

	// Custom WP default control & settings.
	$wp_customize->get_section( 'title_tagline' )->title = esc_html__('Site Title, Tagline & Logo', 'colelawson');
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/**
	 * Hook to add other customize
	 */
	do_action( 'colelawson_customize_before_register', $wp_customize );

	/*------------------------------------------------------------------------*/
    /*  Site Identity.
    /*------------------------------------------------------------------------*/

    $is_old_logo = get_theme_mod( 'colelawson_site_image_logo' );

    $wp_customize->add_setting( 'colelawson_hide_sitetitle',
        array(
            'sanitize_callback' => 'colelawson_sanitize_checkbox',
            'default'           => $is_old_logo ? 1: 0,
        )
    );
    $wp_customize->add_control(
        'colelawson_hide_sitetitle',
        array(
            'label' 		=> esc_html__('Hide site title', 'colelawson'),
            'section' 		=> 'title_tagline',
            'type'          => 'checkbox',
        )
    );

    $wp_customize->add_setting( 'colelawson_hide_tagline',
        array(
            'sanitize_callback' => 'colelawson_sanitize_checkbox',
            'default'           => $is_old_logo ? 1: 0,
        )
    );
    $wp_customize->add_control(
        'colelawson_hide_tagline',
        array(
            'label' 		=> esc_html__('Hide site tagline', 'colelawson'),
            'section' 		=> 'title_tagline',
            'type'          => 'checkbox',

        )
    );

}
add_action( 'customize_register', 'colelawson_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function colelawson_customize_preview_js() {
	wp_enqueue_script( 'colelawson_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'colelawson_customize_preview_js' );
