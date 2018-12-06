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
				<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
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
						<?php
						the_archive_title('<h1 class="page-title">', '</h1>');
						the_archive_description('<div class="archive-description">', '</div>');
						?>
					</header><!-- .page-header -->
					
					<?php
					/* Start the Loop */
					while (have_posts()) :
						the_post();
						
						/*
						 * Include the Post-Type-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
						 */
						get_template_part('template-parts/content', 'archive-posts');
					
					endwhile;
					
					the_posts_navigation();
				
				else :
					
					get_template_part('template-parts/content', 'none');
				
				endif;
				?>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->
</div>
<?php
get_sidebar();
get_footer();
