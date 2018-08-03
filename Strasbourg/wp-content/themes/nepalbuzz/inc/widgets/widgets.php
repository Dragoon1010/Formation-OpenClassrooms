<?php
/**
 * The template for adding Custom Sidebars and Widgets
 *
 * @package NepalBuzz
 */

/**
 * Register widgetized area
 *
 * @since NepalBuzz 0.1
 */
function nepalbuzz_widgets_init() {
	//Primary Sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Primary Sidebar', 'nepalbuzz' ),
		'id'            => 'primary-sidebar',
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget'  => '</div><!-- .widget-wrap --></section><!-- .widget -->',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
		'description'	=> esc_html__( 'This is the primary sidebar if you are using a two or three column site layout option.', 'nepalbuzz' ),
	) );

	//Secondary Sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Secondary Sidebar', 'nepalbuzz' ),
		'id'            => 'secondary-sidebar',
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget'  => '</div><!-- .widget-wrap --></section><!-- .widget -->',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
		'description'	=> esc_html__( 'This is the secondary sidebar if you are using a three column site layout option.', 'nepalbuzz' ),
	) );

	$footer_sidebar_number = 3; //Number of footer sidebars

	for( $i=1; $i <= $footer_sidebar_number; $i++ ) {
		register_sidebar( array(
			'name'          => sprintf( esc_html__( 'Footer Area %d', 'nepalbuzz' ), $i ),
			'id'            => sprintf( 'footer-%d', $i ),
			'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
			'after_widget'  => '</div><!-- .widget-wrap --></section><!-- .widget -->',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
			'description'	=> sprintf( esc_html__( 'Footer %d widget area.', 'nepalbuzz' ), $i ),
		) );
	}
}
add_action( 'widgets_init', 'nepalbuzz_widgets_init' );

/**
 * Loads up Necessary JS Scripts for widgets
 *
 * @since NepalBuzz 0.1
 */
function nepalbuzz_widgets_scripts( $hook) {
	if ( 'widgets.php' == $hook ) {
		wp_enqueue_style( 'nepalbuzz-widgets-styles', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'css/widgets.css' );
	}
}
add_action( 'admin_enqueue_scripts', 'nepalbuzz_widgets_scripts' );

// Load Featured Post Widget
include trailingslashit( get_template_directory() ) . 'inc/widgets/recent-posts.php';

// Load Social Icon Widget
include trailingslashit( get_template_directory() ) . 'inc/widgets/social-icons.php';
