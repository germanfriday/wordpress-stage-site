<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$vispa_template_directory = get_template_directory_uri();
$map_shortcode            = fw_ext( 'shortcodes' )->get_shortcode( 'map' );

$options = array(
	'unique_id'      => array(
		'type' => 'unique'
	),
	'location_group' => array(
		'type'    => 'group',
		'options' => array(
			'data_provider' => array(
				'type'         => 'multi-picker',
				'label'        => false,
				'desc'         => false,
				'picker'       => array(
					'population_method' => array(
						'label'   => __( 'Population Method', 'vispa' ),
						'desc'    => __( 'Select map population method (Ex: events, custom)', 'vispa' ),
						'type'    => 'select',
						'choices' => $map_shortcode->_get_picker_dropdown_choices(),
					)
				),
				'choices'      => $map_shortcode->_get_picker_choices(),
				'show_borders' => false,
			),
		)
	),
	'map_type'       => array(
		'label'   => __( 'Map Type', 'vispa' ),
		'desc'    => __( 'Select map type', 'vispa' ),
		'type'    => 'image-picker',
		'value'   => '',
		'choices' => array(
			'roadmap'   => array(
				'small' => array(
					'height' => 75,
					'src'    => $vispa_template_directory . '/assets/img/image-picker/map-roadmap.jpg',
				),
				'large' => array(
					'height' => 208,
					'src'    => $vispa_template_directory . '/assets/img/image-picker/map-roadmap.jpg'
				),
			),
			'terrain'   => array(
				'small' => array(
					'height' => 75,
					'src'    => $vispa_template_directory . '/assets/img/image-picker/map-terrain.jpg',
				),
				'large' => array(
					'height' => 208,
					'src'    => $vispa_template_directory . '/assets/img/image-picker/map-terrain.jpg'
				),
			),
			'satellite' => array(
				'small' => array(
					'height' => 75,
					'src'    => $vispa_template_directory . '/assets/img/image-picker/map-satellite.jpg',
				),
				'large' => array(
					'height' => 208,
					'src'    => $vispa_template_directory . '/assets/img/image-picker/map-satellite.jpg'
				),
			),
			'hybrid'    => array(
				'small' => array(
					'height' => 75,
					'src'    => $vispa_template_directory . '/assets/img/image-picker/map-hybrid.jpg',
				),
				'large' => array(
					'height' => 208,
					'src'    => $vispa_template_directory . '/assets/img/image-picker/map-hybrid.jpg'
				),
			),
		),
	),
	'contact_data'   => array(
		'type'    => 'multi-picker',
		'label'   => false,
		'desc'    => false,
		'picker'  => array(
			'selected' => array(
				'type'         => 'switch',
				'label'        => esc_html__( 'Contact Data', 'vispa' ),
				'desc'         => esc_html__( 'Enter contact data', 'vispa' ),
				'value'        => 'no',
				'right-choice' => array(
					'value' => 'yes',
					'label' => esc_html__( 'Yes', 'vispa' ),
				),
				'left-choice'  => array(
					'value' => 'no',
					'label' => esc_html__( 'No', 'vispa' ),
				),
			),
		),
		'choices' => array(
			'yes' => array(
				'address' => array(
					'label' => esc_html__( 'Address', 'vispa' ),
					'desc'  => esc_html__( 'Enter the address', 'vispa' ),
					'type'  => 'text',
				),
				'phone'   => array(
					'label' => esc_html__( 'Phone', 'vispa' ),
					'desc'  => esc_html__( 'Enter the phone', 'vispa' ),
					'type'  => 'text',
				),
				'email'   => array(
					'label' => esc_html__( 'Email', 'vispa' ),
					'desc'  => esc_html__( 'Enter the email', 'vispa' ),
					'type'  => 'text',
				),
			),
		)
	),
	'map_height'     => array(
		'label' => __( 'Map Height', 'vispa' ),
		'desc'  => __( 'Enter the map height in pixels (Ex: 300)', 'vispa' ),
		'type'  => 'short-text',
		'value' => '400',
	),
	'map_pin'        => array(
		'label' => __( 'Map Pin', 'vispa' ),
		'desc'  => __( 'Upload a pin for your location(s) (64x64)', 'vispa' ),
		'type'  => 'upload',
	),
	'map_zoom'       => array(
		'type'       => 'short-slider',
		'value'      => 15,
		'properties' => array(
			'min' => 0,
			'max' => 21,
			'sep' => 1,
		),
		'label'      => __( 'Map Zoom', 'vispa' ),
		'desc'       => __( 'Select map zoom', 'vispa' ),
	),
	'class'          => array(
		'label' => __( 'Custom Class', 'vispa' ),
		'desc'  => __( 'Enter custom CSS class', 'vispa' ),
		'help'  => __( 'You can use this class to further style this shortcode by adding your custom CSS in the <strong>custom.less</strong> file. This file is located on your server in the <strong>/child-theme/styles-less/</strong> folder.', 'vispa' ),
		'type'  => 'text',
		'value' => '',
	),
);