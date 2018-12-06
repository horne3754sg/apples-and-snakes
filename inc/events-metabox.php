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
	
	// Get the location data if it's already been entered
	$when = get_post_meta($post->ID, 'when', true);
	// Output the field
	echo '<div><label>When</label><input type="text" name="when" value="' . esc_textarea($when) . '" class="widefat" placeholder="When?"></div></br>';
	
	// Get the location data if it's already been entered
	$time = get_post_meta($post->ID, 'time', true);
	// Output the field
	echo '<div><label>Time</label><input type="text" name="time" value="' . esc_textarea($time) . '" class="widefat" placeholder="time"></div></br>';
	
	// Get the location data if it's already been entered
	$where = get_post_meta($post->ID, 'where', true);
	$address = get_post_meta($post->ID, 'address', true);
	// Output the field
	echo '<div><label>Where</label><input type="text" name="where" value="' . esc_textarea($where) . '" class="widefat" placeholder="Where?"></div></br>';
	echo '<div><label>Address</label><input type="text" name="address" value="' . esc_textarea($address) . '" class="widefat" placeholder="Address"></div></br>';
	
	// Get the location data if it's already been entered
	$tickets = get_post_meta($post->ID, 'tickets', true);
	// Output the field
	echo '<div><label>Tickets</label><input type="text" name="tickets" value="' . esc_textarea($tickets) . '" class="widefat" placeholder="Tickets?"></div></br>';
	
	// Get the location data if it's already been entered
	$other = get_post_meta($post->ID, 'other', true);
	// Output the field
	echo '<div><label>Other</label><textarea type="text" name="other" class="widefat" placeholder="Other info">' . esc_textarea($other) . '</textarea></div></br>';
}

/**
 * Save the metabox data
 */
function aas_save_events_meta($post_id, $post)
{
	// Return if the user doesn't have edit permissions.
	if (!current_user_can('edit_post', $post_id))
	{
		return $post_id;
	}
	// Verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times.
	if (!wp_verify_nonce($_POST['event_fields'], basename(__FILE__)))
	{
		return $post_id;
	}
	// Now that we're authenticated, time to save the data.
	// This sanitizes the data from the field and saves it into an array $events_meta.
	$events_meta['when'] = esc_textarea($_POST['when']);
	$events_meta['where'] = esc_textarea($_POST['where']);
	$events_meta['time'] = esc_textarea($_POST['time']);
	$events_meta['tickets'] = esc_textarea($_POST['tickets']);
	$events_meta['other'] = esc_textarea($_POST['other']);
	
	// Cycle through the $events_meta array.
	// Note, in this example we just have one item, but this is helpful if you have multiple.
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

add_action('save_post', 'aas_save_events_meta', 1, 2);
