<?php
/**
 * Cleaning up HTML
 */

/*
* Remove built-in WP actions
*/
remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'index_rel_link' ); // index link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0); //remove shortlink
remove_action( 'wp_head', 'print_emoji_detection_script', 7 ); // remove WP 4.2 emojis
remove_action( 'wp_print_styles', 'print_emoji_styles' );  // remove WP 4.2 emojis

/*
* remove built-in WP wp-embed.min.js file
*/
function nw_remove_wpembed_script(){
  wp_dequeue_script( 'wp-embed' );
}
add_action( 'wp_footer', 'nw_remove_wpembed_script' );

/*
* Remove recent comments styles
*/
function nw_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
}
add_action('widgets_init', 'nw_remove_recent_comments_style');

/*
* Remove Gutenberg Block Library CSS from loading on the frontend
*/
function nw_remove_wp_block_library_css(){
 wp_dequeue_style( 'wp-block-library' );
 wp_dequeue_style( 'wp-block-library-theme' );
 wp_dequeue_style( 'global-styles' );
}
add_action( 'wp_enqueue_scripts', 'nw_remove_wp_block_library_css', 100 );


/*
* Make links relative (not absolute)
*/
function nw_make_path_root_relative($input) {
    return preg_replace('!http(s)?://' . $_SERVER['HTTP_HOST'] . '/!', '/', $input);
}

/*
* Remove title attributes from links
*/
function nw_remove_title_attributes($input) {
    return preg_replace('/\s*title\s*=\s*(["\']).*?\1/', '', $input);
}

/*
* Apply the two preceding functions
*/
function nw_clean_links($menu) {
    // Remove title attributes
    $menu = nw_remove_title_attributes($menu);
    // Remove protocol and domain name from href values
    $menu = nw_make_path_root_relative($menu);
    return $menu;
}
add_filter( 'wp_page_menu', 'nw_clean_links' );
add_filter( 'wp_nav_menu', 'nw_clean_links' );

/*
* Make attachment URLs & Links relative
*/
add_filter('wp_get_attachment_url', 'nw_make_path_root_relative');
add_filter('wp_get_attachment_link', 'nw_make_path_root_relative');


/*
* Remove all the built-in WP classes, except the following
*/
function nw_remove_excess_classes($css_class) {
	//keep these classes, remove all others
	$keep_classes = array(
		'current_page_item',
		'current-page-ancestor',
		'current_page_ancestor',
		'current_page_parent',
		'menu-item-has-children',
	);
	return is_array($css_class) ? array_intersect($css_class, $keep_classes) : '';
}
add_filter('page_css_class','nw_remove_excess_classes',10,2); //this filter is applied in 'start_el' function
// add_filter('nav_menu_css_class', 'nw_remove_excess_classes',10,2);
add_filter('nav_menu_item_id', 'nw_remove_excess_classes',10,2);

/*
* Remove empty classes (side-effect of previous class removal)
*/
function nw_remove_empty_classes($html) {
    $html = str_replace(' class=""','',$html);
	return $html;
}
add_filter( 'wp_page_menu', 'nw_remove_empty_classes' );

/***
* REMOVE OEMBEDS
***/
//Remove the REST API endpoint.
remove_action('rest_api_init', 'wp_oembed_register_route');

// Turn off oEmbed auto discovery.
add_filter( 'embed_oembed_discover', '__return_false' );

//Don't filter oEmbed results.
remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);

//Remove oEmbed discovery links.
remove_action('wp_head', 'wp_oembed_add_discovery_links');

//Remove oEmbed JavaScript from the front-end and back-end.
remove_action('wp_head', 'wp_oembed_add_host_js');
