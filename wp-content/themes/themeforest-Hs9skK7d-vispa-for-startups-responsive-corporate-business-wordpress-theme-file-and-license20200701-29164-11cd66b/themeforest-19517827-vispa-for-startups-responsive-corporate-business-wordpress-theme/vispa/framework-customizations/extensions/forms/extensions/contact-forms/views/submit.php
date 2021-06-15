<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/**
 * @var int $form_id
 * @var string $submit_button_text
 * @var array $extra_data
 */
?>
<div class="fw-submit-btn-wrap text-center">
	<input class="btn btn-danger btn-fill" type="submit" value="<?php echo esc_attr( $submit_button_text ) ?>"/>
</div>