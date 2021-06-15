<?php
$page_template = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_template');
$page_introduction = get_post_meta( get_the_ID(), 'theme_meta_page_introduction', true );
$category = airtheme_get_post_meta( get_the_ID(), 'theme_meta_page_category' );
$page_show_filter = airtheme_get_post_meta( get_the_ID(), 'theme_meta_page_show_filter' );

if ( $page_template == 'intro-r-filter' || $page_template == 'intro-in-list' ) {
	$page_show_filter = airtheme_get_post_meta( get_the_ID(), 'theme_meta_page_show_2_filter' );
}

if ( is_array( $category ) ) {
	$category = $category[0];
}

$get_category = get_category( $category );
$get_categories = get_categories( array(
	'parent' => $category
) );

if ( $page_introduction ) {
	echo '<div class="intro-wrap-sub active" id="intro-wrap-sub-default">';
	echo balanceTags( wp_kses( do_shortcode( wpautop( $page_introduction ) ), airtheme_shapeSpace_allowed_html() ),false );
	echo '</div>';
	if ( $get_categories ) {
		foreach ( $get_categories as $num => $category ) {
			printf('<div class="intro-wrap-sub" id="intro-wrap-sub_%1$s">%2$s</div>',
			esc_attr( $category->slug ),
			wp_kses( category_description( $category->term_id ), airtheme_shapeSpace_allowed_html() )
			);
		}
	}
}
?>