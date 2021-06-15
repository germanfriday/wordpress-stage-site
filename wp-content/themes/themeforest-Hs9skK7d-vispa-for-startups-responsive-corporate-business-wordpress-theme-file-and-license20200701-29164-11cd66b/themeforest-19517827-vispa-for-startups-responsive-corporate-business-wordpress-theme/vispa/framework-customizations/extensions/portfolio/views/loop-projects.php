<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

global $post;
$vispa_loop_data    = get_query_var( 'fw_portfolio_loop_data' );
$vispa_thumbnail_id = get_post_thumbnail_id();

if ( ! empty( $vispa_thumbnail_id ) ) {
	$vispa_featured_image  = wp_get_attachment_image_src( $vispa_thumbnail_id, 'full' );
	$vispa_thumbnail       = get_post( $vispa_thumbnail_id );
	$vispa_image           = $vispa_featured_image[0];
	$vispa_thumbnail_title = $vispa_thumbnail->post_title;
} else {
	$vispa_image           = fw()->extensions->get( 'portfolio' )->locate_URI( '/static/img/no-photo.jpg' );
	$vispa_thumbnail_title = get_the_title();
}

$vispa_data_category = ( is_tax() ) ? '' : 'data-category="' . vispa_theme_portfolio_post_taxonomies( $post->ID, true ) . '"';
?>
<div class="col-sm-6 portfolio-item <?php echo esc_attr($vispa_loop_data['portfolio_class']); ?>" <?php echo ($vispa_data_category); ?>>
	<div class="project">
		<img src="<?php echo esc_url( $vispa_image ); ?>" alt="<?php echo esc_attr( $vispa_thumbnail_title ); ?>"/>
		<a class="over-area" href="<?php echo esc_url( get_permalink() ); ?>">
			<div class="content">
				<?php vispa_theme_portfolio_post_terms($post->ID); ?>

				<h3><?php the_title(); ?></h3>
				<?php the_excerpt(); ?>
			</div>
		</a>
	</div>
</div>