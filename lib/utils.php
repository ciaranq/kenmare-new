<?php
/**
 * Utility functions
 */

/* CUSTOM TRUNCATE STRING */
function nw_truncate_string($content, $length) {
	$content = strip_tags($content);
	if (strlen($content) > $length) {
		$content = substr($content, 0, strrpos(substr($content, 0, $length), ' '));
		$content .= '...';
	}
	return $content;
}
/* END CUSTOM TRUNCATE STRING */

/* CUSTOM FUNCTION TO ADD A CLASS TO A HTML TAG */
function nw_add_class_to_tagstring($classtoadd, $tag, $tagstring) {
	if (!$tagstring) {
		return false;
	}
	
	$dom = new DOMDocument;
	$dom->loadHTML($tagstring);
	
	$dom->removeChild($dom->doctype);
	$dom->replaceChild($dom->firstChild->firstChild->firstChild, $dom->firstChild);
	
	$tags = $dom->getElementsByTagName($tag);
	foreach($tags as $tagitem) {
		$tagitem->setAttribute('class', 
			$tagitem->getAttribute('class') . ' '.$classtoadd);
	}
	
	return $dom->saveHTML();

}

function nw_add_class_to_img($classtoadd, $tagstring) {
	return nw_add_class_to_tagstring($classtoadd, 'img', $tagstring);
}
/* END CUSTOM FUNCTION TO ADD A CLASS TO A HTML TAG */

/***
* GET FIRST IMAGE IN HTML BLOCK
***/
function getFirstImg($html){
  $dom = new DOMDocument;
  $dom->loadHTML($html);
  $images = $dom->getElementsByTagName('img');
  foreach ($images as $image) {
    return $image->getAttribute('src');
  }
  return false;
}