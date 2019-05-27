<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package apples-and-snakes
 */

get_header();
$header_image = get_post_meta($post->ID, 'featured-header-image', true);
$header_image = !empty($header_image) ? $header_image : (!empty(get_the_post_thumbnail_url()) ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/images/default-banner-image.jpg');
?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">

            <section class="section error-404 not-found">
                <div class="header-container" style="background-image: url(<?php echo $header_image; ?>);">
                    <div class="header-content">
                        <header class="entry-header">
							<h1 class="entry-title">404</h1>
                        </header><!-- .entry-header -->
                    </div>
                </div>

                <div class="container narrow">
                    <p><?php esc_html_e('It looks like nothing was found at this location.', 'aas'); ?></p>

                </div><!-- .page-content -->
            </section><!-- .error-404 -->

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
