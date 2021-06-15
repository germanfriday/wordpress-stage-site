<?php
/**
 * The template for displaying all pages
 *
 * @package WordPress
 * @subpackage Aiteko
 * @since 1.0
 */

get_header();
?>

	<main id="main" class="site-content">
		
	<?php

		do_action( 'aiteko_before_page_content' );

		while( have_posts() ) :
			the_post();

	?>

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'aiteko-single-post' ); ?>>
		<?php if ( ! is_front_page() && ( 'yes' !== get_post_meta( get_the_id(), 'aiteko_hide_title', true ) ) ) : ?>
			<header class="entry-page-header">
				<h1 class="entry-page-title" <?php if ( has_post_thumbnail() ) { print 'style="color: #ffffff;"'; } ?>><?php the_title(); ?></h1>
				<?php get_single_page_featured_image( get_the_ID() ); ?>
				<div class="scroll-notice" <?php if ( has_post_thumbnail() ) { print 'style="color: #ffffff;"'; } ?>>
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
						<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
							<g fill="currentColor">
								<path d="M40,41.0074017 L40,41.0074017 L40,58.9925983 C40,64.5218355 44.4762336,69 50,69 C55.5234877,69 60,64.5203508 60,58.9925983 L60,41.0074017 C60,35.4781645 55.5237664,31 50,31 C44.4765123,31 40,35.4796492 40,41.0074017 L40,41.0074017 Z M38,41.0074017 C38,34.3758969 43.3711258,29 50,29 C56.627417,29 62,34.3726755 62,41.0074017 L62,58.9925983 C62,65.6241031 56.6288742,71 50,71 C43.372583,71 38,65.6273245 38,58.9925983 L38,41.0074017 L38,41.0074017 Z"/>
								<path d="M49,36 L49,40 C49,40.5522847 49.4477153,41 50,41 C50.5522847,41 51,40.5522847 51,40 L51,36 C51,35.4477153 50.5522847,35 50,35 C49.4477153,35 49,35.4477153 49,36 L49,36 Z"/>
							</g>
						</g>
					</svg>
				</div>
			</header>
		<?php endif; ?>
		
			<div class="aiteko-the-content">
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

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}

		endwhile;

		do_action( 'aiteko_after_page_content' );

	?>

	</main>

<?php
get_footer();
