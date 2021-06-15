<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}


if ( ! function_exists( 'vispa_theme_ext_portfolio_get_gallery_images' ) ) :
	/**
	 * Get gallery images
	 *
	 * @param integer $post_id
	 */
	function vispa_theme_ext_portfolio_get_gallery_images( $post_id = 0 ) {
		if ( 0 === $post_id && null === ( $post_id = get_the_ID() ) ) {
			return array();
		}

		$options = get_post_meta( $post_id, 'fw_options', true );

		return isset( $options['project-gallery'] ) ? $options['project-gallery'] : array();
	}
endif;


if ( ! function_exists( 'vispa_theme_portfolio_post_taxonomies' ) ) :
	/**
	 * Return portfolio post taxonomies
	 *
	 * @param integer $post_id
	 * @param boolean $return
	 */
	function vispa_theme_portfolio_post_taxonomies( $post_id, $return = false ) {

		$taxonomy = 'fw-portfolio-category';
		$terms    = wp_get_post_terms( $post_id, $taxonomy );
		$list     = '';
		$checked  = false;
		foreach ( $terms as $term ) {
			if ( $term->parent == 0 ) {
				// if is checked parent category
				$list .= $term->slug . ' ';
				$checked = true;
			} else {
				$list .= $term->slug . ' ';
				$parent_id = $term->parent;
			}
		}

		if ( ! $checked ) {
			// if is not checked parent category extract this parent
			if ( isset( $parent_id ) ) {
				$term = get_term_by( 'id', $parent_id, $taxonomy );
				$list .= $term->slug . ' ';
			}
		}

		if ( $return ) {
			return $list;
		} else {
			echo do_shortcode( $list );
		}
	}
endif;


if ( ! function_exists( 'vispa_theme_portfolio_post_terms' ) ) :
	/**
	 * Return portfolio post terms
	 *
	 * @param integer $post_id
	 * @param boolean $return
	 */
	function vispa_theme_portfolio_post_terms( $post_id, $return = false ) {
		$tax   = 'fw-portfolio-category';
		$terms = wp_get_post_terms( $post_id, $tax );
		$list  = '';
		foreach ( $terms as $term ) {
			$label_color = fw_get_db_term_option($term->term_id, $tax, 'label_color', '#ef7280');
			$list .= '<span class="label label-fill" style="background-color: '.$label_color.'">' . $term->name . '</span>';
		}

		if ( $return ) {
			return $list;
		} else {
			echo do_shortcode( $list );
		}
	}
endif;


if ( ! function_exists( 'vispa_theme_portfolio_filter' ) ) :
	function vispa_theme_portfolio_filter( $filter_enabled, $_permalink = false, $term_id_shortcode = 0 ) {
		/**
		 * Display portfolio filter
		 *
		 * @param boolean $filter_enabled
		 */
		if ( $filter_enabled == 'yes' ) {

			if ( $term_id_shortcode == 0 ) {
				$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			} else {
				$term = get_term( $term_id_shortcode, 'fw-portfolio-category' );
			}

			if ( ! $term ) {
				return;
			}
			$taxonomy = $term->taxonomy;
			$term_id  = $term->term_id;
			$children = get_term_children( $term_id, $taxonomy );
			if ( empty( $children ) ) {
				//return; // if current term hasn't children - don't show filter
			}
			$template_slug   = $term->slug;
			$template_parent = $term->parent;
			$args            = array( 'taxonomy' => $taxonomy );
			$terms           = get_terms( $taxonomy, $args );
			$count           = count( $terms );
			$i               = 0;
			if ( $template_parent == 0 ) {
				$template_parent = $term_id;
			}
			$permalink = '#';

			$class_isotope = 'isotope-filter';
			if( $_permalink ) {
				$class_isotope = '';
			}
			echo '<div class="portfolio-filter '.$class_isotope.'" data-label="' . esc_html__( 'filter', 'vispa' ) . '">
                <ul class="clearfix">';
			if ( $count > 0 ) {
				$term_list = $term_view_all = '';
				foreach ( $terms as $term ) {
					if ( $term->count == 0 ) {
						continue;
					}

					$data_category = is_tax() ? '' : 'data-category="' . $term->slug . '"';

					$i ++;
					if ( $template_parent != $term->parent ) {
						if ( $term->slug == $template_slug ) {
							if ( $_permalink ) {
								$permalink = get_term_link( $term->slug, $taxonomy );
							}
							$term_view_all .= '<li class="active" ' . $data_category . ' ><a href="' . $permalink . '">' . esc_html__( 'All', 'vispa' ) . '</a></li>' . "\n";
						} elseif ( $template_parent == $term->term_id ) {
							if ( $_permalink ) {
								$permalink = get_term_link( $term->slug, $taxonomy );
							}
							$term_view_all .= '<li ' . $data_category . '><a href="' . $permalink . '">' . esc_html__( 'All', 'vispa' ) . '</a></li>' . "\n";
						}
					} elseif ( $template_parent == $term->parent ) {
						if ( $term->slug == $template_slug ) {
							if ( $_permalink ) {
								$permalink = get_term_link( $term->slug, $taxonomy );
							}
							$term_list .= '<li class="active" ' . $data_category . '><a href="' . esc_url( $permalink ) . '">' . esc_html( $term->name ) . '</a></li>' . "\n";
						} else {
							if ( $_permalink ) {
								$permalink = get_term_link( $term->slug, $taxonomy );
							}
							$term_list .= '<li ' . $data_category . '><a href="' . esc_url( $permalink ) . '">' . esc_html( $term->name ) . '</a></li>' . "\n";
						}
					}
				}
				echo do_shortcode( $term_view_all . $term_list );
			}
			echo '</ul></div>';
		}
	}
endif;


