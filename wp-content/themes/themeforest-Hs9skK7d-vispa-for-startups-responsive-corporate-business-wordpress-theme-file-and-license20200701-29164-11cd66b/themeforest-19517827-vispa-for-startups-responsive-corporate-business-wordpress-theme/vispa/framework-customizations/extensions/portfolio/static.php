<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

if ( ! is_admin() ) {
	$ext_instance           = fw()->extensions->get( 'portfolio' );
	$settings               = $ext_instance->get_settings();
	$ext_name               = $ext_instance->get_name();
	$ext_version            = $ext_instance->manifest->get_version();
	$template_directory_uri = get_template_directory_uri();

	if( is_singular('fw-portfolio') ) {
		wp_enqueue_script(
			'carouFredSel',
			esc_url( $template_directory_uri . '/assets/js/jquery.carouFredSel-6.2.1-packed.js' ),
			array( 'jquery' ),
			$ext_version,
			true
		);
	}
}

