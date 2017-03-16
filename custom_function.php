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


register_sidebar(
	array(
		'name' => __('Language Widget', 'colelawson'),
		'id' => 'language_widget',
		'description' => 'Showing widget to choose language',
		'before_widget' => '<div class="languagewidget">',
		'after_widget' => '</div>'
	)
);

register_sidebar(
	array(
		'name' => __('Footer Location Widget', 'colelawson'),
		'id' => 'footer_location_widget',
		'description' => 'Show Location Office',
		'before_widget' => '<div class="footer_location_widget">',
		'after_widget' => '</div>'
	)
);

register_sidebar(
	array(
		'name' => __('Footer Enquiry Widget', 'colelawson'),
		'id' => 'footer_enquiry_widget',
		'description' => 'Show Enquiry Form',
		'before_widget' => '<div class="footer_enquiry_widget">',
		'after_widget' => '</div>'
	)
);

require(get_template_directory() . '/widgets/colelawson-service-widget.php');

function homepage_scripts(){
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script('jcookie', get_template_directory_uri() . '/js/jquery.cookie.js', null, $version, true);
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

function adding_custom_meta_boxes( $post ) {
    add_meta_box( 
        'my-meta-box',
        __( 'Quotes' ),
        'render_my_meta_box',
        'post',
        'normal',
        'default'
    );
}
add_action( 'add_meta_boxes_post', 'adding_custom_meta_boxes' );

function render_my_meta_box($post){
	global $post;
    $values = get_post_custom( $post->ID );
	// $values = get_post_custom( $post->ID );
	$text = isset( $values['my_meta_box_text'] ) ? esc_attr( $values['my_meta_box_text'][0] ) :'';

    // We'll use this nonce field later on when saving.
    wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
	?>
		<div style="width: 100%">
			<label for="my_meta_box_text">Quotes</label>
		</div>
		<div style="width: 100%">
			<textarea style="width:100%;min-height:150px" name="my_meta_box_text" id="my_meta_box_text"><?php echo $text; ?></textarea>	
		</div>
		
	<?php
}

add_action( 'save_post', 'cd_meta_box_save' );

function cd_meta_box_save($post_id){
	// Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
     
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post' ) ) return;

    // Make sure your data is set before trying to save it
    if( isset( $_POST['my_meta_box_text'] ) )
        update_post_meta( $post_id, 'my_meta_box_text', wp_kses( $_POST['my_meta_box_text'], $allowed ) );
}

function custom_search_form() {
?>
	<form method="get" class="custom_search_form" action="<?php echo get_site_url(); ?>/">
		<div class="custom_search_wrapper">
			<input class="custom_search_text" type="text" placeholder="Search" name="s" id="s" />
			<button type="submit"><i class="fa fa-search"></i></button>
			
		</div>
	</form>
<?php
}
add_action('custom_search_form', 'custom_search_form');


?>