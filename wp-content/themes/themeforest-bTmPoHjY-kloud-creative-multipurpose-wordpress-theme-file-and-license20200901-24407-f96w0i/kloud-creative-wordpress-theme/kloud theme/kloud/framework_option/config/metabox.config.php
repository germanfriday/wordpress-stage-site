<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// METABOX OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options = array();

if ( isset( $_GET['post'] ) && $_GET['post'] == get_option( 'page_for_posts' ) ) return;

// -----------------------------------------
// Page Metabox Options                    -
// -----------------------------------------
$options[] = array(
	'id'        => '_custom_page_options',
	'title'     => esc_html__( 'Page Layout Options','kloud'),
	'post_type' => 'page',
	'context'   => 'normal',
	'priority'  => 'high',
	'sections'  => array(
		array(
			'name'  => 's1',
			'fields' => array(
                    array(
            			'type'    => 'subheading',
            			'content' => esc_html__( 'Header Setting', 'kloud' ),
            		),
                	array(
        			'id'    => 'header-layout',
        			'type'  => 'image_select',
        			'title' => esc_html__( 'Layout Header', 'kloud' ),
        			'radio' => true,
        			'options' => array(
			         '1' => CS_URI . '/assets/images/layout/Header-1.jpg',
			         '2' => CS_URI . '/assets/images/layout/left-sidebar.jpg',
        			),
        			'default'    => '1',
        			'attributes' => array(
        				'data-depend-id' => 'header-layout',
        			),
        		),
                 array(
            			'id'      => 'background_sticky_header',
            			'type'    => 'color_picker',
            			'title'   => esc_html__( 'Background Stiky Header', 'kloud' ),
            			'default' => '#000000',
        		),
                array(
            			'type'    => 'subheading',
            			'content' => esc_html__( 'Footer Setting', 'kloud' ),
            		),
                	array(
        			'id'    => 'footer-layout',
        			'type'  => 'image_select',
        			'title' => esc_html__( 'Layout Footer', 'kloud' ),
        			'radio' => true,
        			'options' => array(
        				'1' => CS_URI . '/assets/images/layout/Footer-6.jpg',
        				'2' => CS_URI . '/assets/images/layout/Footer-2.jpg',
                        '3' => CS_URI . '/assets/images/layout/Footer-3.jpg',
                        '4' => CS_URI . '/assets/images/layout/Footer-4.jpg',
                        '5' => CS_URI . '/assets/images/layout/Footer-5.jpg',
                        '6' => CS_URI . '/assets/images/layout/Footer-1.jpg',
                        '7' => CS_URI . '/assets/images/layout/Footer-2.jpg',
        			),
        			'default'    => '6',
        			'attributes' => array(
        				'data-depend-id' => 'footer-layout',
        			),
        		  ),
                    array(
                    	'id'      => 'sticky_footer',
                    	'type'    => 'switcher',
                    	'title'   => esc_html__( 'Enable Sticky Footer', 'kloud' ),
                    	'default' =>  false,
                   	),
                	array(
            			'type'    => 'subheading',
            			'content' => esc_html__( 'Main Color', 'kloud' ),
            		),
                 	array(
            			'id'      => 'primary-color-cutom',
            			'type'    => 'color_picker',
            			'title'   => esc_html__( 'Primary Color', 'kloud' ),
            			'desc'    => esc_html__( 'Main Color Scheme', 'kloud' ),
            			'default' => '#43cea2',
            		),
                    array(
            			'id'      => 'primary-color-cutom2',
            			'type'    => 'color_picker',
            			'title'   => esc_html__( 'Primary Color 2', 'kloud' ),
            			'desc'    => esc_html__( 'Main Color Scheme 2', 'kloud' ),
            			'default' => '#185b9d',
            		),
                    	array(
            			'type'    => 'subheading',
            			'content' => esc_html__( 'Logo Color', 'kloud' ),
            		),
            		array(
            			'id'      => 'logo_color',
            			'type'    => 'color_picker',
            			'title'   => esc_html__( 'Logo Color 1', 'kloud' ),
            			'desc'    => esc_html__( 'Color 1', 'kloud' ),
            			'default' => '#43cea2',
            		),
             	    array(
            			'id'      => 'logo_color2',
            			'type'    => 'color_picker',
            			'title'   => esc_html__( 'Logo Color 1', 'kloud' ),
            			'desc'    => esc_html__( 'Color 2', 'kloud' ),
            			'default' => '#185b9d',
            		),
                     array(
            			'type'    => 'subheading',
            			'content' => esc_html__( 'Top Menu Color', 'kloud' ),
            		),
                    array(
            			'id'      => 'top_menu_color',
            			'type'    => 'color_picker',
            			'title'   => esc_html__( 'Top Menu Color', 'kloud' ),
            			'default' => '#ffffff',
            		),
                     array(
            			'id'      => 'top_menu_hover_color',
            			'type'    => 'color_picker',
            			'title'   => esc_html__( 'Top Menu Hover Color', 'kloud' ),
            			'default' => '#43cea2',
            		),
             	    array(
            			'type'    => 'subheading',
            			'content' => esc_html__( 'Sub Menu Color', 'kloud' ),
            		),
            		array(
            			'id'    => 'sub_menu_color',
            			'type'  => 'color_picker',
            			'title' => esc_html__( 'Sub Menu Color', 'kloud' ),
                        'default' => '#68686d',
            		),
                    
                    array(
                    	'id'      => 'show_cart',
                    	'type'    => 'switcher',
                    	'title'   => esc_html__( 'Enable Mini Cart', 'kloud' ),
                    	'default' =>  true,
                   	),
                    array(
                    	'id'      => 'show_search',
                    	'type'    => 'switcher',
                    	'title'   => esc_html__( 'Enable Search', 'kloud' ),
                    	'default' =>  true,
                   	),
                    array(
                    	'id'      => 'show_shortcode',
                    	'type'    => 'switcher',
                    	'title'   => esc_html__( 'Enable Shortcode', 'kloud' ),
                    	'default' =>  false,
                   	),
                    array(
            			'type'    => 'subheading',
            			'content' => esc_html__( 'Title Bar Cutom', 'kloud' ),
            		),
                    array(
                	'id'      => 'page_title',
                	'type'    => 'switcher',
                	'title'   => esc_html__( 'Enable Page Title', 'kloud' ),
                	'default' =>  false,
                	),
                     array(
                	'id'         => 'page_title_pg',
                	'type'       => 'background',
                	'title'      => esc_html__( 'Page Title Background', 'kloud' ),
                    'dependency' => array( 'page_title', '==', true ),
                    'default'      => array(
                        'image'      => get_template_directory_uri() .'/assets/images/title_bar.jpg',
                        'repeat'     => 'no-repeat',
                        'position'   => 'center center',
                        'attachment' => 'fixed',
                        'size'       => 'cover',
                        'color'      => '#ffffff',
                      ),
	                ),
                   
			),
		),
	),
);

// -----------------------------------------
// Product Metabox Options                    -
// -----------------------------------------
$attributes = array();
	if ( function_exists( 'wc_get_attribute_taxonomies' ) ) {
	$attributes_tax = wc_get_attribute_taxonomies();
	foreach ( $attributes_tax as $attribute ) {
	$attributes[ $attribute->attribute_name ] = $attribute->attribute_label;	
	}
}	
$options[] = array(
	'id'        => '_custom_wc_options',
	'title'     => esc_html__( 'Product Detail Layout Options', 'kloud'),
	'post_type' => 'product',
	'context'   => 'normal',
	'priority'  => 'high',
	'sections'  => array(
		array(
			'name'  => 's2',
			'fields' => array(
				array(
					'id'    => 'wc-single-style',
					'type'  => 'image_select',
					'title' => esc_html__( 'Product Detail Style', 'kloud' ),
					'options' => array(
						    '1' => CS_URI . '/assets/images/layout/thumbnail-bottom.jpg',
							'2' => CS_URI . '/assets/images/layout/layout-1.jpg',
							'3' => CS_URI . '/assets/images/layout/layout-2.jpg',
							'4' => CS_URI . '/assets/images/layout/layout-3.jpg',
					),
				),
				array(
					   'id'      => 'wc-thumbnail-position',
						'type'    => 'image_select',
					       'title'      => esc_html__( 'Thumbnail Position', 'kloud' ),
                            'options' => array(
                            'left'    => CS_URI . '/assets/images/layout/thumbnail-left.jpg',
							'bottom'  => CS_URI . '/assets/images/layout/thumbnail-bottom-right-sidebar.jpg',
							'right'   => CS_URI . '/assets/images/layout/thumbnail-right.jpg',
							'outside' => CS_URI . '/assets/images/layout/thumbnail-outside.jpg',
						),
						'default'    => 'left',
						'dependency' => array( 'wc-single-style_1', '==', true ),
				),
                	array(
						'id'      => 'enble-sidebar',
						'type'    => 'switcher',
						'title'   => esc_html__( 'Enble sidebar', 'kloud' ),
						'default' => false,
                        'dependency' => array( 'wc-single-style_1', '==', true ),
					),
                    array(
						'id'         => 'wc-sidebar-detail',
						'type'       => 'select',
                        'options'    => jws_get_sidebars(),
						'title'      => esc_html__( 'Select Sidebar', 'kloud' ),
						'dependency' => array( 'enble-sidebar', '==', true ),
					),
				array(
					'id'         => 'wc-single-video-url',
					'type'       => 'text',
					'title'      => esc_html__( 'Video Thumbnail Link', 'kloud' ),
				),
				array(
					'title' => esc_html__( 'Size Guide Image','kloud'),
					'id'    => 'wc-single-size-guide',
					'type'  => 'upload',
				),
                array(
					'title' => esc_html__( 'Banner Product','kloud'),
					'id'    => 'wc-single-banner',
					'type'  => 'upload',
				),
                array(
					'title' => esc_html__( 'Link Banner','kloud'),
					'id'    => 'wc-single-banner-link',
					'type'  => 'text',
				),
                array(
                  'id'          => 'gallery_2',
                  'type'        => 'gallery',
                  'title'       => 'Image 360',
                  'add_title'   => 'Add Images',
                  'edit_title'  => 'Edit Images',
                  'clear_title' => 'Remove Images',
                ),
                array(
					'id'         => 'wc-count-down',
					'type'       => 'text',
					'title'      => esc_html__( 'Add time count down for product  example: 2018/12/12 ', 'kloud' ),
				),
                array(
						'id'      => 'wc-attr',
						'type'    => 'checkbox',
						'title'   => esc_html__( 'Enable Products Attribute On Product List', 'kloud' ),
						'options' => $attributes,
				),	
			),
		),
	),
);
// -----------------------------------------
// Product Metabox Options                    -
// -----------------------------------------
$options[] = array(
	'id'        => '_custom_post_options',
	'title'     => esc_html__( 'Post Detail Layout Options', 'kloud'),
	'post_type' => 'post',
	'context'   => 'normal',
	'priority'  => 'high',
	'sections'  => array(
		array(
			'name'  => 's2',
			'fields' => array(
				array(
					'id'    => 'post-single-style',
					'type'  => 'image_select',
					'title' => esc_html__( 'Post Detail Style', 'kloud' ),
					'info'  => sprintf( __( 'Change layout for only this post. You can setup global for all post page layout', 'kloud' ), esc_url( admin_url( 'admin.php?page=jws-theme-options' ) ) ),
					'options' => array(
						'1' => CS_URI . '/assets/images/layout/left-sidebar.jpg',
                    	'2' => CS_URI . '/assets/images/layout/3-col.jpg',
                    	'3' => CS_URI . '/assets/images/layout/right-sidebar.jpg',
					),
				),
			),
		),
	),
);
// -----------------------------------------
// Product Metabox Options                    -
// -----------------------------------------
$options[] = array(
	'id'        => '_custom_pp_options',
	'title'     => esc_html__( 'Portfolio Detail Layout Options', 'kloud'),
	'post_type' => 'portfolio',
	'context'   => 'normal',
	'priority'  => 'high',
	'sections'  => array(
		array(
			'name'  => 's2',
			'fields' => array(    
              array(
                  'id'       => 'column_metro',
                  'type'     => 'select',
                  'title'    => 'Column Metro',
                  'options'  => array(
                    '1'  => '1 Columns',
                    '2'   => '2 Columns',
                    '3' => '3 Columns',
                    '4' => '4 Columns',
                    '5' => '5 Columns',
                    '6' => '6 Columns',
                  ),
                  'default'  => '4',
              ),
              array(
					'title' => esc_html__( 'Height Metro','kloud'),
					'id'    => 'pp_height',
					'type'  => 'text',
				),
             array(
					'title' => esc_html__( 'Client','kloud'),
					'id'    => 'pp_client',
					'type'  => 'text',
			 ),   
              array(
					'title' => esc_html__( 'Project Type','kloud'),
					'id'    => 'pp_type',
					'type'  => 'text',
			 ), 
             array(
					'title' => esc_html__( 'Project Description','kloud'),
					'id'    => 'pp_description',
					'type'  => 'wysiwyg',
                    'settings' => array(
                    'textarea_rows' => 5,
                    'tinymce'       => true,
                    'media_buttons' => true,
                  )
			 ), 
   	         array(
						'type'    => 'heading',
						'content' => esc_html__( 'Single Layout', 'kloud' ),
					),    
    	     array(
						'id'    => 'pp-single-style',
						'type'  => 'image_select',
						'title' => esc_html__( 'Style', 'kloud' ),
						'radio' => true,
						'options' => array(
							'layout1'    => CS_URI . '/assets/images/layout/Lb-big-image.jpg',
							'layout2' => CS_URI . '/assets/images/layout/Lb-small-image.jpg',
						),
						'default' => 'layout1',
				),       
			),
		),
	),
);
$options[] = array(
	'id'        => '_custom_wc_thumb_options',
	'title'     => esc_html__( 'Custom Size For Image Thumbnail', 'kloud'),
	'post_type' => array( 'product' , 'portfolio' ),
	'context'   => 'side',
	'priority'  => 'default',
	'sections'  => array(
		array(
			'name'  => 's3',
			'fields' => array(
				array(
					'id'      => 'wc-thumbnail-size',
					'type'    => 'switcher',
					'title'   => esc_html__( 'Enable Big Image', 'kloud' ),
					'desc'    => esc_html__( 'Apply for Product Layout Metro And Portdolio Metro', 'kloud' ),
					'default' => false
				),
			),
           
		),
	),
    );


CSFramework_Metabox::instance( $options );
