<?php
$post_meta_data = get_post_meta(get_the_ID(), 'rs_option_banner', true);?>
<?php if($post_meta_data!=''){   
?>
<div class="rs-breadcrumbs"> <img id="meta-image-preview" src="<?php echo esc_url($post_meta_data); ?>"  />
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <div class="breadcrumbs-inner">
          <?php 
            $post_meta_title = get_post_meta($post->ID, 'page_title', true);?>
          <?php if($post_meta_title == 'Yes'){             
          ?>
          <h1 class="page-title">
            <?php the_title();?>
          </h1>
          <?php } 
          else{
           ?>
          <h1 class="page-title">
            <?php the_title();?>
          </h1>
          <?php
           }     
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
<?php }
else{   
$post_meta_bread = get_post_meta(get_the_ID(), 'page_bread', true);?>
<?php if($post_meta_bread =='Show' || $post_meta_bread ==''){?>
<div class="rs-breadcrumbs  porfolio-details">
  <div class="rs-breadcrumbs-inner">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <div class="breadcrumbs-inner">
            <h1 class="page-title">
              <?php the_title();?>
            </h1>
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
<?php
  }
  else{
    $post_meta_title = get_post_meta($post->ID, 'page_title', true);?>
    <?php if($post_meta_title == 'Hide'){
      }
    else{
      ?>
      <div class="container inner-page-title">
        <h1>
          <?php the_title();?>
        </h1>
         <?php if(function_exists('bcn_display')) {
            bcn_display();
            }
        ?>
      </div>
  <?php } 
      }
  }
?>