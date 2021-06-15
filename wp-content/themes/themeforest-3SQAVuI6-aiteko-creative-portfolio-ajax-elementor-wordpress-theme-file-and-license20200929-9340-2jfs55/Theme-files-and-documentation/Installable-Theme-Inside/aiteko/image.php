<?php
/**
 * The template for displaying attachment page
 *
 * @package WordPress
 * @subpackage Aiteko
 * @since 1.0
 */

get_header();
?>

	<main id="main" class="site-content">
		
	<?php
		do_action( 'aiteko_before_single_post' );

		while( have_posts() ) :
			the_post();

	?>

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'aiteko-single-post aiteko-no-post-thumbnail' ); ?>>

			<div class="single-post-opener">
				<div class="single-entry-headers">

					<?php aiteko_category_list(); ?>

					<header class="single-entry-header">
						<?php the_title( '<h1 class="single-entry-title">', '</h1>' ); ?>
					</header>

					<footer class="single-entry-footer">
						<?php
							print aiteko_get_post_author();
							print '<span class="meta-gap">&#47;</span>';
							print aiteko_option_time_link();
							print '<span class="meta-gap">&#47;</span>';
							aiteko_get_comment_popup_link();
						?>

					</footer>
				</div>
			</div>

			<div class="aiteko-the-content">
				<figure class="entry-attachment wp-block-image">
					<?php
						$image_size = apply_filters( 'aiteko_single_attachment_size', 'full' );

						echo wp_get_attachment_image( get_the_ID(), $image_size );
					?>

					<figcaption class="wp-caption-text"><?php echo get_the_excerpt(); ?></figcaption>

				</figure><!-- .entry-attachment -->
				<?php 

					the_content();

					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="screen-reader-text">' . esc_html__( 'Pages:', 'aiteko' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span class="page-number">',
						'link_after'  => '</span>',
					) );

					// Retrieve attachment metadata.
					$metadata = wp_get_attachment_metadata();
					if ( $metadata ) {
						printf(
							'<span class="full-size-link aligncenter" style="text-align:center;"><span class="screen-reader-text">%1$s</span><a href="%2$s">%3$s &times; %4$s</a></span>',
							_x( 'Full size', 'Used before full size attachment link.', 'aiteko' ),
							esc_url( wp_get_attachment_url() ),
							absint( $metadata['width'] ),
							absint( $metadata['height'] )
						);
					}

					print '<hr class="wp-block-separator is-style-dots" />' . "\n";

					aiteko_entry_tag();

					do_action( 'aiteko_after_single_entry', $post );
				?>
			</div>
		</article>

	<?php
		// prev / next post links
		if ( '' !== get_theme_mod( 'post_prev_next', true ) || is_customize_preview() ) {

			// customizer placeholder, not really shown in actual site.
			if ( is_customize_preview() ) {
				$postnavhide = ( '' === get_theme_mod( 'post_prev_next', true ) ? 'display:none;' : '' );
				print '<div id="post_prev_next_customization" style="' . esc_attr( $postnavhide ) . '">';
			}

			the_post_navigation( array(
				'prev_text' => '<span class="screen-reader-text">' . esc_html__( 'Parent Post', 'aiteko' ) . '</span><span aria-hidden="true" class="nav-subtitle"><em>' . esc_html__( 'Post', 'aiteko' ) . '</em></span> <span class="nav-title">' . esc_html__( 'Parent post:', 'aiteko' ) . '<br/> %title</span>',
			) );

			// customizer placeholder, not really shown in actual site.
			if ( is_customize_preview() ) {
				print '</div>';
			}
		}

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}

		endwhile;

		do_action( 'aiteko_after_single_post' );
	?>

	</main>

<?php
get_footer();
