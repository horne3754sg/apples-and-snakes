<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package apples-and-snakes
 */

$header_image = !empty(get_the_post_thumbnail_url()) ? 'style="background-image: url(' . get_the_post_thumbnail_url() . ');"' : '';
?>
<div class="section">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="header-container" <?php echo $header_image; ?>>
			<div class="header-content">
				<header class="entry-header">
					<?php
					if (is_singular()) :
						$sub_heading = get_post_meta(get_the_ID(), 'sub_heading', true);
						echo(!empty($sub_heading) ? '<div class="sub_heading">' . $sub_heading . '</div>' : '');
						the_title('<h1 class="entry-title">', '</h1>');
					else :
						the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
					endif;
					
					if ('post' === get_post_type()) :
						?>
						<div class="entry-meta">
							<?php
							aas_posted_on();
							aas_posted_by();
							?>
						</div><!-- .entry-meta -->
					<?php endif; ?>
				</header><!-- .entry-header -->
			</div>
		</div>

		<div class="container">
			<div class="columns">
				<div class="content-column">
					<div class="entry-content">
						<?php
						the_content(sprintf(
							wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
								__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'aas'),
								array(
									'span' => array(
										'class' => array(),
									),
								)
							),
							get_the_title()
						));
						
						wp_link_pages(array(
							'before' => '<div class="page-links">' . esc_html__('Pages:', 'aas'),
							'after'  => '</div>',
						));
						?>
					</div><!-- .entry-content -->
					
					<?php get_template_part('template-parts/social', 'share-bar'); ?>

					<a class="button back" href="<?php echo get_post_type_archive_link('event'); ?>">back to what's
						on</a>

				</div>

				<div class="sidebar">
					<div class="event-meta">
						
						<?php
						$event_meta = get_post_meta($post->ID, 'aas_event', true);
						//var_dump($event_meta);
						$event_date = get_post_meta_event_date($post->ID);
						$now = date('Y-m-d');
						
						if (!empty($event_meta['event']))
						{
							?>
							<div class="meta-section">
								<div class="meta-header">
									<h3><?php echo __('Event Dates'); ?></h3>
								</div>
								<?php
								foreach ($event_meta['event'] as $event)
								{
									if (strtotime($now) <= $event['when_order'])
									{
										?>
										<div class="meta-info events_list_item">
											<?php
											$when_order = !empty($event['when_order']) ? (int)$event['when_order'] : '';
											$time = !empty($event['time']) ? $event['time'] : '';
											$event_date = date("l d M", $when_order) . (!empty($time) ? ', ' . $time : '');
											
											echo ($event['where']) ? '<span class="where">' . $event['where'] . '</span>' : '';
											echo ($event_date) ? '<span class="when">' . $event_date . '</span>' : '';
											echo ($event['address']) ? '<span class="address">' . $event['address'] . '</span>' : '';
											?>
										</div>
									<?php }
									else
									{ ?>
										<div class="meta-info events_list_item past_event">
											<?php
											$when_order = !empty($event['when_order']) ? (int)$event['when_order'] : '';
											$time = !empty($event['time']) ? $event['time'] : '';
											$event_date = date("l d M", $when_order) . (!empty($time) ? ', ' . $time : '');
											
											echo ($event['where']) ? '<span class="where">' . $event['where'] . '</span>' : '';
											echo ($event_date) ? '<span class="when">' . $event_date . '</span>' : '';
											echo ($event['address']) ? '<span class="address">' . $event['address'] . '</span>' : '';
											?>
										</div>
									<?php }
								} ?>
							</div>
						<?php }
						else
						{
							if (!empty($event_date) || !empty($time))
							{
								?>
								<div class="meta-section">
									<div class="meta-header">
										<h3><?php echo __('When'); ?></h3>
									</div>
									<div class="meta-info">
										<?php
										echo ($event_date) ? '<span class="when">' . $event_date . '</span>' : '';
										//echo ($time) ? '<span class="time">' . $time . '</span>' : '';
										?>
									</div>
								</div>
							<?php } ?>
							
							<?php
							
							
							$where = !empty($event_meta['where']) ? $event_meta['where'] : get_post_meta(get_the_ID(), 'where', true);
							$address = !empty($event_meta['address']) ? $event_meta['address'] : get_post_meta(get_the_ID(), 'address', true);
							if (!empty($where) || !empty($address))
							{
								?>
								<div class="meta-section">
									<div class="meta-header">
										<h3><?php echo __('Where'); ?></h3>
									</div>
									<div class="meta-info">
										<?php
										echo ($where) ? '<span class="where">' . $where . '</span>' : '';
										echo ($address) ? '<span class="address">' . $address . '</span>' : '';
										?>
									</div>
								</div>
							<?php }
						} // end else ?>
						
						<?php
						$age = !empty($event_meta['age']) ? $event_meta['age'] : get_post_meta(get_the_ID(), 'age', true);
						if (!empty($age))
						{
							?>
							<div class="meta-section">
								<div class="meta-header">
									<h3><?php echo __('Age'); ?></h3>
								</div>
								<div class="meta-info">
									<?php echo ($age) ? '<span class="age">' . $age . '</span>' : ''; ?>
								</div>
							</div>
						<?php } ?>
						
						<?php
						$other = !empty($event_meta['other']) ? $event_meta['other'] : get_post_meta(get_the_ID(), 'other', true);
						if (!empty($other))
						{
							?>
							<div class="meta-section">
								<div class="meta-header">
									<h3><?php echo __('Other Info'); ?></h3>
								</div>
								<div class="meta-info">
									<?php echo ($other) ? '<span class="other">' . $other . '</span>' : ''; ?>
								</div>
							</div>
						<?php } ?>
						
						
						<?php $tickets = !empty($event_meta['tickets']) ? $event_meta['tickets'] : get_post_meta(get_the_ID(), 'tickets', true);
						if (!empty($tickets))
						{
							?>
							<div class="meta-section">
								<div class="meta-header">
									<h3><?php echo __('Tickets'); ?></h3>
								</div>

								<div class="meta-info">
									<?php echo ($tickets) ? '<span class="tickets">' . $tickets . '</span>' : ''; ?>
								</div>
								
								<?php
								$tickets_link = !empty($event_meta['tickets_link']) ? $event_meta['tickets_link'] : get_post_meta(get_the_ID(), 'tickets_link', true);
								$tickets_text = !empty($event_meta['tickets_text']) ? $event_meta['tickets_text'] : get_post_meta(get_the_ID(), 'tickets_text', true);
								if (!empty($tickets_link))
								{ ?>
									<div class="meta-info">
										<?php echo ($tickets_link) ? '<a class="tickets_link button red" href="' . esc_url($tickets_link) . '">' . (!empty($tickets_text) ? $tickets_text : 'Get Tickets') . '</a>' : ''; ?>
									</div>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
			<?php
			/*
			<div class="post-content-columns">

				<div class="col col-related-content">
					<div class="col-header">
						<h3>You might also like...</h3>
					</div>
					<div class="related_posts">
						<?php
						$terms = get_the_terms($post->ID, 'event_location');
						//Pluck out the IDs to get an array of IDS
						$term_ids = wp_list_pluck($terms, 'term_id');
						
						$related_posts = new WP_Query(array(
							'post_type'           => 'event',
							'tax_query'           => array(
								array(
									'taxonomy' => 'event_location',
									'field'    => 'id',
									'terms'    => $term_ids,
									'operator' => 'IN'
								)
							),
							'posts_per_page'      => 4,
							'ignore_sticky_posts' => 1,
							'orderby'             => 'rand',
							'post__not_in'        => array($post->ID)
						));
						
						if ($related_posts->have_posts()) :
							while ($related_posts->have_posts()) : $related_posts->the_post();
								$background_src = get_the_post_thumbnail_url(get_the_ID(), 'related_sm');
								$background_image = !empty($background_src) ? 'style="background-image: url(' . $background_src . ')"' : '';
								?>
								<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="single_related" <?php echo $background_image; ?>>
									<div class="related_content">
										<div class="content-meta">
											<?php
											$locations = wp_get_post_terms(get_the_ID(), 'event_location');
											if (!empty($locations)) :
												echo '<span class="event-location">' . __('Event') . '/' . $locations[0]->name . '</span>';
											endif;
											
											the_title('<h2 class="entry-title">', '</h2>');
											
											$when_featured = get_post_meta(get_the_ID(), 'when_featured', true);
											if (!empty($when_featured)) :
												echo '<span class="event-featured-time">' . $when_featured . '</span>';
											endif;
											?>
										</div>
									</div>
								</a>
							<?php
							endwhile;
							wp_reset_query();
						endif;
						?>
					</div>
				</div>

				<div class="col col-latest-events">
					<div class="col-header">
						<h3>Latest Events</h3>
					</div>
					<div class="latest_events post_list">
						<?php
						$latest_events = new WP_Query(array(
							'post_type'           => 'event',
							'posts_per_page'      => 4,
							'ignore_sticky_posts' => 1,
							'orderby'             => 'ASC',
							'post__not_in'        => array($post->ID)
						));
						
						if ($latest_events->have_posts()) :
							while ($latest_events->have_posts()) : $latest_events->the_post();
								?>
								<div class="post-item">
									<?php
									$locations = wp_get_post_terms(get_the_ID(), 'event_location');
									if (!empty($locations)) :
										echo '<span class="event-location">' . __('Event') . '/' . $locations[0]->name . '</span>';
									endif;
									?>
									<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title('<h2 class="entry-title">', '</h2>'); ?></a>
								</div>
							<?php
							endwhile;
							wp_reset_query();
						endif; ?>
					</div>
				</div>

				<div class="col col-latest-read">
					<div class="col-header">
						<h3>Latest Read</h3>
					</div>
					<div class="latest_events post_list">
						<?php
						$latest_posts = new WP_Query(array(
							'post_type'           => 'post',
							'posts_per_page'      => 4,
							'ignore_sticky_posts' => 1,
							'orderby'             => 'ASC',
							'post__not_in'        => array($post->ID)
						));
						
						if ($latest_posts->have_posts()) :
							while ($latest_posts->have_posts()) : $latest_posts->the_post();
								?>
								<div class="post-item">
									<?php
									$locations = wp_get_post_terms(get_the_ID(), 'event_location');
									if (!empty($locations)) :
										echo '<span class="event-location">' . __('Event') . '/' . $locations[0]->name . '</span>';
									endif;
									?>
									<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title('<h2 class="entry-title">', '</h2>'); ?></a>
								</div>
							<?php
							endwhile;
							wp_reset_query();
						endif; ?>
					</div>
				</div>

			</div>
			*/
			?>
		</div>

	</article><!-- #post-<?php the_ID(); ?> -->
</div>
