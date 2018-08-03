<?php
/**
* The template for adding Featured Content Settings in Customizer
*
* @package NepalBuzz
*/

$wp_customize->add_section( 'nepalbuzz_featured_content', array(
	'priority'      => 400,
	'title'			=> esc_html__( 'Featured Content', 'nepalbuzz' ),
) );

$wp_customize->add_setting( 'nepalbuzz_theme_options[featured_content_option]', array(
	'default'			=> $defaults['featured_content_option'],
	'sanitize_callback' => 'nepalbuzz_sanitize_select',
) );

$wp_customize->add_control( 'nepalbuzz_theme_options[featured_content_option]', array(
	'choices'  	=> nepalbuzz_featured_section_options(),
	'label'    	=> esc_html__( 'Enable Featured Content on', 'nepalbuzz' ),
	'section'  	=> 'nepalbuzz_featured_content',
	'settings' 	=> 'nepalbuzz_theme_options[featured_content_option]',
	'type'	  	=> 'select',
) );

$wp_customize->add_setting( 'nepalbuzz_theme_options[featured_content_layout]', array(
	'default'			=> $defaults['featured_content_layout'],
	'sanitize_callback' => 'nepalbuzz_sanitize_select',
) );

$wp_customize->add_control( 'nepalbuzz_theme_options[featured_content_layout]', array(
	'active_callback' => 'nepalbuzz_is_featured_content_active',
	'choices'         => nepalbuzz_featured_content_layout_options(),
	'label'           => esc_html__( 'Select Featured Content Layout', 'nepalbuzz' ),
	'section'         => 'nepalbuzz_featured_content',
	'settings'        => 'nepalbuzz_theme_options[featured_content_layout]',
	'type'            => 'select',
) );

$wp_customize->add_setting( 'nepalbuzz_theme_options[featured_content_position]', array(
	'default'			=> $defaults['featured_content_position'],
	'sanitize_callback' => 'nepalbuzz_sanitize_checkbox'
) );

$wp_customize->add_control( 'nepalbuzz_theme_options[featured_content_position]', array(
	'active_callback' => 'nepalbuzz_is_featured_content_active',
	'label'           => esc_html__( 'Check to Move above Footer', 'nepalbuzz' ),
	'section'         => 'nepalbuzz_featured_content',
	'settings'        => 'nepalbuzz_theme_options[featured_content_position]',
	'type'            => 'checkbox',
) );

$wp_customize->add_setting( 'nepalbuzz_theme_options[featured_content_headline]', array(
	'default'			=> $defaults['featured_content_headline'],
	'sanitize_callback'	=> 'wp_kses_post',
) );

$wp_customize->add_control( 'nepalbuzz_theme_options[featured_content_headline]' , array(
	'active_callback'	=> 'nepalbuzz_is_featured_content_active',
	'description'	=> esc_html__( 'Leave field empty if you want to remove Headline', 'nepalbuzz' ),
	'label'    		=> esc_html__( 'Headline for Featured Content', 'nepalbuzz' ),
	'section'  		=> 'nepalbuzz_featured_content',
	'settings' 		=> 'nepalbuzz_theme_options[featured_content_headline]',
	'type'	   		=> 'text',
	)
);

$wp_customize->add_setting( 'nepalbuzz_theme_options[featured_content_subheadline]', array(
	'default'			=> $defaults['featured_content_subheadline'],
	'sanitize_callback'	=> 'wp_kses_post',
) );

$wp_customize->add_control( 'nepalbuzz_theme_options[featured_content_subheadline]' , array(
	'active_callback'	=> 'nepalbuzz_is_featured_content_active',
	'description'	=> esc_html__( 'Leave field empty if you want to remove Sub-headline', 'nepalbuzz' ),
	'label'    		=> esc_html__( 'Sub-headline for Featured Content', 'nepalbuzz' ),
	'section'  		=> 'nepalbuzz_featured_content',
	'settings' 		=> 'nepalbuzz_theme_options[featured_content_subheadline]',
	'type'	   		=> 'text',
	)
);

$wp_customize->add_setting( 'nepalbuzz_theme_options[featured_content_number]', array(
	'default'			=> $defaults['featured_content_number'],
	'sanitize_callback'	=> 'nepalbuzz_sanitize_number_range',
) );

$wp_customize->add_control( 'nepalbuzz_theme_options[featured_content_number]' , array(
		'active_callback' => 'nepalbuzz_is_featured_content_active',
		'description'     => esc_html__( 'Save and refresh the page if No. of Featured Content is changed (Max no of Featured Content is 20)', 'nepalbuzz' ),
		'input_attrs'     => array(
			'style' => 'width: 100px;',
			'min'   => 0,
			'max'   => 20,
			'step'  => 1,
		),
		'label'           => esc_html__( 'No of Featured Content', 'nepalbuzz' ),
		'section'         => 'nepalbuzz_featured_content',
		'settings'        => 'nepalbuzz_theme_options[featured_content_number]',
		'type'            => 'number',
		'transport'       => 'postMessage'
	)
);

$wp_customize->add_setting( 'nepalbuzz_theme_options[featured_content_show]', array(
	'default'			=> $defaults['featured_content_show'],
	'sanitize_callback'	=> 'nepalbuzz_sanitize_select',
) );

$wp_customize->add_control( 'nepalbuzz_theme_options[featured_content_show]', array(
	'active_callback' => 'nepalbuzz_is_featured_content_active',
	'choices'         => nepalbuzz_featured_content_show(),
	'label'           => esc_html__( 'Display Content', 'nepalbuzz' ),
	'section'         => 'nepalbuzz_featured_content',
	'settings'        => 'nepalbuzz_theme_options[featured_content_show]',
	'type'            => 'select',
) );


//loop for featured post content
for ( $i=1; $i <=  $options['featured_content_number'] ; $i++ ) {
	$wp_customize->add_setting( 'nepalbuzz_theme_options[featured_content_page_'. $i .']', array(
		'sanitize_callback' => 'nepalbuzz_sanitize_page',
	) );

	$wp_customize->add_control( 'nepalbuzz_featured_content_page_'. $i .'', array(
		'active_callback' => 'nepalbuzz_is_featured_content_active',
		'label'           => esc_html__( 'Featured Page', 'nepalbuzz' ) . ' ' . $i ,
		'section'         => 'nepalbuzz_featured_content',
		'settings'        => 'nepalbuzz_theme_options[featured_content_page_'. $i .']',
		'type'            => 'dropdown-pages',
	) );
}
