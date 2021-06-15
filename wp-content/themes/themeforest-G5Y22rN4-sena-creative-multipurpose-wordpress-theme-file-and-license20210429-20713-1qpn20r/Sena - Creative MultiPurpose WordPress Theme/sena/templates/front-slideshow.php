<?php global $sena_config; ?>
<?php the_post(); ?>

<!-- Intro -->
<section class="intro" id="intro" 
		 data-type="slideshow" 
		 data-animation="fadeInUp">

	<div class="container-fluid">
		<div class="row">

			<!-- Slideshow -->
            <?php the_content( ); ?>
            
			<!-- Intro navigation -->
			<div class="intro-nav">
				<div class="container">
					<div class="wrapper">
						<div class="owl-arrows"></div>
						<div class="owl-dots"></div>
					</div>
				</div>
			</div>

		</div>
	</div>

	<?php if ( $sena_config['home-magic-mouse'] ) { ?>
		<!-- Magic mouse -->
		<div class="mouse">
			<a href="<?php echo esc_url( $sena_config['home-magic-mouse-url'] ); ?>"><span class="wheel"></span></a>
		</div>
	<?php } ?>

</section>
