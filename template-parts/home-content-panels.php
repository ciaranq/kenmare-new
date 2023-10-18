<?php
/***
* HOME PAGE CONTENT PANELS
***/
if(have_rows('home_content_panels')){
	while(have_rows('home_content_panels')){
		the_row();

		if (get_row_layout() == 'ti_panel') {

			get_template_part('template-parts/cp-home-ti-panel');

		} elseif (get_row_layout() == 'text_panel') {

			get_template_part('template-parts/cp-text-panel');

		} elseif (get_row_layout() == 'two_column_panel') {

			get_template_part('template-parts/cp-two-column-panel');

		} elseif (get_row_layout() == 'instagram_panel') {

			get_template_part('template-parts/cp-instagram-panel');

		}	elseif (get_row_layout() == 'cp_testimonials') {

			get_template_part('template-parts/cp-testimonial-carousel');

		} elseif (get_row_layout() == 'product_by_category_panel') {

			get_template_part('template-parts/cp-product-by-category-panel');

		}	 


	}
}
?>
