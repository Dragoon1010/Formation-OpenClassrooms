<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package NepalBuzz
 */

get_header();

?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', 'page' ); ?>

		<?php
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
