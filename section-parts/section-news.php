<?php
$category_name = 'news';
$args = array(
		'numberposts' => 3,
		'offset' => 0,
		'category_name' => $category_name,
		'orderby' => 'post_date',
		'order' => 'DESC',
		'include' => '',
		'exclude' => '',
		'meta_key' => '',
		'meta_value' =>'',
		'post_type' => 'post',
		'post_status' => 'draft, publish, future, pending, private',
		'suppress_filters' => true
	);

$recent_posts = wp_get_recent_posts($args, ARRAY_A);
$category_id = get_cat_ID($category_name);
?>
<section class="news-section" id="news-section">
	<div class="container">
		<div class="section-title">
			<h1><?php echo pll__('News')?></h1>
			<!-- <p>Check here for the latest updates from Musin & Lawson Communications.</p> -->
			<a class="read-more-link" href="<?php echo get_permalink( get_option('page_for_posts' ) );?>"><?php echo pll__('See All');?></a>			
		</div>

		<div class="news-wrapper">
			<?php 
			foreach ($recent_posts as $post) : setup_postdata($post);
				$link = wp_get_attachment_image_src(get_post_thumbnail_id($post['ID']), 'single-post-thumbnail');

				// var_dump(wp_get_post_tags($post['ID']));
				// echo 'test';
				// // echo var_dump($post);
				// $t = wp_get_post_tags($post['ID']);
				// print_r($t);
			?>	
				<div class="news-item-wrapper">
					<div class="news-thumbnail" style="background-image:url(<?php echo $link[0]; ?>)">
						
					</div>
					<h2>
						<a href="<?php the_permalink($post['ID']);?>">
							<?php echo wp_trim_words($post['post_title'], 8, '...'); ?>
						</a>
					</h2>
					<p class="news-content"><?php echo wp_trim_words($post['post_content'], 15, '  ...'); ?></p>
					<p class="news-date">
						<?php echo get_the_date('F j, Y', $post['ID']);?>
					</p>
					
					<ul class="news-tags">
						<?php
						foreach(wp_get_post_tags($post['ID']) as $tags) {
						?>
							<li><a href="<?php echo get_tag_link($tags->term_id);?>"><?php echo '#'.$tags->name;?></a></li>
						<?php
						}
						?>
					</ul>
				</div>
			<?php
			endforeach;
			wp_reset_postdata();
			?>
		</div>
	</div>
	
</section>