<?php
class jwstheme_Testimonial_Widget extends jwstheme_Widget {
	function __construct() {
		parent::__construct(
			'testimonial_slider', // Base ID
			__('Testimonial ', 'kloud'), // Name
			array('description Silider' => __('Display testimonial slider .', 'kloud'),) // Args
        );
		$this->settings           = array(
            'title'  => array(
				'type'  => 'text',
				'std'   => __( 'Post List', 'kloud' ),
				'label' => __( 'Title', 'kloud' )
			),
			'posts_per_page' => array(
				'type'  => 'number',
				'step'  => 1,
				'min'   => 1,
				'max'   => '',
				'std'   => 3,
				'label' => __( 'Number of posts to show', 'kloud' )
			),
			'orderby' => array(
				'type'  => 'select',
				'std'   => 'none',
				'label' => __( 'Order by', 'kloud' ),
				'options' => array(
					'none'   => __( 'None', 'kloud' ),
					'comment_count'  => __( 'Comment Count', 'kloud' ),
					'title'  => __( 'Title', 'kloud' ),
					'date'   => __( 'Date', 'kloud' ),
					'ID'  => __( 'ID', 'kloud' ),
				)
			),
			'order' => array(
				'type'  => 'select',
				'std'   => 'none',
				'label' => __( 'Order', 'kloud' ),
				'options' => array(
					'none'  => __( 'None', 'kloud' ),
					'asc'  => __( 'ASC', 'kloud' ),
					'desc' => __( 'DESC', 'kloud' ),
				)
			),
            'testimonial_category' => array(
				'type'   => 'bt_taxonomy',
				'std'    => '',
				'label'  => __( 'Categories', 'kloud' ),
			),
			'el_class'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Extra Class', 'kloud' )
			)
		);
		add_action('admin_enqueue_scripts', array($this, 'widget_scripts'));
	}
	function widget_scripts() {
		wp_enqueue_script('widget_scripts', URI_PATH . '/framework/widgets/widgets.js');
	}
	function widget( $args, $instance ) {
		ob_start();
		global $post;
		extract( $args );
		$title                  = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$testimonial_category              = isset($instance['testimonial_category'])? $instance['testimonial_category'] : '';
		$posts_per_page         = absint( $instance['posts_per_page'] );
		$orderby                = sanitize_title( $instance['orderby'] );
		$order                  = sanitize_title( $instance['order'] );
		$layout                 = sanitize_title( $instance['layout'] );
		$el_class               = sanitize_title( $instance['el_class'] );
		echo ''.$before_widget;
		if ( $title )
				echo ''.$before_title . $title . $after_title;
		$query_args = array(
			'posts_per_page' => $posts_per_page,
			'orderby' => $orderby,
			'order' => $order,
			'post_type' => 'testimonial',
			'post_status' => 'publish');
		if (isset($testimonial_category) && $testimonial_category != '') {
			$cats = explode(',', $testimonial_category);
			$testimonial_category = array();
			foreach ((array) $cats as $cat) :
			$testimonial_category[] = trim($cat);
			endforeach;
			$query_args['tax_query'] = array(
									array(
										'taxonomy' => 'testimonial_category',
										'field' => 'id',
										'terms' => $testimonial_category
									)
							);
		}
		$wp_query = new WP_Query($query_args);                
		if ($wp_query->have_posts()){
			?>
			<ul class=" testimonial-owl <?php echo esc_attr( $layout ); ?>">
				<?php 
				while ($wp_query->have_posts()) { 
					$wp_query->the_post(); 
                    ?> <li class="item"> <div class="top-content"><?php 
                        the_excerpt();
                        ?></div><div class="bottom-content"><?php
			            ?> <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5> <?php     
                        echo '<p>'.get_post_meta(get_the_ID(),'tb_testimonial_company',true).'</p>';
                        ?></div>
	                   </li> <?php
                } 
				?>
			</ul>
		<?php 
		}
		wp_reset_postdata();
		echo ''.$after_widget;
		$content = ob_get_clean();
		echo ''.$content;
	}
}
/* Class jwstheme_Post_List_Widget */
function jwstheme_testimonial_widget() {
    insert_widgets('jwstheme_Testimonial_Widget');
}
add_action('widgets_init', 'jwstheme_testimonial_widget');