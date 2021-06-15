<?php
/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */

get_header();
global $rs_option;

require get_parent_theme_file_path('inc/page-header/breadcrumbs-shop.php');

// Layout class
if ( $rs_option['shop-layout'] == 'full' ) {
	 $mifo_layout_class = 'col-sm-12 col-xs-12';

}
else{
	 $mifo_layout_class = 'col-sm-8 col-md-8 col-xs-12';
}
?>
<div class="container">
	<div id="content" class="site-content">		
		<div class="row">
			<?php
				if ( $rs_option['shop-layout'] == 'left-col'  ) {
					get_sidebar();
				}
			?>    			
		    <div class="<?php echo esc_attr($mifo_layout_class);?>">
			    <?php					
					woocommerce_content();						
   				 ?>
		    </div>
			<?php
				if ( $rs_option['shop-layout'] == 'right-col'  ) {
					get_sidebar();
				}
			?> 
		</div>
	</div>
</div>
<?php
get_footer();

