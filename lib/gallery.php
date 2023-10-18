<?php

// UPDATE GALLERY DEFAULTS
function nw_gallery_update_defaults( $settings ) {
		$settings['galleryDefaults']['link'] = 'file';
		$settings['galleryDefaults']['columns'] = '5';
    return $settings;
}
add_filter( 'media_view_settings', 'nw_gallery_update_defaults');