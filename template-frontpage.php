<?php
/**
*Template Name: Front Page
* @package colelawson
*/

get_header();
?>

<div id="content" class="site-content">
	<?php 
	if ( is_front_page() && !is_paged() && is_dynamic_sidebar('servicesection') ) {
		dynamic_sidebar('servicesection');
	}
	?>
</div>

<div id="content" class="site-content">

	<div class="page-header">
		<div class="container">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</div>
	</div>

</div><!-- #content -->

<?php

get_footer();
?>