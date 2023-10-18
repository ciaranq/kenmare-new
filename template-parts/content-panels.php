<?php
/***
* CONTENT PANELS
***/
$fix_product_category_shortcode_reset = (isset($args['fix_product_category_shortcode_reset']) && $args['fix_product_category_shortcode_reset'] != '') ? $args['fix_product_category_shortcode_reset'] : null;

if(have_rows('content_panels')){
	while(have_rows('content_panels')){
		the_row();

		if (get_row_layout() == 'ti_panel') {

			get_template_part('template-parts/cp-ti-panel');

		} else if (get_row_layout() == 'tv_panel_video') {

			get_template_part('template-parts/cp-tv-panel');

		} else if (get_row_layout() == 'subnav_carousel_panel') {

			get_template_part('template-parts/cp-subnav-carousel-panel');

		} else if (get_row_layout() == 'text_panel') {

			get_template_part('template-parts/cp-text-panel');

		} else if (get_row_layout() == 'crosslink_panel') {

			get_template_part('template-parts/cp-crosslink-panel');

		} else if (get_row_layout() == 'videolink_panel') {

			get_template_part('template-parts/cp-videolink-panel');

		} else if (get_row_layout() == 'cp_info_panel') {

		 	get_template_part('template-parts/cp-shop-info-panel');

		} else if (get_row_layout() == 'image_panel') {

			get_template_part('template-parts/cp-image-panel');

		}  else if (get_row_layout() == 'team_carousel_panel') {

			get_template_part('template-parts/cp-team-panel');

		} else if (get_row_layout() == 'cp_testimonials') {

			get_template_part('template-parts/cp-testimonial-carousel');

		} else if (get_row_layout() == 'cp_awards_year') {

			get_template_part('template-parts/cp-awards-year');

		} else if (get_row_layout() == 'cp_awards_body') {

			get_template_part('template-parts/cp-awards-body');

		}
		
		/* when the loop returns from the [product_category] shortcode, the post isn't set up, so re-set it here */
		if ($fix_product_category_shortcode_reset) {
			$shop_id = get_option('woocommerce_shop_page_id');
			global $post; 
			$post = get_post($shop_id, OBJECT);
			setup_postdata($post);
		}

	}
}
?>
