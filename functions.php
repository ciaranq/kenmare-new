<?php
/**
 * Includes
 *
 * The $nw_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * Heavily inspired by Roots theme: https://github.com/roots
 */
$nw_includes = array(
  'lib/extras.php',										// Custom functions - just for this theme
  'lib/utils.php',										// Utility functions
  'lib/init.php',											// Initial theme setup and constants
  'lib/blog-mods.php',								// Modifications to Blog
  'lib/menus.php',										// menus
  'lib/cleanup.php',									// Configuration
  'lib/gallery.php',									// Custom [gallery] modifications
  'lib/scripts.php',									// Scripts and stylesheets
  'lib/shortcode-blocks.php',					// Home made Shortcodes - for blocks of content / functionality
  'lib/custom-post-types.php',				// Custom Post Types
	'lib/customizer.php',								// Customizer
  'lib/afc-custom-mods.php',					// Fixes etc to AFC plugin
  'lib/widgets.php',									// Custom Widgets
  'lib/related-products.php',					// Change related product number of columns
  'lib/product-tabs.php',					    // Change number of product tabs in product detail
  'lib/product-gallery.php',	        // Add custom product gallery
  'lib/woocommerce-support.php',			// Add  woocommerce support
);

foreach ($nw_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'nw'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);

/**

* Hides the product's weight and dimension on the single product page.

*/

add_filter( 'wc_product_enable_dimensions_display', '__return_false' );