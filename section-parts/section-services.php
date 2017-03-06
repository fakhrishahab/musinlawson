<?php 
$hide_service_section = get_theme_mod('colelawson_hide_services_section');
$title = get_theme_mod('colelawson_service_title');
$description = get_theme_mod('colelawson_service_description');
$array = get_theme_mod('colelawson_service_image');


if($hide_service_section){
	?>
	<section class='section-services' id="services-section">
	<div>
		<h1> <?php echo $title; ?> </h1>
		<h3> <?php echo esc_textarea($description); ?> </h3>
	</div>

	<?php 
		if(!empty($array) && is_array($array)){

			foreach ($array as $key => $value) {
				$array[$key] = wp_parse_args($value, array(
					'title' => '',
					'image' => '',
					'link' => ''
				));
			?>

			<a href="<?php echo esc_url($array[$key]['link']); ?>">
				<div>
					<img src="<?php echo esc_url($array[$key]['image']['url']); ?>" > 
					<div><?php echo $array[$key]['title']; ?></div>
				</div>
			</a>
			<?php
			}
		}
	?>

	</section>
	<?php
}

?>