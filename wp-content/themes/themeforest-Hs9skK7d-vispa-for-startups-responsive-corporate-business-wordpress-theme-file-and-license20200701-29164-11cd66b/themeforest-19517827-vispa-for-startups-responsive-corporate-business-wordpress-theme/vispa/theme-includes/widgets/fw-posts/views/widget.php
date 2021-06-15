<?php
/**
 * @var $instance
 * @var $before_widget
 * @var $after_widget
 * @var $title
 */
?>
<?php if ( ! empty( $instance ) ) :
	$items      = 5;
	if ( isset( $instance['posts_number'] ) && $instance['posts_number'] != '' ) {
		$items = (int) $instance['posts_number'];
	}

	$date_query = array();
	if ( $instance['days'] != '' ) {
		$days       = (int) $instance['days'];
		$time       = time() - ( $days * 24 * 60 * 60 );
		$date_query = array(
			'after'     => date( 'F jS, Y', $time ),
			'before'    => date( 'F jS, Y' ),
			'inclusive' => true,
		);
	}

	$args   = array(
		'sort'             => 'recent',
		'items'            => $items,
		'image_post'       => true,
		'return_image_tag' => false,
		'image_width'      => 80,
		'image_height'     => 80,
		'image_class'      => '',
		'date_format'      => 'l, j, M',
		'category'         => $instance['category'],
		'date_query'       => $date_query
	);
	$args_2 = array(
		'sort'             => 'popular',
		'items'            => $items,
		'image_post'       => true,
		'return_image_tag' => false,
		'image_width'      => 80,
		'image_height'     => 80,
		'image_class'      => '',
		'date_format'      => 'l, j, M',
		'category'         => $instance['category'],
		'date_query'       => $date_query
	);

	$fw_posts   = vispa_theme_get_posts( $args );
	$fw_posts_2 = vispa_theme_get_posts( $args_2 );

	vispa_theme_print( $before_widget );
	?>
	<ul class="tab-header clearfix">
		<li class="active"><a href="#tab1" data-toggle="tab"><?php esc_html_e( 'Recent Posts', 'vispa' ); ?></a>
		</li>
		<li><a href="#tab2" data-toggle="tab"><?php esc_html_e( 'Popular Posts', 'vispa' ); ?></a></li>
	</ul>

	<div class="tab-content">
		<div class="tab-pane fade in active" id="tab1">
			<!-- Widget Recent Posts -->
			<div class="widget-posts">
				<?php foreach ( $fw_posts as $item ): $c = rand( 1, 10000 ); ?>
					<!-- Post -->
					<article class="article clearfix" itemscope itemtype="http://schema.org/Article">
						<?php if ( ! empty( $item['post_img'] ) ): ?>
							<?php $attachment_title = get_the_title( get_post_thumbnail_id( $item['id'] ) ); ?>
							<div class="post-media">
								<img src="<?php echo esc_url( $item['post_img'] ); ?>"
								     alt="<?php echo get_the_title( $item['id'] ); ?>" itemprop="image"/>

								<div class="links">
									<a class="swipebox icon-search" data-rel="gallery<?php echo esc_attr( $c ); ?>"
									   href="<?php echo esc_url( $item['post_img_full'] ); ?>"
									   title="<?php echo esc_attr( $attachment_title ); ?>" class="icon-search"></a>
								</div>
							</div>
						<?php endif; ?>

						<div class="post-content" itemprop="articleBody">
							<h3 class="post-title"><a href="<?php echo esc_url( $item['post_link'] ); ?>"
							                          itemprop="name"><?php echo get_the_title( $item['id'] ); ?></a>
							</h3>

							<div class="post-meta">
								<?php if ( $instance['display_date'] ): ?>
									<time class="post-date" datetime="<?php the_time( 'c' ); ?>"
									      itemprop="dateCreated"><?php echo esc_html( $item['post_date_post'] ); ?></time>
								<?php endif; ?>
								<?php vispa_theme_get_post_category( $item['id'] ); ?>
							</div>
						</div>
					</article>
					<!--/ Post -->
				<?php endforeach; ?>
			</div>
			<!--/ Widget Recent Posts -->
		</div>

		<div class="tab-pane" id="tab2">
			<!-- Widget Recent Posts -->
			<div class="widget-posts">
				<?php foreach ( $fw_posts_2 as $item ): $i = rand( 1, 10000 ); ?>
					<!-- Post -->
					<article class="article clearfix" itemscope itemtype="http://schema.org/Article">
						<?php if ( ! empty( $item['post_img'] ) ): ?>
							<?php $attachment_title = get_the_title( get_post_thumbnail_id( $item['id'] ) ); ?>
							<div class="post-media">
								<img src="<?php echo esc_url( $item['post_img'] ); ?>"
								     alt="<?php echo get_the_title( $item['id'] ); ?>" itemprop="image"/>

								<div class="links">
									<a class="swipebox icon-search" data-rel="gallery<?php echo esc_attr( $i ); ?>"
									   href="<?php echo esc_url( $item['post_img_full'] ); ?>"
									   title="<?php echo esc_attr( $attachment_title ); ?>" class="icon-search"></a>
								</div>
							</div>
						<?php endif; ?>

						<div class="post-content" itemprop="articleBody">
							<h3 class="post-title"><a href="<?php echo esc_url( $item['post_link'] ); ?>"
							                          itemprop="name"><?php echo get_the_title( $item['id'] ); ?></a>
							</h3>

							<div class="post-meta">
								<?php if ( $instance['display_date'] ): ?>
									<time class="post-date" datetime="<?php the_time( 'c' ); ?>"
									      itemprop="dateCreated"><?php echo esc_html( $item['post_date_post'] ); ?></time>
								<?php endif; ?>
								<?php vispa_theme_get_post_category( $item['id'] ); ?>
							</div>
						</div>
					</article>
					<!--/ Post -->
				<?php endforeach; ?>
			</div>
			<!--/ Widget Recent Posts -->
		</div>
	</div>
	<?php
	vispa_theme_print( $after_widget );
endif; ?>