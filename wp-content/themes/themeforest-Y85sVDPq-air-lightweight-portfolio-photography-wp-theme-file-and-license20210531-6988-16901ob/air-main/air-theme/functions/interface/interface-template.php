<?php
/****************************************************************/
/*
/* Template archive
/*
/****************************************************************/

//Template Archive loop
function airtheme_interface_archive_loop(){
	airtheme_get_template_part('archive/loop', false);
}

//Template Archive Title
function airtheme_interface_archive_titlewrap(){
	airtheme_get_template_part('archive/content', 'title');
}

/****************************************************************/
/*
/* Template page
/*
/****************************************************************/

//Template Page content before
function airtheme_interface_page_content_before(){
	airtheme_get_template_part('page/content', 'before');
}

//Template Page content after
function airtheme_interface_page_content_after(){
	airtheme_get_template_part('page/content', 'after');
}

//Template page content
function airtheme_interface_page_content(){
	$page_template = airtheme_get_post_meta(get_the_ID(), 'theme_meta_page_template');
	airtheme_get_template_part('page/content', 'blog');
	
	if($page_template != 'blog-masonry'){
		if(!airtheme_enable_pb()){
			airtheme_get_template_part('page/content', false);
		}
	}
}

//Template page slider
function airtheme_interface_content_page_slider(){
	if(is_page()){
		airtheme_get_template_part('page/content', 'slider');
	}
}

//Template Page content
function airtheme_interface_page_comment(){
	echo '<div class="container">';
	comments_template();
	echo '</div>';
}

//Template Page Feature Image
function airtheme_interface_page_feature_image(){
	airtheme_get_template_part('page/content', 'feature-image');
}

//Template Page Title
function airtheme_interface_page_title(){
	airtheme_get_template_part('page/content', 'title');
}

/****************************************************************/
/*
/* Template single
/*
/****************************************************************/

//Template single content before
function airtheme_interface_single_content_before(){
	airtheme_get_template_part('single/content', 'before');
}

//Template single content after
function airtheme_interface_single_content_after(){
	airtheme_get_template_part('single/content', 'after');
}

//Template single Content Inn
function airtheme_interface_single_content_video_cover(){
	airtheme_get_template_part('single/content', 'videocover');
}

//Template Single content
function airtheme_interface_single_content(){

	//** post format
	if ( is_singular('post') && !airtheme_enable_pb() ) {
		$post_format = !get_post_format() || get_post_format() == 'aside' || get_post_format() == 'status' || get_post_format() == 'chat' ? 'standard' : get_post_format();
		airtheme_get_template_part('single/format', $post_format);
	//** post type for clients, faqs, jobs, testimonials team
	} elseif ( is_singular( array( 'clients_item', 'faqs_item', 'jobs_item', 'team_item', 'testimonials_item' ) ) ){
		airtheme_get_template_part('single/type', get_post_type()); 
	} else {
		the_content();
	}
}

//Template Single content
function airtheme_interface_single_comment(){
	comments_template();
}

//Template Single tag
function airtheme_interface_single_tag(){
	if(is_singular('post')){
		airtheme_get_template_part('single/content', 'tag');
	}
}

//Template Single Navi
function airtheme_interface_single_navi(){
	if(is_singular('post')){
		airtheme_get_template_part('single/content', 'navi');
	}
}

//Template Content before inn feature image
function airtheme_interface_singele_inn_feature_image(){
	airtheme_get_template_part('single/content', 'inn-feature-image');
}

//Template Single Feature Image
function airtheme_interface_single_feature_image(){
	airtheme_get_template_part('single/content', 'feature-image');
}

/****************************************************************/
/*
/* Template global
/*
/****************************************************************/

//Template jplayer
function airtheme_interface_jplayer(){
	airtheme_get_template_part('global/site', 'jplayer');
}

//Template Page Loading
function airtheme_interface_page_loading(){
	airtheme_get_template_part('global/page', 'loading');
}

//Template Wrap Outer before
function airtheme_interface_wrap_outer_before(){
	airtheme_get_template_part('global/wrapouter', 'before');
}

//Template Wrap Outer after
function airtheme_interface_wrap_outer_after(){
	airtheme_get_template_part('global/wrapouter', 'after');
}

//Template Content before
function airtheme_interface_content_before(){
	airtheme_get_template_part('global/content', 'before');
}

//Template Content after
function airtheme_interface_content_after(){
	airtheme_get_template_part('global/content', 'after');
}

//Template Content titlewrap
function airtheme_interface_content_titlewrap(){
	airtheme_get_template_part('global/content', 'titlewrap');
}

//Template Sidebar Weiget
function airtheme_interface_sidebar_widget(){
	airtheme_get_template_part('global/sidebar', 'widget');
}

//Template Header
function airtheme_interface_header(){
	airtheme_get_template_part('global/header', false);
}

//Template social bar
function airtheme_interface_social_bar_and_navi($module_post = false){
	if(!has_post_format('gallery')){
		$show_share = true;
		$show_navi = true;
		$share_buttons = array('facebook', 'twitter', 'google-plus', 'pinterest', 'digg', 'reddit', 'linkedin', 'stumbleupon', 'tumblr', 'mail');
		
		$enable_share_buttons = airtheme_get_option('theme_option_enable_share_buttons_for_posts');
		$share_buttons = airtheme_get_option('theme_option_share_buttons');
		if(!$enable_share_buttons){
			$show_share = false;
		}
		
		$enable_share_button_other = airtheme_get_option('theme_option_show_share_button_other');
		if(!$enable_share_button_other){
			$show_share = false;
		}
		
		if($show_navi || $show_share) {
		
		?>
		
		<div class="blog-unit-meta-bottom">
		
		<?php
	
		}
	
		if($show_share){  ?>
			
			<div class="social-bar center-ux">
				<ul class="post_social post-meta-social">
					<?php if(is_array($share_buttons)){
		
						$post_link = get_permalink();
						$post_link_pure = preg_replace('#^https?://#', '', rtrim($post_link,'/'));
						//$share_buttons_text = airtheme_get_option('theme_option_descriptions_share') ? airtheme_get_option('theme_option_descriptions_share') : esc_attr__( 'Share','air-theme' );;
						?>
	
					<?php
						//facebook
						if(in_array('facebook', $share_buttons)){ ?>
					
							<li class="post-meta-social-li">
								<a class="share postshareicon-facebook-wrap" href="https://www.facebook.com/sharer.php?u=<?php echo esc_url($post_link); ?>" onclick="window.open('https://www.facebook.com/sharer.php?u=<?php echo esc_url($post_link); ?>','Facebook','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;">
								<span class="fa fa-facebook postshareicon-facebook"></span>
								</a>
							</li>
						
						<?php }
						
						//twitter
						if(in_array('twitter', $share_buttons)){ ?>
						
							<li class="post-meta-social-li">
								<a class="share postshareicon-twitter-wrap" href="https://twitter.com/share?url=<?php echo esc_url($post_link); ?>&amp;text=<?php the_title(); ?>" onclick="window.open('https://twitter.com/share?url=<?php echo esc_url($post_link); ?>&amp;text=<?php the_title(); ?>','Twitter share','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" >
								<span class="fa fa-twitter postshareicon-twitter"></span>
								</a>
							</li>
						
						<?php }
						
						//google-plus
						if(in_array('google-plus', $share_buttons)){ ?>
				
							<li class="post-meta-social-li">
								<a class="share postshareicon-googleplus-wrap" href="https://plus.google.com/share?url=<?php echo esc_url($post_link); ?>" onclick="window.open('https://plus.google.com/share?url=<?php echo esc_url($post_link); ?>','', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
								<span class="fa fa-google-plus postshareicon-googleplus"></span>
								</a>
							</li>
						
						<?php }
						
						//pinterest
						if(in_array('pinterest', $share_buttons)){
							$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); 
							$thumbnail = $image ? $image[0] : false; ?>
							
							<li class="post-meta-social-li">
								<a class="share postshareicon-pinterest-wrap" href="javascript:;" onclick="javascript:window.open('https://pinterest.com/pin/create/bookmarklet/?url=<?php echo esc_url($post_link); ?>&amp;is_video=false&amp;media=<?php echo esc_url($thumbnail); ?>','', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
								<span class="fa fa-pinterest  postshareicon-pinterest"></span>
								</a>
							</li>
					
						<?php }
	
						//Digg
						if(in_array('digg', $share_buttons)){ ?>
				
							<li class="post-meta-social-li">
								<a class="share postshareicon-digg-wrap" href="https://www.digg.com/submit?url=<?php echo esc_url($post_link); ?>" onclick="window.open('https://www.digg.com/submit?url=<?php echo esc_url($post_link); ?>','Digg','width=715,height=330,left='+(screen.availWidth/2-357)+',top='+(screen.availHeight/2-165)+''); return false;">
								<span class="fa fa-digg postshareicon-digg"></span>
								</a>
							</li>
						
						<?php }
	
						//Readdit
						if(in_array('reddit', $share_buttons)){ ?>
				
							<li class="post-meta-social-li">
								<a class="share postshareicon-reddit-wrap" href="https://reddit.com/submit?url=<?php echo esc_url($post_link); ?>&amp;title=<?php the_title(); ?>" onclick="window.open('https://reddit.com/submit?url=<?php echo esc_url($post_link); ?>&amp;title=<?php the_title(); ?>','Reddit','width=617,height=514,left='+(screen.availWidth/2-308)+',top='+(screen.availHeight/2-257)+''); return false;">
								<span class="fa fa-reddit postshareicon-reddit"></span>
								</a>
							</li>
						
						<?php }
	
						//linkedin
						if(in_array('linkedin', $share_buttons)){ ?>
				
							<li class="post-meta-social-li">
								<a class="share postshareicon-linkedin-wrap" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_url($post_link); ?>" onclick="window.open('https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_url($post_link); ?>','Linkedin','width=863,height=500,left='+(screen.availWidth/2-431)+',top='+(screen.availHeight/2-250)+''); return false;">
								<span class="fa fa-linkedin postshareicon-linkedin"></span>
								</a>
							</li>
						
						<?php }
	
						//stumbleupon
						if(in_array('stumbleupon', $share_buttons)){ ?>
				
							<li class="post-meta-social-li">
								<a class="share postshareicon-stumbleupon-wrap" href="https://www.stumbleupon.com/submit?url=<?php echo esc_url($post_link); ?>&amp;title=<?php the_title(); ?>" onclick="window.open('https://www.stumbleupon.com/submit?url=<?php echo esc_url($post_link); ?>&amp;title=<?php the_title(); ?>','Stumbleupon','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;">
								<span class="fa fa-stumbleupon postshareicon-stumbleupon"></span>
								</a>
							</li>
						
						<?php }
	
						//tumblr
						if(in_array('tumblr', $share_buttons)){ ?>
				
							<li class="post-meta-social-li">
								<a class="share postshareicon-tumblr-wrap" href="https://www.tumblr.com/share/link?url=<?php echo esc_attr($post_link_pure); ?>&amp;name=<?php the_title(); ?>" onclick="window.open('https://www.tumblr.com/share/link?url=<?php  echo esc_attr($post_link_pure); ?>&amp;name=<?php the_title(); ?>','Tumblr','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;">
								<span class="fa fa-tumblr postshareicon-tumblr"></span>
								</a>
							</li>
						
						<?php }
	
						//mail
						if(in_array('mail', $share_buttons)){ ?>
				
							<li class="post-meta-social-li">
								<a class="share postshareicon-mail-wrap" href="mailto:?Subject=<?php the_title(); ?>&amp;Body=<?php echo esc_url($post_link); ?>" >
								<span class="fa fa-envelope-o postshareicon-mail"></span>
								</a>
							</li>
							
						<?php }
		
					} ?>
				</ul>
			</div>
	
	<?php
	
		} 
	
		airtheme_interface_single_navi();
	
		if($show_navi || $show_share) { ?>

            </div>
        
        <?php
		}
	}

}

//Gallery Bottom Navi and plus button (if the gallery post created by PB)
function airtheme_interface_gallery_bottom_navi(){
	if ( airtheme_enable_pb() && get_post_format() == 'gallery') {
		$airtheme_enable_navi = airtheme_get_option('theme_option_show_post_navigation');
		if($airtheme_enable_navi){
			airtheme_get_template_part('single/gallery/portfolio', 'navi');
		}
	}
}

//Template footer
function airtheme_interface_footer(){
	airtheme_get_template_part('global/footer', false);
}

//Template footer widget
function airtheme_interface_footer_widget(){
	airtheme_get_template_part('global/footer', 'widget');
}

//Template footer info
function airtheme_interface_footer_info(){
	airtheme_get_template_part('global/footer', 'info');
}

//Template footer social
function airtheme_interface_footer_social(){
	airtheme_get_template_part('global/footer', 'social');
}

//Template header social
function airtheme_interface_header_social(){
	airtheme_get_template_part('global/header', 'social');
}

//Template wrap border
function airtheme_interface_wrap_border(){
	$enable_border = airtheme_get_option('theme_option_enable_border');
	if($enable_border){
		echo '<div class="bordered-top"></div><div class="bordered-bottom"></div>';
	}
}

//Template menu hidden panel
function airtheme_interface_menu_hidden_panel(){
	airtheme_get_template_part('global/menu-hidden', 'panel');
}

//Template photoswipe
function airtheme_interface_photoswipe(){
	if ( ! class_exists( 'UX_PageBuilder' ) ) {
		airtheme_get_template_part( 'global/photoswipe', false );
	}
}

//Template search popup
function airtheme_interface_search_popup(){
	$header_layout = airtheme_get_option('theme_option_header_layout');
	$show_search_header = airtheme_get_option('theme_option_show_search_on_header');
	if($header_layout == 'navi-show' && $show_search_header) {
		airtheme_get_template_part('global/search', 'popup');
	}
}
?>