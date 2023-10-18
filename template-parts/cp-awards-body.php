<?php
/***
* IMAGE PANEL
***/

$cpab_year = ( '' !== get_sub_field('cpab_year') ) ? get_sub_field('cpab_year') : null;
$cpab_awards = ( '' !== get_sub_field('cpab_awards') ) ? get_sub_field('cpab_awards') : null;
?>

<section class="panel-layout awards-body-panel ">
	<?php if ( $cpab_year ) {  ?>
		<h2 class="heading-2"> <?php echo esc_html( $cpab_year ); ?>  </h2>
	<?php } ?>
	<?php
	if ( $cpab_awards ) {
	?>
	<div class="awards-container">
			<?php
				foreach( $cpab_awards as $key =>  $cpay_award ){
					$ay_image = (isset($cpay_award['ay_image']) ) ? $cpay_award['ay_image'] : null;
					$ay_type = (isset($cpay_award['ay_type']) ) ? $cpay_award['ay_type'] : null;
					$ay_title = (isset($cpay_award['ay_title']) ) ? $cpay_award['ay_title'] : null;
					$ay_text = (isset($cpay_award['ay_text']) ) ? $cpay_award['ay_text'] : null;
					$ay_award_post_link = (isset($cpay_award['ay_award_post_link']) ) ? $cpay_award['ay_award_post_link'] : null;
					$ay_category = (isset($cpay_award['ay_category']) ) ? $cpay_award['ay_category'] : null;
					$ay_select_product = (isset($cpay_award['ay_select_product']) ) ? $cpay_award['ay_select_product'] : null;
					$ay_external_products = (isset($cpay_award['ay_external_products']) ) ? $cpay_award['ay_external_products'] : null;
					$ay_listing = (isset($cpay_award['ay_listing']) ) ? $cpay_award['ay_listing'] : null;
			?>

			
				<div class="awards-box">
				<div class="awards-box-inner">
					
						<?php
						if ($ay_image) {
							?>
						<div class="awards-panel-image">
						<?php
						$img = wp_get_attachment_image($ay_image, 'thumb_255', false, array('class'=>'')); ?>
						<?php if ( $ay_award_post_link ) {  ?> <a href="<?php echo esc_url( $ay_award_post_link['url'] ); ?>"><?php } ?>
						<?php echo $img; ?>
						<?php if ( $ay_award_post_link ) {  ?></a> <?php } ?>
						</div>
						<?php
									}
									?>
					
					<div class="awards-panel-text">
					<?php if ( $ay_title ) {  ?>
						<h4 class="heading-4"> 
						<?php if ( $ay_award_post_link ) {  ?> <a href="<?php echo esc_url( $ay_award_post_link['url'] ); ?>"><?php } ?>
						<?php echo esc_html( $ay_title ); ?>
						<?php if ( $ay_award_post_link ) {  ?></a> <?php } ?>
						</h4>
					<?php } ?>
					<?php if ( $ay_text ) {  ?>
						<div class="award-text"> <?php echo  $ay_text ; ?>  </div>
					<?php } ?>
					
					<?php if ( $ay_listing ) {  
							$ty_class =  esc_html( $ay_type );
						
						
					?>
						<div class="ac-content">
							<h6><?php esc_html_e( 'Award Type:', 'kenmare_td' ); ?></h6>
							<div class="type-item <?php echo $ty_class; ?>"><?php echo esc_html( $ay_listing ); ?></div>
						</div>
					<?php } ?>
					<?php if ( $ay_category ) {  ?>
						<div class="ac-content">
							<h6><?php esc_html_e( 'Category:', 'kenmare_td' ); ?></h6>
							<div class="category-item"><?php echo esc_html( $ay_category ); ?></div>
						</div>
					<?php } ?>
					<?php if ( $ay_select_product || $ay_external_products ) {  ?>
						<div class="ac-content">
							<h6><?php esc_html_e( 'Product:', 'kenmare_td' ); ?></h6>
							<div class="product-item">
							<?php
							if ( $ay_select_product ) {
							global $post;
							$lp_select_posts = array();
							$lp_select_posts = $ay_select_product;
							if ( $lp_select_posts ) {
								foreach ( $lp_select_posts as $lp_posts ) {
									$post = $lp_posts;
									setup_postdata( $post );
									$post_id         = $post->ID;
									?>
									<a href="<?php echo esc_url(get_the_permalink($post_id) ); ?>"><?php echo esc_html( get_the_title($post_id) ); ?></a>
									<?php
							
							}} wp_reset_query();wp_reset_postdata();}
							?>
							<?php
							if ( $ay_external_products ) {
								foreach( $ay_external_products as $key =>  $value ){
									$product = (isset($value['product']) ) ? $value['product'] : null;
									?>
									<a href="<?php echo esc_url($product['url'] ); ?>" target="<?php echo esc_html($product['target'] ); ?>"><?php echo esc_html($product['title'] ); ?></a>
									<?php
								}
							}
							?>
							</div>
						</div>
					<?php } ?>
					</div>
				<div class="clear"></div>
			</div>
			</div>
		<?php
			}
		?>
		
		</div>
	<?php
	}
	?>
	
</section>
