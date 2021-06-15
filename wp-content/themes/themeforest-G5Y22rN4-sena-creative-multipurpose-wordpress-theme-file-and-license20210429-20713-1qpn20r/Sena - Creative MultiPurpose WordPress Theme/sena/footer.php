<?php global $sena_config; ?>

		<?php $footer_bgimage = ! empty( $sena_config['footer-bgimage']['url'] ) ? $sena_config['footer-bgimage']['url'] : ''; ?>

		<!-- Footer -->
		<footer data-bg-image="<?php echo esc_url( $footer_bgimage ); ?>">
			
			<!-- Widgets -->
			<div class="footer-widgets">
				<div class="container">
					
					<?php if( is_active_sidebar( 'footer' ) ) { ?>
						<div class="row">
							<?php dynamic_sidebar( 'footer' ); ?>	
						</div>
					<?php } ?>
					
				</div>				
			</div>
			
			<!-- Copyright -->
			<div class="footer-copyright">				
				<div class="container">
					
					<div class="row">						
						<div class="col-md-12">
							
							<div class="footer-copyright-inner">
					
								<div class="row">

									<div class="col-md-6">

										<!-- Text -->
										<p class="copyright">
											<?php echo do_shortcode( wp_kses_post( $sena_config['copyright-text'] ) ); ?>
										</p>

									</div>

									<div class="col-md-6">

										<!-- Social links -->
										<?php echo Sena_Theme::sena_social_icons( 'social-link', 'footer-social text-right', '<a href="%3$s" title="%2$s" target="_blank"><i class="%1$s fa-fw"></i></a>' ); ?>

									</div>

								</div>
					
							</div>
						
						</div>
					</div>	
					
				</div>				
			</div>
			
			<?php if ( $sena_config['footer-button-top'] or $sena_config === null ) : ?>
				<!-- Back to top -->
				<a id="scrollTop">
					<div class="icon icon-arrows-up"></div>
					<div class="icon icon-arrows-up"></div>
				</a>
			<?php endif; ?>
			
		</footer>

		<?php Sena_Theme::sena_inline_scripts( get_the_ID( ) ); ?>

		<?php wp_footer( ); ?>

	</body>
</html>