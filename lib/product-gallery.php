<?php

/***
// remove default gallery thumbnail images
***/
// remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );
add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );
/***
//add custom gallery
***/
function wdm_add_custom_gallery()
{
    global $product;
    $product_id= wc_get_product($product);
    $attachment_ids = $product->get_gallery_image_ids();
    $image = wp_get_attachment_image_src(get_post_thumbnail_id($product_id), 'single-post-thumbnail');
    if ($attachment_ids) {
        echo '<div class="pd-gallery-slider">
          <div class="swiper-container">
          <div class="swiper-wrapper ">';
        foreach ($attachment_ids as $attachment_id) {
            $image_url = wp_get_attachment_url($attachment_id);
            $image = wp_get_attachment_image($attachment_id, 'imgsize-medium-3to2');
            echo '<div class="swiper-slide pd-gal-slide fx fx-jc fx-ac">
        <a class="fx fx-wrap fx-ae" data-fancybox="gallery" href="';
            echo $image_url;
            echo '" style="background: url(\'';
            echo $image_url;
						echo '\') ';
            echo 'center no-repeat;background-size:cover;">
            ';
            echo $image;
            echo '
          </a>
        </div>';
        }
        echo '</div>
          </div>
          </div>';

    }
}

add_action('woocommerce_after_single_product_summary', 'wdm_add_custom_gallery', 5);
