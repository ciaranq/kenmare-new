<?php

// map the shortcode 'code' to the template file name
$nw_shortcode_blocks = array(
	'nw_sitemap' => 'sitemap',
	'nw_sm_links' => 'sm-links',
);

foreach($nw_shortcode_blocks as $tag=>$template) {
	add_shortcode($tag,'nw_do_shortcode_block');
}

function nw_do_shortcode_block($atts, $content, $tag) {
	global $nw_shortcode_blocks;
	global $nw_shortcode_atts;

	$nw_shortcode_atts = $atts;
	
	$shortcode_block_name = $nw_shortcode_blocks[$tag];
	$shortcode_block_template = dirname(__DIR__).'/lib/shortcode-block-templates/'.$shortcode_block_name.'.php';

	if (file_exists($shortcode_block_template)){
		
		//turn on output buffering to capture script output
		ob_start();
		
		//include the specified file
		require($shortcode_block_template);
		
		//assign the file output to variable and clean buffer
		$shortcode_block_content = ob_get_clean();
		
		//return the $content
		return $shortcode_block_content;

	}
}

 
?>