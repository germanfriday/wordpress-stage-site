<?php
/**
 * The template for displaying the footer
 *
 * @package WordPress
 * @subpackage Aiteko
 * @since 1.0
 */

?>

		<footer id="aiteko-site-footer" class="aiteko-site-footer">

			<div class="site-footer__wrap">

				<?php aiteko_footer_widgets(); ?>

				<div class="site-footer__last-bar">
					<div class="aiteko--copyright-text">
						<?php print aiteko_print_copyright_text(); ?>
					</div>

					<?php get_template_part( 'template-parts/footer', 'nav' ); ?>
				</div>

			</div>

		</footer>

		</div><!-- .aiteko-content-container -->

	</div><!-- .aiteko-main -->

</div><!-- #aiteko-master -->

<?php wp_footer(); ?>

</body>

</html>
