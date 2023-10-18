<?php
/**
 * Scripts and stylesheets
 */
if (!is_admin()){ //don't need these js / css in admin section

	function nw_enqueue_scripts() {
		// register main stylesheets
		wp_register_style( 'nw-stylesheet', get_stylesheet_directory_uri() . '/assets/css/style.min.css', array(), '1.17', 'all' );
		wp_enqueue_style('nw-stylesheet');

		// register main js file (concat'd & minif'd with grunt)
		wp_register_script( 'nw-js', get_stylesheet_directory_uri() . '/assets/js/script.min.js', array('jquery'), '1.7', true );
		wp_enqueue_script('nw-js');
		
	}
	add_action('wp_enqueue_scripts', 'nw_enqueue_scripts');
}

//Making jQuery Google API
function nw_modify_jquery() {
	if (!is_admin()) {
		// comment out the next two lines to load the local copy of jQuery
		wp_deregister_script('jquery');
		wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js', false, '', true);
		wp_enqueue_script('jquery');
	}
}
add_action('wp_enqueue_scripts', 'nw_modify_jquery');


