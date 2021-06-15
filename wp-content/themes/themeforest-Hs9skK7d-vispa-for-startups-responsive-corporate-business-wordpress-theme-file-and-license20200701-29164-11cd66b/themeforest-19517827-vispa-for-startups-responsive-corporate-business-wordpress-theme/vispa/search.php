<?php
/**
 * The template for displaying search page
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 */
get_header();
vispa_theme_header_image();
$vispa_sidebar_position = function_exists( 'fw_ext_sidebars_get_current_position' ) ? fw_ext_sidebars_get_current_position() : 'right';
?>
<div class="page-wrapper <?php vispa_theme_get_sidebar_class( $vispa_sidebar_position ); ?> <?php echo ( $vispa_sidebar_position == 'left' || $vispa_sidebar_position == 'right' ) ? '' : 'page-narrow' ?>">
	<div class="container">
		<div class="row">
			<!-- Content -->
			<main class="fly-content">
				<!-- PostList -->
				<div class="postlist">
					<?php if ( have_posts() ) : ?>
						<?php
						// Start the Loop.
						while ( have_posts() ) : the_post();
							get_template_part( 'listing', 'blog' );
						endwhile;
					else :
						// If no content, include the "No posts found" template.
						get_template_part( 'content', 'none' );

					endif; ?>
				</div>
				<!--/ PostList -->
				<?php echo vispa_theme_paging_nav(); ?>
			</main>
			<!--/ Content -->
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<?php
get_footer();