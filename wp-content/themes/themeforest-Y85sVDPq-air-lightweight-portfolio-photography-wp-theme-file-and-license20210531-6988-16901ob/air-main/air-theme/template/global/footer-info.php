<div class="footer-info">
    <div class="footer-container">
        <?php
        $elements = airtheme_get_option('theme_option_footer_elements');
        $elements_infor_1 = airtheme_get_option('theme_option_footer_elements_infor_1');
        $elements_infor_1_menu = airtheme_get_option('theme_option_footer_elements_infor_1_menu');
        $elements_infor_2 = airtheme_get_option('theme_option_footer_elements_infor_2');
        $elements_infor_2_menu = airtheme_get_option('theme_option_footer_elements_infor_2_menu');
        
        switch($elements){
            case '1-set': ?>
                <div class="foot-one-col">
                    <?php airtheme_interface_footer_info_element($elements_infor_1, $elements_infor_1_menu); ?>
                </div>
            <?php
            break;
            
            case '2-set': ?>
                <div class="span6">
                    <?php airtheme_interface_footer_info_element($elements_infor_1, $elements_infor_1_menu); ?>
                </div>
                <div class="span6">
                    <?php airtheme_interface_footer_info_element($elements_infor_2, $elements_infor_2_menu); ?>
                </div>
            <?php
            break;
        } ?>
    </div>
</div>