<?php
/**
 * Portfolio timeline loop
 *
 * @package WordPress
 * @subpackage Aiteko
 * @since 1.0
 */

$show_category = false;
if ( isset( $GLOBALS['show_cat'] ) ) {
	$show_category = $GLOBALS['show_cat'] === "yes" ? true : false;
}
$year_info = get_portfolio_year_info();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'portfolio-default' ); ?>>
	<div class="portfolio-inner">
		<?php
			if ( $thumbnail = get_the_post_thumbnail( $post, 'aiteko-post-cover', array( 'data-render' => esc_url( get_theme_file_uri( '/assets/images/clouds.jpg' ) ) ) ) ) {
				print '<a class="portfolio-thumbnail-link" href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $thumbnail . '</a>' . "\n";
			}
		?>
		<header class="portfolio-entry-header">
			<?php
				if ( $year_info || $show_category ) {
					print '<span class="year-info">' . $year_info . aiteko_get_portfolio_cat_lists( get_the_ID(), $year_info, $show_category ) . '</span>';
				}
			?>
			<?php the_title( '<h3><a href="' . esc_url( get_permalink() ) . '">', '</a></h3>' ); ?>

		</header>
	</div>
</article>
