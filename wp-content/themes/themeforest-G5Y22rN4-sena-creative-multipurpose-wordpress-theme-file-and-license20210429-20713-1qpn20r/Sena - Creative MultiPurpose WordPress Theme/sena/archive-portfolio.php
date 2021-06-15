<?php get_header( ); ?>

<!-- Primary header -->
<section class="page-title valign parallax" 
		 data-image="<?php echo ( ! empty( $sena_config['header-bgimage']['url'] ) ? esc_url( $sena_config['header-bgimage']['url'] ) : '' ); ?>"
>
	
	<?php if ( ! empty( $sena_config['header-bgimage']['url'] ) ) { ?>
		<div class="parallax-overlay colored"></div>
	<?php } ?>
	
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 col-xs-12 text-center">
			
				<h1 id="blog-title"><?php Sena_Theme::sena_page_title( ); ?></h1>
				<p class="blog-info info breadcrumbs"><?php sena_breadcrumbs( ); ?></p>	
	
			</div>
		</div>
	</div>
	
</section>

<?php if ( class_exists( 'Sena_Shortcode_Portfolio' ) ) : ?>
	<!-- Portfolio -->
	<section id="portfolio" class="portfolio bg-grey">

		<!-- Container -->
		<div class="container">

			<div class="row">
				<div class="col-md-8 col-md-offset-2 col-xs-12">

					<!-- Section title -->
					<div class="section-title text-center">
						<h2>
							<?php esc_html_e( 'Favorite Projects', 'sena' ); ?>
						</h2>
					</div>

				</div>
			</div>
			
			<?php echo Sena_Shortcode_Portfolio::portfolio( array( ) ); ?>
			
		</div>
		
	</section>
	
	<!-- Portfolio details (AJAX) -->
	<section id="portfolio-details"></section>
<?php else : ?>
	<section>
		<div class="container">
			<?php get_template_part( 'templates/no-content' ); ?>				
		</div>
	</section>
<?php endif; ?>

<?php get_footer( ); ?>