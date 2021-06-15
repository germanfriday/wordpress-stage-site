<?php
    global $rs_option;   
?>
<div class="rs-breadcrumbs  porfolio-details">
  <div class="rs-breadcrumbs-inner">  
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <div class="breadcrumbs-inner">
         <?php    
         if(!empty($rs_option['blog_title'])) { ?>
            <h1 class="page-title"><?php echo esc_html($rs_option['blog_title']);?></h1>
            <?php }
            else{
               ?>
               <h1 class="page-title"> <?php esc_html_e('Blog','mifo'); ?></h1>
           <?php  
               }?>
               <?php if(function_exists('bcn_display')) {
                   bcn_display();
                 }
                
               ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>