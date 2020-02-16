<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Bootstrap_Starter
 */

?>
		<footer class="footer">
			<div class="container">
				<div class="row justify-content-center align-items-end footer__upper">
					<div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 col-12 logo">
						<a href="/">
							<img src="<?= get_template_directory_uri(); ?>/assets/img/logoW.png" alt="Neighbourhood Skateshop logo - NBHD Skate">
						</a>
					</div>
					<div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 col-12 newsletter">
						<span class="text-size-xlarge">
							Zapisz się do newsletter’a
						</span>
						<form class="mt-3" action="">
							<div class="line">
								<input type="email" name="email" placeholder="Twój email ziomuś...">
								<button type="submit" class="btn btn__border desktop">Zapisuj mnie!</button>
							</div>
							<div class="check pretty p-default p-thick p-pulse">
								<input type="checkbox" name="agree"/>
								<div class="state p-warning-o">
									<label><span>Daj znać, że zapoznałeś się z naszym <a href="">REGULAMINEM</a></span></label>
								</div>
							</div>
							<button type="submit" class="btn btn__border mobile">Zapisuj mnie!</button>
						</form>
					</div>
				</div>
				<div class="row justify-content-center footer__mid">
					<div class="col-xl-10 col-12">
						<div class="row justify-content-between">
							<div class="col-sm-4 col-12">
								<span class="text-size-xxlarge">
									Info:
								</span>
								<p>
									NBHD<br>
									Dolna 2A<br/>
									32-540 Trzebinia<br/>
									<br/>
									<a href="tel:+48735970079">+48 735 970 079</a><br/>
									<a href="tel:+48505485958">+48 505 485 958</a><br/>
									<br/>
									<a href="mailto:info@nbhdskate.pl">info@nbhdskate.pl</a>
								</p>
							</div>
							<div class="col-sm-4 col-12">
								<span class="text-size-xxlarge">
									Pomoc:
								</span>
								<?php
									wp_nav_menu(array(
										'theme_location'    => 'footer1',
										'container'       => '',
										'container_id'    => '',
										'container_class' => '',
										'menu_id'         => false,
										'menu_class'      => '',
										'depth'           => 1,
										'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
										'walker'          => new wp_bootstrap_navwalker()
									));
								?>
							</div>
							<div class="col-sm-4 col-12">
								<span class="text-size-xxlarge">
									Mapa strony:
								</span>
								<?php
									wp_nav_menu(array(
										'theme_location'    => 'footer2',
										'container'       => '',
										'container_id'    => '',
										'container_class' => '',
										'menu_id'         => false,
										'menu_class'      => '',
										'depth'           => 1,
										'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
										'walker'          => new wp_bootstrap_navwalker()
									));
								?>
							</div>
						</div>
					</div>
				</div>
				<div class="row justify-content-center footer__lower">
					<div class="col-xl-10 col-12">
						<div class="row justify-content-between align-items-center">
							<div class="col-lg-auto col-md-8 col-12 socials">
								<h3>Social media:</h3>
								<a href="https://www.facebook.com/Neighbourhood-Skateshop-436289680462922/" target="_blank"><i class="fab fa-facebook-f"></i></a>
								<a href="https://www.instagram.com/nbhdskate.pl/" target="_blank"><i class="fab fa-instagram"></i></a>
								<a href="https://www.youtube.com/" target="_blank"><i class="fab fa-youtube"></i></a>
							</div>
							<div class="col-lg-auto col-md-8 col-12 text-right text-bold text-size-small">
								<span>Copyright &copy; <?php echo date('Y'); ?> NBHDSKATE</span>
								<a href="https://www.sative.co.uk" target="_blank" class="madeby">Made with <i class="fas fa-heart"></i> by <span>SATIVE</span></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>
	</div><!-- #wrapper -->
	<!-- Load Facebook SDK for JavaScript -->
	<div id="fb-root"></div>
	<script>
		window.fbAsyncInit = function() {
			FB.init({
				xfbml            : true,
				version          : 'v6.0'
			});
		};
		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = 'https://connect.facebook.net/pl_PL/sdk/xfbml.customerchat.js';
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>

	<!-- Your customer chat code -->
		<div class="fb-customerchat"
		attribution=setup_tool
		page_id="436289680462922"
		theme_color="#F5A623"
		logged_in_greeting="Siemanko! Potrzebujesz pomocy Ziomuś? Pisz co jest grane..."
		logged_out_greeting="Siemanko! Potrzebujesz pomocy Ziomuś? Pisz co jest grane...">
	</div>
	<?php wp_footer(); ?>
</body>
</html>