<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package apples-and-snakes
 */

get_header();

$header_image = get_template_directory_uri() . '/images/default-banner-image.jpg';
?>
	<div class="section">
		<div class="header-container" style="background-image: url(<?php echo $header_image; ?>);">
			<div class="header-content">
				<header class="entry-header">
					<?php
					if (is_post_type_archive('event')) : ?>

						<h1 class="entry-title"><?php echo __("What's On") ?></h1>
					
					<?php elseif (is_post_type_archive('project')) : ?>

						<h1 class="entry-title"><?php echo __("Projects") ?></h1>
					
					<?php elseif (is_post_type_archive('case_studies')) : ?>

						<h1 class="entry-title"><?php echo __("Case Studies") ?></h1>
					
					<?php else : ?>

						<h1 class="entry-title"><?php echo single_cat_title('', false); ?></h1>
					
					<?php endif; ?>
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
						<?php ?>
						<?php
						$count = 0;
						/* Start the Loop */
						while (have_posts()) :
							the_post();
							if (is_post_type_archive('event')) :
								if ($count == 0)
								{
									get_template_part('template-parts/content', 'archive-highlight');
								}
								else
								{
									get_template_part('template-parts/content', 'archive-posts');
								}
							elseif (is_post_type_archive('project')) :
								get_template_part('template-parts/content', 'archive-projects');
							else :
								get_template_part('template-parts/content', 'archive-posts');
							endif;
							
							$count++;
						
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
