<?php
/**
 * Custom template tags for this theme
 *
 * @package WordPress
 * @subpackage Aiteko
 * @since 1.0.0
 */

if ( ! function_exists( 'aiteko_time_link' ) ) :
	/**
	 * Gets a nicely formatted string for the published date.
	 */
	function aiteko_time_link() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s"><span class="day">%2$s</span><span class="month-and-year">%3$s</span></time>';

		$time_string = sprintf(
			$time_string,
			get_the_date( DATE_W3C ),
			get_the_date( 'd' ),
			get_the_date( 'M y' )
		);

		// Wrap the time string in a link, and preface it with 'Posted on'.
		return sprintf(
			/* translators: %s: post date */
			__( '<span class="screen-reader-text">Posted on</span> %s', 'aiteko' ),
			$time_string
		);
	}
endif;

if ( ! function_exists( 'aiteko_option_time_link' ) ) :
	/**
	 * Gets a nicely formatted string for the published date.
	 */
	function aiteko_option_time_link() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		$time_string = sprintf(
			$time_string,
			get_the_date( DATE_W3C ),
			get_the_date()
		);

		// Wrap the time string in a link, and preface it with 'Posted on'.
		return sprintf(
			/* translators: %s: post date */
			__( '<span class="screen-reader-text">Posted on</span> %s', 'aiteko' ),
			$time_string
		);
	}
endif;

if ( ! function_exists( 'aiteko_get_post_author' ) ) :
	/**
	 * Gets the post author
	 */
	function aiteko_get_post_author()  {
		return '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . get_the_author() . '</a></span>';
	}
endif;

if ( ! function_exists( 'aiteko_category_lists' ) ) :
	/**
	 * get post category
	 */
	function aiteko_category_list() {
		$categories_list = get_the_category_list( esc_html__( ' ', 'aiteko' ) );
		if ( $categories_list ) {
			/* translators: 1: posted in label, only visible to screen readers. 2: list of categories. */
			printf(
				'<span class="cat-links"><span class="screen-reader-text">%1$s</span>%2$s</span>',
				esc_html__( 'Posted in', 'aiteko' ),
				$categories_list
			); // WPCS: XSS OK.
		}
	}
endif;

if ( ! function_exists( 'aiteko_get_comment_popup_link' ) ) :
	/**
	 * Get comment popup link
	 */
	function aiteko_get_comment_popup_link() {
		comments_popup_link(
			esc_html__( '0 Comments', 'aiteko' ),
			esc_html__( '1 Comment', 'aiteko' ),
			esc_html__( '% Comments', 'aiteko' ),
			'comments-link',
			esc_html__( 'Comments Off', 'aiteko' )
		);
	}
endif;

if ( ! function_exists( 'aiteko_entry_tag' ) ) :
	/**
	 * Prints post tag(s)
	 */
	function aiteko_entry_tag() {
		// Get Tags for posts.
		$tags_list = get_the_tag_list( '', ' ' );

		if ( $tags_list ) {

			if ( get_theme_mod( 'show_tag_lists', true ) !== '' || is_customize_preview() ) {
				// customizer placeholder, not really shown in actual site.
				if ( is_customize_preview() ) {
					$relhiden = ( false === get_theme_mod( 'show_tag_lists', true ) ? 'display:none;' : '' );
					print '<div id="tag_lists_customization" style="' . esc_attr( $relhiden ) . '">';
				}

				echo '<div class="tags-links"><span class="screen-reader-text">' . esc_html__( 'Post tagged with:', 'aiteko' ) . '</span>' .
				wp_kses(
					$tags_list,
					array(
						'a' => array(
							'href'  => array(),
							'title' => array(),
						),
					)
				) . '</div>';

				if ( is_customize_preview() ) {
					print '</div>';
				}
			}
		}
	}
endif;

if ( ! function_exists( 'aiteko_get_single_post_layout' ) ) :
	/**
	 * Get single post/page layout based on user settings
	 * prepare for next version
	 *
	 * @return string
	 */
	function aiteko_get_single_post_layout() {
		global $post;

		$layout = get_post_meta( get_the_ID(), 'aiteko_layout', true );
		if ( false === $layout || empty( $layout ) ) {
			$layout = 'fullwidth';
		}

		return $layout;
	}
endif;

if ( ! function_exists( 'aiteko_get_portfolio_loop_style' ) ) :
	/**
	 * get portfolio archive loop style
	 * default: timeline, secondary is grid masonry
	 *
	 * @since 1.0
	 */
	function aiteko_get_portfolio_loop_style() {
		$style = get_theme_mod( 'archive_portfolio_style', '' );

		return $style;
	}
endif;

/**
 * Get portfolio year info
 *
 * @since 1.0
 */
function get_portfolio_year_info() {
	$year_info = get_post_meta( get_the_ID(), 'aiteko_portfolio_year', true );
	if ( empty( $year_info ) || '' === $year_info ) {
		return false;
	}

	return $year_info;
}

if ( ! function_exists( 'aiteko_footer_widgets' ) ) :
	/**
	 * Print footer widgets
	 *
	 * @since 1.0
	 */
	function aiteko_footer_widgets() {
		if ( get_theme_mod( 'footer_widgets', true ) !== '' || is_customize_preview() ) {
			$relhiden = '';

			// customizer placeholder, not really shown in actual site.
			if ( is_customize_preview() ) {
				$relhiden = ( get_theme_mod( 'footer_widgets', true ) === '' ? ' style="display:none;"' : '' );
			}

			print '<div class="footer-widgets"' . esc_attr( $relhiden ) . '>';

					get_template_part( 'template-parts/footer', 'widgets' );

			print '</div>';
		}
	}
endif;

if ( ! function_exists( 'aiteko_post_author_box' ) ) :
	/**
	 * Display author box
	 *
	 * @since 1.0
	 * @return string
	 */
	function aiteko_post_author_box() {
		global $post;
		if ( ! is_object( $post ) || ! is_single() ) {
			return false;
		}

		// no author for this post? don't bother.
		if ( ! isset( $post->post_author ) ) {
			return false;
		}

		$display_name = get_the_author_meta( 'display_name', $post->post_author );
		// use nickname instead if display_name is empty.
		if ( empty( $display_name ) ) {
			$display_name = get_the_author_meta( 'nickname', $post->post_author );
		}

		// description.
		$user_description = get_the_author_meta( 'user_description', $post->post_author );

		// no author description for this post? don't bother.
		if ( '' === $user_description ) {
			return false;
		}

		// posts archive link.
		$user_posts_link = get_author_posts_url( intval( get_the_author_meta( 'ID' , $post->post_author ) ) );

		// user website URL.
		$user_website = get_the_author_meta( 'url', $post->post_author );

		// user avatar.
		$user_avatar  = get_avatar( get_the_author_meta( 'user_email', $post->post_author ) , 90, '', $display_name );
		$user_socials = aiteko_get_author_social( $post->post_author );
		$user_socials = ( false !== $user_socials ) ? $user_socials : '';

		$kses_defaults = wp_kses_allowed_html( 'post' );
		$svg_args      = array(
			'svg'   => array(
				'class'           => true,
				'aria-hidden'     => true,
				'aria-labelledby' => true,
				'role'            => true,
				'xmlns'           => true,
				'width'           => true,
				'height'          => true,
				'viewbox'         => true, // <= Must be lower case!
			),
			'g'     => array( 'fill' => true ),
			'title' => array( 'title' => true ),
			'path'  => array(
				'd'    => true,
				'fill' => true,
			),
		);
		$allowed_tags  = array_merge( $kses_defaults, $svg_args );

		$html = '<div class="author-box-bio">' . "\n";
		$html .= '<div class="author-box-meta">' . $user_avatar . '</div>' . "\n";
		$html .= '<div class="author-box-info">' . "\n";
			$html .= '<h3 class="author-post-name">' . esc_html( $display_name ) . '</h3>' . "\n";
			$html .= '<div class="author-box-description">' . "\n" . wp_kses( wpautop( $user_description ) . $user_socials, $allowed_tags ) . '</div>' . "\n";
		$html .= '</div>' . "\n";
		$html .= '</div>' . "\n";

		return $html;
	}
endif;

if ( ! function_exists( 'aiteko_get_author_social' ) ) :
	/**
	 * Get author social links.
	 *
	 * @param int $user_id User database ID.
	 */
	function aiteko_get_author_social( $user_id ) {
		$user_id = intval( $user_id );
		if ( ! $user_id || ! class_exists( 'Wip_Themes_Core' ) ) {
			return false;
		}

		$socials = array(
			'_author_facebook',
			'_author_twitter',
			'_author_instagram',
			'_author_youtube',
			'_author_vimeo',
			'_author_google-plus',
			'_author_pinterest',
			'_author_medium',
			'_author_tumblr',
		);

		$kses_defaults = wp_kses_allowed_html( 'post' );
		$svg_args      = array(
			'svg'   => array(
				'class'           => true,
				'aria-hidden'     => true,
				'aria-labelledby' => true,
				'role'            => true,
				'xmlns'           => true,
				'width'           => true,
				'height'          => true,
				'viewbox'         => true, // <= Must be lower case!
			),
			'g'     => array( 'fill' => true ),
			'title' => array( 'title' => true ),
			'path'  => array(
				'd'    => true,
				'fill' => true,
			),
		);
		$allowed_tags  = array_merge( $kses_defaults, $svg_args );

		$html_link = '';
		foreach ( $socials as $social_id ) {
			$link = get_the_author_meta( esc_html( $social_id ), $user_id );
			if ( '' !== $link ) {
				$html_link .= '<a class="' . esc_attr( $social_id ) . '" href="' . esc_url( $link ) . '" rel="nofollow">' . wp_kses( aiteko_get_social_icon_svg( str_replace( '_author_', '', $social_id ), 18 ), $allowed_tags ) . '</a>';
			}
		}
		unset( $social_id );

		if ( '' !== $html_link ) {
			return '<div class="author-social-links">' . $html_link . '</div>' . "\n";
		}

		return false;
	}
endif;

if ( ! function_exists( 'aiteko_get_social_sharing_buttons' ) ) :
	/**
	 * Get social sharing buttons.
	 */
	function aiteko_get_social_sharing_buttons() {
		global $post;
		if ( ! is_single() || ! class_exists( 'Wip_Themes_Core' ) ) {
			return false;
		}

		$post_url = rawurlencode( get_permalink() );
		$post_title = str_replace( ' ', '%20', get_the_title() );
		$post_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
		$share_img = '';
		if ( isset( $post_image[0] ) ) {
			$share_img = $post_image[0];
		}
		// twitter via account.
		$via = ( '' !== get_theme_mod( 'official_twitter_acc', '' ) ) ? '&amp;via=' . get_theme_mod( 'official_twitter_acc' ) : '';

		// add it to array, make it simple to loop over the data.
		$social_btns = array(
			'twitter' => array(
				'url' => '//twitter.com/intent/tweet?text=' . $post_title . '&amp;url=' . $post_url . $via . '',
				'icon' => 'twitter',
			),
			'facebook' => array(
				'url' => '//www.facebook.com/sharer/sharer.php?u=' . $post_url,
				'icon' => 'facebook',
			),
			'google' => array(
				'url' => '//plus.google.com/share?url=' . $post_url,
				'icon' => 'google-plus',
			),
			'pinterest' => array(
				'url' => '//pinterest.com/pin/create/button/?url=' . $post_url . '&amp;media=' . $share_img . '&amp;description=' . $post_title,
				'icon' => 'pinterest',
			),
			'linkedin' => array(
				'url' => '//www.linkedin.com/shareArticle?mini=true&url=' . $post_url . '&amp;title=' . $post_title,
				'icon' => 'linkedin',
			),
		);

		return $social_btns;
	}
endif;

if ( ! function_exists( 'aiteko_the_social_sharing_buttons' ) ) :
	/**
	 * Print social shares.
	 */
	function aiteko_the_social_sharing_buttons() {
		if ( '' !== get_theme_mod( 'show_social_shares', true ) || is_customize_preview() ) {
			// customizer placeholder, not really shown in actual site.
			if ( is_customize_preview() ) {
				$relhiden = ( '' === get_theme_mod( 'show_social_shares', true ) ? 'display:none;' : '' );
				print '<div id="social_shares_customization" style="' . esc_attr( $relhiden ) . '">';
			}

			$buttons = aiteko_get_social_sharing_buttons();
			if ( is_array( $buttons ) ) {

				$kses_defaults = wp_kses_allowed_html( 'post' );
				$svg_args      = array(
					'svg'   => array(
						'class'           => true,
						'aria-hidden'     => true,
						'aria-labelledby' => true,
						'role'            => true,
						'xmlns'           => true,
						'width'           => true,
						'height'          => true,
						'viewbox'         => true, // <= Must be lower case!
					),
					'g'     => array( 'fill' => true ),
					'title' => array( 'title' => true ),
					'path'  => array(
						'd'    => true,
						'fill' => true,
					),
				);
				$allowed_tags  = array_merge( $kses_defaults, $svg_args );

				print '<div class="social_share_links">' . "\n";
				print '<ul>' . "\n";

				foreach ( $buttons as $button => $attr ) {
					print '<li><a class="aiteko_share_' . esc_attr( $button ) . '" href="' . esc_url( $attr['url'] ) . '" rel="nofollow" target="_blank">' . wp_kses( aiteko_get_social_icon_svg( $attr['icon'], 20 ), $allowed_tags ) . '</a></li>' . "\n";
				}
				unset( $button );

				print '</ul>' . "\n";
				print '</div>';

			}

			if ( is_customize_preview() ) {
				print '</div>';
			}
		}
	}
endif;

function aiteko_get_portfolio_cat_lists( $id, $year_info = '', $show = false ) {
	if ( ! $show ) {
		return false;
	}
	$cats = get_the_term_list( $id, 'portfolio-cat', '', ', ' );
	if ( $cats ) {
		if ( $year_info ) {
			$cats = ' &#47; ' . $cats;
		}
		return $cats;
	}
}
