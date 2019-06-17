<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package apples-and-snakes
 */
$header_image = !empty(get_the_post_thumbnail_url()) ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/images/default-banner-image.jpg';
?>

<div class="section">

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
		<?php
		$front_id = get_option('page_on_front');
		$featured_content = get_post_meta($front_id, 'front_slider_re_', true);
		if ($featured_content)
		{
			echo '<div id="slider">';
			foreach ($featured_content as $content)
			{
				if ($content['front_slider_image']['url'])
				{
					?>
					<div class="slide_item header-container"
					     style="background-image: url(<?php echo $content['front_slider_image']['url']; ?>);">
						<div class="header-content">
							<header class="entry-header">
								<h1 class="entry-title"><?php echo $content['front_slider_title']; ?></h1>
								<div class="meta">
									<span class="date"><?php echo $content['front_slider_date']; ?></span>
								</div>
								<?php if (!empty($content['front_slider_button_link'])) : ?>
									<div class="action-container">
										<a href="<?php echo $content['front_slider_button_link']; ?>"
										   class="button"><?php echo(!empty($content['front_slider_button_text']) ? $content['front_slider_button_text'] : 'MORE'); ?></a>
									</div>
								<?php endif; ?>
							</header>
						</div>
					</div>
					<?php
				}
			}
			echo '</div>';
		}
		else
		{
			?>
			<div class="header-container" style="background-image: url(<?php echo $header_image; ?>);">
				<div class="header-content">
					<header class="entry-header">
						<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
					</header>
				</div>
			</div>
		<?php } ?>

		<div class="container">
			<div class="events_section">

				<div class="quote-text mobile">
					<span>WE ARE SPOKEN WORD TRAILBLAZERS, WITH ARTISTS AT OUR HEART.</span>
				</div>

				<div class="events_section-header">
					<h3>What's On</h3>
				</div>

				<div class="events_list">
					<?php
					
					$related_posts = new WP_Query(array(
						'post_type'           => 'event',
						'posts_per_page'      => 5,
						'ignore_sticky_posts' => 1,
						'order'               => 'ASC',
						'orderby'             => 'when_order',
						'post__not_in'        => array($post->ID),
						'meta_query'          => array(
							array(
								'relation' => 'AND',
								array(
									'key'     => 'when_order',
									'compare' => 'EXISTS'
								),
								array(
									'taxonomy' => 'event-category',
									'field'    => 'id',
									'terms'    => array(ECTYPE), // 30
									'operator' => 'NOT IN'
								),
								array(
									'taxonomy' => 'event_location',
									'field'    => 'id',
									'terms'    => array(ELTYPE), // 30
									'operator' => 'NOT IN'
								)
							)
						),
						'tax_query'           => array(
							'relation' => 'AND',
							array(
								'taxonomy' => 'event-category',
								'field'    => 'id',
								'terms'    => array(ECTYPE), // 30
								'operator' => 'NOT IN'
							),
							array(
								'taxonomy' => 'event_location',
								'field'    => 'id',
								'terms'    => array(ELTYPE), // 30
								'operator' => 'NOT IN'
							)
						)
					));
					
					$count = 0;
					
					if ($related_posts->have_posts()) :
						while ($related_posts->have_posts()) : $related_posts->the_post();
							if ($count == 2) : ?>
								<div class="quote-text">
									<span>WE ARE SPOKEN WORD TRAILBLAZERS, WITH ARTISTS AT OUR HEART.</span>
								</div>
							<?php
							endif;
							$background_src = get_the_post_thumbnail_url(get_the_ID(), 'related_sm');
							$background_image = !empty($background_src) ? 'style="background-image: url(' . $background_src . ')"' : '';
							?>
							<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"
							   class="single_events_list" <?php echo $background_image; ?>>
								<div class="events_list_content">
									<div class="content-meta">
										<?php
										$locations = wp_get_post_terms(get_the_ID(), 'event_location');
										if (!empty($locations)) :
											echo '<span class="event-location">' . $locations[0]->name . '</span>';
										endif;
										
										the_title('<h2 class="entry-title">', '</h2>');
										$event_date = get_post_meta_event_date(get_the_ID(), false, true);
										if (!empty($event_date)) :
											echo '<span class="event-featured-time">' . $event_date . '</span>';
										endif;
										?>
									</div>
								</div>
							</a>
							<?php
							$count++;
						endwhile;
						wp_reset_query();
					endif;
					?>
				</div>

				<div class="button-wrap">
					<a href="/whats-on/" class="button right red">More</a>
				</div>
			</div>

			<div class="highlight_section">
				<div class="columns">
					<div class="col-25">
						<div class="quote-text"><span>By bringing together important voices in interesting ways, we create inspiring experiences for audiences.</span>
						</div>
<!--						<div class="support-us">-->
<!--							<div class="section_spotlight-header">-->
<!--								<h3>Support Us</h3>-->
<!--							</div>-->
<!--							<div class="section_content">-->
<!--								<a href="/support-us/" title="support us" class="inner-wrap">-->
<!--									<img src="--><?php //echo get_template_directory_uri() . '/images/support-us-2.png' ?><!--"-->
<!--									     alt="">-->
<!--								</a>-->
<!--							</div>-->
<!--						</div>-->
					</div>
					<div class="content col-75">
						<div class="highlight_section-header">
							<h3>A+S</h3>
						</div>

						<div class="hightlight-video videoWrapper">
							<iframe width="560" height="315" src="https://www.youtube.com/embed/FQQPiOQZZ6c"
							        frameborder="0"
							        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
							        allowfullscreen></iframe>
						</div>

						<!--						<div class="highlight_section-header optin">-->
						<!--							<h3>Keep up to Date</h3>-->
						<!--						</div>-->

						<div class="optin-form-wrap">
							<div class="optin-header">
								<h3>JOIN OUR MAILING LIST</h3>
							</div>
							<div class="optin-form">
								<?php dynamic_sidebar('front-sign-up'); ?>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="projects_section">
				<div class="columns">
					<div class="col">
						<div class="projects_section-header">
							<h3>Projects</h3>
						</div>
						<div class="featured-project">
							<?php
							
							$featured_project = new WP_Query(array(
								'post_type'           => 'project',
								'posts_per_page'      => 1,
								'ignore_sticky_posts' => 1,
								'orderby'             => 'ASC',
								'post__not_in'        => array($post->ID)
							));
							
							if ($featured_project->have_posts()) :
								while ($featured_project->have_posts()) : $featured_project->the_post();
									
									$background_src = get_the_post_thumbnail_url(get_the_ID(), 'full');
									$background_image = !empty($background_src) ? 'style="background-image: url(' . $background_src . ')"' : '';
									?>
									<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"
									   class="featured_content" <?php echo $background_image; ?>>
										<div class="featured_content_inner">
											<div class="content-meta">
												<span class="meta"><?php echo __('Project'); ?></span>
												<?php the_title('<h2 class="entry-title">', '</h2>'); ?>
											</div>
										</div>
									</a>
								<?php
								endwhile;
								wp_reset_query();
							endif;
							?>
						</div>
						<div class="button-wrap">
							<a href="/project/" class="button right blue">More</a>
						</div>
					</div>
					<div class="col work-with-us">
						<!--						<h2>Work With Us</h2>-->
						<!--						<p>We positively encourage artists and producers to push the boundaries of what poetry and spoken word can be.</p>-->
						<!--						<a href="#" class="more">FIND OUT HOW</a>-->
						<h2>We champion the development of extraordinary artists. Want to get involved in spoken word?
							You are in the right place.</h2>
					</div>
				</div>
			</div>

			<div class="spotlight_section">
				<div class="container">
					<div class="columns">

						<div class="read-watch-listen-col col-75">
							<div class="section_spotlight-header">
								<h3>READ, WATCH, LISTEN</h3>
							</div>
							<div class="section_content">
								<div class="blog-post-types">
									<a class="post-type-block" href="/articles/read/">
										<span>Read</span>
									</a>
									<a class="post-type-block" href="/articles/watch/">
										<span>Watch</span>
									</a>
									<a class="post-type-block" href="/articles/listen/">
										<span>Listen</span>
									</a>
								</div>
								<?php //echo do_shortcode( '[instagram-feed num=9 cols=3]' ); ?>
								<?php //echo do_shortcode('[jr_instagram id="2"]'); ?>
							</div>
						</div>
						
						<?php
						$args = array(
							'numberposts'      => 1,
							'offset'           => 0,
							'category'         => 0,
							'orderby'          => 'post_date',
							'order'            => 'DESC',
							'post_type'        => 'spotlight',
							'post_status'      => 'publish',
							'suppress_filters' => true
						);
						
						$recent_posts = wp_get_recent_posts($args, ARRAY_A);
						if (!empty($recent_posts[0]))
						{
							$spotlight_image = get_the_post_thumbnail_url($recent_posts[0]['ID']);
							?>
							<div class="spotlight col-25">
								<div class="section_spotlight-header margin-40">
									<h3>Spotlight</h3>
								</div>
								<div>
									<a class="section_content" href="<?php echo get_the_permalink($recent_posts[0]['ID']); ?>">
										<img src="<?php echo $spotlight_image; ?>" alt="">
									</a>
								</div>
							</div>
							<?php
							
						}
						?>
					</div>
				</div>
			</div>

		</div>

	</article><!-- #post-<?php the_ID(); ?> -->
</div>
