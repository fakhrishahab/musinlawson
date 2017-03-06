<?php
	$hide_about_section = get_theme_mod('colelawson_hide_about_section');
	$about_title = get_theme_mod('colelawson_about_title');
	$about_description = get_theme_mod('colelawson_about_description');
	$about_content = get_theme_mod('colelawson_about_content');
	$about_link = get_theme_mod('colelawson_about_link');

	if(!$hide_about_section){
?>


<section class="about-section" id="about-section">
	<h1><?php echo $about_title; ?></h1>
	<div class="about-section-content">
		<div class="about-content">
			<?php echo esc_textarea($about_content); ?>

			<a href="<?php echo $about_link; ?>">Read Our Story</a>
		</div>

		<div class="about-description">
			<?php echo $about_description; ?>
		</div>
	</div>
</section>
<?php } ?>