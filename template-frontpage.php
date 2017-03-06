<?php
/**
*Template Name: Front Page
* @package colelawson
*/

get_header();
?>


<div id="content" class="site-content">

	<div class="page-header">
		<div class="container">
			<?php //the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</div>
	</div>

</div><!-- #content -->

<div class="service-image">

	<?php
		echo colelawson_get_service_image();
	?>
</div>

<?php

get_footer();
?>