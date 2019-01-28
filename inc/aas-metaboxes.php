<?php
/*
Plugin Name: Demo MetaBox
Plugin URI: http://en.bainternet.info
Description: My Meta Box Class usage demo
Version: 3.1.1
Author: Bainternet, Ohad Raz
Author URI: http://en.bainternet.info
*/

//include the main class file
require_once("aas-metaboxes/aas-metaboxes.php");
if (is_admin())
{
	global $pagenow;
	$post_id = !empty($_GET['post']) ? $_GET['post'] : (!empty($_POST['post_ID']) ? $_POST['post_ID'] : '');
	
	// who weve worked with
	//if ('post.php' == $pagenow && '70' == $post_id)
	if ('post.php' == $pagenow && '241' == $post_id)
	{
		$prefix = 'client_';
		
		$config = array(
			'id'             => 'clients', // meta box id, unique per meta box
			'title'          => 'Our Partners', // meta box title
			'pages'          => array('page'),
			'context'        => 'normal', // where the meta box appear: normal (default), advanced, side; optional
			'priority'       => 'high', // order of meta box: high (default), low; optional
			'fields'         => array(), // list of meta fields (can be added by field arrays)
			'local_images'   => false, // Use local or hosted images (meta box images for add/remove)
			'use_with_theme' => true
		);
		
		$clients = new AT_Meta_Box($config);
		
		$repeater_fields = array();
		$repeater_fields[] = $clients->addText($prefix . 'name', array('name' => 'Name'), true);
		$repeater_fields[] = $clients->addImage($prefix . 'logo', array('name' => 'Logo'), true);
		$repeater_fields[] = $clients->addTextarea($prefix . 'desc', array('name' => 'Description'), true);
		
		// repeater block
		$clients->addRepeaterBlock($prefix . 're_', array(
			'inline'   => false,
			'name'     => 'Partners',
			'fields'   => $repeater_fields,
			'sortable' => true
		));
		
		$clients->Finish();
		
		
		$prefix = 'client_fundraisers_';
		
		$config = array(
			'id'             => 'clients_fundraisers', // meta box id, unique per meta box
			'title'          => 'Fundraisers', // meta box title
			'pages'          => array('page'),
			'context'        => 'normal', // where the meta box appear: normal (default), advanced, side; optional
			'priority'       => 'high', // order of meta box: high (default), low; optional
			'fields'         => array(), // list of meta fields (can be added by field arrays)
			'local_images'   => false, // Use local or hosted images (meta box images for add/remove)
			'use_with_theme' => true
		);
		
		$client_fundraisers = new AT_Meta_Box($config);
		
		$repeater_fields = array();
		$repeater_fields[] = $client_fundraisers->addText($prefix . 'name', array('name' => 'Name'), true);
		$repeater_fields[] = $client_fundraisers->addImage($prefix . 'logo', array('name' => 'Logo'), true);
		$repeater_fields[] = $client_fundraisers->addTextarea($prefix . 'desc', array('name' => 'Description'), true);
		
		// repeater block
		$client_fundraisers->addRepeaterBlock($prefix . 're_', array(
			'inline'   => false,
			'name'     => 'Fundraisers',
			'fields'   => $repeater_fields,
			'sortable' => true
		));
		
		$client_fundraisers->Finish();
		
		$prefix = 'after_clients_';
		/*
		 * configure your meta box
		 */
		$config = array(
			'id'             => 'after_clients_textarea',
			'title'          => 'After Content Textarea',
			'pages'          => array('page'),
			'context'        => 'normal',
			'priority'       => 'high',
			'fields'         => array(),
			'local_images'   => false,
			'use_with_theme' => true
		);
		
		$my_meta = new AT_Meta_Box($config);
		
		$my_meta->addTextarea($prefix . 'textarea', array('name' => 'Text after content'));
		
		$my_meta->Finish();
	}
	
	
	//if ('post.php' == $pagenow && '73' == $post_id)
	if ('post.php' == $pagenow && '238' == $post_id)
	{
		$prefix = 'team_';
		
		$config = array(
			'id'             => 'team_members', // meta box id, unique per meta box
			'title'          => 'Our Team', // meta box title
			'pages'          => array('page'),
			'context'        => 'normal', // where the meta box appear: normal (default), advanced, side; optional
			'priority'       => 'high', // order of meta box: high (default), low; optional
			'fields'         => array(), // list of meta fields (can be added by field arrays)
			'local_images'   => false, // Use local or hosted images (meta box images for add/remove)
			'use_with_theme' => true
		);
		
		$team = new AT_Meta_Box($config);
		
		$repeater_fields[] = $team->addText($prefix . 'name', array('name' => 'Name'), true);
		$repeater_fields[] = $team->addText($prefix . 'role', array('name' => 'Role'), true);
		$repeater_fields[] = $team->addImage($prefix . 'picture', array('name' => 'Logo'), true);
		$repeater_fields[] = $team->addTextarea($prefix . 'desc', array('name' => 'Description'), true);
		
		// repeater block
		$team->addRepeaterBlock($prefix . 're_', array(
			'inline'   => false,
			'name'     => 'Team members',
			'fields'   => $repeater_fields,
			'sortable' => true
		));
		
		$team->Finish();
	}
	
	$front_id = get_option('page_on_front');
	if ('post.php' == $pagenow && $front_id == $post_id)
		//if ('post.php' == $pagenow && '238' == $post_id)
	{
		$prefix = 'front_slider_';
		
		$config = array(
			'id'             => 'front_slider', // meta box id, unique per meta box
			'title'          => 'Front Slider', // meta box title
			'pages'          => array('page'),
			'context'        => 'normal', // where the meta box appear: normal (default), advanced, side; optional
			'priority'       => 'high', // order of meta box: high (default), low; optional
			'fields'         => array(), // list of meta fields (can be added by field arrays)
			'local_images'   => false, // Use local or hosted images (meta box images for add/remove)
			'use_with_theme' => true
		);
		
		$team = new AT_Meta_Box($config);
		
		$repeater_fields[] = $team->addText($prefix . 'title', array('name' => 'Title'), true);
		$repeater_fields[] = $team->addText($prefix . 'date', array('name' => 'Date'), true);
		$repeater_fields[] = $team->addImage($prefix . 'image', array('name' => 'Background Image'), true);
		$repeater_fields[] = $team->addText($prefix . 'button_text', array('name' => 'Button Text'), true);
		$repeater_fields[] = $team->addText($prefix . 'button_link', array('name' => 'Button Link'), true);
		
		// repeater block
		$team->addRepeaterBlock($prefix . 're_', array(
			'inline'   => false,
			'name'     => 'Slides',
			'fields'   => $repeater_fields,
			'sortable' => true
		));
		
		$team->Finish();
	}
}
