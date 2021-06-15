<?php
/****************************************************************/
/*
/* Html
/*
/****************************************************************/

//Action Hook WP Title
add_filter('wp_title', 'airtheme_interface_wp_title', 10, 2);

//Action Web Head
add_action('airtheme_interface_webhead', 'airtheme_interface_webhead_viewport', 10);
//add_action('airtheme_interface_webhead', 'airtheme_interface_equiv_meta', 10);
add_action('airtheme_interface_webhead', 'airtheme_interface_webhead_favicon', 15);


/****************************************************************/
/*
/* Wrap
/*
/****************************************************************/

//Action Hook Wrap Before

add_filter('airtheme_interface_wrap_before', 'airtheme_interface_jplayer', 20);
add_filter('airtheme_interface_wrap_before', 'airtheme_interface_wrap_outer_before', 25);
add_filter('airtheme_interface_wrap_before', 'airtheme_interface_page_loading', 15);

//Action Hook Wrap After
add_filter('airtheme_interface_wrap_after', 'airtheme_interface_wrap_outer_after', 10);
add_filter('airtheme_interface_wrap_after', 'airtheme_interface_wrap_border', 13);
add_filter('airtheme_interface_wrap_after', 'airtheme_interface_photoswipe', 20);
add_action('airtheme_interface_wrap_after', 'airtheme_interface_video_popup', 25);
add_action('airtheme_interface_wrap_after', 'airtheme_interface_search_popup', 30);

/****************************************************************/
/*
/* Content
/*
/****************************************************************/

//Action Hook Content Before
add_filter('airtheme_interface_content_before', 'airtheme_interface_content_before', 5);
add_filter('airtheme_interface_content_before', 'airtheme_interface_single_feature_image', 10);
add_filter('airtheme_interface_content_before', 'airtheme_interface_archive_titlewrap', 25);


//Action Hook Content After
add_filter('airtheme_interface_content_after', 'airtheme_interface_content_after', 10);


/****************************************************************/
/*
/* Sidebar
/*
/****************************************************************/

//Action Hook Sidebar Widget
add_action('airtheme_interface_sidebar_widget', 'airtheme_interface_sidebar_widget', 10);


/****************************************************************/
/*
/* Archive
/*
/****************************************************************/

//Action Hook Archive Loop
add_action('airtheme_interface_archive_loop', 'airtheme_interface_archive_loop', 10);

//Action Hook Archive Loop Item
//add_action('airtheme_interface_loop_item_after', 'airtheme_interface_social_bar_and_navi', 10);

//Action Hook Archive Pagination
add_action('airtheme_interface_archive_pagination', 'airtheme_interface_pagination', 10, 3);


/****************************************************************/
/*
/* Page
/*
/****************************************************************/

//Action Hook Page Content Before
add_action('airtheme_interface_page_content_before', 'airtheme_interface_page_content_before', 10);
add_action('airtheme_interface_content_before', 'airtheme_interface_page_feature_image', 15);
add_filter('airtheme_interface_content_before', 'airtheme_interface_content_page_slider', 20);
add_action('airtheme_interface_page_content_before', 'airtheme_interface_page_title', 20);

//Action Hook Page Content After
add_action('airtheme_interface_page_content_after', 'airtheme_interface_page_content_after', 10);

//Action Hook Page Content
add_action('airtheme_interface_page_content', 'airtheme_interface_page_content', 10);
add_action('airtheme_interface_page_content', 'airtheme_interface_pagebuilder', 20);
add_action('airtheme_interface_page_content', 'airtheme_interface_page_comment', 30);


/****************************************************************/
/*
/* Single
/*
/****************************************************************/



//Action Hook Single Content Before
add_action('airtheme_interface_single_content_before', 'airtheme_interface_single_content_before', 10);
//Action Hook Single Content Before video cover
add_action('airtheme_interface_single_content_before', 'airtheme_interface_single_content_video_cover', 5);

//Action Hook Single Content After
add_action('airtheme_interface_single_content_after', 'airtheme_interface_single_content_after', 11);

//Action Hook Single Content
add_action('airtheme_interface_single_content', 'airtheme_interface_single_content', 10);
add_action('airtheme_interface_single_content', 'airtheme_interface_pagebuilder', 15);
add_action('airtheme_interface_single_content', 'airtheme_interface_social_bar_and_navi', 21); 
add_action('airtheme_interface_single_content', 'airtheme_interface_gallery_bottom_navi', 21); 
add_action('airtheme_interface_single_content', 'airtheme_interface_single_comment', 30);


//Action Hook Single Content Before - Title
add_filter('airtheme_interface_single_article_inn_before', 'airtheme_interface_content_titlewrap', 10);

/****************************************************************/
/*
/* Header
/*
/****************************************************************/

//Action Hook Header
add_filter('airtheme_interface_header', 'airtheme_interface_header', 10);
add_filter('airtheme_interface_header', 'airtheme_interface_menu_hidden_panel', 10);

/****************************************************************/
/*
/* Footer
/*
/****************************************************************/

//Action Hook Footer
add_action('airtheme_interface_footer', 'airtheme_interface_footer', 10);
	
?>