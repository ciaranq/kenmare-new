<?php
/***
* TEXT + IMAGE PANEL
***/
$position = (  '' !== get_sub_field('ti_panel_text_position') ) ? get_sub_field('ti_panel_text_position') : null;
$text = (  '' !== get_sub_field('ti_panel_text') ) ? get_sub_field('ti_panel_text') : null;
$images = (  '' !== get_sub_field('ti_panel_images') ) ? get_sub_field('ti_panel_images') : null;
$background = (  '' !== get_sub_field('ti_panel_background') ) ? get_sub_field('ti_panel_background') : null;

// $position = get_sub_field('ti_panel_text_position');
// $text = get_sub_field('ti_panel_text');
// $images = get_sub_field('ti_panel_images');
// $background = get_sub_field('ti_panel_background');
// var_dump($background);
?>

<section class="panel-layout <?php if ($background == "Background2") { ?> panel-style-Background2   <?php } ?> ">
	<div class="panel-content">

		<div class="ti-panel-contents ti-panel-contents-text-<?php echo $position?>">

			<div class="ti-panel-image-block">

				<div class="ti-panel-image-items">
					<?php
                    if ($images) {
                        if (count($images)> 1) {
                            $size = 'imgsize-medium-3to2';
                        } else {
                            $size = 'medium';
                        }
                        foreach ($images as $image) {
                            ?>
							<div class="ti-panel-image-item">
								<?php
                  $img_id = $image['ti_panel_images_image'];
                            $img = wp_get_attachment_image($img_id, $size, false, array('class'=>'ti-panel-img'));
							 echo $img;
                             ?>
							</div>
							<?php
                        }
                    }
                    ?>
				</div>

			</div>

			<div class="ti-panel-text-block">
				<?php
                echo do_shortcode(wpautop($text));
                ?>
			</div>

		</div>

	</div>
</section>
