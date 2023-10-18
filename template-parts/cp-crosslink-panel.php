<?php
/***
* CROSSLINK PANEL
***/
// $crosslink = get_sub_field('crosslink_panel_crosslink');
// $background = get_field('background_options', $crosslink->ID);


$crosslink = ( '' !== get_sub_field('crosslink_panel_crosslink') ) ? get_sub_field('crosslink_panel_crosslink') : null;
$background = ( '' !== get_field('background_options', $crosslink->ID) ) ? get_field('background_options', $crosslink->ID) : null;





if ($crosslink) {
	
    ?>

<?php if ($background == "Background2") { ?>
  <div class="panel-style-top-bg">
  </div>
<?php } ?>
	<section class="crosslink-panel">

		<?php

$imgid = ( '' !== get_field('crosslink_image', $crosslink->ID) ) ? get_field('crosslink_image', $crosslink->ID) : null;
$title = ( '' !== get_field('crosslink_title', $crosslink->ID) ) ? get_field('crosslink_title', $crosslink->ID) : null;
$text = ( '' !== get_field('crosslink_text', $crosslink->ID) ) ? get_field('crosslink_text', $crosslink->ID) : null;
$btn_text = ( '' !== get_field('crosslink_button_text', $crosslink->ID) ) ? get_field('crosslink_button_text', $crosslink->ID) : null;
$links_to = ( '' !== get_field('crosslink_links_to', $crosslink->ID) ) ? get_field('crosslink_links_to', $crosslink->ID) : null;


    // $imgid = get_field('crosslink_image', $crosslink->ID);
    // $title = get_field('crosslink_title', $crosslink->ID);
    // $text = get_field('crosslink_text', $crosslink->ID);
    // $btn_text = get_field('crosslink_button_text', $crosslink->ID);
    // $links_to = get_field('crosslink_links_to', $crosslink->ID);
	$attr = array(
		'class'	=> 'wp-post-image',
	);
    $img = wp_get_attachment_image($imgid, 'large', false, $attr); ?>


		<a href="<?php echo $links_to?>" class="crosslink-link">
			<?php echo $img?>
			<div class="crosslink-content-text">
				<?php if ($text) {
        ?>
				<h4 class="h4 crosslink-title"><?php echo $title?></h4>
				<?php
		    }
		    if ($text) {
        ?>
				<h5 class="h3 crosslink-text aligncenter"><?php echo $text?></h5>
				<?php
		    }
		    if ($btn_text) {
        ?>
					<div class="crosslink-button">
						<span class="btn-gold"><?php echo $btn_text?></span>
					</div>
				<?php
    } ?>
			</div>
		</a>


	</section>
	<?php
}
        ?>
