<?php
/**
 * The template for displaying custom menus
 *
 * @package NepalBuzz
 */


if ( ! function_exists( 'nepalbuzz_primary_menu' ) ) :
/**
 * Shows the Primary Menu
 *
 * default load in sidebar-header-right.php
 */
function nepalbuzz_primary_menu() {
    ?>

    <button id="menu-toggle-primary" class="menu-toggle"><span class="menu-label"><?php esc_html_e( 'Menu', 'nepalbuzz' ); ?></span></button>
    <div id="primary-menu">
        <div class="wrapper">
            <div id="site-header-menu" class="menu-primary">
                <nav id="site-navigation" class="main-navigation nav-primary search-enabled" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'nepalbuzz' ); ?>">
                    <h3 class="screen-reader-text"><?php esc_html_e( 'Primary menu', 'nepalbuzz' ); ?></h3>
                    <?php
                        if ( has_nav_menu( 'primary' ) ) {
                            $args = array(
                                'theme_location'    => 'primary',
                                'menu_class'        => 'menu nepalbuzz-nav-menu',
                                'container'         => false
                            );
                            wp_nav_menu( $args );
                        }
                        else {
                            wp_page_menu( array( 'menu_class'  => 'default-page-menu' ) );
                        }
                        ?>

                        <div id="search-toggle">
                            <a class="screen-reader-text" href="#search-container"><?php esc_html_e( 'Search', 'nepalbuzz' ); ?></a>
                        </div>

                        <div id="search-container" class="displaynone">
                            <?php get_search_form(); ?>
                        </div>
                </nav><!-- .nav-primary -->
            </div><!-- #site-header-menu -->
        </div><!-- .wrapper -->
    </div><!-- #primary-menu-wrapper -->
    <?php
}
endif; //nepalbuzz_primary_menu
add_action( 'nepalbuzz_header', 'nepalbuzz_primary_menu', 40 );


if ( ! function_exists( 'nepalbuzz_add_page_menu_class' ) ) :
/**
 * Filters wp_page_menu to add menu class  for default page menu
 *
 */
function nepalbuzz_add_page_menu_class( $ulclass ) {
  return preg_replace( '/<ul>/', '<ul class="menu nepalbuzz-nav-menu">', $ulclass, 1 );
}
endif; //nepalbuzz_add_page_menu_class
add_filter( 'wp_page_menu', 'nepalbuzz_add_page_menu_class', 90 );


if ( ! function_exists( 'nepalbuzz_footer_menu' ) ) :
/**
 * Shows the Footer Menu
 *
 * default load in sidebar-header-right.php
 */
function nepalbuzz_footer_menu() {
	if ( has_nav_menu( 'footer' ) ) {
    ?>
	<nav class="nav-footer" role="navigation" aria-label="<?php esc_attr_e( 'Footer Menu', 'nepalbuzz' ); ?>">
        <div class="wrapper">
            <h3 class="assistive-text"><?php _e( 'Footer menu', 'nepalbuzz' ); ?></h3>
            <?php
                $args = array(
                    'theme_location' => 'footer',
                    'menu_class'     => 'menu nepalbuzz-nav-menu',
                    'depth'          => 1
                );
                wp_nav_menu( $args );
            ?>
    	</div><!-- .wrapper -->
    </nav><!-- .nav-footer -->
<?php
    }
}
endif; //nepalbuzz_footer_menu
add_action( 'nepalbuzz_footer', 'nepalbuzz_footer_menu', 40 );
