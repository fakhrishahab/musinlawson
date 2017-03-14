<?php 
$hide_specialities_section = get_theme_mod('colelawson_hide_specialities_section');
$title = get_theme_mod('colelawson_specialies_title');
$video = get_theme_mod('colelawson_specialies_video');
$video_title = get_theme_mod('colelawson_specialities_video_description');
$description = get_theme_mod('colelawson_specialities_description');
$description_image = get_theme_mod('colelawson_specialities_description_image');
$slider_title = get_theme_mod('colelawson_specialities_slider_image_title');
$imageArr = get_theme_mod('colelawson_specialities_slider_image');

if(!$hide_specialities_section){
?>
	
	<section class="specialities-section" id="specialities-section">
		<div class="container">
			<div class="section-title">
				<h1><?php echo $title;?></h1>
			</div>

			<!-- <div class="row specialities-content-wrapper">
				<div class="grid-7">
					<div class="specialities-description-wrapper" style="background:url('<?php //echo $description_image; ?>')">
						<div class="specialities-description">
							<?php //echo esc_html($description); ?>
						</div>
					</div>
				</div>

				<div class="grid-5 specialities-right">
					<div class="specialities-video-wrapper">
						<iframe src='<?php //echo $video; ?>?showinfo=0' frameborder="0" allowfullscreen></iframe>

						<div class="specialities-video-title">
							<?php //echo esc_html($video_title); ?>
						</div>
					</div>

					<div class="specialities-slider-image-wrapper">
						<div class="slider-image-title">
							<?php //echo esc_html($slider_title); ?>
						</div>
						<div class="swiper-container">
							<div class="swiper-wrapper">
								<?php 
								//if(!empty($imageArr) && is_array($imageArr)){

									//foreach ($imageArr as $key => $value) {
										//$imageArr[$key] = wp_parse_args($value, array(
										//		'title' => '',
										//		'image' => '',
										//		'link' => ''
										//	)
										//);
										?>
											<div class="swiper-slide">
												<img src="<?php //echo $imageArr[$key]['image']['url'];?>" alt="">
											</div>
											
										<?php
									//};
								//}
									?>
							</div>

							<div class="btn-prev">
								<i class="fa fa-chevron-left"></i>
							</div>
							<div class="btn-next">
								<i class="fa fa-chevron-right"></i>
							</div>
						</div>
					</div>
				</div>
			</div> -->

			<div class="row specialities-content-wrapper">
				<div class="grid-7">
					<div class="specialities-video-wrapper">
						<iframe src='<?php echo $video; ?>?showinfo=0' frameborder="0" allowfullscreen></iframe>
						<div class="specialities-video-desc">
							<?php echo esc_html($video_title); ?>
						</div>
					</div>
				</div>
				<div class="grid-5 specialities-right">
					<div class="specialities-title">
						<?php echo esc_html($description); ?>
					</div>
					<div class="specialities-slider-image-wrapper">
						<div class="slider-image-title">
							<?php echo esc_html($slider_title); ?>
						</div>
						<div class="swiper-container">
							<div class="swiper-wrapper">
								<?php 
								if(!empty($imageArr) && is_array($imageArr)){

									foreach ($imageArr as $key => $value) {
										$imageArr[$key] = wp_parse_args($value, array(
												'title' => '',
												'image' => '',
												'link' => ''
											)
										);
										?>
											<div class="swiper-slide">
												<img src="<?php echo $imageArr[$key]['image']['url'];?>" alt="">
											</div>
											
										<?php
									};
								}
									?>
							</div>

							<div class="btn-prev">
								<i class="fa fa-chevron-left"></i>
							</div>
							<div class="btn-next">
								<i class="fa fa-chevron-right"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

<?php	
}
?>
<!-- 
<section id="specialities-section">
	<div>
		This is specialities section
	</div>	
</section> -->