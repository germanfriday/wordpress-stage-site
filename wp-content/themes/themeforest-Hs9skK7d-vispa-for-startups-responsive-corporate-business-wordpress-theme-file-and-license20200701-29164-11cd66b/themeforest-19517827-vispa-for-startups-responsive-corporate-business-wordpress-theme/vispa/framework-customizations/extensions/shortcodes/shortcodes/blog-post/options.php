<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'unique_id'              => array(
		'type' => 'unique'
	),
	'category'               => array(
		'type'       => 'multi-select',
		'value'      => array(),
		'label'      => esc_html__( 'Blog Categories', 'vispa' ),
		'desc'       => esc_html__( 'Select blog categeries by start typing category title', 'vispa' ),
		/**
		 * Set population method
		 * Are available: 'posts', 'taxonomy', 'users', 'array'
		 */
		'population' => 'taxonomy',
		/**
		 * Set post types, taxonomies, user roles to search for
		 *
		 * 'population' => 'posts'
		 * 'source' => 'page',
		 *
		 * 'population' => 'taxonomy'
		 * 'source' => 'category',
		 *
		 * 'population' => 'users'
		 * 'source' => array( 'editor', 'subscriber', 'author' ),
		 *
		 * 'population' => 'array'
		 * 'source' => '' // will populate with 'choices' array
		 */
		'source'     => 'category',
		//'prepopulate' => 1,
		/**
		 * Set maximum items number that can be selected
		 */
		//'limit' => 1,
	),
	'posts_view_type'        => array(
		'type'    => 'short-select',
		'value'   => 'yes',
		'label'   => esc_html__( 'Posts View Type', 'vispa' ),
		'desc'    => esc_html__( 'Select the posts view type', 'vispa' ),
		'choices' => array(
			'list'   => esc_html__( 'List', 'vispa' ),
			'grid-1' => esc_html__( 'Grid 1', 'vispa' ),
			'grid-2' => esc_html__( 'Grid 2', 'vispa' ),
		),
	),
	'posts_per_page'         => array(
		'type'  => 'short-text',
		'value' => get_option( 'posts_per_page' ),
		'label' => __( 'Posts Per Page', 'vispa' ),
		'desc'  => __( 'Posts per page to display', 'vispa' )
	),
	'enable-post-date'       => array(
		'type'         => 'switch',
		'value'        => 'yes',
		'label'        => esc_html__( 'Enable Date', 'vispa' ),
		'desc'         => esc_html__( 'Enable posts date.', 'vispa' ),
		'left-choice'  => array(
			'value' => 'no',
			'label' => esc_html__( 'No', 'vispa' ),
		),
		'right-choice' => array(
			'value' => 'yes',
			'label' => esc_html__( 'Yes', 'vispa' ),
		),
	),
	'enable-post-categories' => array(
		'type'         => 'switch',
		'value'        => 'yes',
		'label'        => esc_html__( 'Enable Categories', 'vispa' ),
		'desc'         => esc_html__( 'Enable posts categories.', 'vispa' ),
		'help'         => esc_html__( 'This option is not available to List type', 'vispa' ),
		'left-choice'  => array(
			'value' => 'no',
			'label' => esc_html__( 'No', 'vispa' ),
		),
		'right-choice' => array(
			'value' => 'yes',
			'label' => esc_html__( 'Yes', 'vispa' ),
		),
	),
	'class'                  => array(
		'type'  => 'text',
		'label' => esc_html__( 'Custom Class', 'vispa' ),
		'desc'  => esc_html__( 'Enter a custom CSS class', 'vispa' ),
		'help'  => esc_html__( 'You can use this class to further style this shortcode by adding your custom CSS', 'vispa' ),
	),
);