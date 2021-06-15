<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

class Vispa_Theme_Includes {
	private static $rel_path = null;

	private static $initialized = false;

	public static function init() {
		if ( self::$initialized ) {
			return;
		} else {
			self::$initialized = true;
		}

		/**
		 * Both frontend and backend
		 */
		{
			self::include_child_first( '/helpers.php' );
			self::include_child_first( '/hooks.php' );
			self::include_all_child_first( '/includes' );

			add_action( 'init', array( __CLASS__, '_action_init' ) );
			add_action( 'widgets_init', array( __CLASS__, '_action_widgets_init' ) );
		}

		/**
		 * Only frontend
		 */
		if ( ! is_admin() ) {
			add_action( 'wp_enqueue_scripts', array( __CLASS__, '_action_enqueue_scripts' ),
				20 // Include later to be able to make wp_dequeue_style|script()
			);
		}
	}

	private static function get_rel_path( $append = '' ) {
		if ( self::$rel_path === null ) {
			self::$rel_path = '/theme-includes';
		}

		return self::$rel_path . $append;
	}

	private static function include_all_child_first( $dir_rel_path ) {
		$paths = array();

		if ( is_child_theme() ) {
			$paths[] = self::get_child_path( $dir_rel_path );
		}

		$paths[] = self::get_parent_path( $dir_rel_path );

		foreach ( $paths as $path ) {
			if( ! is_dir( $path ) ) {
				continue;
			}

			if ( $files = scandir( $path ) ) {
				foreach ( $files as $file ) {
					if ( $file == '.' || $file == '..' ) {
						continue;
					}
					self::include_isolated( $path . '/' . $file );
				}
			}
		}
	}

	/**
	 * @param string $dirname 'foo-bar'
	 *
	 * @return string 'Foo_Bar'
	 */
	private static function dirname_to_classname( $dirname ) {
		$class_name = explode( '-', $dirname );
		$class_name = array_map( 'ucfirst', $class_name );
		$class_name = implode( '_', $class_name );

		return $class_name;
	}

	public static function get_parent_path( $rel_path ) {
		return get_template_directory() . self::get_rel_path( $rel_path );
	}

	public static function get_child_path( $rel_path ) {
		if ( ! is_child_theme() ) {
			return null;
		}

		return get_stylesheet_directory() . self::get_rel_path( $rel_path );
	}

	public static function include_isolated( $path ) {
		include $path;
	}

	public static function include_child_first( $rel_path ) {
		if ( is_child_theme() ) {
			$path = self::get_child_path( $rel_path );

			if ( file_exists( $path ) ) {
				self::include_isolated( $path );
			}
		}

		{
			$path = self::get_parent_path( $rel_path );

			if ( file_exists( $path ) ) {
				self::include_isolated( $path );
			}
		}
	}

	/**
	 * @internal
	 */
	public static function _action_enqueue_scripts() {
		self::include_child_first( '/static.php' );
	}

	/**
	 * @internal
	 */
	public static function _action_init() {
		self::include_child_first( '/menus.php' );
		self::include_child_first( '/posts.php' );
	}

	/**
	 * @internal
	 */
	public static function _action_widgets_init() {
		{
			$paths = array();

			if ( is_child_theme() ) {
				$paths[] = self::get_child_path( '/widgets' );
			}

			$paths[] = self::get_parent_path( '/widgets' );
		}

		$included_widgets = array();

		foreach ( $paths as $path ) {
			if ( ! is_dir( $path ) ) {
				continue;
			}
			$dirs = scandir( $path );

			if ( ! $dirs ) {
				continue;
			}

			foreach ( $dirs as $dir ) {
				if ($dir == '.' || $dir == '..' ) {
					continue;
				}
				$dirname = basename( $dir );

				if ( isset( $included_widgets[ $dirname ] ) ) {
					// this happens when a widget in child theme wants to overwrite the widget from parent theme
					continue;
				} else {
					$included_widgets[ $dirname ] = true;
				}

				self::include_isolated( $path . '/' .$dir . '/class-widget-' . $dirname . '.php' );

				register_widget( 'Vispa_Widget_' . self::dirname_to_classname( $dirname ) );
			}
		}
	}
}

Vispa_Theme_Includes::init();


if ( ! function_exists( 'fw_additional_enqueue_scripts' ) ):

	add_action( 'admin_enqueue_scripts', 'fw_additional_enqueue_scripts' );
	function fw_additional_enqueue_scripts() {
		$template_directory_uri = get_template_directory_uri();
		$vispa_version = defined('FW') ? fw()->theme->manifest->get_version() : '1.0';

		if ( is_admin() ) {
			wp_enqueue_script(
				'vispa-admin-js',
				esc_url( $template_directory_uri . '/assets/js/admin.js' ),
				array( 'jquery' ),
				$vispa_version,
				true
			);

			wp_enqueue_style(
				'vispa-admin-css',
				esc_url( $template_directory_uri . '/assets/css/admin.css' ),
				array(),
				$vispa_version
			);
		}
	}
endif;

