<?php

// Register Custom Post Type
function events()
{
	
	$labels = array(
		'name'                  => _x('Events', 'Post Type General Name', 'aas'),
		'singular_name'         => _x('Event', 'Post Type Singular Name', 'aas'),
		'menu_name'             => __('Events', 'aas'),
		'name_admin_bar'        => __('Post Type', 'aas'),
		'archives'              => __('Events Archives', 'aas'),
		'attributes'            => __('Events Attributes', 'aas'),
		'parent_item_colon'     => __('Parent Event:', 'aas'),
		'all_items'             => __('All Events', 'aas'),
		'add_new_item'          => __('Add New Event', 'aas'),
		'add_new'               => __('Add New', 'aas'),
		'new_item'              => __('New Event', 'aas'),
		'edit_item'             => __('Edit Event', 'aas'),
		'update_item'           => __('Update Event', 'aas'),
		'view_item'             => __('View Event', 'aas'),
		'view_items'            => __('View Events', 'aas'),
		'search_items'          => __('Search Events', 'aas'),
		'not_found'             => __('Not found', 'aas'),
		'not_found_in_trash'    => __('Not found in Trash', 'aas'),
		'featured_image'        => __('Featured Image', 'aas'),
		'set_featured_image'    => __('Set featured image', 'aas'),
		'remove_featured_image' => __('Remove featured image', 'aas'),
		'use_featured_image'    => __('Use as featured image', 'aas'),
		'insert_into_item'      => __('Insert into event', 'aas'),
		'uploaded_to_this_item' => __('Uploaded to this event', 'aas'),
		'items_list'            => __('Events list', 'aas'),
		'items_list_navigation' => __('Events list navigation', 'aas'),
		'filter_items_list'     => __('Filter Events list', 'aas'),
	);
	$args = array(
		'label'                => __('Event', 'aas'),
		'description'          => __('Mauris non tempor quam, et lacinia sapien. Mauris accumsan eros eget libero posuere vulputate. Etiam elit elit, elementum sed varius at, adipiscing vitae est. Sed nec felis pellentesque, lacinia dui sed, ultricies.', 'aas'),
		'labels'               => $labels,
		'supports'             => array('title', 'editor', 'thumbnail'),
		'taxonomies'           => array('category', 'post_tag'),
		'hierarchical'         => false,
		'public'               => true,
		'show_ui'              => true,
		'show_in_menu'         => true,
		'menu_position'        => 5,
		'show_in_admin_bar'    => true,
		'show_in_nav_menus'    => true,
		'can_export'           => true,
		'has_archive'          => true,
		'exclude_from_search'  => false,
		'publicly_queryable'   => true,
		'capability_type'      => 'page',
		'register_meta_box_cb' => 'aas_add_event_metaboxes',
	);
	register_post_type('event', $args);
	
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x('Event Location', 'taxonomy general name', 'aas'),
		'singular_name'     => _x('Event Locations', 'taxonomy singular name', 'aas'),
		'search_items'      => __('Search Event Locations', 'aas'),
		'all_items'         => __('All Event Locations', 'aas'),
		'parent_item'       => __('Parent Event Locations', 'aas'),
		'parent_item_colon' => __('Parent Event Locations:', 'aas'),
		'edit_item'         => __('Edit Event Locations', 'aas'),
		'update_item'       => __('Update Event Locations', 'aas'),
		'add_new_item'      => __('Add New Event Locations', 'aas'),
		'new_item_name'     => __('New City Event Locations', 'aas'),
		'menu_name'         => __('Event Locations', 'aas'),
	);
	
	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array('slug' => 'event_location'),
	);
	
	register_taxonomy('event_location', array('event'), $args);
}

add_action('init', 'events', 0);
