<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$icon_style = '';
if( !empty($atts['color']) ) {
	$icon_style .= 'color: '.$atts['color'].';';
}

if( !empty($atts['size']) ) {
	$icon_style .= 'font-size: '.(int)$atts['size'].'px';
}
?>
<span class="fw-icon <?php echo esc_attr($atts['class']); ?>">
	<?php if( !empty($atts['link']) ) : ?>
		<a href="<?php echo esc_url($atts['link']); ?>" target="<?php echo esc_attr($atts['target']); ?>" style="<?php echo ($icon_style); ?>">
			<i class="<?php echo esc_attr($atts['icon']); ?>"></i>
		</a>
	<?php else : ?>
		<i class="<?php echo esc_attr($atts['icon']); ?>" style="<?php echo ($icon_style); ?>"></i>
	<?php endif; ?>
</span>