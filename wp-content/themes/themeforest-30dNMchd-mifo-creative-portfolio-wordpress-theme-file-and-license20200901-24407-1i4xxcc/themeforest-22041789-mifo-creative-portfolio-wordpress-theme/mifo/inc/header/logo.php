<?php 
global $rs_option;
if(!empty($rs_option['logo-type'])){
$logo = $rs_option['logo-type'];
if( $logo == 'Text' ){
   ?>
   <div class="logo-area">
     <h1 id="logo">
          <span class="site-name"><a href="<?php echo esc_url(home_url( '/' )); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
            <?php echo esc_attr($rs_option['mifotext']); ?>
          </a>
          </span>
      </h1><!-- end of #logo -->
    </div>
   <?php
} 
else{
if(is_page()){
 $post_meta_header = get_post_meta($post->ID, 'logo_style', true); 
 if($post_meta_header == 'Dark Logo'){ ?>
  <div class="logo-area">
    <?php
       if (!empty( $rs_option['mifologo']['url'] ) ) { ?>
    	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo esc_url( $rs_option['mifologo']['url']); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"></a>
    <?php }	else{?>
      <h1 id="logo">
          <span class="site-name"><a href="<?php echo esc_url(home_url( '/' )); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
          </span>
      </h1><!-- end of #logo -->
    <?php } 
    ?>
  </div>
  <?php } else {?>

  <div class="logo-area">
    <?php
       if (!empty( $rs_option['mifologo_transparent']['url'] ) ) { ?>
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo esc_url( $rs_option['mifologo_transparent']['url']); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"></a>
    <?php } else{?>
      <h1 id="logo">
          <span class="site-name"><a href="<?php echo esc_url(home_url( '/' )); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
          </span>
      </h1><!-- end of #logo -->
    <?php } 
    ?>
  </div>
<?php }

 if (!empty( $rs_option['rswplogo_sticky']['url'] ) ) { ?>
    <div class="logo-area sticky-logo">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo esc_url( $rs_option['rswplogo_sticky']['url']); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"></a>
       </div>
    <?php } 
    }
else{
  ?>
  <div class="logo-area">
    <?php
       if (!empty( $rs_option['mifologo']['url'] ) ) { ?>
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo esc_url( $rs_option['mifologo']['url']); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"></a>
    <?php }	else{?>
      <h1 id="logo">
          <span class="site-name"><a href="<?php echo esc_url(home_url( '/' )); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
          </span>
      </h1><!-- end of #logo -->
    <?php } 
    ?>
  </div>
  <?php

  if (!empty( $rs_option['rswplogo_sticky']['url'] ) ) { ?>
    <div class="logo-area sticky-logo">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo esc_url( $rs_option['rswplogo_sticky']['url']); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"></a>
       </div>
    <?php }
} 
}
}
else{
  if(is_page()){
 $post_meta_header = get_post_meta($post->ID, 'logo_style', true); 
 if($post_meta_header == 'Dark Logo'){ ?>
  <div class="logo-area">
    <?php
       if (!empty( $rs_option['mifologo']['url'] ) ) { ?>
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo esc_url( $rs_option['mifologo']['url']); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"></a>
    <?php } else{?>
      <h1 id="logo">
          <span class="site-name"><a href="<?php echo esc_url(home_url( '/' )); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
          </span>
      </h1><!-- end of #logo -->
    <?php } 
    ?>
  </div>
  <?php } else {?>

  <div class="logo-area">
    <?php
       if (!empty( $rs_option['mifologo_transparent']['url'] ) ) { ?>
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo esc_url( $rs_option['mifologo_transparent']['url']); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"></a>
    <?php } else{?>
      <h1 id="logo">
          <span class="site-name"><a href="<?php echo esc_url(home_url( '/' )); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
          </span>
      </h1><!-- end of #logo -->
    <?php } 
    ?>
  </div>
<?php } 
    }
else{
  ?>
  <div class="logo-area">
    <?php
       if (!empty( $rs_option['mifologo']['url'] ) ) { ?>
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo esc_url( $rs_option['mifologo']['url']); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"></a>
    <?php } else{?>
      <h1 id="logo">
          <span class="site-name"><a href="<?php echo esc_url(home_url( '/' )); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
          </span>
      </h1><!-- end of #logo -->
    <?php } 
    ?>
  </div>
  <?php

  if (!empty( $rs_option['rswplogo_sticky']['url'] ) ) { ?>
    <div class="logo-area sticky-logo">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo esc_url( $rs_option['rswplogo_sticky']['url']); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"></a>
       </div>
    <?php 
    }
  } 
}


if(!empty($rs_option['logo-type'])){
$logo = $rs_option['logo-type'];
if( $logo == 'Text' ){
  ?>
  <div class="logo-area sticky-logo">
    <h1 class="logo">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
        <?php echo esc_attr($rs_option['mifotext']); ?>
      </a>
    </h1>
  </div>
  <?php
}
}
else{
if (!empty( $rs_option['rswplogo_sticky']['url'] ) ) { ?>
    <div class="logo-area sticky-logo">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo esc_url( $rs_option['rswplogo_sticky']['url']); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"></a>
       </div>
<?php } 
}


?>