<?php
/***
* THREE COLUMN PANEL
***/


$left_text = (  '' !== get_sub_field('tc_left_text_col') ) ? get_sub_field('tc_left_text_col') : null;
$videolink = (  '' !== get_sub_field('tc_videolink_col') ) ? get_sub_field('tc_videolink_col') : null;
$right_text = (  '' !== get_sub_field('tc_right_text_col') ) ? get_sub_field('tc_right_text_col') : null;

// $left_text = get_sub_field('tc_left_text_col');
// $videolink = get_sub_field('tc_videolink_col');
// $right_text = get_sub_field('tc_right_text_col');
?>
<section class="tc-panel">
	<div class="panel-content panel-layout">
		<div class="tc-items">
			<div class="tc-item-left-col">
				<?php  echo do_shortcode(wpautop($left_text)); ?>
				<div class="desktop-only" id="moving-up">
				<?php
          if ($videolink) {
              $imgid = $videolink['tc_videolink_image'];
              $has_videolink = $videolink['tc_videolink_is_videolink'];
              $videolink_url = $videolink['tc_videolink_video_url'];
              $videolink_title = $videolink['tc_videolink_title'];
              if ($has_videolink && $videolink_url) {
                  ?>
						<a href="<?php echo $videolink_url; ?>" class="tc-item-videolink-link">
						<?php
              }
              if ($imgid) {
                  $img =  wp_get_attachment_image($imgid, 'medium', false, array('class'=>'tc-item-videolink-img'));
				   echo $img;
                  
              }
              if ($has_videolink && $videolink_url) {
                  ?>
						<div class="tc-item-videolink-button"><?php  echo esc_html_e( 'Play Video', 'kenmare_td' ); ?></div>
						<div class="tc-item-videolink-title"><?php echo $videolink_title; ?></div>
						</a>
						<?php
              }
          }
                ?>
							</div>
			</div>
			<div class="tc-item-right-col">
			<?php
            echo do_shortcode(wpautop($right_text));
            ?>
			</div>
			<div class="tc-item-videolink-col mobile-only">
				<?php
				if ($videolink) {
					$imgid = $videolink['tc_videolink_image'];
					$has_videolink = $videolink['tc_videolink_is_videolink'];
					$videolink_url = $videolink['tc_videolink_video_url'];
					if ($has_videolink && $videolink_url) {
						?>
						<a href="<?php echo $videolink_url; ?>" class="tc-item-videolink-link">
						<?php
					}
					if ($imgid) {
						$img = wp_get_attachment_image($imgid, 'medium', false, array('class'=>'tc-item-videolink-img'));
						echo $img;
					}
					if ($has_videolink && $videolink_url) {
						?>
						<div class="tc-item-videolink-button">Play Video</div>
							<div class="tc-item-videolink-title"><?php echo $videolink_title; ?></div>
						</a>
						<?php
					}
				}
				?>
			</div>
		</div>
	</div>
</section>
