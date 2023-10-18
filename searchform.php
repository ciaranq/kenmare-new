<?php
global $s;
?>
<div class="search-form-wrap">
	<h4><?php  echo esc_html_e( 'Search our site', 'kenmare_td' ); ?></h4>		
	<form method="get" id="searchform" class="form-search" action="/">
		<label for="s" class="hidden-label"><?php  echo esc_html_e( 'Search', 'kenmare_td' ); ?></label>
		<input type="text" value="<?php echo esc_html($s); ?>" name="s" id="search" class="input-search" placeholder="Search" />
		<button type="submit" id="searchsubmit" class="button button-search" aria-label="Submit Search"><?php require get_template_directory().'/assets/svg/_search-svg.php';?></button>
	</form>
</div>
