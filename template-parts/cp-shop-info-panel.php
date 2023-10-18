<?php
/***
* INFO PANEL
***/
// $title = get_sub_field('info_panel_title');
// $text = get_sub_field('info_text');
// $imgid = get_sub_field('info_image');


$title = ( '' !== get_sub_field('info_panel_title') ) ? get_sub_field('info_panel_title') : null;
$text = ( '' !== get_sub_field('info_text') ) ? get_sub_field('info_text') : null;
$imgid = ( '' !== get_sub_field('info_image') ) ? get_sub_field('info_image') : null;

if ($title || $text) {
	?>
<section class="shop-panel-layout">
	<div class="panel-content panel-intro ">
		<div class="panel-intro-image-overlay">
			<?php
				if ($imgid) {
					$img = wp_get_attachment_image( $imgid, 'large', false, array('class'=>'panel-intro-image')  );
					echo $img;
				}
				?>
			<div class="panel-intro-content">
				<h3><?php echo $title?></h3>
				<p><?php echo $text?></p>
			</div>
		</div>
	</div>
</section>
<?php
}
?>
