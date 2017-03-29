<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package colelawson
 */

get_header(); ?>

	<div id="primary" class="header-gap">
            <div class="container">
                <div class="row">
                    <div class="grid-9 p20">
                        <main id="main" class="site-main" role="main">
		<div class="post-wrap">
	                        <?php if ( have_posts() ) : ?>
	                            <?php $postCount=0 ?>
	                            <?php while ( have_posts() ) : the_post(); ?>
	                                <div class="post" id="post-<?php echo $postCount; ?>" <?php post_class(); ?>>
	                                    <div class="post-img">
                    <a href="<?php the_permalink(); ?>">
                    <?php echo the_post_thumbnail('thumbnail-medium');?>
                        </a>
                </div>
	                                     <div class="post-content-wrap">
                    <div class="post-content">
                         <header class="entry-header">
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php colelawson_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->
	<div class="entry-content">
		<?php
			the_excerpt( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'colelawson' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'colelawson' ),
				'after'  => '</div>',
			) );
		?>
            <a href="<?php the_permalink(); ?>" class="btn btn-secondary">Read More</a>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php colelawson_entry_footer(); ?>
	</footer><!-- .entry-footer -->
                    </div>
                </div>
	                                </div><!-- .post-->
	                                <?php $postCount++ ?>
	                            <?php endwhile; /* rewind or continue if all posts have been fetched */ ?>
	                            <?php else : ?>
	                        <?php endif; ?>
	                    </div>
                               <?php the_posts_pagination();?>
		</main><!-- #main -->
                    </div>
                    <div class="grid-3 p20 m-hide">
                        <?php get_sidebar();?>
                    </div>
                </div>
            </div>
	</div><!-- #primary -->

<?php

get_footer();
