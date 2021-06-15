<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

if ( ! class_exists( 'ReduxFramework' ) ) {
	return;
}

if ( ! class_exists('ReduxFramework_social') ) {

    class ReduxFramework_social extends ReduxFramework {

        // Field constructor
        function __construct( $field = array(), $value ='', $parent ) {
            $this->parent = $parent;
            $this->field = $field;
            $this->value = $value;

            $this->enqueue();
        }

        // Field render function
        public function render() {
            echo '<div class="redux-accordion">';
            $x = 0;
			
            if (isset($this->value) && is_array($this->value)) {
                $socials = $this->value;

                foreach ($socials as $social) {					
                    if ( empty( $social ) ) {
                        continue;
                    }
					
                    $defaults = array(
                        'title' => '',
                        'force_row' => 0,
                        'sort' => '',
                        'url' => '',
                        'select' => array(),
                    );
                    
					$social = wp_parse_args( $social, $defaults );
					
					if ( $social['title'] != '' ) {
						echo '<div class="redux-accordion-group">
								<fieldset class="redux-field" data-id="' . esc_attr( $this->field['id'] ) . '">
									<h3>
										<span class="redux-header">' . esc_html( $social['title'] ) . '</span>
									</h3>
									<div>
										<ul id="' . esc_attr( $this->field['id'] ) . '-ul" class="redux-list">
											<li>
												<label>' . esc_html__( 'Label', 'sena' ) . '</label>
												<input 
													type="text" 
													id="' . esc_attr( $this->field['id'] . '-title_' . $x ) . '" 
													name="' . esc_attr( $this->field['name'] . '[' . $x ) . '][title]" 
													value="' . esc_attr( $social['title'] ) . '" 
													placeholder="' . esc_attr__('Label', 'sena') . '" 
													class="full-text social-title" 
													style="margin-bottom:5px !important;" 
												/>
											</li>
											<li>
												<label>' . esc_html__( 'Link', 'sena' ) . '</label>
												<input 
													type="text" 
													id="' . esc_attr( $this->field['id'] . '-url_' . $x ) . '" 
													name="' . esc_attr( $this->field['name'] . '[' . $x ) . '][url]" 
													value="' . esc_attr( $social['url'] ) . '" 
													placeholder="' . esc_attr__('Link', 'sena') . '"
													class="full-text social-link" 
													style="margin-bottom:5px !important;" 
												/>
											</li>
											<li>
												<input type="hidden" class="social-sort" name="' . $this->field['name'] . '[' . $x . '][sort]" id="' . esc_attr( $this->field['id'] . '-sort_' . $x ) . '" value="' . esc_attr( $social['sort'] ) . '" />
											</li>';
                    
						if ( isset( $this->field['options'] ) && !empty( $this->field['options'] ) ) {
							$placeholder = (isset($this->field['placeholder']['options'])) ? $this->field['placeholder']['options'] : esc_html__( 'Select an Icon', 'sena' );

							if ( isset( $this->field['select2'] ) ) { 
								// if there are any let's pass them to js
								$select2_params = json_encode( esc_attr( $this->field['select2'] ) );
								$select2_params = htmlspecialchars( $select2_params , ENT_QUOTES);
								echo '<input type="hidden" class="select2_params" value="'. esc_attr( $select2_params ) .'">';
							}

							echo '<li>
								  <label>' . esc_html__( 'Icon', 'sena' ) . '</label>
								  <select 
									id="' . esc_attr( $this->field['id'] ) . '-select" 
									data-placeholder="' . esc_attr( $placeholder ) . '" 
									name="' . esc_attr( $this->field['name'] . '[' . $x ) . '][select]" 
									class="font-awesome-icons redux-select-item ' . esc_attr( $this->field['class'] ) . '" 
									rows="6"
									data-width=resolve data-allow-clear=true data-theme=default
								  >
									<option></option>';

								foreach($this->field['options'] as $k => $v) {
									if (is_array($this->value)) {
										$selected = $social['select'] == $k ?' selected="selected"':'';
									} else {
										$selected = selected($this->value['select'], $k, false);
									}

									echo '<option value="' . esc_attr( $k ) . '"'. esc_attr( $selected ) . '>' . esc_html( $v ) . '</option>';
								}
							echo '</select></li>';
						}

						echo '					<li>
													<a href="javascript:void(0);" class="button deletion redux-remove">' . esc_html__('Delete Link', 'sena') . '</a>
												</li>
											</ul>
										</div>
									</fieldset>
								</div>';

						$x++;
					}
                }
            }

            if ($x == 0) {
                echo '<div class="redux-accordion-group hidden">
						<fieldset class="redux-field" data-id="' . esc_attr( $this->field['id'] ) . '">
							<h3>
								<span class="redux-header">' . esc_html__('New Social', 'sena') . '</span>
							</h3>
						  	<div>
								<ul id="' . esc_attr( $this->field['id'] ) . '-ul" class="redux-list">';
                
				$placeholder = ( isset( $this->field['placeholder']['title'] ) ) ? $this->field['placeholder']['title'] : esc_html__( 'Label', 'sena' );
                
				echo '<li>
						<label>' . esc_html__( 'Label', 'sena' ) . '</label>
						<input 
							type="text" 
							id="' . esc_attr( $this->field['id'] . '-title_' . $x ) . '" 
							name="' . esc_attr( $this->field['name'] . '[' . $x ) . '][title]" 
							value="" 
							placeholder="' . esc_attr( $placeholder ) . '" 
							class="full-text social-title"
							style="margin-bottom:5px !important;"
						/>
					  </li>';
                
				$placeholder = ( isset( $this->field['placeholder']['url'] ) ) ? $this->field['placeholder']['url'] : esc_html__( 'Link', 'sena' );
                
				echo '<li>
						<label>' . esc_html__( 'Link', 'sena' ) . '</label>
						<input 
							type="text" 
							id="' . esc_attr( $this->field['id'] . '-url_' . $x ) . '" 
							name="' . esc_attr( $this->field['name'] . '[' . $x ) . '][url]" 
							value="" 
							placeholder="' . esc_attr( $placeholder ) . '"
							class="full-text social-link" 
							style="margin-bottom:5px !important;" 
						/>
					  </li>
               		  <li>
						<input type="hidden" class="social-sort" name="' . esc_attr( $this->field['name'] . '[' . $x ) . '][sort]" id="' . esc_attr( $this->field['id'] . '-sort_' . $x ) . '" value="' . esc_attr( $x ) . '" />
					  </li>';
                    
				if ( isset( $this->field['options'] ) && !empty( $this->field['options'] ) ) {
					$placeholder = ( isset( $this->field['placeholder']['select'] ) ) ? $this->field['placeholder']['select'] : esc_html__( 'Select an Icon', 'sena' );

					if ( isset( $this->field['select2'] ) ) { 
						// If there are any let's pass them to js
						$select2_params = json_encode( esc_attr( $this->field['select2'] ) );
						$select2_params = htmlspecialchars( $select2_params , ENT_QUOTES);
						echo '<input type="hidden" class="select2_params" value="'. esc_attr( $select2_params ) .'">';
					}

					echo '<li>
						  <label>' . esc_html__( 'Icon', 'sena' ) . '</label>
						  <select id="' . esc_attr( $this->field['id'] ) . '-select" data-placeholder="' . esc_attr( $placeholder ) . '" name="' . esc_attr( $this->field['name'] . '[' . $x ) . '][select]" class="font-awesome-icons redux-select-item ' . esc_attr( $this->field['class'] ) . '" rows="6" style="width:93%;">
							<option></option>';
						
						foreach ($this->field['options'] as $k => $v) {
							if (is_array($this->value)) {
								$selected = (is_array($this->value) && in_array($k, $this->value))?' selected="selected"':'';
							} else {
								$selected = selected($this->value, $k, false);
							}
							
							echo '<option value="'. esc_attr( $k ) . '"' . esc_attr( $selected ) . '>' . esc_html( $v ) . '</option>';
						}
					echo '</select></li>';
               	}

                echo '					<li>
											<a href="javascript:void(0);" class="button deletion redux-remove">' . esc_html__('Delete Link', 'sena') . '</a>
										</li>
                					</ul>
								</div>
							</fieldset>
						</div>';
            }
			
            echo '</div>
				  <a href="javascript:void(0);" class="button redux-add button-primary" rel-id="' . esc_attr( $this->field['id'] ) . '-ul" rel-name="' . esc_attr( $this->field['name'] ) . '[title][]">' . esc_html__('Add Link', 'sena') . '</a>
				  <br/>';
		}

        // Enqueue function
        public function enqueue() {
            wp_enqueue_script(
                'redux-field-js',
                get_template_directory_uri() . '/admin/social/social.js',
                array('jquery', 'jquery-ui-core', 'jquery-ui-accordion', 'wp-color-picker', 'select2-js'),
                time(),
                true
            );
			
            wp_enqueue_style(
                'redux-field-css',
                get_template_directory_uri() . '/admin/social/social.css',
                time(),
                true
            );
        }
		
    }
}
