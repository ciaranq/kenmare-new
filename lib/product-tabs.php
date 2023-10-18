<?php
// **
//  * Change product tabs on product detail
//  */

/**
 * Rename product data tabs
 */
add_filter( 'woocommerce_product_tabs', 'woo_rename_tabs', 98 );
function woo_rename_tabs( $tabs ) {

	$tabs['description']['title'] = __( 'Product Description' );		// Rename the description tab
	// $tabs['reviews']['title'] = __( 'Ratings' );				// Rename the reviews tab
	$tabs['additional_information']['title'] = __( 'Nutritional Information' );	// Rename the additional information tab

	return $tabs;

}

/////////////////////////////////////////

//
// /**
//  * Add a custom product data tab
//  */
// add_filter( 'woocommerce_product_tabs', 'woo_new_product_tab' );
// function woo_new_product_tab( $tabs ) {
//
// 	// Adds the new tab
//
// 	$tabs['nutritional_tab'] = array(
// 		'title' 	=> __( 'Nutritional Information', 'woocommerce' ),
// 		'priority' 	=> 50,
// 		'callback' 	=> 'woo_new_product_tab_content'
// 	);
//
// 	return $tabs;
//
// }
// function woo_new_product_tab_content() {
//
// 	// The new tab content
//
// 	echo '<h2>Nutritional Information</h2>';
// 	echo '<p>Here\'s your new product tab.</p>';
//
// }
