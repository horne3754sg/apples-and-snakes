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
	
	if ('post.php' == $pagenow && '70' == $post_id)
	{
		//if ('who-weve-worked-with' == $slug)
		$prefix = 'client_';
		
		$config = array(
			'id'             => 'clients', // meta box id, unique per meta box
			'title'          => 'Our Clients', // meta box title
			'pages'          => array('page'),
			'context'        => 'normal', // where the meta box appear: normal (default), advanced, side; optional
			'priority'       => 'high', // order of meta box: high (default), low; optional
			'fields'         => array(), // list of meta fields (can be added by field arrays)
			'local_images'   => false, // Use local or hosted images (meta box images for add/remove)
			'use_with_theme' => true
		);
		
		$clients = new AT_Meta_Box($config);
		
		$repeater_fields[] = $clients->addText($prefix . 'name', array('name' => 'Name'), true);
		$repeater_fields[] = $clients->addImage($prefix . 'logo', array('name' => 'Logo'), true);
		$repeater_fields[] = $clients->addTextarea($prefix . 'desc', array('name' => 'Description'), true);
		
		// repeater block
		$clients->addRepeaterBlock($prefix . 're_', array(
			'inline'   => false,
			'name'     => 'Clients',
			'fields'   => $repeater_fields,
			'sortable' => true
		));
		
		$clients->Finish();
	}
	
	
	if ('post.php' == $pagenow && '73' == $post_id)
	{
		//if ('who-weve-worked-with' == $slug)
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
}
