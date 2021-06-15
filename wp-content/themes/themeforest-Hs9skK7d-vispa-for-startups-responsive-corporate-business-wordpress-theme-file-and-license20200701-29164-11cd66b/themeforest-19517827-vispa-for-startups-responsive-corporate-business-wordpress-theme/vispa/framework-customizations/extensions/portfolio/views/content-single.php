<?php
/**
 * The default template for displaying project post details
 */

// portfolio post general settings
$vispa_post_share      = fw_get_db_settings_option( 'enable-portfolio-share', 'yes' );
$vispa_post_pagination = fw_get_db_settings_option( 'enable-portfolio-pagination', 'yes' );
$vispa_post_author_box = fw_get_db_settings_option( 'enable-portfolio-author-box', 'yes' );
$vispa_post_categories = fw_get_db_settings_option( 'enable-portfolio-categories', 'yes' );

// portfolio post specific settings
$vispa_thumbnails      = vispa_theme_ext_portfolio_get_gallery_images();
$vispa_permalink       = get_permalink();
$vispa_additional_info = fw_get_db_post_option( $post->ID, 'additional_info' );
?>
<!-- Post -->
<article class="article content-blog" itemscope itemtype="http://schema.org/Article">
	<h2 class="post-title" itemprop="name"><?php the_title(); ?></h2>

	<div class="post-media">
		<!-- Thumbnail Slider -->
		<div class="thumbnail-slider clearfix" data-height="360">
			<div class="slider-images-wrap">
				<ul class="slider-images">
					<?php $vispa_slider_thumbs = ''; ?>
					<?php foreach ( $vispa_thumbnails as $item ) : ?>
						<?php $vipa_attachment_metadata = get_post( $item['attachment_id'] ); ?>
						<li style="background-image: url(<?php echo $item['url']; ?>)">
							<div class="description">
								<h4 class="title"><span><?php echo $vipa_attachment_metadata->post_title; ?></span></h4>
								<?php if ( ! empty( $vipa_attachment_metadata->post_content ) ) : ?>
									<div class="subtitle">
										<span><?php echo $vipa_attachment_metadata->post_content; ?></span></div>
								<?php endif; ?>
								<a href="#" class="description-close fa fa-close"></a>
							</div>
						</li>
						<?php $vispa_slider_thumbs .= '<li style="background-image: url(' . $item['url'] . ')"></li>'; ?>
					<?php endforeach; ?>
				</ul>

				<a href="#" class="prev fa fa-long-arrow-left"></a>
				<a href="#" class="next fa fa-long-arrow-right"></a>
			</div>

			<div class="slider-thumbs-wrap">
				<ul class="slider-thumbs">
					<?php echo $vispa_slider_thumbs; ?>
				</ul>
				<a href="#" class="prev fa fa-long-arrow-up"></a>
				<a href="#" class="next fa fa-long-arrow-down"></a>
			</div>

			<a class="description-open fa fa-info active" href="#"></a>
		</div>
		<!--/ Thumbnail Slider -->
	</div>

	<div class="post-content" itemprop="articleBody">
		<?php if( $vispa_additional_info['selected'] == 'yes' ) : ?>
			<div class="project-info row">
				<?php if( !empty($vispa_additional_info['yes']['client']) ) : ?>
					<div class="item col-sm-6 col-lg-3">
						<strong><?php esc_html_e( 'Client', 'vispa' ); ?></strong>
						<span><?php echo $vispa_additional_info['yes']['client']; ?></span>
					</div>
				<?php endif; ?>

				<?php if( !empty($vispa_additional_info['yes']['production_date']) ) : ?>
					<div class="item col-sm-6 col-lg-3">
						<strong><?php esc_html_e( 'Production Date', 'vispa' ); ?></strong>
						<span><?php echo $vispa_additional_info['yes']['production_date']; ?></span>
					</div>
				<?php endif; ?>

				<?php if( !empty($vispa_additional_info['yes']['skills']) ) : ?>
					<div class="item col-sm-6 col-lg-3">
						<strong><?php esc_html_e( 'Used Skills', 'vispa' ); ?></strong>
						<span><?php echo $vispa_additional_info['yes']['skills']; ?></span>
					</div>
				<?php endif; ?>

				<?php if( $vispa_post_categories == 'yes' ) : ?>
					<div class="item col-sm-6 col-lg-3">
						<strong><strong><?php esc_html_e( 'Categories', 'vispa' ); ?></strong></strong>
						<span>
							<?php echo vispa_get_portfolio_categories(', '); ?>
						</span>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php the_content();
		wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'vispa' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
		) ); ?>
	</div>

	<?php if ( $vispa_post_share == 'yes' ) : ?>
		<div class="post-links clearfix">
			<div class="row">
				<div class="col-sm-12">
					<?php vispa_theme_share_post(); ?>
				</div>
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
		<?php previous_post_link( '%link', '<i class="fa fa-chevron-left"></i>' . esc_html__( 'Previous Project', 'vispa' ) ); ?>
		<?php next_post_link( '%link', '' . esc_html__( 'Next Project', 'vispa' ) . '<i class="fa fa-chevron-right"></i>' ); ?>
	</div>
<?php endif; ?>

<div class="separator separator-danger"><?php echo vispa_theme_separator_symbol(); ?></div>