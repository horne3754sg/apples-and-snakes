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
				</div>

				<div class="sidebar">
					<div class="event-meta">
						
						<?php
						$when = get_post_meta(get_the_ID(), 'when', true);
						$time = get_post_meta(get_the_ID(), 'address', true);
						if (!empty($when) || !empty($address))
						{
							?>
							<div class="meta-section">
								<div class="meta-header">
									<h3><?php echo __('When'); ?></h3>
								</div>
								<div class="meta-info">
									<?php
									echo ($when) ? '<span class="when">' . $when . '</span>' : '';
									echo ($time) ? '<span class="time">' . $time . '</span>' : '';
									?>
								</div>
							</div>
						<?php } ?>
						
						<?php
						$where = get_post_meta(get_the_ID(), 'where', true);
						$address = get_post_meta(get_the_ID(), 'address', true);
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
						<?php } ?>
						
						<?php
						$tickets = get_post_meta(get_the_ID(), 'tickets', true);
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
							</div>
						<?php } ?>
						
						<?php
						$other = get_post_meta(get_the_ID(), 'other', true);
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

					</div>
				</div>
			</div>

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
		</div>

	</article><!-- #post-<?php the_ID(); ?> -->
</div>
