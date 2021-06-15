<?php
function airtheme_theme_slider_source(){
	$output = array();
	
	array_push($output, array(
		'title' => esc_html__('Select Slider', 'air-theme'),
		'value' => 0
	));
	
	if(class_exists('RevSliderFront')) {
		array_push($output, array(
			'title' => esc_html__('Revolution Slider', 'air-theme'),
			'value' => 'revolution-slider'
		));
	}
	
	if(post_type_exists('bmslider')){
		array_push($output, array(
			'title' => __('BM Slider', 'air-theme'),
			'value' => 'bmslider'
		));
		
	}
	
	return $output;
}

//theme meta slider bmslider
function airtheme_theme_meta_slider_bmslider(){
	if(post_type_exists('bmslider')){
		$meta = array(
			array('title' => esc_html__('Select slider name', 'air-theme'), 'value' => 0)
		);
		
		$get_bmslider = get_posts(array(
			'posts_per_page' => -1,
			'post_type' => 'bmslider'
		));
		
		if($get_bmslider){
			foreach($get_bmslider as $slider){
				array_push($meta, array(
					'title' => $slider->post_title, 'value' => $slider->ID
				));
			}
		}
	}else{
		$meta = array(
			array('title' => esc_html__('Bmslider not installed', 'air-theme'), 'value' => 0)
		);
	}
	
	return $meta;
}

//theme meta slider revolution
function airtheme_theme_meta_slider_revolution(){
	if(class_exists('RevSliderFront')) {
		global $wpdb;
		$table_revslider = $wpdb->prefix . "revslider_sliders";
		$revslidersliders = $wpdb->get_results("
			SELECT * FROM $table_revslider
			ORDER BY id ASC
			"
		);
		
		$meta = array(
			array('title' => esc_html__('Select slider name', 'air-theme'), 'value' => 0)
		);
		
		if(count($revslidersliders)){
			foreach($revslidersliders as $num => $slider){
				array_push($meta, array(
					'title' => $slider->title, 'value' => $slider->alias
				));
			}
		}
	}else{
		$meta = array(
			array('title' => esc_html__('revolution slider not installed', 'air-theme'), 'value' => 0)
		);
	}
	return $meta;
}

//theme meta select fields
function airtheme_theme_meta_select_fields($fields){
	$fields['theme_meta_sidebar'] = array(
		array('title' => esc_html__('Right Sidebar','air-theme'),                         'value' => 'right-sidebar'),
		array('title' => esc_html__('Left Sidebar','air-theme'),                          'value' => 'left-sidebar'),
		array('title' => esc_html__('Without Sidebar','air-theme'),                       'value' => 'without-sidebar')
	);
	$fields['theme_meta_title_bar_slider_value'] = array(
		array('title' => esc_html__('Select a slider','air-theme'),                       'value' => '-1')
	);
	$fields['theme_meta_audio_type'] = array(
		array('title' => esc_html__('Self Hosted Audio','air-theme'),                     'value' => 'self-hosted-audio'),
		array('title' => esc_html__('Soundcloud','air-theme'),                            'value' => 'soundcloud')
	);
	$fields['theme_meta_video_ratio'] = array(
		array('title' => esc_html__('4:3','air-theme'),                                   'value' => '4:3'),
		array('title' => esc_html__('16:9','air-theme'),                                  'value' => '16:9'),
		array('title' => esc_html__('Custom','air-theme'),                                'value' => 'custom')
	);
	$fields['theme_meta_video_ratio'] = array(
		array('title' => esc_html__('4:3','air-theme'),                                   'value' => '4:3'),
		array('title' => esc_html__('16:9','air-theme'),                                  'value' => '16:9'),
		array('title' => esc_html__('Custom','air-theme'),                                'value' => 'custom')
	);
	$fields['theme_meta_gallery_video_ratio'] = array(
		array('title' => esc_html__('4:3','air-theme'),                                   'value' => '4:3'),
		array('title' => esc_html__('16:9','air-theme'),                                  'value' => '16:9'),
		array('title' => esc_html__('Custom','air-theme'),                                'value' => 'custom')
	);
	$fields['theme_meta_gallery_video_position'] = array(
		array('title' => esc_html__('Top of Gallery','air-theme'),                        'value' => 'top'),
		array('title' => esc_html__('Bottom of Gallery','air-theme'),                     'value' => 'bottom')
	);
	
	$fields['theme_meta_sidebar_widgets'] = airtheme_theme_register_sidebar('sidebars');
	
	$fields['theme_meta_order'] = array(
		array('title' => esc_html__('Ascending','air-theme'),                             'value' => 'ASC'),
		array('title' => esc_html__('Descending','air-theme'),                            'value' => 'DESC')
	);
	
	$fields['theme_meta_thumbnail_size'] = array(
		array('title' => esc_html__('Small','air-theme'),                                 'value' => 'airtheme-imagebox-thumb'),
		array('title' => esc_html__('Big','air-theme'),                                   'value' => 'airtheme-image-thumb-1'),
		array('title' => esc_html__('Long','air-theme'),                                  'value' => 'airtheme-standard-blog-thumb'),
		array('title' => esc_html__('Height','air-theme'),                                'value' => 'airtheme-image-thumb-2')
	);
	
	$fields['theme_meta_enable_portfolio_list_layout_builder'] = array(
		array('title' => esc_html__('Layout 1','air-theme'),                              'value' => 'list_layout_1'),
		array('title' => esc_html__('Layout 2','air-theme'),                              'value' => 'list_layout_2'),
		array('title' => esc_html__('Layout 3','air-theme'),                              'value' => 'list_layout_3'),
		array('title' => esc_html__('Layout 4','air-theme'),                              'value' => 'list_layout_4')
	);
	
	$fields['theme_meta_page_pagination'] = array(
	array('title' => esc_html__('Load More Button','air-theme'),                          'value' => 'load-more'),
	array('title' => esc_html__('Infiniti Scroll','air-theme'),                           'value' => 'infiniti-scroll'),
	array('title' => esc_html__('Page Number','air-theme'),                           	  'value' => 'page-number')
	);
	
	$fields['page_template_share_buttons'] = array(
	array('title' => esc_html__('Facebook','air-theme'),                                  'value' => 'facebook'),
	array('title' => esc_html__('Twitter','air-theme'),                                   'value' => 'twitter'),
	array('title' => esc_html__('Google Plus','air-theme'),                               'value' => 'google-plus'),
	array('title' => esc_html__('Pinterest','air-theme'),                                 'value' => 'pinterest'),
	array('title' => esc_html__('Digg','air-theme'),                    	 	             'value' => 'digg'),
	array('title' => esc_html__('Reddit','air-theme'),                    	 	         'value' => 'reddit'),
	array('title' => esc_html__('Linkedin','air-theme'),                    	             'value' => 'linkedin'),
	array('title' => esc_html__('Stumbleupon','air-theme'),                               'value' => 'stumbleupon'),
	array('title' => esc_html__('Tumblr','air-theme'),                    	 	         'value' => 'tumblr'),
	array('title' => esc_html__('Mail','air-theme'),                    	 	             'value' => 'mail')
	);
	
	$fields['theme_meta_page_orderby'] = array(
		array('title' => esc_html__('Please Select','air-theme'),                         'value' => 'none'),
		array('title' => esc_html__('Title','air-theme'),                                 'value' => 'title'),
		array('title' => esc_html__('Date','air-theme'),                                  'value' => 'date'),
		array('title' => esc_html__('ID','air-theme'),                                    'value' => 'id'),
		array('title' => esc_html__('Modified','air-theme'),                              'value' => 'modified'),
		array('title' => esc_html__('Author','air-theme'),                                'value' => 'author'),
		array('title' => esc_html__('Comment count','air-theme'),                         'value' => 'comment_count'),
		array('title' => esc_html__('Random','air-theme'),                        		  'value' => 'rand')
	);
	
	$fields['theme_meta_slider_source']                                              = airtheme_theme_slider_source(); 
	$fields['theme_meta_select_bmslider']                                            = airtheme_theme_meta_slider_bmslider();
	$fields['theme_meta_select_revolution_slider']                                   = airtheme_theme_meta_slider_revolution();
	
	$fields['theme_meta_page_template'] = array(
	array('title' => esc_html__('No Template','air-theme'),                               'value' => 'none'),
	array('title' => esc_html__('Blog Masonry','air-theme'),                              'value' => 'blog-masonry'),
	array('title' => esc_html__('Introduction Above List','air-theme'),                   'value' => 'intro-above'),
	array('title' => esc_html__('Left Introduction & Right Filter','air-theme'),          'value' => 'intro-r-filter'),
	array('title' => esc_html__('Introduction In List','air-theme'),                      'value' => 'intro-in-list'), 
	);
	
	$fields['theme_meta_page_colour_for_text'] = array(
	array('title' => esc_html__('Dark','air-theme'),                                      'value' => 'dark'),
	array('title' => esc_html__('Light','air-theme'),                                     'value' => 'light')
	);
	
	$fields['theme_meta_page_list_type'] = array(
	array('title' => esc_html__('Masonry Grid','air-theme'),                              'value' => 'masonry-grid'),
	array('title' => esc_html__('Masonry','air-theme'),                                   'value' => 'masonry'),
	array('title' => esc_html__('Grid(Thumbnail)','air-theme'),                           'value' => 'grid-thumb'),
	array('title' => esc_html__('Grid(Thumbnail + Title)','air-theme'),                   'value' => 'grid-title')
	);
	
	$fields['theme_meta_page_columns'] = array(
	array('title' => esc_html__('1','air-theme'),                                         'value' => '1'),
	array('title' => esc_html__('2','air-theme'),                                         'value' => '2'),
	array('title' => esc_html__('3','air-theme'),                                         'value' => '3'),
	array('title' => esc_html__('4','air-theme'),                                         'value' => '4'),
	array('title' => esc_html__('5','air-theme'),                                         'value' => '5'),
	array('title' => esc_html__('6','air-theme'),                                         'value' => '6')
	);

	$fields['theme_meta_page_columns_mobile'] = array(
	array('title' => esc_html__('1','air-theme'),                                         'value' => '1'),
	array('title' => esc_html__('2','air-theme'),                                         'value' => '2') 
	);
	
	$fields['theme_meta_page_columns_blog'] = array(
	array('title' => esc_html__('1','air-theme'),                                         'value' => '1'),
	array('title' => esc_html__('2','air-theme'),                                         'value' => '2'),
	array('title' => esc_html__('3','air-theme'),                                         'value' => '3'),
	array('title' => esc_html__('4','air-theme'),                                         'value' => '4')
	);
	
	$fields['theme_meta_page_spacing'] = array(
	array('title' => esc_html__('No Spacing','air-theme'),                                'value' => 'no-spacing'),
	array('title' => esc_html__('Narrow','air-theme'),                                    'value' => 'narrow'),
	array('title' => esc_html__('Normal','air-theme'),                                    'value' => 'normal')
	);

	$fields['theme_meta_page_spacing_mobile'] = array(
	array('title' => esc_html__('No Spacing','air-theme'),                                'value' => 'no-spacing'),
	array('title' => esc_html__('Narrow','air-theme'),                                    'value' => 'narrow'),
	array('title' => esc_html__('Normal','air-theme'),                                    'value' => 'normal')
	);
	
	$fields['theme_meta_page_list_width'] = array(
	array('title' => esc_html__('Normal(Main Container Width)','air-theme'),              'value' => 'normal'),
	array('title' => esc_html__('Fullwidth','air-theme'),                                 'value' => 'fullwidth'),
	array('title' => esc_html__('Fullwidth Filled','air-theme'),                          'value' => 'fullwidth-filled')
	);

	$fields['theme_meta_page_list_width_mobile'] = array(
	array('title' => esc_html__('Normal(Main Container Width)','air-theme'),              'value' => 'normal'),
	array('title' => esc_html__('Fullwidth','air-theme'),                                 'value' => 'fullwidth'),
	array('title' => esc_html__('Fullwidth Filled','air-theme'),                          'value' => 'fullwidth-filled')
	);
	
	$fields['theme_meta_page_what_thumb'] = array(
	array('title' => esc_html__('Open The Portfolio Item','air-theme'),                  'value' => 'open-item'),
	array('title' => esc_html__('Open Lightbox','air-theme'),                      		'value' => 'open-featured-img'),
	array('title' => esc_html__('Open Lightbox(Play All Images of Current Project)','air-theme'),     'value' => 'open-all-img')
	);
	
	$fields['theme_meta_page_filter_align'] = array(
	array('title' => esc_html__('Left','air-theme'),                                      'value' => 'left'),
	array('title' => esc_html__('Center','air-theme'),                                    'value' => 'center'),
	array('title' => esc_html__('Right','air-theme'),                                     'value' => 'right')
	); 
	
	$fields['theme_meta_page_title_align'] = array(
	array('title' => esc_html__('Left','air-theme'),                                      'value' => 'left'),
	array('title' => esc_html__('Center','air-theme'),                                    'value' => 'center')
	); 
	
	$fields['theme_meta_page_mouseover_effect'] = array(
	array('title' => esc_html__('Bordered Mask(Text Left)','air-theme'),                  'value' => 'bordered-left'),
	array('title' => esc_html__('Bordered Mask(Text Centered)','air-theme'),              'value' => 'bordered-centered'),
	array('title' => esc_html__('Filled Mask(Text Left)','air-theme'),                    'value' => 'filled-left'),
	array('title' => esc_html__('Filled Mask(Text Centered)','air-theme'),                'value' => 'filled-centered'),
	array('title' => esc_html__('Image Zoom In','air-theme'),                 			  'value' => 'img-zoom-in'),
	array('title' => esc_html__('No Effect','air-theme'),                 			 	  'value' => 'none')
	);
	
	$fields['theme_meta_gallery_template'] = array(
	array('title' => esc_html__('No Template','air-theme'),                               'value' => 'none'),
	array('title' => esc_html__('Standard Gallery','air-theme'),                          'value' => 'standard'),
	array('title' => esc_html__('Gallery on Left','air-theme'),                           'value' => 'on_left'),
	array('title' => esc_html__('Gallery on Right','air-theme'),                          'value' => 'on_right'),
	array('title' => esc_html__('Slider','air-theme'),                                    'value' => 'slider'),
	array('title' => esc_html__('Fullscreen','air-theme'),                                'value' => 'fullscreen')
	);
	
	$fields['theme_meta_gallery_width'] = array(
	array('title' => esc_html__('Fullwidth','air-theme'),                                 'value' => 'fullwidth'),
	array('title' => esc_html__('Wide','air-theme'),                                      'value' => 'wide'),
	array('title' => esc_html__('Narrow','air-theme'),                                    'value' => 'narrow')
	);
	
	$fields['theme_meta_gallery_col_width'] = array(
	array('title' => esc_html__('1/2','air-theme'),                                       'value' => '1/2'),
	array('title' => esc_html__('3/5','air-theme'),                                       'value' => '3/5'),
	array('title' => esc_html__('2/3','air-theme'),                                       'value' => '2/3'),
	array('title' => esc_html__('3/4','air-theme'),                                       'value' => '3/4')
	);
	
	$fields['theme_meta_gallery_image_spacing'] = array(
	array('title' => esc_html__('0','air-theme'),                                         'value' => '0'),
	array('title' => esc_html__('2','air-theme'),                                         'value' => '2'),
	array('title' => esc_html__('10','air-theme'),                                        'value' => '10'),
	array('title' => esc_html__('20','air-theme'),                                        'value' => '20'),
	array('title' => esc_html__('40','air-theme'),                                        'value' => '40'),
	array('title' => esc_html__('60','air-theme'),                                        'value' => '60'),
	array('title' => esc_html__('80','air-theme'),                                        'value' => '80')
	);
	
	$fields['theme_meta_gallery_style'] = array(
	array('title' => esc_html__('Standard','air-theme'),                                  'value' => 'standard'),
	array('title' => esc_html__('Filled','air-theme'),                                    'value' => 'filled')
	);
	
	$fields['theme_meta_gallery_text_align'] = array(
	array('title' => esc_html__('Left','air-theme'),                                      'value' => 'left'),
	array('title' => esc_html__('Center','air-theme'),                                    'value' => 'center')
	);
	
	$fields['theme_meta_gallery_start_from'] = array(
	array('title' => esc_html__('Project Title','air-theme'),                             'value' => 'project_title'),
	array('title' => esc_html__('Gallery','air-theme'),                                   'value' => 'gallery')
	);
	
	$fields['theme_meta_gallery_colour_for_text'] = array(
	array('title' => esc_html__('Dark','air-theme'),                                      'value' => 'dark'),
	array('title' => esc_html__('Light','air-theme'),                                     'value' => 'light')
	);
	
	$fields['theme_meta_gallery_pb_colour_for_text'] = array(
	array('title' => esc_html__('Dark','air-theme'),                                      'value' => 'dark'),
	array('title' => esc_html__('Light','air-theme'),                                     'value' => 'light')
	);

	$fields['theme_meta_page_gallery_caption_align'] = array( 
	array('title' => esc_html__('Left','air-theme'),                                      'value' => ''),
	array('title' => esc_html__('Center','air-theme'),                                    'value' => 'center'),
	array('title' => esc_html__('Right','air-theme'),                                     'value' => 'right')
	);
	
	return $fields;
}
add_filter('theme_config_select_fields', 'airtheme_theme_meta_select_fields');

//theme meta fields
function airtheme_theme_post_meta_fields(){
	$airtheme_theme_post_meta_fields = array(
		
		// Page
		'page' => array(
			array(
				'id'      => 'page-options',
				'title'   => esc_html__('Page Options','air-theme'),
				'section' => array(

					array(
						'item' => array(
						
							// Page Template
							array('title'       => esc_html__('Page Template','air-theme'),
								  'description' => '',
								  'type'        => 'select',
								  'name'        => 'theme_meta_page_template',
								  'default'     => 'none',
								  'col_size'    => 'width:50%;'),
								  
							array('type'        => 'divider'), 
						)
					),
					
					array(/* Sidebar */
						'super-control' => array(
							'name'  => 'theme_meta_page_template',
							'value' => 'none|blog-masonry'
						),
						'item' => array(
							
							// Sidebar
							array('title'       => esc_html__('Sidebar','air-theme'),
								  'description' => '',
								  'type'        => 'image-select',
								  'name'        => 'theme_meta_sidebar',
								  'size'        => '126:80',
								  'default'     => 'without-sidebar',
								  'bind'        => array(
									  array('type'     => 'select',
											'name'     => 'theme_meta_sidebar_widgets',
											'col_size' => 'width:200px;',
											'position' => 'after')))
											
						)), 
							
					array(/* Page Template */
						'super-control' => array(
							'name'  => 'theme_meta_page_template',
							'value' => 'none'
						),
						'item' => array(


							// Show Page Title
							array('title'       => esc_html__('Show Page Title','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_meta_page_show_title',
								  'default'     => 'true'),
							//Hide excerpt
							array('title'       => esc_html__('Hide Description under Title','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_meta_page_hide_des',
								  'default'     => 'false',
								  'control'     => array('name'  => 'theme_meta_page_show_title',
														 'value' => 'true')),
								  
						)),
							
					array(/* Page Template */
						'super-control' => array(
							'name'  => 'theme_meta_page_template',
							'value' => 'intro-above|intro-r-filter|intro-in-list'
						),
						'item' => array(

							// Introduction
							array('title'       => esc_html__('Introduction','air-theme'),
								  'description' => '',
								  'type'        => 'wp-editor',
								  'default'     => '',
								  'name'        => 'theme_meta_page_introduction')
							)),
							
					array(/* Page Template blog */
						'super-control' => array(
							'name'  => 'theme_meta_page_template',
							'value' => 'intro-above|intro-r-filter|intro-in-list'
						),
						'item' => array(

							array('type'        => 'divider'), 
							
							// Portfolio List Type
							array('title'       => esc_html__('Portfolio List Type','air-theme'),
								  'description' => '',
								  'type'        => 'select',
								  'default'     => 'masonry-grid',
								  'name'        => 'theme_meta_page_list_type',
								  'col_size'    => 'width:75%;'),
								  
						)),
							
					array(/* Page Template blog */
						'super-control' => array(
							'name'  => 'theme_meta_page_template',
							'value' => 'intro-above|intro-r-filter|intro-in-list|blog-masonry'
						),
						'item' => array(

							// Category
							array('title'       => esc_html__('Category','air-theme'),
								  'description' => '',
								  'type'        => 'category',
								  'default'     => 0,
								  'name'        => 'theme_meta_page_category',
								  'col_size'    => 'width:75%;'),
								  
							// Select Category Order
							array('title'       => esc_html__('Order','air-theme'),
								  'description' => '',
								  'type'        => 'orderby',
								  'name'        => 'theme_meta_page_orderby',
								  'default'     => 'date',
								  'col_size'    => 'width:75%;'),
								  
							// Columns
							array('title'       => esc_html__('Columns','air-theme'),
								  'description' => '',
								  'type'        => 'select',
								  'name'        => 'theme_meta_page_columns',
								  'default'     => '2',
								  'col_size'    => 'width:75%;',
								  'control'     => array('name'  => 'theme_meta_page_template',
														 'value' => 'intro-above|intro-r-filter|intro-in-list')),

							// Columns
							array('title'       => esc_html__('Columns for Mobile','air-theme'),
								  'description' => '',
								  'type'        => 'select',
								  'name'        => 'theme_meta_page_columns_mobile',
								  'default'     => '1',
								  'col_size'    => 'width:75%;',
								  'control'     => array('name'  => 'theme_meta_page_template',
														 'value' => 'intro-above|intro-r-filter|intro-in-list')),
								  
							// Columns for blog masonry
							array('title'       => esc_html__('Columns','air-theme'),
								  'description' => '',
								  'type'        => 'select',
								  'name'        => 'theme_meta_page_columns_blog',
								  'default'     => '2',
								  'col_size'    => 'width:75%;',
								  'control'     => array('name'  => 'theme_meta_page_template',
														 'value' => 'blog-masonry')),
								  
							// Post Number per Page
							array('title'       => esc_html__('Post Number per Page','air-theme'),
								  'type'        => 'text',
								  'default'     => 10,
								  'name'        => 'theme_meta_page_number',
								  'col_size'    => 'width:75%;'),
								  
							// Pagination
							array('title'       => esc_html__('Pagination','air-theme'),
								  'type'        => 'select',
								  'default'     => 'load-more',
								  'name'        => 'theme_meta_page_pagination',
								  'col_size'    => 'width:75%;'),

							// Hide Category
							array('title'       => esc_html__('Hide Category','air-theme'),
								  'type'        => 'switch',
								  'default'     => 'false',
								  'name'        => 'theme_meta_page_hide_cate_blog', 
								  'control'     => array('name'  => 'theme_meta_page_template',
														 'value' => 'blog-masonry')),

							// Hide Date
							array('title'       => esc_html__('Hide Date','air-theme'),
								  'type'        => 'switch',
								  'default'     => 'false',
								  'name'        => 'theme_meta_page_hide_date_blog', 
								  'control'     => array('name'  => 'theme_meta_page_template',
														 'value' => 'blog-masonry'))
								  
						)),
							
					array(/* Page Template blog */
						'super-control' => array(
							'name'  => 'theme_meta_page_template',
							'value' => 'intro-above|intro-r-filter|intro-in-list'
						),
						'item' => array(
								  
							// Item Title Align
							array('title'       => esc_html__('Item Title Align','air-theme'),
								  'type'        => 'select',
								  'default'     => 'left',
								  'name'        => 'theme_meta_page_title_align',
								  'col_size'    => 'width:75%;',
								  'control'     => array('name'  => 'theme_meta_page_list_type',
														 'value' => 'grid-title')),
								  
							// Item Spacing
							array('title'       => esc_html__('Item Spacing','air-theme'),
								  'type'        => 'select',
								  'default'     => 'normal',
								  'name'        => 'theme_meta_page_spacing',
								  'col_size'    => 'width:75%;',
								  // 'control'     => array('name'  => 'theme_meta_page_list_type',
										// 				 'value' => 'masonry-grid|masonry|grid-thumb')
								  ),

							// Item Spacing
							array('title'       => esc_html__('Item Spacing for Mobile','air-theme'),
								  'type'        => 'select',
								  'default'     => 'normal',
								  'name'        => 'theme_meta_page_spacing_mobile',
								  'col_size'    => 'width:75%;',
								  ),
								  
							// List Width
							array('title'       => esc_html__('List Width','air-theme'),
								  'type'        => 'select',
								  'default'     => 'fullwidth-filled',
								  'name'        => 'theme_meta_page_list_width',
								  'col_size'    => 'width:75%;',
								  // 'control'     => array('name'  => 'theme_meta_page_list_type',
										// 				 'value' => 'masonry-grid|masonry|grid-thumb')
								  ),

							// List Width mobile
							array('title'       => esc_html__('List Width for Mobile','air-theme'),
								  'type'        => 'select',
								  'default'     => 'fullwidth-filled',
								  'name'        => 'theme_meta_page_list_width_mobile',
								  'col_size'    => 'width:75%;',
								  // 'control'     => array('name'  => 'theme_meta_page_list_type',
										// 				 'value' => 'masonry-grid|masonry|grid-thumb')
								  ),
								  
							// What Thumbnail Does
							array('title'       => esc_html__('What Thumbnail Does','air-theme'),
								  'type'        => 'select',
								  'default'     => 'open-item',
								  'name'        => 'theme_meta_page_what_thumb',
								  'col_size'    => 'width:75%;'),
								  
							// Mouseover Effect
							array('title'       => esc_html__('Mouseover Effect','air-theme'),
								  'type'        => 'select',
								  'default'     => 'bordered-left',
								  'name'        => 'theme_meta_page_mouseover_effect',
								  'col_size'    => 'width:75%;',
								  'control'     => array('name'  => 'theme_meta_page_list_type',
														 'value' => 'masonry-grid|masonry|grid-thumb')),
							// Hide Category
							array('title'       => esc_html__('Hide Category','air-theme'),
								  'type'        => 'switch',
								  'default'     => 'false',
								  'name'        => 'theme_meta_page_hide_cate', 
								  'control'     => array('name'  => 'theme_meta_page_list_type',
														 'value' => 'masonry-grid|masonry|grid-thumb'))
							)),
					
					array(/* Page Template Filter */
						'super-control' => array(
							'name'  => 'theme_meta_page_template',
							'value' => 'intro-above'
						),
						'item' => array(

							// Show Filter
							array('title'       => esc_html__('Show Filter','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_meta_page_show_filter',
								  'default'     => 'false',
								  'control'     => array('name'  => 'theme_meta_page_pagination',
														 'value' => 'infiniti-scroll|load-more')),
								  
							// Filter Align
							array('title'       => esc_html__('Filter Align','air-theme'),
								  'type'        => 'select',
								  'default'     => 'left',
								  'name'        => 'theme_meta_page_filter_align',
								  'col_size'    => 'width:75%;',
								  'control'     => array('name'  => 'theme_meta_page_show_filter',
														 'value' => 'true'))
							
							)),
					
					array(/* Page Template Filter */
						'super-control' => array(
							'name'  => 'theme_meta_page_template',
							'value' => 'intro-r-filter|intro-in-list'
						),
						'item' => array(

							// Show Filter
							array('title'       => esc_html__('Show Filter','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_meta_page_show_2_filter',
								  'default'     => 'false',
								  'control'     => array('name'  => 'theme_meta_page_pagination',
														 'value' => 'infiniti-scroll|load-more')),
							
							)),

					array(/* Page Top Spacer */
						'super-control' => array(
							'name'  => 'theme_meta_page_template',
							'value' => 'intro-above|intro-r-filter|intro-in-list|none'
						),
						'item' => array(
							// Show Top Spacer
							array('title'       => esc_html__('Spacer above Content','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_meta_page_show_top_spacer',
								  'default'     => 'true'),
						)
					),	
					
					array(

						'item' => array(
							
							array('type'        => 'divider'),

							array('title'       => esc_html__('From Page Top','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_meta_page_from_page_top',
								  'default'     => 'false'),

							array('title'       => esc_html__('Colour for Logo & Menu Button','air-theme'),
								  'description' => '',
								  'type'        => 'select',
								  'name'        => 'theme_meta_page_colour_for_text',
								  'default'     => 'dark',
								  'col_size'    => 'width:50%;'),

							// Show Slider
							array('title'       => esc_html__('Show Slider','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_meta_enable_slider',
								  'default'     => 'false'),

							array('title'       => esc_html__('Show Featured Image','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_meta_page_show_featured_image',
								  'default'     => 'false',
								  'control'     => array('name'  => 'theme_meta_enable_slider',
														 'value' => 'false')),
							
							)),
	
					array(/* Slider */
						'super-control' => array(
							'name'  => 'theme_meta_enable_slider',
							'value' => 'true'
						),
						'item' => array(

							// Slider Source
							array('title'       => esc_html__('Slider Source','air-theme'),
								  'description' => '',
								  'type'        => 'select',
								  'name'        => 'theme_meta_slider_source'),
	
							// Select Slider
							array('title'       => esc_html__('Select Slider','air-theme'),
								  'description' => '',
								  'type'        => 'select',
								  'name'        => 'theme_meta_select_revolution_slider',
								  'control'     => array('name'  => 'theme_meta_slider_source',
														 'value' => 'revolution-slider')),
	
							// Select Slider
							array('title'       => esc_html__('Select Slider','air-theme'),
								  'description' => '',
								  'type'        => 'select',
								  'name'        => 'theme_meta_select_bmslider',
								  'control'     => array('name'  => 'theme_meta_slider_source',
														 'value' => 'bmslider'))
						)
					)
					
				)
			)
		),
		
		// Single Post
		'post' => array(
			
			/* Select Images */
			array(
				'id'      => 'gallery-settings',
				'title'   => esc_html__('Gallery Setting','air-theme'),
				'format'  => 'gallery',
				'section' => array(
					
					array(/* Format Gallery */
						'item' => array(
							
							// gallery
							array('title'       => esc_html__('Select Images','air-theme'),
								  'type'        => 'gallery',
								  'description' => '',
								  'name'        => 'theme_meta_portfolio'),
								  
							array('type'        => 'divider'),
							
							

							))
				)
			),
			
			/* Audio Settings */
			array(
				'id'      => 'audio-settings',
				'title'   => esc_html__('Audio Settings','air-theme'),
				'format'  => 'audio',
				'section' => array(
					
					array(/* Format Audio */
						'item' => array(
						
							// Audio Type
							array('title'       => esc_html__('Audio Type','air-theme'),
								  'description' => '',
								  'type'        => 'image-select',
								  'size'        => '106:43',
								  'default'     => 'self-hosted-audio',
								  'name'        => 'theme_meta_audio_type'),
								  
							array('type'        => 'divider'),
							
							// Artist
							array('title'       => esc_html__('Artist','air-theme'),
								  'description' => '',
								  'type'        => 'text',
								  'name'        => 'theme_meta_audio_artist',
								  'control'     => array('name'  => 'theme_meta_audio_type',
														 'value' => 'self-hosted-audio')),
								  
							// MP3
							array('title'       => esc_html__('MP3','air-theme'),
								  'description' => '',
								  'type'        => 'social-medias',
								  'name'        => 'theme_meta_audio_mp3',
								  'special'     => 'mp3',
								  'placeholder' => array(esc_html__('Title','air-theme'), esc_html__('URL','air-theme')),
								  'control'     => array('name'  => 'theme_meta_audio_type',
														 'value' => 'self-hosted-audio')),
								  
							// Code for WP
							array('title'       => esc_html__('Code for WP','air-theme'),
								  'type'        => 'textarea',
								  'name'        => 'theme_meta_audio_soundcloud',
								  'description' => esc_html__('*Format: https://soundcloud.com/imam-lepast-konyol/maher-zain-always-be-there-1','air-theme'),
								  'control'     => array('name'  => 'theme_meta_audio_type',
														 'value' => 'soundcloud'))))
				)
			),
			
			/* Video Settings */
			array(
				'id'      => 'video-settings',
				'title'   => esc_html__('Video Settings','air-theme'),
				'format'  => 'video',
				'section' => array(
					
					array(/* Format Video */
						'item' => array(
							
							// Description
							array('description' => esc_html__('You could find the embed code on the source video page.','air-theme').'<div class="show-hide-guide-wrap"><a href="https://www.uiueux.com/a/newtea/documentation/video-guide.html" target="_blank"><span>?</span></a></div>',
								  'type'        => 'description'),
								  
							// Embeded Code
							array('title'       => esc_html__('Embeded Code','air-theme'),
								  'description' => '',
								  'type'        => 'textarea',
								  'name'        => 'theme_meta_video_embeded_code'),
								  
							// Ratio	  
							array('title'       => esc_html__('Ratio','air-theme'),
								  'description' => '',
								  'type'        => 'select',
								  'name'        => 'theme_meta_video_ratio',
								  'default'     => '4:3'),
								  
							// Custom Ratio	  
							array('type'        => 'ratio',
								  'name'        => 'theme_meta_video_custom_ratio',
								  'description' => '',
								  'control'     => array('name'  => 'theme_meta_video_ratio',
														 'value' => 'custom'))))
				)
			),
			
			/* Quote Settings */
			array(
				'id' => 'quote-settings',
				'title' => esc_html__('Quote Settings','air-theme'),
				'format' => 'quote',
				'section' => array(
				
					array(/* Format Quote */
						'item' => array(
							
							// The Quote
							array('title'       => esc_html__('The Quote','air-theme'),
								  'description' => esc_html__('Write your quote in this field.','air-theme'),
								  'type'        => 'textarea',
								  'name'        => 'theme_meta_quote'),
							
							// Cite 
							array('title'       => esc_html__('Cite','air-theme'),
								  'description' => '',
								  'type'        => 'textarea',
								  'name'        => 'theme_meta_quote_cite')))
				)
			),
			
			/* Link Settings */
			array(
				'id' => 'link-settings',
				'title' => esc_html__('Link Settings','air-theme'),
				'format' => 'link',
				'section' => array(
					
					array(/* Format Link */
						'item' => array(
						
							// Link Item
							array('title'       => esc_html__('Link Item','air-theme'),
								  'description' => '',
								  'type'        => 'social-medias',
								  'name'        => 'theme_meta_link_item',
								  'special'     => 'mp3',
								  'placeholder' => array(esc_html__('Title','air-theme'), esc_html__('URL','air-theme'))),

							// open new tab
							array('title'       => esc_html__('Open in new window/tab','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_meta_link_item_new_tab', 
								  'default'     => 'false'),
						)
					)
				)
			),
			
			/* Post Options */
			array(
				'id'      => 'post-options',
				'title'   => esc_html__('Layout Options','air-theme'),
				'section' => array(
				
					array(
						'item' => array(
							
							
							// Layout Template
							array('title'       => esc_html__('Layout Template','air-theme'),
								  'description' => '',
								  'type'        => 'select',
								  'name'        => 'theme_meta_gallery_template',
								  'format'      => 'gallery',
								  'col_size'    => 'width:50%;',
								  'default'     => 'none'))),
					
					array(
						'super-control' => array(
							'name'  => 'theme_meta_gallery_template',
							'value' => 'standard'
						),
						'item' => array(
								  
							array('type'        => 'divider',
								  'format'      => 'gallery'),
							
							// Gallery Width
							array('title'       => esc_html__('Gallery Width','air-theme'),
								  'description' => '',
								  'type'        => 'select',
								  'name'        => 'theme_meta_gallery_width',
								  'format'      => 'gallery',
								  'col_size'    => 'width:50%;',
								  'default'     => 'wide'))),
					
					array(
						'super-control' => array(
							'name'  => 'theme_meta_gallery_template',
							'value' => 'on_left|on_right'
						),
						'item' => array(
								  
							array('type'        => 'divider',
								  'format'      => 'gallery'),
							
							// Gallery Col Width
							array('title'       => esc_html__('Gallery Width','air-theme'),
								  'description' => '',
								  'type'        => 'select',
								  'name'        => 'theme_meta_gallery_col_width',
								  'format'      => 'gallery',
								  'col_size'    => 'width:50%;',
								  'default'     => '1/2'),
								  
							// Gallery Style
							array('title'       => esc_html__('Gallery Style','air-theme'),
								  'description' => '',
								  'type'        => 'select',
								  'name'        => 'theme_meta_gallery_style',
								  'format'      => 'gallery',
								  'col_size'    => 'width:50%;',
								  'default'     => 'standard'))),
					
					array(
						'super-control' => array(
							'name'  => 'theme_meta_gallery_template',
							'value' => 'standard|on_left|on_right'
						),
						'item' => array(
								  
							// Text Align
							array('title'       => esc_html__('Text Align','air-theme'),
								  'description' => '',
								  'type'        => 'select',
								  'name'        => 'theme_meta_gallery_text_align',
								  'format'      => 'gallery',
								  'default'     => 'left',
								  'col_size'    => 'width:50%;',
								  'control'     => array('name'  => 'theme_meta_gallery_template',
														 'value' => 'standard')),
								  
							// Start From
							array('title'       => esc_html__('Start From','air-theme'),
								  'description' => '',
								  'type'        => 'select',
								  'name'        => 'theme_meta_gallery_start_from',
								  'format'      => 'gallery',
								  'default'     => 'project_title',
								  'col_size'    => 'width:50%;',
								  'control'     => array('name'  => 'theme_meta_gallery_template',
														 'value' => 'standard')),

							// Gallery Layout Builder
							array('title'       => esc_html__('Gallery Layout Builder','air-theme'),
								  'description' => '',
								  'type'        => 'layout-builder',
								  'name'        => 'theme_meta_enable_portfolio_list_layout_builder',
								  'format'      => 'gallery',
								  'default'     => 'list_layout_1'),
								  
							// Show Video
							array('title'       => esc_html__('Show Video','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_meta_show_gallery_video',
								  'format'      => 'gallery',
								  'default'     => 'false'),
							
							// Description
							array('description' => esc_html__('You could find the embed code on the source video page.','air-theme').'<div class="show-hide-guide-wrap"><a href="https://www.uiueux.com/a/newtea/documentation/video-guide.html" target="_blank"><span>?</span></a></div>',
								  'type'        => 'description',
								  'format'      => 'gallery',
								  'control'     => array('name'  => 'theme_meta_show_gallery_video',
														 'value' => 'true')),
								  
							// Embeded Code
							array('title'       => esc_html__('Embeded Code','air-theme'),
								  'description' => '',
								  'type'        => 'textarea',
								  'format'      => 'gallery',
								  'name'        => 'theme_meta_gallery_video_embeded_code',
								  'control'     => array('name'  => 'theme_meta_show_gallery_video',
														 'value' => 'true')),
								  
							// Ratio	  
							array('title'       => esc_html__('Ratio','air-theme'),
								  'description' => '',
								  'type'        => 'select',
								  'name'        => 'theme_meta_gallery_video_ratio',
								  'format'      => 'gallery',
								  'default'     => '4:3',
								  'control'     => array('name'  => 'theme_meta_show_gallery_video',
														 'value' => 'true')),
								  
							// Custom Ratio	  
							array('type'        => 'ratio',
								  'name'        => 'theme_meta_gallery_video_custom_ratio',
								  'format'      => 'gallery',
								  'description' => '',
								  'control'     => array('name'  => 'theme_meta_gallery_video_ratio',
														 'value' => 'custom')),
								  
							// Video Position	  
							array('title'       => esc_html__('Video Position','air-theme'),
								  'description' => '',
								  'type'        => 'select',
								  'name'        => 'theme_meta_gallery_video_position',
								  'format'      => 'gallery',
								  'default'     => 'top',
								  'control'     => array('name'  => 'theme_meta_show_gallery_video',
														 'value' => 'true')),
								  
							// Image Spacing
							array('title'       => esc_html__('Image Spacing','air-theme'),
								  'description' => '',
								  'type'        => 'select',
								  'name'        => 'theme_meta_gallery_image_spacing',
								  'format'      => 'gallery',
								  'default'     => '40',
								  'col_size'    => 'width:50%;'),

							// Show Caption
							array('title'       => esc_html__('Show Image Caption','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_meta_show_gallery_caption',
								  'format'      => 'gallery',
								  'default'     => 'false'),

							//Caption align
							array('title'       => esc_html__('Caption Align','air-theme'),
								  'description' => '',
								  'type'        => 'select',
								  'name'        => 'theme_meta_page_gallery_caption_align',
								  'format'      => 'gallery',
								  'default'     => 'left',
								  'col_size'    => 'width:50%;',
								  'control'     => array('name'  => 'theme_meta_show_gallery_caption',
														 'value' => 'true'))
							)),
					
					array(
						'super-control' => array(
							'name'  => 'theme_meta_gallery_template',
							'value' => 'standard|on_left|on_right|slider|fullscreen'
						),
						'item' => array(
								  
							array('type'        => 'divider',
								  'format'      => 'gallery'),


							// Show Buttons
							array('title'       => esc_html__('Show Button','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_meta_gallery_show_button',
								  'format'      => 'gallery',
								  'default'     => 'true'),
							
							// Buttons
							array('type'        => 'button-multiple',
								  'name'        => 'theme_meta_gallery_buttons',
								  'format'      => 'gallery',
								  'placeholder' => array(esc_html__('Title','air-theme'), esc_html__('Link','air-theme')),
								  'control'     => array('name'  => 'theme_meta_gallery_show_button',
														 'value' => 'true')),

							// Buttons - open in same window
							array('title'       => esc_html__('Opened in Same Tab or Window','air-theme'),
								  'type'        => 'switch',
								  'name'        => 'theme_meta_gallery_buttons_open_same_win',
								  'format'      => 'gallery',
								  'default'     => 'false',
								  'control'     => array('name'  => 'theme_meta_gallery_show_button',
														 'value' => 'true')),
								  
							// Show Property
							array('title'       => esc_html__('Show Property','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_meta_gallery_show_property',
								  'format'      => 'gallery',
								  'default'     => 'true'),
							
							// Property
							array('type'        => 'property',
								  'name'        => 'theme_meta_enable_portfolio_property',
								  'format'      => 'gallery',
								  'placeholder' => array(esc_html__('Title','air-theme'), esc_html__('Content','air-theme'), esc_html__('URL','air-theme')),
								  'control'     => array('name'  => 'theme_meta_gallery_show_property',
														 'value' => 'true')))),
					
					array(
						'super-control' => array(
							'name'  => 'theme_meta_gallery_template',
							'value' => 'standard|fullscreen'
						),
						'item' => array(
								  
							// Show Feature Image
							array('title'       => esc_html__('Show Feature Image','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_meta_gallery_show_feature_image',
								  'format'      => 'gallery',
								  'default'     => 'false',
								  'control'     => array('name'  => 'theme_meta_gallery_template',
														 'value' => 'standard')),
								  
							// Colour for Logo & Menu Button
							array('title'       => esc_html__('Colour for Logo & Menu Button','air-theme'),
								  'description' => '',
								  'type'        => 'select',
								  'name'        => 'theme_meta_gallery_colour_for_text',
								  'format'      => 'gallery',
								  'default'     => 'dark',
								  'col_size'    => 'width:50%;'))),

					array(
						'super-control' => array(
							'name'  => 'theme_meta_gallery_template',
							'value' => 'standard|on_left|on_right|slider|fullscreen'
						),
						'item' => array(

							// Title Masking
							array('title'       => esc_html__('Title Text Masking','air-theme'),
								  'description' => esc_html__('The Featured Image need be set. For Webkit Browser only, like Chrome, Safari','air-theme'),
								  'type'        => 'switch',
								  'format'      => 'gallery',
								  'name'        => 'theme_meta_gallery_title_masking',
								  'default'     => 'false')
						)
					),

					array(
						'super-control' => array(
							'name'  => 'theme_meta_gallery_template',
							'value' => 'slider|fullscreen'
						),
						'item' => array(

							// Show Swipe Icon on Touch Screen
							array('title'       => esc_html__('Show Swipe Icon on Touch Screen','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_meta_project_show_swipe_icon',
								  'format'      => 'gallery',
								  'default'     => 'false',
								  'col_size'    => 'width:50%;'))),
					
					array(
						'super-control' => array(
							'name'  => 'theme_meta_gallery_template',
							'value' => 'pagebuilder'
						),
						'item' => array(
								  
							// Show Feature Image
							array('title'       => esc_html__('Show Feature Image','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_meta_gallery_pb_show_feature_image',
								  'format'      => 'gallery',
								  'default'     => 'false'),
								  
							// Colour for Logo & Menu Button
							array('title'       => esc_html__('Colour for Logo & Menu Button','air-theme'),
								  'description' => '',
								  'type'        => 'select',
								  'name'        => 'theme_meta_gallery_pb_colour_for_text',
								  'format'      => 'gallery',
								  'default'     => 'dark',
								  'col_size'    => 'width:50%;'))),
					
					
					array(/* Sidebar */
						'item' => array(
							
							// Sidebar
							array('title'       => esc_html__('Sidebar','air-theme'),
								  'description' => '',
								  'type'        => 'image-select',
								  'name'        => 'theme_meta_sidebar',
								  'size'        => '126:80',
								  //'format'      => 'standard',
								  'default'     => 'none',
								  'bind'        => array(
									  array('type'     => 'select',
											'name'     => 'theme_meta_sidebar_widgets',
											'col_size' => 'width:200px;',
											'position' => 'after'))))
					)
				
					
											
				)
			)
		),
		
		/* Jobs Meta */
		'jobs_item' => array(
			array(
				'id'      => 'jobs-meta',
				'title'   => esc_html__('Jobs Meta','air-theme'),
				'section' => array(
					
					array(/* Jobs Meta */
						'item' => array(
							
							// Location
							array('title'       => esc_html__('Location','air-theme'),
								  'description' => '',
								  'type'        => 'text',
								  'name'        => 'theme_meta_jobs_location'),
								
							// Number
							array('title'       => esc_html__('Number','air-theme'),
								  'description' => '',
								  'type'        => 'text',
								  'name'        => 'theme_meta_jobs_number'))))
			)
		),
		
		/* Testimonials Meta */
		'testimonials_item' => array(
			array(
				'id'      => 'testimonials-meta',
				'title'   => esc_html__('Testimonials Meta','air-theme'),
				'section' => array(
				
					array(/* Testimonials Meta */
						'item' => array(
							
							// Testimonial Cite
							array('title'       => esc_html__('Testimonial Cite','air-theme'),
								  'description' => '',
								  'type'        => 'text',
								  'name'        => 'theme_meta_testimonial_cite'),
								  
							// Position
							array('title'       => esc_html__('Position','air-theme'),
								  'description' => '',
								  'type'        => 'text',
								  'name'        => 'theme_meta_testimonial_position'),
								  
							// Link
							array('title'       => esc_html__('Link','air-theme'),
								  'description' => '',
								  'type'        => 'text',
								  'name'        => 'theme_meta_testimonial_link_title',
								  'placeholder' => esc_html__('Title','air-theme'),
								  'col_style'   => 'width:30%;margin-right:5%;float:left;',
								  'bind'        => array(
									  array('type'        => 'text',
											'name'        => 'theme_meta_testimonial_link',
											'position'    => 'after',
											'placeholder' => esc_html__('Link','air-theme'),
											'col_style'   => 'width:65%;float:left;'))))))
			)
		),
		
		/* Clients Meta */
		'clients_item' => array(
			array(
				'id' => 'clients-meta',
				'title' => esc_html__('Clients Meta','air-theme'),
				'section' => array(
				
					array(/* Clients Meta */
						'item' => array(
							
							//Client Link
							array('title'       => esc_html__('Client Link','air-theme'),
								  'description' => '',
								  'type'        => 'text',
								  'name'        => 'theme_meta_client_link'))))
			)
		),
		
		/* Team Meta */
		'team_item' => array(
			array(
				'id' => 'team-meta',
				'title' => esc_html__('Team Meta','air-theme'),
				'section' => array(
					
					array(/* Team Meta */
						'item' => array(
							
							//use team template
							array('title'       => esc_html__('use team template','air-theme'),
								  'description' => '',
								  'type'        => 'switch',
								  'name'        => 'theme_meta_enable_team_template',
								  'default'     => 'true'))),
					
					
					array(/* Sidebar */
						'super-control' => array(
							'name'  => 'theme_meta_enable_team_template',
							'value' => 'false'
						),
						'item' => array(
							
							// Sidebar
							array('title'       => esc_html__('Sidebar','air-theme'),
								  'description' => '',
								  'type'        => 'image-select',
								  'name'        => 'theme_meta_sidebar',
								  'size'        => '126:80',
								  'default'     => 'without-sidebar',
								  'bind'        => array(
									  array('type'     => 'select',
											'name'     => 'theme_meta_sidebar_widgets',
											'col_size' => 'width:200px;',
											'position' => 'after') )),
								  
							array('type'        => 'divider'))),
					
					
					array(/** Team Template is true */
						'super-control' => array(
							'name'  => 'theme_meta_enable_team_template',
							'value' => 'true'
						),
						'item' => array(
							
							// Position
							array('title'       => esc_html__('Position','air-theme'),
								  'description' => '',
								  'type'        => 'text',
								  'name'        => 'theme_meta_team_position'),
								  
							// Email
							array('title'       => esc_html__('Email','air-theme'),
								  'description' => '',
								  'type'        => 'text',
								  'name'        => 'theme_meta_team_email'),
								  
							// Phone Number
							array('title'       => esc_html__('Phone Number','air-theme'),
								  'description' => '',
								  'type'        => 'text',
								  'name'        => 'theme_meta_team_phone_number'),
								  
							// Social Networks
							array('title'       => esc_html__('Social Networks','air-theme'),
								  'description' => '',
								  'type'        => 'new-social-medias',
								  'name'        => 'theme_meta_team_social_medias'))))
			)
		)
	);
	$airtheme_theme_post_meta_fields = apply_filters('ux_theme_post_meta_fields', $airtheme_theme_post_meta_fields);
	return $airtheme_theme_post_meta_fields;
}
$GLOBALS['ux_theme_post_meta_fields'] = airtheme_theme_post_meta_fields();

//Shape for Masonry Grid List
function airtheme_add_posts_meta_box($post){
    add_meta_box(
        'gallery_shape_for_masonry_grid_list_gallery', esc_html__( 'Shape for Masonry Grid List', 'air-theme' ),
        'airtheme_theme_post_meta_gallery_side_interface',
        'post', 'side', 'low'
    );
}
//add_action( 'add_meta_boxes_post', 'airtheme_add_posts_meta_box' );

//require theme meta interface
require_once get_template_directory() . '/functions/theme/post/post-meta-interface.php';
?>