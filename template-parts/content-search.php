<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package colelawson
 */

?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php colelawson_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->
	
	<div class="content-summary">
		<div style="display:table-row">
			<?php if ( has_post_thumbnail() ) { 
				$link = wp_get_attachment_image_src(get_post_thumbnail_id(), 'single-post-thumbnail');
			?>
				<div class="content-summary-thumbnail" style="background:url(<?php echo $link[0];?>)">
					<?php //the_post_thumbnail( ); ?>
				</div>
			<?php } ?>
			
			<div class="content-summary-excerpt">
				<?php 
					the_excerpt();
					echo sprintf( '<a href="%s" class="more-link" rel="bookmark">Read more</a>', esc_url(get_permalink()) );
				?>

			</div>
		</div>
		

	</div>
	<!-- <div class="entry-summary">
		<?php //the_excerpt(); ?>
	</div> --><!-- .entry-summary -->

	<!-- <footer class="entry-footer">
		<?php //colelawson_entry_footer(); ?>
	</footer> --><!-- .entry-footer -->
</article><!-- #post-## -->

