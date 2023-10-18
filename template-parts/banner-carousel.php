<section class="panel-banner panel-banner--home">
	<div class="banner-carousel">
		<?php
			global $pID;
			global $fields;
			$home_carousel = ( isset( $fields['home_carousel'] ) && '' !== $fields['home_carousel'] ) ? $fields['home_carousel'] : null;
			
		$i = 0;
		if($home_carousel){
			foreach($home_carousel as $hm_carousel){
				$i++;
				$imgid = ( isset( $hm_carousel['home_carousel_image'] ) && '' !== $hm_carousel['home_carousel_image'] ) ? $hm_carousel['home_carousel_image'] : null;
				$overlay_title_span = ( isset( $hm_carousel['overlay_title_span'] ) && '' !== $hm_carousel['overlay_title_span'] ) ? $hm_carousel['overlay_title_span'] : null;
				$overlay_title = ( isset( $hm_carousel['home_carousel_overlay_title'] ) && '' !== $hm_carousel['home_carousel_overlay_title'] ) ? $hm_carousel['home_carousel_overlay_title'] : null;
				$overlay_btn = ( isset( $hm_carousel['overlay_button_link'] ) && '' !== $hm_carousel['overlay_button_link'] ) ? $hm_carousel['overlay_button_link'] : null;
				$overlay_btn_2 = ( isset( $hm_carousel['overlay_button_link_2'] ) && '' !== $hm_carousel['overlay_button_link_2'] ) ? $hm_carousel['overlay_button_link_2'] : null;
				$attr = array(
					'class'=>'carousel-img',
					//'sizes'=>'(max-width: 1079px) 100vw, (min-width: 1080px) and (max-width: 1199px) 1080px, 100vw',
				);

				if ($i == 1) {
					$attr['loading'] = false;
				} else {
					$attr['loading'] = "lazy";
				}
				?>

				<div class="item banner-carousel-item">
					<?php
					$img = '';
					if($imgid) {
						$img = wp_get_attachment_image( $imgid, 'imgsize-large-banner', false, $attr  );
						echo $img;
					}
					?>
					<div class="carousel-overlay">
						<h2 class="carousel-overlay-title">
							<span class="carousel-overlay-title-span h4"><?php echo $overlay_title_span?></span>
							<?php echo $overlay_title?></h2>
						<?php
						if ($overlay_btn){
							$url = $overlay_btn['url'];
							$title = $overlay_btn['title'];
							?>
							<a href="<?php echo $url?>" class="btn"><?php echo $title?></a>
							<?php
						}
						if ($overlay_btn_2){
							$url = $overlay_btn_2['url'];
							$title = $overlay_btn_2['title'];
							?>
							<a href="<?php echo $url?>" class="btn btn-gold"><?php echo $title?></a>
							<?php
						}
						?>
					</div>
				</div>
				<?php
			}
		}
		?>
	</div>
</section>
