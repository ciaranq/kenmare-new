<?php
if(have_rows('home_carousel') && !is_search()){
	get_template_part('template-parts/banner-carousel');
} else {
	get_template_part('template-parts/banner-internal');
}
?>
