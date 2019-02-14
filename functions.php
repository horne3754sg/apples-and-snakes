<?php
/**
 * apples-and-snakes functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package apples-and-snakes
 */

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
	
	if (is_post_type_archive('event'))
	{
		$query->set('meta_query', array(
			'relation' => 'OR',
			array(
				'key'     => 'when_order',
				'compare' => 'EXISTS'
			),
			//array(
			//	'key'     => 'when_order',
			//	'compare' => 'NOT EXISTS'
			//)
		));
		$query->set('orderby', 'when_order');
		$query->set('order', 'ASC');
	}
}

add_action('pre_get_posts', 'order_events_by_meta_field');

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
}

add_action('widgets_init', 'aas_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function aas_scripts()
{
	wp_enqueue_style('aas-style', get_stylesheet_uri(), '', '1.1.94');
	
	if (is_front_page())
	{
		wp_enqueue_script('aas-slick', get_template_directory_uri() . '/inc/slick/slick.min.js', array(), '20151214', true);
		//wp_enqueue_style('aas-slick-style', get_template_directory_uri() . '/inc/slick/slick.css', array(), '20151215', true);
	}
	
	wp_enqueue_script('aas-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151214', true);
	
	wp_enqueue_script('aas-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151214', true);
	
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

function list_cat_register_widgets()
{
	register_widget('list_categories_widget');
}

add_action('widgets_init', 'list_cat_register_widgets');
