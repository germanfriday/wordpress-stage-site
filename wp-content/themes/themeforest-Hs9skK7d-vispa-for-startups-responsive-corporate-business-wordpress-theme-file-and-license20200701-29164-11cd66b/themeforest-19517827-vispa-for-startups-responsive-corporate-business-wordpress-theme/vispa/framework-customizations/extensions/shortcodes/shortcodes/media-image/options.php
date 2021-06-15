<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'image'            => array(
		'type'  => 'upload',
		'label' => __( 'Choose Image', 'vispa' ),
		'desc'  => __( 'Either upload a new, or choose an existing image from your media library', 'vispa' )
	),
	'size'             => array(
		'type'    => 'group',
		'options' => array(
			'width'  => array(
				'type'  => 'short-text',
				'label' => __( 'Width', 'vispa' ),
				'desc'  => __( 'Set image width', 'vispa' ),
				'value' => ''
			),
			'height' => array(
				'type'  => 'short-text',
				'label' => __( 'Height', 'vispa' ),
				'desc'  => __( 'Set image height', 'vispa' ),
				'value' => ''
			)
		)
	),
	'image-link-group' => array(
		'type'    => 'group',
		'options' => array(
			'link'   => array(
				'type'  => 'text',
				'label' => __( 'Image Link', 'vispa' ),
				'desc'  => __( 'Where should your image link to?', 'vispa' )
			),
			'target' => array(
				'type'         => 'switch',
				'label'        => __( 'Open Link in New Window', 'vispa' ),
				'desc'         => __( 'Select here if you want to open the linked page in a new window', 'vispa' ),
				'right-choice' => array(
					'value' => '_blank',
					'label' => __( 'Yes', 'vispa' ),
				),
				'left-choice'  => array(
					'value' => '_self',
					'label' => __( 'No', 'vispa' ),
				),
			),
		)
	)
);

