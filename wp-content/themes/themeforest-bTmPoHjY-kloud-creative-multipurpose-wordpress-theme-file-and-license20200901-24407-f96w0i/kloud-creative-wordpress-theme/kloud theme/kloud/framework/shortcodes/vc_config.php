<?php if ( ! defined('URI_PATH')) exit('No direct script access allowed');

if( ! function_exists( 'kloud_vc_extra_classes' ) ) {

	if( defined( 'VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG' ) ) {
		add_filter( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'kloud_vc_extra_classes', 30, 3 );
	}

	function kloud_vc_extra_classes( $class, $base, $atts ) {
		if( ! empty( $atts['kloud_color_scheme'] ) ) {
			$class .= ' color-scheme-' . $atts['kloud_color_scheme'];
		}

		if( ! empty( $atts['kloud_parallax'] ) ) {
			$class .= ' container-in-full';
		}
        if( ! empty( $atts['jws_parallax'] ) ) {
			$class .= ' background-parallax';
		}
        if( ! empty( $atts['jws_100'] ) ) {
			$class .= ' container100 ';
		}
		return $class;
	}
}

if( ! function_exists( 'kloud_vc_map_shortcodes' ) ) {

	add_action( 'vc_before_init', 'kloud_vc_map_shortcodes' );

	function kloud_vc_map_shortcodes() {

		/**
		 * ------------------------------------------------------------------------------------------------
		 * Parallax option
		 * ------------------------------------------------------------------------------------------------
		 */
        $canvas_background = array(
			'type' => 'checkbox',
			'heading' => __( 'Enble Canvas Background', 'kloud' ),
			'param_name' => 'kloud_canvas',
			'value' => array( __( 'Yes, please', 'kloud' ) => 1 )
		);
		$attributes = array(
			'type' => 'checkbox',
			'heading' => __( 'Container In Full width', 'kloud' ),
			'param_name' => 'kloud_parallax',
			'value' => array( __( 'Yes, please', 'kloud' ) => 1 )
		);
        $parallaxs = array(
			'type' => 'checkbox',
			'heading' => __( 'Parallax background', 'kloud' ),
			'param_name' => 'jws_parallax',
			'value' => array( __( 'Yes, please', 'kloud' ) => 1 )
		);
        $container100 = array(
			'type' => 'checkbox',
			'heading' => __( 'Container Width 100%', 'kloud' ),
			'param_name' => 'jws_100',
			'value' => array( __( 'Yes, please', 'kloud' ) => 1 )
		);
        $number_tab = array(
			'type' => 'textarea',
			'heading' => __( 'Title', 'kloud' ),
			'param_name' => 'title',
		);
        $box_hover_height = array(
			'type' => 'textfield',
			'heading' => __( 'Height', 'kloud' ),
			'param_name' => 'el_height',
		);
        $over_lay = array(
    		'type' => 'colorpicker',
    		'heading' => __( 'Background Overlay', 'kloud' ),
    		'param_name' => 'over_lay'
		);
        vc_add_param( 'vc_section', $canvas_background );
        vc_add_param( 'vc_row', $canvas_background );
        vc_add_param( 'vc_row', $container100 );
        vc_add_param( 'vc_section', $container100 );
        vc_add_param( 'vc_row', $parallaxs );
        vc_add_param( 'vc_section', $parallaxs );
		vc_add_param( 'vc_row', $attributes );
		vc_add_param( 'vc_section', $attributes );
		vc_add_param( 'vc_column', $attributes );
        vc_add_param( 'vc_tta_section', $number_tab );
        vc_add_param( 'vc_hoverbox', $box_hover_height );
        vc_add_param( 'vc_section',$over_lay );
		vc_add_param( 'vc_row', $over_lay );
		$target_arr = array(
			__( 'Same window', 'kloud' ) => '_self',
			__( 'New window', 'kloud' ) => "_blank"
		);

		$post_types_list = array();
		$post_types_list[] = array( 'post', __( 'Post', 'kloud' ) );
		//$post_types_list[] = array( 'custom', __( 'Custom query', 'kloud' ) );
		$post_types_list[] = array( 'ids', __( 'List of IDs', 'kloud' ) );

		/**
		 * ------------------------------------------------------------------------------------------------
		 * Map blog shortcode
		 * ------------------------------------------------------------------------------------------------
		 */
		vc_map( array(
			'name' => 'Blog',
			'base' => 'kloud_blog',
			'category' => __( 'Shortcode elements', 'kloud' ),
			'description' => __( 'Show your blog posts on the page', 'kloud' ),
			'params' => array(
				array(
					'type' => 'dropdown',
					'heading' => __( 'Data source', 'kloud' ),
					'param_name' => 'post_type',
					'value' => $post_types_list,
					'description' => __( 'Select content type for your grid.', 'kloud' )
				),
				array(
					'type' => 'autocomplete',
					'heading' => __( 'Include only', 'kloud' ),
					'param_name' => 'include',
					'description' => __( 'Add posts, pages, etc. by title.', 'kloud' ),
					'settings' => array(
						'multiple' => true,
						'sortable' => true,
						'groups' => true,
					),
					'dependency' => array(
						'element' => 'post_type',
						'value' => array( 'ids' ),
						//'callback' => 'vc_grid_include_dependency_callback',
					),
				),
				// Custom query tab
				array(
					'type' => 'textarea_safe',
					'heading' => __( 'Custom query', 'kloud' ),
					'param_name' => 'custom_query',
					'description' => __( 'Build custom query according to <a href="http://codex.wordpress.org/Function_Reference/query_posts">WordPress Codex</a>.', 'kloud' ),
					'dependency' => array(
						'element' => 'post_type',
						'value' => array( 'custom' ),
					),
				),
				array(
					'type' => 'autocomplete',
					'heading' => __( 'Narrow data source', 'kloud' ),
					'param_name' => 'taxonomies',
					'settings' => array(
						'multiple' => true,
						// is multiple values allowed? default false
						// 'sortable' => true, // is values are sortable? default false
						'min_length' => 1,
						// min length to start search -> default 2
						// 'no_hide' => true, // In UI after select doesn't hide an select list, default false
						'groups' => true,
						// In UI show results grouped by groups, default false
						'unique_values' => true,
						// In UI show results except selected. NB! You should manually check values in backend, default false
						'display_inline' => true,
						// In UI show results inline view, default false (each value in own line)
						'delay' => 500,
						// delay for search. default 500
						'auto_focus' => true,
						// auto focus input, default true
						// 'values' => $taxonomies_for_filter,
					),
					'param_holder_class' => 'vc_not-for-custom',
					'description' => __( 'Enter categories, tags or custom taxonomies.', 'kloud' ),
					'dependency' => array(
						'element' => 'post_type',
						'value_not_equal_to' => array( 'ids', 'custom' ),
					),
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Items per page', 'kloud' ),
					'param_name' => 'items_per_page',
					'description' => __( 'Number of items to show per page.', 'kloud' ),
					'value' => '10',
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Pagination', 'kloud' ),
					'param_name' => 'pagination',
					'value' => array(
	                    '' => '', 
	                    'Pagination' => 'pagination', 
	                    '"Load more" button' => 'more-btn', 
					),
				),
				// Design settings
				array(
					'type' => 'dropdown',
					'heading' => __( 'Style', 'kloud' ),
					'param_name' => 'blog_design',
					'value' => array(
	                    'Blog No Spacing' => 'default', 
	                    'Border With Bottom' => 'border-bottom',
                        'Border With Bottom And Content Center' => 'border-center',  
                        'Blog On Menu' => 'blog-menu', 
					),
					'description' => __( 'You can use different design for your blog styled for the theme', 'kloud' ),
					'group' => __( 'Design', 'kloud' ),
				),
                	// Design settings
			
				array(
					'type' => 'textfield',
					'heading' => __( 'Images size', 'kloud' ),
					'group' => __( 'Design', 'kloud' ),
					'param_name' => 'img_size',
					'description' => __( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.', 'kloud' )
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Columns', 'kloud' ),
					'param_name' => 'blog_columns',
					 "value" => array(
        					"6 column" => "6",
                            "4 column" => "4",
                            "3 column" => "3",
                            "2 column" => "2",
                            "1 column" => "1",
        					
                        ),
					'description' => __( 'Blog items columns', 'kloud' ),
					'group' => __( 'Design', 'kloud' ),
				),
				// Data settings
				array(
					'type' => 'dropdown',
					'heading' => __( 'Order by', 'kloud' ),
					'param_name' => 'orderby',
					'value' => array(
						__( 'Date', 'kloud' ) => 'date',
						__( 'Order by post ID', 'kloud' ) => 'ID',
						__( 'Author', 'kloud' ) => 'author',
						__( 'Title', 'kloud' ) => 'title',
						__( 'Last modified date', 'kloud' ) => 'modified',
						__( 'Post/page parent ID', 'kloud' ) => 'parent',
						__( 'Number of comments', 'kloud' ) => 'comment_count',
						__( 'Menu order/Page Order', 'kloud' ) => 'menu_order',
						__( 'Meta value', 'kloud' ) => 'meta_value',
						__( 'Meta value number', 'kloud' ) => 'meta_value_num',
						// __('Matches same order you passed in via the 'include' parameter.', 'kloud') => 'post__in'
						__( 'Random order', 'kloud' ) => 'rand',
					),
					'description' => __( 'Select order type. If "Meta value" or "Meta value Number" is chosen then meta key is required.', 'kloud' ),
					'group' => __( 'Data Settings', 'kloud' ),
					'param_holder_class' => 'vc_grid-data-type-not-ids',
					'dependency' => array(
						'element' => 'post_type',
						'value_not_equal_to' => array( 'ids', 'custom' ),
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Sorting', 'kloud' ),
					'param_name' => 'order',
					'group' => __( 'Data Settings', 'kloud' ),
					'value' => array(
						__( 'Descending', 'kloud' ) => 'DESC',
						__( 'Ascending', 'kloud' ) => 'ASC',
					),
					'param_holder_class' => 'vc_grid-data-type-not-ids',
					'description' => __( 'Select sorting order.', 'kloud' ),
					'dependency' => array(
						'element' => 'post_type',
						'value_not_equal_to' => array( 'ids', 'custom' ),
					),
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Meta key', 'kloud' ),
					'param_name' => 'meta_key',
					'description' => __( 'Input meta key for grid ordering.', 'kloud' ),
					'group' => __( 'Data Settings', 'kloud' ),
					'param_holder_class' => 'vc_grid-data-type-not-ids',
					'dependency' => array(
						'element' => 'orderby',
						'value' => array( 'meta_value', 'meta_value_num' ),
					),
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Offset', 'kloud' ),
					'param_name' => 'offset',
					'description' => __( 'Number of grid elements to displace or pass over.', 'kloud' ),
					'group' => __( 'Data Settings', 'kloud' ),
					'param_holder_class' => 'vc_grid-data-type-not-ids',
					'dependency' => array(
						'element' => 'post_type',
						'value_not_equal_to' => array( 'ids', 'custom' ),
					),
				),
				array(
					'type' => 'autocomplete',
					'heading' => __( 'Exclude', 'kloud' ),
					'param_name' => 'exclude',
					'description' => __( 'Exclude posts, pages, etc. by title.', 'kloud' ),
					'group' => __( 'Data Settings', 'kloud' ),
					'settings' => array(
						'multiple' => true,
					),
					'param_holder_class' => 'vc_grid-data-type-not-ids',
					'dependency' => array(
						'element' => 'post_type',
						'value_not_equal_to' => array( 'ids', 'custom' ),
						'callback' => 'vc_grid_exclude_dependency_callback',
					),
				),
                array(
                    "type" => "checkbox",
                    "heading" => __('Show Thumbnail', 'kloud'),
                    "param_name" => "thumbnail_show",
                    "value" => array(
                        __("Yes, please", 'kloud') => true
                    ),
                ),
                 array(
                    "type" => "checkbox",
                    "heading" => __('Show like', 'kloud'),
                    "param_name" => "like",
                    "value" => array(
                        __("Yes, please", 'kloud') => true
                    ),
                ),
                array(
                    "type" => "checkbox",
                    "heading" => __('Show review', 'kloud'),
                    "param_name" => "review",
                    "value" => array(
                        __("Yes, please", 'kloud') => true
                    ),
                ),
                array(
                'type' => 'animation_style',
                'heading' => __( 'Animation Style', 'kloud' ),
                'param_name' => 'animation',
                'description' => __( 'Choose your animation style', 'kloud' ),
                'admin_label' => false,
                'weight' => 0,
                )

	      )
	
	    ) );

		// Necessary hooks for blog autocomplete fields
		add_filter( 'vc_autocomplete_kloud_blog_include_callback',	'vc_include_field_search', 10, 1 ); // Get suggestion(find). Must return an array
		add_filter( 'vc_autocomplete_kloud_blog_include_render','vc_include_field_render', 10, 1 ); // Render exact product. Must return an array (label,value)

		// Narrow data taxonomies
		add_filter( 'vc_autocomplete_kloud_blog_taxonomies_callback', 'vc_autocomplete_taxonomies_field_search', 10, 1 );
		add_filter( 'vc_autocomplete_kloud_blog_taxonomies_render', 'vc_autocomplete_taxonomies_field_render', 10, 1 );

		// Narrow data taxonomies for exclude_filter
		add_filter( 'vc_autocomplete_kloud_blog_exclude_filter_callback', 'vc_autocomplete_taxonomies_field_search', 10, 1 );
		add_filter( 'vc_autocomplete_kloud_blog_exclude_filter_render', 'vc_autocomplete_taxonomies_field_render', 10, 1 );

		add_filter( 'vc_autocomplete_kloud_blog_exclude_callback',	'vc_exclude_field_search', 10, 1 ); // Get suggestion(find). Must return an array
		add_filter( 'vc_autocomplete_kloud_blog_exclude_render', 'vc_exclude_field_render', 10, 1 ); // Render exact product. Must return an array (label,value)

	   
        /**
		 * ------------------------------------------------------------------------------------------------
		 * Map pricing tables shortcode
		 * ------------------------------------------------------------------------------------------------
		 */
		vc_map( array(
			'name' => __( 'Pricing tables', 'kloud' ),
			'base' => 'pricing_tables',
			"as_parent" => array('only' => 'pricing_plan'),
			"content_element" => true,
			"show_settings_on_create" => false,
			'category' => __( 'Shortcode elements', 'kloud' ),
			'description' => __( 'Show your pricing plans', 'kloud' ),
   
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => __( 'Extra class name', 'kloud' ),
					'param_name' => 'el_class',
					'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'kloud' )
				),
                array(
					'type' => 'textfield',
					'heading' => __( 'Number Slider Review', 'kloud' ),
					'param_name' => 'view',
                    'dependency' => array(
						'element' => 'layout',
						'value' => array( 'layout2' ),
					),
				),
			),
		    "js_view" => 'VcColumnView'
		));
             /**
		 * ------------------------------------------------------------------------------------------------
		 * Animator shortcode
		 * ------------------------------------------------------------------------------------------------
		 */
		vc_map( array(
			'name' => __( 'Animator', 'kloud' ),
			'base' => 'animator',
            'is_container' => true,
            'content_element' => true,
            'allowed_container_element' => false,
			'category' => __( 'Shortcode elements', 'kloud' ),
			'description' => __( 'Animation for all shortcode', 'kloud' ),
			'params' => array(
                 array(
                'type' => 'animation_style',
                'heading' => __( 'Animation Style', 'kloud' ),
                'param_name' => 'animation',
                'description' => __( 'Choose your animation style', 'kloud' ),
                'admin_label' => false,
                'weight' => 0,
                ),
               	array(
					'type' => 'textfield',
					'heading' => __( 'Animation Delay', 'kloud' ),
					'param_name' => 'delay',
					'description' => __( 'Add Time Delay For Animation. Example:0.4', 'kloud' )
				),
                array(
					'type' => 'textfield',
					'heading' => __( 'Animation Duration', 'kloud' ),
					'param_name' => 'duration',
					'description' => __( 'Add Time Duration For Animation. Example:0.4', 'kloud' )
				),
                 array(
                    "type" => "checkbox",
                    "heading" => __('Animation Infinite', 'kloud'),
                    "param_name" => "infinite",
                    "value" => array(
                        __("Yes, please", 'kloud') => true
                    ),
                ),
			),
		    "js_view" => 'VcColumnView'
		));
		vc_map( array(
			'name' => __( 'Price plan', 'kloud' ),
			'base' => 'pricing_plan',
			'class' => '',
			'category' => __( 'Shortcode elements', 'kloud' ),
			'description' => __( 'Price option', 'kloud' ),
			'params' => array(
                array(
					'type' => 'dropdown',
					'heading' => __( 'Layout', 'kloud' ),
					'param_name' => 'layout',
					'value' => array(
						'' => '',
						__( 'Layout Gradient Color ', 'kloud' ) => 'layout1',
						__( 'Layout Custom Color', 'kloud' ) => 'layout2',
					)
				),
                array(
					'type' => 'colorpicker',
					'heading' => __( 'Background', 'kloud' ),
					'param_name' => 'color'
				),
                array(
					'type' => 'attach_image',
					'heading' => __( 'Icon Image', 'kloud' ),
					'param_name' => 'image',
					'value' => '',
					'description' => __( 'Select image from media library.', 'kloud' )
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Pricing plan name', 'kloud' ),
					'param_name' => 'name',
					'value' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Price value', 'kloud' ),
					'param_name' => 'price_value',
					'value' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Price suffix', 'kloud' ),
					'param_name' => 'price_suffix',
					'value' => 'per month',
					'description' => __( 'For example: per month', 'kloud' )
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Price currency', 'kloud' ),
					'param_name' => 'currency',
					'value' => '',
					'description' => __( 'For example: $', 'kloud' )
				),
				array(
					'type' => 'textarea',
					'heading' => __( 'Featured list', 'kloud' ),
					'param_name' => 'features_list',
					'description' => __( 'Start each feature text from a new line', 'kloud' )
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Button type', 'kloud' ),
					'param_name' => 'button_type',
					'value' => array(
						__( 'Custom', 'kloud' ) => 'custom',
						__( 'Product "add to cart"', 'kloud' ) => 'product',
					),
					'description' => __( 'Set your custom link for button or allow users to add some product to cart', 'kloud' )
				),
				array(
					'type' => 'href',
					'heading' => __( 'Button link', 'kloud'),
					'param_name' => 'link',
					'description' => __( 'Enter URL if you want this box to have a link.', 'kloud' ),
					'dependency' => array(
						'element' => 'button_type',
						'value' => array( 'custom' ),
					),
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Button label', 'kloud' ),
					'param_name' => 'button_label',
					'value' => '',
					'dependency' => array(
						'element' => 'button_type',
						'value' => array( 'custom' ),
					),
				),
				array(
					'type' => 'autocomplete',
					'heading' => __( 'Select identificator', 'kloud' ),
					'param_name' => 'id',
					'description' => __( 'Input product ID or product SKU or product title to see suggestions', 'kloud' ),
					'dependency' => array(
						'element' => 'button_type',
						'value' => array( 'product' ),
					),
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Label text', 'kloud' ),
					'param_name' => 'label',
					'value' => '',
					'description' => __( 'For example: Best option!', 'kloud' )
				),
                 array(
                    "type" => "checkbox",
                    "heading" => __('Pricing Active', 'kloud'),
                    "param_name" => "active",
                    "value" => array(
                        __("Yes, please", 'kloud') => true
                    ),
                ),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Label color', 'kloud' ),
					'param_name' => 'label_color',
					'value' => array(
						'' => '',
						__( 'Red', 'kloud' ) => 'red',
						__( 'Green', 'kloud' ) => 'green',
						__( 'Blue', 'kloud' ) => 'blue',
						__( 'Yellow', 'kloud' ) => 'yellow',
					)
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Extra class name', 'kloud' ),
					'param_name' => 'el_class',
					'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'kloud' )
				),
                array(
                'type' => 'animation_style',
                'heading' => __( 'Animation Style', 'kloud' ),
                'param_name' => 'animation',
                'description' => __( 'Choose your animation style', 'kloud' ),
                'admin_label' => false,
                'weight' => 0,
                )
			)
		));
		// Necessary hooks for blog autocomplete fields
		add_filter( 'vc_autocomplete_pricing_plan_id_callback',	'vc_include_field_search', 10, 1 ); // Get suggestion(find). Must return an array
		add_filter( 'vc_autocomplete_pricing_plan_id_render', 'vc_include_field_render', 10, 1 ); // Render exact product. Must return an array (label,value)
		/**
		 * ------------------------------------------------------------------------------------------------
		 * Map Google Map shortcode
		 * ------------------------------------------------------------------------------------------------
		 */
        vc_map(array(
            "name" => 'Google Maps V3',
            "base" => "maps",
            "category" => __('Shortcode elements', 'kloud'),
        	"icon" => "tb-icon-for-vc",
            "description" => __('Google Maps API V3', 'kloud'),
            "params" => array(
                array(
                    "type" => "textfield",
                    "heading" => __('API Key', 'kloud'),
                    "param_name" => "api",
                    "value" => '',
                    "description" => __('Enter you api key of map, get key from (https://console.developers.google.com)', 'kloud')
                ),
                array(
                    "type" => "textfield",
                    "heading" => __('Address', 'kloud'),
                    "param_name" => "address",
                    "value" => 'New York, United States',
                    "description" => __('Enter address of Map', 'kloud')
                ),
                array(
                    "type" => "textfield",
                    "heading" => __('Coordinate', 'kloud'),
                    "param_name" => "coordinate",
                    "value" => '',
                    "description" => __('Enter coordinate of Map, format input (latitude, longitude)', 'kloud')
                ),
                array(
                    "type" => "checkbox",
                    "heading" => __('Click Show Info window', 'kloud'),
                    "param_name" => "infoclick",
                    "value" => array(
                        __("Yes, please", 'kloud') => true
                    ),
                    "group" => __("Marker", 'kloud'),
                    "description" => __('Click a marker and show info window (Default Show).', 'kloud')
                ),
                array(
                    "type" => "textfield",
                    "heading" => __('Marker Coordinate', 'kloud'),
                    "param_name" => "markercoordinate",
                    "value" => '',
                    "group" => __("Marker", 'kloud'),
                    "description" => __('Enter marker coordinate of Map, format input (latitude, longitude)', 'kloud')
                ),
                array(
                    "type" => "textfield",
                    "heading" => __('Marker Title', 'kloud'),
                    "param_name" => "markertitle",
                    "value" => '',
                    "group" => __("Marker", 'kloud'),
                    "description" => __('Enter Title Info windows for marker', 'kloud')
                ),
                array(
                    "type" => "textarea",
                    "heading" => __('Marker Description', 'kloud'),
                    "param_name" => "markerdesc",
                    "value" => '',
                    "group" => __("Marker", 'kloud'),
                    "description" => __('Enter Description Info windows for marker', 'kloud')
                ),
                array(
                    "type" => "attach_image",
                    "heading" => __('Marker Icon', 'kloud'),
                    "param_name" => "markericon",
                    "value" => '',
                    "group" => __("Marker", 'kloud'),
                    "description" => __('Select image icon for marker', 'kloud')
                ),
                array(
                    "type" => "textarea_raw_html",
                    "heading" => __('Marker List', 'kloud'),
                    "param_name" => "markerlist",
                    "value" => '',
                    "group" => __("Multiple Marker", 'kloud'),
                    "description" => __('[{"coordinate":"41.058846,-73.539423","icon":"","title":"title demo 1","desc":"desc demo 1"},{"coordinate":"40.975699,-73.717636","icon":"","title":"title demo 2","desc":"desc demo 2"},{"coordinate":"41.082606,-73.469718","icon":"","title":"title demo 3","desc":"desc demo 3"}]', 'kloud')
                ),
                array(
                    "type" => "textfield",
                    "heading" => __('Info Window Max Width', 'kloud'),
                    "param_name" => "infowidth",
                    "value" => '200',
                    "group" => __("Marker", 'kloud'),
                    "description" => __('Set max width for info window', 'kloud')
                ),
                array(
                    "type" => "dropdown",
                    "heading" => __("Map Type", 'kloud'),
                    "param_name" => "type",
                    "value" => array(
                        "ROADMAP" => "ROADMAP",
                        "HYBRID" => "HYBRID",
                        "SATELLITE" => "SATELLITE",
                        "TERRAIN" => "TERRAIN"
                    ),
                    "description" => __('Select the map type.', 'kloud')
                ),
                array(
                    "type" => "dropdown",
                    "heading" => __("Style Template", 'kloud'),
                    "param_name" => "style",
                    "value" => array(
                        "Default" => "",
                        "Subtle Grayscale" => "Subtle-Grayscale",
                        "Shades of Grey" => "Shades-of-Grey",
                        "Blue water" => "Blue-water",
                        "Pale Dawn" => "Pale-Dawn",
                        "Blue Essence" => "Blue-Essence",
                        "Apple Maps-esque" => "Apple-Maps-esque",
                    ),
                    "group" => __("Map Style", 'kloud'),
                    "description" => 'Select your heading size for title.'
                ),
                array(
                    "type" => "textfield",
                    "heading" => __('Zoom', 'kloud'),
                    "param_name" => "zoom",
                    "value" => '13',
                    "description" => __('zoom level of map, default is 13', 'kloud')
                ),
                array(
                    "type" => "textfield",
                    "heading" => __('Width', 'kloud'),
                    "param_name" => "width",
                    "value" => 'auto',
                    "description" => __('Width of map without pixel, default is auto', 'kloud')
                ),
                array(
                    "type" => "textfield",
                    "heading" => __('Height', 'kloud'),
                    "param_name" => "height",
                    "value" => '350px',
                    "description" => __('Height of map without pixel, default is 350px', 'kloud')
                ),
                array(
                    "type" => "checkbox",
                    "heading" => __('Scroll Wheel', 'kloud'),
                    "param_name" => "scrollwheel",
                    "value" => array(
                        __("Yes, please", 'kloud') => true
                    ),
                    "group" => __("Controls", 'kloud'),
                    "description" => __('If false, disables scrollwheel zooming on the map. The scrollwheel is disable by default.', 'kloud')
                ),
                array(
                    "type" => "checkbox",
                    "heading" => __('Pan Control', 'kloud'),
                    "param_name" => "pancontrol",
                    "value" => array(
                        __("Yes, please", 'kloud') => true
                    ),
                    "group" => __("Controls", 'kloud'),
                    "description" => __('Show or hide Pan control.', 'kloud')
                ),
                array(
                    "type" => "checkbox",
                    "heading" => __('Zoom Control', 'kloud'),
                    "param_name" => "zoomcontrol",
                    "value" => array(
                        __("Yes, please", 'kloud') => true
                    ),
                    "group" => __("Controls", 'kloud'),
                    "description" => __('Show or hide Zoom Control.', 'kloud')
                ),
                array(
                    "type" => "checkbox",
                    "heading" => __('Scale Control', 'kloud'),
                    "param_name" => "scalecontrol",
                    "value" => array(
                        __("Yes, please", 'kloud') => true
                    ),
                    "group" => __("Controls", 'kloud'),
                    "description" => __('Show or hide Scale Control.', 'kloud')
                ),
                array(
                    "type" => "checkbox",
                    "heading" => __('Map Type Control', 'kloud'),
                    "param_name" => "maptypecontrol",
                    "value" => array(
                        __("Yes, please", 'kloud') => true
                    ),
                    "group" => __("Controls", 'kloud'),
                    "description" => __('Show or hide Map Type Control.', 'kloud')
                ),
                array(
                    "type" => "checkbox",
                    "heading" => __('Street View Control', 'kloud'),
                    "param_name" => "streetviewcontrol",
                    "value" => array(
                        __("Yes, please", 'kloud') => true
                    ),
                    "group" => __("Controls", 'kloud'),
                    "description" => __('Show or hide Street View Control.', 'kloud')
                ),
                array(
                    "type" => "checkbox",
                    "heading" => __('Over View Map Control', 'kloud'),
                    "param_name" => "overviewmapcontrol",
                    "value" => array(
                        __("Yes, please", 'kloud') => true
                    ),
                    "group" => __("Controls", 'kloud'),
                    "description" => __('Show or hide Over View Map Control.', 'kloud')
                )
            )
        ));
        /**
		 * ------------------------------------------------------------------------------------------------
		 * Map button shortcode
		 * ------------------------------------------------------------------------------------------------
		 */

		vc_map( array(
			'name' => __( 'Video Popup', 'kloud' ),
			'base' => 'kloud_button',
			'category' => __( 'Shortcode elements', 'kloud' ),
			'description' => __( 'Simple button in different theme styles', 'kloud' ),
			'params' => array(
                array(
					'type' => 'attach_image',
					'heading' => __( 'Icon Image', 'kloud' ),
					'param_name' => 'img',
					'value' => '',
					'description' => __( 'Select image from media library.', 'kloud' )
				),
				array(
					'type' => 'href',
					'heading' => __( 'Link', 'kloud' ),
					'param_name' => 'link'
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Align', 'kloud' ),
					'param_name' => 'align',
					'value' => array(
						'' => '',
						__( 'left', 'kloud' ) => 'left',
						__( 'center', 'kloud' ) => 'center',
						__( 'right', 'kloud' ) => 'right',
					)
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Extra class name', 'kloud' ),
					'param_name' => 'el_class',
					'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'kloud' )
				)
			),
		));
        /**
		 * ------------------------------------------------------------------------------------------------
		 * Demo Mega Theme shortcode
		 * ------------------------------------------------------------------------------------------------
		 */

		vc_map( array(
			'name' => __( 'Image Demo Theme', 'kloud' ),
			'base' => 'kloud_demo_theme',
			'category' => __( 'Shortcode elements', 'kloud' ),
			'description' => __( 'Simple button in different theme styles', 'kloud' ),
			'params' => array(
                array(
					'type' => 'attach_image',
					'heading' => __( 'Theme Image', 'kloud' ),
					'param_name' => 'img',
					'value' => '',
					'description' => __( 'Select image from media library.', 'kloud' )
				),
				array(
					'type' => 'href',
					'heading' => __( 'Link', 'kloud' ),
					'param_name' => 'link'
				),  
				array(
					'type' => 'textfield',
					'heading' => __( 'Name', 'kloud' ),
					'param_name' => 'name',
				)
			),
		));
            /**
		 * ------------------------------------------------------------------------------------------------
		 * Animator shortcode
		 * ------------------------------------------------------------------------------------------------
		 */
		vc_map( array(
			'name' => __( 'Animator', 'kloud' ),
			'base' => 'animator',
            'is_container' => true,
            'content_element' => true,
            'allowed_container_element' => true,
            'show_settings_on_create' => true,
			'category' => __( 'Shortcode elements', 'kloud' ),
			'description' => __( 'Animation for all shortcode', 'kloud' ),
			'params' => array(
                 array(
                'type' => 'animation_style',
                'heading' => __( 'Animation Style', 'kloud' ),
                'param_name' => 'animation',
                'description' => __( 'Choose your animation style', 'kloud' ),
                'admin_label' => false,
                'weight' => 0,
                ),
               	array(
					'type' => 'textfield',
					'heading' => __( 'Animation Delay', 'kloud' ),
					'param_name' => 'delay',
					'description' => __( 'Add Time Delay For Animation. Example:0.4', 'kloud' )
				),
                array(
					'type' => 'textfield',
					'heading' => __( 'Animation Duration', 'kloud' ),
					'param_name' => 'duration',
					'description' => __( 'Add Time Duration For Animation. Example:0.4', 'kloud' )
				),
                 array(
                    "type" => "checkbox",
                    "heading" => __('Animation Infinite', 'kloud'),
                    "param_name" => "infinite",
                    "value" => array(
                        __("Yes, please", 'kloud') => true
                    ),
                ),
			),
		    "js_view" => 'VcColumnView'
		));
        /**
		 * ------------------------------------------------------------------------------------------------
		 * Map Team Member Shortcode
		 * ------------------------------------------------------------------------------------------------
		 */
		vc_map( array(
			'name' => __( 'Team Member', 'kloud' ),
			'base' => 'team_member',
			'content_element' => true,
			'category' => __( 'Shortcode elements', 'kloud' ),
			'description' => __( 'Display information about some person', 'kloud' ),
			'params' => array(
                array(
					'type' => 'dropdown',
					'heading' => __( 'Layout', 'kloud' ),
					'param_name' => 'layout',
					'value' => array(
						'Hover Content Inner' => 'layout1',
                        'Carousel slider' => 'layout8',
                        'Image Top' => 'layout3',
                        'Hover Content Inner 2' => 'layout4',
                        'Image Top Circle' => 'layout5',
                        'Click Show Content' => 'layout6',
                        'Team Tabs' => 'layout7',
                        'Team Content Top When Click Icon' => 'layout9',
					),
					'description' => __( 'Set numbers of slides you want to display at the same time on slider\'s container for carousel mode.', 'kloud' )
				),
                array(
                    "type" => "checkbox",
                    "heading" => __('Team Active Show Content', 'kloud'),
                    "param_name" => "active",
                    "value" => array(
                        __("Yes, please", 'kloud') => true
                    ),
                    'dependency' => array(
						'element' => 'layout',
						'value' => array( 'layout9' ),
					),
                ),
				array(
					'type' => 'textfield',
					'heading' => __( 'Name', 'kloud' ),
					'param_name' => 'name',
					'value' => '',
					'description' => __( 'User name', 'kloud' )
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Title', 'kloud' ),
					'param_name' => 'position',
					'value' => '',
					'description' => __( 'User title', 'kloud' )
				),
				array(
					'type' => 'attach_image',
					'heading' => __( 'User Avatar', 'kloud' ),
					'param_name' => 'img',
					'value' => '',
					'description' => __( 'Select image from media library.', 'kloud' )
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Image size', 'kloud' ),
					'param_name' => 'img_size',
					'description' => __( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.', 'kloud' )
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Align', 'kloud' ),
					'param_name' => 'align',
					'value' => array(
						__( 'Left', 'kloud' ) => 'left',
						__( 'Center', 'kloud' ) => 'center',
						__( 'Right', 'kloud' ) => 'right',
					),
				),	
				kloud_get_color_scheme_param(),
				array(
					'type' => 'textarea_html',
					'heading' => __( 'Text', 'kloud' ),
					'param_name' => 'content',
					'description' => __( 'You can add some member bio here.', 'kloud' )
				),
                array(
					'type' => 'textfield',
					'heading' => __( 'Text', 'kloud' ),
					'param_name' => 'shortcode',
					'description' => __( 'You can add shortcode to team.', 'kloud' ),
                    'dependency' => array(
						'element' => 'layout',
						'value' => array( 'layout7' ),
					),
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Email', 'kloud' ),
					'param_name' => 'email',
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Facebook link', 'kloud' ),
					'param_name' => 'facebook',
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Twitter link', 'kloud' ),
					'param_name' => 'twitter',
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Google+ link', 'kloud' ),
					'param_name' => 'google_plus',
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Linkedin link', 'kloud' ),
					'param_name' => 'linkedin',
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Skype link', 'kloud' ),
					'param_name' => 'skype',
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Instagram link', 'kloud' ),
					'param_name' => 'instagram',
				),
                array(
					'type' => 'textfield',
					'heading' => __( 'Link button', 'kloud' ),
					'param_name' => 'link_button',
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Social buttons size', 'kloud' ),
					'param_name' => 'size',
					'value' => array(
						__( 'Default', 'kloud' ) => '',
						__( 'Small', 'kloud' ) => 'small',
						__( 'Large', 'kloud' ) => 'large',
					),
				),	
				array(
					'type' => 'dropdown',
					'heading' => __( 'Social buttons style', 'kloud' ),
					'param_name' => 'style',
					'value' => array(
						__( 'Default', 'kloud' ) => '',
						__( 'Circle buttons', 'kloud' ) => 'circle',
						__( 'Colored', 'kloud' ) => 'colored',
						__( 'Colored alternative', 'kloud' ) => 'colored-alt',
					),
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Extra class name', 'kloud' ),
					'param_name' => 'el_class',
					'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'kloud' )
				),
                array(
                'type' => 'animation_style',
                'heading' => __( 'Animation Style', 'kloud' ),
                'param_name' => 'animation',
                'description' => __( 'Choose your animation style', 'kloud' ),
                'admin_label' => false,
                'weight' => 0,
                )
			),
		));
		/**
		 * ------------------------------------------------------------------------------------------------
		 * Map testimonial shortcode
		 * ------------------------------------------------------------------------------------------------
		 */
		vc_map( array(
			'name' => __( 'Testimonials', 'kloud' ),
			'base' => 'testimonials',
			"as_parent" => array('only' => 'testimonial'),
			"content_element" => true,
			"show_settings_on_create" => false,
			'category' => __( 'Shortcode elements', 'kloud' ),
			'description' => __( 'User testimonials slider or grid', 'kloud' ),

			'params' => array(	
                array(
					'type' => 'dropdown',
					'heading' => __( 'Layout Slider', 'kloud' ),
					'param_name' => 'layout',
					'value' => array(
						'Thumbnail slider' => 'layout1',
                        'Carousel slider With Dots' => 'layout2',
                        'Carousel slider With One Nav Next' => 'layout3',
                        'Carousel slider With One Nav Next No Background' => 'layout4',
                        'Carousel slider With Dots And Border' => 'layout5',
					),
					'description' => __( 'Set numbers of slides you want to display at the same time on slider\'s container for carousel mode.', 'kloud' )
				),	
               	array(
					'type' => 'textfield',
					'heading' => __( 'Slider Review', 'kloud' ),
					'param_name' => 'slides_per_view',
					'description' => __( 'Add number slider views.', 'kloud' ),
                    'dependency' => array(
						'element' => 'layout',
						'value' => array( 'layout2' , 'layout3' , 'layout4' , 'layout5' ),
					),
				),
                array(
					'type' => 'attach_image',
					'heading' => __( 'Background', 'kloud' ),
					'param_name' => 'image',
					'value' => '',
					'description' => __( 'Select image from media library.', 'kloud' ),
                    'dependency' => array(
						'element' => 'layout',
						'value' => 'layout1',
					),
				),			
				array(
					'type' => 'textfield',
					'heading' => __( 'Extra class name', 'kloud' ),
					'param_name' => 'el_class',
					'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'kloud' )
				),
                array(
                'type' => 'animation_style',
                'heading' => __( 'Animation Style', 'kloud' ),
                'param_name' => 'animation',
                'description' => __( 'Choose your animation style', 'kloud' ),
                'admin_label' => false,
                'weight' => 0,
                )
			),
		    "js_view" => 'VcColumnView'
		));
 	     
		vc_map( array(
			'name' => __( 'Testimonial', 'kloud' ),
			'base' => 'testimonial',
			'class' => '',
			"as_child" => array('only' => 'testimonials'),
			"content_element" => true,
			'category' => __( 'Shortcode elements', 'kloud' ),
			'description' => __( 'User testimonial', 'kloud' ),
			'params' => array(
                array(
					'type' => 'dropdown',
					'heading' => __( 'Layout Slider', 'kloud' ),
					'param_name' => 'layout',
					'value' => array(
						'Thumbnail slider' => 'layout1',
                        'Carousel slider With Dots' => 'layout2',
                        'Carousel slider With One Nav Next' => 'layout3',
                        'Carousel slider With One Nav Next No Background' => 'layout4',
                        'Carousel slider With Dots And Border' => 'layout5',
					),
					'description' => __( 'Set layout for testimonial.', 'kloud' )
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Name', 'kloud' ),
					'param_name' => 'name',
					'value' => '',
					'description' => __( 'User name', 'kloud' )
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Title', 'kloud' ),
					'param_name' => 'title',
					'value' => '',
					'description' => __( 'User title', 'kloud' )
				),
				array(
					'type' => 'attach_image',
					'heading' => __( 'User Avatar', 'kloud' ),
					'param_name' => 'image',
					'value' => '',
					'description' => __( 'Select image from media library.', 'kloud' )
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Image size', 'kloud' ),
					'param_name' => 'img_size',
					'description' => __( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.', 'kloud' )
				),
				array(
					'type' => 'textarea_html',
					'holder' => 'div',
					'heading' => __( 'Text', 'kloud' ),
					'param_name' => 'content'
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Extra class name', 'kloud' ),
					'param_name' => 'el_class',
					'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'kloud' )
				)
			)
		));

         /**
		 * ------------------------------------------------------------------------------------------------
		 * Map team shortcode
		 * ------------------------------------------------------------------------------------------------
		 */
		vc_map( array(
			'name' => __( 'Teams', 'kloud' ),
			'base' => 'teams',
			"as_parent" => array('only' => 'team_member'),
			"content_element" => true,
			"show_settings_on_create" => false,
			'category' => __( 'Shortcode elements', 'kloud' ),
			'description' => __( 'User teams slider or grid', 'kloud' ),
			'params' => array(	
                  array(
					'type' => 'dropdown',
					'heading' => __( 'Layout', 'kloud' ),
					'param_name' => 'layout',
					'value' => array(
						'Slider thumbnail' => '1',
                        'Tabs Slider' => '2',
					),
					'description' => __( 'Set numbers of slides you want to display at the same time on slider\'s container for carousel mode.', 'kloud' )
				),
               	array(
					'type' => 'textfield',
					'heading' => __( 'Slider Review', 'kloud' ),
					'param_name' => 'slides_per_view',
					'description' => __( 'Add number slider views.', 'kloud' ),
                    'dependency' => array(
						'element' => 'layout',
						'value' => array('1'),
					),
				),			
				array(
					'type' => 'textfield',
					'heading' => __( 'Extra class name', 'kloud' ),
					'param_name' => 'el_class',
					'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'kloud' )
				),
			),
		    "js_view" => 'VcColumnView'
		));
		/**
		 * ------------------------------------------------------------------------------------------------
		 * Map instagram shortcode
		 * ------------------------------------------------------------------------------------------------
		 */

		vc_map(array(
			'name' => __( 'Instagram', 'kloud' ),
			'base' => 'kloud_instagram',
			'class' => '',
			'category' => __( 'Shortcode elements', 'kloud' ),
			'description' => __( 'Instagram photos', 'kloud' ),
			'params' =>  kloud_get_instagram_params()
		));


		/**
		 * ------------------------------------------------------------------------------------------------
		 * Map Author Widget shortcode
		 * ------------------------------------------------------------------------------------------------
		 */

		vc_map(array(
			'name' => __( 'Author area', 'kloud' ),
			'base' => 'author_area',
			'class' => '',
			'category' => __( 'Shortcode elements', 'kloud' ),
			'description' => __( 'Widget for author information', 'kloud' ),
			'params' =>  kloud_get_author_area_params()
		));

		/**
		 * ------------------------------------------------------------------------------------------------
		 * Map promo banner shortcode
		 * ------------------------------------------------------------------------------------------------
		 */

		vc_map(array(
			'name' => __( 'Promo Banner', 'kloud' ),
			'base' => 'promo_banner',
			'class' => '',
			'category' => __( 'Shortcode elements', 'kloud' ),
			'description' => __( 'Promo image with text and hover effect', 'kloud' ),
			'params' =>  kloud_get_banner_params()
		));

		/**
		 * ------------------------------------------------------------------------------------------------
		 * Map banners carousel shortcode
		 * ------------------------------------------------------------------------------------------------
		 */
		vc_map( array(
			'name' => __( 'Infobox carousel', 'kloud' ),
			'base' => 'banners_carousel',
			"as_parent" => array('only' => 'kloud_info_box' ),
			"content_element" => true,
			"show_settings_on_create" => true,
			'category' => __( 'Shortcode elements', 'kloud' ),
			'description' => __( 'Show your banners as a carousel', 'kloud' ),
			'params' => array(
				array(
					'type' => 'dropdown',
					'heading' => __( 'Slides per view', 'kloud' ),
					'param_name' => 'slides_per_view',
					'value' => array(
						1,2,3,4,5,6,7,8
					),
					'description' => __( 'Set numbers of slides you want to display at the same time on slider\'s container for carousel mode.', 'kloud' )
				),
				array(
					'type' => 'checkbox',
					'heading' => __( 'Slider autoplay', 'kloud' ),
					'param_name' => 'autoplay',
					'description' => __( 'Enables autoplay mode.', 'kloud' ),
					'value' => array( __( 'Yes, please', 'kloud' ) => 'yes' ),
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Slider speed', 'kloud' ),
					'param_name' => 'speed',
					'value' => '5000',
					'description' => __( 'Duration of animation between slides (in ms)', 'kloud' ),
				),
				array(
					'type' => 'checkbox',
					'heading' => __( 'Hide pagination control', 'kloud' ),
					'param_name' => 'hide_pagination_control',
					'description' => __( 'If "YES" pagination control will be removed', 'kloud' ),
					'value' => array( __( 'Yes, please', 'kloud' ) => 'yes' ),
				),
				array(
					'type' => 'checkbox',
					'heading' => __( 'Hide prev/next buttons', 'kloud' ),
					'param_name' => 'hide_prev_next_buttons',
					'description' => __( 'If "YES" prev/next control will be removed', 'kloud' ),
					'value' => array( __( 'Yes, please', 'kloud' ) => 'yes' ),
				),
				array(
					'type' => 'checkbox',
					'heading' => __( 'Slider loop', 'kloud' ),
					'param_name' => 'wrap',
					'description' => __( 'Enables loop mode.', 'kloud' ),
					'value' => array( __( 'Yes, please', 'kloud' ) => 'yes' ),
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Extra class name', 'kloud' ),
					'param_name' => 'el_class',
					'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'kloud' )
				),
			),
		    "js_view" => 'VcColumnView'
		));

        /**
		 * ------------------------------------------------------------------------------------------------
		 * Logo shortcode
		 * ------------------------------------------------------------------------------------------------
		 */

		vc_map(array(
			'name' => __( 'Logo', 'kloud' ),
			'base' => 'kloud_log_bn',
			'class' => '',
			'category' => __( 'Shortcode elements', 'kloud' ),
			'description' => __( 'Logo Banner', 'kloud' ),
			'params' => array(
				array(
					'type' => 'attach_images',
					'heading' => __( 'Images', 'kloud' ),
					'param_name' => 'image',
					'value' => '',
					'description' => __( 'Select images from media library.', 'kloud' )
				),
              	array(
					'type' => 'dropdown',
					'heading' => __( 'Columns', 'kloud' ),
					'param_name' => 'columns',
					'description' => __( 'How much columns grid', 'kloud' ),
					'value' => array(
						'1 column' => 1,
						'2 column' => 2,
						'3 column' => 3,
						'4 column' => 4,
                        '5 column' => 5,
						'6 column' => 6,
					),
				),
			)
		));
         /**
		 * ------------------------------------------------------------------------------------------------
		 * Button shortcode
		 * ------------------------------------------------------------------------------------------------
		 */

		vc_map(array(
			'name' => __( 'Button Kloud', 'kloud' ),
			'base' => 'kloud_button_click',
			'class' => '',
			'category' => __( 'Shortcode elements', 'kloud' ),
			'description' => __( 'Button', 'kloud' ),
			'params' => array(
                 array(
					'type' => 'colorpicker',
					'heading' => __( 'Button Background', 'kloud' ),
					'param_name' => 'color'
				),
                array(
					'type' => 'colorpicker',
					'heading' => __( 'Button Background 2', 'kloud' ),
					'param_name' => 'color2'
				),
  	             array(
					'type' => 'textfield',
					'heading' => __( 'Link', 'kloud' ),
					'param_name' => 'link',
					'description' => __( 'Add Link For button.', 'kloud' )
				),
                array(
					'type' => 'textfield',
					'heading' => __( 'Text Button', 'kloud' ),
					'param_name' => 'btn_text',
					'description' => __( 'Add Text For button.', 'kloud' )
				),
                array(
					'type' => 'textfield',
					'heading' => __( 'Text Width', 'kloud' ),
					'param_name' => 'width',
					'description' => __( 'Add Width For button.', 'kloud' )
				),
                array(
					'type' => 'textfield',
					'heading' => __( ' Height Button', 'kloud' ),
					'param_name' => 'height',
					'description' => __( 'Add Height For button.', 'kloud' )
				),
                array(
					'type' => 'textfield',
					'heading' => __( 'Radius Button', 'kloud' ),
					'param_name' => 'radius',
					'description' => __( 'Add Radius For button.', 'kloud' )
				),
                array(
					'type' => 'textfield',
					'heading' => __( 'Class', 'kloud' ),
					'param_name' => 'el_class',
					'description' => __( 'Add Class For button.', 'kloud' )
				),
                
              	array(
					'type' => 'dropdown',
					'heading' => __( 'Position', 'kloud' ),
					'param_name' => 'position',
					'description' => __( 'Choose position for button', 'kloud' ),
					'value' => array(
						'Left' => 'left',
						'right' => 'right',
                        'center' => 'center',
					),
				),
                 array(
                'type' => 'animation_style',
                'heading' => __( 'Animation Style', 'kloud' ),
                'param_name' => 'animation',
                'description' => __( 'Choose your animation style', 'kloud' ),
                'admin_label' => false,
                'weight' => 0,
                )
			)
		));
         /**
		 * ------------------------------------------------------------------------------------------------
		 * Heading Two Color Shortcode
		 * ------------------------------------------------------------------------------------------------
		 */

		vc_map(array(
			'name' => __( 'Heading Two Color', 'kloud' ),
			'base' => 'headingtwo',
			'class' => '',
			'category' => __( 'Shortcode elements', 'kloud' ),
			'description' => __( 'Button', 'kloud' ),
			'params' => array(
                 array(
					'type' => 'colorpicker',
					'heading' => __( 'Color 1', 'kloud' ),
					'param_name' => 'color'
				),
                array(
					'type' => 'colorpicker',
					'heading' => __( 'Color 2', 'kloud' ),
					'param_name' => 'color2'
				),
  	             array(
					'type' => 'textfield',
					'heading' => __( 'Title', 'kloud' ),
					'param_name' => 'title',
				),
                 array(
					'type' => 'textfield',
					'heading' => __( 'Title 2', 'kloud' ),
					'param_name' => 'title2',
				),
                array(
					'type' => 'textfield',
					'heading' => __( 'Font Size 1', 'kloud' ),
					'param_name' => 'font_size1',
				),
                array(
					'type' => 'textfield',
					'heading' => __( 'Font Size 2', 'kloud' ),
					'param_name' => 'font_size2',
				),
                array(
					'type' => 'textfield',
					'heading' => __( 'Font Weight 1', 'kloud' ),
					'param_name' => 'font_weight1',
				),
                array(
					'type' => 'textfield',
					'heading' => __( 'Font Weight 2', 'kloud' ),
					'param_name' => 'font_weight2',
				),
                array(
					'type' => 'textfield',
					'heading' => __( 'Class', 'kloud' ),
					'param_name' => 'el_class',
				),
              	array(
					'type' => 'dropdown',
					'heading' => __( 'Position', 'kloud' ),
					'param_name' => 'position',
					'description' => __( 'Choose position for button', 'kloud' ),
					'value' => array(
						'Left' => 'left',
						'right' => 'right',
                        'center' => 'center',
					),
				),
                 array(
                'type' => 'animation_style',
                'heading' => __( 'Animation Style', 'kloud' ),
                'param_name' => 'animation',
                'description' => __( 'Choose your animation style', 'kloud' ),
                'admin_label' => false,
                'weight' => 0,
                )
			)
		));
		/**
		 * ------------------------------------------------------------------------------------------------
		 * Map countdown timer
		 * ------------------------------------------------------------------------------------------------
		 */

		vc_map(array(
			'name' => __( 'Countdown timer', 'kloud' ),
			'base' => 'kloud_countdown_timer',
			'class' => '',
			'category' => __( 'Shortcode elements', 'kloud' ),
			'description' => __( 'Shows countdown timer', 'kloud' ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => __( 'Date', 'kloud' ),
					'param_name' => 'date',
					'description' => __( 'Final date in the format Y/m/d. For example 2017/12/12', 'kloud' )
				),
				kloud_get_color_scheme_param(),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Size', 'kloud' ),
					'param_name' => 'size',
					'value' => array(
						'' => '',
						__( 'Small', 'kloud' ) => 'small',
						__( 'Medium', 'kloud' ) => 'medium',
						__( 'Large', 'kloud' ) => 'large',
					)
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Align', 'kloud' ),
					'param_name' => 'align',
					'value' => array(
						'' => '',
						__( 'left', 'kloud' ) => 'left',
						__( 'center', 'kloud' ) => 'center',
						__( 'right', 'kloud' ) => 'right',
					)
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Style', 'kloud' ),
					'param_name' => 'style',
					'value' => array(
						'' => '',
						__( 'Standard', 'kloud' ) => 'standard',
						__( 'Transparent', 'kloud' ) => 'transparent',
					)
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Extra class name', 'kloud' ),
					'param_name' => 'el_class',
					'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'kloud' )
				)
			)
		));

		/**
		 * ------------------------------------------------------------------------------------------------
		 * Information box with image (icon)
		 * ------------------------------------------------------------------------------------------------
		 */

		vc_map(array(
			'name' => __( 'Information box', 'kloud' ),
			'base' => 'kloud_info_box',
			'class' => '',
			'category' => __( 'Shortcode elements', 'kloud' ),
			'description' => __( 'Show some brief information', 'kloud' ),
			'params' => array(
                array(
					'type' => 'dropdown',
					'heading' => __( 'Layout', 'kloud' ),
					'param_name' => 'layout',
					'value' => array(
						'Layout Left Icon' => 'left_icon',
                        'Layout Top Icon' => 'top_icon',
                        'Layout Process' => 'process_icon',
                        'Layout Left Icon No Background' => 'left_icon_2',
                        'Layout Top With Border' => 'top_icon_border',
					),
					'description' => __( 'Set layout for infobox', 'kloud' )
				),
            	array(
					'type' => 'textfield',
					'heading' => __( 'Icon', 'kloud' ),
					'param_name' => 'icon',
					'description' => __( 'Add Class icon form http://fontawesome.io Example: comment-o  ', 'kloud' )
				),
                array(
					'type' => 'colorpicker',
					'heading' => __( 'Icon color', 'kloud' ),
					'param_name' => 'color'
				),
				array(
					'type' => 'attach_image',
					'heading' => __( 'Image', 'kloud' ),
					'param_name' => 'image',
					'value' => '',
					'description' => __( 'Select image from media library.', 'kloud' )
				),

                 array(
					'type' => 'textfield',
					'heading' => __( 'Title Icon', 'kloud' ),
					'param_name' => 'title_icon',
					'dependency' => array(
						'element' => 'layout',
						'value' => array( 'top_icon_border' ),
					),
				),
                array(
					'type' => 'textfield',
					'heading' => __( 'Number Process', 'kloud' ),
					'param_name' => 'number',
					'dependency' => array(
						'element' => 'layout',
						'value' => array( 'process_icon' ),
					),
				),
                
				array(
					'type' => 'textfield',
					'heading' => __( 'Image size', 'kloud' ),
					'param_name' => 'img_size',
					'description' => __( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.', 'kloud' )
				),
                 array(
                    "type" => "checkbox",
                    "heading" => __('Process Active', 'kloud'),
                    "param_name" => "active",
                    "value" => array(
                        __("Yes, please", 'kloud') => true
                    ),
                    'dependency' => array(
						'element' => 'layout',
						'value' => array( 'process_icon' ),
					),
                ),
				array(
					'type' => 'textarea_html',
					'holder' => 'div',
					'heading' => __( 'Brief content', 'kloud' ),
					'param_name' => 'content',
					'description' => __( 'Add here few words to your banner image.', 'kloud' )
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Text alignment', 'kloud' ),
					'param_name' => 'alignment',
					'value' => array(
						__( 'Align left', 'kloud' ) => '',
						__( 'Align right', 'kloud' ) => 'right',
						__( 'Align center', 'kloud' ) => 'center'
					),
					'description' => __( 'Select image alignment.', 'kloud' )
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Image position', 'kloud' ),
					'param_name' => 'image_alignment',
					'value' => array(
						__( 'Top', 'kloud' ) => 'top',
						__( 'Left', 'kloud' ) => 'left',
					)
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Hover', 'kloud' ),
					'param_name' => 'hover',
					'value' => array(
						__( 'BoxShaw', 'kloud' ) => 'hover1',
						__( 'Gradient Background', 'kloud' ) => 'hover2',
					)
				),
				array(
					'type' => 'checkbox',
					'heading' => __( 'New CSS structure', 'kloud' ),
					'param_name' => 'new_styles',
					'description' => __( 'Use improved version with CSS flexbox that was added in 2.9 version.', 'kloud' ),
					'value' => array( __( 'Yes, please', 'kloud' ) => 'yes' ),
				),
                array(
					'type' => 'textfield',
					'heading' => __( 'Link Box', 'kloud' ),
					'param_name' => 'link',
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Extra class name', 'kloud' ),
					'param_name' => 'el_class',
					'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'kloud' )
				),
                 array(
                'type' => 'animation_style',
                'heading' => __( 'Animation Style', 'kloud' ),
                'param_name' => 'animation',
                'description' => __( 'Choose your animation style', 'kloud' ),
                'admin_label' => false,
                'weight' => 0,
                )
			)
		));
        /**
		 * ------------------------------------------------------------------------------------------------
		 * Information box with image (icon)
		 * ------------------------------------------------------------------------------------------------
		 */

		vc_map(array(
			'name' => __( 'Counter Up', 'kloud' ),
			'base' => 'kloud_counter_up',
			'class' => '',
			'category' => __( 'Shortcode elements', 'kloud' ),
			'description' => __( 'Show some brief information', 'kloud' ),
			'params' => array(
                array(
					'type' => 'dropdown',
					'heading' => __( 'Layout', 'kloud' ),
					'param_name' => 'layout',
					'value' => array(
						__( 'Icon Left', 'kloud' ) => 'layout1',
						__( 'Icon Top', 'kloud' ) => 'layout2',
					)
				),
                array(
					'type' => 'textfield',
					'heading' => __( 'Icon', 'kloud' ),
					'param_name' => 'icon',
                    'description' => 'Add class for icon from ionicons.com'
				),
            	array(
					'type' => 'textfield',
					'heading' => __( 'Label', 'kloud' ),
					'param_name' => 'label',
				),
                array(
					'type' => 'textfield',
					'heading' => __( 'Value', 'kloud' ),
					'param_name' => 'value',
				),
                array(
					'type' => 'textfield',
					'heading' => __( 'Class', 'kloud' ),
					'param_name' => 'el_class',
				),
                
                 array(
                'type' => 'animation_style',
                'heading' => __( 'Animation Style', 'kloud' ),
                'param_name' => 'animation',
                'description' => __( 'Choose your animation style', 'kloud' ),
                'admin_label' => false,
                'weight' => 0,
                )
			)
		));
        /** 
        Portfolio Filter
        **/
       	$order_by_values = array(
			'',
			__( 'Date', 'kloud' ) => 'date',
			__( 'ID', 'kloud' ) => 'ID',
			__( 'Title', 'kloud' ) => 'title',
			__( 'Modified', 'kloud' ) => 'modified',
		);

		$order_way_values = array(
			'',
			__( 'Descending', 'kloud' ) => 'DESC',
			__( 'Ascending', 'kloud' ) => 'ASC',
		);
        vc_map( array(
			'name' => __( 'Portfolio', 'kloud' ),
			'base' => 'kloud_portfolio',
			'category' => __( 'Shortcode elements', 'kloud' ),
			'description' => __( 'Showcase your projects or gallery', 'kloud' ),
			'params' => array(
                array(
					'type' => 'dropdown',
					'heading' => __( 'Layout', 'kloud' ),
					'param_name' => 'layout',
					'value' => array(
	                    'Grid' => 'grid',
                        'Masonry 1' => 'masonry',
                        'Masonry 2' => 'masonry2',
                        'Metro' => 'metro',
                        'Grid On Menu' => 'grid2',
					)
				),
                array(
					'type' => 'dropdown',
					'heading' => __( 'Nav Style', 'kloud' ),
					'param_name' => 'style',
					'value' => array(
	                    'Style 1' => 'st1',
                        'Style 2' => 'st2',
                        'Style 3' => 'st3',
					)
				),
                array(
					'type' => 'dropdown',
					'heading' => __( 'Hover Style', 'kloud' ),
					'param_name' => 'hover_style',
					'value' => array(
	                    'Style Main Color' => 'hover1',
                        'Style Dark Color' => 'hover2',
					)
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Number of posts per page', 'kloud' ),
					'param_name' => 'posts_per_page'
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Columns', 'kloud' ),
					'param_name' => 'columns',
					'value' => array(
	                     2,
	                     3,
	                     4,
	                     6,
					)
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Space between projects', 'kloud' ),
					'param_name' => 'spacing',
					'value' => array(
	                     0,
	                     2,
	                     6,
	                     10,
	                     20,
	                     30,
                         15,
					)
				),
				array(
					'type' => 'checkbox',
					'heading' => __( 'Show categories filters', 'kloud' ),
					'param_name' => 'filters',
					'value' => array( __( 'Yes, please', 'kloud' ) => 1 )
				),
                
				array(
					'type' => 'dropdown',
					'heading' => __( 'Order by', 'kloud' ),
					'param_name' => 'orderby',
					'value' => $order_by_values,
					'save_always' => true,
					'description' => sprintf( __( 'Select how to sort retrieved projects. More at %s.', 'kloud' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Sort order', 'kloud' ),
					'param_name' => 'order',
					'value' => $order_way_values,
					'save_always' => true,
					'description' => sprintf( __( 'Designates the ascending or descending order. More at %s.', 'kloud' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Pagination', 'kloud' ),
					'param_name' => 'pagination',
					'value' => array(
	                    '' => '',
	                    'Pagination' => 'pagination',
	                    '"Load more" button' => 'more-btn',
	                    'Disable' => 'disable',
					),
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Extra class name', 'kloud' ),
					'param_name' => 'el_class',
					'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'kloud' )
				),
                array(
					'type' => 'textfield',
					'heading' => __( 'Image Size', 'kloud' ),
					'param_name' => 'img_size',
					'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'kloud' )
				),
                 array(
                'type' => 'animation_style',
                'heading' => __( 'Animation Style', 'kloud' ),
                'param_name' => 'animation',
                'description' => __( 'Choose your animation style', 'kloud' ),
                'admin_label' => false,
                'weight' => 0,
                )
			),
		));

		/**
		 * ------------------------------------------------------------------------------------------------
		 * Add options to columns and text block 
		 * ------------------------------------------------------------------------------------------------
		 */

		add_action( 'init', 'kloud_update_vc_column');

		if( ! function_exists( 'kloud_update_vc_column' ) ) {
			function kloud_update_vc_column() {
				if(!function_exists('vc_map')) return;
				vc_remove_param( 'vc_column', 'el_class' );
				
		        vc_add_param( 'vc_column', kloud_get_color_scheme_param() ); 
				
		        vc_add_param( 'vc_column', array(
		            'type' => 'textfield',
		            'heading' => __( 'Extra class name', 'kloud' ),
		            'param_name' => 'el_class',
		            'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'kloud' )
		        ) ); 

				vc_remove_param( 'vc_column_text', 'el_class' );
				
		        vc_add_param( 'vc_column_text', kloud_get_color_scheme_param() ); 
				
		        vc_add_param( 'vc_column_text', array(
		            'type' => 'textfield',
		            'heading' => __( 'Extra class name', 'kloud' ),
		            'param_name' => 'el_class',
		            'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'kloud' )
		        ) ); 
			}
		}


		/**
		 * ------------------------------------------------------------------------------------------------
		 * Add new element to VC: Categories [kloud_categories]
		 * ------------------------------------------------------------------------------------------------
		 */


		$order_by_values = array(
			'',
			__( 'Date', 'kloud' ) => 'date',
			__( 'ID', 'kloud' ) => 'ID',
			__( 'Author', 'kloud' ) => 'author',
			__( 'Title', 'kloud' ) => 'title',
			__( 'Modified', 'kloud' ) => 'modified',
			__( 'Random', 'kloud' ) => 'rand',
			__( 'Comment count', 'kloud' ) => 'comment_count',
			__( 'Menu order', 'kloud' ) => 'menu_order',
			__( 'As IDs or slugs provided order', 'kloud' ) => 'include',
		);

		$order_way_values = array(
			'',
			__( 'Descending', 'kloud' ) => 'DESC',
			__( 'Ascending', 'kloud' ) => 'ASC',
		);

		vc_map( array(
			'name' => __( 'Product categories', 'kloud' ),
			'base' => 'kloud_categories',
			'class' => '',
			'category' => __( 'Shortcode elements', 'kloud' ),
			'description' => __( 'Product categories grid', 'kloud' ), 
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => __( 'Title', 'kloud' ),
					'param_name' => 'title',
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Number', 'kloud' ),
					'param_name' => 'number',
					'description' => __( 'The `number` field is used to display the number of categories.', 'kloud' ),
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Order by', 'kloud' ),
					'param_name' => 'orderby',
					'value' => $order_by_values,
					'save_always' => true,
					'description' => sprintf( __( 'Select how to sort retrieved categories. More at %s.', 'kloud' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Sort order', 'kloud' ),
					'param_name' => 'order',
					'value' => $order_way_values,
					'save_always' => true,
					'description' => sprintf( __( 'Designates the ascending or descending order. More at %s.', 'kloud' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Layout', 'kloud' ),
					'value' => 4,
					'param_name' => 'style',
					'save_always' => true,
					'description' => __( 'Try out our creative styles for categories block', 'kloud' ),
					'value' => array(
						'Default' => 'default',
						'Carousel' => 'carousel',
					)
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Slides per view', 'kloud' ),
					'param_name' => 'slides_per_view',
					'value' => array(
						1,2,3,4,5,6,7,8
					),
					'dependency' => array(
						'element' => 'style',
						'value' => array( 'carousel' ),
					),
					'description' => __( 'Set numbers of slides you want to display at the same time on slider\'s container for carousel mode.', 'kloud' )
				),
				array(
					'type' => 'checkbox',
					'heading' => __( 'Hide pagination control', 'kloud' ),
					'param_name' => 'hide_pagination_control',
					'description' => __( 'If "YES" pagination control will be removed', 'kloud' ),
					'value' => array( __( 'Yes, please', 'kloud' ) => 'yes' ),
					'dependency' => array(
						'element' => 'style',
						'value' => array( 'carousel' ),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => __( 'Hide prev/next buttons', 'kloud' ),
					'param_name' => 'hide_prev_next_buttons',
					'description' => __( 'If "YES" prev/next control will be removed', 'kloud' ),
					'value' => array( __( 'Yes, please', 'kloud' ) => 'yes' ),
					'dependency' => array(
						'element' => 'style',
						'value' => array( 'carousel' ),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => __( 'Slider loop', 'kloud' ),
					'param_name' => 'wrap',
					'description' => __( 'Enables loop mode.', 'kloud' ),
					'value' => array( __( 'Yes, please', 'kloud' ) => 'yes' ),
					'dependency' => array(
						'element' => 'style',
						'value' => array( 'carousel' ),
					),
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Hide empty', 'kloud' ),
					'param_name' => 'hide_empty',
					'description' => __( 'Hide empty', 'kloud' ),
				),
				array(
					'type' => 'autocomplete',
					'heading' => __( 'Categories', 'kloud' ),
					'param_name' => 'ids',
					'settings' => array(
						'multiple' => true,
						'sortable' => true,
					),
					'save_always' => true,
					'description' => __( 'List of product categories', 'kloud' ),
				)
			)
		) );

		//Filters For autocomplete param:
		//For suggestion: vc_autocomplete_[shortcode_name]_[param_name]_callback
		add_filter( 'vc_autocomplete_kloud_categories_ids_callback', 'kloud_productCategoryCategoryAutocompleteSuggester', 10, 1 ); // Get suggestion(find). Must return an array
		add_filter( 'vc_autocomplete_kloud_categories_ids_render', 'kloud_productCategoryCategoryRenderByIdExact', 10, 1 ); 

		if( ! function_exists( 'kloud_productCategoryCategoryAutocompleteSuggester' ) ) {
			function kloud_productCategoryCategoryAutocompleteSuggester( $query, $slug = false ) {
				global $wpdb;
				$cat_id = (int) $query;
				$query = trim( $query );
				$post_meta_infos = $wpdb->get_results(
					$wpdb->prepare( "SELECT a.term_id AS id, b.name as name, b.slug AS slug
								FROM {$wpdb->term_taxonomy} AS a
								INNER JOIN {$wpdb->terms} AS b ON b.term_id = a.term_id
								WHERE a.taxonomy = 'product_cat' AND (a.term_id = '%d' OR b.slug LIKE '%%%s%%' OR b.name LIKE '%%%s%%' )",
						$cat_id > 0 ? $cat_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );

				$result = array();
				if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
					foreach ( $post_meta_infos as $value ) {
						$data = array();
						$data['value'] = $slug ? $value['slug'] : $value['id'];
						$data['label'] = __( 'Id', 'kloud' ) . ': ' .
						                 $value['id'] .
						                 ( ( strlen( $value['name'] ) > 0 ) ? ' - ' . __( 'Name', 'kloud' ) . ': ' .
						                                                      $value['name'] : '' ) .
						                 ( ( strlen( $value['slug'] ) > 0 ) ? ' - ' . __( 'Slug', 'kloud' ) . ': ' .
						                                                      $value['slug'] : '' );
						$result[] = $data;
					}
				}

				return $result;
			}
		}
		if( ! function_exists( 'kloud_productCategoryCategoryRenderByIdExact' ) ) {
			function kloud_productCategoryCategoryRenderByIdExact( $query ) {
				global $wpdb;
				$query = $query['value'];
				$cat_id = (int) $query;
				$term = get_term( $cat_id, 'product_cat' );

				return kloud_productCategoryTermOutput( $term );
			}
		}

		if( ! function_exists( 'kloud_productCategoryTermOutput' ) ) {
			function kloud_productCategoryTermOutput( $term ) {
				$term_slug = $term->slug;
				$term_title = $term->name;
				$term_id = $term->term_id;

				$term_slug_display = '';
				if ( ! empty( $term_sku ) ) {
					$term_slug_display = ' - ' . __( 'Sku', 'kloud' ) . ': ' . $term_slug;
				}

				$term_title_display = '';
				if ( ! empty( $product_title ) ) {
					$term_title_display = ' - ' . __( 'Title', 'kloud' ) . ': ' . $term_title;
				}

				$term_id_display = __( 'Id', 'kloud' ) . ': ' . $term_id;

				$data = array();
				$data['value'] = $term_id;
				$data['label'] = $term_id_display . $term_title_display . $term_slug_display;

				return ! empty( $data ) ? $data : false;
			}
		}

		/**
		 * ------------------------------------------------------------------------------------------------
		 * Add new element to VC: Posts [kloud_posts]
		 * ------------------------------------------------------------------------------------------------
		 */

		vc_map( array(
			'name' => __( 'Posts carousel', 'kloud' ),
			'base' => 'kloud_posts',
			'class' => '',
			'category' => __( 'Shortcode elements', 'kloud' ),
			'description' => __( 'Animated carousel with posts', 'kloud' ), 
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => __( 'Slider title', 'kloud' ),
					'param_name' => 'title',
				),
				array(
					'type' => 'loop',
					'heading' => __( 'Carousel content', 'kloud' ),
					'param_name' => 'posts_query',
					'settings' => array(
						'size' => array( 'hidden' => false, 'value' => 10 ),
						'post_type' => array( 'value' => 'post' ),
						'order_by' => array( 'value' => 'date' )
					),
					'description' => __( 'Create WordPress loop, to populate content from your site.', 'kloud' )
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Images size', 'kloud' ),
					'param_name' => 'img_size',
					'description' => __( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.', 'kloud' )
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Slider speed', 'kloud' ),
					'param_name' => 'speed',
					'value' => '5000',
					'description' => __( 'Duration of animation between slides (in ms)', 'kloud' )
				),
                	array(
					'type' => 'textfield',
					'heading' => __( 'Space Item', 'kloud' ),
					'param_name' => 'space',
					'value' => '15',
					'description' => __( 'Enter Space bewen item', 'kloud' ),
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Slides per view', 'kloud' ),
					'param_name' => 'slides_per_view',
					'value' => array(
						1,2,3,4,5,6,7,8
					),
					'description' => __( 'Set numbers of slides you want to display at the same time on slider\'s container for carousel mode. Also supports for "auto" value, in this case it will fit slides depending on container\'s width. "auto" mode doesn\'t compatible with loop mode.', 'kloud' )
				),
				array(
					'type' => 'checkbox',
					'heading' => __( 'Scroll per page', 'kloud' ),
					'param_name' => 'scroll_per_page',
					'description' => __( 'Scroll per page not per item. This affect next/prev buttons and mouse/touch dragging.', 'kloud' ),
					'value' => array( __( 'Yes, please', 'kloud' ) => 'yes' )
				),
				array(
					'type' => 'checkbox',
					'heading' => __( 'Slider autoplay', 'kloud' ),
					'param_name' => 'autoplay',
					'description' => __( 'Enables autoplay mode.', 'kloud' ),
					'value' => array( __( 'Yes, please', 'kloud' ) => 'yes' )
				),
				array(
					'type' => 'checkbox',
					'heading' => __( 'Hide pagination control', 'kloud' ),
					'param_name' => 'hide_pagination_control',
					'description' => __( 'If "YES" pagination control will be removed', 'kloud' ),
					'value' => array( __( 'Yes, please', 'kloud' ) => 'yes' )
				),
				array(
					'type' => 'checkbox',
					'heading' => __( 'Hide prev/next buttons', 'kloud' ),
					'param_name' => 'hide_prev_next_buttons',
					'description' => __( 'If "YES" prev/next control will be removed', 'kloud' ),
					'value' => array( __( 'Yes, please', 'kloud' ) => 'yes' )
				),
				array(
					'type' => 'checkbox',
					'heading' => __( 'Slider loop', 'kloud' ),
					'param_name' => 'wrap',
					'description' => __( 'Enables loop mode.', 'kloud' ),
					'value' => array( __( 'Yes, please', 'kloud' ) => 'yes' )
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Layout Blog Slider', 'kloud' ),
					'param_name' => 'blog_layout',
					'value' => array(
						' Layout 1' => 1,
						'Layout 2' => 2,
					),
				),
                  array(
                    "type" => "checkbox",
                    "heading" => __('Show Thumbnail', 'kloud'),
                    "param_name" => "thumbnail_show",
                    "value" => array(
                        __("Yes, please", 'kloud') => true
                    ),
                ),
                 array(
                    "type" => "checkbox",
                    "heading" => __('Show like', 'kloud'),
                    "param_name" => "like",
                    "value" => array(
                        __("Yes, please", 'kloud') => true
                    ),
                ),
                array(
                    "type" => "checkbox",
                    "heading" => __('Show review', 'kloud'),
                    "param_name" => "review",
                    "value" => array(
                        __("Yes, please", 'kloud') => true
                    ),
                ),
				array(
					'type' => 'textfield',
					'heading' => __( 'Extra class name', 'kloud' ),
					'param_name' => 'el_class',
					'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'kloud' )
				),
			)
		) );

		/**
		 * ------------------------------------------------------------------------------------------------
		 * Add new element to VC: Products [kloud_products]
		 * ------------------------------------------------------------------------------------------------
		 */

		vc_map( kloud_get_products_shortcode_map_params() );

		// Necessary hooks for blog autocomplete fields
		add_filter( 'vc_autocomplete_kloud_products_include_callback',	'vc_include_field_search', 10, 1 ); // Get suggestion(find). Must return an array
		add_filter( 'vc_autocomplete_kloud_products_include_render',
			'vc_include_field_render', 10, 1 ); // Render exact product. Must return an array (label,value)

		// Narrow data taxonomies
		add_filter( 'vc_autocomplete_kloud_products_taxonomies_callback', 'vc_autocomplete_taxonomies_field_search', 10, 1 );
		add_filter( 'vc_autocomplete_kloud_products_taxonomies_render', 'vc_autocomplete_taxonomies_field_render', 10, 1 );

		// Narrow data taxonomies for exclude_filter
		add_filter( 'vc_autocomplete_kloud_products_exclude_filter_callback', 'vc_autocomplete_taxonomies_field_search', 10, 1 );
		add_filter( 'vc_autocomplete_kloud_products_exclude_filter_render', 'vc_autocomplete_taxonomies_field_render', 10, 1 );

		add_filter( 'vc_autocomplete_kloud_products_exclude_callback',	'vc_exclude_field_search', 10, 1 ); // Get suggestion(find). Must return an array
		add_filter( 'vc_autocomplete_kloud_products_exclude_render', 'vc_exclude_field_render', 10, 1 ); // Render exact product. Must return an array (label,value)




		/**
		 * ------------------------------------------------------------------------------------------------
		 * Map products tabs shortcode
		 * ------------------------------------------------------------------------------------------------
		 */
		vc_map( array(
			'name' => __( 'AJAX Products tabs', 'kloud' ),
			'base' => 'products_tabs',
			"as_parent" => array('only' => 'products_tab'),
			"content_element" => true,
			"show_settings_on_create" => true,
			'category' => __( 'Shortcode elements', 'kloud' ),
			'description' => __( 'Product tabs for your marketplace', 'kloud' ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => __( 'Title', 'kloud' ),
					'param_name' => 'title',
				),
				array(
					'type' => 'attach_image',
					'heading' => __( 'Icon image', 'kloud' ),
					'param_name' => 'image',
					'value' => '',
					'description' => __( 'Select image from media library.', 'kloud' )
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Tabs color', 'kloud' ),
					'param_name' => 'color'
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Extra class name', 'kloud' ),
					'param_name' => 'el_class',
					'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'kloud' )
				)
			),
		    "js_view" => 'VcColumnView'
		));

		$kloud_prdoucts_params = vc_map_integrate_shortcode( kloud_get_products_shortcode_map_params(), '', '', array(
			'exclude' => array(
			),
		));

		vc_map( array(
			'name' => __( 'Products tab', 'kloud' ),
			'base' => 'products_tab',
			'class' => '',
			"as_child" => array('only' => 'products_tabі'),
			"content_element" => true,
			'category' => __( 'Shortcode elements', 'kloud' ),
			'description' => __( 'Products block', 'kloud' ),
			'params' => array_merge( array(
				array(
					'type' => 'textfield',
					'heading' => __( 'Title for the tab', 'kloud' ),
					'param_name' => 'title',
					'value' => '',
				)
			), $kloud_prdoucts_params )
		));

		// Necessary hooks for blog autocomplete fields
		add_filter( 'vc_autocomplete_products_tab_include_callback',	'vc_include_field_search', 10, 1 ); // Get suggestion(find). Must return an array
		add_filter( 'vc_autocomplete_products_tab_include_render',
			'vc_include_field_render', 10, 1 ); // Render exact product. Must return an array (label,value)

		// Narrow data taxonomies
		add_filter( 'vc_autocomplete_products_tab_taxonomies_callback', 'vc_autocomplete_taxonomies_field_search', 10, 1 );
		add_filter( 'vc_autocomplete_products_tab_taxonomies_render', 'vc_autocomplete_taxonomies_field_render', 10, 1 );

		// Narrow data taxonomies for exclude_filter
		add_filter( 'vc_autocomplete_products_tab_exclude_filter_callback', 'vc_autocomplete_taxonomies_field_search', 10, 1 );
		add_filter( 'vc_autocomplete_products_tab_exclude_filter_render', 'vc_autocomplete_taxonomies_field_render', 10, 1 );

		add_filter( 'vc_autocomplete_products_tab_exclude_callback',	'vc_exclude_field_search', 10, 1 ); // Get suggestion(find). Must return an array
		add_filter( 'vc_autocomplete_products_tab_exclude_render', 'vc_exclude_field_render', 10, 1 ); // Render exact product. Must return an array (label,value)



		/**
		 * ------------------------------------------------------------------------------------------------
		 * Update images carousel parameters
		 * ------------------------------------------------------------------------------------------------
		 */
		add_action( 'init', 'kloud_update_vc_images_carousel');

		if( ! function_exists( 'kloud_update_vc_images_carousel' ) ) {
			function kloud_update_vc_images_carousel() {
				if(!function_exists('vc_map')) return;
				vc_remove_param( 'vc_images_carousel', 'mode' );
				vc_remove_param( 'vc_images_carousel', 'partial_view' );
				vc_remove_param( 'vc_images_carousel', 'el_class' );
				
		        vc_add_param( 'vc_images_carousel', array(
					'type' => 'checkbox',
					'heading' => __( 'Add spaces between images', 'kloud' ),
					'param_name' => 'spaces',
					'value' => array( __( 'Yes, please', 'kloud' ) => 'yes' )
				) ); 
				
		        vc_add_param( 'vc_images_carousel', array(
					'type' => 'dropdown',
					'heading' => __( 'Specific design', 'kloud' ),
					'param_name' => 'design',
		            'description' => __( 'With this option your gallery will be styled in a different way, and sizes will be changed.', 'kloud' ),
					'value' => array(
						'' => 'none',
						__( 'Iphone', 'kloud' ) => 'iphone',
						__( 'MacBook', 'kloud' ) => 'macbook',
					)
				) ); 

		        vc_add_param( 'vc_images_carousel', array(
		            'type' => 'textfield',
		            'heading' => __( 'Extra class name', 'kloud' ),
		            'param_name' => 'el_class',
		            'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'kloud' )
		        ) ); 
			}
		}

	}
}


if( ! function_exists( 'kloud_get_products_shortcode_params' ) ) {
	function kloud_get_products_shortcode_map_params() {
		return array(
			'name' => __( 'Products (grid or carousel)', 'kloud' ),
			'base' => 'kloud_products',
			'class' => '',
			'category' => __( 'Shortcode elements', 'kloud' ),
			'description' => __( 'Animated carousel with posts', 'kloud' ),
			'params' => kloud_get_products_shortcode_params() 
		);
	}
}

if( ! function_exists( 'kloud_get_products_shortcode_params' ) ) {
	function kloud_get_products_shortcode_params() {
		return apply_filters( 'kloud_get_products_shortcode_params', array(
				array(
					'type' => 'dropdown',
					'heading' => __( 'Grid or carousel', 'kloud' ),
					'param_name' => 'layout',
					'value' =>  array(
						array( 'grid', __( 'Grid', 'kloud' ) ),
						array( 'carousel', __( 'Carousel', 'kloud' ) ),

					),
					'description' => __( 'Show products in standard grid or via slider carousel', 'kloud' )
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Data source', 'kloud' ),
					'param_name' => 'post_type',
					'value' =>  array(
						array( 'product', __( 'All Products', 'kloud' ) ),
						array( 'featured', __( 'Featured Products', 'kloud' ) ),
						array( 'sale', __( 'Sale Products', 'kloud' ) ),
						array( 'bestselling', __( 'Bestsellers', 'kloud' ) ),
						array( 'ids', __( 'List of IDs', 'kloud' ) )

					),
					'description' => __( 'Select content type for your grid.', 'kloud' )
				),
				array(
					'type' => 'autocomplete',
					'heading' => __( 'Include only', 'kloud' ),
					'param_name' => 'include',
					'description' => __( 'Add products by title.', 'kloud' ),
					'settings' => array(
						'multiple' => true,
						'sortable' => true,
						'groups' => true,
					),
					'dependency' => array(
						'element' => 'post_type',
						'value' => array( 'ids' ),
						//'callback' => 'vc_grid_include_dependency_callback',
					),
				),
				// Custom query tab
				array(
					'type' => 'textarea_safe',
					'heading' => __( 'Custom query', 'kloud' ),
					'param_name' => 'custom_query',
					'description' => __( 'Build custom query according to <a href="http://codex.wordpress.org/Function_Reference/query_posts">WordPress Codex</a>.', 'kloud' ),
					'dependency' => array(
						'element' => 'post_type',
						'value' => array( 'custom' ),
					),
				),
				array(
					'type' => 'autocomplete',
					'heading' => __( 'Categories or tags', 'kloud' ),
					'param_name' => 'taxonomies',
					'settings' => array(
						'multiple' => true,
						// is multiple values allowed? default false
						// 'sortable' => true, // is values are sortable? default false
						'min_length' => 1,
						// min length to start search -> default 2
						// 'no_hide' => true, // In UI after select doesn't hide an select list, default false
						'groups' => true,
						// In UI show results grouped by groups, default false
						'unique_values' => true,
						// In UI show results except selected. NB! You should manually check values in backend, default false
						'display_inline' => true,
						// In UI show results inline view, default false (each value in own line)
						'delay' => 500,
						// delay for search. default 500
						'auto_focus' => true,
						// auto focus input, default true
					),
					'param_holder_class' => 'vc_not-for-custom',
					'description' => __( 'Enter categories, tags or custom taxonomies.', 'kloud' ),
					'dependency' => array(
						'element' => 'post_type',
						'value_not_equal_to' => array( 'ids', 'custom' ),
					),
				),
				array(

					'heading' => __( 'Items per page', 'kloud' ),
					'param_name' => 'items_per_page',
					'description' => __( 'Number of items to show per page.', 'kloud' ),
					'value' => '10',
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Pagination', 'kloud' ),
					'param_name' => 'pagination',
					'value' => array(
	                    '' => '', 
	                    '"Load more" button' => 'more-btn', 
	                    'Arrows' => 'arrows', 
					),
					'dependency' => array(
						'element' => 'layout',
						'value' => array( 'grid' ),
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Columns', 'kloud' ),
					'param_name' => 'columns',
					'value' => array(
						1,2, 3, 4, 5 , 6
					),
					'description' => __( 'Columns', 'kloud' ),
					'group' => __( 'Design', 'kloud' ),
					'dependency' => array(
						'element' => 'layout',
						'value' => array( 'grid' ),
					),
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Images size', 'kloud' ),
					'group' => __( 'Design', 'kloud' ),
					'param_name' => 'img_size',
					'description' => __( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.', 'kloud' )
				),
				array(
					'type' => 'checkbox',
					'heading' => __( 'Sale countdown', 'kloud' ),
					'description' => __( 'Countdown to the end sale date will be shown. Be sure you have set final date of the product sale price.', 'kloud' ),
					'param_name' => 'sale_countdown',
					'value' => 1,
					'group' => __( 'Design', 'kloud' ),
				),
				// Carousel settings
				array(
					'type' => 'textfield',
					'heading' => __( 'Slider speed', 'kloud' ),
					'param_name' => 'speed',
					'value' => '5000',
					'description' => __( 'Duration of animation between slides (in ms)', 'kloud' ),
					'group' => __( 'Carousel Settings', 'kloud' ),
					'dependency' => array(
						'element' => 'layout',
						'value' => array( 'carousel' ),
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Slides per view', 'kloud' ),
					'param_name' => 'slides_per_view',
					'value' => array(
						1,2,3,4,5,6,7,8
					),
					'description' => __( 'Set numbers of slides you want to display at the same time on slider\'s container for carousel mode. Also supports for "auto" value, in this case it will fit slides depending on container\'s width. "auto" mode doesn\'t compatible with loop mode.', 'kloud' ),
					'group' => __( 'Carousel Settings', 'kloud' ),
					'dependency' => array(
						'element' => 'layout',
						'value' => array( 'carousel' ),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => __( 'Off Slider autoplay', 'kloud' ),
					'param_name' => 'autoplay',
					'description' => __( 'Enables autoplay mode.', 'kloud' ),
					'value' => array( __( 'Yes, please', 'kloud' ) => 'yes' ),
					'group' => __( 'Carousel Settings', 'kloud' ),
					'dependency' => array(
						'element' => 'layout',
						'value' => array( 'carousel' ),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => __( 'Hide pagination control', 'kloud' ),
					'param_name' => 'hide_pagination_control',
					'description' => __( 'If "YES" pagination control will be removed', 'kloud' ),
					'value' => array( __( 'Yes, please', 'kloud' ) => 'yes' ),
					'group' => __( 'Carousel Settings', 'kloud' ),
					'dependency' => array(
						'element' => 'layout',
						'value' => array( 'carousel' ),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => __( 'Hide prev/next buttons', 'kloud' ),
					'param_name' => 'hide_prev_next_buttons',
					'description' => __( 'If "YES" prev/next control will be removed', 'kloud' ),
					'value' => array( __( 'Yes, please', 'kloud' ) => 'yes' ),
					'group' => __( 'Carousel Settings', 'kloud' ),
					'dependency' => array(
						'element' => 'layout',
						'value' => array( 'carousel' ),
					),
				),

                
				array(
					'type' => 'checkbox',
					'heading' => __( 'Off Slider loop', 'kloud' ),
					'param_name' => 'wrap',
					'description' => __( 'Off loop mode.', 'kloud' ),
					'value' => array( __( 'Yes, please', 'kloud' ) => 'yes' ),
					'group' => __( 'Carousel Settings', 'kloud' ),
					'dependency' => array(
						'element' => 'layout',
						'value' => array( 'carousel' ),
					),
				),
				// Data settings
				array(
					'type' => 'dropdown',
					'heading' => __( 'Order by', 'kloud' ),
					'param_name' => 'orderby',
					'value' => array(
						__( 'Date', 'kloud' ) => 'date',
						__( 'Order by post ID', 'kloud' ) => 'ID',
						__( 'Author', 'kloud' ) => 'author',
						__( 'Title', 'kloud' ) => 'title',
						__( 'Last modified date', 'kloud' ) => 'modified',
						__( 'Number of comments', 'kloud' ) => 'comment_count',
						__( 'Menu order/Page Order', 'kloud' ) => 'menu_order',
						__( 'Meta value', 'kloud' ) => 'meta_value',
						__( 'Meta value number', 'kloud' ) => 'meta_value_num',
						__( 'Matches same order you passed in via the include parameter.', 'kloud') => 'post__in',
						__( 'Random order', 'kloud' ) => 'rand',
						__( 'Price', 'kloud' ) => 'price',
					),
					'description' => __( 'Select order type. If "Meta value" or "Meta value Number" is chosen then meta key is required.', 'kloud' ),
					'group' => __( 'Data Settings', 'kloud' ),
					'param_holder_class' => 'vc_grid-data-type-not-ids',
					'dependency' => array(
						'element' => 'post_type',
						'value_not_equal_to' => array( 'custom' ),
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Sorting', 'kloud' ),
					'param_name' => 'order',
					'group' => __( 'Data Settings', 'kloud' ),
					'value' => array(
						__( 'Descending', 'kloud' ) => 'DESC',
						__( 'Ascending', 'kloud' ) => 'ASC',
					),
					'param_holder_class' => 'vc_grid-data-type-not-ids',
					'description' => __( 'Select sorting order.', 'kloud' ),
					'dependency' => array(
						'element' => 'post_type',
						'value_not_equal_to' => array( 'ids', 'custom' ),
					),
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Meta key', 'kloud' ),
					'param_name' => 'meta_key',
					'description' => __( 'Input meta key for grid ordering.', 'kloud' ),
					'group' => __( 'Data Settings', 'kloud' ),
					'param_holder_class' => 'vc_grid-data-type-not-ids',
					'dependency' => array(
						'element' => 'orderby',
						'value' => array( 'meta_value', 'meta_value_num' ),
					),
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Offset', 'kloud' ),
					'param_name' => 'offset',
					'description' => __( 'Number of grid elements to displace or pass over.', 'kloud' ),
					'group' => __( 'Data Settings', 'kloud' ),
					'param_holder_class' => 'vc_grid-data-type-not-ids',
					'dependency' => array(
						'element' => 'post_type',
						'value_not_equal_to' => array( 'ids', 'custom' ),
					),
				),
				array(
					'type' => 'autocomplete',
					'heading' => __( 'Exclude', 'kloud' ),
					'param_name' => 'exclude',
					'description' => __( 'Exclude posts, pages, etc. by title.', 'kloud' ),
					'group' => __( 'Data Settings', 'kloud' ),
					'settings' => array(
						'multiple' => true,
					),
					'param_holder_class' => 'vc_grid-data-type-not-ids',
					'dependency' => array(
						'element' => 'post_type',
						'value_not_equal_to' => array( 'ids', 'custom' ),
						'callback' => 'vc_grid_exclude_dependency_callback',
					),
				)
			)
		);
	}
}


if( ! function_exists( 'kloud_get_color_scheme_param' ) ) {
	function kloud_get_color_scheme_param() {
		return apply_filters( 'kloud_get_color_scheme_param', array(
			'type' => 'dropdown',
			'heading' => __( 'Content Position', 'kloud' ),
			'param_name' => 'kloud_color_scheme',
			'value' => array(
				__( 'Content Position Left', 'kloud' ) => 'left',
                __( 'Content Position Center', 'kloud' ) => 'center',
				__( 'Content Position Right', 'kloud' ) => 'right',
			),
		) );
	}
}


if( ! function_exists( 'kloud_get_user_panel_params' ) ) {
	function kloud_get_user_panel_params() {
		return apply_filters( 'kloud_get_user_panel_params', array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Title', 'kloud' ),
				'param_name' => 'title',
			)
		));
	}
}

if( ! function_exists( 'kloud_get_author_area_params' ) ) {
	function kloud_get_author_area_params() {
		return apply_filters( 'kloud_get_author_area_params', array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Title', 'kloud' ),
				'param_name' => 'title',
			),
			array(
				'type' => 'attach_image',
				'heading' => __( 'Image', 'kloud' ),
				'param_name' => 'image',
				'value' => '',
				'description' => __( 'Select image from media library.', 'kloud' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Image size', 'kloud' ),
				'param_name' => 'img_size',
				'description' => __( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.', 'kloud' )
			),
			array(
				'type' => 'textarea_html',
				'holder' => 'div',
				'heading' => __( 'Author bio', 'kloud' ),
				'param_name' => 'content',
				'description' => __( 'Add here few words to your author info.', 'kloud' )
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Text alignment', 'kloud' ),
				'param_name' => 'alignment',
				'value' => array(
					__( 'Align left', 'kloud' ) => '',
					__( 'Align right', 'kloud' ) => 'right',
					__( 'Align center', 'kloud' ) => 'center'
				),
				'description' => __( 'Select image alignment.', 'kloud' )
			),
			array(
				'type' => 'href',
				'heading' => __( 'Author link', 'kloud'),
				'param_name' => 'link',
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Link text', 'kloud'),
				'param_name' => 'link_text',
			),
			kloud_get_color_scheme_param(),
			array(
				'type' => 'textfield',
				'heading' => __( 'Extra class name', 'kloud' ),
				'param_name' => 'el_class',
				'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'kloud' )
			)
		));
	}
}


if( ! function_exists( 'kloud_get_banner_params' ) ) {
	function kloud_get_banner_params() {
		return apply_filters( 'kloud_get_banner_params', array(
			array(
				'type' => 'attach_image',
				'heading' => __( 'Image', 'kloud' ),
				'param_name' => 'image',
				'value' => '',
				'description' => __( 'Select image from media library.', 'kloud' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Image size', 'kloud' ),
				'param_name' => 'img_size',
				'description' => __( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.', 'kloud' )
			),
			array(
				'type' => 'href',
				'heading' => __( 'Banner link', 'kloud'),
				'param_name' => 'link',
				'description' => __( 'Enter URL if you want this banner to have a link.', 'kloud' )
			),
			array(
				'type' => 'textarea_html',
				'holder' => 'div',
				'heading' => __( 'Banner content', 'kloud' ),
				'param_name' => 'content',
				'description' => __( 'Add here few words to your banner image.', 'kloud' )
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Text alignment', 'kloud' ),
				'param_name' => 'alignment',
				'value' => array(
					__( 'Align left', 'kloud' ) => '',
					__( 'Align right', 'kloud' ) => 'right',
					__( 'Align center', 'kloud' ) => 'center'
				),
				'description' => __( 'Select image alignment.', 'kloud' )
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Content vertical alignment', 'kloud' ),
				'param_name' => 'vertical_alignment',
				'value' => array(
					__( 'Top', 'kloud' ) => '',
					__( 'Middle', 'kloud' ) => 'middle',
					__( 'Bottom', 'kloud' ) => 'bottom'
				)
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Hover effect', 'kloud' ),
				'param_name' => 'hover',
				'value' => array(
					__( 'Default', 'kloud' ) => '',
					__( 'Zoom image', 'kloud' ) => '1',
					__( 'Bordered', 'kloud' ) => '2',
					__( 'Content animation', 'kloud' ) => '3',
					__( 'Translate and scale', 'kloud' ) => '4',
				),
				'description' => __( 'Set beautiful hover effects for your banner.', 'kloud' )
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Content style', 'kloud' ),
				'param_name' => 'style',
				'value' => array(
					__( 'Default', 'kloud' ) => '',
					__( 'Color mask', 'kloud' ) => '2',
					__( 'Mask with border', 'kloud' ) => '3',
					__( 'Content with line background', 'kloud' ) => '1',
					__( 'Content with rectangular background', 'kloud' ) => '5',
					//__( 'Style 4', 'kloud' ) => '4',
					//__( 'Style 5', 'kloud' ) => '5',
				),
				'description' => __( 'You can use some of our predefined styles for your banner content.', 'kloud' )
			),
			kloud_get_color_scheme_param(),
			array(
				'type' => 'textfield',
				'heading' => __( 'Extra class name', 'kloud' ),
				'param_name' => 'el_class',
				'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'kloud' )
			),
            array(
                'type' => 'animation_style',
                'heading' => __( 'Animation Style', 'kloud' ),
                'param_name' => 'animation',
                'description' => __( 'Choose your animation style', 'kloud' ),
                'admin_label' => false,
                'weight' => 0,
                )
		));
	}
}

if( ! function_exists( 'kloud_get_instagram_params' ) ) {
	function kloud_get_instagram_params() {
		return apply_filters( 'kloud_get_instagram_params', array(
			array(
					'type' => 'dropdown',
					'heading' => __( 'Design', 'kloud' ),
					'param_name' => 'design',
					'value' => array(
						__( 'Default', 'kloud' ) => 'default',
						__( 'Slider', 'kloud' ) => 'slider',
					),
				),
			array(
				'type' => 'textfield',
				'heading' => __( 'Username', 'kloud' ),
				'param_name' => 'username',
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Number of photos', 'kloud' ),
				'param_name' => 'number',
			),
            array(
					'type' => 'dropdown',
					'heading' => __( 'Slides per view', 'kloud' ),
					'param_name' => 'slides_per_view',
					'value' => array(
						1,2,3,4,5,6,7,8
					),
                    'dependency' => array(
						'element' => 'design',
						'value' => array( 'slider' ),
					),
					'description' => __( 'Set numbers of slides you want to display at the same time on slider\'s container for carousel mode. Also supports for "auto" value, in this case it will fit slides depending on container\'s width. "auto" mode doesn\'t compatible with loop mode.', 'kloud' )
				),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Photo size', 'kloud' ),
				'param_name' => 'size',
				'value' => array(
					__( 'Thumbnail', 'kloud' ) => 'thumbnail',
    	           __( 'Medium', 'kloud' ) => 'medium',
					__( 'Large', 'kloud' ) => 'large',
				),
			),
		));
	}
}

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_animator extends WPBakeryShortCodesContainer {
 
    }
}
// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_testimonials extends WPBakeryShortCodesContainer {
 
    }
}
 
// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_testimonial extends WPBakeryShortCode {
 
    }
}
// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_teams extends WPBakeryShortCodesContainer {
 
    }
}
 
// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_team_member extends WPBakeryShortCode {
 
    }
}
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_banners_carousel extends WPBakeryShortCodesContainer {
 
    }
}

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_pricing_tables extends WPBakeryShortCodesContainer {
 
    }
}
 
// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_pricing_plan extends WPBakeryShortCode {
 
    }
}

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_products_tabs extends WPBakeryShortCodesContainer {
 
    }
}
 
// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_products_tab extends WPBakeryShortCode {
 
    }
}

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_kloud_carousel extends WPBakeryShortCodesContainer {}
}
 
// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_kloud_carousel_item extends WPBakeryShortCode {}
}


// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_kloud_google_map extends WPBakeryShortCodesContainer {
 
    }
}