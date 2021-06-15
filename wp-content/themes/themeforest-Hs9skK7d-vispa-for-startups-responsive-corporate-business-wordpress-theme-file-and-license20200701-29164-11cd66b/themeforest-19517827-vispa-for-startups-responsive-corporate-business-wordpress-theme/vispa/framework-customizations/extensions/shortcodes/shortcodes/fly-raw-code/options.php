<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'text' => array(
		'type'  => 'textarea',
		'value' => '',
		'label' => __( 'Code', 'vispa' ),
		'desc'  => __( 'Enter the HTML, JavaScript or CSS code', 'vispa' )
	),
);