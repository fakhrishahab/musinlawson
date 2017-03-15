<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package colelawson
 */

?>
<section class="header-gap">
<div class="post" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <section class="page-header">
                <div class="container">
                    <div class="page-info">
                        <div class="page-title">
                            <h1><?php the_title();?></h1>
                            <p class="info-date text-s"><i class="fa fa-calendar"></i> <?php colelawson_posted_on(); ?></p>
                            <a href="#" class="info-author text-s">by <?php the_author(); ?></a>
                        </div>
                    </div>
                    <div class="page-img">
                         <?php echo the_post_thumbnail('thumbnail-large');?>
                    </div>
                </div>
            </section>      
    <section>
        <div class="container">
            <article class="page-article">
                <?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'colelawson' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'colelawson' ),
				'after'  => '</div>',
			) );
		?>
            </article>
        </div>
    </section>
</div><!-- #post-## -->
</section>