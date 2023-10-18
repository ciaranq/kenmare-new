<?php
global $val_n, $val_pt, $val_dp, $results_title;

// get link to product landing page
$args = array(
	'post_type' => 'page',
	'fields' => 'ids',
	'meta_key' => '_wp_page_template',
	'meta_value' => 'template-product-landing-page.php',
	'numberposts' => 1,
	'post_status' => 'publish',
	'suppress_filters' => false // for WPML
);
$prod_posts = get_posts( $args );
$prod_post = $prod_posts[0];
$product_landing_page_url = get_permalink($prod_post);
?>


<form class="filter-form-panel" action="<?php echo $product_landing_page_url?>" method="get" data-aos="fade-in">
	<h5 class="filter-form-panel-title"><?php echo esc_html_e( 'Find Products:', 'kenmare_td' ); ?></h5>
	
	<?php
	if ($val_n) {
		$results_title .= '<em>\''.$val_n.'\'</em>, ';
	}
	?>
	<input type="text" name="n" placeholder="<?php echo esc_html_e( 'Search by Name', 'kenmare_td' ); ?>" value="<?php echo $val_n?>">
	
	<?php
	//$pt_label = ($val_pt) ? 'All Product Types' : 'Product Type';
	$pt_label = 'All Product Types';
	$product_types = get_terms('os_prod_type', array(
		'taxonomy' => 'os_prod_type',
		'orderby' => 'name',
		'suppress_filters' => false // for WPML
	));
	?>
	<select name="pt">
		<option value=""><?php echo $pt_label?></option>
		<?php
		foreach($product_types as $product_type){
			if ($product_type->slug == 'foodservice') {
				continue;
			}
			if ($val_pt == $product_type->slug) {
				$selected = ' selected="selected"';
				$results_title .= $product_type->name.', ';
			} else {
				$selected = '';
			}
			?>
			<option value="<?php echo $product_type->slug?>"<?php echo $selected?>><?php echo $product_type->name?></option>
			<?php
		}
		?>
	</select>

	<?php
	//$dp_label = ($val_dp) ? 'All Dietary Preferences' : 'Dietary Preference';
	$dp_label = 'All Dietary Preferences';
	?>
	<select name="dp">
		<option value=""><?php echo $dp_label?></option>
		<?php
		$dprefs = get_terms('product_dietary_preference', array(
			'taxonomy' => 'product_dietary_preference',
			'orderby' => 'name',
			'suppress_filters' => false // for WPML
		));
		
		foreach($dprefs as $dpref){
			if ($val_dp == $dpref->slug) {
				$selected = ' selected="selected"';
				$results_title .= $dpref->name.', ';
			} else {
				$selected = '';
			}
			?>
			<option value="<?php echo $dpref->slug?>"<?php echo $selected?>><?php echo $dpref->name?></option>
			<?php
		}
		?>
	</select>
	
	
	<input type="submit" value="Find Products" class="btn filter-form-panel-btn">
</form>
