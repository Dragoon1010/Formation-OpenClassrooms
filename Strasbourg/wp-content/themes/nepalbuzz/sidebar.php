<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package NepalBuzz
 */
?>

<?php
/**
 * nepalbuzz_before_secondary hook
 *
 * @hooked nepalbuzz_after_posts_pages_sidebar - 10
 * @hooked nepalbuzz_main_end - 20
 * @hooked nepalbuzz_primary_end - 30
 *
 */
do_action( 'nepalbuzz_before_secondary' );

$layout = nepalbuzz_get_theme_layout();

//Bail early if no sidebar layout is selected
if ( 'no-sidebar' == $layout ) {
	return;
}

/**
 * nepalbuzz_before_primary_sidebar hook
 */
do_action( 'nepalbuzz_before_primary_sidebar' );
?>
	<aside class="sidebar sidebar-primary widget-area" role="complementary">
		<?php
		if ( is_active_sidebar( 'primary-sidebar' ) ) {
        	dynamic_sidebar( 'primary-sidebar' );
   		}
		else {
			//Helper Text
			if ( current_user_can( 'edit_theme_options' ) ) { ?>
				<section id="widget-default-text" class="widget widget_text">
					<div class="widget-wrap">
	                	<h4 class="widget-title"><?php esc_html_e( 'Primary Sidebar Widget Area', 'nepalbuzz' ); ?></h4>

	                 	<div class="textwidget">
	                   		<p><?php _e( 'This is the Primary Sidebar Widget Area if you are using a two or three column site layout option.', 'nepalbuzz' ); ?></p>
	                   		<p><?php printf( wp_kses( __( 'By default it will load Search and Archives widgets as shown below. You can add widget to this area by visiting your <a href="%1$s">Widgets Panel</a> which will replace default widgets.', 'nepalbuzz' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'widgets.php' ) ) ); ?></p>
                 		</div><!-- .textwidget -->
	           		</div><!-- .widget-wrap -->
	       		</section><!-- #widget-default-text -->
			<?php
			} ?>
			<section class="widget widget_widget_nepalbuzz_adspace_widget" id="header-right-ads">
				<div class="widget-wrap">
					<a class="ads-image" href="#">
						<img src="<?php echo trailingslashit( esc_url( get_template_directory_uri() ) ); ?>images/ads-300x250.jpg">
					</a>
				</div><!-- .widget-wrap -->
			</section><!-- .widget-wrap -->
			<section class="widget widget_search" id="default-search">
				<div class="widget-wrap">
					<h4 class="widget-title"><?php esc_html_e( 'Search', 'nepalbuzz' ); ?></h4>
					<?php get_search_form(); ?>
				</div><!-- .widget-wrap -->
			</section><!-- #default-search -->
			<section class="widget widget_archive" id="default-archives">
				<div class="widget-wrap">
					<h4 class="widget-title"><?php esc_html_e( 'Archives', 'nepalbuzz' ); ?></h4>
					<ul>
						<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
					</ul>
				</div><!-- .widget-wrap -->
			</section><!-- #default-archives -->
			<?php
		} ?>
	</aside><!-- .sidebar sidebar-primary widget-area -->
<?php
/**
 * nepalbuzz_after_primary_sidebar hook
 */
do_action( 'nepalbuzz_after_primary_sidebar' );


/**
 * nepalbuzz_after_secondary hook
 *
 */
do_action( 'nepalbuzz_after_secondary' );
