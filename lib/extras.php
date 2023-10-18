<?php
/***
* RE-ENABLE EDITOR FOR 'POSTS' PAGE IN WP ADMIN
***/
add_action( 'edit_form_after_title', 'nw_posts_page_edit_form' );
function nw_posts_page_edit_form() {
	global $post, $post_type, $post_ID;
	if ( $post_ID == get_option( 'page_for_posts' ) ) {
		add_post_type_support( $post_type, 'editor' );
	}
}

/***
* REMOVE EDITOR FOR HOME PAGE
***/
$bHideEditor = TRUE;

function nw_remove_pages_editor(){
	global $post, $post_type, $post_ID;
	if ($post_ID == get_option( 'page_on_front' )) {
	//if ($post_ID != get_option( 'page_for_posts' )){
		remove_post_type_support( 'page', 'editor' );
	//}
	}
}
if ($bHideEditor) {
	add_action( 'edit_form_after_title', 'nw_remove_pages_editor' );
}


/***
* REMOVE EDITOR FROM PAGES WITH THESE TEMPLATES
***/
function nw_remove_editor() {
	if (isset($_GET['post'])) {
		$id = $_GET['post'];
		$template = get_post_meta($id, '_wp_page_template', true);
		switch ($template) {
			case '':
			case 'default':
			case 'xxx.php':
				// the below removes 'editor' support for 'pages'
				// if you want to remove for posts or custom post types as well
				// add this line for posts:
				// remove_post_type_support('post', 'editor');
				// add this line for custom post types and replace
				// custom-post-type-name with the name of post type:
				// remove_post_type_support('custom-post-type-name', 'editor');
				remove_post_type_support('page', 'editor');
				break;
			default :
				// Don't remove any other template.
				break;
		}
	}
}
add_action('init', 'nw_remove_editor');



/***
* FIX WORDPRESS EDITOR'S PREDELICTION TO ADDING LINEBREAKS AFTER SHORTCODES
***/
function nw_fix_wp_adding_linebreaks_to_shortcodes($content){
    $array = array (
        '<p>[' => '[',
        ']</p>' => ']',
        ']<br>' => ']',
        ']<br />' => ']'
    );

    $content = strtr($content, $array);
    return $content;
}
add_filter('the_content', 'nw_fix_wp_adding_linebreaks_to_shortcodes');

/***
* FORCE UPSCALING OF IMAGES TO FIT SPECIFIED THUMBNAIL SIZES
***/

function image_upscale_dimensions($default, $orig_w, $orig_h, $new_w, $new_h, $crop){

	if ( !$crop )
		return null; // let the wordpress default function handle this

	if ($orig_w >= $new_w && $orig_h >= $new_h)
		return null; // let the wordpress default function handle this

	//$aspect_ratio = $orig_w / $orig_h;
	$size_ratio = max($new_w / $orig_w, $new_h / $orig_h);

	$crop_w = round($new_w / $size_ratio);
	$crop_h = round($new_h / $size_ratio);

	if ( ! is_array( $crop ) || count( $crop ) !== 2 ) {
		$crop = array( 'center', 'center' );
	}

	list( $x, $y ) = $crop;

	if ( 'left' === $x ) {
		$s_x = 0;
	} elseif ( 'right' === $x ) {
		$s_x = $orig_w - $crop_w;
	} else {
		$s_x = floor( ( $orig_w - $crop_w ) / 2 );
	}

	if ( 'top' === $y ) {
		$s_y = 0;
	} elseif ( 'bottom' === $y ) {
		$s_y = $orig_h - $crop_h;
	} else {
		$s_y = floor( ( $orig_h - $crop_h ) / 2 );
	}

	return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h );
}
add_filter('image_resize_dimensions', 'image_upscale_dimensions', 10, 6);

/***
* DON'T ADD IMAGE SIZE TO SRCSET THAT IS LARGER THAN THE SPECIFIED IMAGES SIZE
***/

add_filter( 'wp_calculate_image_srcset', 'nw_remove_larger_image_srcset', 10, 5);
function nw_remove_larger_image_srcset($sources, $size_array, $image_src, $image_meta, $attachment_id) {
	$width = $size_array[0];

	foreach( $sources as $key=>$source ) {
		if ($key > $width){
			unset($sources[$key]);
		}
	}
	return $sources;
}



/***
* IFRAME SHORTCODE
***/

add_shortcode('iframe', 'nw_do_iframe_shortcode');
function nw_do_iframe_shortcode($atts, $content) {
 if (!$atts['width']) { $atts['width'] = '100%'; }
 if (!$atts['height']) { $atts['height'] = '400'; }

 return '<iframe frameborder="0" src="'.$atts['src'].'" width="'.$atts['width'].'" height="'.$atts['height'].'"></iframe>';
}

/***
* EXPAND SEARCH TO INCLUDE CUSTOM META
***/

/**
 * Join posts and postmeta tables
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_join
 */
function cf_search_join( $join ) {
    global $wpdb;

    if ( is_search() ) {
        $join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
    }

    return $join;
}
add_filter('posts_join', 'cf_search_join' );

/**
 * Modify the search query with posts_where
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_where
 */
function cf_search_where( $where ) {
    global $pagenow, $wpdb;

    if ( is_search() ) {
        $where = preg_replace(
            "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where );
    }

    return $where;
}
add_filter( 'posts_where', 'cf_search_where' );

/**
 * Prevent duplicates
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_distinct
 */
function cf_search_distinct( $where ) {
    global $wpdb;

    if ( is_search() ) {
        return "DISTINCT";
    }

    return $where;
}
add_filter( 'posts_distinct', 'cf_search_distinct' );

/***
* HIDE SOME ADMIN MENU ITEMS
***/

function remove_menus(){

  remove_menu_page( 'edit-comments.php' );          									//COMMENTS
	// remove_menu_page( 'edit.php' );          														//POSTS

	remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=category'); //CATEGORIES
	remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag'); //TAGS

}
add_action( 'admin_menu', 'remove_menus' );


// remove categories & tags meta boxes
function nw_remove_metaboxes() {
	remove_meta_box( 'categorydiv' , 'post' , 'normal' );
	remove_meta_box( 'tagsdiv-post_tag' , 'post' , 'normal' );
}
add_action( 'admin_menu' , 'nw_remove_metaboxes' );

/***
* COMPLETELY REMOVE CATEGORIES & TAGS
***/
function nw_unregister_cats_and_tags() {
	unregister_taxonomy_for_object_type( 'category', 'post' );
	unregister_taxonomy_for_object_type( 'post_tag', 'post' );
}
add_action( 'init', 'nw_unregister_cats_and_tags' );

/***
* STOP DRAFT PAGES APPEARING IN MENUS
***/
function exclude_draft_nav_items( $items, $menu, $args )
{
	global $wpdb;

	//add your custom posttypes to this array
	$allowed_posttypes = array( 'post', 'page' );

	$sql = "SELECT ID FROM {$wpdb->prefix}posts WHERE (post_status='draft' OR post_status='pending') AND ID=%d && post_type=%s";

	foreach ( $items as $k => $item )
	{
		if( in_array($item->object, $allowed_posttypes) )
		{
			$query = $wpdb->prepare( $sql, $item->object_id, $item->object );
			$result = $wpdb->get_var( $query );

			if( $result ) unset($items[$k]);
		}
	}

	return $items;
}
add_filter( 'wp_get_nav_menu_items', 'exclude_draft_nav_items', 10, 3 );

/***
* GET THE DEPTH OF A PAGE
***/

function nw_get_depth($postid) {
  $depth = ($postid==get_option('page_on_front')) ? -1 : 0;
  while ($postid > 0) {
    $postid = get_post_ancestors($postid);
    $postid = $postid[0];
    $depth++;
  }
  return $depth;
}

/***
* Move Yoast to bottom
***/
function yoasttobottom() {
	return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoasttobottom');

/***
* MOVE FEATURED IMAGE BOX POSITION TO BELOW TITLE ON POSTS PAGE
* - adjusted to hook into ACF's 'acf_after_title' context instead
***/

//set up the featured image meta in a new context
add_action('do_meta_boxes', 'nw_move_meta_box_to_new_context');
function nw_move_meta_box_to_new_context($post_type){
	if ( in_array( $post_type, array('post'))) {
		remove_meta_box( 'postimagediv', 'post', 'side' );
		add_meta_box('postimagediv', __('Featured Image'), 'post_thumbnail_meta_box', 'post', 'acf_after_title', 'high');
	}
}

//reposition the new context
//add_action('edit_form_after_title', 'nw_position_new_context');
function nw_position_new_context() {
	# Get the globals:
	global $post, $wp_meta_boxes;

	# Output the "nwnewcontext" meta boxes:
	do_meta_boxes( get_current_screen(), 'nwnewcontext', $post );

	# Remove the initial "nwnewcontext" meta boxes:
	unset($wp_meta_boxes['post']['nwnewcontext']);
}

//add css for the new context
//add_action('admin_head', 'nw_custom_css_for_new_context');
function nw_custom_css_for_new_context() {
  echo '<style>
    #nwnewcontext-sortables {
			margin-top:1.5em;
    }
  </style>';
}

/***
* MAKE FEATURED IMAGE REQUIRED
***/
add_action('save_post', 'nw_check_thumbnail');
add_action('admin_notices', 'nw_thumbnail_error');

function nw_check_thumbnail($post_id) {
    // change to any custom post type
    if(get_post_type($post_id) != 'post')
        return;
    //if 'auto-draft' or 'deleted'
    if(get_post_status($post_id) != 'publish')
        return;

    if ( !has_post_thumbnail( $post_id ) ) {
        // set a transient to show the users an admin message
        set_transient( "has_post_thumbnail", "no" );
        // unhook this function so it doesn't loop infinitely
        remove_action('save_post', 'nw_check_thumbnail');
        // update the post set it to draft
        wp_update_post(array('ID' => $post_id, 'post_status' => 'draft'));

        add_action('save_post', 'nw_check_thumbnail');
    } else {
        delete_transient( "has_post_thumbnail" );
    }
}

function nw_thumbnail_error()
{
    // check if the transient is set, and display the error message
    if ( get_transient( "has_post_thumbnail" ) == "no" ) {
				echo "<div id='message' class='error'><p><strong>You must set a Featured Image. Your Post is saved but it can not be published without a Featured Image.</strong></p></div>";
        delete_transient( "has_post_thumbnail" );
    }

}


/***
* CHANGE PREVIEW SIZE OF FEATURED IMAGE ON EDIT POST PAGE
***/

function nw_change_featured_image_size_in_admin( $downsize, $id, $size ) {
	if ( ! is_admin() || ! get_current_screen() || 'edit' !==   get_current_screen()->parent_base ) {
		return $downsize;
	}

	remove_filter( 'image_downsize', __FUNCTION__, 10, 3 );

	// settings can be thumbnail, medium, large, full
	$image = image_downsize( $id, 'medium' );
	add_filter( 'image_downsize', __FUNCTION__, 10, 3 );

	return $image;
}
add_filter( 'image_downsize', 'nw_change_featured_image_size_in_admin', 10, 3 );


/***
* ADD INSTRUCTION TO FEATURED IMAGE BOX ON EDIT POST PAGE
***/
function nw_admin_post_thumbnail_add_label($content, $post_id, $thumbnail_id)
{
    $post = get_post($post_id);
    if ($post->post_type == 'post') {
        $content = 'Featured Image is required.<br>Image Recommended dimensions: no more than 1400px width/height.'.$content;
        return $content;
    }

    return $content;
}
add_filter('admin_post_thumbnail_html', 'nw_admin_post_thumbnail_add_label', 10, 3);


/***
* ONLY LOAD CONTACT FORM 7 SCRIPTS & CSS ON PAGES WITH CONTACT PAGE TEMPLATE
***/
function nw_contactform7_dequeue_scripts() {
	global $wpdb;

	$nw_load_scripts = false;

	if(is_page_template('template-contact-page.php')){
		$nw_load_scripts = true;
	}

	if( ! $nw_load_scripts ) {
		wp_deregister_script( 'contact-form-7' );
		wp_deregister_script( 'google-recaptcha' );
		wp_dequeue_style( 'contact-form-7' );
	}

}
add_action( 'wp_enqueue_scripts', 'nw_contactform7_dequeue_scripts', 99 );
