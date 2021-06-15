<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "rs_option";

    // This line is only for altering the demo. Can be easily removed.
    $opt_name = apply_filters( 'mifo/opt_name', $opt_name );

    /*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => __( 'RS Options', 'mifo' ),
        'page_title'           => __( 'RS Options', 'mifo' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => false,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        'forced_dev_mode_off' => true,
        // Show the time the page took to load, etc
        'update_notice'        => true,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        'compiler' => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        'force_output' => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    // Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
        $args['intro_text'] = sprintf( __( '<p>mifo Theme</p>', 'mifo' ), $v );
    } else {
        $args['intro_text'] = __( '<p>mifo Theme</p>', 'mifo' );
    }

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */


    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => __( 'Theme Information 1', 'mifo' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'mifo' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => __( 'Theme Information 2', 'mifo' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'mifo' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'mifo' );
    Redux::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */
     
   // -> START General Settings
   Redux::setSection( $opt_name, array(
        'title'            => __( 'General Sections', 'mifo' ),
        'id'               => 'basic-checkbox',
        'customizer_width' => '450px',
        'fields'           => array(

        	array(
                'id'       => 'logo-type',
                'type'     => 'select',
                'title'    => __('Select Logo Type', 'mifo'),                 
                'desc'     => __('Select your logo type', 'mifo'),
                // Must provide key => value pairs for select options
                'options'  => array(
                    'Text' => 'Text',
                    'Image' => 'Image'                      
                ),

                'default'  => 'Text',
            ), 
        	array(
                'id'       => 'mifotext',
                'type'     => 'text',
                'title'    => __( 'Logo Text', 'mifo' ),
                'subtitle' => __( 'You can use here text logo', 'mifo' ),  
                'default'  => 'Mifo',              
                
            ),
            array(
                'id'       => 'mifologo',
                'type'     => 'media',
                'title'    => __( 'Upload Default Logo', 'mifo' ),
                'subtitle' => __( 'Upload your logo', 'mifo' ),
                'url'=> true
                
            ),

            array(
                'id'       => 'mifologo_transparent',
                'type'     => 'media',
                'title'    => __( 'Upload Your Light', 'mifo' ),
                'subtitle' => __( 'Upload your light logo', 'mifo' ),
                'url'=> true
                
            ),

            array(
                'id'       => 'rswplogo_sticky',
                'type'     => 'media',
                'title'    => __( 'Upload Your Sticky Logo', 'mifo' ),
                'subtitle' => __( 'Upload your sticky logo', 'mifo' ),
                'url'=> true                
            ),
            
            array(
            'id'       => 'rs_favicon',
            'type'     => 'media',
            'title'    => __( 'Upload Favicon', 'mifo' ),
            'subtitle' => __( 'Upload your faviocn here', 'mifo' ),
            'url'=> true            
            ),
            
            array(
                'id'       => 'off_sticky',
                'type'     => 'switch', 
                'title'    => __('Sticky Menu', 'mifo'),
                'subtitle' => __('You can show or hide sticky menu here', 'mifo'),
                'default'  => false,
            ),
            
            array(
                'id'       => 'off_canvas',
                'type'     => 'switch', 
                'title'    => __('Show off Canvas', 'mifo'),
                'subtitle' => __('You can show or hide off canvas here', 'mifo'),
                'default'  => false,
            ),
            
            array(
                'id'       => 'show_preloader',
                'type'     => 'switch', 
                'title'    => __('Show Preloader', 'mifo'),
                'subtitle' => __('You can show or hide preloader', 'mifo'),
                'default'  => false,
            ),  
                
            array(
                'id'       => 'show_top_bottom',
                'type'     => 'switch', 
                'title'    => __('Go to Top', 'mifo'),
                'subtitle' => __('You can show or hide here', 'mifo'),
                'default'  => false,
            ),              
            
        )
    ) );
    
    
    // -> START Header Section
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Header', 'mifo' ),
        'id'               => 'header',
        'customizer_width' => '450px',
        'icon' => 'el el-certificate',
        ));
    
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Floating Bar', 'mifo' ),
        'id'               => 'header-top',
        'customizer_width' => '450px',
        'subsection' =>'true',      
        'fields'           => array(
        
        array(
                'id'       => 'show-top',
                'type'     => 'switch', 
                'title'    => __('Show Floating Bar', 'mifo'),
                'subtitle' => __('You can show/hide Floating bar', 'mifo'),
                'default'  => false,
            ), 

        array(
                'id'       => 'topbar-position',
                'type'     => 'select',
                'title'    => __('Select Floating Position', 'mifo'),                 
                'desc'     => __('Select your Floating position', 'mifo'),
                // Must provide key => value pairs for select options
                'options'  => array(
                    'Left' => 'Left',
                    'Right' => 'Right'                      
                ),

                'default'  => 'Left',
            ), 
      
      
        array(
                'id'       => 'show-social',
                'type'     => 'switch', 
                'title'    => __('Show Social Icons at Header', 'mifo'),
                'subtitle' => __('You can select Social Icons show or hide', 'mifo'),
                'default'  => true,
            ),  
                    
        
        
         array(
                    'id'       => 'phone',                               
                    'title'    => __( 'Floating Bar Phone Number', 'mifo' ),
                    'subtitle' => __( 'Enter Phone Number', 'mifo' ),
                    'type'     => 'text',
                    
            ),
     
        array(
                    'id'       => 'top-email',                               
                    'title'    => __( 'Floating Bar Email Address', 'mifo' ),
                    'subtitle' => __( 'Enter Email Address', 'mifo' ),
                    'type'     => 'text',
                    'validate' => 'email',
                    'msg'      => 'Email Address Not Valid',
                    
            ), 
            
           
        )
    ) 

);
                        

    // -> START Style Section
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Style', 'mifo' ),
        'id'               => 'stle',
        'customizer_width' => '450px',
        'icon' => 'el el-brush',
        ));
    
    Redux::setSection( $opt_name, array(
        'title'  => __( 'Global Style', 'mifo' ),
        'desc'   => __( 'Style your theme', 'mifo' ),        
        'subsection' =>'true',  
        'fields' => array( 
                        
                        array(
                            'id'        => 'body_bg_color',
                            'type'      => 'color',                           
                            'title'     => __('Body Backgroud Color','mifo'),
                            'subtitle'  => __('Pick body background color', 'mifo'),
                            'default'   => '#fff',
                            'validate'  => 'color',                        
                        ), 
                        
                        array(
                            'id'        => 'body_text_color',
                            'type'      => 'color',            
                            'title'     => __('Text Color','mifo'),
                            'subtitle'  => __('Pick text color', 'mifo'),
                            'default'   => '#3a505e',
                            'validate'  => 'color',                        
                        ),     
        
                        array(
                        'id'        => 'primary_color',
                        'type'      => 'color', 
                        'title'     => __('Primary Color','mifo'),
                        'subtitle'  => __('Select Primary Color Option.', 'mifo'),
                        'default'   => '#000000',
                        'validate'  => 'color',                        
                        ), 

                         array(
                        'id'        => 'secondary_color',
                        'type'      => 'color', 
                        'title'     => __('Secondary Color','mifo'),
                        'subtitle'  => __('Secondary color option.', 'mifo'),
                        'default'   => '#ffce00',
                        'validate'  => 'color',                        
                        ),                         
                        
                        array(
                            'id'        => 'link_text_color',
                            'type'      => 'color',                       
                            'title'     => __('Link Color','mifo'),
                            'subtitle'  => __('Pick Link color', 'mifo'),
                            'default'   => '#000000',
                            'validate'  => 'color',                        
                        ),
                        
                        array(
                            'id'        => 'link_hover_text_color',
                            'type'      => 'color',                 
                            'title'     => __('Link Hover Color','mifo'),
                            'subtitle'  => __('Pick link hover color', 'mifo'),
                            'default'   => '#ffce00',
                            'validate'  => 'color',                        
                        ),
                 ) 
            ) 
    ); 
    
    //Menu settings
     Redux::setSection( $opt_name, array(
        'title'  => __( 'Main Menu', 'mifo' ),
        'desc'   => __( 'Main Menu Style Here', 'mifo' ),        
        'subsection' =>'true',  
        'fields' => array( 
                        
                        array(
                            'id'        => 'menu_text_color',
                            'type'      => 'color',                       
                            'title'     => __('Main Menu Text Color','mifo'),
                            'subtitle'  => __('Pick color', 'mifo'),    
                            'default'   => '#000000',                        
                            'validate'  => 'color',                        
                        ), 
                        
                        array(
                            'id'        => 'menu_text_hover_color',
                            'type'      => 'color',                       
                            'title'     => __('Main Menu Text Hover Color','mifo'),
                            'subtitle'  => __('Pick color', 'mifo'),           
                            'default'   => '#363636',                 
                            'validate'  => 'color',                        
                        ), 
                        array(
                            'id'        => 'menu_text_active_color',
                            'type'      => 'color',                       
                            'title'     => __('Main Menu Text Active Color','mifo'),
                            'subtitle'  => __('Pick color', 'mifo'),
                            'default'   => '#363636',
                            'validate'  => 'color',                        
                        ), 
                        
                        array(
                            'id'        => 'drop_down_bg_color',
                            'type'      => 'color',                       
                            'title'     => __('Dropdown Menu Background Color','mifo'),
                            'subtitle'  => __('Pick bg color', 'mifo'),
                            'default'   => '#ffffff',
                            'validate'  => 'color',                        
                        ), 
                            
                        
                        array(
                            'id'        => 'drop_text_color',
                            'type'      => 'color',                     
                            'title'     => __('Dropdown Menu Text Color','mifo'),
                            'subtitle'  => __('Pick text color', 'mifo'),
                            'default'   => '#000',
                            'validate'  => 'color',                        
                        ), 
                        
                        array(
                            'id'        => 'drop_text_hover_color',
                            'type'      => 'color',                       
                            'title'     => __('Dropdown Menu Hover Text Color','mifo'),
                            'subtitle'  => __('Pick text color', 'mifo'),
                            'default'   => '#ffce00',
                            'validate'  => 'color',                        
                        ),     
                        
                        
                        array(
                            'id'        => 'drop_text_hoverbg_color',
                            'type'      => 'color',                       
                            'title'     => __('Dropdown Menu item Hover Background Color','mifo'),
                            'subtitle'  => __('Pick text color', 'mifo'),
                            'default'   => '',
                            'validate'  => 'color',                        
                        ), 
                        
                        array(
                            'id'        => 'drop_text_border_color',
                            'type'      => 'color',                       
                            'title'     => __('Dropdown Menu item Seperate Border Color','mifo'),
                            'subtitle'  => __('Pick a color', 'mifo'),             
                            'default'   => '#fff',               
                            'validate'  => 'color',                        
                        ),              
                        
                        
                )
            )
        );
    
    
    
    //-> START Typography
    Redux::setSection( $opt_name, array(
        'title'  => __( 'Typography', 'mifo' ),
        'id'     => 'typography',
        'desc'   => __( 'You can specify your body and heading font here','mifo'),
        'icon'   => 'el el-font',
        'fields' => array(
            array(
                'id'       => 'opt-typography-body',
                'type'     => 'typography',
                'title'    => __( 'Body Font', 'mifo' ),
                'subtitle' => __( 'Specify the body font properties.', 'mifo' ),
                'google'   => true, 
                'font-style' =>false,           
                'default'  => array(                    
                    'font-size'   => '14px',
                    'font-family' => 'Poppins',
                    'font-weight' => 'Normal',
                ),
            ),
             array(
                'id'       => 'opt-typography-menu',
                'type'     => 'typography',
                'title'    => __( 'Navigation Font', 'mifo' ),
                'subtitle' => __( 'Specify the menu font properties.', 'mifo' ),
                'google'   => true,
                'font-backup' => true,                
                'all_styles'  => true,              
                'default'  => array(
                    'color'       => '#000000',                    
                    'font-family' => 'Poppins',
                    'google'      => true,
                    'font-size'   => '15px',                    
                    'font-weight' => 'Normal',
                    
                ),
            ),
            array(
                'id'          => 'opt-typography-h1',
                'type'        => 'typography',
                'title'       => __( 'Heading H1', 'mifo' ),
                //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                //'google'      => false,
                // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup' => true,                
                'all_styles'  => true,
                                // An array of CSS selectors to apply this font style to dynamically
                'units'       => 'px',
                // Defaults to px
                'subtitle'    => __( 'Typography option with each property can be called individually.', 'mifo' ),
                'default'     => array(
                    'color'       => '#000000',
                    'font-style'  => '600',
                    'font-family' => 'Poppins',
                    'google'      => true,
                    'font-size'   => '34px',
                    
                    ),
                ),
            array(
                'id'          => 'opt-typography-h2',
                'type'        => 'typography',
                'title'       => __( 'Heading H2', 'mifo' ),
                //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                //'google'      => false,
                // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup' => true,                
                'all_styles'  => true,                 
                'units'       => 'px',
                // Defaults to px
                'subtitle'    => __( 'Typography option with each property can be called individually.', 'mifo' ),
                'default'     => array(
                    'color'       => '#000000',
                    'font-style'  => '600',
                    'font-family' => 'Poppins',
                    'google'      => true,
                    'font-size'   => '28px',
                    
                ),
                ),
            array(
                'id'          => 'opt-typography-h3',
                'type'        => 'typography',
                'title'       => __( 'Heading H3', 'mifo' ),
                //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                //'google'      => false,              
                'units'       => 'px',
                // Defaults to px
                'subtitle'    => __( 'Typography option with each property can be called individually.', 'mifo' ),
                'default'     => array(
                    'color'       => '#000000',
                    'font-style'  => '600',
                    'font-family' => 'Poppins',
                    'google'      => true,
                    'font-size'   => '24px',
                    
                    ),
                ),
            array(
                'id'          => 'opt-typography-h4',
                'type'        => 'typography',
                'title'       => __( 'Heading H4', 'mifo' ),
                //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                //'google'      => false,
                // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup' => false,                
                'all_styles'  => true,               
                'units'       => 'px',
                // Defaults to px
                'subtitle'    => __( 'Typography option with each property can be called individually.', 'mifo' ),
                'default'     => array(
                    'color'       => '#000000',
                    'font-style'  => '600',
                    'font-family' => 'Poppins',
                    'google'      => true,
                    'font-size'   => '20px',
                    'line-height' => '32px'
                    ),
                ),
            array(
                'id'          => 'opt-typography-h5',
                'type'        => 'typography',
                'title'       => __( 'Heading H5', 'mifo' ),
                //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                //'google'      => false,
                // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup' => false,                
                'all_styles'  => true,                
                'units'       => 'px',
                // Defaults to px
                'subtitle'    => __( 'Typography option with each property can be called individually.', 'mifo' ),
                'default'     => array(
                    'color'       => '#000000',
                    'font-style'  => '700',
                    'font-family' => 'Poppins',
                    'google'      => true,
                    'font-size'   => '18px',
                    'line-height' => '28px'
                    ),
                ),
            array(
                'id'          => 'opt-typography-6',
                'type'        => 'typography',
                'title'       => __( 'Heading H6', 'mifo' ),
             
                'font-backup' => false,                
                'all_styles'  => true,                
                'units'       => 'px',
                // Defaults to px
                'subtitle'    => __( 'Typography option with each property can be called individually.', 'mifo' ),
                'default'     => array(
                    'color'       => '#000000',
                    'font-style'  => '700',
                    'font-family' => 'Poppins',
                    'google'      => true,
                    'font-size'   => '16px',
                    'line-height' => '26px'
                ),
                ),
                
                )
            )
                    
   
    );

    /*Blog Sections*/
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Blog', 'mifo' ),
        'id'               => 'blog',
        'customizer_width' => '450px',
        'icon' => 'el el-comment',
        )
        );
        
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Blog Settings', 'mifo' ),
        'id'               => 'blog-settings',
        'subsection'       => true,
        'customizer_width' => '450px',      
        'fields'           => array(        
                            
                            array(
                                'id'       => 'blog-layout',
                                'type'     => 'image_select',
                                'title'    => __('Select Blog Layout', 'mifo'), 
                                'subtitle' => __('Select your blog layout', 'mifo'),
                                'options'  => array(
                                    'full'      => array(
                                        'alt'   => 'Blog Style 1', 
                                        'img'   => get_template_directory_uri().'/libs/img/1c.png'                                      
                                    ),
                                    '2right'      => array(
                                        'alt'   => 'Blog Style 2', 
                                        'img'   => get_template_directory_uri().'/libs/img/2cr.png'
                                    ),
                                    '2left'      => array(
                                        'alt'   => 'Blog Style 3', 
                                        'img'  => get_template_directory_uri().'/libs/img/2cl.png'
                                    ),                                  
                                ),
                                'default' => '2right'
                            ),                      
                        
                            array(
                                'id'       => 'blog-grid',
                                'type'     => 'select',
                                'title'    => __('Select Blog Gird', 'mifo'),                   
                                'desc'     => __('Select your blog gird layout', 'mifo'),
                                 //Must provide key => value pairs for select options
                                'options'  => array(
                                        '12'=>'1 Column',                                   
                                        '6' => '2 Column',                                          
                                        '4' => '3 Column',
                                        '3' => '4 Column'
                                        ),
                                    'default'  => '12',                                  
                            ),  
                                    
                            array(
                                'id'       => 'blog-author-post',
                                'type'     => 'select',
                                'title'    => __('Show Author Info', 'mifo'),                   
                                'desc'     => __('Select author info show or hide', 'mifo'),
                                 //Must provide key => value pairs for select options
                                'options'  => array(                                            
                                        'show' => 'Show',
                                        'hide' => 'Hide'
                                        ),
                                    'default'  => 'show',
                                
                            ),                  
                            
                        )
                    ) 
    
            );
    
    
    /*Single Post Sections*/
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Single Post', 'mifo' ),
        'id'               => 'spost',
        'subsection'       => true,
        'customizer_width' => '450px',      
        'fields'           => array(                           
        
                           
                            array(
                                    'id'       => 'blog-comments',
                                    'type'     => 'select',
                                    'title'    => __('Show Comment', 'mifo'),                   
                                    'desc'     => __('Select comments show or hide', 'mifo'),
                                     //Must provide key => value pairs for select options
                                    'options'  => array(                                            
                                            'show' => 'Show',
                                            'hide' => 'Hide'
                                            ),
                                        'default'  => 'show',
                                        
                            ),  
                            
                            array(
                                    'id'       => 'blog-author',
                                    'type'     => 'select',
                                    'title'    => __('Show Ahthor Info', 'mifo'),                   
                                    'desc'     => __('Select author info show or hide', 'mifo'),
                                     //Must provide key => value pairs for select options
                                    'options'  => array(                                            
                                            'show' => 'Show',
                                            'hide' => 'Hide'
                                            ),
                                        'default'  => 'show',
                                        
                            ),  
                            
                            array(
                                    'id'       => 'blog-post',
                                    'type'     => 'select',
                                    'title'    => __('Show Related Post', 'mifo'),                  
                                    'desc'     => __('Choose related product show or hide', 'mifo'),
                                     //Must provide key => value pairs for select options
                                    'options'  => array(                                            
                                            'show' => 'Show',
                                            'hide' => 'Hide'
                                            ),
                                        'default'  => 'show',
                                        
                            ),  
                        )
                ) 
    
    
    );

    Redux::setSection( $opt_name, array(
        'title'  => __( 'Social Icons', 'mifo' ),
        'desc'   => __( 'Add your social icon here', 'mifo' ),
        'icon'   => 'el el-share',
         'submenu' => true, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
        'fields' => array(
                    array(
                        'id'       => 'facebook',                               
                        'title'    => __( 'Facebook Link', 'mifo' ),
                        'subtitle' => __( 'Enter Facebook Link', 'mifo' ),
                        'type'     => 'text',                     
                    ),
                        
                     array(
                        'id'       => 'twitter',                               
                        'title'    => __( 'Twitter Link', 'mifo' ),
                        'subtitle' => __( 'Enter Twitter Link', 'mifo' ),
                        'type'     => 'text'
                    ),
                    
                        array(
                        'id'       => 'rss',                               
                        'title'    => __( 'Rss Link', 'mifo' ),
                        'subtitle' => __( 'Enter Rss Link', 'mifo' ),
                        'type'     => 'text'
                    ),
                    
                     array(
                        'id'       => 'pinterest',                               
                        'title'    => __( 'Pinterest Link', 'mifo' ),
                        'subtitle' => __( 'Enter Pinterest Link', 'mifo' ),
                        'type'     => 'text'
                    ),
                     array(
                        'id'       => 'linkedin',                               
                        'title'    => __( 'Linkedin Link', 'mifo' ),
                        'subtitle' => __( 'Enter Linkedin Link', 'mifo' ),
                        'type'     => 'text',
                        
                    ),
                     array(
                        'id'       => 'google',                               
                        'title'    => __( 'Google Plus Link', 'mifo' ),
                        'subtitle' => __( 'Enter Google Plus  Link', 'mifo' ),
                        'type'     => 'text',                       
                    ),

                    array(
                        'id'       => 'instagram',                               
                        'title'    => __( 'Instagram Link', 'mifo' ),
                        'subtitle' => __( 'Enter Instagram Link', 'mifo' ),
                        'type'     => 'text',                       
                    ),

                     array(
                        'id'       => 'youtube',                               
                        'title'    => __( 'Youtube Link', 'mifo' ),
                        'subtitle' => __( 'Enter Youtube Link', 'mifo' ),
                        'type'     => 'text',                       
                    ),

                    array(
                        'id'       => 'tumblr',                               
                        'title'    => __( 'Tumblr Link', 'mifo' ),
                        'subtitle' => __( 'Enter Tumblr Link', 'mifo' ),
                        'type'     => 'text',                       
                    ),

                    array(
                        'id'       => 'vimeo',                               
                        'title'    => __( 'Vimeo Link', 'mifo' ),
                        'subtitle' => __( 'Enter Vimeo Link', 'mifo' ),
                        'type'     => 'text',                       
                    ),         
            ) 
        ) 
    );
    
      Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Woocommerce', 'mifo' ),    
    'icon'   => 'el el-shopping-cart',    
        ) 
    ); 

    Redux::setSection( $opt_name, array(
                'title'            => esc_html__( 'Shop', 'mifo' ),
                'id'               => 'shop_layout',
                'customizer_width' => '450px',
                'subsection' =>'true',      
                'fields'           => array(                      
                   
                        
                        array(
                                'id'       => 'shop-layout',
                                'type'     => 'image_select',
                                'title'    => esc_html__('Select Shop Layout', 'mifo'), 
                                'subtitle' => esc_html__('Select your shop layout', 'mifo'),
                                'options'  => array(
                                    'full'      => array(
                                        'alt'   => 'Shop Style 1', 
                                        'img'   => get_template_directory_uri().'/libs/img/1c.png'                                      
                                    ),
                                    'right-col'      => array(
                                        'alt'   => 'Shop Style 2', 
                                        'img'   => get_template_directory_uri().'/libs/img/2cr.png'
                                    ),
                                    'left-col'      => array(
                                        'alt'   => 'Shop Style 3', 
                                        'img'  => get_template_directory_uri().'/libs/img/2cl.png'
                                    ),                                  
                                ),
                                'default' => 'full'
                            ),

                            array(
                                'id'       => 'wc_num_product',
                                'type'     => 'text',
                                'title'    => esc_html__( 'Number of Products Per Page', 'mifo' ),
                                'default'  => '9',
                            ),

                            array(
                                'id'       => 'wc_num_product_per_row',
                                'type'     => 'text',
                                'title'    => esc_html__( 'Number of Products Per Row', 'mifo' ),
                                'default'  => '3',
                            ),                                               
                    
                        )
                     ) 

                );

   
    Redux::setSection( $opt_name, array(
    'title'  => __( 'Footer Option', 'mifo' ),
    'desc'   => __( 'Footer style here', 'mifo' ),
    'icon'   => 'el el-th-large',
    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
    'fields' => array(

                array(
                        'id'       => 'footer_logo',
                        'type'     => 'media',
                        'title'    => __( 'Footer Logo', 'mifo' ),
                        'subtitle' => __( 'Upload your footer logo', 'mifo' ),                  
                    ),  
                
                array(
                        'id'       => 'show-social2',
                        'type'     => 'switch', 
                        'title'    => __('Show Social Icons at Footer', 'mifo'),
                        'subtitle' => __('You can select Social Icons show or hide', 'mifo'),
                        'default'  => true,
                    ),

                   array(
                            'id'        => 'footer_bg_color',
                            'type'      => 'color',                       
                            'title'     => __('Footer Background Color','mifo'),
                            'subtitle'  => __('Pick bg color', 'mifo'),
                            'default'   => '#fff',
                            'validate'  => 'color',                        
                    ),

                   array(
                        'id'        => 'footer_text_color',
                        'type'      => 'color',                       
                        'title'     => __('Footer Text Color','mifo'),
                        'subtitle'  => __('Pick bg color', 'mifo'),
                        'default'   => '#000',
                        'validate'  => 'color',                        
                ),


                array(
                            'id'        => 'copyright_bg_color',
                            'type'      => 'color',                       
                            'title'     => __('Copyright Background Color','mifo'),
                            'subtitle'  => __('Pick bg color', 'mifo'),
                            'default'   => '#f5f5f5',
                            'validate'  => 'color',                        
                    ),  

                  array(
                            'id'        => 'copy_text_color',
                            'type'      => 'color',                       
                            'title'     => __('Copyright Text Color','mifo'),
                            'subtitle'  => __('Pick color', 'mifo'),
                            'default'   => '#000',
                            'validate'  => 'color',                        
                    ),

                   array(
                            'id'        => 'social_text_color',
                            'type'      => 'color',                       
                            'title'     => __('Social Link Color','mifo'),
                            'subtitle'  => __('Pick  color', 'mifo'),
                            'default'   => '#000',
                            'validate'  => 'color',                        
                    ),

                       
                
                array(
                    'id'       => 'copyright',
                    'type'     => 'textarea',
                    'title'    => __( 'Footer CopyRight', 'mifo' ),
                    'subtitle' => __( 'Change your footer copyright text ?', 'mifo' ),
                    'default'  => '&copy; 2018 All Rights Reserved',
                ),             

              
            ) 
        ) 
    ); 
    
    
    Redux::setSection( $opt_name, array(
    'title'  => __( '404 Error Page', 'mifo' ),
    'desc'   => __( '404 details  here', 'mifo' ),
    'icon'   => 'el el-error-alt',
    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
    'fields' => array(

                array(
                        'id'       => 'title_404',
                        'type'     => 'text',
                        'title'    => __( 'Title', 'mifo' ),
                        'subtitle' => __( 'Enter title for 404 page', 'mifo' ), 
                        'default'  => '404',                
                    ),  
                
                array(
                        'id'       => 'text_404',
                        'type'     => 'text',
                        'title'    => __( 'Text', 'mifo' ),
                        'subtitle' => __( 'Enter text for 404 page', 'mifo' ),  
                        'default'  => 'Page Not Found',             
                    ),                      
                       
                
                array(
                        'id'       => 'back_home',
                        'type'     => 'text',
                        'title'    => __( 'Back to Home Button Label', 'mifo' ),
                        'subtitle' => __( 'Enter label for "Back to Home" button', 'mifo' ),
                        'default'  => 'Back to Homepage',   
                                    
                    ),                
            
                                  
            ) 
        ) 
    ); 
    

    
    /*
     * <--- END SECTIONS
     */


    /*
     *
     * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.
     *
     */

    /*
    *
    * --> Action hook examples
    *
    */

    // If Redux is running as a plugin, this will remove the demo notice and links
    //add_action( 'redux/loaded', 'remove_demo' );
    
    //add_filter('redux/options/' . $this->args['opt_name'] . '/compiler', array( $this, 'compiler_action' ), 10, 3);

    if ( ! function_exists( 'compiler_action' ) ) {
        function compiler_action( $options, $css, $changed_values ) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r( $changed_values ); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
        }
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $field['msg']    = 'your custom error message';
                $return['error'] = $field;
            }

            if ( $warning == true ) {
                $field['msg']      = 'your custom warning message';
                $return['warning'] = $field;
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri()() if you want to use any of the built in icons
     * */
    if ( ! function_exists( 'dynamic_section' ) ) {
        function dynamic_section( $sections ) {
            //$sections = array();
            $sections[] = array(
                'title'  => __( 'Section via hook', 'mifo' ),
                'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'mifo' ),
                'icon'   => 'el el-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    if ( ! function_exists( 'change_arguments' ) ) {
        function change_arguments( $args ) {
            //$args['dev_mode'] = true;

            return $args;
        }
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    if ( ! function_exists( 'change_defaults' ) ) {
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }
    }

    /**
     * Removes the demo link and the notice of integrated demo from the redux-framework plugin
     */
    if ( ! function_exists( 'remove_demo' ) ) {
        function remove_demo() {
            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                remove_action( 'plugin_row_meta', array(
                    ReduxFrameworkPlugin::instance(),
                    'plugin_metalinks'
                ), null, 2 );

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
            }
        }
    }

