<?php
/***
* TEAM PANEL
***/
// $team_carousel = get_sub_field('team_carousel');
// $heading = get_sub_field('team_carousel_heading');

$team_carousel = ( '' !== get_sub_field('team_carousel') ) ? get_sub_field('team_carousel') : null;
$heading = ( '' !== get_sub_field('team_carousel_heading') ) ? get_sub_field('team_carousel_heading') : null;
?>


<div class="panel-style-top-bg">
</div>


<section class="panel-layout panel-style-blue-bg ">
	<div class="panel-content">
		<h3 class="aligncenter aqua"><?php echo $heading?></h3>

		<?php
        if ($team_carousel) {
            ?>
		<div class="cp-team-layout team-carousel">
			<?php
				foreach ($team_carousel as $team) {
						// $imgid = $team['team_carousel_image'];
						// $name = $team['team_carousel_name'];
						// $title = $team['team_carousel_title'];
						// $text = $team['team_carousel_text'];
						// $url = $team['team_carousel_links_to'];

						$imgid = ( '' !== $team['team_carousel_image'] ) ? $team['team_carousel_image'] : null;
						$name = ( '' !== $team['team_carousel_name'] ) ? $team['team_carousel_name'] : null;
						$title = ( '' !== $team['team_carousel_title'] ) ? $team['team_carousel_title'] : null;
						$text = ( '' !== $team['team_carousel_text'] ) ? $team['team_carousel_text'] : null;
						$url = ( '' !== $team['team_carousel_links_to'] ) ? $team['team_carousel_links_to'] : null;


						$img = wp_get_attachment_image($imgid, 'thumbnail', false, array('class'=>'subnav-item-img')); ?>


			<div class="cp-team-overlay">
				<div class="cp-team-image">
			<?php echo $img?>
						<!-- <img class="aligncenter" style="width: 200px; height: 200px;" src="/wp-content/uploads/2022/07/Kenmare-story-right.jpg" alt=""> -->
					</div>
					<div class="cp-team-overlay-content">
						<?php if ( $name ) { ?>
							<p class="cp-team-name">
								<?php echo $name?>
							</p>
						<?php } ?>
						<?php if ( $title ) { ?>
							<p class="cp-team-title">
								<?php echo $title?>
							</p>
						<?php } ?>
						<?php if ( $text ) { ?>
							<p class="cp-team-text">
								<?php echo $text?>
							</p>
						<?php } ?>
				</div>
				<a class="btn cp-button" href="<?php echo $url?>"><?php  echo esc_html_e( 'Read More', 'kenmare_td' ); ?></a>
			</div>
			<?php } ?>
	</div>
	<?php } ?>
</section>
