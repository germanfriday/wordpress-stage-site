<?php
/**
 * Single post layout - fullwidth
 *
 * @package Aiteko
 * @since 1.0
 */

?>

	<main id="main" class="site-content">
		
	<?php
		do_action( 'aiteko_before_single_post' );

		while( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/single/content', 'single' );

		endwhile;

		do_action( 'aiteko_after_single_post' );
	?>

	</main>
