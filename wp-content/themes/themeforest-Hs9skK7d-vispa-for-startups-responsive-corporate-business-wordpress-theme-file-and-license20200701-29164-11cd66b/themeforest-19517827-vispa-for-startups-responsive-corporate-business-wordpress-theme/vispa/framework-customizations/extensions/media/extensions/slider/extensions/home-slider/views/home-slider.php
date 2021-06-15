<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}


if ( isset( $data['slides'] ) && ! empty( $data['slides'] ) ) :
	$count       = 0;
	$interval    = ! empty( $data['settings']['extra']['interval'] ) ? (int) $data['settings']['extra']['interval'] : '1000000';
	$parallax    = ( $data['settings']['extra']['parallax'] == 'yes' ) ? 'parallax' : '';
	$overlay     = ( $data['settings']['extra']['overlay'] == 'yes' ) ? 'filter' : '';
	$zoom_effect = ( $data['settings']['extra']['zoom_effect'] == 'yes' ) ? 'zoom_effect' : '';
	?>
	<!-- Main Slider -->
	<div id="main-slider-<?php echo esc_attr($data['settings']['extra']['unique_id']); ?>" class="main-slider main-slider-big carousel slide fade-effect" data-interval="<?php echo esc_attr( $interval ); ?>">
		<!-- Carousel items -->
		<div class="carousel-inner">
			<?php foreach ( $data['slides'] as $slide ): $count ++; ?>
				<div class="section section-header item <?php echo esc_attr($zoom_effect); ?> <?php echo ( $count == 1 ) ? 'active' : ''; ?>">
					<div class="<?php echo esc_attr($parallax); ?> <?php echo esc_attr($overlay); ?> filter-color-black">
						<div class="image" style="background-image: url(<?php echo esc_url( $slide['src'] ); ?>);"></div>
						<div class="container">
							<div class="content">
								<div data-animate-in="fadeInDownSmall" data-animate-out="fadeOutUpSmall">
									<h1><?php echo esc_html( $slide['title'] ); ?></h1>
								</div>

								<div data-animate-in="fadeInUpSmall" data-animate-out="fadeOutDownSmall">
									<?php if( $data['settings']['extra']['separator'] == 'yes' ) : ?>
										<div class="separator-container">
											<div class="separator line-separator"><?php echo vispa_theme_separator_symbol(); ?></div>
										</div>
									<?php endif; ?>
									<h5><?php echo do_shortcode( $slide['desc'] ); ?></h5>
								</div>
							</div>
						</div>
					</div>

					<?php if( !empty($data['settings']['extra']['link_id']) ) : ?>
						<a href="" data-scroll="true" data-id="#<?php echo esc_attr($data['settings']['extra']['link_id']); ?>" class="scroll-arrow hidden-xs hidden-sm">
							<i class="fa fa-angle-down"></i>
						</a>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>

		<ol class="carousel-indicators">
			<?php for ( $i = 0; $i < count( $data['slides'] ); $i++ ) : ?>
				<li data-target="#main-slider-<?php echo esc_attr($data['settings']['extra']['unique_id']); ?>" data-slide-to="<?php echo esc_attr( $i ); ?>" <?php echo ( $i == 0 ) ? 'class="active"' : ''; ?>></li>
			<?php endfor; ?>
		</ol>

		<a class="carousel-control left fa fa-angle-double-left" href="#main-slider-<?php echo esc_attr($data['settings']['extra']['unique_id']); ?>" data-slide="prev"></a>
		<a class="carousel-control right fa fa-angle-double-right" href="#main-slider-<?php echo esc_attr($data['settings']['extra']['unique_id']); ?>" data-slide="next"></a>
	</div>
	<!--/ Main Image or Slider -->
<?php endif; ?>