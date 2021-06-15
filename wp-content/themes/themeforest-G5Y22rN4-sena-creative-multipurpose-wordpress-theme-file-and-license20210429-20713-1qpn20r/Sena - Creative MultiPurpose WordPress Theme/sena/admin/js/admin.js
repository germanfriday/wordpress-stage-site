(function($) {

	"use strict";
    
    jQuery('#athenastudio_section_type').hide();
    
    jQuery('#page_template').on('change', function() {
        var selected = $('#page_template option:selected').val();

        if (selected==='templates/front.php') {
            jQuery('#athenastudio_section_type').fadeIn(200);
        } else {
            jQuery('#athenastudio_section_type').hide();
        }
    }).trigger('change');
    
})(jQuery);