<?php
// $language = $_COOKIE['pll_language'];
/**
*Template Name: Front Page
* @package colelawson
*/

get_header();
?>

<!-- <div class="popup-container">
	<div class="popup-wrapper">
		<div class="popup-message">
			<p>Form submitted successfully.</p>
			<p>Thank you for contacting Musin & Lawson Communications. We appreciate you taking the time to write to us and will endeavour to respond to you within one business day. If your enquiry is urgent, please call our Jakarta office on +62 21 2965 1271</p>
		</div>
	</div>
	<i class="fa fa-close close-popup"></i>
	</div> -->
<div id="content" class="site-content pRelative">

	<?php 
	if ( is_front_page() && !is_paged() && is_dynamic_sidebar('headerwidget') ) {
		dynamic_sidebar('headerwidget');
	}
	?>
	<div class="mouse"></div>
	<!-- <div class="page-header">
		<div class="container">
			<?php //the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</div>
	</div> -->

</div><!-- #content -->

<!-- <div class="site-content"> -->
	<?php 
		do_action('colelawson_frontpage_before_section_parts');

		if(! has_action('colelawson_frontpage_section_parts')) {
			$sections = apply_filters('colelawson_frontpage_section_order', array(
				'about', 
				'services', 
				'specialities', 
				'engaging', 
				'news', 
				'contact'
			));

			foreach ($sections as $section) {
				get_template_part('section-parts/section', $section);
			}
		}

		do_action('colelawson_frontpage_after_section_parts');
	?>
<!-- </div> -->


<?php

get_footer();
?>