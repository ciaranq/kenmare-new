<?php
/***
* SHOP PAGES FOOTER PANELS PANELS
***/
if(have_rows('shop_footer_panels')){
	while(have_rows('shop_footer_panels')){
		the_row();

		if (get_row_layout() == 'ti_panel') {

			get_template_part('template-parts/cp-home-ti-panel');

		} else if (get_row_layout() == 'text_panel') {

			get_template_part('template-parts/cp-text-panel');

		} else if (get_row_layout() == 'crosslink_panel') {

			get_template_part('template-parts/cp-crosslink-panel');

		}
	}
}
?>
