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

                        <h1 class="entry-title"><?php echo __("A+S Stories") ?></h1>
					
					<?php elseif (is_post_type_archive('spotlight')) : ?>

                        <h1 class="entry-title"><?php echo __("Spotlight") ?></h1>
					
					<?php elseif (is_post_type_archive('opportunities')) : ?>

                        <h1 class="entry-title"><?php echo __("Artists Opportunities") ?></h1>
					
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

                        <header class="page-header"><?php the_archive_description('<div class="archive-description">', '</div>'); ?></header><!-- .page-header -->
						
						<?php
						
						//$locations = wp_get_post_terms(get_the_ID(), 'event_location');
						//var_dump($locations);
						
						?>
                        <div class="category-nav">
							<?php
							if (is_post_type_archive(array('opportunities')))
							{
							$opportunities_type = get_terms('opportunities_type', array(
								'hide_empty' => true,
								'orderby' => 'name',
								'order' => 'DESC'
							));
							
							if ($opportunities_type)
							{ ?>
                            <ul class="cat_nav">
                                <li>
                                    <a href="<?php echo get_post_type_archive_link('opportunities'); ?>">All</a>
                                </li>
								<?php
								foreach ($opportunities_type as $type)
								{
									//var_dump($type);
									?>
                                    <li>
                                        <a href="<?php echo get_term_link($type->term_id); ?>"><?php echo $type->name; ?></a>
                                    </li>
									<?php
								}
								echo '</ul>';
								}
								}
								
								if (is_post_type_archive(array('event')) || is_tax('event_location'))
								{
								$event_location = get_terms('event_location', array(
									'hide_empty' => true,
									'orderby' => 'name',
									'order' => 'DESC'
								));
								
								if ($event_location)
								{ ?>
                                <ul class="cat_nav">
                                    <li>
                                        <a href="<?php echo get_post_type_archive_link('event'); ?>">All</a>
                                    </li>
									<?php
									foreach ($event_location as $location)
									{
										//var_dump($type);
										?>
                                        <li>
                                            <a href="<?php echo get_term_link($location->term_id); ?>"><?php echo $location->name; ?></a>
                                        </li>
										<?php
									}
									echo '</ul>';
									}
									}
									?>
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
                            elseif (is_post_type_archive(array('project', 'case_studies'))) :
								get_template_part('template-parts/content', 'archive-projects');
                            elseif (is_post_type_archive(array('opportunities'))) :
								get_template_part('template-parts/content', 'archive-opportunities');
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
