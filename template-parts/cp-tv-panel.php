<?php
/***
* TEXT + VIDEO PANEL
***/
// $position = get_sub_field('tv_panel_text_position');
// $text = get_sub_field('tv_panel_text');
// $video = get_sub_field('tv_panel_video');

$position = ( '' !== get_sub_field('tv_panel_text_position') ) ? get_sub_field('tv_panel_text_position') : null;
$text = ( '' !== get_sub_field('tv_panel_text') ) ? get_sub_field('tv_panel_text') : null;
$video = ( '' !== get_sub_field('tv_panel_video') ) ? get_sub_field('tv_panel_video') : null;
?>

<section class="panel-layout">
	<div class="panel-content">

		<div class="ti-panel-contents ti-panel-contents-text-<?php echo $position?>">

			<div class="ti-panel-image-block">

				<div class="ti-panel-image-items" id="moving-up">
					<?php
					if ($video) {
						// $imgid = $video['tv_videolink_image'];
						// $videolink_url = $video['tv_videolink_video_url'];
						// $video_title = $video['tv_video_title'];

						$imgid = ( '' !== $video['tv_videolink_image'] ) ? $video['tv_videolink_image'] : null;
						$videolink_url = ( '' !== $video['tv_videolink_video_url'] ) ? $video['tv_videolink_video_url'] : null;
						$video_title = ( '' !== $video['tv_video_title'] ) ? $video['tv_video_title'] : null;

						if ($videolink_url) {
							?>
							<a href="<?php echo $videolink_url;?>" class="tc-item-videolink-link">
							<?php
						}

						if ($imgid) {
							$img = wp_get_attachment_image( $imgid, 'medium', false, array('class'=>'tc-item-videolink-img'));
							echo $img;
						}

						if ($videolink_url) {
							?>
							<div class="tc-item-videolink-button"><?php  echo esc_html_e( 'Play Video', 'kenmare_td' ); ?></div>
						<div class="tc-item-videolink-title"><?php echo $video_title; ?></div>

							</a>
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
