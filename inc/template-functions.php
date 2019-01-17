<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package apples-and-snakes
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function aas_body_classes($classes)
{
	// Adds a class of hfeed to non-singular pages.
	if (!is_singular())
	{
		$classes[] = 'hfeed';
	}
	
	// Adds a class of no-sidebar when there is no sidebar present.
	if (!is_active_sidebar('sidebar-1'))
	{
		$classes[] = 'no-sidebar';
	}
	
	if (is_page('artist-resources'))
	{
		$classes[] = 'green-scheme';
	}
	
	if (is_post_type_archive('project') || is_singular('project'))
	{
		$classes[] = 'orange-scheme';
	}
	
	return $classes;
}

add_filter('body_class', 'aas_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function aas_pingback_header()
{
	if (is_singular() && pings_open())
	{
		printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
	}
}

add_action('wp_head', 'aas_pingback_header');

//function custom_archive_title($title)
//{
//	var_dump($title);
//	if (is_category() || is_post_type_archive())
//	{
//
//		$title = single_cat_title('', false);
//	}
//	else if (is_tag())
//	{
//
//		$title = single_tag_title('', false);
//	}
//	else if (is_author())
//	{
//
//		$title = '<span class="vcard">' . get_the_author() . '</span>';
//	}
//
//	return $title;
//}
//
//add_filter('the_archive_title', 'custom_archive_title');
