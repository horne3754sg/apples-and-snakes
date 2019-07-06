<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package apples-and-snakes
 */

//$header_image_src = !empty(get_the_post_thumbnail_url()) ? get_the_post_thumbnail_url() : '';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="archive-post-columns">
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
				if (is_post_type_archive('opportunities')) :
					$opportunities_type = wp_get_post_terms(get_the_ID(), 'opportunities_type');
					if (!empty($opportunities_type)) :
						echo '<span class="event-location">' . __('Opportunities') . '/' . $opportunities_type[0]->name . '</span>';
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
				
				$opportunity_date = get_post_meta_event_date(get_the_ID());
				if (!empty($opportunity_date)) :
					echo '<span class="event-featured-time">' . $opportunity_date . '</span>';
				endif;
				
				//echo '<span class="post-date">' . get_the_date('D j M Y') . '</span>';
				
				echo '<a href="' . get_the_permalink() . '" class="button">' . __('More') . '</a>';
				?>
			</div>
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
