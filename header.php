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
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!=='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-TZNTMMT');</script>
	<!-- End Google Tag Manager -->

</head>

<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TZNTMMT"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
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

			<div class="header_wrap">
				<div class="menu_wrap">
					<div class="social_info">
						<a href="https://www.facebook.com/applesandsnakes/" target="_blank" rel="noopener noopener"
						   class="social_icon"><img src="<?php echo get_template_directory_uri(); ?>/images/facebook.png"
						                            alt=""></a>
						<a href="https://twitter.com/applesandsnakes" target="_blank" rel="noopener noopener"
						   class="social_icon"><img src="<?php echo get_template_directory_uri(); ?>/images/twitter.png"
						                            alt=""></a>
						<a href="https://www.instagram.com/applesandsnakes/" target="_blank" rel="noopener noopener"
						   class="social_icon"><img src="<?php echo get_template_directory_uri(); ?>/images/instagram.png"
						                            alt=""></a>
						<a href="https://www.youtube.com/user/applesandsnakes/" target="_blank" rel="noopener noopener"
						   class="social_icon"><img src="<?php echo get_template_directory_uri(); ?>/images/You%20tube.png"
						                            alt=""></a>
					</div>

					<div class="donate_button_wrap">
						<a href="/donate/" class="button donate">DONATE</a>
					</div>

					<nav id="site-navigation" class="main-navigation">
						<a class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
						<span class="menu-icon">
							<img src="<?php echo get_template_directory_uri(); ?>/images/menu-icon.svg" alt="">
						</span>
						</a>
					</nav><!-- #site-navigation -->
				</div>
			</div>
		</div>
	</div>

	<div id="content" class="site-content">
