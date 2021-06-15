<?php
/**
 /**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function mifo_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'mifo' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'mifo' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Off Canvas Sidebar', 'mifo' ),
		'id'            => 'sidebarcanvas-1',
		'description'   => esc_html__( 'Add widgets here.', 'mifo' ),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );


 	register_sidebar( array(
			'name' => __( 'Footer One Widget Area', 'mifo' ),
			'id' => 'footer1',
			'description' => __( 'Add Text widgets area', 'mifo' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="footer-title">',
			'after_title' => '</h3>'
	) ); 		 				

	 register_sidebar( array(
			'name' => __( 'Footer Two Widget Area', 'mifo' ),
			'id' => 'footer2',
			'description' => __( 'Add text box widgets area', 'mifo' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="footer-title">',
			'after_title' => '</h3>'
	) ); 
	 register_sidebar( array(
			'name' => __( 'Footer Three Widget Area', 'mifo' ),
			'id' => 'footer3',
			'description' => __( 'Add text box widgets area', 'mifo' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="footer-title">',
			'after_title' => '</h3>'
	) ); 
				
}
add_action( 'widgets_init', 'mifo_widgets_init' );