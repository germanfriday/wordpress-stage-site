<?php
class Sena_Section_Type {
	
	// Initialization
	public static function sena_initialize( ) {
		global $post;

		if ( class_exists( 'Sena_Admin' ) ) {
            Sena_Admin::sena_add_metabox('sena_section_type');
        }
	}

	// Metabox
	public static function sena_content( $post ) {
		// Styles
		wp_enqueue_style( 'sena-meta-sections', get_template_directory_uri( ) . '/admin/metaboxes/styles.css' );
		
		wp_nonce_field( 'athenastudio_nonce_safe', 'athenastudio_nonce' );
		$meta = get_post_meta( $post->ID );

		$section_type = 'none';
		if ( isset( $meta['section_type'] ) and isset( $meta['section_type'][0] ) ) {
			$section_type = $meta['section_type'][0];
		}
		
		$color_schema = 'default';
		if ( isset( $meta['color_schema'] ) and isset( $meta['color_schema'][0] ) ) {
			$color_schema = $meta['color_schema'][0];
		}

		$output = '
			<div class="meta-pt-15">
				<select id="section_type" name="section_type"  class="meta-item-full">
					<option value="none" '      . ( $section_type == 'none'         ? 'selected="selected"' : '') . '>' . esc_html__( 'None', 'sena' ) . '</option>
					<option value="slideshow"'  . ( $section_type == 'slideshow'    ? 'selected="selected"' : '') . '>' . esc_html__( 'Image Slideshow', 'sena' ) . '</option>
					<option value="image"'      . ( $section_type == 'image'        ? 'selected="selected"' : '') . '>' . esc_html__( 'Single Image', 'sena' ) . '</option>
					<option value="video"'      . ( $section_type == 'video'        ? 'selected="selected"' : '') . '>' . esc_html__( 'Video Background', 'sena' ) . '</option>
				</select>
				<p>' . esc_html__( 'You should set <strong>Template</strong> as <em>Front Page</em> for this option.', 'sena' ) . '</p>
			</div>
			
			<p><strong>' . esc_html( 'Color Schema', 'sena' ) . '</strong></p>
			<div>
				<select id="color_schema" name="color_schema"  class="meta-item-full">
					<option value="default" ' 	. ( $color_schema == 'default'      ? 'selected="selected"' : '') . '>' . esc_html__( 'Default', 'sena' ) . '</option>
					<option value="green"'      . ( $color_schema == 'green'        ? 'selected="selected"' : '') . '>' . esc_html__( 'Green', 'sena' ) . '</option>
					<option value="orange"'     . ( $color_schema == 'orange'       ? 'selected="selected"' : '') . '>' . esc_html__( 'Orange', 'sena' ) . '</option>
					<option value="red"'      	. ( $color_schema == 'red'        	? 'selected="selected"' : '') . '>' . esc_html__( 'Red', 'sena' ) . '</option>
					<option value="blue"'  		. ( $color_schema == 'blue'    		? 'selected="selected"' : '') . '>' . esc_html__( 'Blue', 'sena' ) . '</option>
					<option value="turquoise"'  . ( $color_schema == 'turquoise'    ? 'selected="selected"' : '') . '>' . esc_html__( 'Turquoise', 'sena' ) . '</option>
					<option value="purple"'     . ( $color_schema == 'purple'       ? 'selected="selected"' : '') . '>' . esc_html__( 'Purple', 'sena' ) . '</option>
					<option value="yellow"'     . ( $color_schema == 'yellow'       ? 'selected="selected"' : '') . '>' . esc_html__( 'Yellow', 'sena' ) . '</option>
					<option value="grey"'      	. ( $color_schema == 'grey'        	? 'selected="selected"' : '') . '>' . esc_html__( 'Grey', 'sena' ) . '</option>
				</select>
			</div>
		';

		echo wp_specialchars_decode( $output );
	}

	// Save
	public static function sena_save( $post_id ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
		if ( ! isset( $_POST['athenastudio_nonce'] ) || ! wp_verify_nonce( $_POST['athenastudio_nonce'], 'athenastudio_nonce_safe' ) ) return;
		if ( ! current_user_can( 'edit_posts' ) ) return;

		if ( isset( $_POST['section_type'] ) ) {
			update_post_meta( $post_id, 'section_type', sanitize_text_field( $_POST['section_type'] ) );
		}
		
		if ( isset( $_POST['color_schema'] ) ) {
			update_post_meta( $post_id, 'color_schema', sanitize_text_field( $_POST['color_schema'] ) );
		}
	}
	
}

if ( class_exists( 'Sena_Admin' ) ) {
	Sena_Admin::sena_add_action('sena_section_type');
}

add_action( 'save_post', array( 'Sena_Section_Type', 'sena_save' ) );
