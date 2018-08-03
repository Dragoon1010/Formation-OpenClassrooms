<?php
/**
 * The Footer Sidebar containing the footer widget areas.
 *
 * @package NepalBuzz
 */

/* The footer widget area is triggered if any of the areas
 * have widgets. So let's check that first.
 *
 * If none of the sidebars have widgets, then let's bail early.
 */
if (   ! is_active_sidebar( 'footer-1'  )
	&& ! is_active_sidebar( 'footer-2' )
	&& ! is_active_sidebar( 'footer-3'  )
) {
	return;
}
// If we get this far, we have widgets. Let do this.
?>
<div id="supplementary" <?php nepalbuzz_footer_sidebar_class(); ?>>
    <div class="wrapper">
        <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
        <aside id="first" class="widget-area" role="complementary">
            <?php dynamic_sidebar( 'footer-1' ); ?>
        </aside><!-- #first .widget-area -->
        <?php endif; ?>

        <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
        <aside id="second" class="widget-area" role="complementary">
            <?php dynamic_sidebar( 'footer-2' ); ?>
        </aside><!-- #second .widget-area -->
        <?php endif; ?>

        <?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
        <aside id="third" class="widget-area" role="complementary">
            <?php dynamic_sidebar( 'footer-3' ); ?>
        </aside><!-- #third .widget-area -->
        <?php endif; ?>
    </div> <!-- .wrapper -->
</div><!-- #supplementary -->
