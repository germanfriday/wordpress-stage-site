<?php
/**
 * Single content
 *
 * @package Aiteko
 * @since 1.0
 */

$classes = array( 'aiteko-single-post' );
if ( ! has_post_thumbnail() ) {
	$classes[] = 'aiteko-no-post-thumbnail';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>

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

		<?php
		if ( has_post_thumbnail() ) {
		?>
		<div class="single-post-featured-image">
			<?php print get_the_post_thumbnail( $post, 'full' ); ?>
		</div>
		<?php
		}
		?>
	</div>

	<div class="aiteko-the-content">
		<?php 

			the_content();

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="screen-reader-text">' . esc_html__( 'Pages:', 'aiteko' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			) );

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
			'prev_text' => '<span class="screen-reader-text">' . esc_html__( 'Previous Post', 'aiteko' ) . '</span><span aria-hidden="true" class="nav-subtitle"><em>' . esc_html__( 'Previous', 'aiteko' ) . '</em></span> <span class="nav-title">%title</span>',
			'next_text' => '<span class="screen-reader-text">' . esc_html__( 'Next Post', 'aiteko' ) . '</span><span aria-hidden="true" class="nav-subtitle"><em>' . esc_html__( 'Next', 'aiteko' ) . '</em></span> <span class="nav-title">%title</span>',
			'in_same_term' => true
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
