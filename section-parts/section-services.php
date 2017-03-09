<?php 
$hide_service_section = get_theme_mod('colelawson_hide_services_section');
$title = get_theme_mod('colelawson_service_title');
$description = get_theme_mod('colelawson_service_description');
// $array = get_theme_mod('colelawson_service_image');

$args = array(
		'numberposts' => 8,
		'offset' => 0,
		'category_name' => 'services',
		// 'orderby' => 'post_date',
		// 'order' => 'DESC',
		'include' => '',
		'exclude' => '',
		'meta_key' => '',
		'meta_value' =>'',
		'post_type' => 'post',
		'post_status' => 'draft, publish, future, pending, private',
		'suppress_filters' => true
	);

$recent_posts = wp_get_recent_posts($args, ARRAY_A);

if(!$hide_service_section){
	?>

	<section class="section-services" id="services-section">
		<div class="container">
			<div class="section-title">
				<h1><?php echo $title; ?></h1>
				<p> <?php echo esc_textarea($description); ?> </p>
			</div>

			<div class="service-wrapper">
				<?php 
				foreach ($recent_posts as $post) : setup_postdata($post);

				$post_id = $post['ID'];
					if(has_post_thumbnail($post_id)){
						$thumb = get_the_post_thumbnail( $post_id, array(80, 80), array('class' => 'post_thumbnail') );
						$link = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'single-post-thumbnail');
					}
				?>
				
				<div class="service-wrapper-item">
					<a href="<?php the_permalink($post_id)?>">
						<figure>
							<div class="img-overlay" style="background-image:url(<?php echo $link[0];?>)">
							</div>
						</figure>
						<div class="service-item-title"><?php echo $post['post_title']; ?></div>	
					</a>
				</div>

				<?php
				endforeach;
				wp_reset_postdata();
				?>
			</div>
		</div>
	</section>

	
	<?php
}

?>