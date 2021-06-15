<?php
/**
 * The Template for displaying all single posts
 */

get_header();
vispa_theme_header_image();
$vispa_sidebar_position = function_exists( 'fw_ext_sidebars_get_current_position' ) ? fw_ext_sidebars_get_current_position() : 'right';
?>
<div class="page-wrapper <?php vispa_theme_get_sidebar_class( $vispa_sidebar_position ); ?>">
	<div class="container">
		<div class="row">
			<!-- Content -->
			<main class="fly-content">
				<?php vispa_theme_single_post_title(); ?>
				<?php while ( have_posts() ) : the_post();
					get_template_part( 'content', 'single' );

					// If comments are open, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				endwhile; ?>
			</main>
			<!--/ Content -->
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<?php get_footer();