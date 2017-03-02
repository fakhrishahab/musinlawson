<?php
/**
*Template Name: Front Page
* @package colelawson
*/

get_header();
?>

<?php if(is_dynamic_sidebar('servicesection')){ ?>
<div id="service-section" class="site-content">
	<?php 
	if ( is_front_page() && !is_paged() && is_dynamic_sidebar('servicesection') ) {
		if(the_widget('WP_Widget_Text')){
			echo 'ada widget';
		}else{
			echo 'tidak ada widget text';
		}
		dynamic_sidebar('servicesection');
	}
	?>
</div>
<?php } ?>

<div id="content" class="site-content">

	<div class="page-header">
		<div class="container">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</div>
	</div>

</div><!-- #content -->

<div id="service-sectionssss" class="site-content">
	<?php
	echo colelawson_get_service_section();
	?>
</div>

<?php

get_footer();
?>