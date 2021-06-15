<?php
get_header();

global $wp_query;
$vispa_ext_portfolio_instance = fw()->extensions->get( 'portfolio' );
$vispa_ext_portfolio_settings = $vispa_ext_portfolio_instance->get_settings();

$vispa_filter_enabled = fw_get_db_settings_option( 'filter', 'yes' );
$vispa_spaces         = fw_get_db_settings_option( 'spaces', 'yes' );
$vispa_columns        = fw_get_db_settings_option( 'columns', 'yes' );

if( $vispa_columns == '3' ) {
	$portfolio_class = 'col-lg-4 col-md-6 col-sm-6 portfolio-item grid-sizer';
}
else {
	$portfolio_class = 'col-sm-6 portfolio-item';
}

$vispa_taxonomy   = $vispa_ext_portfolio_settings['taxonomy_name'];
$vispa_term       = get_term_by( 'slug', get_query_var( 'term' ), $vispa_taxonomy );
$vispa_term_id    = ( ! empty( $vispa_term->term_id ) ) ? $vispa_term->term_id : 0;
$vispa_categories = fw_ext_portfolio_get_listing_categories( $vispa_term_id, $vispa_taxonomy );
$vispa_loop_data  = array(
	'settings'        => $vispa_ext_portfolio_settings,
	'categories'      => $vispa_categories,
	'portfolio_class' => $portfolio_class,
	'listing_classes' => 'fw-portfolio-item',
);
set_query_var( 'fw_portfolio_loop_data', $vispa_loop_data );

$class = '';
if( $vispa_spaces == 'no' ) {
	$class = 'section-our-projects-fluid';
}

vispa_theme_header_image();
?>
<div class="section section-our-projects <?php echo esc_attr($class); ?>">
	<div class="container">
		<div class="row portfolio-items">
			<!-- Content -->
			<main class="fly-content">
				<?php vispa_theme_portfolio_filter( $vispa_filter_enabled, true ); ?>
				<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post();
						get_template_part( 'framework-customizations/extensions' . $vispa_ext_portfolio_instance->get_rel_path() . '/views/loop', 'projects' );
					endwhile; ?>
				<?php else :
					// If no content, include the "No posts found" template.
					get_template_part( 'content', 'none' );
				endif; ?>
				<?php echo vispa_theme_paging_nav(); ?>
			</main><!--/ content -->
		</div><!--/ row -->
	</div><!--/ container -->
</div><!--/ section -->
<?php
// free memory
unset( $vispa_ext_portfolio_instance );
unset( $vispa_ext_portfolio_settings );
set_query_var( 'fw_portfolio_loop_data', '' );
get_footer();