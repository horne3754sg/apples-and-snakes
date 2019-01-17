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

$blog_id = get_option('page_for_posts');
$title = get_the_title($blog_id);
$content = wpautop(get_post_field('post_content', $blog_id));
?>
	<div class="section">
		<div class="header-container" style="background-image: url(<?php echo $header_image; ?>);">
			<div class="header-content">
				<header class="entry-header">
					<h1 class="entry-title"><?php echo $title; ?></h1>
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
							<div class="archive-description"><?php echo $content; ?></div>
						</header><!-- .page-header -->

						<div class="blog-post-types">
							<a class="post-type-block" href="/articles/read/">
								<span>Read</span>
							</a>
							<a class="post-type-block" href="/articles/watch/">
								<span>Watch</span>
							</a>
							<a class="post-type-block" href="/articles/listen/">
								<span>Listen</span>
							</a>
						</div>
					<?php
						//$locations = wp_get_post_terms(get_the_ID(), 'event_location');
						//var_dump($locations);
						
						/*
						?>
						<div class="category-nav">

						</div>
						<?php
						// Start the Loop
						while (have_posts()) :
							the_post();
						
							get_template_part('template-parts/content', 'single-posts');
							
						endwhile;
						
						the_posts_navigation();
					
					else :
						
						get_template_part('template-parts/content', 'none');
					*/
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
