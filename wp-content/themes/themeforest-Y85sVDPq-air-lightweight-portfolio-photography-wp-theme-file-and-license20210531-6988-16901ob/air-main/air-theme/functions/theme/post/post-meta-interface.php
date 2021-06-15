<?php
//theme meta interface
function airtheme_theme_post_meta_interface( $post ) {
	$airtheme_theme_post_meta_fields = airtheme_theme_post_meta_fields();
		
	if ( ! empty( $airtheme_theme_post_meta_fields[ get_post_type() ] ) ) {
		$airtheme_theme_post_meta_posttype = $airtheme_theme_post_meta_fields[ get_post_type() ];
		foreach ( $airtheme_theme_post_meta_posttype as $option ) {
			$format = isset( $option['format'] ) ? 'data-format="' .esc_attr( $option['format'] ). '"' : false;
			$option_id = isset( $option['id'] ) ? 'id="option_' .esc_attr( $option['id'] ). '"' : false; ?>
            <div <?php echo sanitize_text_field( $option_id ); ?> class="postbox ux-theme-box ux-theme-meta-box" <?php echo sanitize_text_field( $format ); ?>>
                <h3 class="hndle"><span><?php echo esc_html( $option['title'] ); ?></span></h3>
                <div class="inside">
                    <?php if ( isset( $option['action'] ) ) {
						do_action( 'ux-theme-post-meta-interface', esc_attr( $option['id'] ) );
					}else{
						if ( isset( $option['section'] ) ) {
							airtheme_theme_post_meta_section( $option );
						}
					} ?>
                </div>
            </div>
        <?php } ?>
        <div class="ux-theme-box"><?php airtheme_theme_option_modal(); ?></div>
        <input type="hidden" name="custom_meta_box_nonce" value="<?php echo esc_attr(wp_create_nonce(ABSPATH)); ?>" />
	<?php
    }
}
add_action('edit_form_after_editor', 'airtheme_theme_post_meta_interface');

//Shape for Masonry Grid List Interface
function airtheme_theme_post_meta_gallery_side_interface($post){
	$get_post_meta = get_post_meta($post->ID, 'ux_theme_meta', true);
	$gallery_shape = 'gallery_shape_1';
	
	if($get_post_meta){
		if(isset($get_post_meta['theme_meta_gallery_shape'])){
			$gallery_shape = $get_post_meta['theme_meta_gallery_shape'];
		}
	} ?>
    <div class="airtheme_theme_gallery_shape">
        <?php
		for($num=1; $num<=4; $num++){
			$this_class = 'gallery_shape_' .$num;
			$active = false;
			if($gallery_shape == $this_class){
				$active = 'active';
			}
			echo '<div class="gallery_shape ' .$active. '"><div class="' .esc_attr($this_class). '"></div></div>';
		} ?>
        <input type="hidden" name="ux_theme_meta[theme_meta_gallery_shape]" value="<?php echo sanitize_text_field($gallery_shape); ?>" />
    </div>
<?php
}

//theme meta interface
function airtheme_theme_post_meta_interface_wp5( $post_type, $post ) {
	$postMetaFields = airtheme_theme_post_meta_fields();
	
	if ( function_exists( 'use_block_editor_for_post' ) ) {
		if ( use_block_editor_for_post( $post ) ) {
			if ( ! empty( $postMetaFields[ $post_type ] ) ) {
				$postMetaPosttype = $postMetaFields[ $post_type ];
				
				foreach ( $postMetaPosttype as $num => $option ) {
					$option = wp_parse_args( $option, array(
						'title' => false,
						'id' => false
					) );
					
					add_meta_box( $option['id'], $option['title'], 'airtheme_theme_meta_box_callback',
						$post_type, 'normal', 'high',
						array(
							'__block_editor_compatible_meta_box' => true,
							'__back_compat_meta_box' => false,
							'option' => $option
						)
					);
					
				}
			}
		}
	}
}
//add_action( 'add_meta_boxes', 'airtheme_theme_post_meta_interface_wp5', 10, 2 );

function airtheme_theme_meta_box_callback( $post, $metabox ) {
	$option = $metabox['args']['option'];
	$format = isset( $option['format'] ) ? 'data-format="' .esc_attr( $option['format'] ). '"' : false; ?>
	<div class="ux-theme-box ux-theme-meta-box" <?php echo sanitize_text_field( ( $format ) ); ?>>
		<?php if ( isset( $option['action'] ) ) {
            do_action( 'ux-theme-post-meta-interface', esc_attr( $option['id'] ) );
        } else {
            if ( isset( $option['section'] ) ) {
                airtheme_theme_post_meta_section( $option );
            }
        } ?>
    </div>
<?php
}

//theme meta section
function airtheme_theme_post_meta_section( $option ) {
	foreach ( $option['section'] as $section ) {
		$subclass = isset( $section['subclass'] ) ? 'theme-option-item-body' : false;
		$title = isset( $section['title'] ) ? $section['title'] : false;
		$super_control = isset( $section['super-control'] ) ? 'data-super="' .esc_attr( $section['super-control']['name'] ) . '" data-supervalue="' .esc_attr( $section['super-control']['value'] ). '"' : false; ?>
		
		<div class="theme-option-item" <?php echo sanitize_text_field( $super_control ); ?>>
			<?php if ( $title ) { ?>
                <h4 class="theme-option-item-heading"><span><?php echo esc_html( $title ); ?></span></h4>
            <?php } ?>
			<div class="<?php echo esc_attr( $subclass ); ?>">
				<?php if ( isset( $section['item'] ) ) {
					foreach ( $section['item'] as $item ) {
						$control = isset( $item['control'] ) ? 'data-name="' .esc_attr( $item['control']['name'] ). '" data-value="' .esc_attr( $item['control']['value'] ). '"' : false; 
						$item_format = isset( $item['format'] ) ? 'data-format="' .esc_attr( $item['format'] ). '"' : false;
						if ( $item['type'] == 'divider' || $item['type'] == 'description' ) { ?>
							<div <?php echo sanitize_text_field( $control ); ?> <?php echo sanitize_text_field( $item_format ); ?>> 
								<?php airtheme_theme_option_getfield( $item, 'ux_theme_meta' ); ?>
							</div>
						<?php } else { ?>
							<div class="row <?php echo esc_attr( $item['name'] ); ?>" <?php echo sanitize_text_field( $control ); ?> <?php echo sanitize_text_field( $item_format ); ?>>
								<div class="col-xs-3">
									<?php if ( isset( $item['title'] ) ) { ?>
										<h5><?php echo esc_html( $item['title'] ); ?></h5>
									<?php } ?>
								</div>
								<div class="col-xs-9">
									<?php if ( isset( $item['bind'] ) ) {
										foreach ( $item['bind'] as $bind ) {
											if ( $bind['position'] == 'before' ) {
												airtheme_theme_option_getfield( $bind, 'ux_theme_meta' );
											}
										}
									}
									
									airtheme_theme_option_getfield( $item, 'ux_theme_meta' );
									
									if ( isset( $item['bind'] ) ) {
										foreach ( $item['bind'] as $bind ) {
											if ( $bind['position'] == 'after' ) {
												airtheme_theme_option_getfield( $bind, 'ux_theme_meta' );
											}
										}
									} ?>
									<?php if ( isset( $item['description'] ) ) { ?>
										<p class="text-muted"><?php echo esc_html( $item['description'] ); ?></p>
									<?php } ?>
								</div>
							</div>
						<?php
						}
					}
				} ?>
			</div>
		</div>
	<?php 
	}
}

function airtheme_theme_meta_box_hidden_fields( $post ) {
	if ( function_exists( 'use_block_editor_for_post' ) ) {
		if ( use_block_editor_for_post( $post ) ) { ?>
            <input type="hidden" name="custom_meta_box_nonce" value="<?php echo esc_attr( wp_create_nonce( ABSPATH ) ); ?>" />
        <?php
		}
	}
}
add_action( 'block_editor_meta_box_hidden_fields', 'airtheme_theme_meta_box_hidden_fields' );
?>