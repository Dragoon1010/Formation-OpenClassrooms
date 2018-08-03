<?php
/**
 * The template used for displaying post content in single.php
 *
 * @package NepalBuzz
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	/**
	 * nepalbuzz_before_post_container hook
	 *
	 * @hooked nepalbuzz_single_content_image - 10
	 */
	do_action( 'nepalbuzz_before_post_container' ); ?>

	<div class="entry-container">
		<header class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>

			<?php nepalbuzz_entry_meta(); ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links"><span class="pages">' . esc_html__( 'Pages:', 'nepalbuzz' ) . '</span>',
					'after'  => '</div>',
					'link_before' 	=> '<span>',
                    'link_after'   	=> '</span>',
				) );
			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php nepalbuzz_tag_category(); ?>
		</footer><!-- .entry-footer -->
	</div><!-- .entry-container -->
</article><!-- #post-## -->
