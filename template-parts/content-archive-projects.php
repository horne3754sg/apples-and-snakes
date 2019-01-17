<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package apples-and-snakes
 */

$header_image_src = !empty(get_the_post_thumbnail_url()) ? get_the_post_thumbnail_url() : '';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="archive-project-posts">
		<div class="image-col">
			<?php if (has_post_thumbnail()) : ?>
                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_post_thumbnail(); ?>
                </a>
			<?php endif; ?>
		</div>
		<div class="content-col">
			<div class="entry-content">
				<?php
				if (is_post_type_archive('project')) :
					$locations = wp_get_post_terms(get_the_ID(), 'event_location');
					if (!empty($locations)) :
						echo '<span class="event-location">' . __('Project') . '/' . $locations[0]->name . '</span>';
					endif;
				elseif (is_post_type_archive('case_studies')) :
					$cs_location = wp_get_post_terms(get_the_ID(), 'case_study_location');
					if (!empty($cs_location)) :
						echo '<span class="event-location">' . __('Case Study') . '/' . $cs_location[0]->name . '</span>';
					endif;
				else : ?>
					<span class="meta-category"><?php the_category("/"); ?></span>
				<?php
				endif;
				
				if (is_singular()) :
					the_title('<h1 class="entry-title">', '</h1>');
				else :
					the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
				endif;
				
				if (is_post_type_archive('event')) :
					$when_featured = get_post_meta(get_the_ID(), 'when_featured', true);
					if (!empty($when_featured)) :
						echo '<span class="event-featured-time">' . $when_featured . '</span>';
					endif;
				endif;
				
				echo '<a href="' . get_the_permalink() . '" class="button">' . __('More') . '</a>';
				?>
			</div>
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
