<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content.
 */
?>
<!-- Footer -->
<footer class="footer footer-big footer-color-black" data-color="black" itemprop="WPFooter">
	<div class="container">
		<?php if ( defined( 'FW' ) ) : ?>
			<?php
			$widgets = fw_get_db_settings_option( 'enable_footer_widgets/selected', 'no' );
			$socials = fw_get_db_settings_option( 'enable_footer_widgets/yes/enable_footer_socials', 'no' );
			?>
			<?php if ( $widgets == 'yes' || $socials == 'yes' ) : ?>
				<div class="row">
					<?php if ( $widgets == 'yes' ) : ?>
						<?php if ( is_dynamic_sidebar( 'footer-1' ) ): ?>
							<div class="col-md-2 col-sm-3">
								<?php dynamic_sidebar( 'footer-1' ); ?>
							</div>
						<?php endif; ?>
						<?php if ( is_dynamic_sidebar( 'footer-2' ) ): ?>
							<div class="col-md-3 col-md-offset-1 col-sm-3">
								<?php dynamic_sidebar( 'footer-2' ); ?>
							</div>
						<?php endif; ?>
						<?php if ( is_dynamic_sidebar( 'footer-3' ) ): ?>
							<div class="col-md-3 col-sm-3">
								<?php dynamic_sidebar( 'footer-3' ); ?>
							</div>
						<?php endif; ?>
					<?php endif; ?>

					<?php if ( $socials == 'yes' ): ?>
						<?php $socials_icons = fw_get_db_settings_option( 'socials' ); ?>
						<?php if ( ! empty( $socials_icons ) ) : ?>
							<!-- Social Links -->
							<div class="col-md-2 col-md-offset-1 col-sm-3">
								<div class="info">
									<h5 class="title"><?php esc_html_e('Follow us on', 'vispa'); ?></h5>
									<nav>
										<ul class="footer-social">
											<?php foreach ( $socials_icons as $social ) : ?>
												<li>
													<a class="btn btn-social btn-simple" href="<?php echo esc_url( $social['social-link'] ); ?>" target="_blank"><i class="<?php echo esc_attr($social['social_icon']); ?>"></i> <?php echo esc_html( $social['social_name'] ); ?></a>
												</li>
											<?php endforeach; ?>
										</ul>
									</nav>
								</div><!--/ info -->
							</div><!--/ Social Links -->
						<?php endif; ?>
					<?php endif; ?>
				</div>
				<hr>
			<?php endif; ?>
		<?php endif; ?>

		<div class="copyright">
			<?php echo defined( 'FW' ) ? do_shortcode( vispa_theme_translate( fw_get_db_settings_option( 'copyright' ) ) ) : ''; ?>
		</div><!--/ copyright -->
	</div><!--/ container -->
</footer>
<!--/ Footer -->
<?php wp_footer(); ?>
</body>
</html>