jQuery(document).ready(function($) {
    "use strict";

    var page_template = jQuery('#page_template');

    // on click visual page editor button set page template "visual page"
    jQuery('#wp-content-media-buttons').on('click', '.button-primary', function(){
        if( page_template.val() == 'default' ){
            page_template.val('page-builder.php');
        }
    });

    // on click default editor button set page template "default template"
    jQuery('#post-body').on('click', '.page-builder-hide-button', function(){
        // change only previous template was from theme templates
        if( page_template.val() == 'page-builder.php' ) {
            page_template.val('default');
        }
    });

    // on change page template hide header image option
    page_template.on('change', function(){
        if( page_template.val() == 'default' ){
            jQuery('.page-builder-hide-button').trigger('click');
        }
        else if( page_template.val() == 'page-builder.php' ){
            jQuery('#wp-content-media-buttons .button-primary').trigger('click');
        }
    });
});