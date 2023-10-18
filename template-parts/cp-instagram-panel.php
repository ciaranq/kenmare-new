<?php
/***
* INSTAGRAM PANEL
***/

// $title = get_sub_field('instagram_panel_title');
// $shortcode = get_sub_field('instagram_panel_shortcode');


$title = (  '' !== get_sub_field('instagram_panel_title') ) ? get_sub_field('instagram_panel_title') : null;
$shortcode = (  '' !== get_sub_field('instagram_panel_shortcode') ) ? get_sub_field('instagram_panel_shortcode') : null;

?>

<section class="instagram-panel">
	<h3 class="instagram-panel-title"><?php echo $title ?></h3>
	<?php echo do_shortcode($shortcode) ?>
</section>
