<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/**
 * @var string $title
 * @var string $subtitle
 */

if ( empty( $title ) ) {
	return;
}
?>
<div class="header title">
	<h2 class="fw-special-title fw-contact-form-title"><?php echo $title; ?></h2>
	<?php if ( ! empty( $subtitle ) ) : ?>
		<div class="description fw-contact-form-description"><?php echo $subtitle; ?></div>
	<?php endif ?>
</div>