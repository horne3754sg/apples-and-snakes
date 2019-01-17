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
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<div class="highlight-header-container" <?php echo $header_image; ?>>
		<a href="<?php echo esc_url( get_permalink() ); ?>" class="header-content">
			<span class="highlight">Highlight</span>
			<header class="entry-header">
				<?php
				$locations = wp_get_post_terms(get_the_ID(), 'event_location');
				if(!empty($locations)) :
					echo '<span class="event-location">' . $locations[0]->name . '</span>';
				endif;
		
				if ( is_singular() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					the_title( '<h2 class="entry-title">', '</h2>' );
				endif;
				
				$when_featured = get_post_meta(get_the_ID(), 'when_featured', true);
				if(!empty($when_featured)) :
					echo '<span class="event-featured-time">' . $when_featured . '</span>';
				endif;
				?>
			</header><!-- .entry-header -->
		</a>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
