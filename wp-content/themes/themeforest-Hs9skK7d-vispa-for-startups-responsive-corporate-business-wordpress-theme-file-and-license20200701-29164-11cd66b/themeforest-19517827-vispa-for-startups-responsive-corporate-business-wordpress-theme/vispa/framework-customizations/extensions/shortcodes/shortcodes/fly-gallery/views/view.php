<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

if( empty($atts['images']) ) {
	return;
}

$image_width_class = array(
	'mini_square'  => 'grid-sizer',
	'portrait'     => 'height2',
	'landscape'    => 'width2',
	'big_square'   => 'width2 height2',
	'big_portrait' => 'width2 height3',
);
?>
<!-- Gallery -->
<div class="fly-gallery sh-<?php echo esc_attr( $atts['unique_id'] ); ?> <?php echo esc_attr( $atts['class'] ); ?> <?php echo esc_attr( $atts['gallery_columns'] ); ?>">
	<ul class="fly-gallery-items">
		<?php foreach( $atts['images'] as $item ) : ?>
			<li class="fly-gallery-item <?php echo esc_attr($image_width_class[ $item['image_type'] ]); ?>">
				<?php if( !empty($item['img']) ) : ?>
					<a data-rel="g-<?php echo esc_attr( $atts['unique_id'] ); ?>" href="<?php echo esc_url($item['img']['url']); ?>" title="<?php echo esc_attr($item['title']); ?>" class="item-link swipebox">
						<span class="item-image" style="background-image: url(<?php echo esc_url($item['img']['url']); ?>);"></span>

						<div class="item-hover">
							<div class="item-inner">
								<h4 class="item-title"><?php echo ($item['title']); ?></h4>
							</div>
						</div>
					</a>
				<?php endif; ?>
			</li>
		<?php endforeach; ?>
	</ul>
</div>
<!--/ Gallery -->