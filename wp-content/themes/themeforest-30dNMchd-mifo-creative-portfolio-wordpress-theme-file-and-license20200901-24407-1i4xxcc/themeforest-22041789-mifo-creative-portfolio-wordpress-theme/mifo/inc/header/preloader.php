<?php if(!empty($rs_option['show_preloader']))
	{
		$loading = $rs_option['show_preloader'];
		if($loading == 1){
	  ?>  
      <div id="loading">
            <div id="loading-center">
                <div id="loading-center-absolute">
                    <div class="object" id="object_one"></div>
                    <div class="object" id="object_two"></div>
                    <div class="object" id="object_three"></div>
                </div>
            </div>
        </div>
 	<?php } 
}?>

 <?php if(!empty($rs_option['off_sticky'])):   
        $sticky = $rs_option['off_sticky'];         
        if($sticky == 1):
         $sticky_menu ='menu-sticky';        
        endif;
       else:
       $sticky_menu ='';
      endif;


if( is_page() ){
 $post_meta_header = get_post_meta($post->ID, 'trans_header', true);  

     if($post_meta_header == 'Transparent Header'){       
        $header_style = 'transparent_header';             
     }
     else{
        $header_style = 'default_header';
    }
 }
 else{
    $header_style = 'default_header';
 }

 ?>   