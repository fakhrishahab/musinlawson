<?php
/**
 * Template part for displaying services page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package colelawson
 */
	
	$link = wp_get_attachment_image_src(get_post_thumbnail_id(the_ID()), 'thumbnail-medium');
	// var_dump($link);

	$args = array(
			'numberposts' => 8,
			'offset' => 0,
			'category_name' => 'services, service',
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

	$service_list = wp_get_recent_posts($args, ARRAY_A);
?>

<div class="jumbotron-header outer" style="background-image:url(<?php echo $link[0];?>)">
	<div class="jumbotron-header-title inner">
		<h1><?php the_title();?></h1>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="grid-9 border-right-c8">
			<div class="single-content">
				<?php sprintf(the_content());?>
			</div>
		</div>
		<div class="grid-3 border-left-c8">
			<ul class="content-sidebar-menu">
				<li class="title">Our Services</li>
				<?php
				foreach($service_list as $service) : setup_postdata($service);
				?>
					<li><a href="<?php the_permalink($service['ID']);?>"><?php echo $service['post_title'];?></a></li>
				<?php
				endforeach;
				wp_reset_postdata();
				?>
			</ul>
		</div>
	</div>
</div>
