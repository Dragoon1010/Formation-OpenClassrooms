<?php
/**
 * The template for Managing Theme Structure
 *
 * @package NepalBuzz
 */


if ( ! function_exists( 'nepalbuzz_doctype' ) ) :
	/**
	 * Doctype Declaration
	 *
	 * @since NepalBuzz 0.1
	 *
	 */
	function nepalbuzz_doctype() {
		?>
		<!DOCTYPE html>
		<html <?php language_attributes(); ?>>
		<?php
	}
endif;
add_action( 'nepalbuzz_doctype', 'nepalbuzz_doctype', 10 );


if ( ! function_exists( 'nepalbuzz_head' ) ) :
	/**
	 * Header Codes
	 *
	 * @since NepalBuzz 0.1
	 *
	 */
	function nepalbuzz_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php
	}
endif;
add_action( 'nepalbuzz_before_wp_head', 'nepalbuzz_head', 10 );


if ( ! function_exists( 'nepalbuzz_page_start' ) ) :
	/**
	 * Start div id #page
	 *
	 * @since NepalBuzz 0.1
	 *
	 */
	function nepalbuzz_page_start() {
		?>
		<div id="page" class="hfeed site">
		<?php
	}
endif;
add_action( 'nepalbuzz_before', 'nepalbuzz_page_start', 10 );


if ( ! function_exists( 'nepalbuzz_page_end' ) ) :
	/**
	 * End div id #page
	 *
	 * @since NepalBuzz 0.1
	 *
	 */
	function nepalbuzz_page_end() {
		?>
		</div><!-- #page -->
		<?php
	}
endif;
add_action( 'nepalbuzz_after', 'nepalbuzz_page_end', 10 );


if ( ! function_exists( 'nepalbuzz_header_start' ) ) :
	/**
	 * Start Header id #masthead and class .wrapper
	 *
	 * @since NepalBuzz 0.1
	 *
	 */
	function nepalbuzz_header_start() {
		?>
        <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'nepalbuzz' ); ?></a>

        <header id="masthead" role="banner">
		<?php
	}
endif;
add_action( 'nepalbuzz_header', 'nepalbuzz_header_start', 10 );


if ( ! function_exists( 'nepalbuzz_header_end' ) ) :
	/**
	 * End Header id #masthead and class .wrapper
	 *
	 * @since NepalBuzz 0.1
	 *
	 */
	function nepalbuzz_header_end() {
		?>
		</header><!-- #masthead -->
		<?php
	}
endif;
add_action( 'nepalbuzz_header', 'nepalbuzz_header_end', 100 );


if ( ! function_exists( 'nepalbuzz_header_top_start' ) ) :
	/**
	 * Start class .site-header-main
	 *
	 * @since NepalBuzz 0.1
	 *
	 */
	function nepalbuzz_header_top_start() {
		?>
		<div id="header-top">
			<div class="wrapper">
    			<div class="site-header-main">
		<?php
	}
endif;
add_action( 'nepalbuzz_header', 'nepalbuzz_header_top_start', 20 );


if ( ! function_exists( 'nepalbuzz_header_top_end' ) ) :
	/**
	 * End class .site-header-main
	 *
	 * @since NepalBuzz 0.1
	 *
	 */
	function nepalbuzz_header_top_end() {
		?>
				</div><!-- .site-header-main -->
			</div><!-- .wrapper -->
    	</div><!-- .site-header-main -->
		<?php
	}
endif;
add_action( 'nepalbuzz_header', 'nepalbuzz_header_top_end', 50 );


if ( ! function_exists( 'nepalbuzz_site_content_start' ) ) :
	/**
	 * Start class .site-content-contain
	 *
	 * @since NepalBuzz 0.1
	 *
	 */
	function nepalbuzz_site_content_start() {
		?>
		<div class="site-content-contain">
		<?php
	}
endif;
add_action( 'nepalbuzz_after_header', 'nepalbuzz_site_content_start', 10 );


if ( ! function_exists( 'nepalbuzz_site_content_end' ) ) :
	/**
	 * End class .site-content-contain
	 *
	 * @since NepalBuzz 0.1
	 *
	 */
	function nepalbuzz_site_content_end() {
		?>
		</div><!-- .site-content-contain -->
		<?php
	}
endif;
add_action( 'nepalbuzz_footer', 'nepalbuzz_site_content_end', 100 );


if ( ! function_exists( 'nepalbuzz_content_start' ) ) :
	/**
	 * Start div id #content and class .wrapper
	 *
	 * @since NepalBuzz 0.1
	 *
	 */
	function nepalbuzz_content_start() {
		?>
		<div id="content" class="site-content">
			<div class="wrapper">
	<?php
	}
endif;
add_action('nepalbuzz_content', 'nepalbuzz_content_start', 30 );


if ( ! function_exists( 'nepalbuzz_primary_start' ) ) :
	/**
	 * Start div id #primary
	 *
	 * @since NepalBuzz 0.1
	 *
	 */
	function nepalbuzz_primary_start() {
		?>
		<div id="primary" class="content-area">
		<?php
	}
endif;
add_action( 'nepalbuzz_content', 'nepalbuzz_primary_start', 40 );


if ( ! function_exists( 'nepalbuzz_main_start' ) ) :
	/**
	 * Start main #main
	 *
	 * @since NepalBuzz 0.1
	 *
	 */
	function nepalbuzz_main_start() {
		?>
		<main id="main" class="site-main" role="main">
		<?php
	}
endif;
add_action( 'nepalbuzz_content', 'nepalbuzz_main_start', 50 );


if ( ! function_exists( 'nepalbuzz_main_end' ) ) :
	/**
	 * End main #main
	 *
	 * @since NepalBuzz 0.1
	 *
	 */
	function nepalbuzz_main_end() {
		?>
		</main><!-- #main -->
		<?php
	}
endif;
add_action( 'nepalbuzz_before_secondary', 'nepalbuzz_main_end', 20 );


if ( ! function_exists( 'nepalbuzz_sidebar_secondary' ) ) :
	/**
	 * Secondary Sidebar
	 *
	 * @since NepalBuzz 0.1
	 */
	function nepalbuzz_sidebar_secondary() {
		get_sidebar( 'secondary' );
	}
endif;
add_action( 'nepalbuzz_before_secondary', 'nepalbuzz_sidebar_secondary', 25 );


if ( ! function_exists( 'nepalbuzz_primary_end' ) ) :
	/**
	 * End div id #primary
	 *
	 * @since NepalBuzz 0.1
	 *
	 */
	function nepalbuzz_primary_end() {
		?>
		</div><!-- #primary -->
		<?php
	}
endif;
add_action( 'nepalbuzz_before_secondary', 'nepalbuzz_primary_end', 30 );


if ( ! function_exists( 'nepalbuzz_content_end' ) ) :
	/**
	 * End div id #content and class .wrapper
	 *
	 * @since NepalBuzz 0.1
	 */
	function nepalbuzz_content_end() {
		?>
			</div><!-- .wrapper -->
	    </div><!-- #content -->
		<?php
	}

endif;
add_action( 'nepalbuzz_after_content', 'nepalbuzz_content_end', 10 );


if ( ! function_exists( 'nepalbuzz_footer_content_start' ) ) :
/**
 * Start footer id #colophon
 *
 * @since NepalBuzz 0.1
 */
function nepalbuzz_footer_content_start() {
	?>
	<footer id="colophon" class="site-footer" role="contentinfo">
    <?php
}
endif;
add_action('nepalbuzz_footer', 'nepalbuzz_footer_content_start', 10 );


if ( ! function_exists( 'nepalbuzz_footer_sidebar' ) ) :
/**
 * Footer Sidebar
 *
 * @since NepalBuzz 0.1
 */
function nepalbuzz_footer_sidebar() {
	get_sidebar( 'footer' );
}
endif;
add_action( 'nepalbuzz_footer', 'nepalbuzz_footer_sidebar', 20 );


if ( ! function_exists( 'nepalbuzz_footer_content_end' ) ) :
/**
 * End footer id #colophon
 *
 * @since NepalBuzz 0.1
 */
function nepalbuzz_footer_content_end() {
	?>
	</footer><!-- #colophon -->
	<?php
}
endif;
add_action( 'nepalbuzz_footer', 'nepalbuzz_footer_content_end', 70 );
