<?php

function enqueue_styles_scripts() { 
	wp_enqueue_style('gfonts', '//fonts.googleapis.com/css?family=Raleway:300,400,700,900');
	wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css');
} 

add_action('wp_enqueue_scripts', 'enqueue_styles_scripts');

register_sidebar(
	array(
		'name' => __("Services Section", "colelawson"),
		'id' => 'servicesection',
		'description' => 'Front page only',
		'before_widget' => "<div class='servicesection'>",
		'after_widget' => "</div>"
	)
);


require(get_template_directory() . '/colelawson-service-widget.php');


// queue up the necessary js
function hrw_enqueue($hook){

	wp_enqueue_style('thickbox');
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_media();
	wp_enqueue_script('wptuts-upload');
	// moved the js to an external file, you may want to change the path
	wp_enqueue_script('hrw', '/wp-content/themes/colelawson/js/script.js', null, null, false);
}
add_action('admin_enqueue_scripts', 'hrw_enqueue');


?>