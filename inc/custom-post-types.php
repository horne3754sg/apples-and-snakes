<?php

// Register Custom Post Type
function events()
{
	
	$labels = array(
		'name'                  => _x('Case Studies', 'Post Type General Name', 'aas'),
		'singular_name'         => _x('Case Study', 'Post Type Singular Name', 'aas'),
		'menu_name'             => __('Case Studies', 'aas'),
		'name_admin_bar'        => __('Post Type', 'aas'),
		'archives'              => __('Case Studies Archives', 'aas'),
		'attributes'            => __('Case Studies Attributes', 'aas'),
		'parent_item_colon'     => __('Parent Case Studies:', 'aas'),
		'all_items'             => __('All Case Studies', 'aas'),
		'add_new_item'          => __('Add New Case Studies', 'aas'),
		'add_new'               => __('Add New', 'aas'),
		'new_item'              => __('New Case Studies', 'aas'),
		'edit_item'             => __('Edit Case Studies', 'aas'),
		'update_item'           => __('Update Case Studies', 'aas'),
		'view_item'             => __('View Case Studies', 'aas'),
		'view_items'            => __('View Case Studies', 'aas'),
		'search_items'          => __('Search Case Studies', 'aas'),
		'not_found'             => __('Not found', 'aas'),
		'not_found_in_trash'    => __('Not found in Trash', 'aas'),
		'featured_image'        => __('Featured Image', 'aas'),
		'set_featured_image'    => __('Set featured image', 'aas'),
		'remove_featured_image' => __('Remove featured image', 'aas'),
		'use_featured_image'    => __('Use as featured image', 'aas'),
		'insert_into_item'      => __('Insert into case_studies', 'aas'),
		'uploaded_to_this_item' => __('Uploaded to this Case Studies', 'aas'),
		'items_list'            => __('Case Studies list', 'aas'),
		'items_list_navigation' => __('Case Studies list navigation', 'aas'),
		'filter_items_list'     => __('Filter Case Studies list', 'aas'),
	);
	$args = array(
		'label'               => __('Case Studies', 'aas'),
		'description'         => __('Mauris non tempor quam, et lacinia sapien. Mauris accumsan eros eget libero posuere vulputate. Etiam elit elit, elementum sed varius at, adipiscing vitae est. Sed nec felis pellentesque, lacinia dui sed, ultricies.', 'aas'),
		'labels'              => $labels,
		'supports'            => array('title', 'editor', 'thumbnail'),
		'taxonomies'          => array('category', 'post_tag'),
		'hierarchical'        => false,
		'public'              => true,
		'rewrite'             => array('slug' => 'case-studies'),
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
		//'register_meta_box_cb' => 'aas_add_project_metaboxes',
	);
	register_post_type('case_studies', $args);
	
	
	$labels = array(
		'name'                  => _x('Projects', 'Post Type General Name', 'aas'),
		'singular_name'         => _x('Project', 'Post Type Singular Name', 'aas'),
		'menu_name'             => __('Projects', 'aas'),
		'name_admin_bar'        => __('Post Type', 'aas'),
		'archives'              => __('Projects Archives', 'aas'),
		'attributes'            => __('Projects Attributes', 'aas'),
		'parent_item_colon'     => __('Parent Project:', 'aas'),
		'all_items'             => __('All Projects', 'aas'),
		'add_new_item'          => __('Add New Project', 'aas'),
		'add_new'               => __('Add New', 'aas'),
		'new_item'              => __('New Project', 'aas'),
		'edit_item'             => __('Edit Project', 'aas'),
		'update_item'           => __('Update Project', 'aas'),
		'view_item'             => __('View Project', 'aas'),
		'view_items'            => __('View Projects', 'aas'),
		'search_items'          => __('Search Projects', 'aas'),
		'not_found'             => __('Not found', 'aas'),
		'not_found_in_trash'    => __('Not found in Trash', 'aas'),
		'featured_image'        => __('Featured Image', 'aas'),
		'set_featured_image'    => __('Set featured image', 'aas'),
		'remove_featured_image' => __('Remove featured image', 'aas'),
		'use_featured_image'    => __('Use as featured image', 'aas'),
		'insert_into_item'      => __('Insert into project', 'aas'),
		'uploaded_to_this_item' => __('Uploaded to this Project', 'aas'),
		'items_list'            => __('Projects list', 'aas'),
		'items_list_navigation' => __('Projects list navigation', 'aas'),
		'filter_items_list'     => __('Filter Projects list', 'aas'),
	);
	$args = array(
		'label'               => __('Project', 'aas'),
		'description'         => __('Mauris non tempor quam, et lacinia sapien. Mauris accumsan eros eget libero posuere vulputate. Etiam elit elit, elementum sed varius at, adipiscing vitae est. Sed nec felis pellentesque, lacinia dui sed, ultricies.', 'aas'),
		'labels'              => $labels,
		'supports'            => array('title', 'editor', 'thumbnail'),
		'taxonomies'          => array('category', 'post_tag'),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
		//'register_meta_box_cb' => 'aas_add_project_metaboxes',
	);
	register_post_type('project', $args);
	
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
	
	register_taxonomy('event_location', array('event', 'project'), $args);
	
	
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x('Article Type', 'taxonomy general name', 'aas'),
		'singular_name'     => _x('Article Types', 'taxonomy singular name', 'aas'),
		'search_items'      => __('Search Article Types', 'aas'),
		'all_items'         => __('All Article Types', 'aas'),
		'parent_item'       => __('Parent Article Types', 'aas'),
		'parent_item_colon' => __('Parent Article Types:', 'aas'),
		'edit_item'         => __('Edit Article Types', 'aas'),
		'update_item'       => __('Update Article Types', 'aas'),
		'add_new_item'      => __('Add New Article Types', 'aas'),
		'new_item_name'     => __('New City Article Types', 'aas'),
		'menu_name'         => __('Article Types', 'aas'),
	);
	
	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array('slug' => 'articles'),
	);
	
	register_taxonomy('article_type', array('post'), $args);
}

add_action('init', 'events', 0);
