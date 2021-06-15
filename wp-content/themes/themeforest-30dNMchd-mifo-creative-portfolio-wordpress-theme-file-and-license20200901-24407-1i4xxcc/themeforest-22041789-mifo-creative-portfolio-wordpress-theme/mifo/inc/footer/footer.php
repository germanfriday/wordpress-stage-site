<?php
/*
Grassy inlcude footer
*/
if(is_page()){
	 //check individual footer 
     $post_meta_footer = get_post_meta($post->ID, 'trans_footer', true);	   
	 if($post_meta_footer==''){
		 //checking footer style form global settings
	 	    if(!empty($rs_option['footer_layout'])){ 	    	
			$footer=$rs_option['footer_layout'];
				 
			 
			 if($footer=='style2'){		 
				require get_parent_theme_file_path('inc/footer/footer-style2.php');		
			 }
			  if($footer=='style3'){		 
				 require get_parent_theme_file_path('inc/footer/footer-style3.php');		
			 }
			  if($footer=='style4'){		 
				 require get_parent_theme_file_path('inc/footer/footer-style4.php');		
			 }
 	 
			 if($footer=='style1'){		
				require get_parent_theme_file_path('inc/footer/footer-style1.php');       
			 }
		}
		else{
			require get_parent_theme_file_path('inc/footer/footer-style1.php');
		}
	 } 	 
	 else{
		 //checking footer style form global settings
			 if($post_meta_footer=='Footer Style 1'){		
				require get_parent_theme_file_path('inc/footer/footer-style1.php');	
			 }			 
			 if($post_meta_footer=='Footer Style 2'){		 
				 require get_parent_theme_file_path('inc/footer/footer-style2.php');		
			 }
			  if($post_meta_footer=='Footer Style 3'){		 
				 require get_parent_theme_file_path('inc/footer/footer-style3.php');		
			 }		
 
			 if($post_meta_footer=='Footer Style 4'){
				   require get_parent_theme_file_path('inc/footer/footer-style4.php');		
			 } 	
		  
 		}
	 }

 	else if(!empty($rs_option['footer_layout']))
	{
		$footer = $rs_option['footer_layout'];
		 if($footer == ''){
			 $footer ='inc/footer/Footer Style 1';
		 } 	
		 if($footer == 'style2'){		 
			 require get_parent_theme_file_path('inc/footer/footer-style2.php');		
		 }
		  if($footer == 'style3'){		 
			 require get_parent_theme_file_path('inc/footer/footer-style3.php');		
		 }
		  if($footer == 'style4'){		 
			 require get_parent_theme_file_path('inc/footer/footer-style4.php');		
		 }
  
		 if($footer == 'style1'){		
			require get_parent_theme_file_path('inc/footer/footer-style1.php');       
		 }

 	}
	else{
		require get_parent_theme_file_path('inc/footer/footer-style1.php'); 
	}
?>
