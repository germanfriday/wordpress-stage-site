<?php global $sena_config; ?>
<?php the_post(); ?>

<!-- Intro -->
<section class="intro" id="intro" 
		 data-type="single-image">

	<!-- Content -->
	<div class="container">
		<div class="content">
            <?php the_content( ); ?>
        </div>
	</div>

	<?php if ( $sena_config['home-magic-mouse'] ) { ?>
		<!-- Magic mouse -->
		<div class="mouse">
			<a href="#about"><span class="wheel"></span></a>
		</div>
	<?php } ?>

</section>