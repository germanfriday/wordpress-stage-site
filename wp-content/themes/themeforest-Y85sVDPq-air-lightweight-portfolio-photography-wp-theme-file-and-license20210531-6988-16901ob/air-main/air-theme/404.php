<?php get_header(); ?>
   
    <div id="main-wrap">
    
        <div id="main">
        
            <div id="content" class="">
            
                <div id="content_wrap" class="fourofour-wrap">

                    <div class="container-inn">
                
                        <h1><?php esc_html_e('PAGE NOT FOUND','air-theme'); ?></h1><h4><?php esc_html_e('STAY CALM AND DON\'T FREAK OUT!','air-theme'); ?></h4>
                    
                        <p><?php esc_html_e('Unfortunately, the page you are looking for is unavailable. Trying visit our','air-theme'); ?> <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Homepage','air-theme'); ?></a><?php esc_html_e(' and starting from there.','air-theme'); ?></p>
                    
                    </div>

                </div><!--End fourofour-wrap-->
                
            </div><!--End content-->
    
        </div><!--End #main-->
    
    </div><!--End #main-wrap-->
  
<?php get_footer(); ?>