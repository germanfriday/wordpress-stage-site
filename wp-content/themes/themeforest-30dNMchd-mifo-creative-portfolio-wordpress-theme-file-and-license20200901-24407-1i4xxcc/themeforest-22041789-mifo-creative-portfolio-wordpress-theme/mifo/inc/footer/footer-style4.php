<?php
/*
Grassy footer style 1
*/
?>
<footer id="rs-footer" class="rs-footer footer-style-4">
  <div class="container">
      <div class="row">  
         
          <?php
             if(!empty($rs_option['footer_logo']['url'])) { ?>
                <div class="footer-logo">
                  <img src="<?php echo esc_url( $rs_option['footer_logo']['url']); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                </div>
             <?php }               
          ?>
          
          <div class="footer-bottom-share">
            <?php require get_parent_theme_file_path('inc/footer/footer-social.php');?>
          </div> 

          <div class="copyright">
             <?php require get_parent_theme_file_path('inc/footer/copyright.php'); ?>
          </div>                                 
      </div>
  </div>
</footer><!-- end footer -->
