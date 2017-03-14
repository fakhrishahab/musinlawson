<?php
/**
 * Template part for displaying services page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package colelawson
 */
	
	$link = wp_get_attachment_image_src(get_post_thumbnail_id(the_ID()), 'thumbnail-medium');
	var_dump($link);
?>

<div class="jumbotron-header outer" style="background-image:url(<?php echo $link[0];?>)">
	<div class="jumbotron-header-title inner">
		<h1><?php the_title();?>XXX</h1>
	</div>
</div>

<div class="container header-gap">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php echo the_post_thumbnail('thumbnail-large');?>
		<header class="entry-header">
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

			<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php colelawson_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->

		<footer class="entry-footer">
			<?php colelawson_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</article><!-- #post-## -->
</div>

