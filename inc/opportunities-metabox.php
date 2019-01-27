<?php


/**
 * If you wanted to have two sets of metaboxes.
 */
function aas_add_opportunity_metaboxes()
{
	add_meta_box(
		'aas_opportunities_info',
		'Event Info',
		'aas_opportunities_info',
		'opportunities',
		'normal',
		'high'
	);
}

/**
 * Output the HTML for the metabox.
 */
function aas_opportunities_info()
{
	global $post;
	// Nonce field to validate form request came from current site
	wp_nonce_field(basename(__FILE__), 'opportunity_fields');
	
	// Get the when data if it's already been entered
	$when_order = get_post_meta($post->ID, 'when_order', true);
	$when_order = !empty($when_order) ? date('Y-m-d', $when_order) : date('Y-m-d');
	echo '<div><label>When (Used to Order Content and must be a valid date format)</label><input type="date" name="when_order" value="' . $when_order . '" class="widefat" placeholder="When? format: dd/mm/yyyy"></div></br>';
	
	// Get the when data if it's already been entered
	$when = get_post_meta($post->ID, 'when', true);
	echo '<div><label>When (Sidebar)</label><input type="text" name="when" value="' . esc_textarea($when) . '" class="widefat" placeholder="When?"></div></br>';
	
	// Get the when data if it's already been entered
	$when_featured = get_post_meta($post->ID, 'when_featured', true);
	echo '<div><label>When (Featured)</label><input type="text" name="when_featured" value="' . esc_textarea($when_featured) . '" class="widefat" placeholder="eg. Thurs 26 - Sun 28 Oct 2018"></div></br>';
	
	// Get the time data if it's already been entered
	$time = get_post_meta($post->ID, 'time', true);
	echo '<div><label>Time (Sidebar)</label><input type="text" name="time" value="' . esc_textarea($time) . '" class="widefat" placeholder="time"></div></br>';
	
	// Get the where data if it's already been entered
	$where = get_post_meta($post->ID, 'where', true);
	echo '<div><label>Where</label><input type="text" name="where" value="' . esc_textarea($where) . '" class="widefat" placeholder="Where?"></div></br>';
	
	// Get the address data if it's already been entered
	$address = get_post_meta($post->ID, 'address', true);
	echo '<div><label>Address</label><input type="text" name="address" value="' . esc_textarea($address) . '" class="widefat" placeholder="Address"></div></br>';
	
	// Get the tickets data if it's already been entered
	$duration = get_post_meta($post->ID, 'duration', true);
	echo '<div><label>Duration</label><input type="text" name="duration" value="' . esc_textarea($duration) . '" class="widefat" placeholder="The expected duration of the opportunity"></div></br>';
	
	// Get the tickets data if it's already been entered
	$age = get_post_meta($post->ID, 'age', true);
	echo '<div><label>Age</label><input type="text" name="age" value="' . esc_textarea($age) . '" class="widefat" placeholder="Age group of audience"></div></br>';
	
	// Get the tickets data if it's already been entered
	$tickets = get_post_meta($post->ID, 'tickets', true);
	echo '<div><label>Tickets</label><input type="text" name="tickets" value="' . esc_textarea($tickets) . '" class="widefat" placeholder="Tickets"></div></br>';
	
	// Get the tickets data if it's already been entered
	$tickets_text = get_post_meta($post->ID, 'tickets_text', true);
	echo '<div><label>Get tickets button text</label><input type="text" name="tickets_text" value="' . esc_textarea($tickets_text) . '" class="widefat" placeholder="Get Tickets"></div></br>';
	
	// Get the tickets data if it's already been entered
	$tickets_link = get_post_meta($post->ID, 'tickets_link', true);
	echo '<div><label>Get tickets button link</label><input type="text" name="tickets_link" value="' . esc_textarea($tickets_link) . '" class="widefat" placeholder="Link to where the tickets are sold"></div></br>';
	
	// Get the when data if it's already been entered
	$sub_heading = get_post_meta($post->ID, 'sub_heading', true);
	echo '<div><label>Sub Heading</label><input type="text" name="sub_heading" value="' . esc_textarea($sub_heading) . '" class="widefat" placeholder="Sub heading"></div></br>';
	
	// Get the other data if it's already been entered
	$other = get_post_meta($post->ID, 'other', true);
	echo '<div><label>Other</label><textarea type="text" name="other" class="widefat" placeholder="Other info">' . esc_textarea($other) . '</textarea></div></br>';
}

/**
 * Save the metabox data
 */
function aas_save_opportunities_meta($post_id, $post)
{
	$post_type = get_post_type($post_id);
	
	// If this isn't a 'book' post, don't update it.
	if ("opportunities" != $post_type)
		return;
	
	// Return if the user doesn't have edit permissions.
	if (!current_user_can('edit_post', $post_id))
	{
		return $post_id;
	}
	// Verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times.
	if (!empty($_POST['opportunity_fields']) && !wp_verify_nonce($_POST['opportunity_fields'], basename(__FILE__)))
	{
		return $post_id;
	}
	// Now that we're authenticated, time to save the data.
	// This sanitizes the data from the field and saves it into an array $opportunities_meta.
	$opportunities_meta['when_order'] = strtotime($_POST['when_order']);
	$opportunities_meta['when'] = esc_textarea($_POST['when']);
	$opportunities_meta['where'] = esc_textarea($_POST['where']);
	$opportunities_meta['address'] = esc_textarea($_POST['address']);
	$opportunities_meta['when_featured'] = esc_textarea($_POST['when_featured']);
	$opportunities_meta['time'] = esc_textarea($_POST['time']);
	$opportunities_meta['duration'] = esc_textarea($_POST['duration']);
	$opportunities_meta['age'] = esc_textarea($_POST['age']);
	$opportunities_meta['tickets'] = esc_textarea($_POST['tickets']);
	$opportunities_meta['tickets_text'] = esc_textarea($_POST['tickets_text']);
	$opportunities_meta['tickets_link'] = esc_textarea($_POST['tickets_link']);
	$opportunities_meta['sub_heading'] = esc_textarea($_POST['sub_heading']);
	$opportunities_meta['other'] = esc_textarea($_POST['other']);
	
	// Cycle through the $opportunities_meta array.
	// Note, in this example we just have one item, but this is helpful if you have multiple.
	foreach ($opportunities_meta as $key => $value) :
		// Don't store custom data twice
		if ('revision' === $post->post_type)
		{
			return;
		}
		
		if (get_post_meta($post_id, $key, false))
		{
			// If the custom field already has a value, update it.
			update_post_meta($post_id, $key, $value);
		}
		else
		{
			// If the custom field doesn't have a value, add it.
			add_post_meta($post_id, $key, $value);
		}
		
		if (!$value)
		{
			// Delete the meta key if there's no value
			delete_post_meta($post_id, $key);
		}
	endforeach;
}

add_action('save_post', 'aas_save_opportunities_meta', 1, 2);
