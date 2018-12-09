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

	<div class="archive-post-columns">
		<div class="image-col">
			<img src="<?php echo $header_image_src; ?>" alt="">
		</div>
		<div class="content-col">
			<div class="entry-content">
				<span class="meta-category"><?php the_category('/'); ?></span>
				<?php
					
					if (is_singular()) :
						the_title('<h1 class="entry-title">', '</h1>');
					else :
						the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
					endif;
					
					echo '<p class="excerpt">' . get_the_excerpt() . '</p>';
					
					echo '<a href="' . get_the_permalink() . '" class="button">' . __('More') . '</a>';
					?>
			</div>
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
