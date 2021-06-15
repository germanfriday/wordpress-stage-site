<?php
/**
 * The template file for 404 page not found
 *
 * @package WordPress
 * @subpackage Aiteko
 * @since 1.0
 */

get_header();
?>

	<main id="main" class="site-content">
		
		<div class="aiteko-page--404">
			
			<div class="aiteko-page--404-content">
				<h1 class="aiteko-error-page-heading"><span>4</span><span>0</span><span>4</span></h1>
				<p><?php print esc_html__( 'Oops, looks like you got lost!', 'aiteko' ); ?></p>
				<a class="back-home" href="<?php print esc_url( home_url('/') ); ?>">&larr; <?php print esc_html__( 'Back to home', 'aiteko' ); ?></a>
			</div>
		</div>

	</main>

<?php
get_footer();
