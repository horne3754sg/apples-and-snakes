<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package apples-and-snakes
 */

get_header();

$header_image = !empty(get_the_post_thumbnail_url()) ? 'style="background-image: url(' . get_the_post_thumbnail_url() . ');"' : '';
?>
	<div class="section">
		<div class="header-container" <?php echo $header_image; ?>>
			<div class="header-content">
				<header class="entry-header">
					<h1 class="entry-title"><?php echo __("Read") ?></h1>
				</header><!-- .entry-header -->
			</div>
		</div>
	</div>
	<div class="section">
		<div id="primary" class="content-area">
			<main id="main" class="site-main">
				<div class="container narrow">
					<?php if (have_posts()) : ?>

						<header class="page-header">
							<?php the_archive_description('<div class="archive-description">', '</div>'); ?>
						</header><!-- .page-header -->
						
						<?php
						
						//$locations = wp_get_post_terms(get_the_ID(), 'event_location');
						//var_dump($locations);
						
						?>
						<div class="category-nav">

						</div>
						<?php
						/* Start the Loop */
						while (have_posts()) :
							the_post();
						
							get_template_part('template-parts/content', 'single-posts');
							
						endwhile;
						
						the_posts_navigation();
					
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
