<?php

/**
 * @var $instance
 * @var $before_widget
 * @var $after_widget
 * @var $title
 */

if ( ! empty( $instance ) ) :
	if ( ! is_user_logged_in() ) :
		$return_html = '';
		echo do_shortcode( $before_widget );
		echo do_shortcode( $title );

		$return_html .= '<form action="' . esc_url( home_url( '/' ) ) . '/wp-login.php" method="post" name="loginform" id="loginform"  class="form-login">
			<div class="clearfix">
				<input name="log" id="user_login2" class="form-control" value="" size="20" tabindex="10" type="text" placeholder="' . esc_html__( 'username', 'vispa' ) . '">
                <input name="pwd" id="user_pass2" class="form-control" value="" size="20" tabindex="20" type="password" placeholder="' . esc_html__( 'password', 'vispa' ) . '">
            </div>
            <div class="clearfix">';

		if ( $instance['show_remember'] ) {
			$return_html .= '
                <div class="checkbox">
	                <input name="rememberme" type="checkbox" id="rememberme" value="forever" tabindex="90" checked="checked" />
					<label for="rememberme">' . esc_html__( 'Remember Me', 'vispa' ) . '</label>
                </div>';
		}

		$return_html .= '<input type="submit" name="wp-submit" id="wp-submit" class="submit" value="' . esc_html__( 'LOGIN TO ADMIN PANEL', 'vispa' ) . '" tabindex="100" />
						<input type="hidden" name="redirect_to" value="' . esc_url( home_url( '/' ) ) . '/wp-admin/" />
						<input type="hidden" name="testcookie" value="1" />
		            </div>';

		if ( $instance['show_forgot'] ) {
			$return_html .= '<div class="clearfix">
				                <a href="' . esc_url( home_url( '/' ) ) . '/wp-login.php?action=lostpassword" class="forgot">' . esc_html__( 'Forgot Password?', 'vispa' ) . '</a>
			                </div>';
		}
		$return_html .= '</form>';

		echo do_shortcode( $return_html );
		echo do_shortcode( $after_widget );
	endif;
endif; ?>