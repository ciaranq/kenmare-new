<?php
/***
* TEXT + IMAGE PANEL
***/
// $position = get_sub_field('ti_panel_text_position');
// $text = get_sub_field('ti_panel_text');
// $images = get_sub_field('ti_panel_images');


$position = ( '' !== get_sub_field('ti_panel_text_position') ) ? get_sub_field('ti_panel_text_position') : null;
$text = ( '' !== get_sub_field('ti_panel_text') ) ? get_sub_field('ti_panel_text') : null;
$images = ( '' !== get_sub_field('ti_panel_images') ) ? get_sub_field('ti_panel_images') : null;
?>
<div class="panel-style-top-bg">
</div>
<section class="panel-layout  ">
	<div class="panel-content ">

		<div class="ti-panel-contents ti-panel-contents-text-<?php echo $position?>">

			<div class="ti-panel-image-block">
				<?php
				if ($images) {
					if (count($images)> 1) {
						$class = ' ti-panel-multi-img';
					} else {
						$class = ' ti-panel-single-img';
					}

					foreach($images as $image) {
						$img_id = $image['ti_panel_images_image'];
						$img = wp_get_attachment_image( $img_id, 'medium', false, array('class'=>'ti-panel-img'.$class) );
						echo $img;
					}
				}
				?>
			</div>

			<div class="ti-panel-text-block">
				<?php
				echo do_shortcode(wpautop($text));
				?>
			</div>

		</div>

	</div>
</section>
