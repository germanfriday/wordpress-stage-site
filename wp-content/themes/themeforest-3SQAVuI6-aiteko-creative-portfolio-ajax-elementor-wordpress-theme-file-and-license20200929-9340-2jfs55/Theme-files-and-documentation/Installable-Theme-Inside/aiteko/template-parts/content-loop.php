<?php
/**
 * post loop
 *
 * @package aiteko
 * @since 1.0
 */

$post_classes = array( 'post-masonry-list', 'post-grid' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $post_classes ); ?>>
	<div class="ui-post-wrap">
		<div class="entry-thumbnail">
			<?php
				if ( $thumbnail = get_the_post_thumbnail( $post, 'large' ) ) {
					print '<a class="thumbnail-link" href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $thumbnail . '</a>' . "\n";
				}
			?>
			<span class="preloader-block"></span>
			<?php 
				print aiteko_time_link();
				aiteko_category_list();
			?>
			<a class="read-more-block" href="<?php the_permalink(); ?>">
				<svg viewBox="0 0 512 512">
					<g fill="currentColor" fill-rule="evenodd" class="line-arrow">
						<path d="M295.6 163.7c-5.1 5-5.1 13.3-.1 18.4l60.8 60.9H124.9c-7.1 0-12.9 5.8-12.9 13s5.8 13 12.9 13h231.3l-60.8 60.9c-5 5.1-4.9 13.3.1 18.4 5.1 5 13.2 5 18.3-.1l82.4-83c1.1-1.2 2-2.5 2.7-4.1.7-1.6 1-3.3 1-5 0-3.4-1.3-6.6-3.7-9.1l-82.4-83c-4.9-5.2-13.1-5.3-18.2-.3z"/>
					</g>
				</svg>		
			</a>
			<?php
				$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
				if ( $paged < 1 ) {
					$paged = 1;
				}
				if ( is_sticky() && intval( $paged ) === 1 ) :
			?>
				<span class="sticky--post">
					<svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 100 100"><g><path fill="currentColor" d="M74,34H55v-6c0-0.6-0.4-1-1-1h-8c-0.6,0-1,0.4-1,1v6H26c-1.1,0-2,0.9-2,2v35c0,1.1,0.9,2,2,2h48   c1.1,0,2-0.9,2-2V36C76,34.9,75.1,34,74,34z M72,69H28V38h17v3c0,0.6,0.4,1,1,1h8c0.6,0,1-0.4,1-1v-3h17V69z"/><path fill="currentColor" d="M32,47c-0.6,0-1,0.4-1,1s0.4,1,1,1h25c0.6,0,1-0.4,1-1s-0.4-1-1-1H32z"/><path fill="currentColor" d="M61,49h7c0.6,0,1-0.4,1-1s-0.4-1-1-1h-7c-0.6,0-1,0.4-1,1S60.4,49,61,49z"/><path fill="currentColor" d="M30,55c0,0.6,0.4,1,1,1h28c0.6,0,1-0.4,1-1s-0.4-1-1-1H31C30.4,54,30,54.4,30,55z"/><path fill="currentColor" d="M63,54c-0.6,0-1,0.4-1,1s0.4,1,1,1h6c0.6,0,1-0.4,1-1s-0.4-1-1-1H63z"/><path fill="currentColor" d="M50,61H32c-0.6,0-1,0.4-1,1s0.4,1,1,1h18c0.6,0,1-0.4,1-1S50.6,61,50,61z"/><path fill="currentColor" d="M68,61H54c-0.6,0-1,0.4-1,1s0.4,1,1,1h14c0.6,0,1-0.4,1-1S68.6,61,68,61z"/></g></svg>
					<?php print esc_html__( 'Sticky post', 'aiteko' ); ?></span>
			<?php endif; ?>
		</div>

		<footer class="entry-footer">
			<?php 
				print aiteko_get_post_author();
			?>
		</footer>

		<header class="entry-header">
			<h4 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
		</header>


	</div>
</article>
