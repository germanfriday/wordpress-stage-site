<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'unique_id' => array(
		'type' => 'unique'
	),
	'category'       => array(
		'type'    => 'select',
		'value'   => '',
		'label'   => __( 'Portfolio Category', 'vispa' ),
		'desc'    => __( 'Select portfolio category to get posts from', 'vispa' ),
		'choices' => vispa_theme_list_portfolios(),
	),
	'filter'         => array(
		'type'         => 'switch',
		'label'        => __( 'Top Filter', 'vispa' ),
		'desc'         => __( 'Enable top filter?', 'vispa' ),
		'value'        => 'yes',
		'right-choice' => array(
			'value' => 'yes',
			'label' => __( 'Yes', 'vispa' ),
		),
		'left-choice'  => array(
			'value' => 'no',
			'label' => __( 'No', 'vispa' ),
		),
	),
	'spaces'         => array(
		'type'         => 'switch',
		'label'        => __( 'Spaces', 'vispa' ),
		'desc'         => __( 'Enable spaces between items?', 'vispa' ),
		'value'        => 'yes',
		'right-choice' => array(
			'value' => 'yes',
			'label' => __( 'Yes', 'vispa' ),
		),
		'left-choice'  => array(
			'value' => 'no',
			'label' => __( 'No', 'vispa' ),
		),
	),
	'columns'        => array(
		'label'   => esc_html__( 'Columns', 'vispa' ),
		'desc'    => esc_html__( 'Choose the number of columns', 'vispa' ),
		'attr'    => array( 'class' => 'fw-checkbox-float-left' ),
		'type'    => 'radio',
		'value'   => '2',
		'choices' => array(
			'2' => esc_html__( '2 Columns', 'vispa' ),
			'3' => esc_html__( '3 Columns', 'vispa' )
		)
	),
	'posts_per_page' => array(
		'type'  => 'text',
		'value' => get_option( 'posts_per_page' ),
		'label' => __( 'Posts Per Page', 'vispa' ),
		'desc'  => __( 'Posts per page to display', 'vispa' )
	),
	'class'          => array(
		'type'  => 'text',
		'label' => esc_html__( 'Custom Class', 'vispa' ),
		'desc'  => esc_html__( 'Enter a custom CSS class', 'vispa' ),
		'help'  => esc_html__( 'You can use this class to further style this shortcode by adding your custom CSS', 'vispa' ),
	),
);