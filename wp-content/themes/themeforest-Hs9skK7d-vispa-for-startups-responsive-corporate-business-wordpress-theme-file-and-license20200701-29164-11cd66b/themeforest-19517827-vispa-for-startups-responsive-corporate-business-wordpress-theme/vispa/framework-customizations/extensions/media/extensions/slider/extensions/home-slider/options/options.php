<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'unique_id'   => array(
		'type' => 'unique'
	),
	'interval'    => array(
		'type'  => 'text',
		'label' => esc_html__( 'Interval', 'vispa' ),
		'value' => '5000',
		'desc'  => esc_html__( 'Enter slider interval', 'vispa' )
	),
	'parallax'    => array(
		'label'        => __( 'Parallax', 'vispa' ),
		'type'         => 'switch',
		'desc'         => __( 'Enable the parallax?', 'vispa' ),
		'left-choice'  => array(
			'value' => 'no',
			'label' => __( 'No', 'vispa' ),
		),
		'right-choice' => array(
			'value' => 'yes',
			'label' => __( 'Yes', 'vispa' ),
		),
		'value'        => 'yes',
	),
	'overlay'     => array(
		'label'        => __( 'Overlay', 'vispa' ),
		'type'         => 'switch',
		'desc'         => __( 'Enable the overlay?', 'vispa' ),
		'left-choice'  => array(
			'value' => 'no',
			'label' => __( 'No', 'vispa' ),
		),
		'right-choice' => array(
			'value' => 'yes',
			'label' => __( 'Yes', 'vispa' ),
		),
		'value'        => 'yes',
	),
	'zoom_effect' => array(
		'label'        => __( 'Zoom Effect', 'vispa' ),
		'type'         => 'switch',
		'desc'         => __( 'Enable the zoom effect?', 'vispa' ),
		'left-choice'  => array(
			'value' => 'no',
			'label' => __( 'No', 'vispa' ),
		),
		'right-choice' => array(
			'value' => 'yes',
			'label' => __( 'Yes', 'vispa' ),
		),
		'value'        => 'yes',
	),
	'separator'   => array(
		'label'        => __( 'Separator', 'vispa' ),
		'type'         => 'switch',
		'desc'         => __( 'Enable the separator?', 'vispa' ),
		'left-choice'  => array(
			'value' => 'no',
			'label' => __( 'No', 'vispa' ),
		),
		'right-choice' => array(
			'value' => 'yes',
			'label' => __( 'Yes', 'vispa' ),
		),
		'value'        => 'yes',
	),
	'link_id'     => array(
		'type'  => 'text',
		'label' => esc_html__( 'Link ID', 'vispa' ),
		'value' => '',
		'desc'  => esc_html__( 'Enter the link id to the section that you need to scroll', 'vispa' )
	),
);