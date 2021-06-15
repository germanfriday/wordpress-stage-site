<?php if (!defined('FW')) die( 'Forbidden' );
/**
 * @var $atts
 */
?>
<div class="fw-heading <?php echo esc_attr( $atts['class'] ); ?> sh-<?php echo esc_attr( $atts['unique_id'] ); ?> fw-heading-<?php echo esc_attr($atts['heading']); ?> <?php echo ($atts['centered'] == 'yes' ) ? 'fw-heading-center' : ''; ?>">
	<?php $heading = "<{$atts['heading']} class='fw-special-title'>{$atts['title']}</{$atts['heading']}>"; ?>
	<?php echo $heading; ?>
	<?php if ( $atts['separator']['selected'] == 'yes' ) : ?>
		<div class="separator separator-danger"><?php echo vispa_theme_separator_symbol($atts['separator']['yes']['type']); ?></div>
	<?php endif; ?>
	<?php if ( !empty($atts['subtitle']) ) : ?>
		<div class="description"><?php echo ($atts['subtitle']); ?></div>
	<?php endif; ?>
</div>