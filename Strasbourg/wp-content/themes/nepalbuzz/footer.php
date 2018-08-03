<?php
/**
 * The template for displaying the footer
 *
 * @package NepalBuzz
 */


/**
 * nepalbuzz_after_content hook
 *
 * @hooked nepalbuzz_content_end - 10
 * @hooked nepalbuzz_after_content_sidebar - 20
 * @hooked nepalbuzz_featured_content_display (move featured content below homepage posts) - 30
 *
 */
do_action( 'nepalbuzz_after_content' );


/**
 * nepalbuzz_footer hook
 *
 * @hooked nepalbuzz_footer_content_start - 10
 * @hooked nepalbuzz_footer_sidebar - 20
 * @hooked nepalbuzz_site_generator_start - 30
 * @hooked nepalbuzz_footer_menu - 40
 * @hooked nepalbuzz_footer_content - 50
 * @hooked nepalbuzz_site_generator_end - 60
 * @hooked nepalbuzz_footer_content_end - 70
 * @hooked nepalbuzz_site_content_end - 100
 *
 */
do_action( 'nepalbuzz_footer' );


/**
 * nepalbuzz_after hook
 *
 * @hooked nepalbuzz_page_end - 10
 * @hooked nepalbuzz_scrollup - 20
 *
 */
do_action( 'nepalbuzz_after' );

wp_footer(); ?>
</body>
</html>
