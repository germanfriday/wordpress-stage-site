<?php
    /* The footer widget area is triggered if any of the areas
     * have widgets. So let's check that first.
     *
     * If none of the sidebars have widgets, then let's bail early.
     */
    if (   ! is_active_sidebar( 'footer1'  )
        && ! is_active_sidebar( 'footer2' )
        && ! is_active_sidebar( 'footer3'  )
        && ! is_active_sidebar( 'footer4' )
    ){
      
    } 
    
?>

<?php if(is_active_sidebar('footer1') && is_active_sidebar('footer2') && is_active_sidebar('footer3') && is_active_sidebar('footer4'))
  {?>
  <div class="footer-top">
      <div class="container">
        <div class="row">                   
          <div class="col-md-3">                                          
              <div class="about-widget">
               <?php              
                 if(!empty($rs_option['footer_logo']['url'])) { ?>
                       <img src="<?php echo esc_url( $rs_option['footer_logo']['url']); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' )); ?>">
                    <?php }               
                 ?>
                <?php dynamic_sidebar('footer1') ?>
              </div>                        
          </div>              
          <div class="col-md-3">
            <?php dynamic_sidebar('footer2'); ?>                            
          </div>
          <div class="col-md-3">
              <?php dynamic_sidebar('footer3'); ?>   
          </div>
          <div class="col-md-3">
             <?php dynamic_sidebar('footer4'); ?>   
          </div>
      </div>
    </div>
  </div>
  <?php }
 elseif(is_active_sidebar('footer1') && is_active_sidebar('footer2') && is_active_sidebar('footer3') && !is_active_sidebar('footer4'))
  {?>
  <div class="footer-top">
      <div class="container">
        <div class="row">                   
          <div class="col-md-4">                                          
              <div class="about-widget">
               <?php              
                 if(!empty($rs_option['footer_logo']['url'])) { ?>
                       <img src="<?php echo esc_url( $rs_option['footer_logo']['url']); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' )); ?>">
                    <?php }               
                 ?>
                <?php dynamic_sidebar('footer1') ?>
              </div>                        
          </div>              
          <div class="col-md-4">
            <?php dynamic_sidebar('footer2'); ?>                            
          </div>
          <div class="col-md-4">
              <?php dynamic_sidebar('footer3'); ?>   
          </div>         
      </div>
    </div>
  </div>
<?php } 
 elseif(is_active_sidebar('footer1') && is_active_sidebar('footer2') && !is_active_sidebar('footer3') && !is_active_sidebar('footer4'))
  { ?>
  <div class="footer-top"> 
      <div class="container">
        <div class="row">                   
          <div class="col-md-6">                                          
              <div class="about-widget">
               <?php              
                 if(!empty($rs_option['footer_logo']['url'])) { ?>
                       <img src="<?php echo esc_url( $rs_option['footer_logo']['url']); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' )); ?>">
                    <?php }               
                 ?>
                <?php dynamic_sidebar('footer1') ?>
              </div>                        
          </div>              
          <div class="col-md-6">
            <?php dynamic_sidebar('footer2'); ?>                            
          </div>          
      </div>
    </div>
  </div>
  <?php
  }

 elseif(is_active_sidebar('footer1') && !is_active_sidebar('footer2') && !is_active_sidebar('footer3') && !is_active_sidebar('footer4')) {
?>
<div class="footer-top"> 
<div class="container">
        <div class="row">                   
          <div class="col-md-12">                                          
              <div class="about-widget">
               <?php              
                 if(!empty($rs_option['footer_logo']['url'])) { ?>
                       <img src="<?php echo esc_url( $rs_option['footer_logo']['url']); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' )); ?>">
                    <?php }               
                 ?>
                <?php dynamic_sidebar('footer1') ?>
              </div>                        
          </div>                  
      </div>
    </div>
    </div>
<?php } ?>    

