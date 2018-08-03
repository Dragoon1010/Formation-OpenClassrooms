<?php
/**
 * The default template for displaying header
 *
 * @package NepalBuzz
 */

	/**
	 * nepalbuzz_doctype hook
	 *
	 * @hooked nepalbuzz_doctype -  10
	 *
	 */
	do_action( 'nepalbuzz_doctype' );?>

<head>
<?php
	/**
	 * nepalbuzz_before_wp_head hook
	 *
	 * @hooked nepalbuzz_head -  10
	 *
	 */
	do_action( 'nepalbuzz_before_wp_head' );

	wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
	/**
     * nepalbuzz_before_header hook
	 *
	 * @hooked nepalbuzz_page_start -  10
     */
    do_action( 'nepalbuzz_before' );

	/**
	 * nepalbuzz_header hook
	 *
	 * @hooked nepalbuzz_header_start- 10
	 * @hooked nepalbuzz_header_top_start- 20
	 * @hooked nepalbuzz_site_branding - 30
	 * @hooked nepalbuzz_primary_menu - 40
	 * @hooked nepalbuzz_header_top_end - 50
	 * @nepalbuzz_header_div - 60
	 * @hooked nepalbuzz_featured_slider - 70
	 * @hooked nepalbuzz_header_end - 100
	 *
	 */
	do_action( 'nepalbuzz_header' );

	/**
     * nepalbuzz_after_header hook
     *
     * @hooked nepalbuzz_site_content_start - 10
     * @hooked nepalbuzz_news_ticker_display (Before Header Bottom) - 20
     * @hooked nepalbuzz_header_bottom - 40
     *
     */
	do_action( 'nepalbuzz_after_header' );

	/**
	 * nepalbuzz_before_content hook
     * @hooked nepalbuzz_news_ticker_display (After Header Bottom) - 20
     * @hooked nepalbuzz_news_ticker_display 40 (After Secondary Menu)
     * @hooked nepalbuzz_promotion_headline - 50
     * @hooked nepalbuzz_add_breadcrumb - 60
	 * @hooked nepalbuzz_featured_content_display ( Above homepage posts - default option ) - 70
     *
	 */
	do_action( 'nepalbuzz_before_content' );

	/**
     * nepalbuzz_main hook
     * @hooked nepalbuzz_before_content_sidebar - 20
     * @hooked nepalbuzz_content_start - 30
     * @hooked nepalbuzz_primary_start - 40
     * @hooked nepalbuzz_main_start - 50
     * @hooked nepalbuzz_before_posts_pages_sidebar - 60
     */
	do_action( 'nepalbuzz_content' );
