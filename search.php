<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package colelawson
 */

get_header(); ?>
<?php if ( have_posts() ) { ?>
				
	<div class="content-header">
		<div class="container header-gap">
			<h2>Search Results for:</h2>
			<h1>"<?php echo get_search_query();?>"</h1>
			
		</div>
		
	</div><!-- .page-header -->
<?php } ?>
<div class="container">
	<div class="row search-page-wrapper">
		<div class="grid-8">
			<section id="primary" class="content-area search-page-list">
				<main id="main" class="site-main" role="main">
				
				<?php
				if ( have_posts() ) :
					/* Start the Loop */
					while ( have_posts() ) : the_post();

						/**
						 * Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called content-search.php and that will be used instead.
						 */
						get_template_part( 'template-parts/content', 'search' );

					endwhile;

					// the_posts_navigation();
					the_posts_pagination();

				else :

					get_template_part( 'template-parts/content', 'search' );

				endif; 

				?>
					

				</main><!-- #main -->
			</section><!-- #primary -->
		</div>
		<div class="grid-4 sidebar-wrapper">
<?php
			get_sidebar();
?>
		</div>
	</div>
</div>
<?php
get_footer();
