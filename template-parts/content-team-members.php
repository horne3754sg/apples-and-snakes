<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package apples-and-snakes
 */
global $post;
$header_image = !empty(get_the_post_thumbnail_url()) ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/images/default-banner-image.jpg';
?>

<div class="section">

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="header-container" style="background-image: url(<?php echo $header_image; ?>);">
			<div class="header-content">
				<header class="entry-header">
					<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
				</header><!-- .entry-header -->
			</div>
		</div>

		<div class="container narrow">
			<div class="entry-content">
				<?php
				the_content();
				$team_members = get_post_meta($post->ID, 'team_re_', true);
				if ($team_members)
				{
					?>
					<div class="team_members">
						<?php
						foreach ($team_members as $t)
						{
							//var_dump($c);
							?>
							<div class="team_item">
								<div class="team_picture">
									<img src="<?php echo !empty($t['team_picture']['url']) ? $t['team_picture']['url'] : ''; ?>" alt="">
								</div>
								<div class="team_meta">
									<div class="team_meta_head">
										<?php echo !empty($t['team_name']) ? '<h3>' . $t['team_name'] . '</h3>' : ''; ?>
										<?php echo !empty($t['team_role']) ? '<span class="team_role">' . $t['team_role'] . '</span>' : ''; ?>
									</div>
									<?php echo !empty($t['team_desc']) ? $t['team_desc'] : ''; ?>
								</div>
							</div>
							<?php
						}
						?>
					</div>
					<?php
				}
				//var_dump($clients);
				
				wp_link_pages(array(
					'before' => '<div class="page-links">' . esc_html__('Pages:', 'aas'),
					'after'  => '</div>',
				));
				?>
			</div><!-- .entry-content -->
		</div>
	</article><!-- #post-<?php the_ID(); ?> -->
</div>
