<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * @var $map_data_attr
 * @var $atts
 * @var $content
 * @var $tag
 */
$class = isset( $atts['class'] ) ? $atts['class'] : '';

if ( ! isset( $atts['map_pin'] ) || empty( $atts['map_pin'] ) ) {
	$map_data_attr['data-map-pin'] = json_encode( array( 'url' => vispa_include_file_from_child( '/assets/img/marker.png' ) ) );
} elseif ( isset( $atts['map_pin']['url'] ) ) {
	$map_data_attr['data-map-pin'] = json_encode( array( 'url' => $atts['map_pin']['url'] ) );
}

unset($map_data_attr['data-contact-data']);

?>
<div class="section section-contact-us">
	<div class="contact-container">
		<?php if( $atts['contact_data']['selected'] == 'yes' ) : ?>
			<div class="address-container">
				<div class="address">
					<?php if( !empty($atts['contact_data']['yes']['address']) ) : ?>
						<h4><?php esc_html_e('Our Address', 'vispa'); ?></h4>
						<p class="text-gray"><?php echo ($atts['contact_data']['yes']['address']); ?></p>
					<?php endif; ?>

					<?php if( !empty($atts['contact_data']['yes']['phone']) ) : ?>
						<h4><?php esc_html_e('Phone', 'vispa'); ?></h4>
						<p class="text-gray"><?php echo ($atts['contact_data']['yes']['phone']); ?></p>
					<?php endif; ?>

					<?php if( !empty($atts['contact_data']['yes']['email']) ) : ?>
						<h4><?php esc_html_e('Email', 'vispa'); ?></h4>
						<p class="text-gray"><a href="mailto:<?php echo esc_attr($atts['contact_data']['yes']['email']); ?>"><?php echo ($atts['contact_data']['yes']['email']); ?></a></p>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>
		<div class="wrap-map fw-map <?php echo esc_attr( $class ); ?>" <?php echo fw_attr_to_html( $map_data_attr ); ?>>
			<div class="fw-map-canvas map"></div>
		</div>
	</div>
</div>