<?php
/***
* TWO COLUMN TOUCHPOINT
***/

// $title = get_sub_field('touchpoint_title');
// $button_url = get_sub_field('button_url');
// $button_text = get_sub_field('button_text');
// $touchpoints = get_sub_field('two_product_touchpoints');

$title = (  '' !== get_sub_field('touchpoint_title') ) ? get_sub_field('touchpoint_title') : null;
$button_url = (  '' !== get_sub_field('button_url') ) ? get_sub_field('button_url') : null;
$button_text = (  '' !== get_sub_field('button_text') ) ? get_sub_field('button_text') : null;
$touchpoints = (  '' !== get_sub_field('two_product_touchpoints') ) ? get_sub_field('two_product_touchpoints') : null;



// $title_1 = $touchpoints['tc_title_1'];
// $title_2 = $touchpoints['tc_title_2'];
// $image_1 = $touchpoints['tc_image_1'];
// $image_2 = $touchpoints['tc_image_2'];

$title_1 = (  '' !== $touchpoints['tc_title_1'] ) ? $touchpoints['tc_title_1'] : null;
$title_2 = (  '' !== $touchpoints['tc_title_2'] ) ? $touchpoints['tc_title_2'] : null;
$image_1 = (  '' !== $touchpoints['tc_image_1'] ) ? $touchpoints['tc_image_1'] : null;
$image_2 = (  '' !== $touchpoints['tc_image_2'] ) ? $touchpoints['tc_image_2'] : null;



$img1 = wp_get_attachment_image($image_1, 'imgsize-medium-3to2', false, array('class'=>'tc-image'));
$img2 = wp_get_attachment_image($image_2, 'imgsize-medium-3to2', false, array('class'=>'tc-image'));


?>

<section id="tc-touchpoint" class="tc-panel tc-touchpoint">
	<div class="panel-content panel-layout">
		<h2 class="aligncenter tc-touchpoint-heading"><?php echo $title; ?></h2>
		<div class="tc-items tc-touchpoint-items">
			<div class="tc-image-overlay">
				<?php echo $img1; ?>
				<div class="tc-content">
					<?php if ( $title_1 ) { ?>
						<div class="tc-title">
							<h3 class="aligncenter"> <?php echo $title_1;  ?></h3>
						</div>
					<?php } ?>
					<div class="tc-menu">
						<?php
              $args = array(
                  'post_type'      => 'product',
                  'product_cat'    => 'organic',
                  'post_status'    => 'publish',
              );
                $loop = new WP_Query($args);

             ?>

							<div class="tc-menu-item">
									<select class="tc-menu-item-link" name="products-select" id="products-select">
											<span class="tc-menu-title">
                        <option class="tc-menu-title" disabled="disabled" selected="selected" ><?php echo esc_html_e( 'Choose Product', 'kenmare_td' ); ?>&nbsp;</option>
												<?php while ($loop->have_posts()) : $loop->the_post();
                ?>
										<option class="tc-menu-items" value="/cart/?add-to-cart=<?php echo get_the_id(); ?>&quantity=1/#tc-touchpoint"><?php echo get_the_title(); ?></option>
									<?php	endwhile;
    							wp_reset_query();
									?>
									</select>
							</div>
              <input class="btn-white" type="submit" id="goBtn" value="Add to Cart">
					</div>
				</div>
			</div>
			<div class="tc-image-overlay">

	<?php echo $img2; ?>
				<div class="tc-content">
					<div class="tc-title">
						<h3 class="aligncenter"> 	<?php echo $title_2; ?></h3>
					</div>
					<div class="tc-menu">
						<?php
							$args = array(
									'post_type'      => 'product',
									'product_cat'    => 'mild',
									'post_status'    => 'publish',
							);
								$loop = new WP_Query($args);

						 ?>

							<div class="tc-menu-item">
									<select class="tc-menu-item-link" name="products-select" id="products-select">
											<span class="tc-menu-title">
												<option class="tc-menu-title" disabled="disabled" selected="selected" ><?php  echo esc_html_e( 'Choose Product', 'kenmare_td' ); ?>&nbsp;</option> echo
												<?php while ($loop->have_posts()) : $loop->the_post();
								?>
										<option class="tc-menu-items" value="/cart/?add-to-cart=<?php echo get_the_id(); ?>&quantity=1/#tc-touchpoint"><?php echo get_the_title(); ?></option>
									<?php	endwhile;
									wp_reset_query();
									?>
									</select>
							</div>
							<input class="btn-white" type="submit" id="goBtn" value="Add to Cart">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="aligncenter">
		<a class="tc-touchpoint-button btn-gold btn-gold--wide" href="<?php echo $button_url?>"><?php echo $button_text?></a>
	</div>
</section>
