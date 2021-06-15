<?php
/* Top Header part for grassy template
*/
global $rs_option;
?>
<?php if(!empty($rs_option['show-top'])){

      $topbar_position = '';     
     $topbar_position = $rs_option['topbar-position'];
     
     ?>
    <span class="floating-icons float-icon icon-<?php echo esc_attr( strtolower($topbar_position)); ?>"></span>
    <div class="floating-bar <?php echo esc_attr( strtolower($topbar_position)); ?>">
      <div class="floating-share">
        <ul>
          <?php
          if(!empty($rs_option['show-social'])){
            $top_social = $rs_option['show-social']; 
        
              if($top_social == '1'){              
                if(!empty($rs_option['facebook'])) { ?>
                <li> <a href="<?php echo esc_url($rs_option['facebook']);?>" target="_blank"><i class="fa fa-facebook"></i></a> </li>
                <?php } ?>
                <?php if(!empty($rs_option['twitter'])) { ?>
                <li> <a href="<?php echo esc_url($rs_option['twitter']);?> " target="_blank"><i class="fa fa-twitter"></i></a> </li>
                <?php } ?>
                <?php if(!empty($rs_option['rss'])) { ?>
                <li> <a href="<?php  echo esc_url($rs_option['rss']);?> " target="_blank"><i class="fa fa-rss"></i></a> </li>
                <?php } ?>
                <?php if (!empty($rs_option['pinterest'])) { ?>
                <li> <a href="<?php  echo esc_url($rs_option['pinterest']);?> " target="_blank"><i class="fa fa-pinterest-p"></i></a> </li>
                <?php } ?>
                <?php if (!empty($rs_option['linkedin'])) { ?>
                <li> <a href="<?php  echo esc_url($rs_option['linkedin']);?> " target="_blank"><i class="fa fa-linkedin"></i></a> </li>
                <?php } ?>
                <?php if (!empty($rs_option['google'])) { ?>
                <li> <a href="<?php  echo esc_url($rs_option['google']);?> " target="_blank"><i class="fa fa-google-plus-square"></i></a> </li>
                <?php } ?>
                <?php if (!empty($rs_option['instagram'])) { ?>
                <li> <a href="<?php  echo esc_url($rs_option['instagram']);?> " target="_blank"><i class="fa fa-instagram"></i></a> </li>
                <?php } ?>
                <?php if(!empty($rs_option['vimeo'])) { ?>
                <li> <a href="<?php  echo esc_url($rs_option['vimeo']);?> " target="_blank"><i class="fa fa-vimeo"></i></a> </li>
                <?php } ?>
                <?php if (!empty($rs_option['tumblr'])) { ?>
                <li> <a href="<?php  echo esc_url($rs_option['tumblr']);?> " target="_blank"><i class="fa fa-tumblr"></i></a> </li>
                <?php } ?>
                <?php if (!empty($rs_option['youtube'])) { ?>
                <li> <a href="<?php  echo esc_url($rs_option['youtube']);?> " target="_blank"><i class="fa fa-youtube"></i></a> </li>
                <?php } 
                }
            }
           ?>
        </ul>
      </div>
      <div class="floating-contact">
        <ul>
          <?php if(!empty($rs_option['top-email'])) { ?>
          <li><a href="mailto:<?php echo esc_attr($rs_option['top-email'])?>" title="<?php echo esc_attr($rs_option['top-email'])?>"><i class="fa fa-envelope-o"></i><?php //echo esc_html($rs_option['top-email'])?></a> </li>
          <?php } ?>
          <?php if(!empty($rs_option['phone'])) { ?>
          <li><a href="tel:+<?php echo esc_attr($rs_option['phone'])?>" title="<?php echo esc_attr($rs_option['phone'])?>"> <i class="fa fa-mobile"></i><span><?php //echo esc_html($rs_option['phone-pretext']);?></span> <?php //echo esc_html($rs_option['phone']); ?></a> </li>
          <?php } ?>          
        </ul>
      </div>
    </div>
    <?php 
} ?>
