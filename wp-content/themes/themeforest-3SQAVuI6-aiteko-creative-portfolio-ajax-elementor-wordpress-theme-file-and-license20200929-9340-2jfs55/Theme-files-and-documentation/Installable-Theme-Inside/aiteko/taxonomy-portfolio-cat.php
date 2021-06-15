<?php
/**
 * The template for displaying portfolio category archive
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

		print '<h1><span class="shadowed">' . esc_html__( 'Portfolio category', 'aiteko' ) . '</span>' . single_term_title( "", false ) . '</h1>';

	print '</header>' . "\n";

	if ( have_posts() ) :

		print '<div class="portfolio-loop-contain">' . "\n";
		do_action( 'aiteko_before_portfolio_loop' );

		$i = 0;
		while( have_posts() ) :
			the_post();

			$i++;

			get_template_part( 'template-parts/portfolio/loop', aiteko_get_portfolio_loop_style() );

			if ( 'grid' === aiteko_get_portfolio_loop_style() && ( $i < 2 || $i === 2 ) ) {
				$more_class = ( $i === 2 ) ? ' wide' : '';
				print '<div class="portfolio-grids-spacer portfolio-grid' . $more_class . '"></div>';
			}

		endwhile;

		unset($i);
		do_action( 'aiteko_after_portfolio_loop' );

		the_posts_pagination( array(
			'prev_text' => '<span class="screen-reader-text">' . esc_html__( 'Previous page', 'aiteko' ) . '</span>',
			'next_text' => '<span class="screen-reader-text">' . esc_html__( 'Next page', 'aiteko' ) . '</span>',
			'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'aiteko' ) . ' </span>',
		) );

		print '</div>' . "\n";

		wp_reset_postdata();

	else :

		get_template_part( 'template-parts/content', 'none' );

	endif;
	?>

	</main>

<?php
get_footer();
