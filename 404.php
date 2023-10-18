<?php
get_header();
?>

<div class="main">

	<?php
	$the_page = null;
	$errorpage = get_page_by_path('404-page');
	$errorpageid = ($errorpage)?$errorpage->ID:null; 
	if ($errorpageid !== 0) {
		// Typecast to an integer
		$errorpageid = (int) $errorpageid;
		// Get our page
		$the_page = get_page($errorpageid);
	}
	?>

	<section class="panel-layout">
		<div class="panel-content">
			
			<?php
			/***
			* MAIN CONTENT
			***/
			
			if ($the_page) {
				$main_content = $the_page->post_content;
				echo do_shortcode(wpautop($main_content));
			} else {
				?>
				<h3><?php echo esc_html_e( 'Page not found', 'kenmare_td' ); ?></h3>
				<p><?php echo esc_html_e( 'The page you were looking for was not found.', 'kenmare_td' ); ?></p>
			<?php
			}
			?>
			<p><?php echo esc_html_e( 'You could try searching for what you were looking for here:', 'kenmare_td' ); ?></p>
			<p><?php get_search_form(); ?></p>
		</div>
	</section>
</div>



<?php get_footer(); ?>
