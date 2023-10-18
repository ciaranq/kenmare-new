<?php
/***
* Change number of related products output
***/

function woo_related_products_limit() {
  global $product;

	$args['posts_per_page'] = 20;
	return $args;
}

add_filter( 'woocommerce_output_related_products_args', 'nw_related_products_args', 20 );
  function nw_related_products_args( $args ) {
	$args['posts_per_page'] = 3; // 3 related products
	$args['columns'] = 3; // arranged in 3 columns
	return $args;
}

// Change WooCommerce "Related products" text

/*
add_filter('gettext', 'nw_change_related_products_text', 10, 3);
add_filter('ngettext', 'nw_change_related_products_text', 10, 3);

function nw_change_related_products_text($translated, $text, $domain)
{
	if ($text === 'Related products' && $domain === 'woocommerce') {
		$translated = esc_html__('More Organic Smoked Salmon Options', $domain);
	}
	return $translated;
}

*/

add_filter('woocommerce_product_related_products_heading', 'nw_custom_related_products_heading');
function nw_custom_related_products_heading() {
	global $post;
	$terms = get_the_terms( $post->ID, 'product_cat' );
	if ($terms){
		$cat = $terms[0]->name;
	}
	return 'More '.$cat.' Options';
}

add_filter('woocommerce_after_single_product', 'nw_add_button_after_related_products');
function nw_add_button_after_related_products() {
	?>
	<div class="cta-button aligncenter">
		<a class="btn-white" href="/shop/">View all products</a>
	</div>
	<?php
}
