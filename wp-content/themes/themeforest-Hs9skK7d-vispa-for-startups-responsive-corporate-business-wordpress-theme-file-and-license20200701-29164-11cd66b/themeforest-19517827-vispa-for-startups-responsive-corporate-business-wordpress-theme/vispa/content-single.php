<?php
/**
 * The default template for displaying post details
 */

global $post;
$vispa_post_view_type  = ( defined( 'FW' ) ) ? fw_get_db_post_option( $post->ID, 'post_type' ) : '';
$vispa_post_tags       = ( defined( 'FW' ) ) ? fw_get_db_settings_option( 'enable-post-tags' ) : 'yes';
$vispa_post_share      = ( defined( 'FW' ) ) ? fw_get_db_settings_option( 'enable-post-share' ) : 'no';
$vispa_post_author_box = ( defined( 'FW' ) ) ? fw_get_db_settings_option( 'enable-post-author-box' ) : 'yes';
$vispa_post_pagination = ( defined( 'FW' ) ) ? fw_get_db_settings_option( 'enable-post-pagination' ) : 'yes';
$vispa_related_posts   = ( defined( 'FW' ) ) ? fw_get_db_settings_option( 'enable_related_posts' ) : 'yes';
?>
<!-- Post -->
<article id="post-<?php the_ID(); ?>" class="article content-blog" itemscope itemtype="http://schema.org/Article">
	<div class="post-media">
		<?php if ( ! empty( $vispa_post_view_type ) ) :
			vispa_theme_get_post_view_type( $vispa_post_view_type, $post->ID );
		else :
			$image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ), 'post-thumbnails' );
			vispa_theme_show_default_post_image( $image, $post->ID );
		endif; ?>
	</div>

	<?php vispa_theme_post_meta(); ?>

	<div class="post-content" itemprop="articleBody">
		<?php the_content();
		wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'vispa' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
		) ); ?>
	</div>

	<?php if ( $vispa_post_tags == 'yes' || $vispa_post_share == 'yes' ): ?>
		<div class="post-links clearfix">
			<div class="row">
				<?php if ( $vispa_post_tags == 'yes' ) : ?>
					<div class="col-sm-6">
						<div class="post-taglist">
							<?php the_tags( '', ' ', '' ); ?>
						</div>
					</div>
				<?php endif; ?>

				<?php if ( $vispa_post_share == 'yes' ) : ?>
					<div class="col-sm-6">
						<?php vispa_theme_share_post(); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>
</article>
<!--/ Post -->

<?php if ( $vispa_post_author_box == 'yes' ) : ?>
	<?php get_template_part( 'content', 'author' ); ?>
<?php endif; ?>

<?php if ( $vispa_post_pagination == 'yes' ) : ?>
	<div class="pager">
		<?php previous_post_link( '%link', '<i class="fa fa-chevron-left"></i>' . esc_html__( 'Previous Article', 'vispa' ) ); ?>
		<?php next_post_link( '%link', '' . esc_html__( 'Next Article', 'vispa' ) . '<i class="fa fa-chevron-right"></i>' ); ?>
	</div>
<?php endif; ?>
<?php if( $vispa_related_posts == 'yes' ) :
	get_template_part('related', 'posts');
else: ?>
<div class="separator separator-danger"><?php echo vispa_theme_separator_symbol(); ?></div>
<?php endif; ?>