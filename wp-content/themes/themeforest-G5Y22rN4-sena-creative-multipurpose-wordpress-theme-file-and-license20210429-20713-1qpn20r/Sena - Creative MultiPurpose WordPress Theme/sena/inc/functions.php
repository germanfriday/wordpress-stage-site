<?php
class Sena_Theme {
	
	// Shortcodes fix
	// https://gist.github.com/bitfade/4555047
	public static function sena_filter( $content ) {
        $block = join( '|', array(
			'slideshow',    'single_image',     'video_background', 'section_title',	'button',			
            'skills',		'bar',			    'services',         'service',			'our_team',			
            'portfolio',	'details',		    'info_box',         'milestone',		'counter',			
            'testimonial',	'video',		    'accordions',       'accordion',		'pricing_table',	
            'plan',			'our_clients',	    'map',              'google_map',		'contact_form',		
            'contact_info',	'contact_text',	    'slider',           'blog'
		) );

		$rep = preg_replace( "/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/", "[$2$3]", $content );
		$rep = preg_replace( "/(<p>)?\[\/($block)](<\/p>|<br \/>)?/", "[/$2]", $rep );		
		
		return $rep;
	}
	
	// Social icons
	public static function sena_social_icons( $value, $container, $format ) {
		global $sena_config;

		$result = '';
		
		if ( isset( $sena_config ) ) {
			if( ! empty( $sena_config[$value] ) && count( $sena_config[$value] ) >= 1 ) {
				$arr_social = array_values( $sena_config[$value] );
				
				for ($i = 0, $cnt = count( $arr_social ); $i < $cnt; $i++) {
					$item = $arr_social[$i];
					
					$icon = $item['select'];
					$title = $item['title'];
					$url = $item['url'];
					
					if ( $icon != '' ) {
						$result .= sprintf( $format, esc_attr( $icon ), esc_attr( $title ), esc_url( $url ) );
					}
				}
			}
		}
		
		if ( $result != '' ) {
			$result = '<div class="' . $container . '">' . $result . '</div>';
		}

		return $result;
	}

	// Slideshow images
	public static function sena_slideshow_images( $source ) {
		$result = false;
		
		if ( ! empty( $source ) ) {
			$result = explode( ',', $source );
		}

		return $result;
	}

	// Slideshow slides
	public static function sena_slideshow_slides( $postId ) {
		$meta = get_post_meta( $postId );

		if ( count( $meta ) > 0 ) {
			$array = array( );

			foreach ( $meta as $param => $value ) {
				if ( substr_count( $param, 'slideshow-slide-' ) > 0 ) {
					if ( ! empty( $value[0] ) ) {
						$array[] = $value[0];
					}
				}
			}

			if ( count( $array ) > 0 ) {
				return $array;
			}
		}

		return false;
	}

	// Get front page type
	public static function sena_front_page_type( $postId ) {
		$type = get_post_meta( $postId, 'section_type', true );
		
		if ( $type == 'none' or empty( $type ) ) {
			return false;
		}

		return $type;
	}

	// Is front page
	public static function sena_is_front_page( $postId ) {
		if ( self::sena_front_page_type( $postId ) !== false ) {
			return true;
		}

		return false;
	}
	
	// Inline scripts
	public static function sena_inline_scripts( $page_id ) {
		global $sena_config, $color_schema;
		
		$loader = false;
		$isFrontPage = Sena_Theme::sena_is_front_page( get_the_ID( ) );

		if ( $sena_config === null ) {
			$loader = true;
		} else if ( $sena_config['preloader'] ) {
			if ( ( $sena_config['preloader-only-home'] and $isFrontPage ) or ! $sena_config['preloader-only-home'] ) {
				$loader = true;
			}
		}
		
		$script_loader = $loader ? 'true' : 'false';
		$script_animations = $sena_config['animations'] ? 'true' : 'false';
		$script_navigation = $sena_config['header-sticky'] ? 'sticky' : 'normal';
		$ajax_nonce = wp_create_nonce( "sena-nonce" );
		
		$mapColor = '';
		$mapMarker = '';
		
		if ( isset($color_schema) && ! empty($color_schema) ) {
			$mapMarker = get_template_directory_uri( ) . '/layout/images/map-marker-' . $color_schema . '.png';
			
			switch ($color_schema) {
				case 'green': 		$mapColor = '#24bca4'; break;
				case 'orange': 		$mapColor = '#ee8f67'; break;
				case 'red': 		$mapColor = '#f25454'; break;
				case 'blue': 		$mapColor = '#4e9cb5'; break;
				case 'turquoise': 	$mapColor = '#46cad7'; break;
				case 'purple': 		$mapColor = '#c86f98'; break;
				case 'yellow': 		$mapColor = '#e4d20c'; break;
				case 'grey': 		$mapColor = '#6b798f'; break;
			}
		}

		wp_add_inline_script( 'sena-main', 
			'var Sena = {
				"loader":'. $script_loader .', 
				"animations":' . $script_animations . ', 
				"navigation":"' . $script_navigation . '",
				"mapColor":"' . $mapColor . '",
				"mapMarker":"' . $mapMarker . '",
				"security":"' . $ajax_nonce . '"
			};', 
		'before');
	}

	// Load front page templates
	public static function sena_front_page( $postId ) {
		$type = self::sena_front_page_type( $postId );

		if ( $type === false ) {
			return false;
		} else if ( $type == 'slideshow' ) {
			get_template_part( 'templates/front', 'slideshow' );
		} else if ( $type == 'image' ) {
			get_template_part( 'templates/front', 'image' );	
		} else if ( $type == 'video' ) {
			get_template_part( 'templates/front', 'video' );		
		}		

		return true;
	}

	// Front page sections
	public static function sena_front_sections( ) {
		global $sena_config;

		$output = '';
		$sections = ( array ) json_decode( get_option( 'sena_sections', true ), true );

		if ( is_array( $sections ) && count( $sections ) > 0 ) {
			$count = count( $sections['page'] );

			if ( $count > 0 ) {
				for ( $i = 0; $i < $count; $i ++ ) {
					$post = $post_content = null;
					$post_template = '';

					if ( ! empty( $sections['page'][$i] ) ) {
						$post = get_page_by_path( stripslashes( $sections['page'][$i] ) );

						if ( $post !== null and isset( $post->post_content ) ) {
							$post_content = $post->post_content;
						}
					}
					
					if ( $post_content !== null ) {
						$id      = ( $post !== null ) ? $post->post_name : '';
						$current = self::sena_filter( do_shortcode( stripslashes( $post_content ) ) );

						if ( substr_count( $current, '<section' ) < 1 ) {
							$atts = array( );
							$addClass = $after = '';

							if ( $sections['layout'][$i] == 'parallax' ) {
								$atts['data-image'] = $sections['image'][$i];
							} else if ( $sections['layout'][$i] == 'video' ) {
								$atts['data-source'] = $sections['video'][$i];
								$atts['data-start'] = intval( $sections['video-start'][$i] );

								if ( ! $sena_config['multiple-videos'] ) {
									$atts['data-hide-on-another'] = 'true';
								}
							}

							if ( $sections['layout'][$i] == 'parallax' or $sections['layout'][$i] == 'video' ) {
								if ( $sections['overlay'][$i] == 'default' or $sections['overlay'][$i] == 'primary' ) {
									$atts['overlay'] = $sections['overlay'][$i];
								}
							}

							$classes = '';
							$container = true;
							
							if ( substr_count( $post_content, '[info_box' ) > 0 ) {
								$classes = 'info-box';
							}
							
							if ( substr_count( $post_content, '[map' ) > 0 || substr_count( $post_content, '[google_map' ) > 0 ) {
								$classes = 'map';
								$container = false;
							}

							if ( $sections['background'][$i] == 'grey' ) {
								$addClass = 'bg-grey';
							} elseif ( $sections['background'][$i] == 'dark' ) {
								$addClass = 'bg-dark';
							}

							if ( substr_count( $current, 'portfolio-items' ) > 0 ) {
								$classes = 'portfolio';
								$after = '<section id="portfolio-details"></section>';
							}

							$output .= self::sena_section_wrapper( $sections['layout'][$i], $current, $atts, $id, $addClass, $classes, $container );

							if ( ! empty( $after ) ) {
								$output .= $after;
							}
						} else {
							// Map
							if ( substr_count( $post_content, '[map]' ) > 0 ) {
								$current = str_replace( 'class="map"', 'id="' . esc_attr( $id ) . '" class="map"', $current );
							}
							// End

							$output .= $current;
						}
					}
				}
			}
		}

		return $output;
	}

	// Section wrapper (Primary)
	public static function sena_section_wrapper( $type, $content, $atts = array( ), $id = '', $addClass = '', $class = '', $container = true ) {
		$atts_str = '';
		$atts_formated = array( );

		if ( count( $atts ) > 0 ) {
			foreach( $atts as $key => $value ) {
				if ( $key != 'overlay' ) {
					$atts_formated[] = $key . '="' . esc_attr( $value ) . '"';
				}
			}

			$atts_str = ' ' . implode( ' ', $atts_formated );
		}

		if ( $type == 'parallax' ) {
			$class = 'parallax';
			if ( isset( $atts['overlay'] ) ) {
				$overlay = $atts['overlay'] == 'primary' ? '<div class="parallax-overlay colored"></div>' : '<div class="parallax-overlay"></div>';
			} else {
				$overlay = '';
			}

			$content = '<div class="parallax-container">' . $overlay . '<div class="container">' . $content . '</div></div>';
		} else if ( $type == 'video' ) {
			$class = 'video hidden-xs';
			if ( isset( $atts['overlay'] ) ) {
				$overlay = $atts['overlay'] == 'primary' ? '<div class="video-overlay colored"></div>' : '<div class="video-overlay"></div>';
			} else {
				$overlay = '';
			}

			$content = '<div class="video-container">' . $overlay . '<div class="container">' . $content . '</div></div>';
		} else {
			if ( $container ) {
				$content = '<div class="container">' . $content . '</div>';
			}
		}

		return "\n" . '<section' . ( ! empty( $id ) ? ' id="' . esc_attr( $id ) . '"' : '' ) . ' class="' . ( ! empty( $class ) ? ' ' . esc_attr( $class ) : '' ) . ( ! empty( $addClass ) ? ' ' . esc_attr( $addClass ) : '' ) . '"' . $atts_str . '>' . "\n" . $content . "\n" . '</section>' . "\n";
	}

	// Main menu
	public static function sena_main_menu( $post_id, $menu_class = '' ) {
		return wp_nav_menu( array(
			'theme_location' => 'header-menu',
			'container'      => false,
			'menu_class'     => $menu_class,
			'echo'           => false,
			'depth'          => 3,
			'walker'         => new Sena_Menu,
			'fallback_cb'    => array( 'Sena_Menu', 'fallback_cb' )
		) );
	}

	// Portfolio item categories
	public static function sena_portfolio_categories( $post_id, $delimiter = ', ' ) {
		$info = wp_get_object_terms( $post_id, 'portfolio-category' );
		$category = array( );

		foreach( $info as $item ) {
			$category[] = $item->name;
		}

		return implode( $delimiter, $category );
	}

	// Comment
	public static function sena_comment( $comment, $args, $depth ) {
		global $post;
		
		$comment_approved = '';
		
		if ( $comment->comment_approved == '0' ) {
			$comment_approved = '<p class="comment-approved">
									<em>' . esc_html( 'Your comment is awaiting moderation.', 'sena' ) . '</em>
								 </p>';
		}

		if ( $comment->comment_type == 'pingback' or $comment->comment_type == 'trackback' ) {?>
			<div <?php comment_class( 'user-comment pingback' ); ?> id="comment-<?php comment_ID() ?>">
				<div class="user-comment-inner">
					<div class="details">
						<div class="info">
							<span class="author">
								<span><?php esc_html_e( 'Pingback', 'sena' ); ?> &ndash;</span>
								<?php comment_author_link( ); ?>
							</span>
							<span class="reply">
								<?php edit_comment_link( esc_html__( 'Edit ', 'sena' ), '', ( ( comments_open( ) and $depth < $args['max_depth'] ) ? ' &ndash; ' : '' ) ); ?>
							</span>
						</div>					
					</div>
				</div>
		
		<?php 
			} else {
				$avatar = str_replace( 'class=\'', 'class=\'img-responsive img-circle ', get_avatar( $comment, 80, '', 'avatar' ) );
		?>
			<div <?php comment_class( 'user-comment' ); ?> id="comment-<?php comment_ID() ?>">	
				<div class="user-comment-inner">
					<div class="image"><?php echo wp_kses_post( $avatar ); ?></div>				
					<div class="details">
						<div class="info">
							<span class="author"><?php comment_author_link( ); ?></span>
							<span class="date"><?php comment_date( ); ?></span>
						</div>
						<div class="text">
							<?php comment_text(); ?><?php echo wp_kses_post( $comment_approved ); ?>
						</div>
						<div class="reply">
							<?php 
								edit_comment_link( esc_html__( 'Edit ', 'sena' ), '', ( ( comments_open( ) and $depth < $args['max_depth'] ) ? ' &ndash; ' : '' ) );
								comment_reply_link( array_merge( $args, array( 'reply_text' => wp_kses_post( '<i class="fas fa-reply"></i> Reply', 'sena' ), 'depth' => $depth ) ) );
							?>
						</div>
					</div>
				</div>
				
		<?php }
	}

	// Page title
	public static function sena_page_title( ) {
		if ( is_home( ) ) {
			if ( get_option( 'page_for_posts', true ) ) {
				echo get_the_title( get_option( 'page_for_posts', true ) );
			} else {
				esc_html_e( 'Latest Posts', 'sena' );
			}
		} elseif ( is_archive( ) ) {
			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			
			if ( $term ) {
				echo esc_html( $term->name );
			} elseif ( is_post_type_archive( ) ) {
				echo get_queried_object( )->labels->name;
			} elseif ( is_day( ) ) {
				printf( esc_html__( 'Daily Archives: %s', 'sena' ), get_the_date( ) );
			} elseif ( is_month( ) ) {
				printf( esc_html__( 'Monthly Archives: %s', 'sena' ), get_the_date( 'F Y' ) );
			} elseif ( is_year( ) ) {
				printf( esc_html__( 'Yearly Archives: %s', 'sena' ), get_the_date( 'Y' ) );
			} elseif ( is_author( ) ) {
				global $post;

				printf( esc_html__( 'Author Archives: %s', 'sena' ), get_the_author_meta( 'display_name', $post->post_author ) );
			} else {
				single_cat_title( );
			}
		} elseif ( is_search( ) ) {
			printf( esc_html__( 'Search Results for %s', 'sena' ), get_search_query( ) );
		} elseif ( is_404( ) ) {
			esc_html_e( 'File Not Found', 'sena' );
		} else {
			the_title( );
		}
	}

	// Content navigation
	public static function sena_nav_content( $class = '' ) {
		global $wp_query;

		if ( $wp_query->max_num_pages > 1 ) {
			echo '<div class="row">
					<div class="col-md-12 post-nav' . ( ! empty( $class ) ? ' ' . esc_attr( $class ) : '' ) . '">
						' . get_next_posts_link( esc_html__( '&lsaquo;&nbsp; Older posts', 'sena' ) ) . '
						' . get_previous_posts_link( esc_html__( 'Newer posts &nbsp;&rsaquo;', 'sena' ) ) . '
					</div>
				  </div>';
		}
	}

	// Post gallery
	public static function sena_post_gallery( $more_link, $echo = true ) {		
		$content = get_the_content( $more_link );
		
		if ( $echo ) {
			echo apply_filters( 'the_content', wpautop( $content ) );
		} else {
			return apply_filters( 'the_content', wpautop( $content ) );
		}
	}
	
	// Set post view
	public static function sena_set_post_view( $post_id ) {
		$count_key = 'sena_post_views_count';
		$count = get_post_meta( $post_id, $count_key, true );

		if ( $count=='' ) {
			$count = 0;
			delete_post_meta( $post_id, $count_key );
			add_post_meta( $post_id, $count_key, '0' );
		} else {
			$count++;
			update_post_meta(post_id, $count_key, $count);
		}
	}
	
	// Get post view
	public static function sena_get_post_view( $post_id ) {
		$count_key = 'sena_post_views_count';
		$count = get_post_meta( $post_id, $count_key, true );

		if ( $count=='' ) {
			delete_post_meta( $post_id, $count_key );
			add_post_meta( $post_id, $count_key, '0' );
			return "0";
		}

		return $count;
	}
	
	// Get next attachment URL
	public static function sena_next_attachment_url( $post ) {
		$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );

		foreach ( $attachments as $k => $attachment ) {
			if ( $attachment->ID == $post->ID ) {
				break;
			}
		}
		
		if ( count( $attachments ) > 1 ) {
			$k ++;
			if ( isset( $attachments[$k] ) ) {
				$url = get_attachment_link( $attachments[$k]->ID );
			} else {
				$url = get_attachment_link( $attachments[0]->ID );
			}
		} else {
			$url = wp_get_attachment_url( );
		}
		
		return $url;
	}

	// Get option
	public static function sena_option( $key, $default = false ) {
		global $sena_config;

		if ( isset( $sena_config[$key] ) ) {
			return $sena_config[$key];
		}

		return $default;
	}
	
	// Custom CSS
	public static function sena_custom_css() {
		global $sena_config;
		
		$custom_css = '';
		
		// Background colors
		if ( ! empty( $sena_config['header-bgcolor'] ) ) {
			$custom_css .= '.page-title {background:' . esc_attr( $sena_config['header-bgcolor'] ) . ';}' . "\n";
		}
		
		if ( ! empty( $sena_config['header-nav-bgcolor'] ) ) {
			$split = str_split( esc_attr( $sena_config['header-nav-bgcolor'] ), 2 );
			$r = hexdec($split[0]);
			$g = hexdec($split[1]);
			$b = hexdec($split[2]);
			
			$custom_css .= '.navbar.floating {background-color:rgba(' . $r . ', ' . $g. ', ' . $b . ', 0.93);}' . "\n";
		}
		
		if ( ! empty( $sena_config['body-bgcolor'] ) ) {
			$custom_css .= 'body {background:' . esc_attr( $sena_config['body-bgcolor'] ) . ';}' . "\n";
		}
		
		if ( ! empty( $sena_config['loader-bgcolor'] ) ) {
			$custom_css .= '.page-loader {background:' . esc_attr( $sena_config['loader-bgcolor'] ) . ';}' . "\n";
		}
		
		if ( ! empty( $sena_config['footer-bgcolor'] ) ) {
			$custom_css .= 'footer {background-color:' . esc_attr( $sena_config['footer-bgcolor'] ) . ';}' . "\n";
		}
		
		// Primary font
		$defaultFont = 'Open Sans';
		$defaultSize = 14;		
		
		if ( $sena_config['typography-content']['font-family'] != $defaultFont ) {
			$custom_css .= 'body,
							.info-box input[type="email"],
							.info-box input[type="text"],
							.circular-bars input,
							.sticker {
								font-family:"' . esc_attr( $sena_config['typography-content']['font-family'] ) . '", sans-serif;
							}' . "\n";
		}
		
		if ( $sena_config['typography-content']['font-size'] != $defaultSize ) {
			$custom_css .= 'body,
							.navbar .navbar-nav > li > a,
							.navbar .navbar-nav > li > .dropdown-menu > li a,
							.arrows .arrow,
							.portfolio-item .details,
							.contact-form .field .error i.fa,
							blockquote,
							blockquote footer,
							.user-comment .details .info,
							.milestone .description {
								font-size:' . intval( $sena_config['typography-content']['font-size'] ) . 'px;
							}' . "\n";
		}
		
		// H1
		if ( $sena_config['typography-headers-h1']['font-family'] != $defaultFont ) {
			$custom_css .= "\n" . 'h1, .h1 {font-family:"' . esc_attr( $sena_config['typography-headers-h1']['font-family'] ) . '", sans-serif;}';
		}
		
		if ( $sena_config['typography-headers-h1']['font-size'] != 60 ) {
			$custom_css .= "\n" . 'h1, .h1 {font-size:' . intval( $sena_config['typography-headers-h1']['font-size'] ) . 'px !important;}';
		}
		
		// H2
		if ( $sena_config['typography-headers-h2']['font-family'] != $defaultFont ) {
			$custom_css .= "\n" . 'h2, .h2 {font-family:"' . esc_attr( $sena_config['typography-headers-h2']['font-family'] ) . '", sans-serif;}';
		}
		
		if ( $sena_config['typography-headers-h2']['font-size'] != 40 ) {
			$custom_css .= "\n" . 'h2, .h2 {font-size:' . intval( $sena_config['typography-headers-h2']['font-size'] ) . 'px !important;}';
		}
		
		// H3
		if ( $sena_config['typography-headers-h3']['font-family'] != $defaultFont ) {
			$custom_css .= "\n" . 'h3, .h3 {font-family:"' . esc_attr( $sena_config['typography-headers-h3']['font-family'] ) . '", sans-serif;}';
		}
		
		if ( $sena_config['typography-headers-h3']['font-size'] != 32 ) {
			$custom_css .= "\n" . 'h3, .h3 {font-size:' . intval( $sena_config['typography-headers-h3']['font-size'] ) . 'px !important;}';
		}
		
		// H4
		if ( $sena_config['typography-headers-h4']['font-family'] != $defaultFont ) {
			$custom_css .= "\n" . 'h4, .h4 {font-family:"' . esc_attr( $sena_config['typography-headers-h4']['font-family'] ) . '", sans-serif;}';
		}
		
		if ( $sena_config['typography-headers-h4']['font-size'] != 22 ) {
			$custom_css .= "\n" . 'h4, .h4 {font-size:' . intval( $sena_config['typography-headers-h4']['font-size'] ) . 'px !important;}';
		}
		
		// H5
		if ( $sena_config['typography-headers-h5']['font-family'] != $defaultFont ) {
			$custom_css .= "\n" . 'h5, .h5 {font-family:"' . esc_attr( $sena_config['typography-headers-h5']['font-family'] ) . '", sans-serif;}';
		}
		
		if ( $sena_config['typography-headers-h5']['font-size'] != 18 ) {
			$custom_css .= "\n" . 'h5, .h5 {font-size:' . intval( $sena_config['typography-headers-h5']['font-size'] ) . 'px !important;}';
		}
		
		// H6
		if ( $sena_config['typography-headers-h6']['font-family'] != $defaultFont ) {
			$custom_css .= "\n" . 'h6, .h6 {font-family:"' . esc_attr( $sena_config['typography-headers-h6']['font-family'] ) . '", sans-serif;}';
		}
		
		if ( $sena_config['typography-headers-h6']['font-size'] != 16 ) {
			$custom_css .= "\n" . 'h6, .h6 {font-size:' . intval( $sena_config['typography-headers-h6']['font-size'] ) . 'px !important;}';
		}
		
		return $custom_css;
	}
	
}
