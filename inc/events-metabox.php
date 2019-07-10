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
	
	add_action('admin_print_styles', 'aas_load_scripts_styles');
}

function aas_load_scripts_styles()
{
	global $typenow;
	if ($typenow == 'event')
	{
		wp_enqueue_style('admin-styles', get_stylesheet_directory_uri() . '/inc/event-admin.css', '', AAS_VERSION);
		wp_enqueue_script('admin-script', get_stylesheet_directory_uri() . '/inc/event-admin.js', array('jquery'), AAS_VERSION);
		//wp_localize_script('admin-script', 'aas_events_admin', array(
		//	'ajaxurl'     => admin_url('admin-ajax.php'),
		//	'event_nonce' => wp_create_nonce('event_nonce'),
		//));
	}
}

/**
 * Output the HTML for the metabox.
 */
function aas_events_location()
{
	global $post;
	// Nonce field to validate form request came from current site
	wp_nonce_field(basename(__FILE__), 'event_fields');
	
	echo '<div class="group_options">'; // start group
	
	echo '<div class="group_header">';
	echo '<h3>Event Date & Venue</h3>';
	echo '</div>';
	
	echo '<div class="group_content multi">';
	echo '<ul id="event_list">';
	$i = 0;
	$events = get_post_meta($post->ID, 'aas_event', true);
	//if (!empty($events['event']))
	//{
	//	usort($events['event'], function ($a, $b)
	//	{
	//		return $a['when_order'] - $b['when_order'];
	//	});
	//}
	//var_dump($events);
	do
	{
		echo '<li class="event_item">';
		
		echo '<div class="event_header">';
		echo '<h4>Event ' . ($i + 1) . '</h4>';
		echo '<a class="delete" href="#">delete</a>';
		echo '</div>';
		
		echo '<div class="event_content">';
		
		echo '<div class="event_dates">'; // event dates
		// Get the where data if it's already been entered
		$ranged = (isset($events['event'][$i]['ranged']) && 1 === $events['event'][$i]['ranged']) ? 1 : 0;

		echo '<div class="option_row">';
		echo '<label for="ranged_' . $i . '"><input id="ranged_' . $i . '" type="checkbox" name="events[event][' . $i . '][ranged]" value="1" ' . checked($ranged, 1, false) . '>Display Ranged Dates (this will display the first and last event date in the sidebar.)</label>';
		echo '</div>';
		
		echo '<h4>Event Dates</h4>';
		echo '<ul id="event_dates_' . $i . '" class="event_dates_list">'; // date/time lists
		
		$j = 0;
		do
		{
			echo '<li class="event_date_item">'; // date/time lists
			
			// Get the when data if it's already been enteredCase Study Meta
			$when_order = !empty($events['event'][$i]['dates'][$j]['when_order']) ? $events['event'][$i]['dates'][$j]['when_order'] : '';
			$when_order = !empty($when_order) ? date('Y-m-d', $when_order) : date('Y-m-d');
			echo '<div class="option_row option_cols">';
			echo '<div class="option_col">';
			echo '<label>When</label>';
			echo '<input type="date" name="events[event][' . $i . '][dates][' . $j . '][when_order]" value="' . $when_order . '" class="widefat" placeholder="When? format: dd/mm/yyyy">';
			echo '</div>';
			
			// Get the time data if it's already been entered
			$time = !empty($events['event'][$i]['dates'][$j]['time']) ? $events['event'][$i]['dates'][$j]['time'] : '';
			echo '<div class="option_col">';
			echo '<label>Time</label>';
			echo '<input type="text" name="events[event][' . $i . '][dates][' . $j . '][time]" value="' . esc_textarea($time) . '" class="widefat" placeholder="time">';
			echo '</div>';
			
			echo '<a class="delete" href="#" onclick="this.parentNode.remove(); return false;">remove</a>';
			echo '</div>';
			
			echo '</li>';  // end date/time lists
			$j++;
		} while ($j < (!empty($events['event'][$i]['dates']) ? count($events['event'][$i]['dates']) : 0));
		
		echo '</ul>';  // end date/time lists
		
		echo '<div class="button_wrap">';
		echo '<button class="button add_new_event_date" data-id="' . $i . '"  disabled>Add Date/Time</button>';
		echo '</div>';
		
		echo '</div>'; // event dates
		
		// Get the where data if it's already been entered
		$where = !empty($events['event'][$i]['where']) ? $events['event'][$i]['where'] : get_post_meta($post->ID, 'where', true);
		echo '<div class="option_row"><label>Where</label><input type="text" name="events[event][' . $i . '][where]" value="' . $where . '" class="widefat" placeholder="Where?"></div>';
		
		// Get the address data if it's already been entered
		$address = !empty($events['event'][$i]['address']) ? $events['event'][$i]['address'] : get_post_meta($post->ID, 'address', true);
		echo '<div class="option_row"><label>Address</label><input type="text" name="events[event][' . $i . '][address]" value="' . $address . '" class="widefat" placeholder="Address"></div>';
		
		// Get the tickets data if it's already been entered
		$tickets = !empty($events['event'][$i]['tickets']) ? $events['event'][$i]['tickets'] : get_post_meta($post->ID, 'tickets', true);
		echo '<div class="option_row"><label>Tickets</label><input type="text" name="events[event][' . $i . '][tickets]" value="' . $tickets . '" class="widefat" placeholder="Tickets"></div>';
		
		// Get the tickets data if it's already been entered
		$tickets_text = !empty($events['event'][$i]['tickets_text']) ? $events['event'][$i]['tickets_text'] : get_post_meta($post->ID, 'tickets_text', true);
		echo '<div class="option_row"><label>Get tickets button text</label><input type="text" name="events[event][' . $i . '][tickets_text]" value="' . $tickets_text . '" class="widefat" placeholder="Get Tickets"></div>';
		
		// Get the tickets data if it's already been entered
		$tickets_link = !empty($events['event'][$i]['tickets_link']) ? $events['event'][$i]['tickets_link'] : get_post_meta($post->ID, 'tickets_link', true);
		echo '<div class="option_row"><label>Get tickets button link</label><input type="text" name="events[event][' . $i . '][tickets_link]" value="' . $tickets_link . '" class="widefat" placeholder="Link to where the tickets are sold"></div>';
		
		
		echo '</div>'; // content
		echo '</li>';
		$i++;
	} while ($i < (!empty($events['event']) ? count($events['event']) : 0));
	
	
	echo '</ul>';
	
	echo '<div class="button_wrap">';
	echo '<button id="add_new_event" class="button" disabled>Add New</button>';
	echo '</div>';
	
	echo '</div>';
	echo '</div>'; // end group
	
	echo '<div class="group_options">'; // start group
	
	echo '<div class="group_header">';
	echo '<h3>Other information</h3>';
	echo '</div>';
	
	echo '<div class="group_content">';
	// Get the tickets data if it's already been entered
	$duration = !empty($events['duration']) ? $events['duration'] : get_post_meta($post->ID, 'duration', true);
	echo '<div class="option_row"><label>Duration</label><input type="text" name="events[duration]" value="' . $duration . '" class="widefat" placeholder="The expected duration of the event"></div>';
	
	// Get the tickets data if it's already been entered
	$age = !empty($events['duration']) ? $events['duration'] : get_post_meta($post->ID, 'age', true);
	echo '<div class="option_row"><label>Age</label><input type="text" name="events[age]" value="' . $age . '" class="widefat" placeholder="Age group of audience"></div>';
	
	// Get the when data if it's already been entered
	$sub_heading = !empty($events['sub_heading']) ? $events['sub_heading'] : get_post_meta($post->ID, 'sub_heading', true);
	echo '<div class="option_row"><label>Sub Heading  (used in the featured header)</label><input type="text" name="events[sub_heading]" value="' . $sub_heading . '" class="widefat" placeholder="Sub heading"></div>';
	
	// Get the other data if it's already been entered
	$other = !empty($events['other']) ? $events['other'] : get_post_meta($post->ID, 'other', true);
	echo '<div class="option_row"><label>Other</label><textarea type="text" name="events[other]" class="widefat" placeholder="Other info">' . $other . '</textarea></div>';
	echo '</div>';
	
	echo '</div>'; // end group
}

/**
 * Save the metabox data
 *
 * @param $post_id
 * @param $post
 *
 * @return bool|void
 */
function aas_save_events_meta($post_id, $post)
{
	$post_type = get_post_type($post_id);
	
	//var_dump($_POST);
	// If this isn't a 'book' post, don't update it.
	if ('event' != $post_type)
		return false;
	
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
	
	$em = array();
	$now = date('Y-m-d');
	$nextevent = false;
	if (!empty($_POST['events']))
	{
		//var_dump($_POST['events']);
		// handle events
		if (!empty($_POST['events']['event']))
		{
			foreach ($_POST['events']['event'] as $i => $event)
			{
				if (!empty($event['dates']))
				{
					foreach ($event['dates'] as $j => $dates)
					{
						$em['event'][$i]['dates'][$j]['when_order'] = !empty($dates['when_order']) ? strtotime($dates['when_order']) : '';
						$em['event'][$i]['dates'][$j]['time'] = !empty($dates['time']) ? esc_textarea($dates['time']) : '';
						//$em['event'][$i]['dates'][$j]['when'] = !empty($dates['when']) ? esc_textarea($dates['when']) : '';
					}
				}
				
				$em['event'][$i]['ranged'] = (isset($event['ranged']) && '1' === $event['ranged']) ? 1 : 0;
				
				$em['event'][$i]['where'] = !empty($event['where']) ? esc_textarea($event['where']) : '';
				$em['event'][$i]['address'] = !empty($event['address']) ? esc_textarea($event['address']) : '';
				
				// ticket info
				$em['event'][$i]['tickets'] = !empty($event['tickets']) ? esc_textarea($event['tickets']) : '';
				$em['event'][$i]['tickets_text'] = !empty($event['tickets_text']) ? esc_textarea($event['tickets_text']) : '';
				$em['event'][$i]['tickets_link'] = !empty($event['tickets_link']) ? esc_url($event['tickets_link']) : '';
				
				//update_post_meta($post_id, 'when_order', $em['event'][$i]['when_order']);
				//update_post_meta($post_id, 'time', $em['event'][$i]['time']);
				//if (strtotime($now) <= $em['event'][$i]['when_order'])
				//{
				//	wp_remove_object_terms($post_id, array(ECTYPE), 'event-category');
				//	wp_remove_object_terms($post_id, array(ELTYPE), 'event_location');
				//	if (!$nextevent)
				//	{
				//		update_post_meta($post_id, 'when_order', $em['event'][$i]['when_order']);
				//		update_post_meta($post_id, 'time', $em['event'][$i]['time']);
				//
				//		update_post_meta($post_id, 'tickets', $em['event'][$i]['tickets']);
				//		update_post_meta($post_id, 'tickets_text', $em['event'][$i]['tickets_text']);
				//		update_post_meta($post_id, 'tickets_link', $em['event'][$i]['tickets_link']);
				//
				//		$nextevent = $em['event'][$i]['when_order'];
				//	}
				//}
				//else
				//{
				//	wp_set_post_terms($post->ID, array(ECTYPE), 'event-category', true);
				//	wp_set_post_terms($post->ID, array(ELTYPE), 'event_location', true);
				//}
			}
		}
		
		// handle other saved options
		$em['duration'] = !empty($_POST['events']['duration']) ? esc_textarea($_POST['events']['duration']) : '';
		$em['age'] = !empty($_POST['events']['age']) ? esc_textarea($_POST['events']['age']) : '';
		//$em['tickets'] = !empty($_POST['events']['tickets']) ? esc_textarea($_POST['events']['tickets']) : '';
		//$em['tickets_text'] = !empty($_POST['events']['tickets_text']) ? esc_textarea($_POST['events']['tickets_text']) : '';
		//$em['tickets_link'] = !empty($_POST['events']['tickets_link']) ? esc_textarea($_POST['events']['tickets_link']) : '';
		$em['sub_heading'] = !empty($_POST['events']['sub_heading']) ? esc_textarea($_POST['events']['sub_heading']) : '';
		$em['other'] = !empty($_POST['events']['other']) ? esc_textarea($_POST['events']['other']) : '';
	}
	
	// Cycle through the $em array.
	// Note, in this example we just have one item, but this is helpful if you have multiple.
	if ($em)
	{
		if ('revision' === $post->post_type)
		{
			return;
		}
		
		update_post_meta($post_id, 'aas_event', $em);
		
		
		// delete the old data
		$keys = array(
			'when',
			'where',
			'address',
			'when_featured',
			'duration',
			'age',
			//'tickets',
			//'tickets_text',
			//'tickets_link',
			'sub_heading',
			'other'
		);
		if ($keys)
		{
			foreach ($keys as $key)
			{
				delete_post_meta($post_id, $key);
			}
		}
	}
	else
	{
		delete_post_meta($post_id, 'aas_event');
	}
}

add_action('save_post', 'aas_save_events_meta', 1, 2);


// Add the custom columns to the book post type:
add_filter('manage_event_posts_columns', 'set_custom_edit_event_columns');
function set_custom_edit_event_columns($columns)
{
	$columns['event_count'] = __('Total Event Dates', 'aas');
	$columns['next_event_date'] = __('Next Event Date', 'aas');
	
	return $columns;
}

// Add the data to the custom columns for the book post type:
add_action('manage_event_posts_custom_column', 'custom_event_column', 10, 2);
function custom_event_column($column, $post_id)
{
	$events = get_post_meta($post_id, 'aas_event', true);
	
	$event_count = 0;
	$nextevent = false;
	$now = date('Y-m-d');
	$next_event_date = 'No Dates';
	$all_event_dates = array();
	if (!empty($events['event']))
	{
		foreach ($events['event'] as $event)
		{
			if (!empty($event['dates']))
			{
				foreach ($event['dates'] as $event_dates)
				{
					$all_event_dates[] = array_merge($event_dates, $event);
					$event_count++;
				}
			}
			else if (!empty($event['when_order']))
			{
				$all_event_dates[] = $event;
				$event_count++;
			}
		}
	}
	
	usort($all_event_dates, function ($a, $b)
	{
		return $a['when_order'] - $b['when_order'];
	});
	
	if (!empty($all_event_dates))
	{
		foreach ($all_event_dates as $dates)
		{
			if (!$nextevent && (strtotime($now) < $dates['when_order']))
			{
				$next_event_date = date('l d M Y', $dates['when_order']);
				$nextevent = true;
			}
		}
	}
	
	switch ($column)
	{
		case 'event_count' :
			echo $event_count;
			break;
		case 'next_event_date' :
			echo $next_event_date;
			break;
	}
}
