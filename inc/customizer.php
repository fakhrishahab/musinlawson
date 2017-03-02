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

    /*------------------------------------------------------------------------*/
    /*  Site Options
    /*------------------------------------------------------------------------*/
	/*------------------------------------------------------------------------*/
    /*  Site Options
    /*------------------------------------------------------------------------*/
		$wp_customize->add_panel( 'colelawson_options',
			array(
				'priority'       => 22,
			    'capability'     => 'edit_theme_options',
			    'theme_supports' => '',
			    'title'          => esc_html__( 'Frontpage Content', 'onepress' ),
			    'description'    => '',
			)
		);

		/* Services Settings
		----------------------------------------------------------------------*/
		$wp_customize->add_section( 'colelawson_services_settings' ,
			array(
				'priority'    => 3,
				'title'       => esc_html__( 'Services', 'onepress' ),
				'description' => '',
				'panel'       => 'colelawson_options',
			)
		);

			// Service Title
			$wp_customize->add_setting( 'colelawson_service_title',
				array(
					'sanitize_callback' => 'sanitize_text_field',
					'default'           => esc_html__( 'Service Title', 'colelawson' ),
					'transport'			=> 'postMessage',
				)
			);
			$wp_customize->add_control( 'colelawson_service_title',
				array(
					'label'       => esc_html__('Service Title', 'colelawson'),
					'section'     => 'colelawson_services_settings',
					'description' => ''
				)
			);

			// Service Description
			$wp_customize->add_setting( 'colelawson_service_description',
				array(
					'sanitize_callback' => 'sanitize_text_field',
					'default'           => esc_html__( 'Service Description', 'colelawson' ),
					'transport'			=> 'postMessage'
				)
			);
			$wp_customize->add_control( 'colelawson_service_description',
				array(
					'label'       => esc_html__('Service Description', 'colelawson'),
					'section'     => 'colelawson_services_settings',
					'description' => '',
					'type'		  => 'textarea'
				)
			);

			// $wp_customize->add_setting('colelawson_service_image_upload',
			// 	array(
			// 		'sanitize_callback' => 'sanitize_text_field',
			// 		'transport'			=> 'postMessage'
			// 	)
			// );

			// $wp_customize->add_control(
			// 	new WP_Customize_Upload_Control(
			// 		$wp_customize,
			// 		'colelawson_service_image_upload',
			// 		array(
			// 			'label'      => esc_html__( 'Service Image', 'colelawson' ),
			// 			'section'    => 'colelawson_services_settings'
			// 		)
			// 	)
			// );

			// Service Image
			$wp_customize->add_setting('colelawson_service_image',
				array(
					'sanitize_callback' => 'colelawson_sanitize_repeatable_data_field',
					'transport' 		=> 'postMessage'
				)
			);

			$wp_customize->add_control(
				new Colelawson_Customize_Repeatable_Control(
					$wp_customize,
					'colelawson_service_image',
					array(
						'label'			=> esc_html__('Service Images', 'colelawson'),
						'description'	=> '',
						'section'		=> 'colelawson_services_settings',
                        'live_title_id' => 'network', // apply for unput text and textarea only
                        'title_format'  => esc_html__('[live_title]', 'colelawson'), // [
						'max_item'		=> 8,
						'limited_msg' 	=> wp_kses_post( 'Upgrade to <a target="_blank" href="https://www.famethemes.com/plugins/onepress-plus/?utm_source=theme_customizer&utm_medium=text_link&utm_campaign=onepress_customizer#get-started">OnePress Plus</a> to be able to add more items and unlock other premium features!', 'onepress' ),
						'fields'    => array(
                            'network'  => array(
                                'title' => esc_html__('Service Title', 'colelawson'),
                                'type'  =>'text',
                            ),
                            'user_id' => array(
								'title' => esc_html__('Image', 'colelawson'),
								'type'  =>'media',
								'desc'  => '',
							),
                            'link'  => array(
                                'title' => esc_html__('URL', 'colelawson'),
                                'type'  =>'text',
                            ),
                        ),
					)
				)
			);




	/**
	 * Hook to add other customize
	 */
	do_action( 'colelawson_customize_after_register', $wp_customize );
}

add_action( 'customize_register', 'colelawson_customize_register' );

function colelawson_sanitize_text( $string ) {
	return wp_kses_post( balanceTags( $string ) );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function colelawson_customize_preview_js() {
	wp_enqueue_script( 'colelawson_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
// add_action( 'customize_preview_init', 'colelawson_customize_preview_js' );
