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

					<div class="aas-share-this">
						<h3>Share This</h3>
						<div class="social_icons">
							<svg width="40px" height="40px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
								<g id="Welcome" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<g id="Individual-Event-V2-Copy" transform="translate(-409.000000, -1461.000000)">
										<g id="facebook" transform="translate(409.000000, 1461.000000)">
											<rect id="Rectangle" x="0" y="0" width="40" height="40"></rect>
											<circle id="Oval" stroke="#FFFFFF" stroke-width="0.899999976" cx="20" cy="20" r="19.55"></circle>
											<path d="M21.195187,31.8181818 L16.7611289,31.8181818 L16.7611289,21.3623167 L14.5454545,21.3623167 L14.5454545,17.7595763 L16.7611289,17.7595763 L16.7611289,15.5966124 C16.7611289,12.6576737 18.0115522,10.9090909 21.5663853,10.9090909 L24.5251335,10.9090909 L24.5251335,14.5131509 L22.6759158,14.5131509 C21.2920508,14.5131509 21.2006059,15.0166108 21.2006059,15.9562266 L21.1945096,17.7595763 L24.5454545,17.7595763 L24.1532578,21.3623167 L21.1945096,21.3623167 L21.1945096,31.8181818 L21.195187,31.8181818 Z" id="Shape" fill="#FFFFFF"></path>
										</g>
									</g>
								</g>
							</svg>

							<svg width="40px" height="40px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
								<g id="Welcome" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<g id="Individual-Event-V2-Copy" transform="translate(-462.000000, -1461.000000)">
										<g id="twitter" transform="translate(462.000000, 1461.000000)">
											<rect id="Rectangle" x="0" y="0" width="40" height="40"></rect>
											<circle id="Oval" stroke="#FFFFFF" stroke-width="0.899999976" cx="20" cy="20" r="19.55"></circle>
											<path d="M27.7510445,15.3143015 C28.5600858,14.8037503 29.1808737,13.9941959 29.4722182,13.0298215 C28.7147225,13.5037359 27.8776673,13.846467 26.9845844,14.0320145 C26.2719109,13.2283692 25.2533256,12.7272727 24.1260465,12.7272727 C21.9633738,12.7272727 20.2108246,14.5768387 20.2108246,16.8577732 C20.2108246,17.1815949 20.2433207,17.4971439 20.310554,17.7985109 C17.05646,17.6259635 14.1710288,15.983218 12.2380701,13.4824629 C11.9007828,14.0946516 11.7080472,14.8037503 11.7080472,15.5601224 C11.7080472,16.9925019 12.3994301,18.2570614 13.4505115,18.9992515 C12.808433,18.9779785 12.2044534,18.7900674 11.6755511,18.4827912 L11.6755511,18.53361 C11.6755511,20.5356322 13.0247003,22.2055599 14.8187101,22.5837459 C14.4892667,22.680656 14.1441355,22.7291111 13.7855576,22.7291111 C13.5334326,22.7291111 13.2869103,22.7042927 13.0493525,22.6558376 C13.5468793,24.2962195 14.9935168,25.4922327 16.7079672,25.5241422 C15.3666619,26.6327 13.6779843,27.2921618 11.8436344,27.2921618 C11.5276377,27.2921618 11.2150026,27.2744344 10.9090909,27.2354339 C12.6425907,28.4066288 14.7010517,29.0909091 16.9130289,29.0909091 C24.1182026,29.0909091 28.0558357,22.7964755 28.0558357,17.3375967 C28.0558357,17.1579583 28.0535946,16.9795018 28.0457507,16.8034089 C28.8110903,16.2207661 29.4767004,15.492758 30,14.6642942 C29.2974115,14.9928434 28.5421569,15.2150276 27.7510445,15.3143015 Z" id="Shape" fill="#FFFFFF"></path>
										</g>
									</g>
								</g>
							</svg>
						</div>
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

			</div>
		</div>

	</article><!-- #post-<?php the_ID(); ?> -->
</div>
