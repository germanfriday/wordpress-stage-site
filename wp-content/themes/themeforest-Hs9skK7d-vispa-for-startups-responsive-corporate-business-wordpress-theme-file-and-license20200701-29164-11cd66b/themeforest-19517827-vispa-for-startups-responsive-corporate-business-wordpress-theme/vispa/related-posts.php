<?php
$vispa_related_posts    = vispa_related_posts();
$vispa_sidebar_position = function_exists( 'fw_ext_sidebars_get_current_position' ) ? fw_ext_sidebars_get_current_position() : 'right';
$vispa_related_class    = ( $vispa_sidebar_position == 'right' || $vispa_sidebar_position == 'left' ) ? 'postlist-double' : 'postlist-triple';

if ( ! empty( $vispa_related_posts ) ) : ?>
	<!-- Related Posts -->
	<div class="section section-gray section-related-articles">
		<div class="container-wrap">
			<div class="title-area">
				<h2><?php esc_html_e( 'Related Posts', 'vispa' ); ?></h2>
				<div class="separator separator-danger"><?php echo vispa_theme_separator_symbol(); ?></div>
			</div>

			<!-- PostList -->
			<div class="<?php echo $vispa_related_class; ?> postlist-masonry">
				<?php foreach ( $vispa_related_posts as $item ) : ?>
					<article class="article card card-blog card-white">
						<div class="inner">
							<a href="<?php echo esc_url(get_permalink($item->ID)); ?>" class="header">
								<?php
								$image = wp_get_attachment_url( get_post_thumbnail_id( $item->ID ), 'post-thumbnails' );
								vispa_theme_show_default_post_image( $image, $item->ID );
								?>
							</a>
							<div class="content">
								<div class="circle-black">
									<div class="circle">
										<div class="date-wrapper">
											<span class="month"><?php echo get_the_date( "M", $item->ID ); ?></span>
											<span class="date"><?php echo get_the_date( "d", $item->ID ); ?></span>
										</div>
									</div>
								</div>
								<a href="<?php echo esc_url(get_permalink($item->ID)); ?>" class="card-title"><h3><?php echo $item->post_title; ?></h3></a>
								<h6 class="card-category"><?php vispa_theme_get_one_post_category($item->ID); ?></h6>
								<div class="text-description text-gray">
									<?php if( !empty($item->post_excerpt) ) :
										echo $item->post_excerpt;
									else :
										echo strip_tags(substr($item->post_content, 0, 200));
									endif; ?>
								</div>
							</div>
							<div class="clearfix"></div>
						</div>
					</article>
				<?php endforeach; ?>
				<?php wp_reset_query(); ?>
			</div>
			<!--/ PostList -->
		</div>
	</div>
	<!--/ Related Posts -->
<?php endif; ?>