<?php
	// $language = $_COOKIE['pll_language'];
	// if($language == 'id'){
	// 	$lang = '_id';
	// }else{
	// 	$lang = '';
	// }

	// $hide_about_section = get_theme_mod('colelawson_hide_about_section');
	// $about_title = get_theme_mod('colelawson_about_title'.$lang);
	// $about_description = get_theme_mod('colelawson_about_description'.$lang);
	// $about_content = get_theme_mod('colelawson_about_content'.$lang);
	// $about_link = get_theme_mod('colelawson_about_link');

	$args = array(
		'numberposts' => 1,
		'offset' => 0,
		'category_name' => 'engaging',
		'include' => '',
		'exclude' => '',
		'meta_key' => '',
		'meta_value' =>'',
		'post_type' => 'post',
		'post_status' => 'draft, publish, future, pending, private',
		'suppress_filters' => true
	);

$engaging = wp_get_recent_posts($args, ARRAY_A);

	//if(!$hide_about_section){
?>

<?php //echo get_post($about[0]['ID']);?>
<section class="engaging-section" id="engaging-section">
	<div class="container">
		<div class="engaging-section-content-wrapper">
			<div class="engaging-section-content row">
				<div class="engaging-content home-content grid-7">
					<h1><?php echo $engaging[0]['post_title'] ?></h1>
					<p><?php echo apply_filters('the_content',$engaging[0]['post_content']); ?>

					<a href="<?php the_permalink($engaging[0]['ID']); ?>" class="read-more-link">Read Our Story</a>
				</div>

				<div class="engaging-description grid-5 outer">
					<div class="engaging-description-content home-description-content inner">
						<?php echo apply_filters('the_content', get_post_meta($engaging[0]['ID'], 'my_meta_box_text', true)); ?>	
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php //} ?>