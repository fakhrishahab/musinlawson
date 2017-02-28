<?php

/*-----------------------------------------------------------------------------------*/
/*  Musin Lawson Customizer Controls
/*-----------------------------------------------------------------------------------*/

class MusinLawson_Misc_Control extends WP_Customize_Control{

}

if ( ! function_exists( 'colelawson_sanitize_checkbox' ) ) {
    function colelawson_sanitize_checkbox( $input ) {
        if ( $input == 1 ) {
            return 1;
        } else {
            return 0;
        }
    }
}
?>