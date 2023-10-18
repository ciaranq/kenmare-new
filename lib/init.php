<?php
/**
 * Initial setup and constants
 */
function nw_setup() {

	// Register wp_nav_menu() menus
	register_nav_menus(array(
		'header_navigation' => __('Header Navigation', 'nw'),
		'footer_navigation' => __('Footer Navigation', 'nw'),
		'header_links' => __('Header Links', 'nw'),
		'footer_links' => __('Footer Links', 'nw'),
	));

	// Add post thumbnails - comment & uncomment as used for this theme
	add_theme_support('post-thumbnails');

	/***
	* REMOVE WORDPRESS BUILT-IN IMAGE SIZES
	***/
	add_filter( 'intermediate_image_sizes', 'remove_default_img_sizes', 10, 1);

	function remove_default_img_sizes( $sizes ) {
		//$targets = array('thumbnail','medium', 'medium_large', 'large', '1536x1536', '2048x2048');
		$targets = array('medium_large', '1536x1536', '2048x2048');
		//$targets = array('1536x1536', '2048x2048');

		foreach($sizes as $size_index=>$size) {
			if(in_array($size, $targets)) {
				unset($sizes[$size_index]);
			}
		}

		return $sizes;
	}

	/***
	* UPDATE BUILT-IN S,M,L IMAGE SIZES
	***/
	update_option( 'thumbnail_size_h', 350 );
	update_option( 'thumbnail_size_w', 350 );
	update_option( 'thumbnail_crop', 0 );
	update_option( 'medium_size_h', 700 );
	update_option( 'medium_size_w', 700 );
	update_option( 'large_size_h', 1400 );
	update_option( 'large_size_w', 1400 );

	/***
	* ADD CUSTOM IMAGE SIZES
	***/

	//SMALL
	add_image_size( 'imgsize-small-300x320', 300, 320, true ); // small image size 300 x 320 cropped
	add_image_size( 'imgsize-small-340x300', 340, 300, true ); // small image size 340 x 300 cropped
	add_image_size( 'thumb_255', 255, 255, true );

	//MEDIUM
	// add_image_size( 'imgsize-medium-6to9', 300, 450, true ); // medium image size 6:9 cropped
	// add_image_size( 'imgsize-medium-1to1', 400, 400, true ); // medium image size 1:1 cropped
	// add_image_size( 'imgsize-medium-4to3', 400, 300, true ); // medium image size 4:3 cropped
	add_image_size( 'imgsize-medium-3to2', 600, 450, true ); // medium image size 3:4 cropped
	add_image_size( 'imgsize-medium-600x350', 600, 350, true ); // medium image size 3:4 cropped
	// add_image_size( 'imgsize-medium-400x340', 400, 340, true ); // medium image size 3:4 cropped

	// LARGE
	//add_image_size( 'imgsize-large-5to3', 1200, 720, true ); // large image size 5:3 cropped

	// BANNER
	add_image_size( 'imgsize-large-banner', 1400, 670, true );
	//add_image_size( 'imgsize-banner', 1400, 320, true );
	//add_image_size( 'imgsize-home-banner-mobile', 1080, 648, true ); // banner image for mobile (loaded via srcset - must be same aspect ratio as srcset for WP to find it)
	//add_image_size( 'imgsize-banner-fact', 285, 300, true );

	// Add post formats
	//add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio'));

	// Add HTML5 markup for captions
	add_theme_support('html5', array('caption', 'comment-form', 'comment-list', 'gallery'));

	// give page title conttol to wordpress
	add_theme_support( 'title-tag' );

	add_theme_support( 'responsive-embeds' );

}
add_action('after_setup_theme', 'nw_setup');

/**
 * Register sidebars
 */
function nw_widgets_init() {

	register_sidebar(array(
    'name'          => __('Footer Text', 'nw'),
    'id'            => 'footer-text',
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '<h6>',
    'after_title'   => '</h6>',
  ));

	register_sidebar(array(
    'name'          => __('Footer Contact Details', 'nw'),
    'id'            => 'footer-contact-details',
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '<h6>',
    'after_title'   => '</h6>',
  ));

}
add_action('widgets_init', 'nw_widgets_init');
