<?php

/*
Template Name: Redirect to Specified Page

 * @author		Dave Stewart
 * @email		dave@davestewart.co.uk
 * @web			www.davestewart.co.uk
 
 * @name		Page Redirect
 * @type		PHP page
 * @desc		Wordpress template that redirects the current page based on the content of the database entry it loads

 * @requires	Wordpress
 * @install		Copy this file to the directory of the theme you wish to use
 * usage		
			   1. Create a new Page in your Wordpress control panel
			   2. Enter the URL (or local path, relative to your Wordpress directory) you want to redirect to as the only page content
			   3. Set the Page Template to "Page Redirect"
			   4. Publish
 */

if (function_exists('have_posts') && have_posts()){
	while (have_posts()){
		// get the post
		the_post();
		
		// get content
		$link = get_the_content();

		// do the link
		header("Location: $link");
		die('');
	}

}
?>
