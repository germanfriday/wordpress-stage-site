<?php
/**
 * post loop
 *
 * @package aiteko
 * @since 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'search-loop' ); ?>>

	<header class="entry-header">
		<h4 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
	</header>

	<div class="entry-search-content">
		<?php the_excerpt(); ?>

		<a href="<?php the_permalink(); ?>" class="rd-more" rel="bookmark"><?php print esc_html__( 'Read more', 'aiteko' ); ?></a>
	</div>

</article>
