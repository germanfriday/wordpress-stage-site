<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package mifo
 */

if ( !is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
if(is_home()){
	?>

<aside id="secondary" class="widget-area">
  <div class="bs-sidebar dynamic-sidebar">
    <?php		
         dynamic_sidebar('sidebar-1');
      ?>
  </div>
</aside>
<?php
	}
else{ 
	$page_layout = get_post_meta( $post->ID, 'layout', true );
	if($page_layout=='2left' || $page_layout=='2right' ){	
?>
<div class="col-md-3">
  <aside id="secondary" class="widget-area">
    <div class="bs-sidebar dynamic-sidebar">
      <?php
		$page_sidebar = get_post_meta( $post->ID, 'custom_sidebar', true );
         dynamic_sidebar($page_sidebar);
      ?>
    </div>
  </aside>
  <!-- #secondary --> 
</div>
<?php
}
}?>
