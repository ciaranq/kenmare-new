<?php
/***
* TESTIMONIAL PANEL
***/
// $imgid = get_sub_field('testimonial_image');
// $title = get_sub_field('testimonial_title');



$imgid = (  '' !== get_sub_field('testimonial_image') ) ? get_sub_field('testimonial_image') : null;
$title = (  '' !== get_sub_field('testimonial_title') ) ? get_sub_field('testimonial_title') : null;
?>
<section class="cp-testimonial-carousel ">
	<h3 class="aligncenter"><?php echo $title?></h3>
	<div class="testimonial-image-container">
		<?php
		if ($imgid) {
				$img = wp_get_attachment_image($imgid, 'large', false, array('class'=>'image-panel-img'));
				echo $img;
		}
		?>
		<div class="testimonial-overlay">
			<div class="banner-carousel">
				<?php
	if (have_rows('testimonial_carousel')) {
			while (have_rows('testimonial_carousel')) {
					the_row();
					$testimonial_text = get_sub_field('testimonial_text');
					$testimonial_author = get_sub_field('testimonial_author'); ?>
				<div class="item">
					<blockquote>
						<p class="testimonial-text"> <?php echo $testimonial_text?></p>
						<p class="testimonial-author"> <?php echo $testimonial_author?> </p>
					</blockquote>
				</div>
				<?php
					}
			}
			?>
			</div>
		</div>
	</div>
</section>
