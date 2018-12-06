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
<div class="section">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
		<div class="header-container" <?php echo $header_image; ?>>
			<div class="header-content">
				<header class="entry-header">
					<?php
					if ( is_singular() ) :
						the_title( '<h1 class="entry-title">', '</h1>' );
					else :
						the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
					endif;
			
					if ( 'post' === get_post_type() ) :
						?>
						<div class="entry-meta">
							<?php
							aas_posted_on();
							aas_posted_by();
							?>
						</div><!-- .entry-meta -->
					<?php endif; ?>
				</header><!-- .entry-header -->
			</div>
		</div>
		
		<div class="container">
			<div class="columns">
				<div class="content-column">
					<div class="entry-content">
						<?php
						the_content( sprintf(
							wp_kses(
								/* translators: %s: Name of current post. Only visible to screen readers */
								__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'aas' ),
								array(
									'span' => array(
										'class' => array(),
									),
								)
							),
							get_the_title()
						) );
				
						wp_link_pages( array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'aas' ),
							'after'  => '</div>',
						) );
						?>
					</div><!-- .entry-content -->
				</div>
				<div class="sidebar">
				
				</div>
			</div>
		</div>
		
	</article><!-- #post-<?php the_ID(); ?> -->
</div>
