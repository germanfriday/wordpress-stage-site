<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

/**
 * Helper functions and classes with static methods for usage in theme
 */

/**
 * Register Lato Google font.
 *
 * @return string
 */
function vispa_theme_font_url() {
	$font_url = '';
	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Lato, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== esc_html_x( 'on', 'Lato font: on or off', 'vispa' ) ) {
		$font_url = add_query_arg( 'family', urlencode( 'Lato:300,400,700,900,300italic,400italic,700italic' ), "//fonts.googleapis.com/css" );
	}

	return $font_url;
}

/**
 * Getter function for Featured Content Plugin.
 *
 * @return array An array of WP_Post objects.
 */
function vispa_theme_get_featured_posts() {
	/**
	 * @param array|bool $posts Array of featured posts, otherwise false.
	 */
	return apply_filters( 'vispa_theme_get_featured_posts', array() );
}

/**
 * A helper conditional function that returns a boolean value.
 *
 * @return bool Whether there are featured posts.
 */
function vispa_theme_has_featured_posts() {
	return ! is_paged() && (bool) vispa_theme_get_featured_posts();
}


if ( ! function_exists( 'vispa_theme_separator_symbol' ) ) :
	/**
	 * Display separator symbol for separator/divider shortcode
	 */
	function vispa_theme_separator_symbol( $type = 'star' ) {
		if( $type == 'square' ) {
			return '∎';
		}
		elseif( $type == 'star' ) {
			return '✻';
		}
		else {
			return '♦';
		}
	}
endif;


if ( ! function_exists( 'vispa_theme_paging_nav' ) ) :
	/**
	 * Display navigation to next/previous set of posts when applicable.
	 */
	function vispa_theme_paging_nav( $args = array(), $query = '' ) {

		global $wp_rewrite, $wp_query;
		if ( $query ) {

			$wp_query = $query;

		} // End IF Statement
		/* If there's not more than one page, return nothing. */
		if ( 1 >= $wp_query->max_num_pages ) {
			return false;
		}

		/* Get the current page. */
		$current = ( get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1 );

		/* Get the max number of pages. */
		$max_num_pages = intval( $wp_query->max_num_pages );

		/* Set up some default arguments for the paginate_links() function. */
		$defaults = array(
			'base'         => add_query_arg( 'paged', '%#%' ),
			'format'       => '',
			'total'        => $max_num_pages,
			'current'      => $current,
			'prev_next'    => false,
			'show_all'     => false,
			'end_size'     => 2,
			'mid_size'     => 1,
			'add_fragment' => '',
			'type'         => 'array',
			'before'       => '<li>',
			'after'        => '</li>',
			'echo'         => true,
		);

		/* Add the $base argument to the array if the user is using permalinks. */
		if ( $wp_rewrite->using_permalinks() ) {
			$defaults['base'] = user_trailingslashit( trailingslashit( get_pagenum_link() ) . 'page/%#%' );
		}

		/* If we're on a search results page, we need to change this up a bit. */
		if ( is_search() ) {
			$search_permastruct = $wp_rewrite->get_search_permastruct();
			if ( ! empty( $search_permastruct ) ) {
				$defaults['base'] = user_trailingslashit( trailingslashit( get_search_link() ) . 'page/%#%' );
			}
		}

		/* Merge the arguments input with the defaults. */
		$args = wp_parse_args( $args, $defaults );

		/* Get the paginated links. */
		$page_links = paginate_links( $args );

		/* Remove 'page/1' from the entire output since it's not needed. */
		$prev = get_previous_posts_link( '' );
		$next = get_next_posts_link( '' );
		?>

		<ul class="pagination">
			<?php if ( $prev ): ?>
				<li class="prev"><?php echo( $prev ); ?></li>
			<?php else: ?>
				<li class="disabled prev"><a href="#"></a></li>
			<?php endif; ?>

			<?php if ( ! empty( $page_links ) ): ?>
				<?php foreach ( $page_links as $key => $page_link ): ?>
					<li><?php echo ( $key == 0 ) ? str_replace( array(
							'&#038;paged=1\'',
							'/page/1\''
						), '\'', $page_link ) : $page_link; ?></li>
				<?php endforeach; ?>
			<?php endif; ?>

			<?php if ( $next ): ?>
				<li class="next"><?php echo( $next ); ?></li>
			<?php else: ?>
				<li class="disabled next"><a href="#"></a></li>
			<?php endif; ?>
		</ul>
	<?php
	}
endif;


if ( ! function_exists( 'vispa_theme_get_posts' ) ):
	/**
	 *  Generate array with: recent/popular/most commented posts
	 *
	 * @param string $sort Sort type (recent/popular/most commented)
	 * @param integer $items Number of items to be extracted
	 * @param boolean $image_post Extract or no post image
	 * @param integer $image_width Set width of post image
	 * @param integer $image_height Set height of post image
	 * @param string $image_class Set class of post image
	 * @param boolean $date_post Extract or no post date
	 * @param string $date_format Set date format
	 * @param string $post_type Set post type
	 * @param string $category Set category from where posts would be extracted
	 */
	function vispa_theme_get_posts( $args = null ) {
		$defaults = array(
			'sort'             => 'recent',
			'items'            => 5,
			'image_post'       => true,
			'return_image_tag' => true,
			'image_width'      => 70,
			'image_height'     => 70,
			'image_class'      => 'thumbnail',
			'date_post'        => true,
			'date_format'      => get_option( 'date_format' ),
			'post_type'        => 'post',
			'category'         => '',
			'excerpt_length'   => 40
		);

		extract( wp_parse_args( $args, $defaults ) );
		global $post;
		$fw_cat_ID = ( ! empty( $category ) ) ? get_cat_ID( $category ) : '';

		if ( $sort == 'recent' ) {
			$query = new WP_Query( array(
				'post_type'      => $post_type,
				'orderby'        => 'post_date',
				'order '         => 'DESC',
				'cat'            => $fw_cat_ID,
				'posts_per_page' => $items
			) );
			$posts = $query->get_posts();
		} elseif ( $sort == 'popular' ) {
			$query = new WP_Query( array(
				'post_type'      => $post_type,
				'orderby'        => 'meta_value',
				'meta_key'       => 'fw_post_views',
				'order '         => 'DESC',
				'cat'            => $fw_cat_ID,
				'posts_per_page' => $items
			) );
			$posts = $query->get_posts();
		} elseif ( $sort == 'commented' ) {
			$query = new WP_Query( array(
				'post_type'      => $post_type,
				'orderby'        => 'comment_count',
				'order '         => 'DESC',
				'cat'            => $fw_cat_ID,
				'posts_per_page' => $items
			) );
			$posts = $query->get_posts();

		} else {
			return false;
		}

		$fw_post_option = array();
		$count          = 0;
		if ( ! empty( $posts ) ) {

			foreach ( $posts as $post_elm ) {
				setup_postdata( $post_elm );
				$img      = '';
				$img_full = '';

				if ( $image_post == true ) {
					$post_thumbnail_id = get_post_thumbnail_id( $post_elm->ID );
					$post_thumbnail    = wp_get_attachment_image_src( $post_thumbnail_id, 'large' );
					$post_view_type    = ( defined( 'FW' ) ) ? fw_get_db_post_option( $post_elm->ID, 'post_type' ) : '';

					if ( ! empty( $post_thumbnail ) ) {
						$image    = defined( 'FW' ) ? fw_resize( $post_thumbnail_id, $image_width, $image_height, true ) : $post_thumbnail[0];
						$img      = $image;
						$img_full = $post_thumbnail[0];
						if ( $return_image_tag ) {
							$img = '<img src="' . esc_url( $image ) . '" class="' . esc_attr( $image_class ) . '" alt="' . esc_attr( get_the_title( $post_thumbnail_id ) ) . '" width="' . esc_attr( $image_width ) . '" height="' . esc_attr( $image_height ) . '" />';
						}
					} elseif ( isset( $post_view_type['post_type'] ) && $post_view_type['post_type'] == 'slider' ) {
						if ( isset( $post_view_type['slider']['images'] ) && ! empty( $post_view_type['slider']['images'] ) ) {
							foreach ( $post_view_type['slider']['images'] as $img_slider ) {
								$image    = defined( 'FW' ) ? fw_resize( $img_slider['attachment_id'], $image_width, $image_height, true ) : $img_slider['url'];
								$img      = $image;
								$img_full = $img_slider['url'];
								if ( $return_image_tag ) {
									$img = '<img src="' . esc_url( $image ) . '" class="' . esc_attr( $image_class ) . '" alt="' . esc_attr( get_the_title( $post_thumbnail_id ) ) . '" width="' . esc_attr( $image_width ) . '" height="' . esc_attr( $image_height ) . '" />';
								}

								break;
							}
						}
					}
				}

				if ( ! empty( $img ) ) {
					$fw_post_option[ $count ]['post_img'] = $img;
				} else {
					$fw_post_option[ $count ]['post_img'] = '';
				}

				//get full image for lightbox
				if ( ! empty( $img_full ) ) {
					$fw_post_option[ $count ]['post_img_full'] = $img_full;
				} else {
					$fw_post_option[ $count ]['post_img_full'] = '';
				}

				if ( $date_post ) {
					$time_format                                = apply_filters( '_filter_widget_time_format', $date_format );
					$fw_post_option[ $count ]['post_date_post'] = get_the_time( $time_format, $post_elm->ID );
				} else {
					$fw_post_option[ $count ]['post_date_post'] = '';
				}

				$fw_post_option[ $count ]['post_class']        = ( is_singular() && $post->ID == $post_elm->ID ) ? 'current-menu-item post_' . ( $sort ) : 'post_' . ( $sort );
				$fw_post_option[ $count ]['post_title']        = get_the_title( $post_elm->ID );
				$fw_post_option[ $count ]['post_link']         = esc_url( get_permalink( $post_elm->ID ) );
				$fw_post_option[ $count ]['post_author_link']  = get_author_posts_url( get_the_author_meta( 'ID' ) );
				$fw_post_option[ $count ]['post_author_name']  = get_the_author();
				$fw_post_option[ $count ]['post_comment_numb'] = get_comments_number( $post_elm->ID );
				$fw_post_option[ $count ]['post_excerpt']      = ( isset( $post ) ) ? get_the_excerpt() : '';
				$fw_post_option[ $count ]['id']                = $post_elm->ID;
				$count ++;
			}
			wp_reset_postdata();
		}

		return $fw_post_option;
	}
endif;

if ( ! function_exists( 'vispa_theme_get_sidebar_class' ) ) :
	/**
	 * get parent sidebar class
	 */
	function vispa_theme_get_sidebar_class( $sidebar_position ) {
		if ( $sidebar_position == 'left' ) {
			$class = 'page-sidebar-left';
		} elseif ( $sidebar_position == 'right' ) {
			$class = 'page-sidebar';
		} else {
			$class = '';
		}
		vispa_theme_print( $class );
	}
endif;


if ( ! function_exists( 'vispa_theme_type_logo' ) ) :
	/**
	 * display theme logo
	 */
	function vispa_theme_type_logo() {
		$logo_type = ( defined( 'FW' ) ) ? fw_get_db_settings_option( 'logo_type' ) : '';
		if ( ! empty( $logo_type ) ) { ?>
			<a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo get_bloginfo( 'name' );?>">
				<?php if($logo_type['selected'] == 'image' && !empty($logo_type['image']['logo']) ) : ?>
					<img src="<?php echo esc_url( $logo_type['image']['logo']['url'] );?>" alt="<?php echo get_bloginfo( 'name' );?>" />
				<?php else : ?>
					<?php echo ( $logo_type['text']['logo_text'] ); ?>
				<?php endif; ?>
			</a>
		<?php } else { ?>
			<a class="logo logo-default" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo get_bloginfo( 'name' );?>">
				<?php echo get_bloginfo( 'name' );?>
			</a>
		<?php }

	}
endif;


if ( ! function_exists( 'vispa_theme_list_portfolios' ) ) :
	/**
	 * return the list of portfolio
	 */
	function vispa_theme_list_portfolios() {
		$args   = array(
			'hide_empty' => false,
		);
		$terms  = get_terms( 'fw-portfolio-category', $args );
		$result = array();

		if ( ! empty( $terms ) ) {
			foreach ( $terms as $term ) {
				$result[ $term->term_id ] = $term->name;
			}
		}

		return $result;
	}
endif;


if ( ! function_exists( 'vispa_get_portfolio_categories' ) ) :
	/**
	 * return portfolio categories
	 */
	function vispa_get_portfolio_categories( $separator ) {
		global $post;
		$args   = array(
			'hide_empty' => false,
		);
		$terms = wp_get_post_terms( $post->ID, 'fw-portfolio-category', $args );
		$result = '';

		if ( ! empty( $terms ) ) {
			$count = 0;
			$terms_count = count($terms);
			foreach ( $terms as $term ) {
				$count++;
				$result .= '<a href="'.get_term_link($term).'">'.$term->name.'</a>';
				if( $count < $terms_count ) {
					$result .= $separator;
				}
			}
		}

		return $result;
	}
endif;


if ( ! function_exists( 'vispa_theme_relative_menu' ) ) :
	/**
	 * display header menu position
	 */
	function vispa_theme_relative_menu() {
		if( !function_exists('fw_get_db_settings_option') ) {
			echo 'static';
			return;
		}
		global $post;
		$general_header_options = array();
		$class     = 'static';
		$post_type = get_post_type();
		// general header options
		if ( is_front_page() ) {
			$general_header_options = fw_get_db_settings_option('homepage_header_type', '');
			$header_type = $general_header_options;
		} elseif ( is_home() ) {
			$general_header_options = fw_get_db_settings_option('blogpage_header_type', '');
			$header_type = $general_header_options;
		}elseif ( is_search() ) {
			$general_header_options = fw_get_db_settings_option('search_header_type', '');
			$header_type = $general_header_options;
		} elseif ( is_404() ) {
			$general_header_options = fw_get_db_settings_option('404_header_type', '');
			$header_type = $general_header_options;
		} elseif ( $post_type == 'page' ) {
			$general_header_options = fw_get_db_settings_option('page_header_type', '');
		} elseif ( $post_type == 'fw-portfolio' ) {
			$general_header_options = fw_get_db_settings_option('portfolio_header_type', '');
		} elseif ( is_archive() ) {
			$general_header_options = fw_get_db_settings_option('post_header_type', '');
			$header_type = $general_header_options;
		} else {
			// posts general options
			$general_header_options = fw_get_db_settings_option('post_header_type', '');
		}

		if( is_single() || is_page() ) {
			$header_type = fw_get_db_post_option( $post->ID, 'post_header_type' );
			if( empty($header_type) || ( isset($header_type['header_type']) && $header_type['header_type'] == 'general') ) {
				// get options from general when header is empty or header is selected from "general"
				$header_type = $general_header_options;
			}
		}
		else {
			if( is_category() ){
				$term = get_category( get_query_var('cat'), false );
			}
			else{
				$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			}

			if ( is_wp_error( $term ) ) {
				return;
			}

			if ( isset($term->term_id) ) {
				$header_type = fw_get_db_term_option($term->term_id, $term->taxonomy, 'blog_header_type', '');
			}
		}

		if(( isset($header_type['header_type']) && $header_type['header_type'] != 'relative') ) {
			$class = '';
		}

		echo esc_attr($class);
	}
endif;


if ( ! function_exists( 'vispa_theme_header_image' ) ) :
	/**
	 * display theme header image
	 */
	function vispa_theme_header_image() {
		if( !function_exists('fw_get_db_settings_option') ) {
			return;
		}
		global $post;
		$title = $desc = '';
		$general_header_options = array();
		$post_type = get_post_type();

		// general header options
		if( is_front_page() && ( get_option('show_on_front', 'posts') == 'posts' ) ) {
			// front page
			$general_header_options = fw_get_db_settings_option('homepage_header_type', '');
			$header_type = $general_header_options;
		} elseif ( is_home() ) {
			// blog page
			$general_header_options = fw_get_db_settings_option('blogpage_header_type', '');
			$header_type = $general_header_options;
		} elseif ( is_search() ) {
			$general_header_options = fw_get_db_settings_option('search_header_type', '');
			$header_type = $general_header_options;
		} elseif ( is_404() ) {
			$general_header_options = fw_get_db_settings_option('404_header_type', '');
			$header_type = $general_header_options;
		} elseif ( $post_type == 'page' ) {
			$title = get_the_title();
			$general_header_options = fw_get_db_settings_option('page_header_type', '');
		} elseif ( $post_type == 'fw-portfolio' ) {
			$title = get_the_title();
			$general_header_options = fw_get_db_settings_option('portfolio_header_type', '');
		} elseif ( is_archive() ) {
			$title = ( is_category() || is_tag() ) ? single_cat_title( '', false ) : esc_html__( 'Archive', 'vispa' );
			$general_header_options = fw_get_db_settings_option('post_header_type', '');
			$header_type = $general_header_options;
		} else {
			// posts general options
			$title = get_the_title();
			$general_header_options = fw_get_db_settings_option('post_header_type', '');
		}

		if( is_single() || is_page() ) {
			$header_type = fw_get_db_post_option( $post->ID, 'post_header_type' );
			if( empty($header_type) || ( isset($header_type['header_type']) && $header_type['header_type'] == 'general') ) {
				// get options from general when header is empty or header is selected from "general"
				$header_type = $general_header_options;
			}
		} else {
			if( is_category() ){
				$term = get_category( get_query_var('cat'), false );
			}
			else{
				$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			}

			if( !is_wp_error($term) && $term != false) {
				$term_id     = $term->term_id;
				$taxonomy    = $term->taxonomy;
				$title       = $term->name;
				$desc        = $term->description;
				$header_type = fw_get_db_term_option( $term_id, $taxonomy, 'blog_header_type', '' );
			}
		}

		// check if header is not empty
		if ( ! empty( $header_type ) ) :
			// Header Image
			if ( $header_type['header_type'] == 'image' ) :
				$title = isset( $header_type['image']['title'] ) ? $header_type['image']['title'] : $title;
				$desc = isset( $header_type['image']['desc'] ) ? $header_type['image']['desc'] : $desc;
				// header image
				$img      = $header_type['image']['img'];
				$bg_image = ( isset( $img['url'] ) && ! empty( $img['url'] ) ) ? 'style="background-image: url(' . esc_url( $img['url'] ) . ');"' : '';
				?>
				<!-- Main Image or Slider -->
				<div id="main-slider" class="main-slider carousel slide fade-effect" data-interval="10000">
					<!-- Carousel items -->
					<div class="carousel-inner">
						<div class="section section-header section-text-white item active">
							<div class="parallax filter filter-color-black">
								<div class="image" <?php echo $bg_image; ?>></div>
								<div class="container">
									<div class="content">
										<h1 class="fw-special-title"><?php echo ($title); ?></h1>
										<?php if( !empty($desc) ) : ?>
											<div class="separator separator-danger"><?php echo vispa_theme_separator_symbol(); ?></div>
											<div class="description"><?php echo $desc; ?></div>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--/ Main Image or Slider -->
			<?php elseif ( $header_type['header_type'] == 'slider' ) :
				$slider_id       = $header_type['slider']['slider_id'];
				$slider_settings = vispa_theme_get_slider_settings( $slider_id );

				if ( ! empty( $slider_id ) ) {
					$meta        = fw_get_db_post_option( $slider_id );
					$post_status = get_post_status( $slider_id );
					if ( 'publish' === $post_status and isset( $meta['populated'] ) ) {
						$slider_name = $meta['slider']['selected'];
						echo ( fw()->extensions->get( 'slider' ) ) ? vispa_theme_render_view( fw()->extensions->get( 'slider' )->locate_path( '/extensions/' . $slider_name . '/views/' . $slider_name . '.php' ), array( 'data' => $slider_settings ) ) : '';
					}
				}
			endif;
		else : // empty header ?>
			<div class="fly-empty-header-type"></div>
		<?php endif;
	}
endif;


if ( ! function_exists( 'vispa_theme_single_post_title' ) ) :
	/**
	 * display single post title
	 */
	function vispa_theme_single_post_title() {
		global $post;
		$header_type = fw_get_db_post_option( $post->ID, 'post_header_type' );
		if( !empty($header_type) && ( isset($header_type['header_type']) && $header_type['header_type'] != 'image') ) {
			if( $header_type['header_type'] == 'general' ) {
				$general_header_options = fw_get_db_settings_option('post_header_type', '');
				if( $general_header_options['header_type'] != 'image' ) {
					$title = get_the_title();
					echo '<h2>' . $title . '</h2>';
				}
			}
			else {
				$title = get_the_title();
				echo '<h2>' . $title . '</h2>';
			}
		}
	}
endif;


if ( ! function_exists( 'vispa_theme_get_slider_settings' ) ) :
	/**
	 * get slider settings
	 */
	function vispa_theme_get_slider_settings( $slider_id ) {
		$meta        = fw_get_db_post_option( $slider_id );
		$post_status = get_post_status( $slider_id );

		$collector = array();

		if ( 'publish' === $post_status and isset( $meta['populated'] ) ) {

			$slider_name       = $meta['slider']['selected'];
			$population_method = $meta['slider'][ $slider_name ]['population-method'];

			$collector = array(
				'slides'   => array(),
				'settings' => array(
					'title'             => $meta['title'],
					'slider_type'       => $slider_name,
					'population_method' => $population_method,
					'post_id'           => $slider_id,
					'extra'             => isset( $meta['custom-settings'] ) ? $meta['custom-settings'] : array(),
				)
			);

			foreach ( $meta['custom-slides'] as $slide ) {

				$collector_slide = array(
					'title'           => ! empty( $slide['title'] ) ? $slide['title'] : '',
					'multimedia_type' => $slide['multimedia']['selected'],
					'src'             =>
						( $slide['multimedia']['selected'] === 'image' && ! empty( $slide['multimedia'][ $slide['multimedia']['selected'] ]['src']['url'] ) ) ?
							$slide['multimedia'][ $slide['multimedia']['selected'] ]['src']['url'] :
							$slide['multimedia'][ $slide['multimedia']['selected'] ]['src'],
					'attachment_id'   =>
						( $slide['multimedia']['selected'] === 'image' && ! empty( $slide['multimedia'][ $slide['multimedia']['selected'] ]['src']['attachment_id'] ) ) ?
							$slide['multimedia'][ $slide['multimedia']['selected'] ]['src']['attachment_id'] :
							'',
					'desc'            => ! empty( $slide['desc'] ) ? $slide['desc'] : '',
					'extra'           => isset( $slide['extra-options'] ) ? $slide['extra-options'] : array()
				);

				array_push( $collector['slides'], $collector_slide );
			}
		}

		return $collector;
	}
endif;


if ( ! function_exists( 'vispa_is_real_post_save' ) ) :
	/**
	 * Return true if is real save
	 *
	 * @param integer $post_id
	 */
	function vispa_is_real_post_save( $post_id ) {
		return ! (
			wp_is_post_revision( $post_id )
			|| wp_is_post_autosave( $post_id )
			|| ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			|| ( defined( 'DOING_AJAX' ) && DOING_AJAX )
		);
	}
endif;


if ( ! function_exists( 'vispa_theme_translate' ) ) :
	/**
	 * Return the content for translations plugins
	 *
	 * @param string $content
	 */
	function vispa_theme_translate( $content ) {
		$content = html_entity_decode( $content, ENT_QUOTES, 'UTF-8' );

		if ( function_exists( 'icl_object_id' ) && strpos( $content, 'wpml_translate' ) == true ) {
			$content = do_shortcode( $content );
		} elseif ( function_exists( 'qtrans_useCurrentLanguageIfNotFoundUseDefaultLanguage' ) ) {
			$content = qtrans_useCurrentLanguageIfNotFoundUseDefaultLanguage( $content );
		}

		return $content;
	}
endif;


if ( ! function_exists( 'vispa_theme_render_view' ) ) :
	/**
	 * Safe render a view and return html
	 * In view will be accessible only passed variables
	 * Use this function to not include files directly and to not give access to current context variables (like $this)
	 *
	 * @param string $file_path
	 * @param array $view_variables
	 * @param bool $return In some cases, for memory saving reasons, you can disable the use of output buffering
	 *
	 * @return string HTML
	 */
	function vispa_theme_render_view( $file_path, $view_variables = array(), $return = true ) {
		extract( $view_variables, EXTR_REFS );

		unset( $view_variables );

		if ( $return ) {
			ob_start();

			require $file_path;

			return ob_get_clean();
		} else {
			require $file_path;
		}
	}
endif;


if ( ! function_exists( 'vispa_theme_print' ) ):
	/**
	 * echo alternative
	 *
	 */
	function vispa_theme_print( $var ) {
		print $var;
	}
endif;


if ( ! function_exists( 'vispa_theme_array_merge_recursive' ) ) :
	/**
	 * Merge array recursive
	 *
	 * @param array $a
	 * @param array $b
	 */
	function vispa_theme_array_merge_recursive( $a, $b ) {
		if ( ! is_array( $a ) || ! is_array( $b ) ) {
			return $a;
		}

		foreach ( array_merge( array_keys( $a ), array_keys( $b ) ) as $k ) {
			if (
				isset( $b[ $k ] ) && isset( $a[ $k ] )
				&&
				is_array( $a[ $k ] ) && is_array( $b[ $k ] )
			) {
				$a[ $k ] = vispa_theme_array_merge_recursive( $a[ $k ], $b[ $k ] );
			} elseif ( isset( $b[ $k ] ) ) {
				$a[ $k ] = $b[ $k ];
			}
		}

		return $a;
	}
endif;


if ( ! function_exists( 'vispa_theme_get_remote_fonts' ) ) :
	/**
	 * Get remote fonts
	 *
	 * @param array $include_from_google
	 */
	function vispa_theme_get_remote_fonts( $include_from_google ) {
		if ( ! sizeof( $include_from_google ) ) {
			return '';
		}

		$html = "https://fonts.googleapis.com/css?family=";
		foreach ( $include_from_google as $font => $styles ) {
			if ( array_key_exists( 'false', $styles['variation'] ) ) {
				unset( $styles['variation']['false'] );
			}

			$html .= str_replace( ' ', '+', $font ) . ':' . implode( ',', $styles['variation'] ) . '|';

			if ( array_key_exists( 'false', $styles['subset'] ) ) {
				unset( $styles['subset']['false'] );
			}

			if ( count( $styles['subset'] ) > 1 ) {
				// if font have more than 1 subset
				foreach ( $styles['subset'] as $subset_item ) {
					$subset_key            = $subset_item;
					$subset[ $subset_key ] = $subset_key;
				}
			} else {
				$subset_key            = implode( '', $styles['subset'] );
				$subset[ $subset_key ] = $subset_key;
			}
		}
		$html = substr( $html, 0, - 1 );
		$html .= '&subset=' . implode( ',', $subset );

		return $html;
	}
endif;


if ( ! function_exists( 'vispa_theme_get_post_category' ) ) :
	/**
	 * Display the post category
	 */
	function vispa_theme_get_post_category( $post_id ) {
		$post_categories = wp_get_post_categories( $post_id );

		if ( ! empty( $post_categories ) ) {
			$cnt = 0;
			foreach ( $post_categories as $c ) {
				$cnt ++;
				$cat = get_category( $c );
				echo '<span class="post-category" itemprop="keywords">' . esc_html__( 'in', 'vispa' ) . ' <a href="' . esc_url( get_category_link( $cat->term_id ) ) . '" class="link-orange">' . esc_html( $cat->name ) . '</a></span>';

				if ( $cnt == 1 ) {
					break;
				}
			}
		}
	}
endif;


if ( ! function_exists( 'vispa_theme_get_one_post_category' ) ) :
	/**
	 * Display one post category
	 */
	function vispa_theme_get_one_post_category( $post_id ) {
		if( !function_exists('fw_get_db_term_option') ) {
			return;
		}
		$post_categories = wp_get_post_categories( $post_id );
		if( isset($post_categories['0']) ) {
			$term_id = $post_categories['0'];
			$label_color = fw_get_db_term_option($term_id, 'category', 'label_color', '');
			$cat = get_category( $term_id );
			echo '<span style="color:'.$label_color.'">'.$cat->name.'</span>';
		}
	}
endif;


if ( ! function_exists( 'vispa_theme_get_post_view_type' ) ) :
	/**
	 * Display post image, video or audio
	 */
	function vispa_theme_get_post_view_type( $post_view_type, $post_id ) {
		$image = wp_get_attachment_url( get_post_thumbnail_id( $post_id ), 'post-thumbnails' );

		if ( $post_view_type['post_type'] == 'quote' ) {
			if ( ! empty( $image ) ): ?>
				<img alt="<?php the_title(); ?>" src="<?php echo esc_url( $image );?>" itemprop="image"/>
			<?php endif; ?>
			<!-- get post quote -->
			<?php if ( isset( $post_view_type['quote']['quote'] ) && ! empty( $post_view_type['quote']['quote'] ) ): ?>
				<a class="post-overlay-link" href="<?php echo esc_url( get_permalink( $post_id ) ) ?>">
					<div class="inner">
						<i class="fa fa-quote-right"></i>
						<blockquote itemprop="citation">
							<?php echo esc_html( $post_view_type['quote']['quote'] ); ?>
						</blockquote>
					</div>
				</a>
			<?php endif; ?>
		<?php } elseif ( $post_view_type['post_type'] == 'link' ) {
			if ( ! empty( $image ) ):?>
				<img alt="<?php the_title(); ?>" src="<?php echo esc_url( $image );?>" itemprop="image"/>
			<?php endif; ?>
			<!-- get post link -->
			<?php if ( isset( $post_view_type['link']['text'] ) && ! empty( $post_view_type['link']['text'] ) ): ?>
				<a class="post-overlay-link" href="<?php echo esc_url( $post_view_type['link']['link'] ) ?>" target="_blank">
					<div class="inner">
						<i class="fa fa-link"></i>
						<blockquote itemprop="citation">
							<?php echo esc_html( $post_view_type['link']['text'] ); ?>
						</blockquote>
					</div>
				</a>
			<?php endif; ?>
		<?php } elseif ( $post_view_type['post_type'] == 'audio' ) {
			if ( isset( $post_view_type['audio']['audio'] ) && ! empty( $post_view_type['audio']['audio'] ) ) {
				echo do_shortcode( $post_view_type['audio']['audio'] );
			} else {
				vispa_theme_show_default_post_image( $image, $post_id );
			}
		} elseif ( $post_view_type['post_type'] == 'video' ) {
			if ( isset( $post_view_type['video']['video'] ) && ! empty( $post_view_type['video']['video'] ) ) {
				preg_match( "#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $post_view_type['video']['video'], $video_id );

				if ( strpos( $post_view_type['video']['video'], '</iframe>' ) ) {
					vispa_theme_print( $post_view_type['video']['video'] );
				} elseif ( ! empty( $video_id ) ) {
					echo '<iframe itemprop="video" class="video-player" title="' . get_the_title( $post_id ) . '" src="http://www.youtube.com/embed/' . $video_id[0] . '" width="1920" height="1080" allowfullscreen></iframe>';
				} elseif ( strpos( $post_view_type['video']['video'], 'vimeo' ) ) {
					$video = preg_replace( '#https?://(www\.)?vimeo\.com/(\d+)#', '//player.vimeo.com/video/$2', $post_view_type['video']['video'] );

					echo '<iframe itemprop="video" class="video-player" title="' . get_the_title( $post_id ) . '" src="' . $video . '" width="1920" height="1080" allowfullscreen></iframe>';
				} else {
					vispa_theme_print( $post_view_type['video']['video'] );
				}
			} else {
				vispa_theme_show_default_post_image( $image, $post_id );
			}
		} elseif ( $post_view_type['post_type'] == 'slider' ) {
			if ( isset( $post_view_type['slider']['images'] ) && ! empty( $post_view_type['slider']['images'] ) ) { ?>
				<div class="owl-carousel post-slider">
					<?php foreach ( $post_view_type['slider']['images'] as $img ): ?>
						<?php $attachment_title = get_the_title( $img['attachment_id'] ); ?>
						<a class="swipebox" data-rel="gallery-<?php echo $post_id; ?>" href="<?php echo esc_url( $img['url'] ); ?>" title="<?php echo esc_attr( $attachment_title ); ?>">
							<img src="<?php echo esc_url( $img['url'] ); ?>" alt="<?php echo esc_attr( $attachment_title ); ?>" itemprop="image"/>
						</a>
					<?php endforeach; ?>
				</div>
			<?php
			} else {
				vispa_theme_show_default_post_image( $image, $post_id );
			}
		} else {
			vispa_theme_show_default_post_image( $image, $post_id );
		}
	}
endif;


if ( ! function_exists( 'vispa_theme_show_default_post_image' ) ) :
	/**
	 * Display default post image
	 */
	function vispa_theme_show_default_post_image( $image, $post_id ) {
		if ( ! empty( $image ) ) :
			$attachment_title = get_the_title( get_post_thumbnail_id( $post_id ) );
			?>
			<img alt="<?php the_title(); ?>" src="<?php echo esc_url( $image );?>" itemprop="image" />
			<!-- get post swipebox -->
			<div class="links">
				<a class="swipebox icon-search" data-rel="gallery" href="<?php echo esc_url( $image );?>" title="<?php echo esc_attr( $attachment_title );?>"></a>
				<a href="<?php echo esc_url( get_permalink( $post_id ) )?>" itemprop="url" class="icon-eye"></a>
			</div>
		<?php endif;
	}
endif;


if ( ! function_exists( 'vispa_include_file_from_child' ) ) :
	/**
	 * Include a file first from child if exist else from parent
	 * a file from url (example url/logo.png)
	 */
	function vispa_include_file_from_child( $file ) {
		if ( file_exists( get_stylesheet_directory() . $file ) ) {
			return get_stylesheet_directory_uri() . $file;
		} else {
			return get_template_directory_uri() . $file;
		}
	}
endif;


if ( ! function_exists( 'vispa_get_youtube_id' ) ) :
	/**
	 * Return the youtube video id
	 */
	function vispa_get_youtube_id( $youtubeUrl ) {
		$link = parse_url( $youtubeUrl );
		parse_str( $link['query'], $qs );
		if ( isset ( $qs['v'] ) && $qs['v'] != '' ) {
			$youtubeId = $qs['v'];
		} elseif ( isset( $link['path'] ) ) {
			$pattern = '/src="([^"]+)"/';
			preg_match( $pattern, $link['path'], $matches );
			$pos       = strpos( $matches[1], 'youtube.com/embed/' );
			$youtubeId = substr( $matches[1], $pos + 18 );
		} else {
			$youtubeId = '';
		}

		return $youtubeId;
	}
endif;


if ( ! function_exists( 'vispa_theme_post_meta' ) ) :
	/**
	 * Display post meta
	 */
	function vispa_theme_post_meta() { ?>
		<?php
		global $post;
		$vispa_post_date       = ( defined( 'FW' ) ) ? fw_get_db_settings_option( 'enable-post-date' ) : 'yes';
		$vispa_post_categories = ( defined( 'FW' ) ) ? fw_get_db_settings_option( 'enable-post-categories' ) : 'yes';
		$vispa_post_author     = ( defined( 'FW' ) ) ? fw_get_db_settings_option( 'enable-post-author' ) : 'yes';
		$vispa_post_comments   = ( defined( 'FW' ) ) ? fw_get_db_settings_option( 'enable-post-comments' ) : 'yes';
		?>
		<div class="post-meta">
			<!--show post date-->
			<?php if ( $vispa_post_date == 'yes' ): ?>
				<time class="post-date" datetime="<?php the_time( 'c' ); ?>" itemprop="dateCreated"><?php echo esc_html( get_the_date() ); ?></time>
			<?php endif; ?>
			<!--show post category-->
			<?php if ( $vispa_post_categories == 'yes' ): ?>
				<?php $vispa_post_categories = wp_get_post_categories( $post->ID );
				if ( ! empty( $vispa_post_categories ) ) {
					echo '<span class="post-category" itemprop="keywords">'.esc_html__('in', 'vispa').' ';
					$vispa_cats = "";
					foreach ( $vispa_post_categories as $vispa_c ) {
						$vispa_cat = get_category( $vispa_c );
						$vispa_cats .= '<a class="link-orange" href="' . esc_url( get_category_link( $vispa_cat->term_id ) ) . '">' . esc_html( $vispa_cat->name ) . '</a>, ';
					}

					echo substr( $vispa_cats, 0, strlen( $vispa_cats ) - 2 );
					echo '</span>';
				} ?>
			<?php endif; ?>
			<!--show post author-->
			<?php if ( $vispa_post_author == 'yes' ): ?>
				<span class="post-author" itemprop="author"><?php esc_html_e( 'by', 'vispa' ); ?>
					<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
						<?php echo esc_html( get_the_author() ); ?>
					</a>
			</span>
			<?php endif; ?>
			<?php // If comments are open, load up the comment template.
			if ( $vispa_post_comments == 'yes' && ( comments_open() || get_comments_number() ) ) { ?>
				<a href="<?php echo esc_url( the_permalink() ) ?>#comments" class="post-comments">
				<span itemprop="commentCount"><?php comments_number( 0, 1, '%' ); ?></span> <?php comments_number( esc_html__( 'comments', 'vispa' ), esc_html__( 'comment', 'vispa' ), esc_html__( 'comments', 'vispa' ) ); ?>
				</a>
			<?php } ?>
		</div>
	<?php }
endif;


if ( ! function_exists( 'vispa_theme_share_post' ) ) :
	/**
	 * Display share buttons
	 */
	function vispa_theme_share_post() {
		$vispa_permalink = get_permalink(); ?>
		<ul class="post-share">
			<li>
				<a href="https://www.facebook.com/sharer/sharer.php?m2w&u=<?php echo esc_url( $vispa_permalink ); ?>" onclick="javascript:void window.open('https://www.facebook.com/sharer/sharer.php?m2w&u=<?php echo esc_url( $vispa_permalink ); ?>','1410949501326','width=700,height=500,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');return false;" class="fa fa-facebook"></a></li>
			<li><a href="http://twitter.com/home/?status=<?php echo esc_url( $vispa_permalink ); ?>" onclick="javascript:void window.open('https://twitter.com/share?status=<?php echo esc_url( $vispa_permalink ); ?>&text=<?php the_title(); ?>','1410949501326','width=700,height=500,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');return false;" class="fa fa-twitter"></a></li>
			<li>
				<a href="http://pinterest.com/pin/create/button/?url=<?php echo esc_url( $vispa_permalink ); ?>" onclick="javascript:void window.open('http://www.pinterest.com/pin/create/button/?url=<?php echo esc_url( $vispa_permalink ); ?>&description=<?php the_title(); ?>','1410949501326','width=700,height=500,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');return false;" class="fa fa-pinterest"></a></li>
			<li>
				<a href="https://www.tumblr.com/share/link?url=<?php echo esc_url( $vispa_permalink ); ?>" class="fa fa-tumblr" onclick="javascript:void window.open('https://www.tumblr.com/share/link?url=<?php echo esc_url( $vispa_permalink ); ?>/&name=<?php the_title(); ?>','1410949501326','width=700,height=500,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');return false;"></a>
			</li>
			<li>
				<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_url( $vispa_permalink ); ?>" onclick="javascript:void window.open('https://www.linkedin.com/shareArticle?title=<?php the_title(); ?>=true&url=<?php echo esc_url( $vispa_permalink ); ?>','1410949501326','width=700,height=500,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');return false;" class="fa fa-linkedin"></a></li>
			<li><a href="https://plus.google.com/share?url=<?php echo esc_url( $vispa_permalink ); ?>" onclick="javascript:void window.open('https://plus.google.com/share?url=<?php echo esc_url( $vispa_permalink ); ?>','1410949501326','width=700,height=500,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');return false;" class="fa fa-google-plus"></a></li>
		</ul>
	<?php }
endif;


if ( ! function_exists( 'vispa_related_posts' ) ) :
	/**
	 * Return post related articles
	 */
	function vispa_related_posts() {
		global $post;
		$taxonomy   = 'post_tag';
		$post_terms = array();
		$terms      = wp_get_post_terms( $post->ID, $taxonomy );
		if ( ! empty( $terms ) ) {
			foreach ( $terms as $term ) {
				$post_terms[] = $term->term_id;
			}
		} else {
			// if post have 0 tags
			$taxonomy = 'category';
			$terms    = wp_get_post_terms( $post->ID, $taxonomy );
			if ( ! empty( $terms ) ) {
				foreach ( $terms as $term ) {
					$post_terms[] = $term->term_id;
				}
			}
		}

		$sidebar_position = function_exists( 'fw_ext_sidebars_get_current_position' ) ? fw_ext_sidebars_get_current_position() : 'right';
		$posts_per_page   = ( $sidebar_position == 'right' || $sidebar_position == 'left' ) ? 2 : 3;
		$args = array(
			'posts_per_page' => $posts_per_page,
			'orderby'        => 'date',
			'post_status'    => 'publish',
			'post_type'      => 'post',
			'post__not_in'   => array( $post->ID ),
			'tax_query'      => array(
				array(
					'taxonomy' => $taxonomy,
					'field'    => 'id',
					'terms'    => $post_terms
				),
			)
		);

		$all_posts = new WP_Query( $args );

		return $all_posts->posts;
	}
endif;


if( ! function_exists( 'vispa_responsive_heading_styles' ) ) :
	/**
	 * return text size styles
	 *
	 * @param array $atts
	 */
	function vispa_responsive_heading_styles( $atts = array( 'styles' => array(), 'selector' => '', 'important' => false ) ) {
		$return_html = $important = '';
		if( isset($atts['important']) && $atts['important'] ) {
			$important = ' !important';
		}

		if( !empty($atts['styles']) && !empty($atts['selector']) ) {
			$atts['styles']['size'] = (int) $atts['styles']['size'];
			$atts['styles']['line-height'] = (int) $atts['styles']['line-height'];
			if ( $atts['styles']['size'] >= 20 && $atts['styles']['size'] <= 25 ) {
				$return_html .= $atts['selector'] . '{font-size: ' . round( $atts['styles']['size'] * 0.9, 0 ) . 'px ' . $important . '; line-height: ' . round( $atts['styles']['line-height'] * 0.9, 0 ) . 'px ' . $important . ';}';
			} elseif ( $atts['styles']['size'] >= 26 && $atts['styles']['size'] <= 30 ) {
				$return_html .= $atts['selector'] . '{font-size: ' . round( $atts['styles']['size'] * 0.8, 0 ) . 'px ' . $important . '; line-height: ' . round( $atts['styles']['line-height'] * 0.8, 0 ) . 'px ' . $important . ';}';
			} elseif ( $atts['styles']['size'] >= 31 && $atts['styles']['size'] <= 45 ) {
				$return_html .= $atts['selector'] . '{font-size: ' . round( $atts['styles']['size'] * 0.7, 0 ) . 'px ' . $important . '; line-height: ' . round( $atts['styles']['line-height'] * 0.7, 0 ) . 'px ' . $important . ';}';
			} elseif ( $atts['styles']['size'] >= 46 && $atts['styles']['size'] <= 65 ) {
				$return_html .= $atts['selector'] . '{font-size: ' . round( $atts['styles']['size'] * 0.6, 0 ) . 'px ' . $important . '; line-height: ' . round( $atts['styles']['line-height'] * 0.6, 0 ) . 'px ' . $important . ';}';
			} elseif ( $atts['styles']['size'] >= 66 && $atts['styles']['size'] <= 80 ) {
				$return_html .= $atts['selector'] . '{font-size: ' . round( $atts['styles']['size'] * 0.5, 0 ) . 'px ' . $important . '; line-height: ' . round( $atts['styles']['line-height'] * 0.5, 0 ) . 'px ' . $important . ';}';
			} elseif ( $atts['styles']['size'] >= 81 && $atts['styles']['size'] <= 100 ) {
				$return_html .= $atts['selector'] . '{font-size: ' . round( $atts['styles']['size'] * 0.4, 0 ) . 'px ' . $important . '; line-height: ' . round( $atts['styles']['line-height'] * 0.4, 0 ) . 'px ' . $important . ';}';
			} elseif ( $atts['styles']['size'] > 100 ) {
				$return_html .= $atts['selector'] . '{font-size: ' . round( $atts['styles']['size'] * 0.3, 0 ) . 'px ' . $important . '; line-height: ' . round( $atts['styles']['line-height'] * 0.3, 0 ) . 'px ' . $important . ';}';
			}
		}

		return $return_html;
	}
endif;


if ( ! function_exists( 'vispa_get_shortcode_advanced_styles' ) ) :
	/**
	 * Get shortcode advanced styles
	 *
	 * @param array $style
	 * @param array $atts
	 */
	function vispa_get_shortcode_advanced_styles( $style, $atts = array( 'custom_meta' => '' ) ) {
		$advanced_styles = '';
		global $google_fonts_list;
		if ( isset( $style['google_font'] ) && ( $style['google_font'] === true || $style['google_font'] === 'true' ) ) {
			// is google font

			$google_fonts = fw_get_google_fonts();

			// font style
			if ( strpos( $style['variation'], 'italic' ) !== false ) {
				$advanced_styles .= 'font-style: italic; ';
			} elseif ( strpos( $style['variation'], 'oblique' ) !== false ) {
				$advanced_styles .= 'font-style: oblique; ';
			} else {
				$advanced_styles .= 'font-style: normal; ';
			}

			// font weight
			$advanced_styles .= ( intval( $style['variation'] ) == 0 ) ? 'font-weight:400; ' : 'font-weight:' . intval( $style['variation'] ) . '; ';

			// save google font array in a global variable
			$google_fonts_list[ $style['family'] ]['variation'][ $style['variation'] ] = $style['variation'];
			$google_fonts_list[ $style['family'] ]['subset'][ $style['subset'] ]       = $style['subset'];

			// include and italic variation for font if current font has, because user can use <em> tag
			$italic_variation = ($style['variation'] == 'regular') ? $italic_variation = "italic" : $style['variation'] . "italic";
			if ( in_array( $italic_variation, $google_fonts[ $style['family'] ]['variants'] ) ) {
				$google_fonts_list[ $style['family'] ]['variation'][ $italic_variation ] = $italic_variation;
			}

			if ( isset( $atts['custom_meta'] ) && ! empty( $atts['custom_meta'] ) ) {
				// save google font in a custom meta
				update_option( $atts['custom_meta'], $google_fonts_list );
			}
		} else {
			// is simple font
			$advanced_styles .= ( isset( $style['style'] ) && ! empty( $style['style'] ) ) ? 'font-style:' . esc_attr( $style['style'] ) . '; ' : '';
			$advanced_styles .= isset( $style['weight'] ) ? 'font-weight:' . esc_attr( $style['weight'] ) . '; ' : '';
		}

		$advanced_styles .= ( isset( $style['family'] ) && ! empty( $style['family'] ) ) ? 'font-family:' . esc_attr( $style['family'] ) . '; ' : '';
		$advanced_styles .= ! empty( $style['line-height'] ) ? is_numeric( $style['line-height'] ) ? 'line-height:' . esc_attr( $style['line-height'] ) . 'px; ' : 'line-height:' . esc_attr( $style['line-height'] ) . '; ' : '';
		$advanced_styles .= ! empty( $style['size'] ) ? is_numeric( $style['size'] ) ? 'font-size:' . esc_attr( $style['size'] ) . 'px; ' : 'font-size:' . esc_attr( $style['size'] ) . '; ' : '';
		$advanced_styles .= is_numeric( $style['letter-spacing'] ) ? 'letter-spacing:' . esc_attr( $style['letter-spacing'] ) . 'px; ' : '';
		$advanced_styles .= ! empty($style['color']) ? 'color:' . esc_attr( $style['color'] ) . ';' : '';

		return $advanced_styles;
	}
endif;


