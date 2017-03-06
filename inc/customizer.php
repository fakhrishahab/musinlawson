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
		$wp_customize->add_panel( 'colelawson_options',
			array(
				'priority'       => 22,
			    'capability'     => 'edit_theme_options',
			    'theme_supports' => '',
			    'title'          => esc_html__( 'Frontpage Content', 'onepress' ),
			    'description'    => '',
			)
		);

		/* About Us 
		----------------------------------------------------------------------*/

		$wp_customize->add_section('colelawson_about_section',
			array(
				'priority' => 1,
				'title' => esc_html__('About', 'colelawson'),
				'description' => '',
				'panel' => 'colelawson_options'
			)
		);

			$show_about = get_theme_mod('colelawson_hide_about_section');

			$wp_customize->add_setting('colelawson_hide_about_section', 
				array(
					'sanitize_callback' => 'colelawson_sanitize_checkbox',
					'default' => $show_about ? 1 : 0,
				)
			);

			$wp_customize->add_control(
		        'colelawson_hide_about_section',
		        array(
		            'label' 		=> esc_html__('Hide About Section', 'colelawson'),
		            'section' 		=> 'colelawson_about_section',
		            'type'          => 'checkbox',
		        )
		    );

			// About Title
			$wp_customize->add_setting( 'colelawson_about_title',
				array(
					'sanitize_callback' => 'sanitize_text_field',
					'default'           => esc_html__( 'Title', 'colelawson' ),
					'transport'			=> 'postMessage',
				)
			);
			$wp_customize->add_control( 'colelawson_about_title',
				array(
					'label'       => esc_html__('Title', 'colelawson'),
					'section'     => 'colelawson_about_section',
					'description' => ''
				)
			);

			// About Description
			$wp_customize->add_setting( 'colelawson_about_description',
				array(
					'sanitize_callback' => 'sanitize_text_field',
					'default'           => esc_html__( 'Description', 'colelawson' ),
					'transport'			=> 'postMessage',
				)
			);
			$wp_customize->add_control( 'colelawson_about_description',
				array(
					'label'       => esc_html__('Description', 'colelawson'),
					'section'     => 'colelawson_about_section',
					'description' => '',
					'type'		  => 'textarea'
				)
			);

			// About Content
			$wp_customize->add_setting( 'colelawson_about_content',
				array(
					'sanitize_callback' => 'sanitize_text_field',
					'default'           => esc_html__( 'Content', 'colelawson' ),
					'transport'			=> 'postMessage',
				)
			);
			$wp_customize->add_control( 'colelawson_about_content',
				array(
					'label'       => esc_html__('Content', 'colelawson'),
					'section'     => 'colelawson_about_section',
					'description' => '',
					'type'		  => 'textarea'
				)
			);

			// About Link
			$wp_customize->add_setting( 'colelawson_about_link',
				array(
					'sanitize_callback' => 'sanitize_text_field',
					// 'default'           => esc_html__( 'Link', 'colelawson' ),
					'transport'			=> 'postMessage',
				)
			);
			$wp_customize->add_control( 'colelawson_about_link',
				array(
					'label'       => esc_html__('Link', 'colelawson'),
					'section'     => 'colelawson_about_section',
					'description' => '',
					'type' => 'dropdown-pages'
				)
			);

		/* Services Settings
		----------------------------------------------------------------------*/
		$wp_customize->add_section( 'colelawson_services_settings' ,
			array(
				'priority'    => 3,
				'title'       => esc_html__( 'Services', 'colelawson' ),
				'description' => '',
				'panel'       => 'colelawson_options',
			)
		);

			$show_services = get_theme_mod('colelawson_hide_services_section');

			$wp_customize->add_setting( 'colelawson_hide_services_section',
		        array(
		            'sanitize_callback' => 'colelawson_sanitize_checkbox',
		            'default'           => $show_services ? 1: 0,
		        )
		    );

		    $wp_customize->add_control(
		        'colelawson_hide_services_section',
		        array(
		            'label' 		=> esc_html__('Hide Service Section', 'colelawson'),
		            'section' 		=> 'colelawson_services_settings',
		            'type'          => 'checkbox',
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
                        'live_title_id' => 'title', // apply for unput text and textarea only
                        'title_format'  => esc_html__('[live_title]', 'colelawson'), // [
						'max_item'		=> 8,
						'limited_msg' 	=> wp_kses_post( 'Upgrade to <a target="_blank" href="https://www.famethemes.com/plugins/onepress-plus/?utm_source=theme_customizer&utm_medium=text_link&utm_campaign=onepress_customizer#get-started">OnePress Plus</a> to be able to add more items and unlock other premium features!', 'onepress' ),
						'fields'    => array(
                            'title'  => array(
                                'title' => esc_html__('Service Title', 'colelawson'),
                                'type'  =>'text',
                            ),
                            'image' => array(
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
