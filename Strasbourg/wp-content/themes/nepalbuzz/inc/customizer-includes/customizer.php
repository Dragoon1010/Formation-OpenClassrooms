<?php
/**
 * The main template for implementing Theme/Customzer Options
 *
 * @package NepalBuzz
 */


/**
 * Implements NepalBuzz theme options into Theme Customizer.
 *
 * @param $wp_customize Theme Customizer object
 * @return void
 *
 * @since NepalBuzz 0.1
 */
function nepalbuzz_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport			= 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport	= 'postMessage';

	$options  = nepalbuzz_get_options();

	$defaults = nepalbuzz_default_options();

	//Custom Controls
	require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/custom-controls.php';

	// Move title_tagline (added to Site Title and Tagline section in Theme Customizer)
	$wp_customize->add_setting( 'nepalbuzz_theme_options[move_title_tagline]', array(
		'default'			=> $defaults['move_title_tagline'],
		'sanitize_callback' => 'nepalbuzz_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'nepalbuzz_theme_options[move_title_tagline]', array(
		'label'    => esc_html__( 'Check to move Site Title and Tagline before logo', 'nepalbuzz' ),
		'priority' => 103,
		'section'  => 'title_tagline',
		'settings' => 'nepalbuzz_theme_options[move_title_tagline]',
		'type'     => 'checkbox',
	) );
	// Custom Logo End

	// Header Options (added to Header section in Theme Customizer)
	require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/header-options.php';

	//Theme Options
	require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/theme-options.php';

	//Featured Content
	require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/featured-content.php';

	//Featured Slider
	require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/featured-slider.php';

	//News Ticker
	require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/news-ticker.php';

	//Social Links
	require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/social-icons.php';

	// Reset all settings to default
	$wp_customize->add_section( 'nepalbuzz_reset_all_settings', array(
		'description'	=> esc_html__( 'Caution: Reset all settings to default. Refresh the page after save to view full effects.', 'nepalbuzz' ),
		'priority' 		=> 900,
		'title'    		=> esc_html__( 'Reset all settings', 'nepalbuzz' ),
	) );

	$wp_customize->add_setting( 'nepalbuzz_theme_options[reset_all_settings]', array(
		'default'			=> $defaults['reset_all_settings'],
		'sanitize_callback' => 'nepalbuzz_sanitize_checkbox',
		'transport'			=> 'postMessage',
	) );

	$wp_customize->add_control( 'nepalbuzz_theme_options[reset_all_settings]', array(
		'label'    => esc_html__( 'Check to reset all settings to default', 'nepalbuzz' ),
		'section'  => 'nepalbuzz_reset_all_settings',
		'settings' => 'nepalbuzz_theme_options[reset_all_settings]',
		'type'     => 'checkbox',
	) );
	// Reset all settings to default end


	//Important Links
		$wp_customize->add_section( 'important_links', array(
			'priority' 		=> 999,
			'title'   	 	=> esc_html__( 'Important Links', 'nepalbuzz' ),
		) );

		/**
		 * Has dummy Sanitizaition function as it contains no value to be sanitized
		 */
		$wp_customize->add_setting( 'important_links', array(
			'sanitize_callback'	=> 'nepalbuzz_sanitize_important_link',
		) );

		$wp_customize->add_control( new nepalbuzz_Important_Links( $wp_customize, 'important_links', array(
	        'label'   	=> esc_html__( 'Important Links', 'nepalbuzz' ),
	         'section'  	=> 'important_links',
	        'settings' 	=> 'important_links',
	        'type'     	=> 'important_links',
	    ) ) );
	    //Important Links End
}
add_action( 'customize_register', 'nepalbuzz_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously for NepalBuzz.
 * And flushes out all transient data on preview
 *
 * @since NepalBuzz 0.1
 */
function nepalbuzz_customize_preview() {
	wp_enqueue_script( 'nepalbuzz_customizer', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'js/customizer.min.js', array( 'customize-preview' ), '20120827', true );

	//Flush transients
	nepalbuzz_flush_transients();
}
add_action( 'customize_preview_init', 'nepalbuzz_customize_preview' );


/**
 * Custom scripts and styles on customize.php for NepalBuzz.
 *
 * @since NepalBuzz 0.1
 */
function nepalbuzz_customize_scripts() {
	wp_enqueue_script( 'nepalbuzz_customizer_custom', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'js/customizer-custom-scripts.min.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), '20150630', true );

	$data = array(
		'reset_message'     => esc_html__( 'Refresh the customizer page after saving to view reset effects', 'nepalbuzz' )
	);

	// Send list of color variables as object to custom customizer js
	wp_localize_script( 'nepalbuzz_customizer_custom', 'nepalbuzz_data', $data );
}
add_action( 'customize_controls_enqueue_scripts', 'nepalbuzz_customize_scripts');


/**
 * Function to reset date with respect to condition
 *
 * @since NepalBuzz 0.1
 *
 */
function nepalbuzz_reset_data() {
	$options  = nepalbuzz_get_options();
    if( $options['reset_all_settings'] ) {
    	remove_theme_mods();

        // Flush out all transients	on reset
        nepalbuzz_flush_transients();
    }
}
add_action( 'customize_save_after', 'nepalbuzz_reset_data' );

//Active callbacks for customizer
require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/active-callbacks.php';


//Sanitize functions for customizer
require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/sanitize-functions.php';

// Add Upgrade to Pro Button.
require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/upgrade-button/class-customize.php';
