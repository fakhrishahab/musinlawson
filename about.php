<?php
/*
*Template Name: About 
*/

get_header();

$link = wp_get_attachment_image_src(get_post_thumbnail_id(the_ID()), 'thumbnail-large');
$args = array(
			'numberposts' => 3,
			'offset' => 0,
			'category_name' => 'news, berita',
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

	$newsArr = wp_get_recent_posts($args, ARRAY_A);
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
				<?php
			    // TO SHOW THE PAGE CONTENTS
			    while ( have_posts() ) : the_post(); ?> <!--Because the_content() works only inside a WP Loop -->
			        <?php the_content(); ?> <!-- Page Content -->

			    <?php
			    endwhile; //resetting the page loop
			    wp_reset_query(); //resetting the page query
			    ?>
			</div>
		</div>
		<div class="grid-3 border-left-c8">
			<ul class="content-sidebar-menu has-thumbnail">
				<li class="title">Recent News</li>
				<?php
				foreach($newsArr as $news) : setup_postdata($news);
				?>
					<li>
						<?php 
							if ( has_post_thumbnail($news['ID']) ) { 
							$link = wp_get_attachment_image_src(get_post_thumbnail_id($news['ID']), 'single-post-thumbnail');
							// var_dump($link);
						?>
							<div class="content-summary-thumbnail" style="background:url(<?php echo $link[0];?>)">
							</div>
						<?php
						}
						?>

						<a href="<?php the_permalink($news['ID']);?>">
							<?php echo $news['post_title'];?>
						</a>
						<span>
							<?php
								echo get_the_date('',$news['ID']);
							?>
						</span>
					</li>
				<?php
				endforeach;
				wp_reset_postdata();
				?>
			</ul>
		</div>
	</div>
</div>

<?php
get_footer();
?>