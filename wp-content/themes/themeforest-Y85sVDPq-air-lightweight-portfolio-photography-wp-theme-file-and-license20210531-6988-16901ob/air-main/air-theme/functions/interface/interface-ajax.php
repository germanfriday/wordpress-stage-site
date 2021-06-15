<?php
//Function interface ajax search list
function airtheme_interface_ajax_search_list(){
	$data = $_POST['data'];
	$keywords = $data["keywords"];
	$paged = $data["paged"];
	airtheme_interface_search_list_load($keywords, $paged);
	exit;
}
add_action('wp_ajax_airtheme_interface_ajax_search_list', 'airtheme_interface_ajax_search_list');
add_action('wp_ajax_nopriv_airtheme_interface_ajax_search_list', 'airtheme_interface_ajax_search_list');


//Function interface ajax add cart
function blocker_interface_ajax_add_cart(){
	$product_id = $_POST['product_id'];
	$quantity = empty( $_POST['quantity'] ) ? 1 : wc_stock_amount( $_POST['quantity'] );
	blocker_woocommerce_loop_add_to_cart($product_id, $quantity);

	exit;
}
add_action('wp_ajax_blocker_interface_ajax_add_cart', 'blocker_interface_ajax_add_cart');
add_action('wp_ajax_nopriv_blocker_interface_ajax_add_cart', 'blocker_interface_ajax_add_cart');

//Function interface ajax cart number
function blocker_interface_ajax_cart_number(){
	if(function_exists('WC')){
		echo sizeof(WC()->cart->get_cart());
	}

	exit;
}
add_action('wp_ajax_blocker_interface_ajax_cart_number', 'blocker_interface_ajax_cart_number');
add_action('wp_ajax_nopriv_blocker_interface_ajax_cart_number', 'blocker_interface_ajax_cart_number');

//Function interface ajax portfolio list
function airtheme_interface_ajax_portfolio_list(){
	$post_id = intval($_POST['post_id']);
	$paged = intval($_POST['paged']);
	
	if($post_id){
		$category = airtheme_get_option('theme_option_category_for_more_project');
		$per_page = airtheme_get_option('theme_option_category_for_more_project_num');
		
		$per_page = $per_page ? intval($per_page) : -1;
		
		$paged = $paged ? $paged : 1;
		
		if(!intval($category)){
			$category = '';
		}else{
			$category = intval($category);
		}
		
		$the_query = new WP_Query(array(
			'posts_per_page' => $per_page,
			'paged' => $paged,
			'category__in' => $category,
			'post_status' => 'publish',
			'tax_query' => array(
				array(
					'taxonomy' => 'post_format',
					'field' => 'slug',
					'terms' => array('post-format-gallery')
				)
			)
		));
		
		if($the_query->have_posts()){
			
			if($paged < 2){ ?>
		
			<div class="ux-portfolio-ajaxed-list-wrap container">
				<div class="ux-portfolio-ajaxed-list grid-mask-filled-center clearfix">
                <?php } ?>
				
					<?php
					while($the_query->have_posts()){ $the_query->the_post();
						$thumb_width = 650;
						$thumb_height = 490;
						$thumb_url = esc_url(get_template_directory_uri(). '/img/blank.gif');
						
						if(has_post_thumbnail()){
							$thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'airtheme-thumb-43-small');
							$thumb_width = $thumb[1];
							$thumb_height = $thumb[2];
							$thumb_url = esc_url($thumb[0]);
						}
						
						$thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'airtheme-thumb-43-small');
						
						$image_lazyload = airtheme_get_option('theme_option_enable_image_lazyload');
						$image_lazyload_style = 'data-bg="' .esc_url($thumb_url). '"';
						$image_lazyload_class = 'ux-lazyload-bgimg';
						if(!$image_lazyload){
							$image_lazyload_style = 'style="background-image:url(' .esc_url($thumb_url). ');"';
							//$image_lazyload_class = '';
						} ?>
						
                        <section class="ajaxed-grid-item grid-item">
							<div class="grid-item-inside">
								<div class="grid-item-con">
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="grid-item-mask-link"></a>
									<div class="grid-item-con-text">
										<span class="grid-item-cate"><?php airtheme_theme_hide_category(' ', 'grid-item-cate-a'); ?></span>
										<h2 class="grid-item-tit"><a class="grid-item-tit-a" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
									</div>
								</div>
				
								<div class="brick-content ux-lazyload-wrap" style="padding-top:75%;">
                                    <div class="<?php echo sanitize_html_class($image_lazyload_class); ?> ux-background-img" <?php echo wp_kses($image_lazyload_style, airtheme_shapeSpace_allowed_html()); ?>></div>
								</div>
								
							</div><!--End inside-->
						</section> 
                    <?php
                    }
					wp_reset_postdata(); 
					
				if($paged < 2){ ?>
				</div>
                
                <?php if($the_query->have_posts()){
					airtheme_page_view_pagination($post_id, $the_query, 'load-more'); 
				} ?>
			</div>
			<?php
            }
		}
	}
	
	exit;
}
add_action('wp_ajax_airtheme_interface_ajax_portfolio_list', 'airtheme_interface_ajax_portfolio_list');
add_action('wp_ajax_nopriv_airtheme_interface_ajax_portfolio_list', 'airtheme_interface_ajax_portfolio_list');

//Function interface ajax page masonry list
function airtheme_interface_page_ajax_masonry_list(){
	$post_id = intval($_POST['post_id']);
	$paged = intval($_POST['paged']);
	
	if($post_id){
		airtheme_page_load_masonry_list($post_id, $paged);
	}
	
	exit;
}
add_action('wp_ajax_airtheme_interface_page_ajax_masonry_list', 'airtheme_interface_page_ajax_masonry_list');
add_action('wp_ajax_nopriv_airtheme_interface_page_ajax_masonry_list', 'airtheme_interface_page_ajax_masonry_list');

//Funtion interface ajax page filter
function airtheme_interface_page_ajax_filter(){
	$module_post = intval($_POST['post_id']);
	$post__not_in = $_POST['post__not_in'];
	$cat_id = intval($_POST['cat_id']);
	$currentLang = $_POST['currentLang'];
	
	if(!$post__not_in){
		$post__not_in = array();
	}
	
	if($module_post){
		$page_template = airtheme_get_post_meta($module_post, 'theme_meta_page_template');
		$category = airtheme_get_post_meta($module_post, 'theme_meta_page_category');
		$orderby = airtheme_get_post_meta($module_post, 'theme_meta_page_orderby');
		$order = airtheme_get_post_meta($module_post, 'theme_meta_order');
		$per_page = airtheme_get_post_meta($module_post, 'theme_meta_page_number');
		$defaultLang = apply_filters('wpml_default_language', false );
		
		$per_page = $per_page ? $per_page : -1;
		if($cat_id){
			$category = array($cat_id);
		}
		
		if($defaultLang){
			if(count($post__not_in)){
				foreach($post__not_in as $thisID){
					if($currentLang != ''){
						if($post = get_post(apply_filters('wpml_object_id', $thisID, 'post', true, $defaultLang))){
							$post__not_in[] = $post->ID;
						}
					}
				}
			}
		}
		$get_posts = get_posts(array(
			'posts_per_page' => $per_page,
			//'paged' => $paged,
			'orderby' => $orderby,
			'order' => $order,
			'category__in' => $category,
			'post__not_in' => $post__not_in,
			'tax_query' => array(
				array(
					'taxonomy' => 'post_format',
					'field' => 'slug',
					'terms' => array('post-format-gallery', 'post-format-link'),
				)
			)
		));
		
		if($page_template == 'blog-masonry'){
			$paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
			$get_posts = get_posts(array(
				'posts_per_page' => $per_page,
				'paged' => $paged,
				'orderby' => $orderby,
				'order' => $order,
				'category__in' => $category
			));
		}
		
		if($get_posts){
			global $post;
			
			foreach($get_posts as $num => $post){ setup_postdata($post);
				if($currentLang != ''){
					$post = get_post(apply_filters( 'wpml_object_id', $post->ID, $post->post_type, true, $currentLang ));							 
				}
				if($page_template == 'blog-masonry'){
					airtheme_page_load_blog_masonry_item($module_post, $post, $category);
				}else{
					airtheme_page_load_masonry_list_item($module_post, $post, $category);
				}
			}
			wp_reset_postdata();
		}
	}
	
	/*if($post_id){
		$cat_id = intval($_POST['cat_id']);
		$paged = 1;
		airtheme_page_load_masonry_list($post_id, $paged, $cat_id, true);
	}*/
}
add_action('wp_ajax_airtheme_interface_page_ajax_filter', 'airtheme_interface_page_ajax_filter');
add_action('wp_ajax_nopriv_airtheme_interface_page_ajax_filter', 'airtheme_interface_page_ajax_filter');

?>