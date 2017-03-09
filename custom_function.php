<?php

$theme = wp_get_theme();
$version = $theme->get( 'Version' );

function enqueue_styles_scripts() { 
	wp_enqueue_style('gfonts', 'https://fonts.googleapis.com/css?family=Poly:400,400i|Source+Sans+Pro:400,400i,600,600i,700,700i');
	wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css');
	wp_enqueue_style('swiper','https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.1/css/swiper.min.css');
} 

add_action('wp_enqueue_scripts', 'enqueue_styles_scripts');

register_sidebar(
	array(
		'name' => __("Header Widget", "colelawson"),
		'id' => 'headerwidget',
		'description' => 'Front page only',
		'before_widget' => "<div class='headerwidget'>",
		'after_widget' => "</div>"
	)
);


require(get_template_directory() . '/widgets/colelawson-service-widget.php');

function homepage_scripts(){
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script('scroll', get_template_directory_uri() . '/js/smooth-scroll.js', array('jquery'), $version, true);
	wp_enqueue_script('swiper', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.1/js/swiper.jquery.js', array('jquery'), $version, true);
	wp_enqueue_script('nav', get_template_directory_uri() .'/js/custom_navigation.js', array('jquery'), $version, true);
}

add_action('wp_enqueue_scripts', 'homepage_scripts');


// queue up the necessary js
function hrw_enqueue($hook){
	wp_enqueue_style('thickbox');
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'onepress-js-plugins', get_template_directory_uri() . '/js/plugins.js', array(), $version, true );
	// wp_enqueue_script( 'onepress-js-theme', get_template_directory_uri() . '/js/theme.js', array(), $version, true );
    wp_enqueue_script( 'jquery-ui-sortable' );
    wp_enqueue_script( 'wp-color-picker' );
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_style( 'onepress-customizer',  get_template_directory_uri() . '/css/customizer.css' );
	wp_enqueue_media();
	wp_enqueue_script('wptuts-upload');
	// moved the js to an external file, you may want to change the path
	wp_enqueue_script('hrw', get_template_directory_uri() . '/js/script.js', null, $version, true);
	wp_enqueue_script('hrws', get_template_directory_uri() . '/js/customizer.js', null, $version, true);
}

function cus_enqueue($hook){

	// wp_enqueue_style('thickbox');
	// wp_enqueue_script('media-upload');
	// wp_enqueue_script('thickbox');
	// wp_enqueue_media();
	// wp_enqueue_script('wptuts-upload');
	// moved the js to an external file, you may want to change the path
	wp_enqueue_script('hrw', '/wp-content/themes/colelawson/js/customizer.js', null, 1.0, true);
}
add_action('admin_enqueue_scripts', 'hrw_enqueue');


function custom_search_form() {
?>
	<form method="get" class="custom_search_form" action="<?php bloginfo('home'); ?>/">
		<div class="custom_search_wrapper">
			<input class="custom_search_text" type="text" placeholder="Search" name="s" id="s" />
			<i class="fa fa-search"></i>
		</div>
	</form>
<?php
}
add_action('custom_search_form', 'custom_search_form');
?>