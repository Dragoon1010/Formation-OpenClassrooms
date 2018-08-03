<?php
/**
 * The Template for displaying all single posts
 *
 * @package NepalBuzz
 */

get_header();

?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', 'single' ); ?>

		<?php
			/**
			 * nepalbuzz_after_post hook
			 *
			 * @hooked nepalbuzz_post_navigation - 10
			 */
			do_action( 'nepalbuzz_after_post' );

			/**
			 * nepalbuzz_comment_section hook
			 *
			 * @hooked nepalbuzz_get_comment_section - 10
			 */
			do_action( 'nepalbuzz_comment_section' );
		?>
	<?php endwhile; // end of the loop. ?>

<?php

get_sidebar();

get_footer(); ?>
