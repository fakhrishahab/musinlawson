<?php
	$hide_about_section = get_theme_mod('colelawson_hide_about_section');
	$about_title = get_theme_mod('colelawson_about_title');
	$about_description = get_theme_mod('colelawson_about_description');
	$about_content = get_theme_mod('colelawson_about_content');
	$about_link = get_theme_mod('colelawson_about_link');

	if(!$hide_about_section){
?>


<section class="about-section" id="about-section">
	<div class="container">
		<div class="about-section-content-wrapper">
			<div class="about-section-content row">
				<div class="about-content grid-7">

					<h1><?php echo $about_title; ?></h1>
					<?php echo htmlspecialchars_decode(esc_html($about_content)); ?>

					<a href="<?php echo $about_link; ?>" class="read-more-link">Read Our Story</a>
				</div>

				<div class="about-description grid-5">
					<?php echo htmlspecialchars_decode(esc_html($about_description)); ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php } ?>