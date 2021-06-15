<?php
/**
 * The template for displaying sticky posts in the Image post format
 */

global $post;
$vispa_permalink = get_permalink();

$vispa_post_view_type = ( defined( 'FW' ) ) ? fw_get_db_post_option( $post->ID, 'post_type' ) : '';
if( !empty($extra_options) ) {
	$vispa_post_categories = $extra_options['enable_post_categories'];
	$vispa_post_date       = $extra_options['enable_post_date'];
}
else {
	$vispa_post_categories = ( defined( 'FW' ) ) ? fw_get_db_settings_option( 'enable-post-categories' ) : 'yes';
	$vispa_post_date       = ( defined( 'FW' ) ) ? fw_get_db_settings_option( 'enable-post-date' ) : 'yes';
}
?>
<!-- Post -->
<article id="post-<?php the_ID(); ?>" <?php post_class( 'article card card-blog card-plain' ); ?>>
	<div class="header">
		<?php if ( ! empty( $vispa_post_view_type ) ) :
			vispa_theme_get_post_view_type( $vispa_post_view_type, $post->ID );
		else :
			$image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ), 'post-thumbnails' );
			vispa_theme_show_default_post_image( $image, $post->ID );
		endif; ?>
	</div>
	<div class="content">
		<?php if( $vispa_post_date == 'yes' ) : ?>
			<h6 class="card-date"><?php echo get_the_date( "M d", $post->ID ); ?></h6>
		<?php endif; ?>
		<a href="<?php echo esc_url( $vispa_permalink ); ?>" class="card-title">
			<h3><?php the_title(); ?></h3>
		</a>
		<?php if( $vispa_post_categories == 'yes' ) : ?>
			<div class="line-divider line-danger"></div>
			<h6 class="card-category"><?php vispa_theme_get_one_post_category($post->ID); ?></h6>
		<?php endif; ?>
	</div>
</article>
<!--/ Post -->