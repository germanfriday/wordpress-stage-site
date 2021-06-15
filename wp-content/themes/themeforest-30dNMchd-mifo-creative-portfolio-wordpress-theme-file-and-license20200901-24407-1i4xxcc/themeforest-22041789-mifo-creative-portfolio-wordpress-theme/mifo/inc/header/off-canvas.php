<?php if(!empty($rs_option['off_canvas'])){
            $off = $rs_option['off_canvas'];
            if( $off == 1 ){
       ?>
          <div class='nav-link-container'> 
            <a href='#' class="nav-menu-link"><i class="fa fa-bars" aria-hidden="true"></i></a> 
          </div>
          <?php } 
      }

    $off_style = get_post_meta(get_the_ID(), 'off_style', true);
    $off_full="";
    if($off_style=="Fullwidth"):
      $off_full = "offcanvas-full";
    endif;


     //off convas here
    if(!empty( $rs_option['off_canvas'] )){
        $off = $rs_option['off_canvas'];
        if( $off == 1 ){
    ?>
    <nav class="nav-container nav">
        <ul class="sidenav <?php echo  esc_attr($off_full); ?>">
            <li class='nav-close-menu-li'><button><?php esc_html_e('x', 'mifo');?></button></li>
              <?php dynamic_sidebar('sidebarcanvas-1'); ?>
            <li>
              <?php require get_parent_theme_file_path('inc/footer/footer-social.php'); ?> 
            </li> 
        </ul>
    </nav>
    <?php }
}?>