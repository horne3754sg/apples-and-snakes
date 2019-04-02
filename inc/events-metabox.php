<?php


/**
 * If you wanted to have two sets of metaboxes.
 */
function aas_add_event_metaboxes()
{
	add_meta_box(
		'aas_events_location',
		'Event Info',
		'aas_events_location',
		'event',
		'normal',
		'high'
	);
}

/**
 * Output the HTML for the metabox.
 */
function aas_events_location()
{
	global $post;
	// Nonce field to validate form request came from current site
	wp_nonce_field(basename(__FILE__), 'event_fields');
	
	// Get the when data if it's already been entered
	$when_order = get_post_meta($post->ID, 'when_order', true);
	$when_order = !empty($when_order) ? date( 'Y-m-d', $when_order ) : date( 'Y-m-d');
	echo '<div><label>When (Used to Order Content and must be a valid date format)</label><input type="date" name="when_order" value="' . $when_order . '" class="widefat" placeholder="When? format: dd/mm/yyyy"></div></br>';
	
	// Get the when data if it's already been entered
	$when = get_post_meta($post->ID, 'when', true);
	echo '<div><label>When (Sidebar)</label><input type="text" name="when" value="' . $when . '" class="widefat" placeholder="When?"></div></br>';
	
	// Get the when data if it's already been entered
	$when_featured = get_post_meta($post->ID, 'when_featured', true);
	echo '<div><label>When (Featured)</label><input type="text" name="when_featured" value="' . $when_featured . '" class="widefat" placeholder="eg. Thurs 26 - Sun 28 Oct 2018"></div></br>';
	
	// Get the time data if it's already been entered
	$time = get_post_meta($post->ID, 'time', true);
	echo '<div><label>Time (Sidebar)</label><input type="text" name="time" value="' . esc_textarea($time) . '" class="widefat" placeholder="time"></div></br>';
	
	// Get the where data if it's already been entered
	$where = get_post_meta($post->ID, 'where', true);
	echo '<div><label>Where</label><input type="text" name="where" value="' . $where . '" class="widefat" placeholder="Where?"></div></br>';
	
	// Get the address data if it's already been entered
	$address = get_post_meta($post->ID, 'address', true);
	echo '<div><label>Address</label><input type="text" name="address" value="' . $address . '" class="widefat" placeholder="Address"></div></br>';
	
	// Get the tickets data if it's already been entered
	$duration = get_post_meta($post->ID, 'duration', true);
	echo '<div><label>Duration</label><input type="text" name="duration" value="' . $duration . '" class="widefat" placeholder="The expected duration of the event"></div></br>';
	
	// Get the tickets data if it's already been entered
	$age = get_post_meta($post->ID, 'age', true);
	echo '<div><label>Age</label><input type="text" name="age" value="' . $age . '" class="widefat" placeholder="Age group of audience"></div></br>';
	
	// Get the tickets data if it's already been entered
	$tickets = get_post_meta($post->ID, 'tickets', true);
	echo '<div><label>Tickets</label><input type="text" name="tickets" value="' . $tickets . '" class="widefat" placeholder="Tickets"></div></br>';
	
	// Get the tickets data if it's already been entered
	$tickets_text = get_post_meta($post->ID, 'tickets_text', true);
	echo '<div><label>Get tickets button text</label><input type="text" name="tickets_text" value="' . $tickets_text . '" class="widefat" placeholder="Get Tickets"></div></br>';
	
	// Get the tickets data if it's already been entered
	$tickets_link = get_post_meta($post->ID, 'tickets_link', true);
	echo '<div><label>Get tickets button link</label><input type="text" name="tickets_link" value="' . $tickets_link . '" class="widefat" placeholder="Link to where the tickets are sold"></div></br>';
	
	// Get the when data if it's already been entered
	$sub_heading = get_post_meta($post->ID, 'sub_heading', true);
	echo '<div><label>Sub Heading</label><input type="text" name="sub_heading" value="' . $sub_heading . '" class="widefat" placeholder="Sub heading"></div></br>';
	
	// Get the other data if it's already been entered
	$other = get_post_meta($post->ID, 'other', true);
	echo '<div><label>Other</label><textarea type="text" name="other" class="widefat" placeholder="Other info">' . $other . '</textarea></div></br>';
}

/**
 * Save the metabox data
 */
function aas_save_events_meta($post_id, $post)
{
	$post_type = get_post_type($post_id);
	
	// If this isn't a 'book' post, don't update it.
	if ("event" != $post_type)
		return;
	
	// Return if the user doesn't have edit permissions.
	if (!current_user_can('edit_post', $post_id))
	{
		return $post_id;
	}
	// Verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times.
	if (!empty($_POST['event_fields']) && !wp_verify_nonce($_POST['event_fields'], basename(__FILE__)))
	{
		return $post_id;
	}
	// Now that we're authenticated, time to save the data.
	// This sanitizes the data from the field and saves it into an array $events_meta.
	$events_meta['when_order'] = !empty($_POST['when_order']) ? strtotime($_POST['when_order']) : '';
	$events_meta['when'] = !empty($_POST['when']) ?  esc_textarea($_POST['when']) : '';
	$events_meta['where'] = !empty($_POST['where']) ?  esc_textarea($_POST['where']) : '';
	$events_meta['address'] = !empty($_POST['address']) ?  esc_textarea($_POST['address']) : '';
	$events_meta['when_featured'] = !empty($_POST['when_featured']) ?  esc_textarea($_POST['when_featured']) : '';
	$events_meta['time'] = !empty($_POST['time']) ?  esc_textarea($_POST['time']) : '';
	$events_meta['duration'] = !empty($_POST['duration']) ?  esc_textarea($_POST['duration']) : '';
	$events_meta['age'] = !empty($_POST['age']) ?  esc_textarea($_POST['age']) : '';
	$events_meta['tickets'] = !empty($_POST['tickets']) ?  esc_textarea($_POST['tickets']) : '';
	$events_meta['tickets_text'] = !empty($_POST['tickets_text']) ?  esc_textarea($_POST['tickets_text']) : '';
	$events_meta['tickets_link'] = !empty($_POST['tickets_link']) ?  esc_textarea($_POST['tickets_link']) : '';
	$events_meta['sub_heading'] = !empty($_POST['sub_heading']) ?  esc_textarea($_POST['sub_heading']) : '';
	$events_meta['other'] = !empty($_POST['other']) ?  esc_textarea($_POST['other']) : '';
	
	// Cycle through the $events_meta array.
	// Note, in this example we just have one item, but this is helpful if you have multiple.
	if($events_meta)
	{
		foreach ($events_meta as $key => $value) :
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
}

add_action('save_post', 'aas_save_events_meta', 1, 2);
