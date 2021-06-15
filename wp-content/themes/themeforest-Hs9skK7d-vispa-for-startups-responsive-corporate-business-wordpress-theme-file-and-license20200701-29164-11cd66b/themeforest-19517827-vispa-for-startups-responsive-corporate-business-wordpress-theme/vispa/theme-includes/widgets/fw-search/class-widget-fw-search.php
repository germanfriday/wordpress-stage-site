<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

class Vispa_Widget_Fw_Search extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'description' => esc_html__( 'A search form for your site.', 'vispa' ) );

		parent::__construct( false, esc_html__( 'Fly Search', 'vispa' ), $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$params = array();

		foreach ( $instance as $key => $value ) {
			$params[ $key ] = $value;
		}

		$before_widget = '<div class="widget widget-search">';
		$after_widget  = '</div>';

		$filepath = get_template_directory() . '/theme-includes/widgets/fw-search/views/widget.php';

		$data = array(
			'instance'      => $params,
			'title'         => $params['title'],
			'before_widget' => $before_widget,
			'after_widget'  => $after_widget,
		);

		echo fw_render_view( $filepath, $data );
	}

	function update( $new_instance, $old_instance ) {
		$instance          = wp_parse_args( (array) $new_instance, $old_instance );
		$instance['title'] = $new_instance['title'];

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title    = esc_attr( $instance['title'] );
		?>

		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'vispa' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text"
			       value="<?php echo esc_attr( $title ); ?>"/>
		</p>
	<?php
	}
}


