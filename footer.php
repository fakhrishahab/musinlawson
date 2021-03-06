<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package colelawson
 */
$footer_content = get_theme_mod('colelawson_footer_copyright');
?>

	</div><!-- #content -->

	<!-- <footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<a href="<?php //echo esc_url( __( 'https://wordpress.org/', 'colelawson' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'colelawson' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php //printf( esc_html__( 'Theme: %1$s by %2$s.', 'colelawson' ), 'colelawson', '<a href="https://automattic.com/" rel="designer">Underscores.me</a>' ); ?>
		</div>
	</footer> -->

	<footer class="site-footer">
		<div class="container">
			<div class="footer-text">
				<?php echo esc_html__($footer_content); ?>
			</div>
			
			<a href="#body">
				<div class="btn-to-top">
					<i class="fa fa-angle-up"></i>
				</div>
			</a>

			<nav id="footer-nav" class="footer-nav" role="navigation">
                <ul class="footer-menu">
                    <?php wp_nav_menu(array('theme_location' => 'menu-footer', 'menu_id' => 'menu-footer', 'container' => '', 'items_wrap' => '%3$s')); ?>
                </ul>
            </nav>
					
			
		</div>
		
	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
