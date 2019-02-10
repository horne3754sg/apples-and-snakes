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
				<div class="footer-logo arts-council">
					<img src="<?php echo get_template_directory_uri(); ?>/images/AC_logo_2.png" alt="">
				</div>
				<!--				<div class="description">-->
				<!--					<p>Apples and Snakes is proud to be a National Portfolio Organisation and receive regular funding from Arts Council England.</p>-->
				<!--				</div>-->
			</div>
			<div class="col">
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
				<a class="button" href="/keep-in-touch/">CONTACT</a>
			</div>
			<div class="col">
				<h3>JOIN OUR MAILING LIST</h3>
				<?php dynamic_sidebar('footer-sign-up'); ?>
			</div>
			<div class="col">
				<h3>TWITTER</h3>
				<?php dynamic_sidebar('twitter-feed'); ?>
			</div>
		</div>
	</div>
</div>

<div class="section after-footer quote">
	<div class="container">
		<img src="<?php echo get_template_directory_uri(); ?>/images/no-words-unspoken.png" alt="">
	</div>
</div>

<div class="section after-footer legal">
	<div class="container">
		<span class="copyright">© <?php echo date('Y'); ?> Apples and Snakes All rights reserved</span>
		<span class="spacer">|</span>
		<span><a href="/terms-conditions/">Terms and Conditions</a></span>
		<span class="spacer">|</span>
		<span><a href="/privacy-policy/">Privacy Policy</a></span>
		<span class="charityNo">Charity Number: 294030</span>
		<span class="companyReg">Company registration number: 1994850</span>
	</div>
</div>

</div><!-- #page -->
<div class="slideover">
	<div class="slideover_content">
		<div class="menu_logo">
			<a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><img
						src="<?php echo get_template_directory_uri(); ?>/images/menu-logo.svg" alt=""></a>
			<div class="close">
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 64 64"
				     xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 64 64">
					<g>
						<path fill="#1D1D1B"
						      d="M28.941,31.786L0.613,60.114c-0.787,0.787-0.787,2.062,0,2.849c0.393,0.394,0.909,0.59,1.424,0.59   c0.516,0,1.031-0.196,1.424-0.59l28.541-28.541l28.541,28.541c0.394,0.394,0.909,0.59,1.424,0.59c0.515,0,1.031-0.196,1.424-0.59   c0.787-0.787,0.787-2.062,0-2.849L35.064,31.786L63.41,3.438c0.787-0.787,0.787-2.062,0-2.849c-0.787-0.786-2.062-0.786-2.848,0   L32.003,29.15L3.441,0.59c-0.787-0.786-2.061-0.786-2.848,0c-0.787,0.787-0.787,2.062,0,2.849L28.941,31.786z"></path>
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
			<a class="social_icon" href="https://www.facebook.com/applesandsnakes/" target="_blank" rel="noopener noopener" class="social_icon">
				<img src="<?php echo get_template_directory_uri(); ?>/images/facebook-red.png" alt="">
			</a>
			<a class="social_icon" href="https://twitter.com/applesandsnakes" target="_blank" rel="noopener noopener" class="social_icon">
				<img src="<?php echo get_template_directory_uri(); ?>/images/twitter-red.png" alt="">
			</a>
			<a class="social_icon" href="https://www.instagram.com/applesandsnakes/" target="_blank" rel="noopener noopener" class="social_icon">
				<img src="<?php echo get_template_directory_uri(); ?>/images/instagram-red.png" alt="">
			</a>
			<a class="social_icon" href="https://www.youtube.com/user/applesandsnakes/" target="_blank" rel="noopener noopener" class="social_icon">
				<img src="<?php echo get_template_directory_uri(); ?>/images/You%20tube%20red.png" alt="">
			</a>
		</div>
	</div>
</div>


<?php wp_footer(); ?>

<script type="text/javascript" src="//downloads.mailchimp.com/js/signup-forms/popup/unique-methods/embed.js" data-dojo-config="usePlainJson: true, isDebug: false"></script>
<script type="text/javascript">window.dojoRequire(['mojo/signup-forms/Loader'], function(L) {
		L.start({
			'baseUrl': 'mc.us16.list-manage.com',
			'uuid': '625a4b2bd87829e08f7867ea5',
			'lid': '0aff2faf7f',
			'uniqueMethods': true
		});
	});</script>
</body>
</html>

