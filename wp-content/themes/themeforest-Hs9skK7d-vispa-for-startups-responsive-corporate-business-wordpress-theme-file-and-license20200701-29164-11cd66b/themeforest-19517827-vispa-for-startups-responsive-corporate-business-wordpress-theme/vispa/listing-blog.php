<?php
/**
 * The template for displaying sticky posts in the Image post format
 */

global $post;
if( !isset( $extra_options ) ) $extra_options = array();
$vispa_permalink = get_permalink();
$columns_class   = '';

$vispa_post_view_type = ( defined( 'FW' ) ) ? fw_get_db_post_option( $post->ID, 'post_type' ) : '';
if( !empty($extra_options) ) {
	$vispa_post_categories = $extra_options['enable_post_categories'];
}
else {
	$vispa_post_categories = ( defined( 'FW' ) ) ? fw_get_db_settings_option( 'enable-post-categories' ) : 'yes';
}

$image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ), 'post-thumbnails' );
?>
<!-- Post -->
<article id="post-<?php the_ID(); ?>" <?php post_class( 'article card card-plain card-blog clearfix' ); ?>>
	<?php if( !empty($vispa_post_view_type) || !empty($image) ) : ?>
		<div class="column-image">
			<div class="header">
				<?php if ( ! empty( $vispa_post_view_type ) ) :
					vispa_theme_get_post_view_type( $vispa_post_view_type, $post->ID );
				else :
					vispa_theme_show_default_post_image( $image, $post->ID );
				endif; ?>
			</div>
		</div>
	<?php else :
		$columns_class = 'full-post-column';
	endif; ?>

	<div class="column-content <?php echo $columns_class; ?>">
		<div class="content">
			<?php if( $vispa_post_categories == 'yes' ) : ?>
				<h5 class="card-category"><?php vispa_theme_get_one_post_category($post->ID); ?></h5>
			<?php endif; ?>
			<a href="<?php echo esc_url( $vispa_permalink ); ?>" class="card-title">
				<h2><?php the_title(); ?></h2>
			</a>

			<div class="text-gray">
				<?php if ( get_post_format() == '' ) {
					the_excerpt();
				} else {
					the_content();
				} ?>
			</div>

			<a href="<?php echo esc_url( $vispa_permalink ); ?>" class="btn btn-danger btn-fill"><?php esc_html_e( 'Read More', 'vispa' ); ?></a>
		</div>
	</div>
</article>
<!--/ Post -->