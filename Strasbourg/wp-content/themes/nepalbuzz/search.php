<?php
/**
 * The template for displaying Search Results pages
 *
 * @package NepalBuzz
 */

get_header();
?>

	<?php if ( have_posts() ) : ?>

		<header class="entry-header">
			<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'nepalbuzz' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		</header><!-- .page-header -->

		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'search' ); ?>

		<?php endwhile; ?>

		<?php nepalbuzz_content_nav( 'nav-below' ); ?>

	<?php else : ?>

		<?php get_template_part( 'content', 'none' ); ?>

	<?php endif; ?>

<?php
get_sidebar();

get_footer(); ?>
