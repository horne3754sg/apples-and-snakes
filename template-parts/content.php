<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package apples-and-snakes
 */

$featured_header_image = get_post_meta($post->ID, 'featured-header-image', true);
$featured_header_image = !empty($featured_header_image) ? $featured_header_image : (!empty(get_the_post_thumbnail_url()) ? get_the_post_thumbnail_url() : '');
$header_image = !empty(get_the_post_thumbnail_url()) ? get_the_post_thumbnail_url() : '';
$header_image = !empty($header_image) ? $header_image : '';
?>
<style>
	.section .header-container {
		background-image: url(<?php echo $featured_header_image; ?>);
	}

	@media screen and (max-width: 800px) {
		.section .header-container {
			background-image: url(<?php echo $header_image; ?>);
		}
	}
</style>
?>
<div class="section">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="header-container">
			<div class="header-content">
				<header class="entry-header">
					<?php
					if (is_singular()) :
						the_title('<h1 class="entry-title single-post-title">', '</h1>');
					else :
						the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
					endif;
					?>
				</header><!-- .entry-header -->
			</div>
		</div>

		<div class="container">
			<div class="columns single_col">
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
			</div>
			<?php /*
			<div class="post-content-columns">

				<div class="col col-related-content">
					<div class="col-header">
						<h3>You might also like...</h3>
					</div>
					<div class="related_posts">
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
								$background_src = get_the_post_thumbnail_url(get_the_ID(), 'related_sm');
								$background_image = !empty($background_src) ? 'style="background-image: url(' . $background_src . ')"' : '';
								?>
								<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="single_related" <?php echo $background_image; ?>>
									<div class="related_content">
										<div class="content-meta">
											<?php
											//$locations = wp_get_post_terms(get_the_ID(), 'event_location');
											//if (!empty($locations)) :
											//	echo '<span class="event-location">' . __('Event') . '/' . $locations[0]->name . '</span>';
											//endif;
											
											the_title('<h2 class="entry-title">', '</h2>');
											
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

			</div>*/
			?>
		</div>

	</article><!-- #post-<?php the_ID(); ?> -->
</div>
