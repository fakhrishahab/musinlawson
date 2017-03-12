<?php
$hide_location = get_theme_mod('colelawson_hide_location_section');
$arrLocation = get_theme_mod('colelawson_location_detail');
?>
<section class="contact-section" id="contact-section">
	<div class="container row">
		<div class="grid-8">
			<div class="contact-location">
				<div class="section-title">
					<h1>Contact</h1>
				</div>
				
				<div class="location-wrapper">
					<div class="row">
					<?php
					if(!empty($arrLocation) && is_array($arrLocation) ){
						// echo var_dump($arrLocation);
						foreach ($arrLocation as $key => $value) {
							$arrLocation[$key] = wp_parse_args($value, array(
									'country' => '',
									'description' => '',
									'latitude' => '',
									'longitude' => ''
								)
							);
						?>
						
							<div class="grid-6">
								<div class="location-info">
									<h2><?php echo $arrLocation[$key]['country']; ?></h2>
									<div class="location-desc">
										<?php echo htmlspecialchars_decode(esc_html($arrLocation[$key]['description'])); ?>
									</div>
								</div>
								
							</div>
							

						<?php
						}
					}
					?>
					</div>	

					<div class="row">
					<?php 
					if(!empty($arrLocation) && is_array($arrLocation) ){
						// echo var_dump($arrLocation);
						foreach ($arrLocation as $key => $value) {
							$arrLocation[$key] = wp_parse_args($value, array(
									'country' => '',
									'description' => '',
									'latitude' => '',
									'longitude' => ''
								)
							);
						?>
						<div class="grid-6">
							<div class="location-map"
								id="location-map<?php echo $key;?>"data-lat="<?php echo $arrLocation[$key]['latitude'];?>"
								data-lng="<?php echo $arrLocation[$key]['longitude'];?>">
									
							</div>
						</div>
					<?php
						}
					}
					?>
					</div>
				</div>
				
			</div>
		</div>
		<div class="grid-4 footer-enquiry">

			<?php 
				if(is_dynamic_sidebar('footer_enquiry_widget')){
					dynamic_sidebar('footer_enquiry_widget');
				}
			?>
		</div>
		
	</div>
</section>