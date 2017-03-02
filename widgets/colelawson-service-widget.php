<?php 
/*Plugin Name: Service Section
Description: This widget checks if the current page has parent or child pages and if so, outputs a list of the highest ancestor page and its descendants. This file supports part 1 of the series to create the widget and doesn't give you a functioning widget.
Version: 0.1
Author: Fakhri Shahab
Author URI: http://fakhrisyahab.com
License: GPLv2
*/
?>


<?php
add_action( 'widgets_init', 'register_colelawson_service_widget' );

function register_colelawson_service_widget() {
 
    register_widget( 'Colelawson_Service_Widget' );
 
}

?>

<?php
function tutsplus_check_for_page_tree() {
 
    //start by checking if we're on a page
    if( is_page() ) {
     
        global $post;
     
        // next check if the page has parents
        if ( $post->post_parent ){
         
            // fetch the list of ancestors
            $parents = array_reverse( get_post_ancestors( $post->ID ) );
             
            // get the top level ancestor
            return $parents[0];
             
        }
         
        // return the id  - this will be the topmost ancestor if there is one, or the current page if not
        return $post->ID;
         
    }
 
}
?>

<?php
class Colelawson_Service_Widget extends WP_Widget{
	function __construct(){
		parent::__construct(
         
	        // base ID of the widget
	        'colelawson_service_widget',
	         
	        // name of the widget
	        __('Service Section', 'colelawson' ),
	         
	        // widget options
	        array (
	            'description' => __( 'For service section only for front page template.', 'colelawson' )
	        )
	         
	    );
	}

	function form($instance){

	    // markup for form ?>
	    <p>
			<label for="<?php echo $this->get_field_id('text'); ?>">Text</label><br />
			<input type="text" name="<?php echo $this->get_field_name('text'); ?>" id="<?php echo $this->get_field_id('text'); ?>" value="<?php echo $instance['text']; ?>" class="widefat" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('image_uri'); ?>">Image</label><br />
			<input type="text" class="img" name="<?php echo $this->get_field_name('image_uri'); ?>" id="<?php echo $this->get_field_id('image_uri'); ?>" value="<?php echo $instance['image_uri']; ?>" />
			<input type="button" class="select-img" value="Select Image" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('description');?>">Description</label><br/>
			<textarea name="<?php echo $this->get_field_name('description'); ?>" id="<?php echo $this->get_field_id('description'); ?>" value="<?php echo $instance['description']; ?>" class="widefat">
				<?php echo $instance['description']; ?>
			</textarea>
		</p>
		<?php
	}

	function update($new_instance, $old_instance){
		$instance = $old_instance;
	    $instance[ 'text' ] = strip_tags( $new_instance[ 'text' ] );
	    $instance[ 'image_uri' ] = strip_tags( $new_instance[ 'image_uri' ] );
	    $instance[ 'description' ] = strip_tags( $new_instance[ 'description' ] );
	    return $instance;
	}

	function widget($args, $instance){
		// markup ?>
		<a href="#" class="ah">
			<img src="<?php echo esc_html($instance['image_uri'])?>" />
			<h4><?php echo esc_html($instance['text']) ?></h4>
			<p><?php echo esc_html($instance['description']) ?></p>
			test
		</a>
		<?php
	}
}
?>
