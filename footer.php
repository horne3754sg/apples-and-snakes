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
						<br />
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
				<div class="col">
					<img src="<?php echo get_template_directory_uri(); ?>/images/support-us.png" alt="">
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

<?php wp_footer(); ?>

</body>
</html>

