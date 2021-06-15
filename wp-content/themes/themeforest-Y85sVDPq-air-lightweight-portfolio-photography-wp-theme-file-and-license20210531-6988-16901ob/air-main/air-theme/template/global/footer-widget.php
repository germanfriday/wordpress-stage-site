<?php
$switch_sidebar = false;
$sidebar_widget = '';

if ( is_singular( 'post' ) ) {	
	$sidebar_widget = airtheme_get_option( 'theme_option_footer_widget_for_posts' );
	$switch_sidebar = airtheme_get_option( 'theme_option_enable_footer_widget_for_posts' );
} else {
	$sidebar_widget = airtheme_get_option( 'theme_option_footer_widget_for_pages' );
	$switch_sidebar = airtheme_get_option( 'theme_option_enable_footer_widget_for_pages' );
}

if ( $switch_sidebar ) { ?>
    <div class="widget_footer">
        <div class="container">
            <div class="row">
                <?php if ( $sidebar_widget ) {
					airtheme_dynamic_sidebar( $sidebar_widget, 3 );
				} ?>
            </div>
        </div>
    </div>

<?php
}
?>