<?php
if(is_home()){ 
	global $paged;
	query_posts(array(
		'paged' => $paged,
		'tax_query' => array(
			array(
				'taxonomy' => 'post_format',
				'field' => 'slug',
				'terms' => array('post-format-gallery'),
				'operator' => 'NOT IN' 
			)
		))
	);	
}

if(have_posts()){ ?>
	
	<div class="archive-list">
        
		<?php while(have_posts()){ the_post(); 
        
            //** Post format
            $get_post_format = (!get_post_format()) || get_post_format() == 'aside' || get_post_format() == 'status' || get_post_format() == 'chat' ? 'standard' : get_post_format();
            
            airtheme_get_template_part('archive/loop-item', $get_post_format);
            
            //** Template Archive loop item
            
            
        }
        
        //** Do Hook Archive Pagination
        /**
         * @hooked  airtheme_interface_pagination - 10
         */
        do_action('airtheme_interface_archive_pagination', '', 3, 'pagenums'); ?>

    </div>
    
<?php }else{ ?>

    <div class="archive-nopost container"><?php esc_html_e('Sorry, no articles','air-theme');?> </div> 
    
<?php } ?>

