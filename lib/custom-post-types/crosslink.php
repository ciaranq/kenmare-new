<?php

add_action( 'init', 'nw_create_crosslink_custom_post_type' );

function nw_create_crosslink_custom_post_type() {
	
	/***
	Crosslink CUSTOM POST TYPE
	***/
	register_post_type( 'nw_crosslink',
		array(
			'labels' => array(
				'name' => __( 'Crosslink' ),
				'singular_name' => __( 'Crosslink' ),
				'menu_name' => __( 'Crosslinks' ),
				'name_admin_bar' => __( 'Crosslink' ),
				'all_items' => __( 'All Crosslinks' ),
				'add_new_item' => __( 'Add New Crosslink' ),
				'edit_item' => __( 'Edit Crosslink' ),
				'new_item' => __( 'New Crosslink' ),
				'view_item' => __( 'View Crosslink' ),
				'search_items' => __( 'Search Crosslinks' ),
				'not_found' => __( 'No Crosslinks found' ),
				'not_found_in_trash' => __( 'No Crosslinks found in Trash' ),
			),
			'public' => true,
			'menu_position' => 25,
			'supports' => array( 'title', 'revisions' ),
			'hierarchical' => true,
			'exclude_from_search' => true,
			'menu_icon'   => 'dashicons-paperclip',
			'publicly_queryable' => false
		)
	);
}


