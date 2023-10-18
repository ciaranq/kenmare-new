<?php
/***
* PRODUCT BY CATEGORY PANEL
***/

// $title = get_sub_field('product_by_category_panel_title');
// $button_url = get_sub_field('product_by_category_panel_button_url');
// $button_text = get_sub_field('product_by_category_panel_button_text');
// $categories = get_sub_field('product_by_category_panel_category_blocks');

$title = (  '' !== get_sub_field('product_by_category_panel_title') ) ? get_sub_field('product_by_category_panel_title') : null;
$button_url = (  '' !== get_sub_field('product_by_category_panel_button_url') ) ? get_sub_field('product_by_category_panel_button_url') : null;
$button_text = (  '' !== get_sub_field('product_by_category_panel_button_text') ) ? get_sub_field('product_by_category_panel_button_text') : null;
$categories = (  '' !== get_sub_field('product_by_category_panel_category_blocks') ) ? get_sub_field('product_by_category_panel_category_blocks') : null;

if ($categories) {
	?>
	
	<section class="pbc-panel">
		<div class="pbc-panel-layout">
			
			<h3 class="h2 aligncenter"><?php echo $title; ?></h3>
			
			<div class="pbc-items">
				
				<?php
				foreach($categories as $category) {
					$img_id = $category['product_by_category_panel_category_image'];
					$cat = $category['product_by_category_panel_category'];
					$product_cat_id = $cat->term_id;
					$name = $cat->name;
					$slug = $cat->slug;
					?>
					<div class="pbc-item moving-up">
					
						<div class="pbc-image-block">
							<?php
							$img = wp_get_attachment_image($img_id, 'imgsize-medium-3to2', false, array('class'=>'pbc-img'));
							echo $img;
							?>
						</div>
						
						<div class="pbc-content">
						
							<h3 class="pbc-item-title aligncenter white"><?php echo $name;?></h3>
							
							<div class="pbc-menu">
								<?php
								$args = array(
									'post_type' => 'product',
									'product_cat' => $slug,
									'post_status' => 'publish',
									'numberposts' => -1,
									'orderby' => 'menu_order',
									'order' => 'ASC',
								);
								$products = get_posts($args);
								?>
									
								<select class="pbc-select" name="products-select" id="products-select">
									<option class="pbc-menu-title" disabled="disabled" selected="selected" >Choose Product&nbsp;&#x25BC;</option>
									<?php
									foreach($products as $product){										
										?>
										<option class="pbc-menu-items" value="/cart/?add-to-cart=<?php echo $product->ID; ?>&quantity=1"><?php echo $product->post_title; ?></option>
										<?php
									}
									?>
								</select>
								
								<input class="pbc-btn btn-white" type="submit" value="Add to Cart">
								
							</div>
						
						</div>
						
					</div>
					<?php
				}
				?>
			
			</div>
			
			<div class="aligncenter">
				<a class="btn-gold btn-gold--wide" href="<?php echo $button_url?>"><?php echo $button_text?></a>
			</div>
		
		</div>
	</section>
	<?php
}
?>
