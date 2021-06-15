<?php if ( ! defined( 'ABSPATH' ) ) {
	die( esc_html__( 'Direct access forbidden.', 'vispa' ) );
}

class Vispa_Widget_FW_Posts extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'description' => esc_html__( "Popular/Recent Posts.", 'vispa' ) );

		parent::__construct( false, esc_html__( 'Fly Popular/Recent Posts', 'vispa' ), $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$params = array();

		foreach ( $instance as $key => $value ) {
			$params[ $key ] = $value;
		}

		$filepath = get_template_directory() . '/theme-includes/widgets/fw-posts/views/widget.php';

		$data = array(
			'instance'      => $params,
			'before_widget' => '<div class="widget fw-widget-posts tabs ">',
			'after_widget'  => '</div>',
		);

		echo fw_render_view( $filepath, $data );
	}

	function update( $new_instance, $old_instance ) {
		$instance                 = wp_parse_args( (array) $new_instance, $old_instance );
		$instance['posts_number'] = $new_instance['posts_number'];
		$instance['display_date'] = isset( $new_instance['display_date'] );

		return $instance;
	}

	function form( $instance ) {
		$instance   = wp_parse_args( (array) $instance, array(
			'posts_number' => 5,
			'days'         => 'all_time',
			'category'     => 'all_categories'
		) );
		$args       = array(
			'orderby' => 'name',
			'order'   => 'ASC',
		);
		$categories = get_categories( $args );
		?>
		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'posts_number' ) ); ?>"><?php esc_html_e( 'Number of Posts to Show:', 'vispa' ); ?></label>
			<input size="3" style="width: 45px;" class="widefat"
			       id="<?php echo esc_attr( $this->get_field_id( 'posts_number' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'posts_number' ) ); ?>" type="text"
			       value="<?php echo esc_attr( $instance['posts_number'] ); ?>"/>
		</p>
		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'days' ) ); ?>"><?php esc_html_e( 'Select Days:', 'vispa' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'days' ) ); ?>"
			        id="<?php echo esc_attr( $this->get_field_id( 'days' ) ); ?>" class="widefat">
				<option
					value="" <?php selected( $instance['days'], '' ); ?>><?php esc_html_e( 'All time', 'vispa' ); ?></option>
				<option
					value="7" <?php selected( $instance['days'], '7' ); ?>><?php esc_html_e( '1 Week', 'vispa' ); ?></option>
				<option
					value="30" <?php selected( $instance['days'], '30' ); ?>><?php esc_html_e( '1 Month', 'vispa' ); ?></option>
				<option
					value="90" <?php selected( $instance['days'], '90' ); ?>><?php esc_html_e( '3 Month', 'vispa' ); ?></option>
				<option
					value="180" <?php selected( $instance['days'], '180' ); ?>><?php esc_html_e( '6 Month', 'vispa' ); ?></option>
				<option
					value="360" <?php selected( $instance['days'], '360' ); ?>><?php esc_html_e( '1 Year', 'vispa' ); ?></option>
			</select>
		</p>
		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>"><?php esc_html_e( 'Select Category:', 'vispa' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'category' ) ); ?>"
			        id="<?php echo esc_attr( $this->get_field_id( 'type' ) ); ?>" class="widefat">
				<option
					value="" <?php selected( $instance['category'], '' ); ?>><?php esc_html_e( 'All Categories', 'vispa' ); ?></option>
				<?php foreach ( $categories as $category ) { ?>
					<option
						value="<?php echo esc_attr( $category->term_id ); ?>" <?php selected( $instance['category'], $category->term_id ); ?>><?php echo esc_html( $category->name ); ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<input id="<?php echo esc_attr( $this->get_field_id( 'display_date' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'display_date' ) ); ?>"
			       type="checkbox" <?php checked( isset( $instance['display_date'] ) ? $instance['display_date'] : 0 ); ?> />
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'display_date' ) ); ?>"><?php esc_html_e( 'Display Date?', 'vispa' ); ?></label>
		</p>
	<?php
	}
}