<?php
/***
* FIX TEXTAREA HEIGHT BUG
***/
add_filter('admin_head','nw_afc_textarea_height_fix');
function nw_afc_textarea_height_fix() {
	echo '<style type="text/css">.acf_postbox .field textarea {min-height:0 !important;}</style>';
}

/***
* CREATE acf-json FOLDER IF IT DOESN'T EXIST
***/
function nw_afc_plugin_init() {
	if(class_exists('acf')) {
		
		$theme_dir = get_template_directory();
		$folder = $theme_dir.'/acf-json';
		if (!is_dir($folder)) {
			mkdir($folder, 0755);
		}

	}
}
add_action( 'after_setup_theme', 'nw_afc_plugin_init' );


/***
* ADD WOOCOMMERCE SHOP PAGE TO PAGE TYPES FILTER
***/

add_filter( 'acf/location/rule_values/page_type', function ( $choices ) {
	$choices['woo_shop_page'] = 'WooCommerce Shop Page';
	return $choices;
});

add_filter( 'acf/location/rule_match/page_type', function ( $match, $rule, $options ) {
	if ( $rule['value'] == 'woo_shop_page' && isset( $options['post_id'] ) ){
		if (function_exists('wc_get_page_id')){
			
			$shop_id = wc_get_page_id('shop');
			if (defined('ICL_LANGUAGE_CODE')) {
				$trnslated_shop_id = apply_filters( 'translate_object_id', $shop_id, 'page', false, ICL_LANGUAGE_CODE );
			} else {
				$trnslated_shop_id = $shop_id;
			}
			
			if ( $rule['operator'] == '==' ){
				$match = ( $options['post_id'] == $trnslated_shop_id);
			}
			if ( $rule['operator'] == '!=' ){
				$match = ( $options['post_id'] != $trnslated_shop_id);
			}
		}
	}
	return $match;
}, 10, 3 );


/***
* ADDING A CUSTOM RULE - USE IT TO ONLY ALLOW THE MENU FIELDS TO SHOW WHEN DEPTH = 0
* https://support.advancedcustomfields.com/forums/topic/conditional-logic-on-menu-item/
***/

function acf_location_rules_types($choices)
{
    $choices['Menu']['menu_level'] = 'Menu Depth';
    return $choices;
}

add_filter('acf/location/rule_types', 'acf_location_rules_types');

add_filter('acf/location/rule_values/menu_level', 'acf_location_rule_values_level');
function acf_location_rule_values_level($choices)
{
    $choices[0] = '0';

    return $choices;
}
add_filter('acf/location/rule_match/menu_level', 'acf_location_rule_match_level', 10, 4);
function acf_location_rule_match_level($match, $rule, $options, $field_group)
{
    $current_screen = get_current_screen();
    if ($current_screen->base == 'nav-menus') {
        if ($rule['operator'] == "==") {
            $match = ($options['nav_menu_item_depth'] == $rule['value']);
        }
    }
    return $match;
}
