<?php
/**
 * The main template file
 *
 * @package WordPress
 * @subpackage Aiteko
 * @since 1.0
 */

get_header();
?>

	<main id="main" class="site-content">
		
	<?php
	if ( have_posts() ) :

		do_action( 'aiteko_before_post_loop' );

		$i = 0;
		while( have_posts() ) :
			the_post();

			$i++;

			get_template_part( 'template-parts/content', 'loop' );

			if ( $i < 2 || $i === 2 ) {
				$more_class = ( $i === 2 ) ? ' wide' : '';
				print '<div class="post-grids-spacer post-grid' . $more_class . '"></div>';
			}

		endwhile;

		do_action( 'aiteko_after_post_loop' );

		the_posts_pagination( array(
			'prev_text' => '<span class="screen-reader-text">' . esc_html__( 'Previous page', 'aiteko' ) . '</span>',
			'next_text' => '<span class="screen-reader-text">' . esc_html__( 'Next page', 'aiteko' ) . '</span>',
			'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'aiteko' ) . ' </span>',
		) );

		wp_reset_postdata();

	else :

		get_template_part( 'template-parts/content', 'none' );

	endif;
	?>

	</main>

<?php
get_footer();
