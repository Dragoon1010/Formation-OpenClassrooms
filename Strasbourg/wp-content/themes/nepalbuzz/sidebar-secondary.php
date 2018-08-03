<?php
/**
 * The Secondary Sidebar containing the secondary widget area
 *
 * @package NepalBuzz
 */


$layout = nepalbuzz_get_theme_layout();
//Bail early if no sidebar layout is selected
if ( 'three-columns-content-left' != $layout ) {
	return;
}

/**
 * nepalbuzz_before_secondary_sidebar hook
 *
 * @hooked nepalbuzz_sidebar_secondary - 25
 */
do_action( 'nepalbuzz_before_secondary_sidebar' ); ?>

<aside class="sidebar sidebar-secondary widget-area" role="complementary">
	<?php
	if ( is_active_sidebar( 'secondary-sidebar' ) ) {
    	dynamic_sidebar( 'secondary-sidebar' );
	}
	else {
		//Helper Text
		if ( current_user_can( 'edit_theme_options' ) ) { ?>
			<section id="widget-default-text" class="widget widget_text">
				<div class="widget-wrap">
                	<h4 class="widget-title"><?php esc_html_e( 'Secondary Sidebar Widget Area', 'nepalbuzz' ); ?></h4>

           			<div class="textwidget">
                   		<p><?php _e( 'This is the Secondary Sidebar Widget Area if you are using a three column site layout option.', 'nepalbuzz' ); ?></p>
                   		<p><?php printf( wp_kses( __( 'By default it will load Search and Archives widgets as shown below. You can add widget to this area by visiting your <a href="%1$s">Widgets Panel</a> which will replace default widgets.', 'nepalbuzz' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'widgets.php' ) ) ); ?></p>
                 	</div>
           		</div><!-- .widget-wrap -->
       		</section><!-- #widget-default-text -->
		<?php
		} ?>
		<section class="widget widget_search" id="default-search">
			<div class="widget-wrap">
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
</aside><!-- .sidebar .sidebar-secondary .widget-area -->

<?php
/**
 * nepalbuzz_after_secondary_sidebar hook
 *
 */
do_action( 'nepalbuzz_after_secondary_sidebar' );
