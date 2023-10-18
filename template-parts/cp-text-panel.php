<?php
/***
* TEXT PANEL
***/

$text = (  '' !== get_sub_field('text_panel_text') ) ? get_sub_field('text_panel_text') : null;
$width = ('' !== get_sub_field('text_panel_width')) ? get_sub_field('text_panel_width'): null;

 //$text = get_sub_field('text_panel_text');
// $width = get_sub_field('text_panel_width');

?>

<section class="panel-layout">
	<div class="panel-content panel-text-content panel-text-content-<?php echo $width?>">
		<?php
		echo do_shortcode(wpautop($text));
		?>
	</div>
</section>
