<?php
/*
      Grassy Footer Social Links
*/
?>
<?php 
      if(!empty($rs_option['show-social2'])){
            $footer_social = $rs_option['show-social2'];
            if($footer_social == 1){?>
                  <ul class="social">  
                        <?php
                         if(!empty($rs_option['facebook'])) { ?>
                         <li> 
                              <a href="<?php echo esc_url($rs_option['facebook'])?>" target="_blank"><i class="fa fa-facebook"></i></a> 
                         </li>
                        <?php } ?>
                        <?php if(!empty($rs_option['twitter'])) { ?>
                        <li> 
                              <a href="<?php echo esc_url($rs_option['twitter']);?> " target="_blank"><i class="fa fa-twitter"></i></a> 
                        </li>
                        <?php } ?>
                        <?php if(!empty($rs_option['rss'])) { ?>
                        <li> 
                              <a href="<?php  echo esc_url($rs_option['rss']);?> " target="_blank"><i class="fa fa-rss"></i></a> 
                        </li>
                        <?php } ?>
                        <?php if (!empty($rs_option['pinterest'])) { ?>
                        <li> 
                              <a href="<?php  echo esc_url($rs_option['pinterest']);?> " target="_blank"><i class="fa fa-pinterest-p"></i></a> 
                        </li>
                        <?php } ?>
                        <?php if (!empty($rs_option['linkedin'])) { ?>
                        <li> 
                              <a href="<?php  echo esc_url($rs_option['linkedin']);?> " target="_blank"><i class="fa fa-linkedin"></i></a> 
                        </li>
                        <?php } ?>
                        <?php if (!empty($rs_option['google'])) { ?>
                        <li> 
                              <a href="<?php  echo esc_url($rs_option['google']);?> " target="_blank"><i class="fa fa-google-plus-square"></i></a> 
                        </li>
                        <?php } ?>
                        <?php if (!empty($rs_option['instagram'])) { ?>
                        <li> 
                              <a href="<?php  echo esc_url($rs_option['instagram']);?> " target="_blank"><i class="fa fa-instagram"></i></a> 
                        </li>
                        <?php } ?>
                        <?php if(!empty($rs_option['vimeo'])) { ?>
                        <li> 
                              <a href="<?php  echo esc_url($rs_option['vimeo'])?> " target="_blank"><i class="fa fa-vimeo"></i></a> 
                        </li>
                        <?php } ?>
                        <?php if (!empty($rs_option['tumblr'])) { ?>
                        <li> 
                              <a href="<?php  echo esc_url($rs_option['tumblr'])?> " target="_blank"><i class="fa fa-tumblr"></i></a> 
                        </li>
                        <?php } ?>
                        <?php if (!empty($rs_option['youtube'])) { ?>
                        <li> 
                              <a href="<?php  echo esc_url($rs_option['youtube'])?> " target="_blank"><i class="fa fa-youtube"></i></a> 
                        </li>
                        <?php } ?>     
                  </ul>
       <?php } 
}?>
