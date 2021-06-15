<?php
//Tag widget filter
function airtheme_cloud_filter($args = array()) {
   $args['smallest'] = 11;
   $args['largest'] = 11;
   $args['unit'] = 'px';
   return $args;
}
add_filter('widget_tag_cloud_args', 'airtheme_cloud_filter', 90);

//widget require modal
function airtheme_widgets_admin_page(){ ?>
    <div class="ux-theme-box">
		<?php airtheme_theme_option_modal(); ?>
    </div>
<?php
}
add_action('widgets_admin_page', 'airtheme_widgets_admin_page');

?>