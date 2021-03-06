<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package colelawson
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php

		$catArr = [];
		while ( have_posts() ) : the_post();
			foreach ((get_the_category()) as $category) {
				array_push($catArr, $category->cat_name);
			}

			if(in_array('services', $catArr) || in_array('service', $catArr)){
				get_template_part('template-parts/content', 'service');
			}else{
				get_template_part( 'template-parts/content', get_post_format() );	

				?>
                    
                    <nav class="page-nav">
	            <div class="container">
	                <div class="row">
	                   <?php the_post_navigation(); ?>
	                </div>
	            </div>
	        </nav>
                    
                    <?php

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			}						

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
if(!in_array('services', $catArr) && !in_array('service', $catArr)){
	//get_sidebar();
}

get_footer();
