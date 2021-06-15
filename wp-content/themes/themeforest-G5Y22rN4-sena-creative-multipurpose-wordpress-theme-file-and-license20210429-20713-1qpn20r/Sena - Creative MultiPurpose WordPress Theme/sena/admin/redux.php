<?php
if ( ! class_exists( 'SenaRedux' ) ) {
	class SenaRedux {
		public $args        = array( );
		public $sections    = array( );
		public $theme;
		public $ReduxFramework;

		public function __construct( ) {
			if ( ! class_exists( 'ReduxFramework' ) ) {
				return;
			}
			if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
				$this->initSettings( );
			} else {
				add_action( 'plugins_loaded', array( $this, 'initSettings' ), 10 );
			}
		}

		public function initSettings( ) {
			if ( is_admin( ) ) {
				load_textdomain( 'sena', get_template_directory( ) . '/languages/' . get_locale( ) . '.mo' );
			}
			
			$this->setArguments( );
			$this->setSections( );

			if ( ! isset( $this->args['opt_name'] ) ) {
				return;
			}

			$this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
		}

		public function setSections( ) {
			
			// General
			$this->sections[] = array(
				'title'     => esc_html__( 'General', 'sena' ),
				'icon'      => 'el-icon-website',
				'fields'    => array(
					array(
						'id'        => 'home-page-title',
						'type'      => 'text',
						'title'     => esc_html__( 'Home Page Title', 'sena' ),
						'desc'      => esc_html__( 'This title used only for navigation menu', 'sena' ),
						'default'   => esc_html__( 'Home', 'sena' )
					),
                    array(
						'id'        => 'home-magic-mouse',
						'type'      => 'switch',
						'title'     => esc_html__( 'Animated Magic Mouse', 'sena' ),
						'on'        => esc_html__( 'Enabled', 'sena' ),
						'off'       => esc_html__( 'Disabled', 'sena' ),
						'default'   => true
					),
					array(
						'id'        => 'home-magic-mouse-url',
						'type'      => 'text',
						'title'     => esc_html__( 'Animated Magic Mouse Url', 'sena' ),
						'default'   => esc_html__( '#mission', 'sena' ),
						'required' => array( 'home-magic-mouse', '=' , '1' )
					),
					array(
						'id'        => 'preloader',
						'type'      => 'switch',
						'title'     => esc_html__( 'Page Loader', 'sena' ),
						'on'        => esc_html__( 'Enabled', 'sena' ),
						'off'       => esc_html__( 'Disabled', 'sena' ),
						'default'   => true
					),
					array(
						'id'        => 'preloader-only-home',
						'type'      => 'switch',
						'title'     => esc_html__( 'Page Loader Location', 'sena' ),
						'on'        => esc_html__( 'Only Home Page', 'sena' ),
						'off'       => esc_html__( 'All Pages', 'sena' ),
						'default'   => true
					),
					array(
						'id'        => 'animations',
						'type'      => 'switch',
						'title'     => esc_html__( 'Animations on Scroll', 'sena' ),
						'on'        => esc_html__( 'Enabled', 'sena' ),
						'off'       => esc_html__( 'Disabled', 'sena' ),
						'default'   => true
					),
					array(
						'id'        => 'multiple-videos',
						'type'      => 'switch',
						'title'     => esc_html__( 'Multiple Video Sections', 'sena' ),
						'subtitle'  => esc_html__( 'Per page', 'sena' ),
						'on'        => esc_html__( 'Allow', 'sena' ),
						'off'       => esc_html__( 'Deny', 'sena' ),
						'default'   => false
					),
                    array(
						'id'        => 'google-map-api',
						'type'      => 'text',
						'title'     => esc_html__( 'Google Maps API Key', 'sena' ),
						'default'   => ''
					),
					array(
						'id'        => 'settings',
						'type'      => 'switch',
						'title'     => esc_html__( 'Settings Panel', 'sena' ),
						'on'        => esc_html__( 'Enabled', 'sena' ),
						'off'       => esc_html__( 'Disabled', 'sena' ),
						'default'   => false
					),
				),
			);

			// Logo
			$this->sections[] = array(
				'title'     => esc_html__( 'Logo', 'sena' ),
				'icon'      => 'el-icon-picasa',
				'fields'    => array(
					array(
						'id'        => 'logo-dark',
						'type'      => 'media',
						'title'     => esc_html__( 'Dark Logo', 'sena' ),
						'subtitle'  => esc_html__( 'Normal size', 'sena' ),
						'mode'      => false,
						'desc'      => esc_html__( 'Upload a logotype image that will represent your website', 'sena' )
					),
					array(
						'id'        => 'logo-light',
						'type'      => 'media',
						'title'     => esc_html__( 'Light Logo', 'sena' ),
						'subtitle'  => esc_html__( 'Normal size', 'sena' ),
						'mode'      => false,
						'desc'      => esc_html__( 'Upload a logotype image that will represent your website', 'sena' )
					),
					array(
						'id'        => 'logo-dark-retina',
						'type'      => 'media',
						'title'     => esc_html__( 'Dark Logo (2X)', 'sena' ),
						'subtitle'  => esc_html__( 'Double size (for Retina displays)', 'sena' ),
						'mode'      => false,
						'desc'      => esc_html__( 'Name it same with the dark logo ending by @2x (image_name@2x.jpg)', 'sena' )
					),
					array(
						'id'        => 'logo-light-retina',
						'type'      => 'media',
						'title'     => esc_html__( 'Light Logo (2X)', 'sena' ),
						'subtitle'  => esc_html__( 'Double size (for Retina displays)', 'sena' ),
						'mode'      => false,
						'desc'      => esc_html__( 'Name it same with the light logo ending by @2x (image_name@2x.jpg)', 'sena' )
					),
					array(
						'id'        => 'logo-height',
						'type'      => 'slider',
						'title'     => esc_html__( 'Logo Height', 'sena' ),
						'mode'      => false,
						'desc'      => esc_html__( 'Use numbers only', 'sena' ),
						'default'       => 25,
                        'min'           => 1,
                        'step'          => 1,
                        'max'           => 100,
                        'display_value' => 'text'
					),
				),
			);
			
			// Header
			$this->sections[] = array(
				'title'     => esc_html__( 'Header', 'sena' ),
				'icon'      => 'el-icon-star-empty',
				'fields'    => array(
					array(
						'id'        => 'header-sticky',
						'type'      => 'switch',
						'title'     => esc_html__( 'Menu Mode', 'sena' ),
						'on'        => esc_html__( 'Sticky', 'sena' ),
						'off'       => esc_html__( 'Normal', 'sena' ),
						'default'   => true
					),
					array(
						'id'        => 'search-icon',
						'type'      => 'switch',
						'title'     => esc_html__( 'Search Icon', 'sena' ),
						'on'        => esc_html__( 'Enabled', 'sena' ),
						'off'       => esc_html__( 'Disabled', 'sena' ),
						'default'   => true
					),
                    array(
						'id'        => 'shop-icon',
						'type'      => 'switch',
						'title'     => esc_html__( 'Shopping Cart Icon', 'sena' ),
						'on'        => esc_html__( 'Enabled', 'sena' ),
						'off'       => esc_html__( 'Disabled', 'sena' ),
						'default'   => false
					),
					array(
                        'id'        => 'header-nav-bgcolor',
                        'type'      => 'color',
                        'title'     => esc_html__( 'Menu Background Color', 'sena' ),
                        'desc'  	=> esc_html__( 'Leave blank or pick a color for the header. (default: #333333).', 'sena' ),
                        'default'   => '#333333',
                        'transparent' => false,
                        'validate'  => 'color',
                    ),
					array(
                        'id'        => 'header-bgcolor',
                        'type'      => 'color',
                        'title'     => esc_html__( 'Header Background Color', 'sena' ),
                        'desc'  	=> esc_html__( 'Leave blank or pick a color for the header. (default: #000000).', 'sena' ),
                        'default'   => '#000000',
                        'transparent' => false,
                        'validate'  => 'color',
                    ),					
					array(
						'id'        => 'header-bgimage',
						'type'      => 'media',
						'title'     => esc_html__( 'Header Background Image', 'sena' ),
						'mode'      => false,
						'desc'      => esc_html__( '1920 x 800 pixels', 'sena' )
					),
				),
			);
			
			// Footer
			$this->sections[] = array(
				'title'     => esc_html__( 'Footer', 'sena' ),
				'icon'      => 'el-icon-minus',
				'fields'    => array(
					array(
						'id'        => 'footer-button-top',
						'type'      => 'switch',
						'title'     => esc_html__( 'Back to Top Button', 'sena' ),
						'on'        => esc_html__( 'Enabled', 'sena' ),
						'off'       => esc_html__( 'Disabled', 'sena' ),
						'default'   => true
					),
					array(
                        'id'        => 'footer-bgcolor',
                        'type'      => 'color',
                        'title'     => esc_html__( 'Footer Background Color', 'sena' ),
                        'desc'  => esc_html__( 'Leave blank or pick a color for the footer. (default: #1a191d).', 'sena' ),
                        'default'   => '#1a191d',
                        'transparent' => false,
                        'validate'  => 'color',
                    ),
					array(
						'id'        => 'footer-bgimage',
						'type'      => 'media',
						'title'     => esc_html__( 'Footer Background Image', 'sena' ),
						'mode'      => false,
					),
					array(
						'id'        => 'copyright-text',
						'type'      => 'editor',
						'title'     => esc_html__( 'Copyright Text', 'sena' ),
						'desc'      => esc_html__( 'You can use the shortcodes in your footer text', 'sena' ),
						'default'   => esc_html__( 'Copyright &copy; 2021 Sena', 'sena' )
					),
				),
			);
			
			// Blog
			$this->sections[] = array(
				'title'     => esc_html__( 'Blog', 'sena' ),
				'icon'      => 'el-icon-pencil',
				'fields'    => array(
					array(
						'id'        => 'allow-share-posts',
						'type'      => 'switch',
						'title'     => esc_html__( 'Allow Sharing Posts', 'sena' ),
						'subtitle'  => esc_html__( 'Via Social Networks', 'sena' ),
						'on'        => esc_html__( 'Yes', 'sena' ),
						'off'       => esc_html__( 'No', 'sena' ),
						'default'   => true
					),
					array(
						'id'        => 'show-post-author',
						'type'      => 'switch',
						'title'     => esc_html__( 'Show Post Author', 'sena' ),
						'subtitle'  => esc_html__( 'Author section in posts', 'sena' ),
						'on'        => esc_html__( 'Yes', 'sena' ),
						'off'       => esc_html__( 'No', 'sena' ),
						'default'   => true
					),
					array(
						'id'        => 'show-comments',
						'type'      => 'switch',
						'title'     => esc_html__( 'Show Comments', 'sena' ),
						'subtitle'  => esc_html__( 'Enable comments in posts', 'sena' ),
						'on'        => esc_html__( 'Yes', 'sena' ),
						'off'       => esc_html__( 'No', 'sena' ),
						'default'   => true
					),
					array(
						'id'        => 'excerpt-length',
						'type'      => 'text',
						'title'     => esc_html__( 'Excerpt Length', 'sena' ),
						'subtitle'  => esc_html__( 'Blog Archive Text Length', 'sena' ),
						'default'   => '50'
					),
					array(
						'id'    => 'opt-divide',
						'type'  => 'divide'
					),
					array(
						'id'        => 'layout-blog',
						'type'      => 'image_select',
						'compiler'  => false,
						'title'     => esc_html__( 'Blog Pages Layout', 'sena' ),
						'subtitle'  => esc_html__( 'Select one of layouts for blog pages', 'sena' ),
						'options'   => array(
							'1' => array( 'alt' => esc_html__( '1 Column', 'sena' ),       'img' => ReduxFramework::$_url . 'assets/img/1col.png' ),
							'2' => array( 'alt' => esc_html__( '2 Column Left', 'sena' ),  'img' => ReduxFramework::$_url . 'assets/img/2cl.png' ),
							'3' => array( 'alt' => esc_html__( '2 Column Right', 'sena' ), 'img' => ReduxFramework::$_url . 'assets/img/2cr.png' ),
						),
						'default'   => '3'
					),
					array(
						'id'        => 'layout-search',
						'type'      => 'image_select',
						'compiler'  => false,
						'title'     => esc_html__( 'Search Page Layout', 'sena' ),
						'subtitle'  => esc_html__( 'Select one of layouts for search page', 'sena' ),
						'options'   => array(
							'1' => array( 'alt' => esc_html__( '1 Column', 'sena' ),       'img' => ReduxFramework::$_url . 'assets/img/1col.png' ),
							'2' => array( 'alt' => esc_html__( '2 Column Left', 'sena' ),  'img' => ReduxFramework::$_url . 'assets/img/2cl.png' ),
							'3' => array( 'alt' => esc_html__( '2 Column Right', 'sena' ), 'img' => ReduxFramework::$_url . 'assets/img/2cr.png' ),
						),
						'default'   => '3'
					),
				),
			);

			// Typography
			$this->sections[] = array(
				'title'     => esc_html__( 'Typography', 'sena' ),
				'icon'      => 'el-icon-text-height',
				'fields'    => array(
					array(
						'id'            => 'typography-content',
						'type'          => 'typography',
						'title'         => esc_html__( 'Content &mdash; Font', 'sena' ),
						'google'        => true,
						'update_weekly' => true,
						'font-backup'   => false,
						'font-style'    => false,
						'font-weight'   => false,
						'subsets'       => false,
						'font-size'     => true,
						'line-height'   => false,
						'text-align'    => false,
						'color'         => false,
						'preview'       => array(
							'text'          => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'sena' )
						),
						'default'       => array(
							'font-family'   => 'Open Sans',
							'font-size'     => '14',
							'google'        => true,
						),
					),
					array(
						'id'            => 'typography-headers-h1',
						'type'          => 'typography',
						'title'         => esc_html__( 'Headers &mdash; H1', 'sena' ),
						'google'        => true,
						'update_weekly' => true,
						'font-family'   => true,
						'font-backup'   => false,
						'font-style'    => false,
						'font-weight'   => false,
						'subsets'       => false,
						'font-size'     => true,
						'line-height'   => false,
						'text-align'    => false,
						'color'         => false,
						'preview'       => array(
							'text'          => esc_html__( 'Lorem ipsum dolor sit amet.', 'sena' )
						),
						'default'       => array(
							'font-family'   => 'Poppins',
							'font-size'     => '70',
							'google'        => true,
						),
					),
					array(
						'id'            => 'typography-headers-h2',
						'type'          => 'typography',
						'title'         => esc_html__( 'Headers &mdash; H2', 'sena' ),
						'google'        => true,
						'update_weekly' => true,
						'font-family'   => true,
						'font-backup'   => false,
						'font-style'    => false,
						'font-weight'   => false,
						'subsets'       => false,
						'font-size'     => true,
						'line-height'   => false,
						'text-align'    => false,
						'color'         => false,
						'preview'       => array(
							'text'          => esc_html__( 'Lorem ipsum dolor sit amet.', 'sena' )
						),
						'default'       => array(
							'font-family'   => 'Poppins',
							'font-size'     => '40',
							'google'        => true,
						),
					),
					array(
						'id'            => 'typography-headers-h3',
						'type'          => 'typography',
						'title'         => esc_html__( 'Headers &mdash; H3', 'sena' ),
						'google'        => true,
						'update_weekly' => true,
						'font-family'   => true,
						'font-backup'   => false,
						'font-style'    => false,
						'font-weight'   => false,
						'subsets'       => false,
						'font-size'     => true,
						'line-height'   => false,
						'text-align'    => false,
						'color'         => false,
						'preview'       => array(
							'text'          => esc_html__( 'Lorem ipsum dolor sit amet.', 'sena' )
						),
						'default'       => array(
							'font-family'   => 'Poppins',
							'font-size'     => '32',
							'google'        => true,
						),
					),
					array(
						'id'            => 'typography-headers-h4',
						'type'          => 'typography',
						'title'         => esc_html__( 'Headers &mdash; H4', 'sena' ),
						'google'        => true,
						'update_weekly' => true,
						'font-family'   => true,
						'font-backup'   => false,
						'font-style'    => false,
						'font-weight'   => false,
						'subsets'       => false,
						'font-size'     => true,
						'line-height'   => false,
						'text-align'    => false,
						'color'         => false,
						'preview'       => array(
							'text'          => esc_html__( 'Lorem ipsum dolor sit amet.', 'sena' )
						),
						'default'       => array(
							'font-family'   => 'Poppins',
							'font-size'     => '24',
							'google'        => true,
						),
					),
					array(
						'id'            => 'typography-headers-h5',
						'type'          => 'typography',
						'title'         => esc_html__( 'Headers &mdash; H5', 'sena' ),
						'google'        => true,
						'update_weekly' => true,
						'font-family'   => true,
						'font-backup'   => false,
						'font-style'    => false,
						'font-weight'   => false,
						'subsets'       => false,
						'font-size'     => true,
						'line-height'   => false,
						'text-align'    => false,
						'color'         => false,
						'preview'       => array(
							'text'          => esc_html__( 'Lorem ipsum dolor sit amet.', 'sena' )
						),
						'default'       => array(
							'font-family'   => 'Poppins',
							'font-size'     => '20',
							'google'        => true,
						),
					),
					array(
						'id'            => 'typography-headers-h6',
						'type'          => 'typography',
						'title'         => esc_html__( 'Headers &mdash; H6', 'sena' ),
						'google'        => true,
						'update_weekly' => true,
						'font-family'   => true,
						'font-backup'   => false,
						'font-style'    => false,
						'font-weight'   => false,
						'subsets'       => false,
						'font-size'     => true,
						'line-height'   => false,
						'text-align'    => false,
						'color'         => false,
						'preview'       => array(
							'text'          => esc_html__( 'Lorem ipsum dolor sit amet.', 'sena' )
						),
						'default'       => array(
							'font-family'   => 'Poppins',
							'font-size'     => '16',
							'google'        => true,
						),
					),
				),
			);
			
			// Styling
			$this->sections[] = array(
				'title'     => esc_html__( 'Styling', 'sena' ),
				'icon'      => 'el-icon-asterisk',
				'fields'    => array(
					array(
						'id'        => 'styling-schema',
						'type'      => 'select',
						'title'     => esc_html__( 'Color Schema', 'sena' ),
						'desc'      => esc_html__( 'Select a predefined color schema', 'sena' ),
						'options'   => array(
							'green'         => esc_html__( 'Green', 'sena' ),
							'orange'        => esc_html__( 'Orange', 'sena' ),
							'red'      	 	=> esc_html__( 'Red', 'sena' ),
							'blue'       	=> esc_html__( 'Blue', 'sena' ),
							'turquoise'     => esc_html__( 'Turquoise', 'sena' ),							
							'purple'        => esc_html__( 'Purple', 'sena' ),
							'yellow'        => esc_html__( 'Yellow', 'sena' ),
							'grey'     	 	=> esc_html__( 'Grey', 'sena' )
						),
						'default'   => 'green'
					),
					array(
                        'id'        => 'body-bgcolor',
                        'type'      => 'color',
                        'title'     => esc_html__( 'Body Background Color', 'sena' ),
                        'desc'  	=> esc_html__( 'Leave blank or pick a color for the body. (default: #ffffff).', 'sena' ),
                        'default'   => '#ffffff',
                        'transparent' => false,
                        'validate'  => 'color',
                    ),
					array(
                        'id'        => 'loader-bgcolor',
                        'type'      => 'color',
                        'output'    => array('background-color' => 'html body'),
                        'title'     => esc_html__( 'Page Loader Background Color', 'sena' ),
                        'desc'  	=> esc_html__( 'Leave blank or pick a color for the page loader. (default: #212121).', 'sena' ),
                        'default'   => '#ffffff',
                        'transparent' => false,
                        'validate'  => 'color',
                    ),
				),
			);

			// Social
			$this->sections[] = array(
				'title'     => esc_html__( 'Social Links', 'sena' ),
				'icon'      => 'el-icon-heart',
				'fields'    => array(
					array(
						'id' => 'social-link',
						'type' => 'social',
						'title' => esc_html__( 'Social Links', 'sena' ),
						'options' => SenaFontAwesomeSocial(),
						'default_show' => false,
						'default' => ''
					)
				),
			);

			// Contact
			$this->sections[] = array(
				'title'     => esc_html__( 'Contact', 'sena' ),
				'icon'      => 'el-icon-phone',
				'fields'    => array(
					array(
						'id'        => 'contact-email',
						'type'      => 'text',
						'title'     => esc_html__( 'Target Email Address', 'sena' ),
						'default'   => ''
					),
					array(
						'id'        => 'contact-template',
						'type'      => 'textarea',
						'title'     => esc_html__( 'Email Template', 'sena' ),
						'desc'      => esc_html__( 'Available tags &ndash; {from}, {email}, {phone}, {message}, {date}, {ip}', 'sena' ),
						'default'   => esc_html__( "Dear Administrator,\nYou have one message from {from} ({email}).\n\n{message}\n\n{date}\n{phone}", 'sena' )
					),
				),
			);
            
            // Shop
			$this->sections[] = array(
				'title'     => esc_html__( 'Shop', 'sena' ),
				'icon'      => 'el-icon-shopping-cart',
				'fields'    => array(
					array(
						'id'        => 'shop-sidebar',
						'type'      => 'switch',
						'title'     => esc_html__( 'Show Sidebar', 'sena' ),
						'subtitle'  => esc_html__( 'Sidebar on shop page', 'sena' ),
						'on'        => esc_html__( 'Yes', 'sena' ),
						'off'       => esc_html__( 'No', 'sena' ),
						'default'   => false
					),
                    array(
                        'id' => 'shop-columns',
                        'title' => esc_html__( 'Number of Columns', 'sena' ),
                        'type' => 'select',
                        'options' => array(
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                        ),
                        'default' => '3'
                    ),
                    array(
                        'id'    => 'shop-products',
                        'title' => esc_html__( 'Products per Page', 'sena' ),
                        'type' => 'select',
                        'options' => array(
                            '-1'  => esc_html__( 'All', 'sena' ),
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                            '5' => '5',
                            '6' => '6',
                            '7' => '7',
                            '8' => '8',
                            '9' => '9',
                            '10' => '10',
                            '11' => '11',
                            '12' => '12',
                        ),
                        'default' => '6',
                        'validate' => 'numeric'
                    ),
				),
			);
			
        }

		public function setArguments( ) {
			$theme = wp_get_theme( );

			$this->args = array(
				'opt_name'           => 'sena_config',
				'display_name'       => $theme->get( 'Name' ),
				'display_version'    => $theme->get( 'Version' ),
				'menu_type'          => 'menu',
				'allow_sub_menu'     => true,
				'menu_title'         => esc_html__( 'Sena', 'sena' ),
				'page_title'         => esc_html__( 'Theme Options', 'sena' ),
				'google_api_key'     => '',
				'async_typography'   => false,
				'admin_bar'          => false,
				'global_variable'    => '',
				'dev_mode'           => false,
				'output'             => false,
				'compiler'           => false,
				'customizer'         => true,
				'page_priority'      => 102,
				'page_parent'        => 'themes.php',
				'page_permissions'   => 'manage_options',
				'menu_icon'          => 'dashicons-art',
				'last_tab'           => '',
				'page_icon'          => 'icon-themes',
				'page_slug'          => 'theme-options',
				'save_defaults'      => true,
				'default_show'       => false,
				'default_mark'       => '',
				'update_notice'      => false,
			);
			
			//Custom links in the footer of Redux panel
			$this->args['share_icons'][] = array(
				'url'   => 'https://themeforest.net/user/athenastudio',
				'title' => esc_html__( 'AthenaStudio', 'sena' ),
				'icon'  => 'el el-globe-alt'
			);
			
			$this->args['share_icons'][] = array(
				'url'   => 'https://twitter.com/AthenaStudio87',
				'title' => esc_html__( 'Twitter', 'sena' ),
				'icon'  => 'el el-twitter'
			);
			
			$this->args['share_icons'][] = array(
				'url'   => 'https://dribbble.com/AthenaStudio',
				'title' => esc_html__( 'Dribbble', 'sena' ),
				'icon'  => 'el el-dribbble'
			);
			
		}

	}
	
	global $senaInstance;
	$senaInstance = new SenaRedux( );
}
