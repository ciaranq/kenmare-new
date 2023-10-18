<?php
if (!class_exists('WooCommerce')) return;

/***
* SETUP THEME TO BE WOOCOMMERCE COMPATIBLE
***/

add_action( 'after_setup_theme', 'setup_woocommerce_support' );

function setup_woocommerce_support()
{
		// Remove default wrappers.
		remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper' );
		remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end' );

		// Add custom wrappers.
		add_action('woocommerce_before_main_content', 'nw_wc_wrapper_start_1', 1);
		add_action('woocommerce_before_main_content', 'nw_wc_wrapper_start_2', 10);
		add_action('woocommerce_after_main_content', 'nw_wc_wrapper_end_2', 10);
		add_action('woocommerce_after_main_content', 'nw_wc_wrapper_end_1', 10);

		// Declare theme support for features.
		add_theme_support(
			'woocommerce'
		);
}


// Custom open wrappers
function nw_wc_wrapper_start_1() {
	echo '<div class="main">';
}

function nw_wc_wrapper_start_2() {
	if(!(is_shop() && count($_GET) == 0)) {
		echo '<section class="panel-layout panel-layout-shop-content">';
		echo '<div class="panel-content">';
	}
}


// Close close wrappers
function nw_wc_wrapper_end_2() {
	if(!(is_shop() && count($_GET) == 0)) {
		echo '		</div>
						</section>';
	}


	$shop_id = get_option('woocommerce_shop_page_id');
	global $post; 
	$post = get_post($shop_id, OBJECT);
	setup_postdata($post);
	
	$args = array('fix_product_category_shortcode_reset' => TRUE);
	
	get_template_part('template-parts/shop-pages-footer-panels', null, $args);
	
	wp_reset_postdata();

}

// Close close wrappers
function nw_wc_wrapper_end_1() {
	echo '</div>';
}

/***
* REMOVE WC BREADCRUMBS - actually, we do want breadcrumbs
***/
//remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

/***
* MOVE WC BREADCRUMBS TO BETWEEN 1ST & 2ND CUSTOM WRAPPERS
***/
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
add_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 2 ); // add inside opening wrapper above

/***
* Remove Category in Breadcrumb on single product page
***/
add_filter( 'woocommerce_get_breadcrumb', 'nw_modify_breadcrumb', 10, 2 );
function nw_modify_breadcrumb( $crumbs, $object_class ){
	
	if(!is_shop()) {
		$shop_id = get_option('woocommerce_shop_page_id');
		
		$crumbs[0][0] = 'Shop';
		$crumbs[0][1] = get_permalink($shop_id);
	} else {
		$crumbs = null;
	}
	
	return $crumbs;
}



/***
* REMOVE DEFAULT FILTER BAR
***/
remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );


/***
* AJAX UPDATE OF CART COUNT
***/

add_filter( 'woocommerce_add_to_cart_fragments', 'nw_wc_refresh_cart_fragments' );
function nw_wc_refresh_cart_fragments( $fragments ){
    $cart_count = WC()->cart->get_cart_contents_count();
    if ($cart_count > 0) {
			$count_span = '<span class="cart-count cart-count-active">'.$cart_count.'</span>';
      $mini_cart_count = '<span class="mini-cart-count">You have '.$cart_count.' items in your cart</span>';
    } else {
			$count_span = '<span class="cart-count cart-count-inactive"></span>';
		}
    $fragments['.cart-count'] = $count_span;
    $fragments['.mini-cart-count'] = $mini_cart_count;
    return $fragments;
}

// Mini Cart update with AJAX

add_filter( 'woocommerce_add_to_cart_fragments', function($fragments) {
    ob_start();
    ?>
<span class="mini-cart-dropdown">
  <?php woocommerce_mini_cart(); ?>
</span>
<?php $fragments['span.mini-cart-dropdown'] = ob_get_clean();
    return $fragments;
} );

/***
* ADD PRICE TO ADD TO CART BUTTON
***/
add_filter( 'woocommerce_product_add_to_cart_text', 'custom_add_to_cart_price', 20, 2 ); // Shop and other archives pages
// add_filter( 'woocommerce_product_single_add_to_cart_text', 'custom_add_to_cart_price', 20, 2 ); // Single product pages
function custom_add_to_cart_price( $button_text, $product ) {
    // Variable products
    if( $product->is_type('variable') ) {
        // shop and archives
        if( ! is_product() ){
            $product_price = wc_price( wc_get_price_to_display( $product, array( 'price' => $product->get_variation_price() ) ) );
            return $button_text . ' - From ' . strip_tags( $product_price );
        }
        // Single product pages
        else {
            return $button_text;
        }
    }
    // All other product types
    else {
        $product_price = wc_price( wc_get_price_to_display( $product ) );
        return $button_text . '&nbsp;&nbsp;' . strip_tags( $product_price );
    }
}

/***
* REMOVE PRICE ON SHOP LANDING PAGE
***/
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );

/***
* REMOVE TITLE IN CONTENT ON SHOP LANDING PAGE
***/
add_filter( 'woocommerce_show_page_title', 'nw_hide_shop_page_title' );
function nw_hide_shop_page_title($title) {
   if(is_shop()){
	 	$title = false;
	 }
   return $title;
}

/***
* REMOVE AUTOMATIC PRODUCT LISTING FROM SHOP PAGE (instead, we're loading product listings via shortcodes in the content)
***/
//add_action( 'woocommerce_product_query', 'nw_modify_woocommerce_product_query_on_shop_page' );
function nw_modify_woocommerce_product_query_on_shop_page($q) {
	if( is_shop() || is_page('shop') ) {
		
		// set the query to something impossible
		$q->set('post_parent', 1);
		
		// remove the 'no products found' message
		remove_action( 'woocommerce_no_products_found', 'wc_no_products_found' );
	}
}

/***
* STOP LOOP RESETTING AFTER PRODUCT CATEGORY SHORTCODE USED
***/
/*
add_filter( 'woocommerce_shortcode_after_product_category_loop', 'nw_after_product_category_loop' );
function nw_after_product_category_loop() {
	$shop_id = get_option('woocommerce_shop_page_id');
	global $post; 
	$post = get_post($shop_id, OBJECT);
	setup_postdata($post);
}
*/

/***
* REMOVE DEFAULT SHOP SIDEBAR
***/

remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

/***
* ADD NOTE AFTER COUNTRY FIELD ON CHECKOUT PAGE
***/

//add_filter('woocommerce_checkout_fields', 'nw_update_country_checkout_field');
function nw_update_country_checkout_field($fields) {
	// var_dump($fields);
	//$fields['billing']['billing_country']['label'] = $fields['billing']['billing_country']['label'].'<div class="note">Lorem Ipsum Dolor site amet</div>';
	return $fields;
}

// Add field type to WooCommerce form field 
add_filter( 'woocommerce_form_field_message','nw_woocommerce_form_field_message', 10, 4 );
function nw_woocommerce_form_field_message($field, $key, $args, $value) {
    $output = '<p class="form-row form-row-wide"><span class="wp-caption-text">'.__( $args['label'], 'woocommerce' ).'</span></p>';
    echo $output;
}

// Modify checkout fields
add_filter( 'woocommerce_checkout_fields','nw_custom_override_checkout_fields' );
function nw_custom_override_checkout_fields( $fields ) {
    $fields['billing']['billing_message_name'] = array(
        'type'    	 		=> 'message',
        'label'   	  	=> 'If your country if not listed here, please <a href="/contact/">contact us</a> for a shipping quotation.',
				'required'			=> FALSE,
				'autocomplete'	=> '',
				'priority'			=> 45
    );
		
		return $fields;
}

/***
* ADD WEIGHT COLUMN TO PRODUCT ADMIN PAGE
***/

// add new column
add_filter( 'manage_edit-product_columns', 'nw_wc_add_admin_weight_column', 20 );
function nw_wc_add_admin_weight_column($columns_array) {
	// display column after the product name column
	return array_slice( $columns_array, 0, 3, true )
	+ array( 'weight' => 'Weight' )
	+ array_slice( $columns_array, 3, NULL, true );
}

// populate weight column
add_action( 'manage_posts_custom_column', 'nw_wc_admin_populate_weight_column' );
function nw_wc_admin_populate_weight_column($column_name) {
	if( $column_name  == 'weight' ) {
		$product = wc_get_product(get_the_ID());
		$weight = $product->get_weight();
		echo ($weight) ? $weight.'kg' : '-';
	}
}

// css for column width
add_action('admin_head', 'nw_wc_admin_weight_column_css');
function nw_wc_admin_weight_column_css() {
    echo '<style type="text/css">';
    echo 'table.wp-list-table .column-weight { width: 46px; text-align: left!important;padding: 5px;}';
    echo '</style>';
}

/***
* ADD NORTHERN IRELAND + COUNTIES FOR SHIPPING
***/

add_filter( 'woocommerce_countries', 'nw_custom_add_country' );
function nw_custom_add_country( $countries ) {
	$new_country = array(
		'NIRE' => 'Northern Ireland',
	);
	return array_merge( $countries, $new_country );
}

add_filter( 'woocommerce_continents', 'nw_custom_add_country_to_continent' );
function nw_custom_add_country_to_continent( $continents ) {
	$continents['EU']['countries'][] = 'NIRE';
	return $continents;
}

add_filter( 'woocommerce_states', 'nw_custom_add_country_counties' );
function nw_custom_add_country_counties( $states ) {
	$states['NIRE'] = array(
		'AN' => 'Antrim',
		'AR' => 'Armagh',
		'DY' => 'Derry',
		'DO' => 'Down',
		'FM' => 'Fermanagh',
		'TR' => 'Tyrone',
	);
	return $states;
}
