<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package colelawson
 */


if ( ! function_exists( 'colelawson_site_logo' ) ) {
    function colelawson_site_logo(){
        $classes = array();
        $html = '' ;
        $classes['logo'] = 'no-logo-img';

        if ( function_exists( 'has_custom_logo' ) ) {
            if ( has_custom_logo()) {
                $classes['logo'] = 'has-logo-img';
                $html .= '<div class="site-logo-div">';
                $html .= get_custom_logo();
                $html .= '<div class="logo-headline">';
            }
        }

        $hide_sitetile = get_theme_mod( 'colelawson_hide_sitetitle',  0 );
        $hide_tagline  = get_theme_mod( 'colelawson_hide_tagline', 0 );

        if ( ! $hide_sitetile ) {
            if ( is_front_page() && !is_home() ) {
            	$classes['title'] = 'has-title';	
                $html .= '<h1 class="site-title"><a class="site-text-logo" href="' . esc_url(home_url('/')) . '" rel="home">' . get_bloginfo('name') . '</a></h1>';
            } else {

            	$classes['title'] = 'no-title';
                //$html .= '<p class="site-title"><a class="site-text-logo" href="' . esc_url(home_url('/')) . '" rel="home">' . get_bloginfo('name') . '</a></p>';
            }
        }

        if ( ! $hide_tagline ) {
            $description = get_bloginfo( 'description', 'display' );
            if ( $description || is_customize_preview() ) {
                $classes['desc'] = 'has-desc';
                $html .= '<p class="site-description">'.$description.'</p>';
            }
        } else {
            $classes['desc'] = 'no-desc';
        }

        echo '<div class="site-brand-inner '.esc_attr( join( ' ', $classes ) ).'">'.$html.'</div></div></div>';
    }
}

add_action( 'colelawson_site_start', 'colelawson_site_header' );
if ( ! function_exists( 'colelawson_site_header' ) ) {
    /**
     * Display site header
     */
    function colelawson_site_header(){
        ?>
        <header id="masthead" class="site-header" role="banner">
            <div class="container ps10">
                <div class="site-branding">
                <?php
                    colelawson_site_logo();
                ?>
                    
                </div>
                <!-- .site-branding -->
                <div class="header-right-wrapper">
                    <div class="widget-header-wrapper fRight">
                        <?php custom_search_form(); ?>
                        <?php
                        if(is_dynamic_sidebar('language_widget')){
                            dynamic_sidebar('language_widget');
                        }
                        ?>
                    </div>
                    
                    <nav id="site-navigation" class="main-navigation nav-header" role="navigation">
                        <ul class="colelawson-menu">
                            <?php wp_nav_menu(array('theme_location' => 'menu-1', 'menu_id' => 'primary-menu', 'container' => '', 'items_wrap' => '%3$s')); ?>
                        </ul>
                    </nav>
                </div>
                <!-- <div class="header-right-wrapper"> -->
                    
                <!-- </div> -->
                <div class="menu-toggle">
                    <i class="fa fa-bars"></i>
                </div>
                
            </div>

            <div class="collapse-menu">
                <nav id="site-navigation" class="main-navigation" role="navigation">
                    <ul class="colelawson-menu">
                        <?php wp_nav_menu(array('theme_location' => 'menu-1', 'menu_id' => 'primary-menu', 'container' => '', 'items_wrap' => '%3$s')); ?>
                    </ul>
                </nav>
                <div class="collapse-search-form">
                    <?php custom_search_form(); ?>
                </div>

            </div>
        </header><!-- #masthead -->
        <?php
    }
}

if ( ! function_exists( 'colelawson_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function colelawson_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'colelawson' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'colelawson' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'colelawson_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function colelawson_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'colelawson' ) );
		if ( $categories_list && colelawson_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'colelawson' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'colelawson' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'colelawson' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'colelawson' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'colelawson' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

if ( ! function_exists( 'colelawson_get_service_section' ) ) {
    /**
     * Get social profiles
     *
     * @since 1.1.4
     * @return bool|array
     */
    function colelawson_get_service_section()
    {
        $array = get_theme_mod('colelawson_service_title');
        echo $array;
        if (is_string($array)) {
            $array = json_decode($array, true);
        }
        $html = '';
        if (!empty($array) && is_array($array)) {
            foreach ($array as $k => $v) {
                $array[$k] = wp_parse_args($v, array(
                    'network' => '',
                    'icon' => '',
                    'link' => '',
                ));

                //Get/Set social icons
                // If icon isset
                $icons = array();
                $array[$k]['icon'] = trim($array[$k]['icon']);
                if ($array[$k]['icon'] != '' && strpos($array[$k]['icon'], 'fa-') !== 0) {
                    $icons['fa-' . $array[$k]['icon']] = 'fa-' . $array[$k]['icon'];
                } else {
                    $icons[$array[$k]['icon']] = $array[$k]['icon'];
                }
                $network = ($array[$k]['network']) ? sanitize_title($array[$k]['network']) : false;
                if ($network) {
                    $icons['fa-' . $network] = 'fa-' . $network;
                }

                $array[$k]['icon'] = join(' ', $icons);

            }
        }

        foreach ( (array) $array as $s) {
            if ($s['icon'] != '') {
                $html .= '<a target="_blank" href="' . $s['link'] . '" title="' . esc_attr($s['network']) . '"><i class="fa ' . esc_attr($s['icon']) . '"></i></a>';
            }
        }

        return $html;
    }
}

if(! function_exists('colelawson_get_service_image')){

	function colelawson_get_service_image(){
		$title = get_theme_mod('colelawson_service_title');
		$description = get_theme_mod('colelawson_service_description');
		$array = get_theme_mod('colelawson_service_image');
		
		$html = '<div>'. $title .'</div><div>' . $description . '</div>';

		if(!empty($array) && is_array($array)){
			foreach ($array as $key => $value) {
				$array[$key] = wp_parse_args($value, array(
					'title' => '',
					'image' => '',
					'link' => ''
				));

				$html .= '<a href=' . esc_url($array[$key]['link']) . '><div>
					<img src=' . esc_url($array[$key]['image']['url']) . '> 
					<div>' . $array[$key]['title'] . '</div>
					</div></a>';

				//echo $array[$key]['title'];
			}
		}

		return $html;
	}
}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function colelawson_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'colelawson_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'colelawson_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so colelawson_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so colelawson_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in colelawson_categorized_blog.
 */
function colelawson_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'colelawson_categories' );
}
add_action( 'edit_category', 'colelawson_category_transient_flusher' );
add_action( 'save_post',     'colelawson_category_transient_flusher' );
