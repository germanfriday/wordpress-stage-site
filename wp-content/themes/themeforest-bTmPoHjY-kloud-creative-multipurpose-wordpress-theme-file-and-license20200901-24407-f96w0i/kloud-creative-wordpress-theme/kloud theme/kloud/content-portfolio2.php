<?php 
   global $kloud_portfolio_loop , $kloud_loop ;
   $options_2 = get_post_meta( get_the_ID(), '_custom_pp_options', true );
   $kloud_loop['img_size'] = $kloud_portfolio_loop['img_size'];
   $columns = "";
   if($kloud_portfolio_loop['columns']  == "4") {
    $columns = " col-lg-3 col-md-3 col-sm-6 col-xs-12 ";
   }elseif($kloud_portfolio_loop['columns']  == "3"){
    $columns = " col-lg-4 col-md-4 col-sm-6 col-xs-12 ";
   }elseif($kloud_portfolio_loop['columns']  == "2"){
    $columns = " col-lg-6 col-md-6 col-sm-6 col-xs-12 ";
   }else {
    $columns = " col-lg-2 col-md-2 col-sm-6 col-xs-12 ";
   }
    $class_slug = '';
	$item_cats  = get_the_terms( get_the_ID(), 'portfolio_cat' );
	if ( $item_cats ):
		foreach ( $item_cats as $item_cat ) {
			$class_slug .= $item_cat->slug . ' ';
		}
	endif;  
?>
<div style="padding:<?php echo wp_kses_post($kloud_portfolio_loop['spacing']."px"); ?>;" class="item_portfolio <?php echo wp_kses_post($kloud_portfolio_loop['layout']);  echo wp_kses_post($columns);?> <?php echo wp_kses_post($class_slug) ; ?>">
<div  class="pp_inner">
    <div class="image_pp">
    <?php 
        echo kloud_get_post_thumbnail('large');
    ?>
    </div>
        <div class="content_pp">
    <div class="content_pp_inner">
    <h6 class="title">
    <a href="<?php the_permalink(); ?>">
    <?php 
        the_title();
    ?>
    </a>
    </h6>
    <div class="cat">
        <?php 
            if ( $item_cats ):
        		foreach ( $item_cats as $item_cat ) {
        	    ?>
                     <a href="<?php echo esc_url(get_term_link($item_cat->slug, 'portfolio_cat')); ?>">
                        <?php echo wp_kses_post($item_cat->name . ' '); ?>
                     </a><span>,</span> 
        		<?php }

           	endif;
      ?>
    </div>
    </div>
    </div>
</div>
</div>
