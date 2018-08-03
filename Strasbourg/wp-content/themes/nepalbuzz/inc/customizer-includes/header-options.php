<?php
/**
* The template for adding Additional Header Option in Customizer
*
* @package NepalBuzz
*/

// Header Options
$description = $wp_customize->get_section( 'header_image' )->description;
$description = esc_html__( 'Video will only be used on Homepage/Frontpage. Other pages will use header image.', 'nepalbuzz' ) . '<br />' . $description;

$wp_customize->get_section( 'header_image' )->description = $description;

$wp_customize->add_setting( 'nepalbuzz_theme_options[enable_featured_header_image]', array(
	'default'			=> $defaults['enable_featured_header_image'],
	'sanitize_callback' => 'nepalbuzz_sanitize_select',
) );

$wp_customize->add_control( 'nepalbuzz_theme_options[enable_featured_header_image]', array(
	'choices'  => nepalbuzz_enable_featured_header_image_options(),
	'label'    => esc_html__( 'Enable Header Media on ', 'nepalbuzz' ),
	'section'  => 'header_image',
	'settings' => 'nepalbuzz_theme_options[enable_featured_header_image]',
	'type'     => 'select',
	'priority' => 1
) );

$wp_customize->add_setting( 'nepalbuzz_theme_options[featured_image_size]', array(
	'default'			=> $defaults['featured_image_size'],
	'sanitize_callback' => 'nepalbuzz_sanitize_select',
) );

$wp_customize->add_control( 'nepalbuzz_theme_options[featured_image_size]', array(
	'choices'  => nepalbuzz_image_sizes_options(),
	'label'    => esc_html__( 'Page/Post Featured Header Image Size', 'nepalbuzz' ),
	'section'  => 'header_image',
	'settings' => 'nepalbuzz_theme_options[featured_image_size]',
	'type'     => 'select',
) );

$wp_customize->add_setting( 'nepalbuzz_theme_options[featured_header_title]', array(
	'default'			=> $defaults['featured_header_title'],
	'sanitize_callback' => 'wp_kses_post',
) );

$wp_customize->add_control( 'nepalbuzz_theme_options[featured_header_title]', array(
		'label'		=> esc_html__( 'Title', 'nepalbuzz' ),
		'section'   => 'header_image',
        'settings'  => 'nepalbuzz_theme_options[featured_header_title]',
        'type'	  	=> 'text',
) );

$wp_customize->add_setting( 'nepalbuzz_theme_options[featured_header_content]', array(
	'default'			=> $defaults['featured_header_content'],
	'sanitize_callback' => 'wp_kses_post',
) );

$wp_customize->add_control( 'nepalbuzz_theme_options[featured_header_content]', array(
	'label'    => esc_html__( 'Content', 'nepalbuzz' ),
	'section'  => 'header_image',
	'settings' => 'nepalbuzz_theme_options[featured_header_content]',
	'type'     => 'textarea',
) );

$wp_customize->add_setting( 'nepalbuzz_theme_options[featured_header_button_text]', array(
	'default'			=> $defaults['featured_header_button_text'],
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'nepalbuzz_theme_options[featured_header_button_text]', array(
	'label'    => esc_html__( 'Button Text', 'nepalbuzz' ),
	'section'  => 'header_image',
	'settings' => 'nepalbuzz_theme_options[featured_header_button_text]',
	'type'     => 'textarea',
) );

$wp_customize->add_setting( 'nepalbuzz_theme_options[featured_header_button_link]', array(
	'default'			=> $defaults['featured_header_button_link'],
	'sanitize_callback' => 'esc_url_raw',
) );

$wp_customize->add_control( 'nepalbuzz_theme_options[featured_header_button_link]', array(
	'label'    => esc_html__( 'Button Link', 'nepalbuzz' ),
	'section'  => 'header_image',
	'settings' => 'nepalbuzz_theme_options[featured_header_button_link]',
	'type'     => 'text',
) );

$wp_customize->add_setting( 'nepalbuzz_theme_options[featured_header_button_target]', array(
	'sanitize_callback' => 'nepalbuzz_sanitize_checkbox',
) );

$wp_customize->add_control( 'nepalbuzz_theme_options[featured_header_button_target]', array(
	'label'    => esc_html__( 'Check to Open Link in New Window/Tab', 'nepalbuzz' ),
	'section'  => 'header_image',
	'settings' => 'nepalbuzz_theme_options[featured_header_button_target]',
	'type'     => 'checkbox',
) );
// Header Options End
