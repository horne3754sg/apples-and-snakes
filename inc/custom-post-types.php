<?php

class ZGS_CPT
{
	public $post_type_name;
	public $post_type_args;
	public $post_type_labels;
	
	/* Class constructor */
	public function __construct($name, $args = array(), $labels = array())
	{
		// Set some important variables
		$this->post_type_name = $this->uglify($name);
		$this->post_type_args = $args;
		$this->post_type_labels = $labels;
		
		// Add action to register the post type, if the post type does not already exist
		if (!post_type_exists($this->post_type_name))
			add_action('init', array(&$this, 'register_post_type'), 0);
	}
	
	/* Method which registers the post type */
	public function register_post_type()
	{
		//Capitilize the words and make it plural
		$name = $this->beautify($this->post_type_name);
		$plural = $this->pluralize($name);
		
		// We set the default labels based on the post type name and plural. We overwrite them with the given labels.
		$labels = array_merge(
		
		// Default
			array(
				'name'               => _x($plural, 'post type general name'),
				'singular_name'      => _x($name, 'post type singular name'),
				'add_new'            => _x('Add New', strtolower($name)),
				'add_new_item'       => __('Add New ' . $name),
				'edit_item'          => __('Edit ' . $name),
				'new_item'           => __('New ' . $name),
				'all_items'          => __('All ' . $plural),
				'view_item'          => __('View ' . $name),
				'search_items'       => __('Search ' . $plural),
				'not_found'          => __('No ' . strtolower($plural) . ' found'),
				'not_found_in_trash' => __('No ' . strtolower($plural) . ' found in Trash'),
				'parent_item_colon'  => '',
				'menu_name'          => $plural
			),
			
			// Given labels
			$this->post_type_labels
		
		);
		
		// Same principle as the labels. We set some defaults and overwrite them with the given arguments.
		$args = array_merge(
		// Default
			array(
				'label'             => $plural,
				'labels'            => $labels,
				'public'            => true,
				'show_ui'           => true,
				'supports'          => array('title', 'editor', 'thumbnail'),
				'show_in_nav_menus' => true,
				'_builtin'          => false,
			),
			// Given args
			$this->post_type_args
		);
		
		// Register the post type
		register_post_type($this->post_type_name, $args);
	}
	
	/* Method to attach the taxonomy to the post type */
	public function add_taxonomy($name, $args = array(), $labels = array())
	{
		if (!empty($name))
		{
			// We need to know the post type name, so the new taxonomy can be attached to it.
			$post_type_name = $this->post_type_name;
			
			// Taxonomy properties
			$taxonomy_name = $this->uglify($name);
			$taxonomy_labels = $labels;
			$taxonomy_args = $args;
			
			if (!taxonomy_exists($taxonomy_name))
			{
				//Capitilize the words and make it plural
				$name = $this->beautify($name);
				$plural = $this->pluralize($name);
				
				// Default labels, overwrite them with the given labels.
				$labels = array_merge(
				
				// Default
					array(
						'name'              => _x($plural, 'taxonomy general name'),
						'singular_name'     => _x($name, 'taxonomy singular name'),
						'search_items'      => __('Search ' . $plural),
						'all_items'         => __('All ' . $plural),
						'parent_item'       => __('Parent ' . $name),
						'parent_item_colon' => __('Parent ' . $name . ':'),
						'edit_item'         => __('Edit ' . $name),
						'update_item'       => __('Update ' . $name),
						'add_new_item'      => __('Add New ' . $name),
						'new_item_name'     => __('New ' . $name . ' Name'),
						'menu_name'         => __($name),
					),
					// Given labels
					$taxonomy_labels
				);
				
				// Default arguments, overwritten with the given arguments
				$args = array_merge(
				// Default
					array(
						'label'             => $plural,
						'labels'            => $labels,
						'public'            => true,
						'show_ui'           => true,
						'show_in_nav_menus' => true,
						'show_admin_column' => true,
						'_builtin'          => false,
					),
					$taxonomy_args
				);
				
				// Add the taxonomy to the post type
				add_action('init',
					function () use ($taxonomy_name, $post_type_name, $args)
					{
						register_taxonomy($taxonomy_name, $post_type_name, $args);
					}, 0
				);
			}
			else
			{
				add_action('init',
					function () use ($taxonomy_name, $post_type_name)
					{
						register_taxonomy_for_object_type($taxonomy_name, $post_type_name);
					}, 0
				);
			}
		}
	}
	
	public function beautify($string)
	{
		return ucwords(str_replace('_', ' ', $string));
	}
	
	public function uglify($string)
	{
		return strtolower(str_replace(' ', '_', $string));
	}
	
	public function pluralize($string)
	{
		$last = $string[strlen($string) - 1];
		
		if ($last == 'y')
		{
			$cut = substr($string, 0, -1);
			//convert y to ies
			$plural = $cut . 'ies';
		}
		else if ($last == 's')
		{
			$plural = $string;
		}
		else
		{
			// just attach an s
			$plural = $string . 's';
		}
		
		return $plural;
	}
}

// case studies
$case_studies = array(
	'menu_position'       => apply_filters('case_study_post_type_menu_position', 5),
	'supports'            => array('title', 'editor', 'thumbnail'),
	'taxonomies'          => array('category', 'post_tag'),
	'hierarchical'        => false,
	'public'              => true,
	'rewrite'             => array('slug' => 'stories'),
	'show_ui'             => true,
	'show_in_menu'        => true,
	'show_in_admin_bar'   => true,
	'show_in_nav_menus'   => true,
	'can_export'          => true,
	'has_archive'         => true,
	'exclude_from_search' => false,
	'publicly_queryable'  => true,
	'capability_type'     => 'page',
	//'register_meta_box_cb' => 'aas_add_project_metaboxes',
);
$case_study = new ZGS_CPT('case_studies', $case_studies);

// projects
$projects = array(
	'menu_position'       => apply_filters('projects_post_type_menu_position', 5),
	'supports'            => array('title', 'editor', 'thumbnail'),
	'taxonomies'          => array('category', 'post_tag'),
	'hierarchical'        => false,
	'public'              => true,
	'show_ui'             => true,
	'show_in_menu'        => true,
	'show_in_admin_bar'   => true,
	'show_in_nav_menus'   => true,
	'can_export'          => true,
	'has_archive'         => true,
	'exclude_from_search' => false,
	'publicly_queryable'  => true,
	'capability_type'     => 'page',
	//'register_meta_box_cb' => 'aas_add_project_metaboxes',
);
$project = new ZGS_CPT('project', $projects);

// artist opportunities
$artists = array(
	'menu_position'        => apply_filters('artist_opportunities_post_type_menu_position', 5),
	'supports'             => array('title', 'editor', 'thumbnail'),
	//'taxonomies'           => array('category', 'post_tag'),
	'hierarchical'         => false,
	'public'               => true,
	'show_ui'              => true,
	'show_in_menu'         => true,
	'show_in_admin_bar'    => true,
	'show_in_nav_menus'    => true,
	'can_export'           => true,
	'has_archive'          => true,
	'exclude_from_search'  => false,
	'publicly_queryable'   => true,
	'capability_type'      => 'page',
	'register_meta_box_cb' => 'aas_add_opportunity_metaboxes'
);
$artist = new ZGS_CPT('opportunities', $artists);

// events
$events = array(
	'menu_position'        => apply_filters('events_post_type_menu_position', 5),
	'supports'             => array('title', 'editor', 'thumbnail'),
	//'taxonomies'           => array('category', 'post_tag'),
	'hierarchical'         => false,
	'public'               => true,
	'rewrite'              => array('slug' => 'whats-on'),
	'show_ui'              => true,
	'show_in_menu'         => true,
	'show_in_admin_bar'    => true,
	'show_in_nav_menus'    => true,
	'can_export'           => true,
	'has_archive'          => true,
	'exclude_from_search'  => false,
	'publicly_queryable'   => true,
	'capability_type'      => 'page',
	'register_meta_box_cb' => 'aas_add_event_metaboxes'
);
$event = new ZGS_CPT('event', $events);

// spotlight opportunities
$spotlights = array(
	'menu_position'       => apply_filters('spotlight_post_type_menu_position', 5),
	'supports'            => array('title', 'editor', 'thumbnail'),
	//'taxonomies'           => array('category', 'post_tag'),
	'hierarchical'        => false,
	'public'              => true,
	'show_ui'             => true,
	'show_in_menu'        => true,
	'show_in_admin_bar'   => true,
	'show_in_nav_menus'   => true,
	'can_export'          => true,
	'has_archive'         => true,
	'exclude_from_search' => false,
	'publicly_queryable'  => true,
	'capability_type'     => 'page',
	//'register_meta_box_cb' => 'aas_add_event_metaboxes',
);
$spotlight = new ZGS_CPT('spotlight', $spotlights);


// spotlight opportunities
$spines = array(
	'menu_position'       => apply_filters('spine_post_type_menu_position', 5),
	'supports'            => array('title', 'editor', 'thumbnail'),
	//'taxonomies'           => array('category', 'post_tag'),
	'hierarchical'        => false,
	'public'              => true,
	'rewrite'             => array('slug' => 'spine/%year%'),
	//'rewrite'             => true,
	'show_ui'             => true,
	'show_in_menu'        => true,
	'show_in_admin_bar'   => true,
	'show_in_nav_menus'   => true,
	'can_export'          => true,
	'has_archive'         => true,
	'exclude_from_search' => false,
	'publicly_queryable'  => true,
	'capability_type'     => 'page',
	//'register_meta_box_cb' => 'aas_add_event_metaboxes',
);
$spine = new ZGS_CPT('spines', $spines);

// Register Custom Post Type
function events()
{
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
		'new_item_name'     => __('New Event Locations', 'aas'),
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
		'name'              => _x('Case Study Location', 'taxonomy general name', 'aas'),
		'singular_name'     => _x('Case Study Locations', 'taxonomy singular name', 'aas'),
		'search_items'      => __('Search Case Study Locations', 'aas'),
		'all_items'         => __('All Case Study Locations', 'aas'),
		'parent_item'       => __('Parent Case Study Locations', 'aas'),
		'parent_item_colon' => __('Parent Case Study Locations:', 'aas'),
		'edit_item'         => __('Edit Case Study Locations', 'aas'),
		'update_item'       => __('Update Case Study Locations', 'aas'),
		'add_new_item'      => __('Add New Case Study Locations', 'aas'),
		'new_item_name'     => __('New Case Study Locations', 'aas'),
		'menu_name'         => __('Case Study Locations', 'aas'),
	);
	
	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array('slug' => 'case-study-location'),
	);
	
	register_taxonomy('case_study_location', array('case_studies'), $args);
	
	
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
		'new_item_name'     => __('New Article Types', 'aas'),
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
	
	
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x('Opportunities Type', 'taxonomy general name', 'aas'),
		'singular_name'     => _x('Opportunities Type', 'taxonomy singular name', 'aas'),
		'search_items'      => __('Search Opportunities Type', 'aas'),
		'all_items'         => __('All Opportunities Type', 'aas'),
		'parent_item'       => __('Parent Opportunities Type', 'aas'),
		'parent_item_colon' => __('Parent Opportunities Type:', 'aas'),
		'edit_item'         => __('Edit Opportunities Type', 'aas'),
		'update_item'       => __('Update Opportunities Type', 'aas'),
		'add_new_item'      => __('Add New Opportunities Type', 'aas'),
		'new_item_name'     => __('New Opportunities Type', 'aas'),
		'menu_name'         => __('Opportunities Type', 'aas'),
	);
	
	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array('slug' => 'artists/opportunities'),
	);
	
	register_taxonomy('opportunities_type', array('opportunities'), $args);
	
	
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x('Spine Type', 'taxonomy general name', 'aas'),
		'singular_name'     => _x('Spine Type', 'taxonomy singular name', 'aas'),
		'search_items'      => __('Search Spine Types', 'aas'),
		'all_items'         => __('All Spine Types', 'aas'),
		'parent_item'       => __('Parent Spine Type', 'aas'),
		'parent_item_colon' => __('Parent Spine Type:', 'aas'),
		'edit_item'         => __('Edit Spine Type', 'aas'),
		'update_item'       => __('Update Spine Type', 'aas'),
		'add_new_item'      => __('Add New Spine Type', 'aas'),
		'new_item_name'     => __('New Spine Type', 'aas'),
		'menu_name'         => __('Spine Type', 'aas'),
	);
	
	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array('slug' => 'spine'),
	);
	
	register_taxonomy('spine_type', array('spines'), $args);
}

add_action('init', 'events', 0);


add_permastruct(
	'spines',
	"/spine/%year%/%spines%/",
	array('with_front' => false)
);

add_rewrite_rule(
	'^spines/([0-9]{4})/?$',
	'index.php?post_type=spines&year=$matches[1]',
	'top'
);

function spines_permalinks($url, $post)
{
	if ('spines' == get_post_type($post))
	{
		$url = str_replace("%year%", get_the_date('Y'), $url);
	}
	
	return $url;
}

add_filter('post_type_link', 'spines_permalinks', 10, 2);


function spine_create_my_taxonomy()
{
	
	register_taxonomy(
		'event-category',
		'event',
		array(
			'label'        => __('Event Category'),
			'rewrite'      => array('slug' => 'event-category'),
			'hierarchical' => true,
		)
	);
}

add_action('init', 'spine_create_my_taxonomy');
