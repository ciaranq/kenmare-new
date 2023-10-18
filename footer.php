	<footer class="page-footer">

		<section class="footer-panel footer-panel-upper">
			<div class="footer-panel-content">

				<div class="footer-text">
					<?php
					if (function_exists('dynamic_sidebar')) {
							if (is_active_sidebar('footer-text')) {
									dynamic_sidebar('footer-text');
							}
					}
					?>
				</div>

				<div class="footer-nav">

					<h6><?php echo esc_html_e( 'EXPLORE', 'kenmare_td' ); ?></h6>
					<?php
                    if (has_nav_menu('footer_navigation')) {
                        wp_nav_menu(array(
                            'menu_class' => 'footer-nav-menu',
                            'container' => '',
                            'theme_location' => 'footer_navigation'
                        ));
                    }
										?>
				</div>
				<div class="footer-contact">
					<?php
					if (function_exists('dynamic_sidebar')) {
							if (is_active_sidebar('footer-contact-details')) {
									dynamic_sidebar('footer-contact-details');
							}
					}
					?>
				</div>
				<div class="footer-social">

					<?php
                    $sm_text = get_theme_mod('nw_footer_social_media_text');
                    $newsletter_text = get_theme_mod('nw_footer_newsletter_text');
                    ?>
					<?php echo $sm_text?>
					<?php get_template_part('template-parts/sm-links'); ?>
				</div>
			</div>
			
			<?php
			if (has_nav_menu('footer_links')) {
				wp_nav_menu(array(
					'menu_class' => 'footer-lower-menu',
					'container' => '',
					'theme_location' => 'footer_links',
				));
			}
			?>
		</section>

	</footer>

	</div>

	<?php
wp_footer();
?>


	</body>

	</html>
