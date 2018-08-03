<?php
/**
 * Functions and definitions
 *
 * Sets up the theme using core nepalbuzz-core and provides some helper functions using nepalbuzz-custon-functions.
 * Others are attached to action and
 * filter hooks in WordPress to change core functionality
 *
 * @package NepalBuzz
 */

//define theme version
if ( !defined( 'NEPALBUZZ_THEME_VERSION' ) ) {
	$theme_data = wp_get_theme();

	define ( 'NEPALBUZZ_THEME_VERSION', $theme_data->get( 'Version' ) );
}

/**
 * Implement the core functions
 */
require trailingslashit( get_template_directory() ) . 'inc/core.php';
