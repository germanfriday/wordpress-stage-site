<?php
/**
 * Portfolio grid loop
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

<article id="post-<?php the_ID(); ?>" <?php post_class( 'portfolio-grid' ); ?>>
	<div class="portfolio-inner">
		<header class="portfolio-entry-header">
			<?php the_title( '<h3><a href="' . esc_url( get_permalink() ) . '">', '</a><span class="p__tt_splash_o"></span><span class="p__tt_splash_i"></span></h3>' ); ?>
			<?php
				if ( $year_info || $show_category ) {
					print '<span class="year-info">' . $year_info . aiteko_get_portfolio_cat_lists( get_the_ID(), $year_info, $show_category ) . '<span class="p__y_splash_o"></span><span class="p__y_splash_i"></span></span>';
				}
			?>
		</header>

		<?php
			if ( $thumbnail = get_the_post_thumbnail( $post, 'large' ) ) {
				print '<a class="portfolio-thumbnail-link" href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $thumbnail . '<span class="p__t_splash_o"></span><span class="p__t_splash_i"></span></a>' . "\n";
			}
		?>
	</div>
</article>
