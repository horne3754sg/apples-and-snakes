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
									<a href="<?php echo get_post_type_archive_link('event'); ?>">All</a>
								</li>
								<?php
								$past_events = '';
								foreach ($event_location as $location)
								{
									?>
									<li>
										<a href="<?php echo get_term_link($location->term_id); ?>"><?php echo $location->name; ?></a>
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
							if (is_post_type_archive('event') || is_tax('event_location')) :
								
								// Get "date" meta field as unix timestamp
								$when_order = get_post_meta($post->ID, 'when_order', true);
								
								// Get "current" unix timestamp
								$now = date('Y-m-d');
								//$now_plusday = strtotime("+1 day" . $now);
								
								if (strtotime($now) >= $when_order)
								{
									//var_dump('now ' . strtotime($now));
									//var_dump('when ' . $when_order);
									
									//$date = new DateTime();
									//$date->setTimestamp($now_plusday);
									//echo $date->format('U = Y-m-d H:i:s') . "\n";
									//echo '<br/>';
									//var_dump('old time: ' . $when_order);
									//$date = new DateTime();
									//$date->setTimestamp($when_order);
									//echo $date->format('U = Y-m-d H:i:s') . "\n";
									//echo '<br/>';
									//var_dump('new time: ' . strtotime('+100 year', $when_order));
									//$date = new DateTime();
									//$date->setTimestamp(strtotime('+50 year', $when_order));
									//echo $date->format('U = Y-m-d H:i:s') . "\n";
									// $now is later than $then, update post.
									//update_post_meta($post->ID, 'when_order', strtotime('+50 year', $when_order));
									//wp_set_post_terms($post->ID, array(26), 'event_location', true);
									wp_set_post_terms($post->ID, array(52), 'event_location', true);
								}
								
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
									get_template_part('template-parts/content', 'archive-posts');
								}
							elseif (is_post_type_archive(array('project', 'case_studies'))) :
								get_template_part('template-parts/content', 'archive-projects');
							elseif (is_post_type_archive(array('opportunities'))) :
								get_template_part('template-parts/content', 'archive-opportunities');
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
