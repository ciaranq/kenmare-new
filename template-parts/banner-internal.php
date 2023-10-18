<?php
global $post;
global $this_page;

/***
* INTERNAL PAGE BANNER
***/
if (is_shop()) {
	$shop_id = get_option('woocommerce_shop_page_id');	
	$page_for_banner = get_post($shop_id);
	$current_id = $page_for_banner->ID;
} else if (is_404()|| is_category() || is_archive() || is_single()) {
	$news_page_id = get_option('page_for_posts');
	$page_for_banner = get_post($news_page_id);
	$current_id = $page_for_banner->ID;
} else {
	$current_id = get_the_ID();
	$page_for_banner = $this_page;
}
$fields        = get_fields( $current_id );
// $banner_imgid = ;
$banner_imgid = ( isset( $fields['banner_image'] ) && '' !== $fields['banner_image'] ) ? $fields['banner_image'] : null;
$title = ( isset( $fields['banner_overlay_title'] ) && '' !== $fields['banner_overlay_title'] ) ? $fields['banner_overlay_title'] : null;
$background = ( isset( $fields['banner_background'] ) && '' !== $fields['banner_background'] ) ? $fields['banner_background'] : null;
$quote = ( isset( $fields['banner_quote'] ) && '' !== $fields['banner_quote'] ) ? $fields['banner_quote'] : null;
$author = ( isset( $fields['banner_author'] ) && '' !== $fields['banner_author'] ) ? $fields['banner_author'] : null;

// $banner_imgid = get_field('banner_image', $current_id);
// $title = get_field('banner_overlay_title', $current_id);
// $background = get_field('banner_background', $current_id);
// $quote =	get_field('banner_quote', $current_id);
// $author =	get_field('banner_author', $current_id);

if (!$title && is_woocommerce()) {
	$title = get_theme_mod('nw_product_banner_overlay_title');
} else if (!$title && !is_search()) {
	$title = get_the_title($current_id);
} elseif (is_search()) {
	$title = 'Search Results';
}

if (!$banner_imgid) {
	$banner_imgid = get_theme_mod('nw_default_banner_img');
}

if ($banner_imgid) {
	$banner_image = wp_get_attachment_image($banner_imgid, 'large', false, array('class'=>'banner-image'));
}else{
	$banner_image = null;
}

if ($banner_image) {
?>
<section class="panel-banner banner-internal <?php if ($background == "Background1") { ?> panel-banner-internal--background-1  <?php } ?>">
	<div class="panel-banner-internal">
	<?php echo $banner_image; ?>
		<div class="banner-internal-overlay">
			<?php
      if ($background == "Background2") { ?>
				<div class="banner-internal-blockquote">
					<h2 class="banner-internal-overlay-title "><?php echo $title; ?></h2>
					<?php if ( $quote ) { ?>
						<p class="banner-internal-overlay-quote">"<?php echo $quote;?>"</p>
					<?php } ?>
					<?php if ( $author ) { ?>
						<p class="banner-internal-overlay-author"><?php echo $author;?></p>
					<?php } ?>
				</div>
        <?php
			} else {
				?>
				<h2 class="banner-internal-overlay-title"><?php echo $title; ?></h2>
				<?php
			}
			?>
		</div>
	</div>

</section>
<?php
}
?>
