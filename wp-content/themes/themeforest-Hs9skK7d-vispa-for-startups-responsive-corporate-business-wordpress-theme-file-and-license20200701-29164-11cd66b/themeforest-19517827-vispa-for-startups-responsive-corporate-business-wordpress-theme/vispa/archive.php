<?php
/**
 * The template for displaying Archive pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 */
get_header();
vispa_theme_header_image();
$vispa_sidebar_position = function_exists( 'fw_ext_sidebars_get_current_position' ) ? fw_ext_sidebars_get_current_position() : 'right';
$vispa_posts_view_type  = function_exists('fw_get_db_settings_option') ? fw_get_db_settings_option('posts_view_type') : '';
if( $vispa_posts_view_type == 'grid-1' ) {
	$vispa_template_part  = 'grid-1';
	$vispa_section_class  = '';
	$vispa_postlist_class = 'postlist-masonry';
	$vispa_postlist_class .= ( $vispa_sidebar_position == 'right' || $vispa_sidebar_position == 'left' ) ? ' postlist-double' : ' postlist-triple';

}
elseif( $vispa_posts_view_type == 'grid-2' ) {
	$vispa_template_part  = 'grid-2';
	$vispa_section_class  = '';
	$vispa_postlist_class = 'postlist-masonry';
	$vispa_postlist_class .= ( $vispa_sidebar_position == 'right' || $vispa_sidebar_position == 'left' ) ? ' postlist-double' : ' postlist-triple';
}
else {
	$vispa_template_part  = 'listing-blog';
	$vispa_section_class  = 'section-blog-horizontal';
	$vispa_postlist_class = 'postlist-alternate';
}
?>
<div class="section page-wrapper <?php echo $vispa_section_class; ?> <?php vispa_theme_get_sidebar_class( $vispa_sidebar_position ); ?>">
	<div class="container">
		<div class="row">
			<!-- Content -->
			<main class="fly-content">
				<!-- PostList -->
				<div class="<?php echo $vispa_postlist_class; ?>">
					<?php if ( have_posts() ) : ?>
						<?php
						// Start the Loop.
						while ( have_posts() ) : the_post();
							get_template_part( $vispa_template_part );
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