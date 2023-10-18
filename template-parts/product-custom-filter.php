<div class="custom-filter">
	
	<div class="custom-filter-item">
		<?php woocommerce_result_count(); ?>
	</div>
	
	<div class="custom-filter-item">
		<?php the_widget( 'WC_Widget_Product_Categories', 'dropdown=1' );?>
	</div>
	
	<div class="custom-filter-item">

		<?php
		//$shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
		
		$orders = array(
			'menu_order' => 'Default sorting',
			'popularity' => 'Sort by popularity',
			'rating' => 'Sort by average rating',
			'date' => 'Sort by latest',
			'price' => 'Sort by price: low to high',
			'price-desc' => 'Sort by price: high to low',
		);
		
		$orderby = (isset($_GET['orderby']) && $_GET['orderby']!='') ? sanitize_text_field($_GET['orderby']): 'date';
		$action = $_SERVER['REQUEST_URI'];
		?>

		<form class="woocommerce-ordering" method="get" action="<?php echo $action?>">
			<div class="xcustom-select" style="width:200px;">
			<select name="orderby" id="orderby" class="orderby" aria-label="Shop order" >
				<?php
				foreach ($orders as $key=>$order) {
					$selected = ($orderby == $key) ? 'selected="selected"'  : '';
					?>
					<option value="<?php echo $key?>" <?php echo $selected?>><?php echo $order?></option>
					<?php
				}
				?>
			</select>
			</div>
			<input type="hidden" name="paged" value="1">
		</form>
	</div>
</div>
