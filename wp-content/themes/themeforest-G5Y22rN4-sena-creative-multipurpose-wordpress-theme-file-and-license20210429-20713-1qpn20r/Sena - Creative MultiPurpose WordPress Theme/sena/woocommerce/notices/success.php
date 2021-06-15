<?php
/**
 * Show messages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/notices/success.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! $notices ) {
	return;
}

?>

<?php foreach ( $messages as $message ) : ?>
	<div class="alert alert-success alert-dismissible">
		<div class="alert-icon">
			<i class="hc-checkmark-circle"></i>
		</div>
		<button type="button" data-dismiss="alert" aria-label="Close" class="close"><i class="hc-close"></i></button>
		<p><?php echo wp_kses_post( str_replace('button wc-forward', 'btn btn-light-out btn-sm', $message) ); ?></p>
	</div>
<?php endforeach; ?>
