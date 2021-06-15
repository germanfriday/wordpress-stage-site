<?php
/**
 * The template for displaying 404 page
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
					<h2><?php esc_html_e( 'Page Not Found', 'vispa' ); ?></h2>

					<p><?php esc_html_e( 'Sorry, we can\'t find the page You are looking for. Please, try a search or go to', 'vispa' ); ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'homepage', 'vispa' ); ?></a>
					</p>

					<!-- Widget Search -->
					<div class="widget-search">
						<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" class="form-search">
							<input type="search" name="s" class="form-control" placeholder="<?php esc_html_e( 'search an existing page', 'vispa' ); ?>"/>
							<button type="submit" name="" class="submit fa fa-search"></button>
						</form>
					</div>
					<!--/ Widget Search -->
			</main>
			<!--/ Content -->
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<?php
get_footer();