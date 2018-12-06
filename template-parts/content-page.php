<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package apples-and-snakes
 */
$header_image = !empty(get_the_post_thumbnail_url()) ? 'style="background-image: url(' . get_the_post_thumbnail_url() . ');"' : '';
?>

<div class="section">

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="header-container" <?php echo $header_image; ?>>
			<div class="header-content">
				<header class="entry-header">
					<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
				</header><!-- .entry-header -->
			</div>
		</div>

		<div class="container">
			<div class="entry-content">
				<?php
				the_content();
				
				wp_link_pages(array(
					'before' => '<div class="page-links">' . esc_html__('Pages:', 'aas'),
					'after'  => '</div>',
				));
				?>
			</div><!-- .entry-content -->
			
			<?php if (get_edit_post_link()) : ?>
				<footer class="entry-footer">
					<?php
					edit_post_link(
						sprintf(
							wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
								__('Edit <span class="screen-reader-text">%s</span>', 'aas'),
								array(
									'span' => array(
										'class' => array(),
									),
								)
							),
							get_the_title()
						),
						'<span class="edit-link">',
						'</span>'
					);
					?>
				</footer><!-- .entry-footer -->
			<?php endif; ?>
		</div>
	</article><!-- #post-<?php the_ID(); ?> -->
</div>
