<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK SETTINGS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$settings = array(
	'menu_title'     => esc_html__( 'Theme Options', 'kloud' ),
	'menu_parent'    => 'jws',
	'menu_type'      => 'menu',
	'menu_slug'      => 'jws-theme-options',
	'show_reset_all' => true,
	'ajax_save'      => true
);



// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options = array();

// ----------------------------------------
// a option section for options layout    -
// ----------------------------------------
$options[] = array(
	'name'  => 'layout',
	'title' => esc_html__( 'General Layout', 'kloud' ),
	'icon'  => 'fa fa-cog',
	'fields' => array(
             array(
        	'id'      => 'golobal-enable-less',
        	'type'    => 'switcher',
        	'title'   => esc_html__( 'Enable Less Design', 'kloud' ),
        	'default' =>  false,
        	),
            array(
        	'id'      => 'golobal-enable-page-title2',
        	'type'    => 'switcher',
        	'title'   => esc_html__( 'Enable Page Title', 'kloud' ),
        	'default' =>  true,
        	),
            array(
        	'id'         => 'golobal-enable-page-title-bg',
        	'type'       => 'background',
        	'title'      => esc_html__( 'Page Title Background', 'kloud' ),
            'dependency' => array( 'golobal-enable-page-title2', '==', true ),
        	),
            array(
			'id'        => 'padding-top',
			'type'      => 'text',
			'title'     => esc_html__( 'Padding Top', 'kloud' ),
            'dependency' => array( 'golobal-enable-page-title2', '==', true ),
            'default' => '100px',
		    ),
            array(
			'id'        => 'padding-bottom',
			'type'      => 'text',
			'title'     => esc_html__( 'Padding Bottom', 'kloud' ),
            'dependency' => array( 'golobal-enable-page-title2', '==', true ),
            'default' => '100px',
		    ),
            array(
			'id'        => 'title-size',
			'type'      => 'text',
			'title'     => esc_html__( 'Font Size', 'kloud' ),
            'dependency' => array( 'golobal-enable-page-title2', '==', true ),
            'default' => '60px',
		    ),
            array(
              'id'      => 'title-color',
              'type'    => 'color_picker',
              'title'   => 'Title Color',
              'default' => '#43cea2',
            ),  
		
	),
);


// ----------------------------------------
// a option section for options rr    -
// ----------------------------------------
$options[] = array(
	'name'  => 'header',
	'title' => esc_html__( 'Header', 'kloud' ),
	'icon'  => 'fa fa-header',
	'fields' => array(
		array(
			'id'    => 'header-layout',
			'type'  => 'image_select',
			'title' => esc_html__( 'Layout', 'kloud' ),
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
			'id'         => 'header-bg',
			'type'       => 'background',
			'title'      => esc_html__( 'Background', 'kloud' ),
			'dependency' => array( 'header-layout', 'any', 5 ),
		),
       array(
      'id'        => 'logo_st',
      'type'      => 'fieldset',
      'title'     => 'Logo Setting',
      'un_array'  => true,
      'fields'    => array(
		array(
			'id'        => 'logo',
			'type'      => 'image',
			'title'     => esc_html__( 'Logo', 'kloud' ),
			'add_title' => esc_html__( 'Upload', 'kloud' ),
		),
        array(
			'id'        => 'logo_text',
			'type'      => 'text',
			'title'     => esc_html__( 'Logo Text', 'kloud' ),
		),
        array(
			'id'        => 'favicon',
			'type'      => 'image',
			'title'     => esc_html__( 'Favicon Icon', 'kloud' ),
			'add_title' => esc_html__( 'Upload', 'kloud' ),
		),
		array(
			'id'      => 'logo-max-width',
			'type'    => 'text',
			'title'   => esc_html__( 'Logo Max Width', 'kloud' ),
			'default' => 200,
			'desc'    => esc_html__( 'Defined in pixels. Do not add the \'px\' unit.', 'kloud' ),
		),
        array(
			'id'      => 'logo-light-height',
			'type'    => 'text',
			'title'   => esc_html__( 'Logo Line Height', 'kloud' ),
			'default' => 82,
			'desc'    => esc_html__( 'Defined in pixels. Do not add the \'px\' unit.', 'kloud' ),
		),
      )),  
       array(
      'id'        => 'menu_right',
      'type'      => 'fieldset',
      'title'     => 'Menu Right',
      'un_array'  => true,
      'fields'    => array(   
        array(
			'id'      => 'right-header-light-height',
			'type'    => 'text',
			'title'   => esc_html__( 'Right Header Height', 'kloud' ),
			'default' => 82,
			'desc'    => esc_html__( 'Defined in pixels. Do not add the \'px\' unit.', 'kloud' ),
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
			'id'         => 'header-menu-right',
			'type'       => 'textarea',
			'title'      => esc_html__( 'Content Shortcode Right Menunu', 'kloud' ),
			'desc'       => esc_html__( 'HTML, shortcode is allowed', 'kloud' ),
			'dependency' => array( 'show_shortcode', '==', true ),
		),
        )),
        array(
        	'id'         => 'header_bg',
        	'type'       => 'background',
        	'title'      => esc_html__( 'Background Header Verticle', 'kloud' ),
            'default'      => array(
            'image'      => get_template_directory_uri() .'/assets/images/bg_header.jpg',
            'repeat'     => 'repeat-x',
            'position'   => 'center center',
            'attachment' => 'fixed',
            'size'       => 'cover',
            'color'      => '#ffffff',
          ),
       	),
	),
);

// ----------------------------------------
// a option section for options footer    -
// ----------------------------------------
$options[] = array(
	'name'  => 'footer',
	'title' => esc_html__( 'Footer', 'kloud' ),
	'icon'  => 'fa fa-sitemap',
	'fields' => array(
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
			'id'      => 'footer-1',
			'type'    => 'textarea',
			'title'   => esc_html__( 'Content Footer One', 'kloud' ),
			'desc'    => esc_html__( 'Add Html Or Shortcode Here', 'kloud' ).'<p><a target="_blank" href="'.esc_url(  admin_url('/edit.php?post_type=visual_content') ).'">Link Content Shortcode</a></p>',
			'default' => '[vc_content id="52"]',
		),
        array(
			'id'      => 'footer-2',
			'type'    => 'textarea',
			'title'   => esc_html__( 'Content Footer Two', 'kloud' ),
			'desc'    => esc_html__( 'Add Html Or Shortcode Here', 'kloud' ).'<p><a target="_blank" href="'.esc_url(  admin_url('/edit.php?post_type=visual_content') ).'">Link Content Shortcode</a></p>',
			'default' => '[vc_content id="536"]',
		),
        array(
			'id'      => 'footer-3',
			'type'    => 'textarea',
			'title'   => esc_html__( 'Content Footer Three', 'kloud' ),
			'desc'    => esc_html__( 'Add Html Or Shortcode Here', 'kloud' ).'<p><a target="_blank" href="'.esc_url(  admin_url('/edit.php?post_type=visual_content') ).'">Link Content Shortcode</a></p>',
			'default' => '[vc_content id="556"]',
		),
        array(
			'id'      => 'footer-4',
			'type'    => 'textarea',
			'title'   => esc_html__( 'Content Footer four', 'kloud' ),
			'desc'    => esc_html__( 'Add Html Or Shortcode Here', 'kloud' ).'<p><a target="_blank" href="'.esc_url(  admin_url('/edit.php?post_type=visual_content') ).'">Link Content Shortcode</a></p>',
			'default' => '[vc_content id="768"]',
		),
        array(
			'id'      => 'footer-5',
			'type'    => 'textarea',
			'title'   => esc_html__( 'Content Footer five', 'kloud' ),
			'desc'    => esc_html__( 'Add Html Or Shortcode Here', 'kloud' ).'<p><a target="_blank" href="'.esc_url(  admin_url('/edit.php?post_type=visual_content') ).'">Link Content Shortcode</a></p>',
			'default' => '[vc_content id="829"]',
		),
        array(
			'id'      => 'footer-6',
			'type'    => 'textarea',
			'title'   => esc_html__( 'Content Footer six', 'kloud' ),
			'desc'    => esc_html__( 'Add Html Or Shortcode Here', 'kloud' ).'<p><a target="_blank" href="'.esc_url(  admin_url('/edit.php?post_type=visual_content') ).'">Link Content Shortcode</a></p>',
			'default' => '[vc_content id="838"]',
		),
        array(
			'id'      => 'footer-7',
			'type'    => 'textarea',
			'title'   => esc_html__( 'Content Footer Seven', 'kloud' ),
			'desc'    => esc_html__( 'Add Html Or Shortcode Here', 'kloud' ).'<p><a target="_blank" href="'.esc_url(  admin_url('/edit.php?post_type=visual_content') ).'">Link Content Shortcode</a></p>',
			'default' => '[vc_content id="1396"]',
		),
        array(
        	'id'      => 'sticky_footer',
        	'type'    => 'switcher',
        	'title'   => esc_html__( 'Enable Sticky Footer', 'kloud' ),
        	'default' =>  false,
       	),
	),
);
// ----------------------------------------
// a option section for options typography-
// ----------------------------------------
$options[] = array(
	'name'  => 'typography',
	'title' => esc_html__( 'Typography', 'kloud' ),
	'icon'  => 'fa fa-font',
	'fields' => array(
       array(
      'id'        => 'font_family',
      'type'      => 'fieldset',
      'title'     => 'Font Family',
      'un_array'  => true,
      'fields'    => array(
		array(
			'id'        => 'body-font',
			'type'      => 'typography',
			'title'     => esc_html__( 'Body Font Family', 'kloud' ),
			'default'   => array(
				'family'  => 'Poppins',
				'font'    => 'google',
				'variant' => 'regular',
			),
		),
        array(
			'id'        => 'heading-font',
			'type'      => 'typography',
			'title'     => esc_html__( 'Heading Font Family', 'kloud' ),
			'default'   => array(
				'family'  => 'Poppins',
				'font'    => 'google',
				'variant' => '600',
			),
		),
        )),
      array(
      'id'        => 'font_size',
      'type'      => 'fieldset',
      'title'     => 'Font Size',
      'un_array'  => true,
      'fields'    => array(
		array(
			'id'      => 'body-font-size',
			'type'    => 'number',
			'title'   => esc_html__( 'Body', 'kloud' ),
			'after'   => ' <i class="cs-text-muted">px</i>',
			'default' => 14
		),
		array(
			'id'      => 'h1-font-size',
			'type'    => 'number',
			'title'   => esc_html__( 'H1', 'kloud' ),
			'after'   => ' <i class="cs-text-muted">px</i>',
			'default' => '48'
		),
		array(
			'id'      => 'h2-font-size',
			'type'    => 'number',
			'title'   => esc_html__( 'H2', 'kloud' ),
			'after'   => ' <i class="cs-text-muted">px</i>',
			'default' => '36'
		),
		array(
			'id'      => 'h3-font-size',
			'type'    => 'number',
			'title'   => esc_html__( 'H3', 'kloud' ),
			'after'   => ' <i class="cs-text-muted">px</i>',
			'default' => '24'
		),
		array(
			'id'      => 'h4-font-size',
			'type'    => 'number',
			'title'   => esc_html__( 'H4', 'kloud' ),
			'after'   => ' <i class="cs-text-muted">px</i>',
			'default' => '21'
		),
		array(
			'id'      => 'h5-font-size',
			'type'    => 'number',
			'title'   => esc_html__( 'H5', 'kloud' ),
			'after'   => ' <i class="cs-text-muted">px</i>',
			'default' => '18'
		),
		array(
			'id'      => 'h6-font-size',
			'type'    => 'number',
			'title'   => esc_html__( 'H6', 'kloud' ),
			'after'   => ' <i class="cs-text-muted">px</i>',
			'default' => '16'
		),
        )),
	),
);

// ------------------------------------------
// a option section for options color_scheme-
// ------------------------------------------
$options[] = array(
	'name'  => 'color_scheme',
	'title' => esc_html__( 'Color Scheme', 'kloud' ),
	'icon'  => 'fa fa-picture-o',
	'fields' => array(
       array(
      'id'        => 'ft_main_color',
      'type'      => 'fieldset',
      'title'     => 'Main Color',
      'un_array'  => true,
      'fields'    => array(
		array(
			'id'      => 'primary-color',
			'type'    => 'color_picker',
			'title'   => esc_html__( 'Primary Color', 'kloud' ),
			'desc'    => esc_html__( 'Main Color Scheme', 'kloud' ),
			'default' => '#43cea2',
		),
        array(
			'id'      => 'primary-color-2',
			'type'    => 'color_picker',
			'title'   => esc_html__( 'Primary Color 2', 'kloud' ),
			'desc'    => esc_html__( 'Main Color Scheme 2', 'kloud' ),
			'default' => '#185a9d',
		),
      )), 
      array(
      'id'        => 'ft_section_color',
      'type'      => 'fieldset',
      'title'     => 'Section Color',
      'un_array'  => true,
      'fields'    => array(  
		array(
			'id'      => 'body-background-color',
			'type'    => 'color_picker',
			'title'   => esc_html__( 'Body Background Color', 'kloud' ),
			'default' => '#fff',
		),
		array(
			'id'      => 'body-color',
			'type'    => 'color_picker',
			'title'   => esc_html__( 'Body Color', 'kloud' ),
			'default' => '#68686d',
		),
		array(
			'id'      => 'heading-color',
			'type'    => 'color_picker',
			'title'   => esc_html__( 'Heading Color', 'kloud' ),
			'default' => '#222',
		),
        )),
	   array(
      'id'        => 'ft_header_color',
      'type'      => 'fieldset',
      'title'     => 'Header Color',
      'un_array'  => true,
      'fields'    => array(  
		array(
			'id'    => 'header-background',
			'type'  => 'color_picker',
			'title' => esc_html__( 'Header Background Color', 'kloud' ),
		),
         array(
		      'id'      => 'background_sticky_header',
		      'type'    => 'color_picker',
		      'title'   => esc_html__( 'Background Stiky Header', 'kloud' ),
		      'default' => '#232323',
		),
     )), 
       array (
      'id'        => 'ft_menu_color',
      'type'      => 'fieldset',
      'title'     => 'Menu Color',
      'un_array'  => true,
      'fields'    => array(    
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
        )),
	),
);
// ----------------------------------------
// a option section for options woocommerce-
// ----------------------------------------
if ( class_exists( 'WooCommerce' ) ) {
	$attributes = array();
	$attributes_tax = wc_get_attribute_taxonomies();
	foreach ( $attributes_tax as $attribute ) {
		$attributes[ $attribute->attribute_name ] = $attribute->attribute_label;
	}
	$options[]  = array(
		'name'  => 'woocommerce',
		'title' => esc_html__( 'WooCommerce', 'kloud' ),
		'icon'  => 'fa fa-shopping-cart',
		'sections' => array(



			// Product Listing Setting
			array(
				'name'   => 'wc_list_setting',
				'title'  => esc_html__( 'Product Shop Setting', 'kloud' ),
				'icon'   => 'fa fa-minus',
				'fields' => array(
					array(
						'type'    => 'heading',
						'content' => esc_html__( 'Product Listing', 'kloud' ),
					),
                      array(
                      'id'        => 'woo_title_bar',
                      'type'      => 'fieldset',
                      'title'     => 'Title Bar',
                      'un_array'  => true,
                      'fields'    => array(
    	           array(
						'id'      => 'wc-enable-page-title',
						'type'    => 'switcher',
						'title'   => esc_html__( 'Enable Page Title', 'kloud' ),
						'default' =>  false,
					),
					array(
						'id'         => 'wc-pagehead-bg',
						'type'       => 'background',
						'title'      => esc_html__( 'Page Title Background', 'kloud' ),
						'dependency' => array( 'wc-enable-page-title', '==', true ),
					),
                    )),
					array(
                      'id'        => 'woo_layout',
                      'type'      => 'fieldset',
                      'title'     => 'Layout',
                      'un_array'  => true,
                      'fields'    => array(
					array(
						'id'    => 'wc-style',
						'type'  => 'image_select',
						'title' => esc_html__( 'Layout', 'kloud' ),
						'desc'  => esc_html__( 'Display product listing as grid or masonry or metro', 'kloud' ),
						'radio' => true,
						'options' => array(
							'grid'    => CS_URI . '/assets/images/layout/left-sidebar.jpg',
							'masonry' => CS_URI . '/assets/images/layout/masonry-2.jpg',
							'metro'   => CS_URI . '/assets/images/layout/masonry-1.jpg'
						),
						'default' => 'grid',
					),
                    array(
						'id'    => 'wc-layout',
						'type'  => 'image_select',
						'title' => esc_html__( 'Sidebar Or Non Sidebar', 'kloud' ),
						'radio' => true,
						'options' => array(
							'left-sidebar'  => CS_URI . '/assets/images/layout/left-sidebar.jpg',
							'no-sidebar'    => CS_URI . '/assets/images/layout/3-col.jpg',
							'right-sidebar' => CS_URI . '/assets/images/layout/right-sidebar.jpg',
						),
						'default' => 'no-sidebar'
					),
                    	array(
						'id'    => 'wc-column',
						'type'  =>'image_select',
						'title' => esc_html__( 'Number Column', 'kloud' ),
						'desc'  => esc_html__( 'Display number of product per row', 'kloud' ),
						'radio' => true,
						'options' => array(
							'6' => CS_URI . '/assets/images/layout/2-col.jpg',
							'4' => CS_URI . '/assets/images/layout/3-col.jpg',
							'3' => CS_URI . '/assets/images/layout/4-col.jpg',
                            '20' => CS_URI . '/assets/images/layout/5-col-wide.jpg',
							'2' => CS_URI . '/assets/images/layout/6-col-wide.jpg',
						),
						'default' => '4'
					),
                    array(
						'id'      => 'wc-layout-full',
						'type'    => 'switcher',
						'title'   => esc_html__( 'Enable Full-Width', 'kloud' ),
						'default' => false,
					),
                    )),
                    array(
                      'id'        => 'woo_orther',
                      'type'      => 'fieldset',
                      'title'     => 'Orther Setting',
                      'un_array'  => true,
                      'fields'    => array(
					array(
						'id'         => 'wc-pagination',
						'type'       => 'select',
						'title'      => esc_html__( 'Pagination Style', 'kloud' ),
						'options' => array(
							'number'   => esc_html__( 'Number', 'kloud' ),
							'loadmore' => esc_html__( 'Load More', 'kloud' ),
						),
						'default' => 'number'
					),
                    array(
						'id'      => 'wc-action-columns',
						'type'    => 'switcher',
						'title'   => esc_html__( 'On / Off Filter Columns', 'kloud' ),
						'default' => false,
					),
					array(
                      'id'        => 'shop-column-filter',
                      'type'      => 'fieldset',
                      'title'     => 'Shop Columns Filter',
                      'dependency' => array( 'wc-action-columns', '==', true ),
                      'fields'    => array(
                       array(
						'id'      => 'wc-2',
						'type'    => 'switcher',
						'title'   => esc_html__( 'Turn On 2 columns', 'kloud' ),
						'default' => false,
                        'dependency' => array( 'wc-action-columns', '==', true ),
					   ),
                       array(
						'id'      => 'wc-3',
						'type'    => 'switcher',
						'title'   => esc_html__( 'Turn On 3 columns', 'kloud' ),
						'default' => false,
                        'dependency' => array( 'wc-action-columns', '==', true ),
					   ),
                       array(
						'id'      => 'wc-4',
						'type'    => 'switcher',
						'title'   => esc_html__( 'Turn On 4 columns', 'kloud' ),
						'default' => false,
                        'dependency' => array( 'wc-action-columns', '==', true ),
					   ),
                       array(
						'id'      => 'wc-5',
						'type'    => 'switcher',
						'title'   => esc_html__( 'Turn On 5 columns', 'kloud' ),
						'default' => false,
                        'dependency' => array( 'wc-action-columns', '==', true ),
					   ),
                       array(
						'id'      => 'wc-6',
						'type'    => 'switcher',
						'title'   => esc_html__( 'Turn On 6 columns', 'kloud' ),
						'default' => false,
                        'dependency' => array( 'wc-action-columns', '==', true ),
					   ),
                    
                      ),
                    ),
                    array(
						'id'      => 'wc-action-filter',
						'type'    => 'switcher',
						'title'   => esc_html__( 'On / Off Filter Product', 'kloud' ),
						'default' => false,
					),
                     array(
						'id'         => 'wc-filter-topbar-columns',
						'type'       => 'select',
                        'options'        => array(
                            '1'          => '1 Columns',
                            '2'     => '2 Columns',
                            '3'         => '3 Columns',
                            '4'         => '4 Columns',
                            '5'         => '5 Columns',
                            '6'         => '6 Columns',
                          ),
						'title'      => esc_html__( 'Select Sidebar', 'kloud' ),
						'dependency' => array( 'wc-action-filter', '==', true ),
					),
					array(
						'id'      => 'wc-number-per-page',
						'type'    => 'number',
						'title'   => esc_html__( 'Per Page', 'kloud' ),
						'desc'    => esc_html__( 'How much items per page to show (-1 to show all products)', 'kloud' ),
						'default' => '12',
					),
					array(
						'id'         => 'wc-sidebar',
						'type'       => 'select',
                        'options'    => jws_get_sidebars(),
						'title'      => esc_html__( 'Select Sidebar', 'kloud' ),
						'dependency' => array( 'wc-layout_no-sidebar', '==', false ),
					),
                    array(
						'id'      => 'wc-flip-thumb',
						'type'    => 'switcher',
						'title'   => esc_html__( 'Flip Product Thumbnail', 'kloud' ),
						'default' => false,
					),
						array(
						'id'      => 'content-inner',
						'type'    => 'switcher',
						'title'   => esc_html__( 'Layout Content Inner', 'kloud' ),
						'default' => false,
					),
					array(
						'id'      => 'wc-attr',
						'type'           => 'select',
						'title'   => esc_html__( 'Enable Products Attribute On Product List', 'kloud' ),
						'options' => $attributes,
					),
                    )),
				)
			),
			// Product Detail Setting
			array(
				'name'   => 'wc_detail_setting',
				'title'  => esc_html__( 'Product Detail Setting', 'kloud' ),
				'icon'   => 'fa fa-minus',
				'fields' => array(
					array(
						'type'    => 'heading',
						'content' => esc_html__( 'Product Shop Detail Setting', 'kloud' ),
					),
                    array(
                      'id'        => 'woodt_title_bar',
                      'type'      => 'fieldset',
                      'title'     => 'Title Bar Setting',
                      'un_array'  => true,
                      'fields'    => array(
                     array(
						'id'      => 'wc-detail-enable-page-title',
						'type'    => 'switcher',
						'title'   => esc_html__( 'Enable Page Title', 'kloud' ),
						'default' =>  false,
					),
                    array(
						'id'         => 'wc-pagehead-single-bg',
						'type'       => 'background',
						'title'      => esc_html__( 'Page Title Background', 'kloud' ),
                        'dependency' => array( 'wc-detail-enable-page-title', '==', true ),
					),
                    )),
                    array(
                      'id'        => 'woodt_layout',
                      'type'      => 'fieldset',
                      'title'     => 'Layout Setting',
                      'un_array'  => true,
                      'fields'    => array(
					array(
						'id'      => 'wc-single-style',
						'type'    => 'image_select',
						'title'   => esc_html__( 'Product Detail Layout', 'kloud' ),
						'radio'   => true,
						'options' => array(
							'1' => CS_URI . '/assets/images/layout/thumbnail-bottom.jpg',
							'2' => CS_URI . '/assets/images/layout/layout-1.jpg',
							'3' => CS_URI . '/assets/images/layout/layout-2.jpg',
							'4' => CS_URI . '/assets/images/layout/layout-3.jpg',
						),
						'default' => '1'
					),
                    array(
						'id'      => 'wc-thumbnail-position',
						'type'    => 'image_select',
					       'title'      => esc_html__( 'Thumbnail Gallery Position', 'kloud' ),
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
						'id'      => 'wc-detail-full',
						'type'    => 'switcher',
						'title'   => esc_html__( 'Enable Full Width', 'kloud' ),
						'default' => false,
					),

                    )),
                     array(
                      'id'        => 'woodt_orther',
                      'type'      => 'fieldset',
                      'title'     => 'Orther Setting',
                      'un_array'  => true,
                      'fields'    => array(
						array(
						'id'      => 'enble-sidebar',
						'type'    => 'switcher',
						'title'   => esc_html__( 'Enble sidebar', 'kloud' ),
						'default' => false,
                        'dependency' => array( 'wc-single-style_1', '==', true ),
					),
					array(
						'type'    => 'subheading',
						'content' => esc_html__( 'Orther Setting', 'kloud' ),
					),
					array(
						'id'    => 'wc-single-size-guide',
						'title' => esc_html__( 'Size Guide Default', 'kloud' ),
						'type'  => 'upload',
					),
                    array(
						'id'    => 'wc-single-banner',
						'title' => esc_html__( 'Banner Product', 'kloud' ),
						'type'  => 'upload',
					),
                    array(
					'title' => esc_html__( 'Link Banner','kloud'),
					'id'    => 'wc-single-banner-link',
					'type'  => 'text',
					'info'  => sprintf( __( 'Add Link banner', 'kloud' ), esc_url( admin_url( 'admin.php?page=jws-theme-options' ) ) ),
				    ),
                    array(
						'id'    => 'wc-shortcode-title',
						'title' => esc_html__( 'Add Content title Product Related', 'kloud' ),
						'type'  => 'textarea',
						'desc'    => esc_html__( 'Add Html Or Shortcode Here', 'kloud' ).'<p><a target="_blank" href="'.esc_url(  admin_url('/edit.php?post_type=visual_content') ).'">Link Content Shortcode</a></p>',
					),
                   )),	
				)
			),
		),
	);
}
// ----------------------------------------
// a option section for options portfolio-
// ----------------------------------------
	$options[]  = array(
		'name'  => 'portfolio',
		'title' => esc_html__( 'portfolio', 'kloud' ),
		'icon'  => 'fa fa-users',
		'sections' => array(

			// General Setting
			array(
				'name'   => 'pp_general_setting',
				'title'  => esc_html__( 'General Setting', 'kloud' ),
				'icon'   => 'fa fa-minus',
				'fields' => array(
					array(
						'type'    => 'heading',
						'content' => esc_html__( 'General Setting', 'kloud' ),
					),
					array(
						'id'      => 'pp-enable-page-title',
						'type'    => 'switcher',
						'title'   => esc_html__( 'Enable Page Title', 'kloud' ),
						'default' => true,
					),
					array(
						'id'         => 'pp-pagehead-bg',
						'type'       => 'background',
						'title'      => esc_html__( 'Page Title Background', 'kloud' ),
						'dependency' => array( 'pp-enable-page-title', '==', true ),
					),
				)
			),

			// Portfolio Listing Setting
			array(
				'name'   => 'pp_list_setting',
				'title'  => esc_html__( 'Archive Setting', 'kloud' ),
				'icon'   => 'fa fa-minus',
				'fields' => array(
					array(
						'type'    => 'heading',
						'content' => esc_html__( 'Archive Setting', 'kloud' ),
					),
					array(
						'id'      => 'pp-layout-full',
						'type'    => 'switcher',
						'title'   => esc_html__( 'Enable Full-Width', 'kloud' ),
						'default' => false,
					),
					array(
						'id'    => 'pp-column',
						'type'  =>'image_select',
						'title' => esc_html__( 'Number Of Column', 'kloud' ),
						'desc'  => esc_html__( 'Display number of portfolio per row', 'kloud' ),
						'radio' => true,
						'options' => array(
							'6' => CS_URI . '/assets/images/layout/2-col.jpg',
							'4' => CS_URI . '/assets/images/layout/3-col.jpg',
							'3' => CS_URI . '/assets/images/layout/4-col.jpg',
                            '20' => CS_URI . '/assets/images/layout/5-col-wide.jpg',
							'2' => CS_URI . '/assets/images/layout/6-col-wide.jpg',
						),
						'default' => '4'
					),
					array(
						'id'      => 'pp-number-per-page',
						'type'    => 'number',
						'title'   => esc_html__( 'Per Page', 'kloud' ),
						'desc'    => esc_html__( 'How much items per page to show (-1 to show all Portfolio)', 'kloud' ),
						'default' => '12',
					),
				)
			),
 		 // Portfolio Listing Setting
			array(
				'name'   => 'pp_list_single_setting',
				'title'  => esc_html__( 'Single Setting', 'kloud' ),
				'icon'   => 'fa fa-minus',
				'fields' => array(
					array(
						'type'    => 'heading',
						'content' => esc_html__( 'Single Setting', 'kloud' ),
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
				)
			),
		),
	);

// ----------------------------------------
// a option section for options blog      -
// ----------------------------------------
$options[] = array(
	'name'  => 'blog',
	'title' => esc_html__( 'Blog Single', 'kloud' ),
	'icon'  => 'fa fa-file-text-o',
	'fields' => array(
        array(
        	'id'      => 'post-single-style',
        	'type'    => 'image_select',
        	'title'   => esc_html__( 'Post Detail Style', 'kloud' ),
        	'radio'   => true,
        	'options' => array(
        	'1' => CS_URI . '/assets/images/layout/left-sidebar.jpg',
        	'2' => CS_URI . '/assets/images/layout/3-col.jpg',
        	'3' => CS_URI . '/assets/images/layout/right-sidebar.jpg',
        	),
        	'default' => '2'
        	),
		array(
			'id'      => 'blog-thumbnail',
			'type'    => 'switcher',
			'title'   => esc_html__( 'Enable Blog Thumbnail', 'kloud' ),
			'default' => true,
		),
        array(
			'id'      => 'blog-title',
			'type'    => 'switcher',
			'title'   => esc_html__( 'Enable Blog title', 'kloud' ),
			'default' => true,
		),
        array(
			'id'      => 'blog-meta',
			'type'    => 'switcher',
			'title'   => esc_html__( 'Enable Blog Meta ', 'kloud' ),
			'default' => true,
		),
        array(
			'id'      => 'blog-tag',
			'type'    => 'switcher',
			'title'   => esc_html__( 'Enable Blog Tags ', 'kloud' ),
			'default' => true,
		),
        array(
			'id'      => 'blog-social',
			'type'    => 'switcher',
			'title'   => esc_html__( 'Enable Blog Social ', 'kloud' ),
			'default' => true,
		),
        array(
			'id'      => 'blog-author',
			'type'    => 'switcher',
			'title'   => esc_html__( 'Enable Blog Author ', 'kloud' ),
			'default' => true,
		),
        array(
			'id'      => 'blog-related',
			'type'    => 'switcher',
			'title'   => esc_html__( 'Enable Blog Post Related ', 'kloud' ),
			'default' => true,
		),
		array(
			'id'         => 'blog-sidebar',
			'type'       => 'select',
            'options'    => jws_get_sidebars(),
			'title'      => esc_html__( 'Select Sidebar', 'kloud' ),
		),
	),
);

// ----------------------------------------
// a option section for 404    -
// ----------------------------------------
$options[] = array(
	'name'  => '404',
	'title' => esc_html__( '404 Page', 'kloud' ),
	'icon'  => 'fa fa-times',
	'fields' => array(
       
				array(
                  'id'        => 'image_404',
                  'type'      => 'textarea',
                  'title'     => 'Add shortcode',
                  'add_title' => 'Add Short code for 404',
                  'default' => '[vc_content id="1131"]',
                  'desc'    => esc_html__( 'Add Html Or Shortcode Here', 'kloud' ).'<p><a target="_blank" href="'.esc_url(  admin_url('/edit.php?post_type=visual_content') ).'">Link Content Shortcode</a></p>',
                ),
		
	),
);
// ------------------------------
// backup                       -
// ------------------------------
$options[]   = array(
	'name'     => 'backup_section',
	'title'    => 'Backup',
	'icon'     => 'fa fa-shield',
	'fields'   => array(
		array(
			'type'    => 'notice',
			'class'   => 'warning',
			'content' => esc_html__( 'You can save your current options. Download a Backup and Import.', 'kloud' ),
		),
		array(
			'type'    => 'backup',
		),
  	)
);
CSFramework::instance( $settings, $options );
