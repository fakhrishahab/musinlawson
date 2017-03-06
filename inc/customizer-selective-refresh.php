<?php
function colelawson_customizer_load_template( $template_names ){
    $located = '';

    $is_child =  get_stylesheet_directory() != get_template_directory() ;
    foreach ( (array) $template_names as $template_name ) {
        if (  !$template_name )
            continue;

        if ( $is_child && file_exists( get_stylesheet_directory() . '/' . $template_name ) ) {  // Child them
            $located = get_stylesheet_directory() . '/' . $template_name;
            break;

        } elseif ( defined( 'COLELAWSON_PLUS_PATH' ) && file_exists( ONEPRESS_PLUS_PATH  . $template_name ) ) { // Check part in the plugin
            $located = ONEPRESS_PLUS_PATH . $template_name;
            break;
        } elseif ( file_exists( get_template_directory() . '/' . $template_name) ) { // current_theme
            $located =  get_template_directory() . '/' . $template_name;
            break;
        }
    }
    
    return $located;
}

function colelawson_customizer_partials($wp_customize){
	if( !isset($wp_customize->selective_refresh) ){
		return;
	}


	$selective_refresh_keys = array(

		// array(
		// 	'id' => 'services',
		// 	'selector' => '.section-services',
		// 	'settings' => array(
		// 		'colelawson_service_title',
		// 		'colelawson_service_description'
		// 	),
		// ),

	);

	$selective_refresh_keys = apply_filters('colelawson_customizer_partials_selective_refresh_keys', $selective_refresh_keys);

	foreach ($selective_refresh_keys as $section) {
		foreach ($section['settings'] as $key) {
			if($wp_customize->get_setting($key)){
				$wp_customize->get_setting($key)->transport = 'postMessage';
			}
		}

		$wp_customize->selective_refresh->add_partial('section-'.$section['id'], array(
				'selector' => $section['selector'],
				'settings' => $section['settings'],
				'render_callback' => 'colelawson_selective_refresh_render_section_content',
		))
	}

	$wp_customize->selective_refresh->add_partial( 'colelawson_service_image', array(
        'selector' => '.image-service',
        'settings' => array( 'colelawson_service_image' ),
        'render_callback' =>  'colelawson_get_service_image',
    ) );
	
}

// add_action('customize_register', 'colelawson_customizer_partials', 50);

function colelawson_selective_refresh_render_section_content($partial, $container_context = array()){
	echo $partial->id;
	$tpl = 'section-parts/'.$partial->id.'.php';
	$GLOBALS['colelawson_is_selective_refresh'] = true;
	$file = colelawson_customizer_load_template($tpl);
	if($file){
		include $file;
	}
}
?>