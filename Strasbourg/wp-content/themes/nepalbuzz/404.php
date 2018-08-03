<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package NepalBuzz
 */

get_header();
?>

		<?php if ( is_active_sidebar( 'sidebar-notfound' ) ) :
			dynamic_sidebar( 'sidebar-notfound' );
		else : ?>
		<article id="page-404" class="error-404 not-found type-page hentry">
			<div class="entry-container">
				<header class="entry-header">
					<h1 class="entry-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'nepalbuzz' ); ?></h1>
				</header><!-- .page-header -->

				<div class="entry-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'nepalbuzz' ); ?></p>

					<?php get_search_form(); ?>

				</div><!-- .page-content -->
			</div><!-- .entry-container -->
		</article><!-- .error-404 -->
	<?php endif; ?>

<?php
get_sidebar();
get_footer(); ?>
