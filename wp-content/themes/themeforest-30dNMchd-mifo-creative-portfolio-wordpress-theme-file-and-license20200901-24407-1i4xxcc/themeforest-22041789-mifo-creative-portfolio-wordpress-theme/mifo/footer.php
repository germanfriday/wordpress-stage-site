<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package mifo
 */
?>
		    
		</div><!-- .main-container -->

		<?php
			global $rs_option;
		 	require get_parent_theme_file_path('inc/footer/footer.php');    
		?>
	</div><!-- #page -->

		<?php 
		if(!empty($rs_option['show_top_bottom'])){	
			$rstop_bottom=$rs_option['show_top_bottom'];
			if($rstop_bottom == 1){
			?>
		 	<!-- start scrollUp  -->
			<div id="scrollUp">
			    <i class="icon-arrows-slim-up"></i>
			</div>   
			<?php }
			}
		?>

		<?php 			
			wp_footer(); 
		?>  
	</body>
</html>
