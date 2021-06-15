<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

if( empty($atts['testimonials']) ) {
	return;
}

$id = 'sh-'.$atts['unique_id'];
?>
<div class="fw-testimonials section section-our-clients-freebie <?php echo $id; ?> <?php echo esc_attr( $atts['class'] ); ?>">
	<ul class="nav nav-text" role="tablist">
		<?php $count = 0; $testimonials_items = ''; ?>
		<?php foreach ($atts['testimonials'] as $key=>$testimonial) : ?>
			<?php
			$class = '';
			if( $count == 0 ) {
				$class = 'in active';
			} ?>
			<li class="<?php echo esc_attr($class); ?>">
				<a href="#<?php echo esc_attr($id).'-'.$key; ?>" role="tab" data-toggle="tab">
					<div class="image-clients">
						<?php if( !empty($testimonial['author_avatar']) ) : ?>
							<img alt="<?php echo esc_attr($testimonial['title']); ?>" class="img-circle" src="<?php echo esc_url($testimonial['author_avatar']['url']); ?>"/>
						<?php else : ?>
							<span class="fly-testimonials-title"><?php echo ($testimonial['title']); ?></span>
						<?php endif; ?>
					</div>
				</a>
			</li>

			<?php
			$testimonials_items .= ' <div class="tab-pane fade '.$class.'" id="'.esc_attr($id).'-'.$key.'">
				<div class="description">
					'.do_shortcode($testimonial['content']).'
				</div>
			</div>';
			?>
			<?php $count++; ?>
		<?php endforeach; ?>
	</ul>

	<div class="tab-content">
		<?php echo $testimonials_items; ?>
	</div>
</div>