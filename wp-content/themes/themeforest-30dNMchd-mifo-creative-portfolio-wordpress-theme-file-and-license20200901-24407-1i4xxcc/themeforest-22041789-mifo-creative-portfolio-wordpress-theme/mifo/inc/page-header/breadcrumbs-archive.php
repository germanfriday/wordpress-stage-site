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
                 the_archive_title( '<h1 class="page-title">', '</h1>' );
              ?>
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