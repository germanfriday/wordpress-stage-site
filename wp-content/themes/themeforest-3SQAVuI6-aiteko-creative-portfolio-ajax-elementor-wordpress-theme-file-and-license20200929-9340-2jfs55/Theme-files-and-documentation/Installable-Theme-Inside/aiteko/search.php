<?php
/**
 * The template file to display the search results
 *
 * @package WordPress
 * @subpackage Aiteko
 * @since 1.0
 */

get_header();
?>

	<main id="main" class="site-content">
		
	<?php
	print '<header id="archive-title">' . "\n";

		print '<h1><span class="shadowed">' . esc_html__( 'Search results', 'aiteko' ) . '</span>' . get_search_query() . '</h1>';

	print '</header>' . "\n";

	if ( have_posts() ) :

		do_action( 'aiteko_before_search_loop' );

		while( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/search', 'loop' );

		endwhile;

		the_posts_pagination( array(
			'prev_text' => '<span class="screen-reader-text">' . esc_html__( 'Previous page', 'aiteko' ) . '</span>',
			'next_text' => '<span class="screen-reader-text">' . esc_html__( 'Next page', 'aiteko' ) . '</span>',
			'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'aiteko' ) . ' </span>',
		) );

		do_action( 'aiteko_after_search_loop' );

		wp_reset_postdata();

	else :

		get_template_part( 'template-parts/content', 'none' );

	endif;
	?>

	</main>

<?php
get_footer();
