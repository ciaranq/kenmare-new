<?php
/***
* IMAGE PANEL
***/
// $imgid = get_sub_field('image_panel_image');
$imgid = ( '' !== get_sub_field('image_panel_image') ) ? get_sub_field('image_panel_image') : null;
?>

<section class="image-panel">
	<?php
	if ($imgid) {
		$img = wp_get_attachment_image( $imgid, 'large', false, array('class'=>'image-panel-img')  );
		echo $img;
	}
	?>
</section>
