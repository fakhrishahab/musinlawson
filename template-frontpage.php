<?php
/**
*Template Name: Front Page
* @package colelawson
*/

get_header();
?>


<div id="content" class="site-content">

	<?php 
	if ( is_front_page() && !is_paged() && is_dynamic_sidebar('headerwidget') ) {
		dynamic_sidebar('headerwidget');
	}
	?>

	<div class="page-header">
		<div class="container">
			<?php //the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</div>
	</div>

</div><!-- #content -->

<div class="site-content">
	<?php 
		do_action('colelawson_frontpage_before_section_parts');

		if(! has_action('colelawson_frontpage_section_parts')) {
			$sections = apply_filters('colelawson_frontpage_section_order', array(
				'about', 'services', 'specialities', 'engaging', 'news', 'contact'
			));

			foreach ($sections as $section) {
				get_template_part('section-parts/section', $section);
			}
		}

		do_action('colelawson_frontpage_after_section_parts');
	?>
</div>

<div class="service-image">

</div>

<?php

get_footer();
?>