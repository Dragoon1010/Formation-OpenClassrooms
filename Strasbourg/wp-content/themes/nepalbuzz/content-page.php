<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package NepalBuzz
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	/**
	 * nepalbuzz_before_page_container hook
	 *
	 * @hooked nepalbuzz_single_content_image - 10
	 */
	do_action( 'nepalbuzz_before_page_container' ); ?>
	<div class="entry-container">
		<header class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
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
		<?php edit_post_link( esc_html__( 'Edit', 'nepalbuzz' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer>' ); ?>
	</div><!-- .entry-container -->
</article><!-- #post-## -->
