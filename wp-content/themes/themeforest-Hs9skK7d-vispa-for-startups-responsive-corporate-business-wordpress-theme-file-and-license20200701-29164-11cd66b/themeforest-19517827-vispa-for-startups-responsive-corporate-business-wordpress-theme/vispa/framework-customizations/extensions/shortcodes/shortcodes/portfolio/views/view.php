<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$taxonomy = 'fw-portfolio-category';
$term     = get_term( $atts['category'], $taxonomy );
$cat_id   = $atts['category'];
if ( ! empty( $term ) && !is_wp_error($term) ) {
	if ( $term->parent == 0 ) {
		$cat_id = $atts['category'];
	} else {
		$cat_id = $term->parent;
	}
}

$the_query = new WP_Query( array(
	'posts_per_page' => $atts['posts_per_page'],
	'post_type'      => 'fw-portfolio',
	'tax_query'      => array(
		array(
			'taxonomy' => $taxonomy,
			'field'    => 'id',
			'terms'    => array( $cat_id ),
		),
	),
) );

$ext_portfolio_instance = fw()->extensions->get( 'portfolio' );
$ext_portfolio_settings = $ext_portfolio_instance->get_settings();

if( $atts['columns'] == '3' ) {
	$portfolio_class = 'col-lg-4 col-md-6 col-sm-6 portfolio-item grid-sizer';
}
else {
	$portfolio_class = 'col-sm-6 portfolio-item';
}

if( $atts['spaces'] == 'no' ) {
	$atts['class'] .= ' section-our-projects-fluid';
}

vispa_theme_portfolio_filter( $atts['filter'], false, $atts['category'] );
?>
<!-- Portfolio Items -->
<div class="section-our-projects portfolio-shortcode <?php echo esc_attr( $atts['class'] ); ?>">
	<div class="row portfolio-items">
		<?php if ( $the_query->have_posts() ) :
			while ( $the_query->have_posts() ) : $the_query->the_post();
				global $post;
				$permalink = get_permalink();

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

				$vispa_data_category = 'data-category="' . vispa_theme_portfolio_post_taxonomies( $post->ID, true ) . '"';
				?>
				<div class="<?php echo $portfolio_class; ?>" <?php echo $vispa_data_category; ?>>
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
			<?php endwhile; ?>
		<?php else :
			// If no content, include the "No posts found" template.
			get_template_part( 'content', 'none' );
		endif;
		wp_reset_postdata(); ?>
	</div>
</div>
<!--/ Portfolio Items -->