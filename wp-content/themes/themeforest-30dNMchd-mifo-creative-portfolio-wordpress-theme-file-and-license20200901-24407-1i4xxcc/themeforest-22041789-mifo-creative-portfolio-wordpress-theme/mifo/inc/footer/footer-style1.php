<?php
/*
Grassy footer style 1
*/
if(is_active_sidebar('footer1')):
   $top_gap='';
  else:
    $top_gap='top_gap';
  endif;
?>
<footer id="rs-footer" class="rs-footer footer-style-1 <?php echo esc_attr($top_gap);?>">
<!-- adding footer widget -->	
 <?php require get_parent_theme_file_path('inc/footer/footer-top.php'); ?>
  <div class="footer-bottom">
      <div class="container">
          <div class="row">
              <div class="col-md-4 col-sm-6">
                  <div class="copyright">
                     <?php require get_parent_theme_file_path('inc/footer/copyright.php'); ?>
                  </div>
              </div>
              <div class="col-md-8 col-sm-6">
                  <div class="text-right ft-bottom-right">
                      <div class="footer-bottom-share">
                        <?php require get_parent_theme_file_path('inc/footer/footer-social.php');?>
                      </div>                                
                  </div>
              </div>
          </div>
      </div>
  </div>
</footer><!-- end footer -->
