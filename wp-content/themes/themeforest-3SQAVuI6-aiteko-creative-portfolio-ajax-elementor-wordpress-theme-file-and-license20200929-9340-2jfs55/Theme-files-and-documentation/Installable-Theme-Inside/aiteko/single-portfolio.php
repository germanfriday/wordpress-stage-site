<?php
/**
 * The template for displaying portfolio single page
 *
 * @package WordPress
 * @subpackage Aiteko
 * @since 1.0
 */

get_header();
?>

	<main id="main" class="site-content">
		
	<?php

		do_action( 'aiteko_before_portfolio_content' );

		while( have_posts() ) :
			the_post();

	?>

		<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'aiteko-single-post', 'aiteko-portfolio-single' ) ); ?>>

			<header class="entry-portfolio-header">
				<?php the_title( '<h1 class="entry-portfolio-title">', '<span class="p__tt_splash_o"></span><span class="p__tt_splash_i"></span></h1>' ); ?>
				<?php
					if ( $year_info = get_portfolio_year_info() ) {
						print '<br/><span class="year-info">' . $year_info . '<span class="p__y_splash_o"></span><span class="p__y_splash_i"></span></span>';
					}
				?>
			</header>

			<div class="aiteko-the-content">
				<?php
					if ( has_post_thumbnail() ) {
					?>
					<div class="portfolio-entry-image jarallax alignfull">
						<?php print get_the_post_thumbnail( $post, 'full', array( 'class' => 'jarallax-img' ) ); ?>
					</div>
					<?php
					}
				?>
				<?php
					the_content();

					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="screen-reader-text">' . esc_html__( 'Pages:', 'aiteko' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span class="page-number">',
						'link_after'  => '</span>',
					) );
				?>
			</div>

		</article>

	<?php

		the_post_navigation( array(
			'prev_text' => '<span class="screen-reader-text">' . esc_html__( 'Previous Post', 'aiteko' ) . '</span><span aria-hidden="true" class="nav-subtitle"><em>' . esc_html__( 'Previous', 'aiteko' ) . '</em></span> <span class="nav-title">%title</span>',
			'next_text' => '<span class="screen-reader-text">' . esc_html__( 'Next Post', 'aiteko' ) . '</span><span aria-hidden="true" class="nav-subtitle"><em>' . esc_html__( 'Next', 'aiteko' ) . '</em></span> <span class="nav-title">%title</span>',
		) );
		
		endwhile;

		do_action( 'aiteko_after_portfolio_content' );

	?>

	</main>

<?php
get_footer();
