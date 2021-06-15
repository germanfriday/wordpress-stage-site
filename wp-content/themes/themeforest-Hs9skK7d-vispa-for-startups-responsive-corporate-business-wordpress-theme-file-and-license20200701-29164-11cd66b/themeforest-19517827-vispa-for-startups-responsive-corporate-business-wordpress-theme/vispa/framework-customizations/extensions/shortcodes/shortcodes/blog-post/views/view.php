<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

if ( empty( $atts['category'] ) ) {
	return;
}

$posts_per_page = $atts['posts_per_page'];

$the_query = new WP_Query( array(
	'posts_per_page' => $posts_per_page,
	'post_type'      => 'post',
	'tax_query'      => array(
		array(
			'taxonomy' => 'category',
			'field'    => 'id',
			'terms'    => $atts['category'],
		),
	),
) );

$vispa_sidebar_position = '';
// posts display type
$vispa_posts_view_type = $atts['posts_view_type'];
if ( $vispa_posts_view_type == 'grid-1' ) {
	$vispa_template_part  = 'grid-1';
	$vispa_section_class  = '';
	$vispa_postlist_class = 'postlist-masonry';
	$vispa_postlist_class .= ( $vispa_sidebar_position == 'right' || $vispa_sidebar_position == 'left' ) ? ' postlist-double' : ' postlist-triple';

} elseif ( $vispa_posts_view_type == 'grid-2' ) {
	$vispa_template_part  = 'grid-2';
	$vispa_section_class  = '';
	$vispa_postlist_class = 'postlist-masonry';
	$vispa_postlist_class .= ( $vispa_sidebar_position == 'right' || $vispa_sidebar_position == 'left' ) ? ' postlist-double' : ' postlist-triple';
} else {
	$vispa_template_part  = 'listing-blog';
	$vispa_section_class  = 'section-blog-horizontal';
	$vispa_postlist_class = 'postlist-alternate';
}

$extra_options = array();
$extra_options['extra_options']['enable_post_date']       = $atts['enable_post_date'];
$extra_options['extra_options']['enable_post_categories'] = $atts['enable_post_categories'];
?>
<!-- PostList -->
<div class="fly-latest-posts-shortcode <?php echo esc_attr( $vispa_postlist_class ); ?> <?php echo esc_attr( $atts['class'] ); ?>">
	<?php if ( $the_query->have_posts() ) :
		while ( $the_query->have_posts() ) : $the_query->the_post();
			global $post; ?>
			<!-- Post -->
			<?php echo fw_render_view( get_template_directory().'/'.$vispa_template_part.'.php', $extra_options ); ?>
			<!--/ Post -->
		<?php endwhile; ?>
	<?php else :
		// If no content, include the "No posts found" template.
		get_template_part( 'content', 'none' );
	endif;
	wp_reset_postdata(); ?>
</div>
<!--/ PostList -->