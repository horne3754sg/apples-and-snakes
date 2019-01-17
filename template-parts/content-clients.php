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
				
				$fundraisers = get_post_meta($post->ID, 'client_fundraisers_re_', true);
				//var_dump($fundraisers);
				if ($fundraisers)
				{
					?>
					<h2>Funders</h2>
					<div class="clients">
						<?php
						foreach ($fundraisers as $c)
						{
							//var_dump($c);
							?>
							<div class="client_item">
								<div class="client_logo">
									<img src="<?php echo !empty($c['client_fundraisers_logo']['url']) ? $c['client_fundraisers_logo']['url'] : ''; ?>" alt="">
								</div>
								<div class="client_meta">
									<?php echo !empty($c['client_fundraisers_desc']) ? $c['client_fundraisers_desc'] : ''; ?>
								</div>
							</div>
							<?php
						}
						?>
					</div>
					<?php
				}
				
				$clients = get_post_meta($post->ID, 'client_re_', true);
				if ($clients)
				{
					?>
					<h2>Partners</h2>
					<div class="clients">
						<?php
						foreach ($clients as $c)
						{
							//var_dump($c);
							?>
							<div class="client_item">
								<div class="client_logo">
									<img src="<?php echo !empty($c['client_logo']['url']) ? $c['client_logo']['url'] : ''; ?>" alt="">
								</div>
								<div class="client_meta">
									<?php echo !empty($c['client_desc']) ? $c['client_desc'] : ''; ?>
								</div>
							</div>
							<?php
						}
						?>
					</div>
					<?php
				}
				//var_dump($clients);
				
				$text_after_content = get_post_meta($post->ID, 'after_clients_textarea', true);
				if (!empty($text_after_content))
				{
					echo wpautop($text_after_content);
				}
				?>
				<?php
				wp_link_pages(array(
					'before' => '<div class="page-links">' . esc_html__('Pages:', 'aas'),
					'after'  => '</div>',
				));
				?>
			</div><!-- .entry-content -->
		</div>
	</article><!-- #post-<?php the_ID(); ?> -->
</div>
