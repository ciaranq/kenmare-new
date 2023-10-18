<!doctype html>
<html lang="en">
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<!-- <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;600;700&display=swap" rel="stylesheet"> -->
<!-- load font without FOUT -->
<link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700&display=swap" >
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700&display=swap"  media="print" onload="this.media='all'" />
<link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@300;400;600;700&display=swap" >
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@300;400;600;700&display=swap"  media="print" onload="this.media='all'" />

<noscript>
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;600;700&display=swap" />
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@300;600;700&display=swap" />
</noscript>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="apple-touch-icon-precomposed" href="<?php echo get_stylesheet_directory_uri().'/touch-icon.png'?>"><?php //ios touch icon?>
<script>
  /*to prevent Firefox FOUC, this must be here*/
  0
</script>
<meta name="viewport" content="initial-scale=1, width=device-width">
<?php
wp_head();

// get all meta for this page
global $this_page;
$this_page = get_queried_object();


global $pID;
global $fields;
$pID = get_the_ID();
if ( is_home() ) {
	$pID = get_option( 'page_for_posts' );
}
if ( is_404() || is_archive() || is_category() || is_search() ) {
	$pID = get_option( 'page_on_front' );
}
$post_title = get_the_title( $pID );
if ( function_exists( 'get_fields' )  ) {
	$fields        = get_fields( $pID );
}

/*
//@cdtodo - google analytics - add via complianz plugin
//@cdtodo - add message to IE ppl that they cannot purchase (how? geosniffing?) UK + IE also not able to purchase. must go to quinlans site.
//@cdtodo - may need to 'translate' all shop page links once wpml is installed
*/
?>

</head>

<?php
// set up theme body classes & h1 content
if (is_front_page()) {
    $nw_body_class = ' home';
    $h1text = get_bloginfo('name').', '.get_bloginfo('description');
} else {
    $nw_body_class = ' internal';
    $h1text = ($post_title) ? $post_title : get_bloginfo('name').', '.get_bloginfo('description');
}
?>

<body <?php body_class($nw_body_class);?>>

	<div class="page-wrapper">
		<header class="page-header" id="main-header">

			<a class="logo" href="/" title="logo">
				<h1><?php echo $h1text ?></h1>
			</a>

			<div class="mobile-menu-link">
				<div class="menu-icon"></div>
			</div>

			<nav class="header-nav">
        <div class="header-upper-menus">
          <!-- <div class="header-nav-link">
            <?php
            // $button_url = get_theme_mod('nw_header_button_links_to');
            // $button_label = get_theme_mod('nw_header_button_label');

            // if ($button_url && $button_label) {
                ?>
              <a class="header-nav-btn" href="<?php //echo $button_url?>"><?php //echo $button_label?></a>
              <?php
            //}
            ?>
          </div> -->
              <?php
				if (has_nav_menu('header_links')) {
					wp_nav_menu(array(
						'menu_class' => 'header-links-menu',
						'container' => '',
						'theme_location' => 'header_links'
					));
				}
              ?>
          </div>
			<?php
				if (has_nav_menu('header_navigation')) {
					wp_nav_menu(array(
						'menu_class' => 'header-main-menu',
						'container' => '',
						'theme_location' => 'header_navigation',
					));
				}
			?>
        <ul  class="header-side-menu ">
        <?php
        // add account / login link
        if (is_user_logged_in()) {
            $link_text = "My Account";
        } else {
            $link_text = "sign in";
        } ?>
          <li class="login-button menu-item menu-item-type-post_type menu-item-object-page menu-item-720"><a href="/my-account/" title="Account"><?php echo $link_text; ?></a></li>
          <li class="menu-item cart-button menu-item-has-children">
					<?php 		
					//$cart_link = wc_get_cart_url();
					$cart_link = '/cart/';
      		$cart_count = WC()->cart->cart_contents_count;
      		if ($cart_count > 0) {
      			$cart_count_span = '<span class="cart-count cart-count-active">'.$cart_count.'</span>';
      		} else {
      			$cart_count_span = '<span class="cart-count cart-count-inactive">'.$cart_count.'</span>';
      		} ?>
            <a class="" href=<?php echo $cart_link ?> title="cart"><?php echo $cart_count_span ?></a>
          <ul class="nav-mini-cart">
            <li class="nav-mini-cart-items">
              <p class="mini-cart-heading"> <?php echo esc_html_e( 'Added to your cart', 'kenmare_td' ); ?>
                <span class="mini-cart-count"><?php echo esc_html_e( 'You have', 'kenmare_td' ); ?> <?php echo WC()->cart->get_cart_contents_count() ?> <?php echo esc_html_e( 'items in your cart', 'kenmare_td' ); ?></span>
              </p>
              <span class="mini-cart-dropdown"><?php woocommerce_mini_cart(); ?></span></li>
          </ul>
           </li>
           <li class="shop-button menu-item">
             <a class="shop-button-link" title="shop" href="/shop/"><?php echo esc_html_e( 'shop', 'kenmare_td' ); ?></a>
           </li>
        </ul>

			</nav>

		</header>

		<?php get_template_part('template-parts/banner'); ?>
