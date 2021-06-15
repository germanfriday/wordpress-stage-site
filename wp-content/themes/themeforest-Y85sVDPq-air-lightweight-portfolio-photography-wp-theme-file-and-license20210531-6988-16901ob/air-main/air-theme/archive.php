<?php get_header(); ?>
   
    <div id="content">
    
        <?php //** Do Hook Archive before
		do_action('airtheme_interface_archive_before'); ?>
        
        <div class="content_wrap_outer container">
			<?php airtheme_get_template_part('global/content', 'titlewrap'); ?>
        
            <div class="sidebar-layout row">
                <div id="content_wrap" class="col-sm-9 col-md-9">

                    <?php
                    //** Do Hook Archive loop
                    /**
                     * @hooked  airtheme_interface_archive_loop - 10
                     */
                    do_action('airtheme_interface_archive_loop'); ?>
                    
                </div>
                
                <?php //** Do Hook Sidebar Widget
				/**
				 * @hooked  airtheme_interface_sidebar_widget - 10
				 */
				do_action('airtheme_interface_sidebar_widget'); ?>
                
            </div>
        </div>
        
    </div><!--End content-->
  
<?php get_footer(); ?>