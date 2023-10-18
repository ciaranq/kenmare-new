<?php
function nw_new_customizer_settings($wp_customize) {

	// remove site icon
	$wp_customize->remove_control('site_icon');

	// fields
	$wp_customize->add_setting('nw_default_banner_img');
	$wp_customize->add_control(
		new WP_Customize_Media_Control( $wp_customize, 'nw_default_banner_img',
			array(
				'section' => 'title_tagline',
				'label' => 'Default Banner Image',
				'mime_type' => 'image',
				'settings' => 'nw_default_banner_img',
				'description' => 'Will be shown on the top of the page if a image banner is not set for that page.',
			)
		)
	);

	/***
	* HEADER LINK SECTION
	***/
	// set up a new section
	// $wp_customize->add_section( 'nw_header_link' , array(
	// 	'title'      => 'Header Link',
	// 	'priority'   => 20,
	// ));
	//
	// $wp_customize->add_setting('nw_header_button_label');
	// $wp_customize->add_control(
	// 	new WP_Customize_Control( $wp_customize, 'nw_header_button_label',
	// 		array(
	// 			'section' => 'nw_header_link',
	// 			'label' => 'Header Button Label',
	// 			'settings' => 'nw_header_button_label',
	// 		)
	// 	)
	// );
	//
	// $wp_customize->add_setting('nw_header_button_links_to');
	// $wp_customize->add_control(
	// 	new WP_Customize_Control( $wp_customize, 'nw_header_button_links_to',
	// 		array(
	// 			'section' => 'nw_header_link',
	// 			'label' => 'Header Button Links To',
	// 			'settings' => 'nw_header_button_links_to',
	// 		)
	// 	)
	// );



	/***
	* SOCIAL MEDIA LINKS SECTION
	***/

	// set up a new section
	$wp_customize->add_section( 'nw_sm_links' , array(
		'title'      => 'Social Media',
		'priority'   => 999,
	));


	$wp_customize->add_setting('nw_footer_social_media_text');
	$wp_customize->add_control(
		new WP_Customize_Control( $wp_customize, 'nw_footer_social_media_text',
			array(
				'section' => 'nw_sm_links',
				'label' => 'Footer Social Media Text',
				'settings' => 'nw_footer_social_media_text',
			)
		)
	);


	$smsites = array(
		'facebook',
		'twitter',
		'youtube',
		'instagram',
		'linkedin',
	);
	foreach($smsites as $smsite) {
		// add setting & control to that section
		$wp_customize->add_setting('nw_'.$smsite.'_url');
		$wp_customize->add_control(
			new WP_Customize_Control( $wp_customize, 'nw_'.$smsite.'_url',
				array(
					'section' => 'nw_sm_links',
					'label' => ucfirst($smsite).' URL',
					'settings' => 'nw_'.$smsite.'_url',
				)
			)
		);
	}

	/***
	* FOOTER NEWSLETTER
	***/

	// set up a new section
	$wp_customize->add_section( 'nw_footer_newsletter' , array(
		'title'      => 'Footer Newsletter',
		'priority'   => 999,
	));


	$wp_customize->add_setting('nw_footer_newsletter_text');
	$wp_customize->add_control(
		new WP_Customize_Control( $wp_customize, 'nw_footer_newsletter_text',
			array(
				'section' => 'nw_footer_newsletter',
				'label' => 'Footer Newsletter Text',
				'settings' => 'nw_footer_newsletter_text',
			)
		)
	);
	
	/***
	* ADD TO WOOCOMMERCE PRODUCTS SECTION
	***/
	$wp_customize->add_setting('nw_product_banner_overlay_title');
	$wp_customize->add_control(
		new WP_Customize_Control( $wp_customize, 'nw_product_banner_overlay_title',
			array(
				'section' => 'woocommerce_product_catalog',
				'label' => 'Product Banner Overlay Title',
				'settings' => 'nw_product_banner_overlay_title',
			)
		)
	);

	

}
add_action('customize_register', 'nw_new_customizer_settings');
