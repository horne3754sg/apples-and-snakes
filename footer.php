<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package apples-and-snakes
 */

?>

</div><!-- #content -->
<div class="section footer">
	<div class="container">
		<div class="cols">
			<div class="col">
				<div class="footer-logo">
					<img src="<?php echo get_template_directory_uri(); ?>/images/footer-logo.png" alt="">
				</div>

				<div class="address">
					<span class="heading">Address:</span>
					<span>The Albany</span>
					<span>Douglas Way</span>
					<span>London</span>
					<span>SE8 4AG</span>
					<br/>
					<span class="heading">Phone:</span>
					<span>020 8465 6140</span>
				</div>
				<a class="button" href="#">GET IN TOUCH</a>
				<div class="social_info">
					<a href="#" class="social_icon"><img src="<?php echo get_template_directory_uri(); ?>/images/facebook.png" alt=""></a>
					<a href="#" class="social_icon"><img src="<?php echo get_template_directory_uri(); ?>/images/twitter.png" alt=""></a>
					<a href="#" class="social_icon"><img src="<?php echo get_template_directory_uri(); ?>/images/instagram.png" alt=""></a>
					<a href="#" class="social_icon"><img src="<?php echo get_template_directory_uri(); ?>/images/You%20tube.png" alt=""></a>
				</div>
			</div>
			<div class="col  no-mobile">
				<a href="/support-us/" title="support us"><img src="<?php echo get_template_directory_uri(); ?>/images/support-us.png" alt=""></a>
			</div>
			<div class="col">
				<h3>KEEP UP TO DATE!</h3>
				<form action="">
					<input type="text" value="" placeholder="FIRST NAME">
					<input type="text" value="" placeholder="LAST NAME">
					<input type="text" value="" placeholder="EMAIL">
					<button type="submit">JOIN</button>
				</form>
			</div>
			<div class="col">
				<h3>TWITTER</h3>
			</div>
		</div>
	</div>
</div>
<div class="section after-footer">
	<div class="container">
		<img src="<?php echo get_template_directory_uri(); ?>/images/NO%20WORD%20UNSPOKEN.svg" alt="">
	</div>
</div>
</div><!-- #page -->
<div class="slideover">
	<div class="slideover_content">
		<div class="menu_logo">
			<img src="<?php echo get_template_directory_uri(); ?>/images/menu-logo.svg" alt="">
			<div class="close">
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 64 64" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 64 64">
					<g>
						<path fill="#1D1D1B" d="M28.941,31.786L0.613,60.114c-0.787,0.787-0.787,2.062,0,2.849c0.393,0.394,0.909,0.59,1.424,0.59   c0.516,0,1.031-0.196,1.424-0.59l28.541-28.541l28.541,28.541c0.394,0.394,0.909,0.59,1.424,0.59c0.515,0,1.031-0.196,1.424-0.59   c0.787-0.787,0.787-2.062,0-2.849L35.064,31.786L63.41,3.438c0.787-0.787,0.787-2.062,0-2.849c-0.787-0.786-2.062-0.786-2.848,0   L32.003,29.15L3.441,0.59c-0.787-0.786-2.061-0.786-2.848,0c-0.787,0.787-0.787,2.062,0,2.849L28.941,31.786z"></path>
					</g>
				</svg>
			</div>
		</div>
		<div class="menu_wrap">
			<?php
			wp_nav_menu(array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
				'container'      => false
			));
			?>
		</div>
		<div class="social_info">
			<a href="#" class="social_icon"><img src="<?php echo get_template_directory_uri(); ?>/images/facebook-red.png" alt=""></a>
			<a href="#" class="social_icon"><img src="<?php echo get_template_directory_uri(); ?>/images/twitter-red.png" alt=""></a>
			<a href="#" class="social_icon"><img src="<?php echo get_template_directory_uri(); ?>/images/instagram-red.png" alt=""></a>
			<a href="#" class="social_icon"><img src="<?php echo get_template_directory_uri(); ?>/images/You%20tube%20red.png" alt=""></a>
		</div>
	</div>
</div>


<?php wp_footer(); ?>

</body>
</html>

