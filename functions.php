<?php
/**
 * apples-and-snakes functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package apples-and-snakes
 */

define('DEV', false);
define('AAS_VERSION', 1.25);
define('OPTYPE', (!empty(DEV) ? 31 : 62)); // opportunities type archive cat
define('ECTYPE', (!empty(DEV) ? 30 : 57)); // event category type archive cat
define('ELTYPE', (!empty(DEV) ? 26 : 52)); // event location type archive cat

if (!function_exists('aas_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function aas_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on apples-and-snakes, use a find and replace
		 * to change 'aas' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('aas', get_template_directory() . '/languages');
		
		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');
		
		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');
		
		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');
		
		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(array(
			'menu-1' => esc_html__('Primary', 'aas'),
		));
		
		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support('html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		));
		
		// Set up the WordPress core custom background feature.
		add_theme_support('custom-background', apply_filters('aas_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		)));
		
		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');
		
		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support('custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		));
		
		add_image_size('related_sm', 400, 400, true);
	}
endif;
add_action('after_setup_theme', 'aas_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function aas_content_width()
{
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters('aas_content_width', 640);
}

add_action('after_setup_theme', 'aas_content_width', 0);

function order_events_by_meta_field($query)
{
	if (is_admin() || !$query->is_main_query())
	{
		return;
	}
	
	if (!empty($query->query['event_location']) && $query->query['event_location'] == 'past-events')
	{
		return;
	}
	
	if ((is_post_type_archive('event') || is_tax('event_location') || has_term('spine-events', 'event-category')))
	{
		$query->set('meta_query', array(
			'relation' => 'OR',
			array(
				'key'     => 'when_order',
				'compare' => 'EXISTS'
			),
			array(
				'taxonomy' => 'event_location',
				'field'    => 'id',
				'terms'    => array(ELTYPE), // 26
				'operator' => 'NOT IN'
			)
		));
		$query->set('orderby', 'when_order');
		$query->set('order', 'ASC');
		
		$query->set('tax_query', array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'event_location',
				'field'    => 'id',
				'terms'    => array(ELTYPE),
				'operator' => 'NOT IN'
			)
		));
	}
}

add_action('pre_get_posts', 'order_events_by_meta_field');


function order_events_by_meta_field2($query)
{
	if (is_admin() || !$query->is_main_query())
	{
		return;
	}
	
	// $event = get_post_meta($post->ID, 'aas_event', true);
	if (!empty($query->query['event-category']) && $query->query['event-category'] == 'spine-events')
	{
		$query->set('meta_query', array(
			'relation' => 'OR',
			array(
				'key'     => 'when_order',
				'compare' => 'EXISTS'
			),
			array(
				'taxonomy' => 'event-category',
				'field'    => 'id',
				'terms'    => array(ECTYPE), // 30
				'operator' => 'NOT IN'
			)
		));
		$query->set('orderby', 'when_order');
		$query->set('order', 'ASC');
		
		$query->set('tax_query', array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'event-category',
				'field'    => 'id',
				'terms'    => array(ECTYPE), // 30
				'operator' => 'NOT IN'
			)
		));
	}
}

add_action('pre_get_posts', 'order_events_by_meta_field2');

function order_events_by_meta_field3($query)
{
	if (is_admin() || !$query->is_main_query())
	{
		return;
	}
	//var_dump($query->query['event_location']);
	
	if (!empty($query->query['opportunities_type']) && $query->query['opportunities_type'] == 'past-opportunities')
	{
		return;
	}
	
	//opportunities_type
	if (is_post_type_archive('opportunities') || is_tax('opportunities_type'))
	{
		$query->set('meta_query', array(
			'relation' => 'OR',
			array(
				'key'     => 'when_order',
				'compare' => 'EXISTS'
			),
			array(
				'taxonomy' => 'opportunities_type',
				'field'    => 'id',
				'terms'    => array(OPTYPE), // 26
				'operator' => 'NOT IN'
			)
		));
		$query->set('orderby', 'when_order');
		$query->set('order', 'ASC');
		
		$query->set('tax_query', array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'opportunities_type',
				'field'    => 'id',
				'terms'    => array(OPTYPE),
				'operator' => 'NOT IN'
			)
		));
	}
}

add_action('pre_get_posts', 'order_events_by_meta_field3');

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function aas_widgets_init()
{
	register_sidebar(array(
		'name'          => esc_html__('Sidebar', 'aas'),
		'id'            => 'sidebar-1',
		'description'   => esc_html__('Add widgets here.', 'aas'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
	
	register_sidebar(array(
		'name'          => esc_html__('Resources Left', 'aas'),
		'id'            => 'resources-left',
		'description'   => esc_html__('Add widgets here.', 'aas'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
	
	register_sidebar(array(
		'name'          => esc_html__('Resources Center', 'aas'),
		'id'            => 'resources-center',
		'description'   => esc_html__('Add widgets here.', 'aas'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
	
	register_sidebar(array(
		'name'          => esc_html__('Resources Right', 'aas'),
		'id'            => 'resources-right',
		'description'   => esc_html__('Add widgets here.', 'aas'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
	
	register_sidebar(array(
		'name'          => esc_html__('Twitter Feed', 'aas'),
		'id'            => 'twitter-feed',
		'description'   => esc_html__('Add widgets here.', 'aas'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
	
	register_sidebar(array(
		'name'          => esc_html__('Footer Sign Up', 'aas'),
		'id'            => 'footer-sign-up',
		'description'   => esc_html__('Add widgets here.', 'aas'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
	
	register_sidebar(array(
		'name'          => esc_html__('Front Sign Up', 'aas'),
		'id'            => 'front-sign-up',
		'description'   => esc_html__('Add widgets here.', 'aas'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
	
	register_sidebar(array(
		'name'          => esc_html__('A&S Stories Intro', 'aas'),
		'id'            => 'as-stories-intro',
		'description'   => esc_html__('Add widgets here.', 'aas'),
		'before_widget' => false,
		'after_widget'  => false,
		'before_title'  => false,
		'after_title'   => false,
	));
}

add_action('widgets_init', 'aas_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function aas_scripts()
{
	wp_enqueue_style('aas-style', get_stylesheet_uri(), '', AAS_VERSION);
	
	if (is_front_page())
	{
		wp_enqueue_script('aas-slick', get_template_directory_uri() . '/inc/slick/slick.min.js', array(), AAS_VERSION, true);
		//wp_enqueue_style('aas-slick-style', get_template_directory_uri() . '/inc/slick/slick.css', array(), '20151215', true);
	}
	
	wp_enqueue_script('aas-navigation', get_template_directory_uri() . '/js/navigation.js', array(), AAS_VERSION, true);
	
	wp_enqueue_script('aas-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), AAS_VERSION, true);
	
	if (is_singular() && comments_open() && get_option('thread_comments'))
	{
		wp_enqueue_script('comment-reply');
	}
}

add_action('wp_enqueue_scripts', 'aas_scripts');

if (!function_exists('fix_no_editor_on_posts_page'))
{
	
	function fix_no_editor_on_posts_page($post_type, $post)
	{
		if (isset($post) && $post->ID != get_option('page_for_posts'))
		{
			return;
		}
		
		remove_action('edit_form_after_title', '_wp_posts_page_notice');
		add_post_type_support('page', 'editor');
	}
	
	add_action('add_meta_boxes', 'fix_no_editor_on_posts_page', 0, 2);
}

function custom_excerpt_length($length)
{
	$length = 20;
	
	return $length;
}

add_filter('excerpt_length', 'custom_excerpt_length', 999);

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


/**
 * CPTs
 */
require get_template_directory() . '/inc/custom-post-types.php';


/**
 * Custom Metaboxes & shortcodes
 */
require get_template_directory() . '/inc/aas-metaboxes.php';
require get_template_directory() . '/inc/opportunities-metabox.php';
require get_template_directory() . '/inc/events-metabox.php';
require get_template_directory() . '/inc/shortcodes.php';
require get_template_directory() . '/inc/featured-header-metabox.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION'))
{
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * List Categories Widget Class
 */
class list_categories_widget extends WP_Widget
{
	/** constructor -- name this the same as the class above */
	function __construct()
	{
		parent::__construct(false, $name = 'List Categories');
	}
	
	/** @see WP_Widget::widget -- do not rename this */
	function widget($args, $instance)
	{
		extract($args);
		$title = apply_filters('widget_title', $instance['title']); // the widget title
		$number = $instance['number']; // the number of categories to show
		$taxonomy = $instance['category']; // the taxonomy to display
		
		//$args = array(
		//	'number'   => $number,
		//	'taxonomy' => $taxonomy
		//);
		// retrieves an array of categories or taxonomy terms
		//$cats = get_categories($args);
		
		//var_dump($taxonomy);
		?>
		<?php echo $before_widget; ?>
		<?php
		if ($title)
		{
			echo $before_title . $title . $after_title;
		}
		?>
		<ul>
			<?php
			global $post;
			
			$myposts = get_posts(array(
				'posts_per_page' => $number,
				'category'       => $taxonomy
			));
			
			if ($myposts)
			{
				foreach ($myposts as $post) :
					setup_postdata($post); ?>
					<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php
				endforeach;
				wp_reset_postdata();
			}
			?>
		</ul>
		<?php echo $after_widget; ?>
		<?php
	}
	
	/** @see WP_Widget::update -- do not rename this */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = strip_tags($new_instance['number']);
		$instance['category'] = $new_instance['category'];
		
		return $instance;
	}
	
	/** @see WP_Widget::form -- do not rename this */
	function form($instance)
	{
		$title = !empty($instance['title']) ? esc_attr($instance['title']) : '';
		$number = !empty($instance['number']) ? esc_attr($instance['number']) : '';
		$taxonomy = !empty($instance['category']) ? esc_attr($instance['category']) : '';
		//var_dump($taxonomy);
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
			       name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of categories to display'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('number'); ?>"
			       name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Choose the Category to display'); ?></label>
			<select name="<?php echo $this->get_field_name('category'); ?>"
			        id="<?php echo $this->get_field_id('category'); ?>" class="widefat">
				<?php
				$categories = get_categories(array('hide_empty' => false));
				if ($categories)
				{
					foreach ($categories as $option)
					{
						echo '<option id="' . $option->term_id . '" value="' . $option->term_id . '" ', $taxonomy == $option->term_id ? ' selected="selected"' : '', '>', $option->name, '</option>';
					}
				}
				?>
			</select>
		</p>
		<?php
	}
} // end class list_categories_widget


function as_register_widgets()
{
	register_widget('list_categories_widget');
}

add_action('widgets_init', 'as_register_widgets');

add_action('yikes-mailchimp-google-analytics', 'yikes_mailchimp_google_analytics', 10, 1);

function yikes_mailchimp_google_analytics($form_id)
{
	?>
	<script type="text/javascript">
		
		var form_id = <?php echo $form_id; ?>;
		
		// Fire off GA event for a failed subscription
		function yikes_mailchimp_google_analytics_failure(response) {
			
			(function(i, s, o, g, r, a, m) {
				i['GoogleAnalyticsObject'] = r;
				i[r] = i[r] || function() {
					(i[r].q = i[r].q || []).push(arguments);
				}, i[r].l = 1 * new Date();
				a = s.createElement(o),
					m = s.getElementsByTagName(o)[0];
				a.async = 1;
				a.src = g;
				m.parentNode.insertBefore(a, m);
			})(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
			
			ga('create', 'UA-108570495-1', 'auto');
			ga('send', 'event', 'mailchimp-subscribe', 'subscription-failed');
		}
		
		// Fire off GA event for a successful subscription
		function yikes_mailchimp_google_analytics_success(response) {
			
			(function(i, s, o, g, r, a, m) {
				i['GoogleAnalyticsObject'] = r;
				i[r] = i[r] || function() {
					(i[r].q = i[r].q || []).push(arguments);
				}, i[r].l = 1 * new Date();
				a = s.createElement(o),
					m = s.getElementsByTagName(o)[0];
				a.async = 1;
				a.src = g;
				m.parentNode.insertBefore(a, m);
			})(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
			
			ga('create', 'UA-108570495-1', 'auto');
			ga('send', 'event', 'mailchimp-subscribe', 'subscription-successful');
		}

	</script>
	<?php
}


/**
 * Get the event date
 *
 * @param int $postid
 * @param bool $strtime
 * @param bool $ranged
 *
 * @return int|mixed|string
 */
function get_post_meta_event_date_VOID($postid = -1, $strtime = false, $ranged = false)
{
	$event_date = '';
	if ($postid > 0)
	{
		$ranged_dates = array();
		$total = 0;
		$now = date('Y-m-d');
		$events = get_post_meta($postid, 'aas_event', true);
		//var_dump($events);
		//if (!empty($events['event']))
		//{
		//	usort($events['event'], function ($a, $b)
		//	{
		//		return $a['when_order'] - $b['when_order'];
		//	});
		//}
		
		if (!empty($events) && !empty($events['when_order']))
		{
			$nextevent = false;
			$total = count($events['event']);
			foreach ($events['event'] as $i => $event)
			{
				if ($i == 0)
				{
					$ranged_dates[] = $event['when_order'];
				}
				
				if (strtotime($now) <= $event['when_order'])
				{
					if (!$nextevent)
					{
						$when_order = $event['when_order'];
						update_post_meta($postid, 'when_order', $when_order);
						update_post_meta($postid, 'time', $event['time']);
						$nextevent = $when_order;
					}
				}
				
				if ($i == ($total - 1) && $i != 0)
				{
					$ranged_dates[] = $event['when_order'];
				}
			}
		}
		//else
		//{
		//	$when_order = get_post_meta($postid, 'when_order', true);
		//}
		
		if ($total > 0 && $ranged_dates && count($ranged_dates) == 2 && $ranged)
		{
			$event_date = date("l d M", $ranged_dates[0]) . ' - ' . date("l d M", $ranged_dates[1]);
		}
		else
		{
			if (!empty($when_order) && empty($strtime))
			{
				$time = get_post_meta($postid, 'time', true);
				$event_date = date("l d M", $when_order) . (!empty($time) ? ', ' . $time : '');
			}
			else
			{
				$event_date = !empty($when_order) ? $when_order : -1;
			}
			
			if ($event_date == -1)
			{
				$when_order = get_post_meta($postid, 'when_order', true);
				$time = get_post_meta($postid, 'time', true);
				if ($when_order > 0)
					$event_date = date("l d M", $when_order) . (!empty($time) ? ', ' . $time : '');
			}
		}
	}
	
	return $event_date;
}

//if (!wp_next_scheduled('update_aas_events_hook'))
//{
//	wp_schedule_event(time(), 'hourly', 'update_aas_events_hook');
//}
//
//add_action('update_aas_events_hook', 'update_aas_events_function');

function update_aas_events_function()
{
	//wp_mail('mattjhorne@hotmail.co.uk', 'Automatic email', 'Automatic scheduled email from WordPress.');
	$get_events = get_posts(array(
		'post_type'   => 'event',
		'post_status' => 'publish',
		'numberposts' => -1
	));
	
	if ($get_events)
	{
		foreach ($get_events as $event)
		{
			if ($event->ID > 0)
			{
				$events_meta = get_post_meta($event->ID, 'aas_event', true);
				$all_event_dates = get_all_events_dates($event->ID);
				
				if (!empty($all_event_dates))
				{
					$nextevent = false;
					$now = date('Y-m-d');
					foreach ($all_event_dates as $event_window)
					{
						//var_dump($event->ID);
						//var_dump(date("l d M Y", $event_window));
						//var_dump('--------------');
						foreach ($event_window as $window)
						{
							if (!empty($window['when_order']))
							{
								if (strtotime($now) <= $window['when_order'])
								{
									if ($nextevent == false)
									{
										if (!empty($events_meta))
										{
											$event_data = $events_meta;
											
											if (!empty($window['when_order']))
												$event_data['when_order'] = $window['when_order'];
											
											if (!empty($window['time']))
												$event_data['time'] = $window['time'];
											
											if (!empty($window['tickets']))
												$event_data['tickets'] = $window['tickets'];
											
											if (!empty($window['tickets_text']))
												$event_data['tickets_text'] = $window['tickets_text'];
											
											if (!empty($window['tickets_link']))
												$event_data['tickets_link'] = $window['tickets_link'];
											
											//var_dump($event_data);
											update_post_meta($event->ID, 'aas_event', $event_data);
											
											$nextevent = true;
											
											//var_dump(wp_remove_object_terms($event->ID, array(ELTYPE), 'event_location'));
											wp_remove_object_terms($event->ID, array(ECTYPE), 'event-category');
											wp_remove_object_terms($event->ID, array(ELTYPE), 'event_location');
										}
									}
								}
							}
						}
						
						if (!$nextevent)
						{
							wp_set_post_terms($event->ID, array(ECTYPE), 'event-category', true);
							wp_set_post_terms($event->ID, array(ELTYPE), 'event_location', true);
						}
					}
				}
			}
		}
		//var_dump($event_dates);
	}
}

add_action('wp_loaded', 'update_aas_events_function');
//update_aas_events_function();

function update_aas_opportunities_function()
{
	//wp_mail('mattjhorne@hotmail.co.uk', 'Automatic email', 'Automatic scheduled email from WordPress.');
	$get_opportunities = get_posts(array(
		'post_type'   => 'opportunities',
		'post_status' => 'publish',
		'numberposts' => -1
	));
	if ($get_opportunities)
	{
		$now = date('Y-m-d');
		foreach ($get_opportunities as $opportunities)
		{
			if ($opportunities->ID > 0)
			{
				$when_order = get_post_meta($opportunities->ID, 'when_order', true);
				if (strtotime($now) > $when_order)
				{
					wp_set_post_terms($opportunities->ID, array(OPTYPE), 'opportunities_type', true);
				}
				else
				{
					wp_remove_object_terms($opportunities->ID, array(OPTYPE), 'opportunities_type');
				}
			}
		}
	}
}

add_action('wp_loaded', 'update_aas_opportunities_function');

/**
 * Get all the event dates and reorder them
 *
 * @param $eventid
 *
 * @return array
 */
function get_all_events_dates($eventid = -1)
{
	$all_event_dates = array();
	if ($eventid > 0)
	{
		$events_meta = get_post_meta($eventid, 'aas_event', true);
		//var_dump($events_meta);
		if (!empty($events_meta['event']))
		{
			foreach ($events_meta['event'] as $i => $em)
			{
				if (!empty($em['dates']))
				{
					foreach ($em['dates'] as $j => $event_dates)
					{
						if (!empty($event_dates['when_order']))
						{
							unset($em['dates']);
							$all_event_dates[$eventid][] = array(
								'eventid'    => $eventid,
								'meta'       => $em,
								'when'       => !empty($event_dates['when_order']) ? date("l d M", $event_dates['when_order']) : '',
								'when_order' => !empty($event_dates['when_order']) ? $event_dates['when_order'] : '',
								'time'       => !empty($event_dates['time']) ? $event_dates['time'] : ''
							);
						}
					}
				}
				else if (!empty($em['when_order']))
				{
					unset($em['dates']);
					$all_event_dates[$eventid][] = array(
						'eventid'    => $eventid,
						'meta'       => $em,
						'when'       => !empty($em['when_order']) ? date("l d M", $em['when_order']) : '',
						'when_order' => !empty($em['when_order']) ? $em['when_order'] : '',
						'time'       => !empty($em['time']) ? $em['time'] : ''
					);
				}
			}
		}
		
		//var_dump($all_event_dates[$event->ID]);
		if (!empty($all_event_dates[$eventid]))
			usort($all_event_dates[$eventid], function ($a, $b)
			{
				return $a['when_order'] - $b['when_order'];
			});
	}
	
	//var_dump($all_event_dates);
	
	return $all_event_dates;
}

/**
 * Get all the event dates and reorder them
 *
 * @param int $eventid
 * @param bool $strtime
 * @param bool $ranged
 *
 * @return string
 */
function get_post_meta_event_date($eventid = -1, $strtime = false, $ranged = false)
{
	$event_date = '';
	$all_event_dates = array();
	
	if ($eventid > 0)
	{
		$events_meta = get_post_meta($eventid, 'aas_event', true);
		//var_dump($events_meta);
		if (!empty($events_meta['event']))
		{
			foreach ($events_meta['event'] as $i => $em)
			{
				if (!empty($em['dates']))
				{
					foreach ($em['dates'] as $j => $event_dates)
					{
						if (!empty($event_dates['when_order']))
						{
							unset($em['dates']);
							$all_event_dates[$eventid][] = array(
								'when'       => !empty($event_dates['when_order']) ? date("l d M", $event_dates['when_order']) : '',
								'when_order' => !empty($event_dates['when_order']) ? $event_dates['when_order'] : '',
								'time'       => !empty($event_dates['time']) ? $event_dates['time'] : ''
							);
						}
					}
				}
				else if (!empty($em['when_order']))
				{
					unset($em['dates']);
					$all_event_dates[$eventid][] = array(
						'eventid'    => $eventid,
						'meta'       => $em,
						'when'       => !empty($em['when_order']) ? date("l d M", $em['when_order']) : '',
						'when_order' => !empty($em['when_order']) ? $em['when_order'] : '',
						'time'       => !empty($em['time']) ? $em['time'] : ''
					);
				}
			}
			
			
			if (!empty($all_event_dates))
			{
				usort($all_event_dates[$eventid], function ($a, $b)
				{
					return $a['when_order'] - $b['when_order'];
				});
				
				
				if (count($all_event_dates[$eventid]) > 1 && $ranged)
				{
					$first_date = $all_event_dates[$eventid][0];
					//var_dump($first_date);
					$last_date = $all_event_dates[$eventid][count($all_event_dates[$eventid]) - 1];
					//var_dump($last_date);
					
					$event_date = date("l d M", $first_date['when_order']) . ' - ' . date("l d M", $last_date['when_order']);
				}
				else
				{
					$time = (!empty($all_event_dates[$eventid][0]['time']) ? ', ' . $all_event_dates[$eventid][0]['time'] : '');
					if (!empty($all_event_dates[$eventid][0]['when']))
						$event_date = date("l d M", $all_event_dates[$eventid][0]['when_order']) . $time;
				}
			}
		}
		else
		{
			$when_order = get_post_meta($eventid, 'when_order', true);
			$event_time = get_post_meta($eventid, 'time', true);
			if (!empty($when_order))
				$event_date = date("l d M", $when_order) . (!empty($event_time) ? ', ' . $event_time : '');
		}
	}
	
	//var_dump($all_event_dates);
	
	return $event_date;
}
