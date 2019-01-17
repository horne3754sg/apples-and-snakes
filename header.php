<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package apples-and-snakes
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'aas'); ?></a>


	<div class="section header">
		<div class="container">


			<div class="site-branding">
				<a href="<?php echo esc_url(home_url('/')); ?>">
					<picture>
						<source media="(max-width: 900px)" srcset="<?php echo get_template_directory_uri(); ?>/images/apples-and-snakes-dark-logo.svg">
						<img src="<?php echo get_template_directory_uri(); ?>/images/apples-and-snakes-logo.svg" alt="Apples and Snakes">
					</picture>
				</a>
				<?php
				if (is_front_page() && is_home()) : ?>
					<h1 class="site-title">
						<a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
				<?php else : ?>
					<p class="site-title">
						<a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
				<?php endif; ?>
			</div><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation">
				<a class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
					<span class="menu-icon">
						<img src="<?php echo get_template_directory_uri(); ?>/images/menu-icon.svg" alt="">
					</span>
				</a>
			</nav><!-- #site-navigation -->
		</div>
	</div>

	<div id="content" class="site-content">
