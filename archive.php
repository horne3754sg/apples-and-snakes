<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package apples-and-snakes
 */

get_header();

$header_image = get_template_directory_uri() . '/images/default-banner-image.jpg';
?>
	<div class="section">
		<div class="header-container" style="background-image: url(<?php echo $header_image; ?>);">
			<div class="header-content">
				<header class="entry-header">
					<?php
					if (is_post_type_archive('event')) : ?>

						<h1 class="entry-title"><?php echo __("What's On") ?></h1>
					
					<?php elseif (is_post_type_archive('project')) : ?>

						<h1 class="entry-title"><?php echo __("Projects") ?></h1>
					
					<?php elseif (is_post_type_archive('case_studies')) : ?>

						<h1 class="entry-title"><?php echo __("A+S Stories") ?></h1>
					
					<?php elseif (is_post_type_archive('spotlight')) : ?>

						<h1 class="entry-title"><?php echo __("Spotlight") ?></h1>
					
					<?php elseif (is_post_type_archive('opportunities')) : ?>

						<h1 class="entry-title"><?php echo __("Artists Opportunities") ?></h1>
					
					<?php else : ?>

						<h1 class="entry-title"><?php echo single_cat_title('', false); ?></h1>
					
					<?php endif; ?>
				</header><!-- .entry-header -->
			</div>
		</div>
	</div>
	<div class="section">
		<div id="primary" class="content-area">
			<main id="main" class="site-main">
				<div class="container narrow">
					<?php if (have_posts()) : ?>
						
						<?php if (is_post_type_archive('case_studies')) : ?>
							<header class="page-header">
								<div class="archive-description"><?php dynamic_sidebar('as-stories-intro'); ?></div>
							</header><!-- .page-header -->
						<?php else : ?>
							<header class="page-header">
								<?php the_archive_description('<div class="archive-description">', '</div>'); ?>
							</header><!-- .page-header -->
						<?php endif
						
						//$locations = wp_get_post_terms(get_the_ID(), 'event_location');
						//var_dump($locations);
						
						?>
						<div class="category-nav">
							<?php
							if (is_post_type_archive(array('event')) || is_tax('event_location'))
							{
							$event_location = get_terms('event_location', array(
								'hide_empty' => true,
								'orderby'    => 'id',
								'order'      => 'ASC'
							));
							
							if ($event_location)
							{ ?>
							<ul class="cat_nav">
								<li>
									<a class="<?php echo(!empty(get_queried_object()->name) && (get_queried_object()->name == 'event') ? 'active' : '') ?>" href="<?php echo get_post_type_archive_link('event'); ?>">All</a>
								</li>
								<?php
								$past_events = '';
								foreach ($event_location as $location)
								{
									$class = (!empty(get_queried_object()->term_id) && (get_queried_object()->term_id == $location->term_id)) ? ' class="active"' : '';
									?>
									<li>
										<a <?php echo $class; ?> href="<?php echo get_term_link($location->term_id); ?>"><?php echo $location->name; ?></a>
									</li>
									<?php
								}
								echo $past_events;
								echo '</ul>';
								}
								} ?>
						</div>
						<?php ?>
						<?php
						$count = 0;
						/* Start the Loop */
						while (have_posts()) :
							the_post();
							if (is_post_type_archive('event') ||
								is_post_type_archive('opportunities') ||
								is_tax('event_location') ||
								is_tax('opportunities_type') ||
								has_term('spine-events', 'event-category')) :
								
								//$when_order = get_post_meta_event_date($post->ID, true);
								// Get "current" unix timestamp
								//$now = date('Y-m-d');
								
								//if (strtotime($now) > $when_order)
								//{
								//	//opportunities_type
								//	if (is_post_type_archive('opportunities') || is_tax('opportunities_type'))
								//	{
								//		//wp_set_post_terms($post->ID, array(OPTYPE), 'opportunities_type', true);
								//	}
								//
								//	if (is_post_type_archive('event') || is_tax('event_location') || has_term('spine-events', 'event-category'))
								//	{
								//
								//		if (has_term('spine-events', 'event-category'))
								//		{
								//			//wp_set_post_terms($post->ID, array(ECTYPE), 'event-category', true);
								//			//wp_set_post_terms($post->ID, array(ELTYPE), 'event_location', true);
								//		}
								//		else
								//		{
								//			//wp_set_post_terms($post->ID, array(ECTYPE), 'event-category', true);
								//			//wp_set_post_terms($post->ID, array(ELTYPE), 'event_location', true);
								//		}
								//	}
								//}
								
								if ($count == 0)
								{
									echo '<div class="featured_content_desktop">';
									get_template_part('template-parts/content', 'archive-highlight');
									echo '</div>';
									echo '<div class="featured_content_mobile">';
									get_template_part('template-parts/content', 'archive-posts');
									echo '</div>';
								}
								else
								{
									if (is_post_type_archive(array('opportunities'))) :
										get_template_part('template-parts/content', 'archive-opportunities');
									elseif (is_post_type_archive(array('project', 'case_studies'))) :
										get_template_part('template-parts/content', 'archive-projects');
									else :
										get_template_part('template-parts/content', 'archive-posts');
									endif;
								}

							//elseif (is_post_type_archive(array('opportunities'))) :
							//	get_template_part('template-parts/content', 'archive-opportunities');
							else :
								get_template_part('template-parts/content', 'archive-posts');
							endif;
							
							$count++;
						
						endwhile;
						
						if (is_post_type_archive('event')) :
							the_posts_navigation(array(
								'prev_text'          => __('More events', 'aas'),
								'next_text'          => __('back', 'aas'),
								'screen_reader_text' => __('Event navigation', 'aas')
							));
						else :
							the_posts_navigation();
						endif;
					
					else :
						
						get_template_part('template-parts/content', 'none');
					
					endif;
					?>
				</div>
				<div class="spacing"></div>
			</main><!-- #main -->
		</div><!-- #primary -->
	</div>
<?php
get_sidebar();
get_footer();
